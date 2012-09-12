@layout('admin.template')
@section('title')
Add/Edit Tags
@endsection

@section('content')

<?php echo Asset::scripts(); ?>
<?php echo Asset::styles(); ?>
<?php
echo View::make('admin.navigation',array('type'=>'Comments','mode'=>'View'));


?>

<div id="admincontent">


    <h2>Editing Comment</h2>

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
                <?php echo Form::open('admin/comments/edit');?> <br>


                <table cellspacing="0">
                    <tbody>

                    <!-- task title -->
                    <tr><td style="width: 900px"><label style="font-weight: bold">Comment Author</label>     <br>
                        <?php echo Form::text('name',Input::old('author',$passedComment->name),array("style"=>"width: 400px;margin-left: 0px;")); ?>
                    </tr>

                    <tr><td style="width: 900px"><label style="font-weight: bold">Author Email</label>  <br>
                        <?php echo Form::text('email',Input::old('email',$passedComment->email),array("style"=>"width: 400px;margin-left: 0px;")); ?>
                    </tr>

                    <tr><td style="width: 900px"><label style="font-weight: bold">Comment Content</label>  <br>
                        <?php echo Form::textarea('content',Input::old("content",$passedComment->content),array("style"=>"width: 800px;margin-left: 0px;"));?>
                    </tr>

                        <?php echo Form::hidden('editingMode',Input::old("editingMode",$passedComment->id));?>

                    <tr><td colspan="4"><?php echo Form::submit("Save",array("id"=>"adminbutton"));?>
                        </td></tr>
                    <?php echo Form::close();?>
                   </tbody>
                    </table>
                </div>
            </div>
        </div>
    <script>
        $(document).ready(function(){
            $('#successcolor').fadeIn(800);
            $('#errorcolor').fadeIn(800); });
    </script>
    @endsection