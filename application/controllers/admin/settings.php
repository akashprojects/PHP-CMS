<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 7/13/12
 * Time: 9:06 AM
 * To change this template use File | Settings | File Templates.
 */
class Admin_Settings_Controller extends Base_Controller
{
    public $restful = true;
    public function get_view()
    {
        return View::make("admin.SettingMgt.edit");
    }

    public function post_view()
    {
        if(!cmsHelper::isCurrentUserAllowedToPerform('settings')) return;
        Input::flash();
        //Add rules here

        $rules = array(
            'articlelimit' => 'required',
            'articlesize' => 'required',
            'commentsize' => 'required' ,
            'convertemotions' => 'required',
            'maintenance' => 'required',
            'textboxrows' => 'required',
            'unregistercomments' => 'required'
        );

        //Get all inputs fields
        $input = Input::all();

        //Apply validaiton rules
        $validation = Validator::make($input, $rules);


        if($validation->fails())
            return Redirect::to("/admin/settings/view")->with_errors($validation);

        $settings = Setting::all();

        foreach($settings as $setting)
        {
            $setting->value = Input::get($setting->keyname);
            $setting->save();
        }


        Input::flush();
        return Redirect::to("/admin/settings/view")->with("successmessage","Settings updated");
    }
}
