<?php

class Visitor_Articlecontent_controller extends  Base_Controller
{
    public $restful = true;

    public function get_index($category,$title,$id,$idparent=null)
    {
        $id = !is_null($idparent)?$idparent:$id;

        $article = Article::find($id);

       // || strcmp($title,$article->title)!=0
        if(is_null($article))
            return Redirect::error(404);

        $article->categoryName = $article->Category()->first()->getCategoryFullName();
        $article->categoryUrl = $article->Category()->first()->getCategoryUrl();

        return View::make('visitor.article_content',array('article'=>$article));
    }
    public function post_index($category,$title,$id,$idparent=null)
    {
        $id = !is_null($idparent)?$idparent:$id;
        Input::flash();
        //check if unregistered users' are allowed to post
        if(Setting::find(5)->value!=1 && Auth::guest())
        {
            echo " Only Registered user's can post comments";
            die();
        }
        if(Setting::find(6)->value<strlen(Input::get('content')))
        {
            echo " Comment size cannot be greater than ".Setting::find(6)->value.' characters ';
            die();
        }


        //Add rules here
        $rules = array(
            'name' => 'required|max:100',
            'email' => 'required|email',
            'content' => 'required'
        );

        //Get all inputs fields
        $input = Input::all();

        //Apply validaiton rules
        $validation = Validator::make($input, $rules);

        if($validation->fails())
            return Redirect::to($_SERVER['PATH_INFO'].'#commentheading')->with_errors($validation);

        $newComment = new Comment();
        $newComment->name = Input::get('name');
        $newComment->email = Input::get('email');
        $newComment->content = Input::get('content');
        $newComment->article_id = $id;
        $newComment->approved = 1;


        $blacklists=  explode(',',Setting::find(8)->value);
        foreach($blacklists as $blword)

        if( false !==  strpos($newComment->content,$blword) )
        {
            $newComment->approved=0;
            break;
        }

        $newComment->save();

        Input::flush();
        return Redirect::to($_SERVER['PATH_INFO'].'#comment-'.$newComment->id);
    }
}