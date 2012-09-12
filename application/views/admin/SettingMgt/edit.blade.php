@layout('admin.template')
@section('title')
    Edit Settings
@endsection
@section('content')
<?php echo Asset::styles();?>
<?php echo Asset::scripts();?>
<?php
echo View::make('admin.navigation',array('type'=>'Settings','mode'=>'View'));

?>

<div id="admincontent">
    <h2>Settings</h2>
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

            <table cellspacing="0">
                <?php $oldType = '' ?>
                <?php echo Form::open('admin/settings/view'); ?>

                @foreach(Setting::order_by('type')->get() as $setting)

                    @if( $oldType!== $setting->type )
                        <tr><td  colspan="2"><h2> {{ ucfirst($setting->type) }} </h2></tr>
                    @endif
                    <tr>
                        <td>{{ $setting->content }}</td>

                    @if($setting->fieldtype === "select")
                        <td>{{ Form::select($setting->keyname,array("Disabled","Enabled"),Input::old($setting->keyname,$setting->value)) }} </td>
                    @elseif($setting->fieldtype === "text")
                        <td>{{  Form::text($setting->keyname,Input::old($setting->keyname,$setting->value),array('style'=>'margin: 0px')) }} </td>
                    @elseif($setting->fieldtype === "textarea")
                        <td>{{  Form::textarea($setting->keyname,Input::old($setting->keyname,$setting->value),array('style'=>'margin: 0px','rows'=>4)) }}
                        <br>
                            {{$setting->contentdetail }}
                        </td>
                    @endif
                    </tr>

                <?php $oldType = $setting->type; ?>
          @endforeach

            <tr><td><?php echo Form::submit('Save',array('id'=>'adminbutton')); ?> </td></tr>
<?php echo Form::close();?>
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