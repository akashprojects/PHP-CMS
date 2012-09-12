<div id="rightcontent" style="float:left;width: 279px;">

    <div class="block">
        <div style="background: #f9f6f3;padding-right: 5px;">
            <h2 style="font-size: 20px;color: #DF6838;padding: 10px 5px;margin: 0px;">
                Recent comments</h2>
            <ul>
                <?php $i=0;?>
                @foreach(Comment::where('approved','=','1')->take(10)->order_by('id','desc')->get() as $comment)
                <li <?php if($i%2==0)echo 'style="background: #fffefc"'; $i++?>>
                    <a href="{{$comment->Article->getArticleUrl()}}"><b>{{$comment->name}}</b> {{substr($comment->content,0,50)}}.. </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="block">
        <div style="background: #f9f6f3;padding-right: 5px;">
            <h2 style="font-size: 20px;color: #DF6838;padding: 10px 5px;margin: 0px;">
                Buzzing Articles</h2>
            <ul>
                <?php $i=0;?>
                <?php $entities = DB::query("select entityid, sum(count) as visits from visitorslog o where type = 'A' group by entityid order by sum(count) desc limit 10");  ?>
                @foreach($entities as $key=>$entity)
                <li <?php if($i%2==0)echo 'style="background: #fffefc"'; ?>>
                    <?php $article = Article::find($entity->entityid); ?>
                    @if(!is_null($article))
                        <a href="{{$article->getArticleUrl()}}">{{$article->title}} </a>
                        <span class="title"> <b>Visits {{$entity->visits}}</b></span>
                        <?php $i++; ?>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>


</div>