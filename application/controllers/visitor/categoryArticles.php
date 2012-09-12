<?php

class Visitor_CategoryArticles_controller extends  Base_Controller
{
    public $restful = true;
    public function get_index($categoryParent,$categoryChild=null)
    {

        //Load details of the passed category
        $parentCategoryDetails = Category::where('curl','=',$categoryParent)->first();
        if($categoryChild==null)
            $childCategoryDetails=null;
        else
            $childCategoryDetails = Category::where('curl','=',$categoryChild)->first();

        //Gets all articles in the default Sub Category
        if(is_null($parentCategoryDetails))
            return Response::error('404');

        if(is_null($childCategoryDetails ))
            $allarticles = Category::find($parentCategoryDetails->id)->Article()->where("status",'=','1')->get();
        else
            $allarticles = Category::find($childCategoryDetails->id)->Article()->where("status",'=','1')->get();


        //Pushes all articles within the Sub category of a parent Category
        if(is_null($childCategoryDetails ))
        {
            $inner_categories = $parentCategoryDetails->InnerCategory()->get();
            foreach($inner_categories as $innercat)
            {
                $allarticlesinner = Category::find($innercat->id)->Article()->get();
                foreach($allarticlesinner as $innercatarticles)
                    array_push($allarticles,$innercatarticles);
            }
        }


        //A  sort on articles  using the POSTed ID
        usort($allarticles,'cmsHelper::sortById');


        $allarticles = cmsHelper::bakeArticleForViewers($allarticles);


        //make and return the view
        return View::make('visitor.categorylist',array('allarticles' => $allarticles,'parentCategoryDetails'=>$parentCategoryDetails,'childCategoryDetails'=>$childCategoryDetails));
    }
}
