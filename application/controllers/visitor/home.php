<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 6/28/12
 * Time: 9:56 AM
 * To change this template use File | Settings | File Templates.
 */
class Visitor_Home_controller extends Base_Controller
{
    public $restful = true;

    public function get_index()
    {
        $articles = cmsHelper::getAllArticles($message,true);

        //get the article limit size
        $articles = $articles->where('status','=',1)->paginate(Setting::find(2)->value);
        $dbquery = $articles;
        $articles = cmsHelper::bakeArticleForViewers($articles->results);

        return View::make('visitor.index',array("articles"=>$articles,'dbquery'=>$dbquery));
    }
}
