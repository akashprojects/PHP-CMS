<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mind
 * Date: 7/11/12
 * Time: 7:43 PM
 * To change this template use File | Settings | File Templates.
 */
class Tag  extends Eloquent
{
    public static $timestamps = false;
    public static $table = 'tags';

    public function Articles()
    {
        return $this->has_many_and_belongs_to('Article','Articles_Tags');
    }
}
