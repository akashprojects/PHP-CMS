<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 7/11/12
 * Time: 7:57 AM
 * To change this template use File | Settings | File Templates.
 */
abstract class cmsHelper
{

    static function bakeArticleForViewers($articles)
    {

        foreach($articles as $article)
        {
            if ($article->articletype==1)
                $article->headingClass = 'entry-title-imp';
            elseif ($article->onlytitle==1)
                $article->headingClass = 'entry-title-onlytitle';
            else
                $article->headingClass = 'entry-title';

             $article->categoryName = $article->Category()->first()->getCategoryFullName();
             $article->categoryUrl = $article->Category()->first()->getCategoryUrl();
        }
        return $articles;
    }
    static function getCommentsByArticleId($id,&$message)
    {
       $message = "Show all articles by Article ".$id;
       return Comment::where('article_id','=',$id)->order_by('id', 'desc');
    }

    static function getAllComments(&$message,$search=null)
    {
        if(!is_null($search))
        {
            $message = "Showing all comments searches by \"$search\"";
            echo "%$search%";
            return Comment::where('name','like',"%$search%")->or_where('content','like',"%$search%")->or_where('email','like',"%$search%")->order_by('id', 'desc');
        }
        else{
        $message = "Showing all comments";
        return Comment::order_by('id', 'desc');}
    }


    static function closetags($html) {
        #put all opened tags into an array
        preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
        $openedtags = $result[1];

#put all closed tags into an array
        preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
        $closedtags = $result[1];
        $len_opened = count ( $openedtags );
# all tags are closed
        if( count ( $closedtags ) == $len_opened )
        {
            return $html;
        }
        $openedtags = array_reverse ( $openedtags );
# close tags
        for( $i = 0; $i < $len_opened; $i++ )
        {
            if ( !in_array ( $openedtags[$i], $closedtags ) )
            {
                $html .= "</" . $openedtags[$i] . ">";
            }
            else
            {
                unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
            }
        }
        return $html;
    }

    static function getArrayToString($params)
    {
        $url = "?";
        if (count($params) > 0) {
            $url .=  implode('&', array_map(function($item) {
                return $item[0] . '=' . $item[1];
            }, array_map(null, array_keys($params), $params))).'&';
        }

        return  $url;
    }
    static function getAllArticlesBySearch($search,&$message,$orderby="id")
    {
        if(Auth::user()->type!=1)
        {
            $message = 'Showing searches by '.$search;
            return Article::where('author_id','=',Auth::user()->id)->where('title','like ',"%$search%")->order_by($orderby, 'desc');
        }

        $message = 'Showing searches by '.$search;
        return Article::where('title','like ',"%$search%")->order_by($orderby, 'desc');
    }

    static function getAllArticlesByStatus($status,&$message,$orderby="id")
    {
        if(Auth::user()->type!=1)
        {
            $message = 'Showing all '.cmsHelper::getArticleStatusArray($status).' articles by me';
            return Article::where('author_id','=',Auth::user()->id)->where('status','=',$status)->order_by($orderby, 'desc');
        }

            $message = 'Showing all '.cmsHelper::getArticleStatusArray($status);
            return Article::where('status','=',$status)->order_by($orderby, 'desc');

    }
    static  function getAllArticlesByAuthorId($id,&$message,$orderby="id")
    {

        $article =  Article::where('author_id','=',$id)->order_by($orderby, 'desc');
        $message = "Showing all articles posted by ".ucfirst(User::find($id)->displayname);
        return $article;
    }
    static function getAllArticles(&$message, $forceall=false,$orderby="id")
    {

        if(!$forceall && isset($_GET['type']) && $_GET['type']==="unpublished")
        {
            if(Auth::user()->type!=1)
            {
                $message = "Showing all unpublished by you";
                return Article::where('author_id','=',Auth::user()->id)->where('status','=','0')->order_by($orderby, 'desc');
            }
            else
            {
                $message = "Showing all unpublished Articles (by all authors)";
                return Article::where('status','=','0')->order_by($orderby, 'desc');
            }

        }
        else if(!$forceall && Auth::user()->type!=1)
        {
            $message = "Showing all articles posted by you";
            return Article::where('author_id','=',Auth::user()->id)->order_by($orderby, 'desc');
        }
        else
        {
            $message="Showing all articles";

            return Article::order_by($orderby, 'desc');
        }
    }

