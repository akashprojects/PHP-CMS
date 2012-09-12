@layout('visitor.front')

@section('title')
Home
@endsection

@section('content')
    <?php
        $tag = Tag::where('turl','=',$tagurl)->first();
        $articles = $tag->Articles;
        $articles = cmsHelper::bakeArticleForViewers($articles);
    ?>
    <?php VisitorLogger::logVisitor($tag->id,'T'); ?>


<?php echo  View::make('visitor.index',array("articles"=>$articles,'dbquery'=>null,'message'=>"Showing all posts tagged with ".$tag->tname)); ?>

@endsection