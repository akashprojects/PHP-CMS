@layout('admin.template')
@section('title')
    Add/Edit category
@endsection

@section('content')

<!-- Include javascript files   -->
<?php echo Asset::scripts(); ?>
<?php echo Asset::styles(); ?>
<?php echo View::make('admin.navigation',array('type'=>'Categories','mode'=>'Add'));  ?>






<div id="admincontent">
<h2> Add/Edit Category </h2>
<!-- Form output starts     -->
<div class="shadowed">
<div class="inner-boundary">
    <div style="padding: 5px;">
        <div id="errorcolor">
            @foreach ($errors->all('<div id="notificationtext">:message</div>') as $errors)
            {{  $errors }}
            @endforeach
            @if (Session::has('errormessage'))
               <div id="notificationtext"> {{ Session::get('errormessage') }}  </div>
            @endif
        </div>
        <div id="successcolor">

            @if (Session::has('successmessage'))
                 <div id="notificationtext">  {{ Session::get('successmessage') }}  </div>
            @endif
        </div>
        <?php echo Form::open('admin/categories/add?type=edit')?>
    <table class="inner-border" cellspacing="0">

        <tbody>


                <!-- task title -->
                <tr><td style="width: 900px"><label style="font-weight: bold">Category name</label><p id="message">Be sure to choose a decent name that reflects the content of the category</p>
                <?php echo Form::text('categoryName', Input::old("categoryName",$name), array('onkeyup' => 'createUrl(this,1)','style'=>'width: 400px;margin-left: 0px;')); ?></td></tr>

                <tr><td><label style="font-weight: bold">Category url</label> <p id="message">This url shall identify the address of your category</p>
                <?php echo Form::text('categoryNameUrl', Input::old("categoryNameUrl",$url), array('id' => 'categoryNameUrl','onkeyup' => 'createUrl(this,2)','style'=>'width: 400px;margin-left: 0px;')); ?> </td></tr>

                <tr><td><label style="font-weight: bold">Parent Category (optional)</label> <p id="message">If you want this to act as a child, select its parent</p>
                <?php echo Form::select('parentId', $arraycategory, Input::old("parentId",$parentid),array("style"=>"padding: 5px;margin-top: 5px;")); ?>   </td></tr>


                <tr><td><label style="font-weight: bold">Category Description</label></td></tr>
                <tr><td> <?php echo Form::textarea('description', Input::old("description",$description), array("rows" => 3,"style"=>"width: 650px")); ?> </td></tr>


                <?php echo Form::hidden('editingMode',Input::old("editingMode",$editingmode));?>
                <!-- submit button -->
                <tr><td>  <?php echo Form::submit(is_null($editingmode)?'Create Category':'Update Category',array("id"=>"adminbutton"));?></td>  </tr>


        </tbody>
        </table>
    </div>
    </div>
    <?php echo Form::close(); ?>
</div>
    </div>
  </div>

      <script>
          $(document).ready(function(){
              $('#successcolor').fadeIn(800);
              $('#errorcolor').fadeIn(800); });
      </script>
@endsection