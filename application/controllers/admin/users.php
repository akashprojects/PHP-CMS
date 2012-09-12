<?php

class Admin_Users_Controller extends Base_Controller
{
    public $restful = true;
    function get_view()
    {
        $users = User::order_by('ID', 'asc')->get();
        return View::make("admin.UserMgt.list", array("users" => $users));
    }

    function get_edit()
    {
        Input::flush();
        $edit_user = User::find($_GET['id']);

        if($edit_user==null || ( Auth::user()->id!=1 && $edit_user->id != Auth::user()->id))
            return "Invalid action";

        //Return view with all the parent tags
        return View::make("admin.UserMgt.add", array("passedUser"=>$edit_user));
    }

    function get_add()
    {
        return View::make("admin.UserMgt.add", array("passedUser"=>new User()));
    }

    function post_add()
    {

        //Flash current values to session
        Input::flash();

        //Same action is used for editing and adding a new category
        $username = Input::get("userName");
        $password = Input::get("userPassword");
        $saving_id = Input::get('editingMode');
        $tempType = Input::get('type');
        $userDisplayName = Input::get('userDisplayName');

        if(!cmsHelper::isCurrentUserAllowedToPerform('users') && $saving_id!=Auth::user()->id) return;
        //Add rules here
        $rules = array(
            'userName' => 'required|max:100',
            'userPassword' => 'required',
            'userDisplayName' => 'required'
        );

        //Get all inputs fields
        $input = Input::all();

        //Apply validaiton rules
        $validation = Validator::make($input, $rules);


        //Validate rules
        if ($validation->fails())
            return Redirect::to('/admin/users/add')->with_errors($validation);

        $present = User::where('username','=',$username)->count();
        if(empty($saving_id) && $present > 0)
            return Redirect::to('/admin/users/add')->with("errormessage","User with the same 'username' already exists");

        $present = User::where('displayname','=',$userDisplayName)->count();
        if(empty($saving_id) && $present > 0)
            return Redirect::to('/admin/users/add')->with("errormessage","User with the same 'displayname' already exists");


        $temp = !empty($saving_id)?User::find($saving_id):new User();;
        $temp->username = $username;
        $temp->password = Hash::make($password);
        $temp->displayname = $userDisplayName;
        if(isset($tempType))
            $temp->type = $tempType + 2;
        $temp->save();

        Input::flush();
        return Redirect::to('/admin/users/add')->with("successmessage",!empty($saving_id)?"User Edited successfuly":"New User Added successfully");


    }
}