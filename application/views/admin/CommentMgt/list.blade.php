@layout('admin.template')
@section('title')
Listing Comments
@endsection

@section('content')
<?php echo Asset::styles();?>



<?php echo View::make('admin.navigation',array('type'=>'Comments','mode'=>'View'));?>

<div id="admincontent">
    <h2> {{ $message }} </h2>
    <form name="viewdelete" action="/admin/comments/view" method="post">
    <div class="shadowed">
        <div class="inner-boundary">
            <table cellspacing="0" class="inner-border">
                <tr>
                    <td colspan="2"><input id="admintextbox" name="search" type="text"><input type="submit" id="adminbutton" value="Search"></td>
                    <td align="right" colspan="3"><input id="adminbutton" type="submit" value="Delete Selected Articles"></td>
                </tr>
                <tr align="left" style="background: #636363;color:#fff" >
                    <th><input name="delete[]"  type="checkbox"></th>
                    <th style="width: 550px;">Author</th>


                    <th style="width: 180px;">Time</th>
                    <th style="width: 150px;"></th>
                </tr>
                @forelse($comments->get() as $comment)
                    <tr <?php if($comment->approved==0) echo "class='commentunapproved'";?> >
                        <td valign="top" halign="center"><input name="delete[]" value="{{$comment->id}}" type="checkbox"></td>
                        <td>
                           <div>
                             <div style="float:left;margin: 5px;margin-left: 0px;">
                                <img src="/img/gravatar.png"/>
                             </div>
                              <div style="float:left;margin: 5px;margin-bottom: 10px;">
                                   <a href="edit?id={{$comment->id}} "> <b>{{ $comment->name }}</b></a>  <br>
                                   <a style="color:#636363; " href="mailto:{{$comment->email}}"><u>{{$comment->email}}</u></a>
                              </div>
                           </div>
                            <br>
                            <div style="clear:both">
                        {{$comment->content}} </div>    <br>

                        <div style="margin: 5px;"><b>on: </b><a target="_blank" href=" {{$comment->Article->getArticleUrl() }}#comments" style="color: #636363;"><u>{{$comment->Article->title}}</U></a>
                        </div>
                        </td>
                        <td valign="top" halign="center">{{$comment->created_at}}</td>

                        <td  valign="top" align="right" style="padding-right: 10px;"><a class="ajaxApproveComment" href="{{$comment->id}}"> <?php echo $comment->approved==1?'Unapprove':'Approve';?> </a>
                        | <a href="{{$comment->id}}" class="ajaxDeleteComment"> Delete </a>
                        </td>
                    </tr>
                @empty
                    <h2> No comments</h2>
                @endforelse
            </table>
         </div>
     </div>
        </form>
</div>
<?php echo Asset::scripts();?>
    <script>
        // public/js/script.js
        $(document).ready(function() {
            $('.ajaxDeleteComment').click(function(e) {
                var element = $(this).parents("tr:first");
                var baseurl = '/admin/ajaxhandler?type=deletecomment&id='+$(this).attr('href');
                $.get(baseurl);
                var p = element;
                element.stop().css("background-color","red").hide(800);
                e.preventDefault();
            });

            $('.ajaxApproveComment').click(function(e) {
                // prevent the links default action
                // from firing
                // console.log(element.css("background-color"));
                var element = $(this).parents("tr:first");
                var baseurl = '/admin/ajaxhandler?type=comment&id='+$(this).attr('href');

                if(element.attr('class')=="commentunapproved")
                {
                    baseurl+="&approved=1";
                    $(this).text("Unapprove");
                    element.switchClass("commentunapproved", "comment", 800 );
                    //element.animate({   class: "" }, 400);
                }
                else
                {
                    baseurl+="&approved=0";
                    $(this).text("Approved");
                    element.switchClass("comment", "commentunapproved", 800 );
                }

                $.get(baseurl);
               /* $(function(){
                    $("button").mouseover(function(){
                        var $p = $("#P44");
                        $p.stop()
                            .css("background-color","yellow")
                            .hide(1500, function() {
                                $p.css("background-color","red")
                                    .show(1500);
                            });
                    });
                });*/


                e.preventDefault();
                // attempt to GET the new content

            })
        });
    </script>

    @endsection