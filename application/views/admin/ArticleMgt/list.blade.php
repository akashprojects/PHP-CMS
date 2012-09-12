@layout('admin.template')
@section('title')
Listing Articles
@endsection



@section('content')

<?php echo Asset::styles();?>

<?php echo  render('admin.navigation',array('type'=>'Articles','mode'=>'View')); ?>
<div id="admincontent">
    <h2>
        <?php echo $message; ?>
        @if (Session::has('message'))
        {{ Session::get('message') }}
        @endif
    </h2>
    <?php $articles = $articles->paginate(15); ?>
    <form name="viewdelete" action="/admin/articles/view" method="post">
        <div class="shadowed">
            <div class="inner-boundary">
                <table  cellspacing="0" class="inner-border">
                    <tr>
                        <td colspan="4"><input id="admintextbox" name="search" type="text"><input type="submit" id="adminbutton" value="Search"></td>
                        <td align="right" colspan="5"><input id="adminbutton" type="submit" value="Delete Selected Articles"></td>
                    </tr>
                    <tr ALIGN=LEFT style="background: #636363;color:#fff">
                        <th width="20px"><input onclick="selectDeletingItems(this)" type="checkbox" style="padding: 0px;margin: 0px 6px;"/></th>
                        <th width="450px"><b><a href="{{$filterdQueryString}}sortby=title">Title</a></b></th>
                        <th width="250px"><b>Tags</b></th>
                        <th width="80px"><b>Category</b></th>
                        <th width="80px"><b><a href="{{$filterdQueryString}}sortby=author_id">Author</a></b></th>
                        <th width="80px"><b><a href="{{$filterdQueryString}}sortby=status">Status</a></b></th>
                        <th title="Comments"><b>Com.</b></th>
                    </tr>
                    <?php $i=0; ?>

                    @forelse($articles->results as $article)
                    <tr <?php if($i%2==0) echo 'id="alt"'; $i++?> >
                        <td><input value="{{$article->id}}" name="delete[]" type="checkbox"></td>
                        <td> <h3><a href="edit?id={{ $article->id }}">{{ $article->title}} </a></h3> </td>
                        <td>
                            @foreach($article->Tags as $tag)
                            <a href="view?filterby=tag&value={{ $tag->turl }}">{{ $tag->tname }} | </a>
                            @endforeach
                            &nbsp;
                        </td>
                        <td><a href="view?filterby=category&value={{ $article->Category->curl }}">{{ $article->Category->cname }}</a></td>
                        <td><a href="view?filterby=author&value={{ $article->author_id }}">{{ ucfirst($article->User->displayname) }}</a></td>
                        <td><a href="view?filterby=status&value={{ $article->status }}">{{ cmsHelper::getArticleStatusArray($article->status) }}</a></td>
                        <td><a href="/admin/comments/view?forarticle={{$article->id}}"><b>{{$article->Comments()->count()}}</b></a></td>
                    </tr>
                    @empty
                    <div>No Articles to display</div>
                    @endforelse
                    <tr>  <td align="right" colspan="10">
                        <?php echo $articles->appends($filterdQueryStringArray)->links(); ?>
                    </td>
                    </tr>


                </table>
            </div>


        </div>
    </form>
    <script>
        function selectDeletingItems(obj)
        {
            var ele = document.getElementsByName("delete[]");

            for(var i=0;i<ele.length;i++)
                if(obj.checked)
                    ele[i].checked = true;
                else
                    ele[i].checked = false;
        }
    </script>
    @endsection
