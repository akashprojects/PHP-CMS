<script src="/js/jquery-1.7.2.js"></script>
<?php

$outer = array();
$inner = array();
$currentlyselectedparent = is_null($outercategory)?'home':$outercategory->id;
foreach(Category::where_null('parent_id')->get() as $parentcategory)
{
    $outer[] = $parentcategory;
    $inner[$parentcategory->id]=array();
    foreach(Category::where('parent_id','=',$parentcategory->id)->get() as $childcategory)
        $inner[$parentcategory->id][] = $childcategory;
}
?>
<div id="header" xmlns="http://www.w3.org/1999/html">
     <div id="logo" style="float:left;width: 300px;height: 80px;"><a href="/"><img style="margin-left: -20px;"src="/img/logo.png"></a></div>
     <div id="banner" style="float:left;width: 650px;margin: 10px 0px; display:block;background: #d1d1d1;height: 70px;"><div style="width: 50%;  margin: 0 auto; margin-top:22px;" align="center" >Add banner can be placed here</div></div>
 </div>
<div id="menuitembox" style="clear:both">

    <ul class="menuitems">
        <li id="home" ><a class='{{is_null($outercategory)?"currentlyselectedparent":"currentlyunselectedparent"}}'  href="/">Home</a></li>
    @foreach($outer as $outeritem)
        <li  id="{{$outeritem->id}}">
             @if( !is_null($outercategory) && $outeritem->cname == $outercategory->cname )
                <a  class="currentlyselectedparent" href="/{{$outeritem->curl}}"> {{ $outeritem->cname }} </a>
             @else
                <a  class="currentlyunselectedparent" href="/{{$outeritem->curl}}"> {{ $outeritem->cname }} </a>
             @endif
        </li>
        <li id="child_home" style="display: none">
            <ul ><li> Lisiting all articles</li></ul>
        </li>
        <li id="child_{{$outeritem->id}}" style="display: none">
             <ul style="clear:both">
                    @foreach($inner[$outeritem->id] as $inneritem)
                        <li>
                            @if( !is_null($innercategory) && $inneritem->id == $innercategory->id )
                                <a class="currentlyselectedchild" href="/{{$outercategory->curl}}/{{$inneritem->curl}}"> {{ $inneritem->cname }} </a>
                            @else
                                <a href="/{{$outeritem->curl}}/{{$inneritem->curl}}"> {{ $inneritem->cname }} </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
        </li>
    @endforeach
    </ul>
    <div style="" class="submenucontainer">  </div>
</div>



    <script>
        var prev=null;
        $(document).ready(function () {
            $('.menuitems > li').bind('mouseover', openSubMenu);
            $('#menuitembox').bind('mouseleave', closeSubMenu);
            function openSubMenu() {

                var container = $("#child_"+($(this).attr("id")));

                if(prev!=null)
                    $("#{{$currentlyselectedparent}}").children(".currentlyselectedparent").attr('class','currentlyselectedparentlowvisible');
                if(prev!=null)
                    prev.attr('class','currentlyunselectedparent');
                if( ($(this).attr('id'))=="{{$currentlyselectedparent}}")
                    $("#{{$currentlyselectedparent}}").children(".currentlyselectedparentlowvisible").attr('class','currentlyselectedparent');


                prev=$(this).children(".currentlyunselectedparent");

                var e = $(this).children(".currentlyunselectedparent").attr('class','currentlyselectedparent');

                $(".submenucontainer").html(container.html());

            };

            function closeSubMenu() {


             $("#{{$currentlyselectedparent}}").mouseover();
                $("#{{$currentlyselectedparent}}").children(".currentlyselectedparentlowvisible").attr('class','currentlyselectedparent');

            }

            $("#{{$currentlyselectedparent}}").mouseover();
        });
    </script>