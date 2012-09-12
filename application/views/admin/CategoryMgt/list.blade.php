@layout('admin.template')
@section('title')
    Listing Categories
@endsection

@section('content')
<?php echo Asset::styles();?>

<?php echo View::make('admin.navigation',array('type'=>'Categories','mode'=>'View'));?>

<div id="admincontent">
    <h2> Showing all Categories @if (Session::has('message'))
                                    {{ Session::get('message') }}
                                @endif
    </h2>
    <form name="viewdelete" action="/admin/categories/view" method="post">
    <div class="shadowed">
        <div class="inner-boundary">
            <table cellspacing="0" class="inner-border">
                <td align="right" colspan="5">
                    <input id="adminbutton" type="submit" value="Delete Selected Comments">
                </td>
                <tr style="background: #636363;color:#fff">
                    <td><input type="checkbox" name="delete[]" value="32"></td>
                    <td width="150px" ><b>Category name</b></td>
                    <td width="150px"><b>Sub categories</b></td>
                    <td width="650px"><b>Category Description</b></td>
                    <td width="50px"><b>Count</b></td>
                </tr>

                    <?php echo Form::open('admin/article'); ?>
                        @forelse ($categories as $category)

                                @if ($category->parent_id==null)
                                         <tr>
                                                <td><input type="checkbox" name="delete[]" value="{{$category->id}}""></td>
                                                <td colspan="2"><a href="edit?id={{$category->id}}"><h2>{{$category->cname}}</h2></a></td>

                                                <td> {{ $category->cdescription }} </td>
                                                <td><a href="http://localhost/admin/articles/view?filterby=category&value={{$category->curl}}"><b>{{ Category::find($category->id)->Article()->count()}} </b></a></td>
                                         </tr>
                                                @foreach ($category->InnerCategory()->get() as $innercat)
                                                   <tr id="alt">
                                                       <td><input type="checkbox" name="delete[]" value="{{$innercat->id}}"></td>
                                                        <td>|-></td>
                                                        <td> <a href="edit?id={{$innercat->id}}"><b>{{$innercat->cname}}</b></a> </td>
                                                       <td>  {{$innercat->cdescription}}</a> </td>
                                                        <td><a href="http://localhost/admin/articles/view?filterby=category&value={{$innercat->curl}}"> <b>{{ Category::find($innercat->id)->Article()->count()}}</b></a> </td>
                                                    </tr>
                                                 @endforeach


                                    </div>

                                 @endif

                        @empty
                            <div>No categories to display</div>
                        @endforelse
                <?php echo Form::close()?>

        </div>

    </div>
</table></form>
</div>

@endsection