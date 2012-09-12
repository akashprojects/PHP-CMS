@layout('admin.template')
@section('title')
Add/Edit User
@endsection

@section('content')

<?php
$passed = explode(',',Input::get('date'));
$date = $passed[0];

?>


<?php echo Asset::scripts(); ?>
<?php echo Asset::styles(); ?>
<link class="include" rel="stylesheet" type="text/css" href="../css/jqplot/jquery.jqplot.css" />



<?php
echo View::make('admin.navigation',array('type'=>'dashboard'));         ?>


<div id="admincontent">
    <h2> Showing stats for {{$date}} </h2>
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
    foreach (DB::query("select sum(count) as t,date from visitorslog group by date") as   $value){
        $visitors = $value->t;

        $date = "'$value->date'".',';
        $output .= '['.$date.''.$visitors.'],';
    }
    $output = substr($output,0,strlen($output)-1);

 echo  HTML::linkImage('home', HTML::image('img/smile.jpg') )
    ?>

    <div class="shadowed">
        <div class="inner-boundary">
            <div class="inner-border" style="padding: 10px;">
                <p id="message">Total pageviews [daywise]</p>
                <div id="chart1" align="center" style="margin:0 auto;width:600px;align:center "></div>
                <div id="highli" style=" position: absolute;"></div>

                <table style="margin: 0 auto">
                <tbody>
                <tr><td style="width: 500px"><b>Name</td><td><b>Total visits</b></td></tr>
        <?php

            $entries = VisitorLog::where('date','=',$passed[0])->order_by('count','desc')->get();
            foreach($entries as $entry)
            {
                echo '<tr >';
                $id = $entry->entityid;
                $type = $entry->type;

                if($type=='A')
                {
                    $article = Article::find($id);
                    if(!is_null($article))
                        echo '<td><a target="_blank" target="_blank" href="'.$article->getArticleUrl().'">'.$article->title.'</a></td>';
                    else
                        continue;
                }
                elseif($type=='C')
                {
                    $category = Category::find($id);
                    if(!is_null($category))
                        echo '<td><a target="_blank" href="'.$category->getCategoryUrl().'">'.$category->cname.'</a></td>';
                    else
                        continue;
                }
                elseif($type=='T')
                {
                    $tag = Tag::find($id);
                    if(!is_null($tag))
                        echo '<td><a href="/tags/'.$tag->turl.'">'.$tag->tname.'</td>';
                    else
                        continue;
                }
                elseif($type=='H')
                {
                        echo '<td>Home</td>';
                }
                echo '<td>'.$entry->count.'</td>';
                echo '</tr>';
            }
        ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>

    <script class="code" type="text/javascript">
        var line3 = [{{$output}}]
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