@layout('visitor.front')

@section('headerfiles')
<link href="/css/visitor.style.css" media="all" type="text/css" rel="stylesheet">
    @endsection
    @section('title')
        Home
    @endsection

@section('content')
<div id="wrapper" >

<?php echo render('visitor.navigation', array('outercategory'=>null,'innercategory'=>null));   ?>
<?php VisitorLogger::logVisitor(0,'H'); ?>

    <div id="leftcontent" style="float: left; width: 680px;">
    @if(isset($message))
        <h3 id="message">
           {{ $message }}
        </h3>
    @endif
    @foreach($articles as $article)

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

    <!--Shows the comment pages-->
    @if(!is_null($dbquery))
        {{  $dbquery->links(); }}
    @endif
        </div>
    <?php echo  View::make('visitor.sidebar'); ?>

</div>
@endsection
