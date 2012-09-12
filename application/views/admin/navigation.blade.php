<div id="adminheader" style="clear: both">
    <?php
    $mainmenus=array();
    if(cmsHelper::isCurrentUserAllowedToPerform('articles'))
        $mainmenus[]="Articles~articles/view";

    if(cmsHelper::isCurrentUserAllowedToPerform('comments'))
        $mainmenus[]="Comments~comments/view";

    if(cmsHelper::isCurrentUserAllowedToPerform('categories'))
        $mainmenus[]="Categories~categories/view";

    if(cmsHelper::isCurrentUserAllowedToPerform('tags'))
        $mainmenus[]="Tags~tags/view";

    if(cmsHelper::isCurrentUserAllowedToPerform('settings'))
        $mainmenus[]="Settings~settings/view";

    if(cmsHelper::isCurrentUserAllowedToPerform('users'))
        $mainmenus[]="Users~users/view";
    else
        $mainmenus[]="My Profile~users/edit?id=".Auth::user()->id;

//Article functions
    $submenus=array();
    $submenus['Articles']=array();
    $submenus['Articles'][0]="View~All Articles";
    $submenus['Articles'][1]="Add~Add/Edit";
    $submenus['Articles'][2]="View~View unpublished Articles~type=unpublished";

//Categories functions
    $submenus['Categories']=array();
    $submenus['Categories'][0]="View~All Categories";
    $submenus['Categories'][1]="Add~Add/Edit";

    $submenus['Comments']=array();
    $submenus['Comments'][0]="View~All Comments";



    $submenus['Tags']=array();
    $submenus['Tags'][0]="View~All Tags";
    $submenus['Tags'][1]="Add~Add/Edit";

    $submenus['Settings']=array();
    $submenus['Settings'][0]="View~Adjust Settings";

    $submenus['Users']=array();

    if(cmsHelper::isCurrentUserAllowedToPerform('users'))
    {
        $submenus['Users'][0]="View~All Users";
        $submenus['Users'][1]="Add~Add/Edit User";
    }


    echo "<ul>";

    for($i=0;$i<count($mainmenus);$i++)
    {
        $temp = explode('~',$mainmenus[$i]);

        if($type === $temp[0] || (isset($type_alt) && $type_alt === $temp[0]))
            echo '<li id="adminmenumainSelected"><a href="/admin/'.strtolower($temp[1]).'" >'.$temp[0].'</a></li>';
        else
            echo '<li><a href="/admin/'.strtolower($temp[1]).'" class="adminmenumain">'.$temp[0].'</a></li>';
    }
    echo '</ul>';
    if(strcmp('dashboard',$type)!=0){
    echo '<div style="padding:0px;margin-top:10px;border-top: 1px solid #EFEFEF;color: #ccbc8d;display:block"></div><div style="padding:0px;margin-bottom:5px;border-top: 1px solid #D2D2D2;color: #8b6903;display:block"></div><ul>';
    for($i=0;$i<count($submenus[$type]);$i++)
    {
        $temp = explode('~',$submenus[$type][$i]);
        $url = $temp[0]; //link
        $name =$temp[1]; //Display name
        $queryString = null;

        if(count($temp)>2)
            $queryString = $temp[2];
        if(isset($queryString))$url.='?'.$queryString;
        if($mode === $temp[0] )
        {
            if(isset($_GET['type']))
            {
                if(str_contains( $queryString,$_GET['type']))
                    echo '<li id="adminmenumainSelectedSub"><a href="'.strtolower($url).'" >'.$name.'</a></li>';
                else
                    echo '<li><a href="'.strtolower($url).'" class="adminmenusub">'.$name.'</a></li>';
            }
            else
            {   if(count($temp)<=2)
                    echo  '<li  id="adminmenumainSelectedSub"><a href="'.strtolower($url).'">'.$name.'</a></li>';
                else
                    echo '<li><a href="'.strtolower($url).'" class="adminmenusub">'.$name.'</a></li>';
            }

        }
        else
            echo '<li><a href="'.strtolower($url).'" class="adminmenusub">'.$name.'</a></li>';
    }
    echo '</ul>';}
    ?>
</div>

