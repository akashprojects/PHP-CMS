@layout('admin.template')
@section('title')
    Dashboard
@endsection

@section('content')




<?php echo Asset::scripts(); ?>
<?php echo Asset::styles(); ?>
<link class="include" rel="stylesheet" type="text/css" href="../css/jqplot/jquery.jqplot.css" />

<?php
echo View::make('admin.navigation',array('type'=>'dashboard'));         ?>

<div id="admincontent">
    <h2> Dashboard </h2>
    <div class="shadowed">
        <div class="inner-boundary">
            <table class="inner-border" cellspacing="0" >
                <tbody>
                    <tr>
                        <td  valign="top" width="350px;" style="padding: 5px 10px">
                            <h2>Visitor Stats</h2>
                            <p id="message">Total pageviews [daywise]</p>
                            <div id="chart1" style="margin-top:10px; margin-left:10px; margin-bottom: 10px;width:400px; "></div>
                            <div id="highli" style=" position: absolute;"></div>

                        </td>
                        <td valign="top" width="480px"  style="padding: 5px 10px">
                            <h2>Recent Articles</h2>
                            <p id="message">Recent articles posted</p>
                            <div>
                                <?php $i=0;?>
                                @foreach(Article::order_by('id','desc')->take(5)->get() as $article)
                                  <p style="border: 1px solid #D8D8D8;padding: 5px;" <?php if($i%1==0) echo "id='alt'"; $i++;?>><a target="_blank" href="{{$article->getArticleUrl()}}">{{ $article->title }}</a>
                                  <br>
                                by - {{$article->User->username}}
                                <p>

                                @endforeach
                            </div>
                        </td>
                    </tr>
                <tr>
                   <td valign="top" style="padding: 5px 10px"> <h2>Site details</h2>
                       <p id="message">General Site details</p>
                    <table>
                      <tr><td style="padding: 10px" width="350px">Total Aritlces</td> <td  width="20%">{{Article::count()}}</td> </tr>
                      <tr id="alt"><td style="padding: 10px">Total Comments</td> <td>{{Comment::count()}}</td></tr>
                      <tr><td style="padding: 10px">Total Tags </td><td>{{Tag::count()}} </td> </tr>
                      <tr id="alt"><td style="padding: 10px" >Total views </td><td>{{VisitorLog::sum('count')}}</td> </tr>
                      <tr><td style="padding: 10px">Total Users </td><td>{{User::count()}}</td> </tr>
                      <tr id="alt"><td style="padding: 10px">Site name </td><td>{{Setting::find(9)->value}}</td> </tr>
                      <tr><td style="padding: 10px">Total Categories </td><td>{{Category::count()}}</td> </tr>
                      <tr id="alt"><td style="padding: 10px">Parent Categories </td><td>{{Category::where_null('parent_id')->count()}}</td> </tr>
                      <tr><td style="padding: 10px">Inner Categories </td><td>{{Category::where_not_null('parent_id')->count()}}</td> </tr>
                    </table>
                  </td>
                    <td valign="top" style="padding: 5px 10px"><h2>Recent Comments</h2>
                        <p id="message">Recent 10 comments</p>
                        @foreach(Comment::order_by('id','desc')->take(6)->get() as $comment)
                        <p style="border: 1px solid #D8D8D8;padding: 5px;" <?php if($i%1==0) echo "id='alt'"; $i++;?>><a href="/admin/comments/edit?id={{$comment->id}}" target="_blank" >{{ ($comment->content) }}</a>
                        <br>
                        by - {{$comment->name}}
                        <p>
                        @endforeach
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<style type="text/css">
    #chart3 .jqplot-point-label {
        border: 1.5px solid #aaaaaa;
        padding: 1px 3px;
        background-color: #eeccdd;
    }
</style>
<style>
    #highli {
        background: none repeat scroll 0 0 rgba(208, 208, 208, 0.6);
        border: 1px solid #CCCCCC;

        padding: 3px;
        font-size: 12px;
        white-space: nowrap;
    }</style>