    static function getAllArticlesByCategoryUrl($cateogoryUrl,&$message,$orderby="id")
    {
        $category = Category::where('curl','=',$cateogoryUrl)->first();
        $articles = array();


        $articles = Article::where('category_id','=',$category->id);

        if(is_null($category->parent_id))
        {

            $parentCategory = $category->InnerCategory()->get();
            foreach($parentCategory as $temp)
                $articles = $articles->or_where('category_id','=',$temp->id);


        }
        //If user is not admin, show only his articles
        if(Auth::user()->type!=1)
            $articles =  $articles->where('author_id','=',Auth::user()->id);

        $message = "Showing all Articles of Category named ".$category->getCategoryFullName();
        return $articles;
    }

    static function getAllArticlesByTagUrl($tagUrl,&$message,$orderby='id')
    {
        $curTag = Tag::where('turl','=',$tagUrl)->first();
        $articles = $curTag->Articles();

        //If user is not admin, show only his articles
        if(Auth::user()->type!=1)
            $articles =  $articles->where('author_id','=',Auth::user()->id);

        $articles = $articles->order_by($orderby,'desc');
        $message = "Showing all articles of tag named ".$curTag->tname;
        return $articles;
    }
    static function isEligible($articleContent)
    {
        $logged_in_user = Auth::user();

        if($articleContent==null)
            return false;

        if($logged_in_user->type!=1 && $logged_in_user->id!=$articleContent->author_id )
            return false;

        return true;
    }

    static function isCurrentUserAllowedToPerform($action=null)
    {

        $currentUserType = Auth::user()->type;
        $rights = array();
        $rights[2]=array("articles","comments" );
        $rights[3]=array( "comments" );
        //Allow admin
        if($currentUserType==1)
            return true;
        else if($currentUserType==2)
            return in_array($action, $rights[$currentUserType]);
        else if($currentUserType==3)
            return in_array($action, $rights[$currentUserType]);
    }

    static function getAllAuthorsArray()
    {
        $sendusers = array();

        //If the current user is not admin, directly skip array
        if(Auth::user()->type!=1)
            return array(Auth::user()->username);

        foreach(User::all() as $user)
            $sendusers[] = $user->username;
        return $sendusers;
    }
    static function getUserTypeArray()
    {
        $temp = array("Author","Moderator");
        return $temp;
    }

    static function getArticleTypeArray($id = null)
    {
        $temp = array("Normal","Important");
        return $id==null?$temp:$temp[$id];
    }
    static function getDisableEnableArray($id = null)
    {
        $temp =  array("Disabled", "Enabled");
        return $id==null?$temp:$temp[$id];
    }
    static function getArticleStatusArray($id=null)
    {

        $temp = array("Save(ed)", "Published");
        if(!is_null($id))
            return $temp[$id];
        return $temp;
    }
    static function getTagSelectBox($addedTags)
    {
        $output= '<select name="selectorbox[]"  data-placeholder="Click to add tags" style="width: 896px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
" multiple class="chzn-select" tabindex="8">';
        $output.='<option value=""></option>';
        $allTags = Tag::all();

        foreach($allTags as $tag)
            if(in_array($tag->tname,$addedTags))
                $output.="<option selected>$tag->tname</option>";
            else
                $output.="<option>$tag->tname</option>";
        $output.='</select>';
        return $output;
    }
    //Comparator sorts by the 2 ID's
    static function sortById( $a, $b )
    {
        return  $b->id -  $a->id;
    }

    static function getUrlFromId($article)
    {
        $category = Category::find($article->category_id);
        $url = "http://localhost";
        $categoryUrl = null;

        //Its a article within a parent category
        if( is_null($category->parent_id))
            $categoryUrl = $category->curl;
        else
        {
            $parentCategory = Category::find($category->parent_id);
            $categoryUrl = $parentCategory->curl.'/'.$category->curl;
            $article->childCatName = $category->cname;
        }

        $url=$url.'/'.$categoryUrl.'/'.(is_null($article->url)?str_replace(' ','-',$article->title):$article->url).'/'.$article->id;
        return $url;
    }
}
