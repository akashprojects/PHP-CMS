<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 6/28/12
 * Time: 9:07 AM
 * To change this template use File | Settings | File Templates.
 */
class Category extends Eloquent
{
    public static $timestamps = false;
    public static $table = 'categories';

    public function Article()
    {
        return $this->has_many('Article',"category_id");
    }
    public function InnerCategory()
    {
        return $this->has_many('InnerCategory',"parent_id");
    }

    public function getCategoryFullName()
    {
        if($this->parent_id!=null){
            $parent_cat_details = Category::find($this->parent_id);
            return $parent_cat_details->cname.' > '.$this->cname;
        }
        else
            return  $this->cname;
    }

    public function getCategoryUrl()
    {
        if($this->parent_id!=null){

            $parent_cat_details = Category::find($this->parent_id);

            return '/'.$parent_cat_details->curl.'/'.$this->curl;
        }
        else
            return '/'.$this->curl;
    }
}
