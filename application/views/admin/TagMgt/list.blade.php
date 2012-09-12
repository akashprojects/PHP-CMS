@layout('admin.template')
@section('title')
    Listing Tags
@endsection

@section('content')
<?php echo Asset::styles();?>
<?php echo  render('admin.navigation',array('type'=>'Tags','mode'=>'View')); ?>

<div id="admincontent" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <h2> Showing all Tags </h2>
    <div class="shadowed">
        <div class="inner-boundary">
            <table cellspacing="0" class="inner-border">
                <tr>
                    <td align="right" colspan="5">
                        <input id="adminbutton" type="submit" value="Delete Selected Tags">
                    </td>
                </tr>
                <tr align="left" style="background: #636363;color:#fff">
                    <th ><input type="checkbox" name="delete[]" value="32"></th>
                    <th width="750px" ><b><a href="{{$filterdQueryString}}sortby=tname">Tag name</a></b></th>
                    <th width="150px"><b>Tag Article Count</a></b></th>

                </tr>
                <?php $counter = 0;?>
                <?php $tags = $tags->paginate(15);?>
                @forelse($tags->results as $tag)
                    <tr <?php if($counter%2==0) echo 'id="alt"'?>>
                        <td><input type="checkbox" name="delete[]" value="32"></td>
                        <td><a href="edit?id={{ $tag->id }}"> <b>{{ ucfirst($tag->tname) }}</b> </a>  </td>
                        <td><a href='http://localhost/admin/articles/view?filterby=tag&value={{$tag->turl}}'>{{ $tag->Articles()->count() }} </td>
                        <?php $counter++;?>
                    </tr>
                @empty
                    <div>No tags to display</div>
                @endforelse
                <tr>  <td align="right" colspan="10">
                    <?php echo $tags->appends($filterdQueryStringArray)->links(); ?>
                </td>
                </tr>
            </table>
         </div>
    </div>
@endsection