<?php
$sql = '';
$visitors="";
$date = "";
$output="";
foreach (DB::query("select sum(count) as t,date from visitorslog group by date order by date desc limit 8") as  $key => $value){
           $visitors = $value->t;
           $date = "'$value->date'".',';
           $output .= '['.$date.''.$visitors.'],';
}

$output = substr($output,0,strlen($output)-1);


?>
<script class="code" type="text/javascript">
    var line3 = [{{$output}}]
    line3 = line3.reverse()
    $(document).ready(function(){


        var plot1 = $.jqplot('chart1', [line3], {


            seriesDefaults:{
                renderer:$.jqplot.BarRenderer

            },
            // Custom labels for the series are specified with the "label"
            // option on the series option.  Here a series option object
            // is specified for each series.
            legend: {show: true } ,
            series:[{label:'PAGE VIEWS'}  ],



            seriesColors : [ '#D06D0C'],

            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,

                    labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                    tickOptions: {
                        angle: -30,
                        fontFamily: 'Verdana',
                        fontSize: '9pt'
                    }

                },

                yaxis: {

                    labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                }
            }
        });


  /*  $(document).ready(function(){
        var line1 = [14, 32, 41, 44, 40];
        var plot3 = $.jqplot('chart3', [line1], {
            title: 'Bar Chart with Point Labels',
            seriesDefaults: {renderer: $.jqplot.BarRenderer},
            legend: {show: true } ,
            series:[{label:'BANANA'}, {label:'ORANGE'}  ],
            axes: {
                xaxis:{renderer:$.jqplot.CategoryAxisRenderer},
                yaxis:{padMax:1.3}}
        });
    });*/

        $('#chart1').bind('jqplotDataHighlight',
            function (ev, seriesIndex, pointIndex, data) {
                var mouseX = ev.pageX; //these are going to be how jquery knows where to put the div that will be our tooltip
                var mouseY = ev.pageY;
                x = plot1.axes.xaxis.u2p(data[0]),  // convert x axis unita to pixels
                    y = plot1.axes.yaxis.u2p(data[1]);  // convert y axis units to pixels
                chart_top = $('#chart1').offset().top,

                    chart_left = $('#chart1').offset().left;
                    var temp =  (line3[pointIndex]).toString().split(",")[0];
                $('#chart1').css('cursor','pointer');
                $('#highli').css('display','block');
                    $('#highli').html(temp + ' /  Views: ' + data[1]);


                var cssObj = {

                    'position' : 'absolute',
                    'font-weight' : 'bold',
                    'left' : (chart_left+x) + 'px', //usually needs more offset here
                    'top' : (y+chart_top-25 ) + 'px'
                };
                $('#highli').css(cssObj);
            }
        );


        $('#chart1').bind('jqplotDataUnhighlight',
            function (ev) {
                $('#chart1').css('cursor','default');
                $('#highli').css('display','none');
            }
        );


    });


    $('#chart1').bind('jqplotDataClick',
        function (ev, seriesIndex, pointIndex, data) {
            window.location='/admin/stats?date='+line3[pointIndex];
            $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
        }
    );
</script>


<script class="include" type="text/javascript" src="../js/jqplot/jquery.jqplot.min.js"></script>
<script class="include" type="text/javascript" src="../js/jqplot/jqplot.pointLabels.min.js"></script>
<script class="include" type="text/javascript" src="../js/jqplot/jqplot.canvasTextRenderer.min.js"></script>
<script class="include" type="text/javascript" src="../js/jqplot/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script class="include" type="text/javascript" src="../js/jqplot/jqplot.canvasAxisTickRenderer.min.js"></script>
<script class="include" type="text/javascript" src="../js/jqplot/jqplot.dateAxisRenderer.min.js"></script>
<script class="include" type="text/javascript" src="../js/jqplot/jqplot.categoryAxisRenderer.min.js"></script>
<script class="include" type="text/javascript" src="../js/jqplot/jqplot.barRenderer.min.js"></script>
@endsection