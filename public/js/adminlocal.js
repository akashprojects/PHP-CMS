/**
 * Created with JetBrains PhpStorm.
 * User: mind
 * Date: 7/8/12
 * Time: 11:56 PM
 * To change this template use File | Settings | File Templates.
 */
var urlParentCategory="";
var urlChildCategory="";

 function findCategoryELementById(id)
 {
     if(id == null)   return;
     container = document.getElementById("Categories").getElementsByTagName("input");
     for(var i=0;i<container.length;i++)
         if(container[i].value == id && (container[i].checked = true)) return adjustCategoryUrl(container[i]);
 }
function adjustCategoryUrl(obj)
{
    document.forms[0]["ArticleCategoryAutoSelect"].value = obj.value;
    var parent = obj.parentNode.parentNode;

    if(obj.name=="ArticleCategory" )
    {
        //lets uncheck all inner categories
        var inners = document.forms[0]["ArticleCategoryInner"];
        for(var i=0;i<inners.length;i++)   inners[i].checked=false ;
        urlParentCategory = "/"+parent.title;
        urlChildCategory = "";
    }
    else
    {
        var continer = parent.parentNode.parentNode;
        continer.getElementsByTagName("input")[0].checked = true;
        urlParentCategory = "/"+parent.parentNode.parentNode.title;
        urlChildCategory =  "/"+parent.title;
    }
    reGenerateUrl();
}

function adjustChilds(obj)
{
    var parent = obj.parentNode.parentNode;
    parent.parentNode.getElementsByTagName("input")[0].checked= true;

    urlParentCategory="/"+(parent.parentNode.getElementsByTagName("label")[0].innerHTML.split(">")[1]);
    urlChildCategory="/"+(obj.parentNode.innerHTML.split(">")[1]);
    reGenerateUrl();
}

function adjustParent(obj)
{
    var inners = document.forms[0]["innercategory"];
    for(var i=0;i<inners.length;i++)
        document.forms[0]["innercategory"][i].checked=false ;
    urlChildCategory="";
    urlParentCategory="/"+(obj.parentNode.innerHTML.split(">")[1]);
    reGenerateUrl();
}

function  reGenerateUrl()
{
    var up = document.getElementById("ArticleUrl");

    var articleTitle = document.getElementById("ArticleTitleUrl");
    $("#ArticleUrl").text(("http://localhost"+urlParentCategory+''+urlChildCategory+'/').trim());

    var one = $("#ArticleUrl").width();

    var remaining_width = parseInt(870 - one);


    $('#ArticleTitleUrl').width(remaining_width);
}

function createUrl(obj,type,ignore) {
    var tempValue = obj.value;
    var Texter;

    //skipping spaces after text
    if( obj.value[obj.value.length-1]==" ") return;

    if(type==2)
    {
        Texter = tempValue.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
        obj.value = Texter;
    }
    else
        Texter = tempValue.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');

    if(ignore!=1)
        document.getElementById(obj.name+"Url").value = Texter;
    else
        return Texter;

}