<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 6/29/12
 * Time: 8:13 AM
 * To change this template use File | Settings | File Templates.
 */
class InnerCategory extends Eloquent
{
    public static $timestamps = false;
    public static $table = 'categories';

    public function Category()
    {
        return $this->belongs_to("Category", 'ID');
    }
}
