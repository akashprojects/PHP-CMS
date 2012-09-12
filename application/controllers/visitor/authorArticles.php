<?php

class Visitor_AuthorArticles_controller extends Base_Controller
{
    public $restful = true;
    public function get_index($authorname)
    {
        $user = User::where('username','=',$authorname)->first();

        //get the article limit size
        $articles = Article::where('author_id','=',$user->id)->paginate(Setting::find(2)->value);
        $dbquery = $articles;
        $articles = cmsHelper::bakeArticleForViewers($articles->results);

        return View::make('visitor.index',array("articles"=>$articles,'dbquery'=>$dbquery,'message'=>'Showing all articles by '.$user->displayname));

    }
}