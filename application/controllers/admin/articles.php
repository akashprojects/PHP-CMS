<?php

class Admin_Articles_Controller extends Base_Controller
{
    public $restful = true;

    public function get_edit()
    {
        $articleContent = Article::find($_GET['id']);

        if(!cmsHelper::isEligible($articleContent))
            return "Invalid Action";

        return View::make("admin.ArticleMgt.add",array("passedArticle"=>$articleContent,'message'=>"Editing Article"));
    }


    public function post_view()
    {
        $deletedIds = Input::get('delete');
        $search = Input::get('search');
        $i=0;
        if(isset($deletedIds))
        {
            foreach($deletedIds as $delete)
                Article::where('id','=',$delete)->first()->delete() && ++$i;

            return Redirect::to('/admin/articles/view')->with('message',$i." article(s) deleted");
        }
        if(strlen($search)>1)
            return Redirect::to('/admin/articles/view?filterby=search&value='.$search);
        Input::flush();

    return Redirect::to('/admin/articles/view')->with('message',' [no action performed]');
    }
    public function get_view()
    {
        $articles  = null;
        $message = "show all";

        $orderby = 'id';
        if(isset($_GET['sortby']))
           $orderby = $_GET['sortby'];

        if(isset($_GET['filterby']))
        {
            if($_GET['filterby']==="tag")
                $articles = cmsHelper::getAllArticlesByTagUrl($_GET['value'],$message,$orderby);
            else if($_GET['filterby']==="category")
                $articles = cmsHelper::getAllArticlesByCategoryUrl($_GET['value'],$message,$orderby);
            else if($_GET['filterby']==="author")
                $articles = cmsHelper::getAllArticlesByAuthorId($_GET['value'],$message,$orderby);
            else if($_GET['filterby']==="status")
                $articles = cmsHelper::getAllArticlesByStatus($_GET['value'],$message,$orderby);
            else if($_GET['filterby']==="search")
                $articles = cmsHelper::getAllArticlesBySearch($_GET['value'],$message,$orderby);


        }
        else
            $articles = cmsHelper::getAllArticles($message,false,$orderby);

        $filterdQueryStringArray = array();
        $output = null;
        parse_str( $_SERVER['QUERY_STRING'], $filterdQueryStringArray);
        unset($filterdQueryStringArray['page']);
        $output = $filterdQueryStringArray;
        unset($filterdQueryStringArray['sortby']);

        return View::make("admin.ArticleMgt.list",array('articles'=>$articles,'message'=>$message,'filterdQueryString'=>cmsHelper::getArrayToString($filterdQueryStringArray),'filterdQueryStringArray'=>$output));
    }


    public function get_add()
    {
        //Just making a fake article to use the same template as for the editing
        $demoArticle = new Article();
        $demoArticle->status = 1;
        $demoArticle->comments = 1;
        $demoArticle->tagNames = array();

        return View::make("admin.ArticleMgt.add",array("passedArticle"=>$demoArticle,'message'=>"Add new Article"));
    }



    public function post_add()
    {
        if(!cmsHelper::isCurrentUserAllowedToPerform('articles')) return;

        Input::flash();

        $articlecontent = Input::get('ArticleContent');
        $category = Input::get('ArticleCategory');
        $title = Input::get('ArticleTitle');
        $innercat = Input::get('ArticleCategoryInner');
        $saving_id = Input::get('ArticleEditing');
        $articleUrl =   Input::get('ArticleTitleUrl');
        $articleStatus = Input::get('StatusSelect');
        $articletype = Input::get('ArticleType');
        $onlySelectTitle = Input::get('OnlyTitleSelect');
        $comments = Input::get('Comments');
        $author = Input::get('Author');

        $addedTags = !isset($_POST['selectorbox'])?array():$_POST['selectorbox'];
        //Add rules here
        $rules = array(
            'ArticleTitle' => 'required|max:100',
            'ArticleTitleUrl' => 'required',
            'ArticleCategory' => 'required' ,
            'ArticleContent' => 'required'
        );

        //Get all inputs fields
        $input = Input::all();

        //Apply validaiton rules
        $validation = Validator::make($input, $rules);

        //Validate rules
        if (!empty($saving_id) && $validation->fails())
            return Redirect::to('/admin/articles/edit?id='.$saving_id)->with_errors($validation)->with('EditedTags',$addedTags);
        elseif( $validation->fails())
            return Redirect::to('/admin/articles/add')->with_errors($validation)->with('EditedTags',$addedTags);

        if( isset ($innercat) )
           $category = $innercat;

        $temp = !empty($saving_id)?Article::find($saving_id):new Article();
        $temp->content = $articlecontent;
        $temp->category_id = $category;
        $temp->title = $title;
        $temp->url = $articleUrl;
        $temp->status = $articleStatus;
        $temp->onlytitle = $onlySelectTitle;
        $temp->articletype = $articletype;
        $temp->author_id = Auth::user()->type==1?$author+1:Auth::user()->id;
        $temp->comments = $comments;
        $temp->Tags()->delete();

        echo $temp->save();

        foreach($addedTags as $tagName)
        {
            $tagt = Tag::where("tname","=",$tagName)->first();
                $temp->Tags()->attach($tagt->id);
        }

        Input::flush();
        if(!empty($saving_id))
            return Redirect::to('/admin/articles/edit?id='.$saving_id)->with('EditedTags',$addedTags)->with("successmessage","Article Edited successfully");
        else
            return Redirect::to('/admin/articles/edit?id='.$temp->id)->with('EditedTags',$addedTags)->with("successmessage","Article Posted");

    }
}