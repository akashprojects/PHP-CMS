<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 7/13/12
 * Time: 5:29 PM
 * To change this template use File | Settings | File Templates.
 */

class User  extends  Eloquent
{

    public static $table = 'users';

    public function Articles()
    {
        return $this->has_many('Article',"author_id");
    }
}