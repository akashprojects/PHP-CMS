@layout('visitor.front')

@section('headerfiles')
<link href="/css/visitor.style.css" media="all" type="text/css" rel="stylesheet"
      xmlns="http://www.w3.org/1999/html">
@endsection
@section('title')
    {{$article->title}}
@endsection



@section('content')
<div id="wrapper">
<?php echo render('visitor.navigation', array('outercategory'=>$article->getParentCategory(),'innercategory'=>$article->getChildCategory()));   ?>
<?php VisitorLogger::logVisitor($article->id,'A'); ?>
<div id="leftcontent" style="float: left; width: 680px;">
<h1> {{ $article->title }} </h1>
    <div class="articleinfo">
        <div style="float:left;margin-top: 5px;">
            <a class="author-link" href="/author/{{ User::find($article->author_id)->username }}">{{ User::find($article->author_id)->displayname }}</a>
            <a class="published-time" href="{{ $article->getArticleUrl() }}">{{$article->postedDate()}}</a>
        </div>
        <div style="float:right;margin-bottom:5px ">
            <div class="cat-list">
                <a title="View all posts in {{ $article->categoryName}}" href="{{$article->Category->getCategoryUrl()}}">{{ $article->categoryName }}</a>
            </div>
            <a class="comments-link">{{ $article->Comments()->count() }}</a>
        </div>
        @if($article->articletype==1)
            <div style="clear:both" id="imparticle">
               This article has been flagged as important
            </div>
        @endif
        <div style="clear:both"/>
<p>{{ $article->content }}</p>

    @if($article->Tags()->count()>0)
        <b>Tags: </b>
        @foreach($article->Tags()->get() as $tag)
            <div id="tag"><a href="/tags/{{$tag->turl}}">{{$tag->tname}}</a></div>
        @endforeach
    @endif
@if($article->comments == 1)
    <div id="commentcontainer">
        <h2 id="commentheading">Comments</h2>
        <table cellpadding="0" cellspacing="0">
            <?php $i=0?>
            @forelse($article->Comments as $comment)
                @if($comment->approved==1)
                    <tr id="comment-{{$comment->id}}" <?php if($i%2==0) echo 'style="background:#f4f4f4"';$i++;?>>
                         <td style="padding: 5px;"><img src="/img/gravatar.png"/></td>
                         <td style="padding: 5px;border-bottom: 1px solid #e8e8e8;width: 150px"><b>{{ ucfirst($comment->name) }}</b></td>
                         <td style="padding: 5px;border-bottom: 1px solid #e8e8e8;width: 100%">{{ $comment->content }}</td>
                @endif
            @empty
                No comments for this article<br>
            @endforelse
                </tr>
        </table>
        <h2>Post a new comment</h2>
        <div id="errorcolor">
                @foreach ($errors->all('<div id="notificationtext">:message</div>') as $errors)
                    {{  $errors }}
                @endforeach

        </div>
        <?php echo Form::open($_SERVER['PATH_INFO']); ?>
        <table cellpadding="0" cellspacing="0">
            <tr><td style="padding: 8px;">Name</td> <td><?php echo Form::text('name',Input::old('name',!Auth::guest()?Auth::user()->displayname:"")); ?> </td></tr>
            <tr><td style="padding: 8px;">Email</td>  <td><?php echo Form::text('email',Input::old('email',!Auth::guest()?Auth::user()->email:""));  ?></td></tr>
            <tr><td style="padding: 8px;" valign="top">Content</td> <td> <?php echo Form::textarea('content',Input::old('content')); ?></td></tr>
            <tr><td style="padding: 8px;" colspan="2" align ="right"><?php echo Form::submit('submit',array('id'=>'visitorbutton'));?></td></tr>
       </table>
            <?php echo Form::close(); ?>
    </div>
@else
        <br/><br/>
@endif



</div>         </div> </div>
    <?php echo  View::make('visitor.sidebar'); ?>
</div>
    <script>
            $(document).ready(function(){
            $('#errorcolor').fadeIn(800); });
    </script>
 @endsection
