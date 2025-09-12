<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Statistics of search</title>
    </head>
    <body><div class="wrap_all">
<?
if (empty($_COOKIE['a']))  exit;
header('Content-Type: text/html; charset=windows-1251');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define("MAIN_FILE_EXECUTED", TRUE);
require_once($_SERVER["DOCUMENT_ROOT"].'/sc/lib_new_includes/inc_dbconnect.php');
require_once('controller/inc_functions.php');
if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')){
  
    global $db;
    $out = array();
    //////////////
    $query = "SELECT * FROM `search_statistics` order by `id` desc limit 500;";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($db));
    if (mysqli_num_rows($result)>0){
    echo '<h2>Последние 500 запросов</h2><table><tr><th>Запрос</th><th>Дата</th><th>Время</th><th>REMOTE_ADDR</th><th>Город</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td><a target='_blank' href='http://".$_SERVER['HTTP_HOST']."/search/?search=".$row["text"]."'>".$row["text"]."</a></td><td>".$row["date"]."</td><td>".$row["time"]."</td><td>".$row["REMOTE_ADDR"]."</td><td>".$row["city"]."</td></tr>";
    } 
    echo '</table>';}   
    //////////////    
    ////////////////////////////////////////////////////////////////////////////
    if ($_GET["date_start"] != "" and $_GET["date_finish"] != ""){
        $condition = " where `date` between '{$_GET["date_start"]}' and  '{$_GET["date_finish"]}' ";
    }else{$condition = "";}    
     $query = "SELECT `id`,`text`,COUNT(*),`date`,`time` FROM `search_statistics` "
            . " $condition GROUP BY `text` order by COUNT(*) desc;";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($db));
    if (mysqli_num_rows($result)>0){
    echo '<h2>Сгруппировано по фразам</h2><table>';
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td><a target='_blank' href='http://".$_SERVER['HTTP_HOST']."/search/?search=".$row["text"]."'>".$row["text"]."</a></td><td>".$row["COUNT(*)"]."</td></tr>";
    } 
    echo '</table>';}
    else{
        echo 'No records!';
    }

    
    
exit();
}
?>
<? require_once('view/menu.php'); ?>

<form id="form_get_statistics" method="get" class="form_get_statistics">    
    <table>
        <tr>
            <td><input placeholder="дата начала периода" type="text" name="date_start" autocomplete="off" /></td>
            <td><input placeholder="дата конца периода" type="text" name="date_finish" autocomplete="off" /></td>
            <td><span class="clear_inputs">X</span></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Run!" /></td>            
        </tr>
    </table>    
</form>
<div id="ajax_result"></div>
<style>
    .wrap_all{width: 100%;margin: 10px auto;max-width: 1000px; }
    .menu-bar{margin: 10px auto;}
    .form_get_statistics{display: block;margin: 10x auto;                            
        padding: 20px;background: #44bb6e;box-shadow: 1px 1px 4px rgba(0,0,0,0.4);}
    
    #ajax_result table{width: 100%;max-width: 1000px;margin: 10px auto;}
    #ajax_result table td,#ajax_result table th{padding: 5px 10px;text-align: left;}
    #ajax_result table tr:nth-child(2n+1){background: #eee;}
    #ajax_result table tr:hover{background: rgba(86,187,110, 0.5);}
    
    #form_get_statistics .clear_inputs{display: inline-block;cursor: pointer;border-radius: 20px;background: #fff;width: 20px;text-align: center;}
    
    #ui-datepicker-div{display: none;padding: 20px;background: #fff;box-shadow: 1px 1px 4px rgba(0,0,0,0.4);}
    .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 40%; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
.ui-timepicker-div .ui_tpicker_unit_hide{ display: none; }

.ui-timepicker-div .ui_tpicker_time .ui_tpicker_time_input { background: none; color: inherit; border: none; outline: none; border-bottom: solid 1px #555; width: 95%; }
.ui-timepicker-div .ui_tpicker_time .ui_tpicker_time_input:focus { border-bottom-color: #aaa; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
.ui-timepicker-rtl dl dt{ float: right; clear: right; }
.ui-timepicker-rtl dl dd { margin: 0 40% 10px 10px; }

/* Shortened version style */
.ui-timepicker-div.ui-timepicker-oneLine { padding-right: 2px; }
.ui-timepicker-div.ui-timepicker-oneLine .ui_tpicker_time, 
.ui-timepicker-div.ui-timepicker-oneLine dt { display: none; }
.ui-timepicker-div.ui-timepicker-oneLine .ui_tpicker_time_label { display: block; padding-top: 2px; }
.ui-timepicker-div.ui-timepicker-oneLine dl { text-align: right; }
.ui-timepicker-div.ui-timepicker-oneLine dl dd, 
.ui-timepicker-div.ui-timepicker-oneLine dl dd > div { display:inline-block; margin:0; }
.ui-timepicker-div.ui-timepicker-oneLine dl dd.ui_tpicker_minute:before,
.ui-timepicker-div.ui-timepicker-oneLine dl dd.ui_tpicker_second:before { content:':'; display:inline-block; }
.ui-timepicker-div.ui-timepicker-oneLine dl dd.ui_tpicker_millisec:before,
.ui-timepicker-div.ui-timepicker-oneLine dl dd.ui_tpicker_microsec:before { content:'.'; display:inline-block; }
.ui-timepicker-div.ui-timepicker-oneLine .ui_tpicker_unit_hide,
.ui-timepicker-div.ui-timepicker-oneLine .ui_tpicker_unit_hide:before{ display: none; }
.ui-datepicker-title,.ui-datepicker-buttonpane{text-align: center;font-weight: bold;padding: 10px;background: #eee;margin: 5px 0;font-size: 20px;}
#ui-datepicker-div a,#ui-datepicker-div button{display: inline-block;padding:2px 5px;margin: 0 5px;background: #44bb6e;
  color:#fff;text-decoration: none;transition: 0.2s;min-width: 17px;text-align: center;cursor: pointer;
border:2px solid #44bb6e;}
#ui-datepicker-div button{padding: 5px 10px;font-size: 20px;}
#ui-datepicker-div a:hover,#ui-datepicker-div button:hover{background: #24ab4e;}
#ui-datepicker-div a.ui-state-default.ui-state-highlight{    
    border:2px solid #f00;
}

</style>
 
<script src="/js/jquery-1.10.2.js?1422519954"></script>
<script src="/js/jquery-ui.js?1422519954"></script>
<script src="/search/scripts/jquery-ui-timepicker-addon.js"></script>
<script>
$(
        function(){
            $('input[name=date_start], input[name=date_finish]').datetimepicker({
                timeFormat: 'yy',
                dateFormat: "yy-mm-dd",
                timeInput: true,
                controlType: 'select',
                showTimepicker: false,
            });            
        }
);
$("#form_get_statistics").submit(function (e) {
        var form = $(this);
        $('#ajax_result').html("sending request...");        
        $.ajax({
            type: "GET",            
            data: form.serialize(), // serializes the form's elements.
            success: function (data)
            {
                $('#ajax_result').html(data);
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    
    $(".clear_inputs").click(
            function(){
                $('#form_get_statistics input[type=text]').val(""); 
            });
    $("#form_get_statistics input[type=submit]").click();        
</script>

</div>
    </body>
</html>
