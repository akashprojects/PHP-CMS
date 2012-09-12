@layout('visitor.front')

@section('headerfiles')
<link href="/css/visitor.style.css" media="all" type="text/css" rel="stylesheet">
@endsection
@section('title')
{{$parentCategoryDetails->cname}} : {{!is_null($childCategoryDetails)?$childCategoryDetails->cname:''}}
@endsection



@section('content')
<div id="wrapper">
<?php echo render('visitor.navigation', array('outercategory'=>$parentCategoryDetails,'innercategory'=>$childCategoryDetails));   ?>
<?php VisitorLogger::logVisitor(($childCategoryDetails == null)?$parentCategoryDetails->id:$childCategoryDetails->id,'C'); ?>
    <div id="leftcontent" style="float: left; width: 680px;">
    <h3 id="message">
@if($childCategoryDetails == null)
    Showing all post of category named {{$parentCategoryDetails->cname}} <BR>
@else
    Showing all post of category named {{$parentCategoryDetails->cname}} -> {{$childCategoryDetails->cname}} <BR>
@endif
        </h3>
    @foreach($allarticles as $article)
    <h2 class="{{$article->headingClass}}"><a  href="{{ $article->getArticleUrl() }} ">{{ $article->title }}</a></h2>
    @if($article->onlytitle!=1)
    <div class="articleinfo">
        <div style="float:left">
            <a class="author-link" href="/author/{{ User::find($article->author_id)->username }}">{{ User::find($article->author_id)->displayname }}</a>
            <a class="published-time" href="{{ $article->getArticleUrl() }}">{{$article->postedDate()}}</a>
        </div>
        <div style="float:right;margin-bottom:5px ">
            <div class="cat-list">
                <a title="View all posts in {{ $article->categoryName}}" href="{{$article->Category->getCategoryUrl()}}">{{ $article->categoryName }}</a>
            </div>
            <a class="comments-link">{{ $article->Comments()->count() }}</a>
        </div>
    </div>
    <p style="clear:both">{{ $article->getAdjustedArticleContent() }}</p>

    @endif

    @endforeach
    </div>
    <?php echo  View::make('visitor.sidebar'); ?>
     </div>

@endsection