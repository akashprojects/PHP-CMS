<?php

Asset::add('admin', 'js/adminlocal.js');
Asset::add('jquery', 'js/jquery-1.7.2.js');
Asset::add('jqueryUi', 'js/jqueryui.js');
Asset::add('chosenJs', 'js/chosen.jquery.min.js');
Asset::add('ckeditorJs', 'js/ckeditor/ckeditor.js');
Asset::add('chosenCss', 'css/chosen.css');
Asset::add('AdminCss', 'css/admin.style.css');
Asset::add('chosenImg', 'img/chosen-sprite.png');

Route::controller('visitor.home');
Route::controller('visitor.categoryArticles');
Route::controller('visitor.authorArticles');
Route::controller('admin.articles');
Route::controller('admin.categories');
Route::controller('admin.tags');
Route::controller('admin.settings');
Route::controller('admin.users');
Route::controller('admin.comments');
Route::controller('login');


Route::filter('filter', function()
{
   if (Auth::guest()) return Redirect::to('login');
});
Route::filter('pattern: admin','filter');


//Route to article content page
//category/title/id
Route::any('(:any)/(:any)/(:num)','visitor.Articlecontent@index');

//Route to article content page
//category/subcategory/title/id
Route::any('(:any)/(:any)/(:any)/(:num)','visitor.Articlecontent@index');

//Show all posts of the mentioned category
Route::any('(:any)','visitor.categoryArticles@index');

//Show all posts of the mentioned Category/Sub Category
Route::any('(:any)/(:any)','visitor.categoryArticles@index');

Route::any('admin',function(){
        return View::make('admin.dashboard');
});


Route::get('admin/stats',function(){
        return View::make('admin.stats');

});
Route::get('tags/(:any)', function($tagurl) {
        return View::make('visitor.taglist')->with('tagurl',$tagurl);
    }
);


Route::get('/', 'visitor.home@index');

Route::get('author/(:any)', 'visitor.authorArticles@index');

Route::get('admin/ajaxhandler',function(){
        return View::make('admin.ajaxhandler');

});
Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('login')->with('message','You have been logged out');
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});


Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});


Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});