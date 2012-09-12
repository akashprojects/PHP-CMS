<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 7/18/12
 * Time: 9:55 AM
 * To change this template use File | Settings | File Templates.
 */
class Comment extends Eloquent
{
    public static $timestamps = true;
    public static $table = 'comments';

    public function Article()
    {
        return $this->belongs_to("Article",'article_id');
    }



}
