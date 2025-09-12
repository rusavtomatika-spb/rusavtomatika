<?
define("bullshit",1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");
include ("../sc/auth.php");

database_connect();

temp0("weintek");
top_buttons();
temp1_no_menu();
//temp1();
//left_menu();
basket();
add_to_basket();


temp2();
//-----------------------content

?>
    <script>

        var gl_host="broker.mqttdashboard.com";
        var gl_port=8000;

    </script>

    <style>
	
	h1, h2 {
    font-family: Verdana, 'Lucida Grande';
    font-size: 20px;
    margin-bottom: 20px;
}

        table > tbody > tr > td{
            vertical-align: middle;

        }

        #mes{
            overflow: scroll;
            height: 200px;
            border: 1px solid #000000;


        }

        #cc1{
            padding:10px;

        }
        #connst{

            font-size: 20px;
            color:darkblue;
            font-weight: bold;
            padding: 3px;

        }

        #nickname{

            font-size: 20px;
            color:darkred;
            font-weight: bold;
            padding: 3px;

        }

        #cont{

            font-size: 14px;
            color:#808080;
            padding: 3px;

        }
        #warn{

            font-size: 16px;
            color:red;
            padding: 3px;

        }

        .tds{

            font-size: 19px;
            color:black;
            padding: 5px;
            width: 160px;

        }

        #val1, #val2{

            font-size: 24px;
            font-weight: bold;
            color:olivedrab;
            padding: 3px;
            width: 130px;
        }

        #chart3 .jqplot-meterGauge-tick, {
            font-size: 10pt;
        }

        #chart4 .jqplot-meterGauge-tick, {
            font-size: 10pt;
        }

        #chart5 .jqplot-meterGauge-tick, {
            font-size: 10pt;
        }

    </style>

<div id="cc1" style="padding:10px;text-align:center;width:1000px;margin:auto;font-family: Verdana;">
<br><br>
    <center><h1>Тестирование протокола MQTT на панелях оператора Weintek</h1></center>
    <br>
    <a href="index.php#manual">Описание проекта</a><br><br>

     <table><tr>

         <td width="400">

         <div id="nickname">Введите топик <input id="in_nick" type="text"/></div>
          <div id="cont">Топик - это произвольная строка, такой же топик<br> вы должны задать в операторской панели </div>
         </td>

         <td width="150">
     <div id="connectButton" class="zakazbut" onclick="con_discon();" ></div>
        </td><td>

     <div id="connst">Нет подключения</div>
        </td>

    </tr> </table>
    <div id="warn"></div>


    <br><br>

    <table style="margin:auto;font-size:80%;"><tr>

    <td width="125"> </td> <td class="tds" >Переменная 1</td><td id="val1">0 </td> <td class="tds"> Переменная 2  </td><td> <div id="val2" >0</div></td>


        </tr> </table>

    <br><br>

    <!----------------------------JQPLOT -------------------------------------------------------------------------->
    <table style="margin:auto;"><tr>
    <td><div id="chart3" class="plot" style="width:300px;height:180px;"></div></td>
    <td><div id="chart4" class="plot" style="width:300px;height:180px;"></div></td>
    </tr></table>

    <div id="chart5">  </div>

      <!-- <div onclick="grl(b+=10, b);">dd</div>  -->

    <script>

       // var a=[[1,2,3,4,5,6,7]];
       // var a=[[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]];
       var a=[[null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null],
           [null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null]   ];
        var b=10;
        //  var plot1 = $.jqplot('chart3', a);

        function grl(xx,yy)
        {
            $("#chart5").html("");

            //a[0]=a[0].splice(-1).concat(xx);

            a[0].shift();
            a[0].push(xx);

            a[1].shift();
            a[1].push(yy);

            console.log(a[0]);


            var plot1 = $.jqplot('chart5', a);
        }


        function  g1(xx){

           $("#chart3").html("");
        var s1 = [];
            s1.push(xx);
      var   plot3 = $.jqplot('chart3',[s1],{
        seriesDefaults: {
        renderer: $.jqplot.MeterGaugeRenderer,
        rendererOptions: {
        min: 0,
        max: 1000,
        intervals:[250, 500, 750, 1000],
        intervalColors:['#66cc66', '#93b75f', '#E7E658', '#cc6666']
        }
        }
        }
         );
        }


            function  g2(xx){

                $("#chart4").html("");
                var s1 = [];
                s1.push(xx);
                var   plot4 = $.jqplot('chart4',[s1],{
                    seriesDefaults: {
                        renderer: $.jqplot.MeterGaugeRenderer,
                        rendererOptions: {
                            min: 0,
                            max: 1000,
                            intervals:[250, 500, 750, 1000],
                            intervalColors:['#66cc66', '#93b75f', '#E7E658', '#cc6666']
                        }
                    }
                });
            }

    </script>

    <!----------------------------JQPLOTEnd -------------------------------------------------------------------------->


    <div style="margin: 20px auto;">Данные от панели оператора в формате JSON</div>
    <div id="mes">  </div>

    <div style="font-size:80%;padding: 20px 0px;">Скачать проект для операторской панели можно <a href="mqtt_test.emtp">здесь</a><br>
    Проект сделан для панели MT8090XE, если вы хотите его загрузить в другую панель, <br>
    нужно будет в проекте изменить модель.</div>

</div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/1.3.1/lodash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/foundation/4.2.3/js/foundation.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/foundation/4.2.3/js/foundation/foundation.forms.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js"></script>
    <script src="js/jquery.minicolors.min.js"></script>
    <script src="js/mqttws31.js"></script>
    <script src="js/encoder.js"></script>
    <script src="js/app.js"></script>
    <script src="config.js"></script>

    <script>

        function randomString(length) {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < length; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }

        $(document).foundation();
        $(document).ready(function () {

            $('#connectButton').html("Подключиться");

            websocketclient.render.toggle('publish');
            websocketclient.render.toggle('messages');
            websocketclient.render.toggle('sub');

            g1(0);
            g2(0);
            grl(null,null);
            //  var plot1 = $.jqplot('chart3', [[3,7,9,1,5,3,8,2,5]]);

        });
    </script>

<!---JQPLOT ------------------------->

    <script type="text/javascript" src="jqplot/jquery.min.js"></script>
    <script type="text/javascript" src="jqplot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="jqplot/plugins/jqplot.meterGaugeRenderer.min.js"></script>
    <script type="text/javascript" src="jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script type="text/javascript" src="jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jqplot/jquery.jqplot.min.css" />

<?
/*

 <script type="text/javascript" src="jqplot/syntaxhighlighter/scripts/shCore.min.js"></script>
    <script type="text/javascript" src="jqplot/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="jqplot/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
    <script type="text/javascript" src="jqplot/example.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jqplot/examples.min.css" />



 */

//------------------- end content
temp3();

?>