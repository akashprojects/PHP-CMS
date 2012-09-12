<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mind
 * Date: 7/11/12
 * Time: 7:44 PM
 * To change this template use File | Settings | File Templates.
 */
class Admin_Tags_Controller extends Base_Controller
{
    public $restful = true;

    public function get_view()
    {
        $orderby = 'id';
        if(isset($_GET['sortby']))
            $orderby = $_GET['sortby'];

        $filterdQueryStringArray = array();
        $output = null;
        parse_str( $_SERVER['QUERY_STRING'], $filterdQueryStringArray);
        unset($filterdQueryStringArray['page']);
        $output = $filterdQueryStringArray;
        unset($filterdQueryStringArray['sortby']);

        $tags = Tag::order_by($orderby, 'desc');
        return View::make("admin.TagMgt.list", array("tags" => $tags,'filterdQueryString'=>cmsHelper::getArrayToString($filterdQueryStringArray),'filterdQueryStringArray'=>$output));
    }

    function get_edit()
    {
        Input::flush();
        $edit_tag = Tag::find($_GET['id']);

        //Return view with all the parent tags
        return View::make("admin.TagMgt.add", array("passedTag"=>$edit_tag));

    }

    function get_add()
    {
        //Adding a fake new Tag to avoid errors
        $edit_tag = new  Tag();
        return View::make("admin.TagMgt.add", array("passedTag"=>$edit_tag));
    }

    function post_add()
    {
        if(!cmsHelper::isCurrentUserAllowedToPerform('tags')) return;
        //Flash current values to session
        Input::flash();

        //Same action is used for editing and adding a new category
        $tag_title = Input::get("tagName");
        $tag_url = Input::get("tagNameUrl");
        $saving_id = Input::get('editingMode');

        //Add rules here
        $rules = array(
            'tagName' => 'required|max:100',
            'tagNameUrl' => 'required'
        );

        //Get all inputs fields
        $input = Input::all();

        //Apply validaiton rules
        $validation = Validator::make($input, $rules);

        $checkIfTagExists = Tag::where('id','!=',$saving_id)->where('turl','=',$tag_url)->count();

        //Check if same tag exists
        if($checkIfTagExists>0)
            return Redirect::to('/admin/tags/add')->with("errormessage","Tag with the same url already exists");

        //Validate rules
        if ($validation->fails())
            return Redirect::to('/admin/tags/add')->with_errors($validation);

        $temp = !empty($saving_id)?Tag::find($saving_id):new Tag();;
        $temp->turl = $tag_url;
        $temp->tname = $tag_title;
        $temp->save();

        Input::flush();
        if(!empty($saving_id))
            return Redirect::to('/admin/tags/edit?id='.$saving_id)->with('successmessage',"Tag Edited successfully");
        else
            return Redirect::to('/admin/tags/add')->with("successmessage","New Tag Added successfully");
    }
}
