@layout('admin.template')
@section('title')
    Listing Users
@endsection

@section('content')
<?php echo Asset::styles();?>

<?php echo  render('admin.navigation',array('type'=>'Users','mode'=>'View')); ?>
<div id="admincontent" >
<h2> Showing all Tags </h2>
<div class="shadowed">
    <div class="inner-boundary">
        <table class="inner-border" cellspacing="0">
            <tbody>
            <tr align="left" style="background: #636363;color:#fff">
                <th width="300px">Username</th>
                <th width="250px">Displayname</th>
                <th width="200px">Articles posted</th>
                <th width="200px">Registered on</th>
            </tr>

                @forelse ($users as $user)
                <tr>
                    <td><h2><a href="edit?id={{ $user->id }}"> {{ $user->username }} </a></h2></td>
                    <td>{{$user->displayname}}</td>
                    <td><b>{{$user->Articles()->count()}}</b></td>
                    <td>{{$user->created_at}}</td>
                </tr>
                @empty
                <div>No users to display</div>
                @endforelse
            </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection