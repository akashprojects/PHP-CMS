<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 7/18/12
 * Time: 2:05 PM
 * To change this template use File | Settings | File Templates.
 */
class Admin_Comments_Controller extends Base_Controller
{
    public $restful = true;

    public function post_view()
    {
        $deletedIds = Input::get('delete');
        $search = Input::get('search');
        $i=0;
        if(isset($deletedIds))
        {
            foreach($deletedIds as $delete)
                Comment::find($delete)->delete() && ++$i;

            return Redirect::to('/admin/comments/view')->with('message',$i." comment(s) deleted");
        }
        if(strlen($search)>1)
            return Redirect::to('/admin/comments/view?filterby=search&value='.$search);
        Input::flush();

        return Redirect::to('/admin/comments/view')->with('message',' [no action performed]');

    }
    public function get_view()
    {
        $forArticleId = Input::get('forarticle');
        $message = "";
        $comments = null;
        if(isset($forArticleId))
            $comments  = cmsHelper::getCommentsByArticleId($forArticleId,$message);
        else
            $comments = cmsHelper::getAllComments($message,Input::get('value'));

        return View::make("admin.CommentMgt.list", array("message"=>$message,"comments" => $comments));
    }

    public function get_edit()
    {
        $id = Input::get('id');
        $comment = Comment::find($id);
        return View::make("admin.CommentMgt.edit",array("passedComment"=>$comment));
    }

    public function post_edit()
    {
        if(!cmsHelper::isCurrentUserAllowedToPerform('comments')) return;
        //Flash current values to session
        Input::flash();

        $id = Input::get('editingMode');

        $editComment = Comment::find($id);
        $editComment->name = Input::get('name');
        $editComment->email = Input::get('email');
        $editComment->content = Input::get('content');


        //Add rules here
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'content' => 'required'
        );

        //Get all inputs fields
        $input = Input::all();

        //Apply validaiton rules
        $validation = Validator::make($input, $rules);


        //Validate rules
        if ($validation->fails())
            return Redirect::to($_SERVER['PATH_INFO'].'?id='.$editComment->id)->with_errors($validation);

        //Update the comment
        $editComment->save();


        return Redirect::to($_SERVER['PATH_INFO'].'?id='.$editComment->id)->with('successmessage','Comment successfully updated');
    }
}
