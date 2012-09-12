<?php

class Login_Controller extends Base_Controller {

    public $restful = true;

    function get_index()
    {
        if (Auth::guest())
            return View::make('login');
        return Redirect::to('admin');
    }

    function post_index()
    {
        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if ( Auth::attempt($userdata) )
        {
            // we are now logged in, go to home
            return Redirect::to('admin');
        }
        else
        {
            // auth failure! lets go back to the login
            return Redirect::to('login')->with('login_errors', true);
        }
    }
}
?>