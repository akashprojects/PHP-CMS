@layout('admin.template')
@section('title')
    Add/Edit Tags
@endsection

@section('content')

<?php echo Asset::scripts(); ?>
<?php echo Asset::styles(); ?>
<?php
echo View::make('admin.navigation',array('type'=>'Tags','mode'=>'Add'));


?>

<div id="admincontent">


    <h2>Add/Edit Tag</h2>

    <div class="shadowed">
        <div class="inner-boundary">
            <div class="inner-border" style="padding: 10px;">

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

                <!-- Form output starts     -->
                <?php echo Form::open('admin/tags/add');?> <br>
                <table cellspacing="0">
                    <tbody>

                    <!-- task title -->
                      <tr><td style="width: 900px"><label style="font-weight: bold">Tag Name</label>
                        <p id="message">Metadata that helps describe an item and allows it to be found again by browsing or searching</p>
                        <?php echo Form::text('tagName',Input::old('tagName',$passedTag->tname),array('onkeyup' => 'createUrl(this,1)','style'=>'width: 400px;margin-left: 0px;')); ?>
                      </td></tr>

                <tr><td style="width: 900px"><label style="font-weight: bold">Tag Url</label>
                    <p id="message">Be sure to choose a name that distinguishes the Article from others</p>
                    <?php echo Form::text('tagNameUrl',Input::old('tagNameUrl',$passedTag->turl),array('id' => 'tagNameUrl','onkeyup' => 'createUrl(this,2)','style'=>'width: 400px;margin-left: 0px;'));?>      <br>
                </td></tr>

                <?php echo Form::hidden('editingMode',Input::old("editingMode",$passedTag->id));?>
                <tr><td><?php echo Form::submit(is_null($passedTag->id)?"Add":"Edit",array("id"=>"adminbutton"));?>         </td></tr>


                    </tbody>
                    </table>
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