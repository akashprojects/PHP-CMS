@layout('admin.template')
@section('title')
    Add/Edit User
@endsection

@section('content')
<?php echo Asset::scripts(); ?>
<?php echo Asset::styles(); ?>
<?php
echo View::make('admin.navigation',array('type'=>'Users','type_alt'=>'My Profile','mode'=>'Add'));         ?>

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
                <?php echo Form::open('admin/users/add');?> <br>
                <table cellspacing="0">
                    <tbody>

                    <!-- task title -->
                    <tr><td style="width: 900px"><label style="font-weight: bold">User Name</label>
                        <p id="message">Enter your username here</p>
                        <?php echo Form::text('userName',Input::old('userName',$passedUser->username),array('style'=>'width: 400px;margin-left: 0px;')); ?>
                    </td></tr>

                    <tr><td style="width: 900px"><label style="font-weight: bold">User Password</label>
                        <p id="message">Enter your password here</p>
                        <?php echo Form::password('userPassword',array('style'=>'width: 400px;margin-left: 0px;')); ?>
                    </td></tr>

                    <tr><td style="width: 900px"><label style="font-weight: bold">Display Name</label>
                        <p id="message">Choose a name for other user's to recognize you</p>
                        <?php echo Form::text('userDisplayName',Input::old('userDisplayName',$passedUser->displayname),array('style'=>'width: 400px;margin-left: 0px;')); ?>
                    </td></tr>

                    <tr><td style="width: 900px"><label style="font-weight: bold">User Type</label>
                        <p id="message">Authority of the user</p>
                        <?php echo  Form::select('type',cmsHelper::getUserTypeArray(),Input::old('type',$passedUser->type-2),Input::old("editingMode",$passedUser->id) == 1 || Auth::user()->id != 1?array("disabled"=>"enabled"):array() );?>
                    </td></tr>
<!-- Form output starts     -->



<?php echo Form::hidden('editingMode',Input::old("editingMode",$passedUser->id));?>
                <tr><td colspan="3"> <?php echo Form::submit(is_null($passedUser->id)?"Add":"Edit",array('id'=>'adminbutton'));?>   </td></tr>

<?php echo Form::close(); ?>
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