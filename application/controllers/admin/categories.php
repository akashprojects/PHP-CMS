<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mind
 * Date: 7/4/12
 * Time: 10:36 AM
 * To change this template use File | Settings | File Templates.
 */
class Admin_Categories_Controller extends Base_Controller
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
                Category::where('id','=',$delete)->first()->delete() && ++$i;

            return Redirect::to('/admin/categories/view')->with('message',$i." categories(s) deleted");
        }
        if(strlen($search)>1)
            return Redirect::to('/admin/categories/view?filterby=search&value='.$search);
        Input::flush();

        return Redirect::to('/admin/categories/view')->with('message',' [no action performed]');

    }

    public function get_view()
    {
        $categories = Category::all();
        return View::make("admin.CategoryMgt.list", array("categories" => $categories));
    }


    public function get_edit()
    {
        Input::flush();
        //All the user to select a parent category
        $allcategories = Category::all();
        $arraycategory = array();
        $arraycategory[0] = "none";
        foreach ($allcategories as $tempcat) {
            if (($tempcat->parent_id) == null)
                $arraycategory[$tempcat->id] = $tempcat->cname;
        }

        $edit_category = Category::find($_GET['id']);
        $currentCategoryDetails = array('editingmode' => $_GET['id'], 'arraycategory' => $arraycategory, "name" => $edit_category->cname, "url" => $edit_category->curl, "parentid" => $edit_category->parent_id, "description" => $edit_category->cdescription);

        //Return view with all the parent categories
        return View::make("admin.CategoryMgt.add", $currentCategoryDetails);

    }

    public function get_add()
    {

        //All the user to select a parent category
        $allcategories = Category::all();
        $arraycategory = array();
        $arraycategory[0] = "none";
        foreach ($allcategories as $tempcat) {
            if (($tempcat->parent_id) == null)
                $arraycategory[$tempcat->id] = $tempcat->cname;
        }
        $currentCategoryDetails = array('editingmode' => null, 'arraycategory' => $arraycategory, "name" => '', "url" => '', "parentid" => '', "description" => '');

        //Return view with all the parent categories
        return View::make("admin.CategoryMgt.add", $currentCategoryDetails);

    }

    public function post_add()
    {
        if(!cmsHelper::isCurrentUserAllowedToPerform('categories')) return;
        //Flash current values to session
        Input::flash();

        global $category_title;

        //Same action is used for editing and adding a new category
        $category_title = Input::get("categoryName");
        $category_url = Input::get("categoryNameUrl");
        $parnet_id = Input::get("parentId");
        $category_desc = Input::get("description");
        $saving_id = Input::get('editingMode');

        $counter = 0;

        if($parnet_id==0)
           $counter = Category::where('id','!=',$saving_id)->where('curl','=',$category_url)->count();
       else
            $counter = Category::where('id','!=',$saving_id)->where('parent_id','=',$parnet_id)->where('curl','=',$category_url)->count();




        //Add rules here
        $rules = array(
            'categoryName' => 'required|max:100',
            'categoryNameUrl' => 'required'
        );

        //Get all inputs fields
        $input = Input::all();

        //Apply validaiton rules
        $validation = Validator::make($input, $rules);

        //Validate rules
        if ($counter>0 || $validation->fails())
        {
            if($counter == 0)
                return Redirect::to('/admin/categories/add')->with_errors($validation);
            else
                return Redirect::to('/admin/categories/add')->with('errormessage','Category with the same name already exists (having the same settings)');
        }


       /* //Check if a category with the same name exists (skip current editing category)
        if (Category::where("cname", '=', $category_title)->where("parent_id", '=', $parnet_id)->where("id", '!=', $saving_id)->count() > 0) {
            echo "Category already present";
            die();
        }*/

        //Check if edit/new post action is performed
        $saveCategory =  !empty($saving_id)?Category::find($saving_id):new Category();

        $saveCategory->cname = $category_title;
        $saveCategory->curl = $category_url;
        $saveCategory->cdescription = $category_desc;

        $saveCategory->parent_id = ($parnet_id != 0)?$parnet_id:null;

        $saveCategory->save();

        Input::flush();

        //Print appropriate message
        if (!empty($saving_id))
            return Redirect::to('/admin/categories/edit?id='.$saving_id)->with('successmessage','Category Edited Successfully');
        else
            return Redirect::to('/admin/categories/add')->with('successmessage','New Category Added Successfully');


    }


}
