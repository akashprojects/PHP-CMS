<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dl717
 * Date: 7/20/12
 * Time: 4:07 PM
 * To change this template use File | Settings | File Templates.
 */

abstract class visitorLogger
{

    static function logVisitor($id,$type)
    {
       // echo $id." : ".$type;
        $today = date("Y-m-d");
        $time = date("H:i:s");
        $entry = VisitorLog::where('date','=',$today)->where('type','=',$type)->where('entityid','=',$id)->first();
        if(is_null($entry))
        {
            $visitor = new VisitorLog();
            $visitor->date = $today;
            $visitor->type = $type;
            $visitor->entityid = $id;
            $visitor->count = 1;
            $visitor->lastaccess = $time;
            $visitor->save();
        //    echo " adding new ";
        }
        else
        {
            $entry->count+=1;
            $entry->lastaccess = $time;
            $entry->save();
         //   echo " updated ";
        }
     /*   $str = explode('/',$_SERVER['PHP_SELF']);
        unset($str[0]);
        unset($str[1]);
        $url = "";

        if(count($str)==0)
             $url = "//";
        else
            foreach($str as $part)
                $url.=$part.'/';
        $url = substr($url,0,strlen($url)-1);
        echo " url now is ".$url;

        echo 'the use ris '.$_SERVER['PHP_SELF'];*/

    }
}