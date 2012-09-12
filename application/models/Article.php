<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 6/28/12
 * Time: 9:35 AM
 * To change this template use File | Settings | File Templates.
 */
class Article  extends  Eloquent
{
    public static $timestamps = true;
    public static $table = 'articles';

    public function User()
    {
        return $this->belongs_to("User",'author_id');
    }
    public function Category()
    {
        return $this->belongs_to("Category",'category_id');
    }

    public function Comments()
    {
        return $this->has_many('Comment',"article_id");
    }

    public function Tags()
    {
        return $this->has_many_and_belongs_to('Tag','Articles_Tags');
    }

    public function getAdjustedArticleContent()
    {

        $trim = Setting::find(1)->value;
         if($trim != 0 && strlen($this->content) > $trim )
             $text = (substr($this->content,0,$trim)).'...';
        else
            $text = ($this->content);

        $tidy = new tidy();
        $tidy->parseString($text,array('show-body-only'=>true),'utf8');
        $tidy->cleanRepair();
        return $tidy.'<a href="'.$this->getArticleUrl().'">[ Continue reading ]</a>';

    }

    public function postedDate()
    {
        $datetime = strtotime($this->created_at);
        $mysqldate = date("F j, Y", $datetime);
        return $mysqldate;
    }

    public function getTagItems()
    {
        if(is_null($this->id)) return array();
        $tagArray =  array();
        foreach($this->Tags()->get() as $tag)
            $tagArray[] = $tag->tname;
        return $tagArray;
    }

    public function getChildCategory()
    {
        if(is_null($this->id)) return null;
        $category = Category::find($this->category_id);

        $this->parentCategory = $category;
        if( !is_null($category->parent_id))
            return $category;
        else
            return null;
    }

    public function getParentCategory()
    {
        if(is_null($this->id)) return null;
        $category = Category::find($this->category_id);

        if( !is_null($category->parent_id))
            return Category::find($category->parent_id);
        else
            return $category;
    }
    public function getArticleUrl()
    {
        if(is_null($this->id)) return null;
        $category = Category::find($this->category_id);
        $url = "";
        $categoryUrl = null;

        //Its a article within a parent category

        if( is_null($category->parent_id))
            $categoryUrl = $category->curl;
        else
        {
            $parentCategory = Category::find($category->parent_id);
            $categoryUrl = $parentCategory->curl.'/'.$category->curl;
        }

        $url=$url.'/'.$categoryUrl.'/'.(is_null($this->url)?str_replace(' ','-',$this->title):$this->url).'/'.$this->id;
        return $url;
    }
}
