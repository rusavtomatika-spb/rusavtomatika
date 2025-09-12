<?php

session_start();
define("bullshit", 1);
include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_controllers.php");

//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));
//database_connect();
//mysql_query("SET NAMES 'cp1251'");
//echo "sss=".$_SERVER['SCRIPT_FILENAME'];
//echo "sss=".$_SERVER['DOCUMENT_ROOT'];
//---------------content ---------------------

$prices_out = '
<script>
function dich(num,link)
 {
if (link != "0") {
   $("#dd").html("<a id=\"biglightbox\" href=\'"+link+"\' rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" /><img src=\'"+num+"\'\"></span></a>");
} else {
 $("#dd").html("<img src=\'"+num+"\'\">");

};


 }
 /*
 $(function() {
    $( "#tabs" ).tabs({
      event: "mouseover"
    });
  });
*/
$(function() {
    $( "#tabs" ).tabs();
  });


$(document).ready(function(){
 $(\'.toclick\').click(function() {
  $(\'.lightbox\').prop(\'rel\', \'lightbox[1]\');
   $(this).children(\'.lightbox\').prop(\'rel\', \'box[1]\');
	});
	});

  </script> ';


//$var_array = explode("/",$_SERVER['REQUEST_URI']);
//$levels = count($var_array);
//$end_page = $levels - 1;
//$num="MT8070iH";
//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$num = str_replace(".php", "", $var_array[$levels]);

$sql = "SELECT * FROM `controllers` WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_object($res);

$q = mysql_num_rows($res);
if ($q > 0) {
//echo basename($_SERVER['PHP_SELF']);
    /*
      if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
      else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;есть на складах: СПБ, МСК, КИЕВ</div>";
     */

    $series = array('A-51' => 'series_a51', 'A-10A-10x' => 'series_a10x', 'A-52' => 'series_a52', 'A-61' => 'series_a61', 'A-118' => 'series_a1', 'A-218' => 'series_a2', 'A-12x' => 'series_a12x', 'A-18x' => 'series_a18x');



    $kolvo = children($r->model);

    if ($r->type == 'controller') {
        if ($kolvo > 1) {
            $type = 'Контроллеры';
        } else {
            $type = 'Контроллер';
        };
        if (preg_match('/A-52/i', $r->model)) {
            $title = 'ПЛК, PLC с Wi-Fi, программируемый логический контроллер Yottacontrol ' . $r->model . ', бюджетный контроллер, со склада';
            if ($kolvo > 1) {
                $type = 'Контроллеры с Wi-Fi';
            } else {
                $type = 'Контроллер с Wi-Fi';
            };
        } else {
            //$title = $r->brand.' '.$r->model.' — '.strtolower($type).' управления со склада по отличной цене';
            $title = 'ПЛК, PLC, программируемый логический контроллер Yottacontrol ' . $r->model . ', бюджетный контроллер, со склада';
        }
    };
    if ($r->type == 'module') {
        if ($kolvo > 1) {
            $type = 'Модули ввода-вывода';
        } else {
            $type = 'Модуль ввода-вывода';
        };
//$title = $r->brand.' серия '.$r->model.' — '.strtolower($type).' для контроллеров '.$r->brand.' со склада по отличной цене';

        if ($r->parent == 'A-2060x') {
            $title = 'ПЛК, PLC, модуль-расширение ввода-вывода Yottacontrol ' . $r->model . ', бюджетный контроллер, со склада';
        } else if (preg_match('/A-12/i', $r->model)) {
            $title = 'Модуль ввода-вывода, Yottacontrol ' . $r->model . ', Wi-Fi, Modbus TCP' . ($r->DI ? ', ' . $r->DI . 'DI' : '') . ($r->AI ? ', ' . $r->AI . 'AI' : '') . ($r->DO ? ', ' . $r->DO . 'DO' : '') . ($r->AO ? ', ' . $r->AO . 'AO' : '');
        } else if (preg_match('/A-18/i', $r->model)) {
            $title = 'Модуль ввода-вывода, Yottacontrol ' . $r->model . ', Ethernet, USB, Modbus TCP' . ($r->DI ? ', ' . $r->DI . 'DI' : '') . ($r->AI ? ', ' . $r->AI . 'AI' : '') . ($r->DO ? ', ' . $r->DO . 'DO' : '') . ($r->AO ? ', ' . $r->AO . 'AO' : '');
        } else {
            $title = 'Modbus модуль ввода-вывода Yottacontrol ' . $r->model . ', бюджетный, со склада';
        };
        if ($r->model == 'A-3016') {
            $type = 'Радиомодуль ввода-вывода';
            $title = $r->brand . ' ' . $r->model . ' — радиомодуль ввода-вывода для контроллеров ' . $r->brand . ' со склада по отличной цене';
            $title = 'ПЛК, PLC, радиомодуль ввода-вывода для контроллеров Yottacontrol, бюджетный контроллер, со склада';
        };
    };
    if ($r->type == 'transmitter') {
        if ($kolvo > 1) {
            $type = 'Пульты управления';
        } else {
            $type = 'Пульт управления';
        };
        $title = $r->brand . ' ' . $r->model . ' — ' . strtolower($type) . ' управления контроллерами серии ' . $r->series . ' с обратной связью со склада';
    };
    if ($r->type == 'coupler') {
        if ($kolvo > 1) {
            $type = 'Коммутационные модули (Coupler) для модульной системы ввода вывода (Coupler + Digital I/O)';
        } else {
            $type = 'Коммутационный модуль (Coupler) для модульной системы ввода вывода (Coupler + Digital I/O)';
        };
        $title = $r->brand . ' ' . $r->model . ' — ' . mb_strtolower($type, 'Windows-1251') . ' серии ' . $r->series . ' со склада';
    };
    if ($r->AI > 0 || $r->AO > 0 ){
        $module_type ='аналоговый';
    }else{
         $module_type ='дискретный'; 
    }
    if ($r->type == 'module')  {
        if ($kolvo > 1) {
            $type = ($r->AI > 0 || $r->AO > 0 )? 'Аналоговый модуль ввода-вывода' : 'Дискретный модуль ввода-вывода';
        } else {
            $type = ($r->AI > 0 || $r->AO > 0 )? 'Аналоговый модуль ввода-вывода' : 'Дискретный модуль ввода-вывода';
        };
        $title = $r->model . ' — ' . mb_strtolower($type, 'Windows-1251') . ' серии ' . $r->series . ' от' . ' ' . $r->brand  ;
    };

    $nav = '<br /><nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/plc/weintek/">Модульные системы Weintek</a>&nbsp;/&nbsp;' . $type . ' ' . $r->brand . ' ' . $r->model . '</nav>';
    $type = strtoupper($type);
    switch ($r->type) {
        case 'controller':
            $types = 'контроллер';
            $types1 = 'контроллера';
            $keywords = 'PLC, ПЛК, Контроллер управления, ' . $r->model . ', ' . $r->brand . ', контроллеры';
            $description = 'PLC, программируемый логический контроллер управления, ' . $r->model . ', ' . $r->brand . ' - оптимальное сочетание цены и работоспособности';
            break;
        case 'module':
            if ($r->model == 'A-3016') {
                $types = 'радиомодуль ввода-вывода';
                $types1 = 'радиомодуля ввода-вывода';
                $keywords = 'PLC, ПЛК, Радиомодуль ввода вывода, контроллеры управления, ' . $r->model . ', ' . $r->brand . '';
                $description = 'Радиомодуль ввода-вывода, ' . $r->model . ', ' . $r->brand . ' для PLC, программируемых логических контроллеров управления ' . $r->brand . ' - оптимальное сочетание цены и работоспособности';
            } else {
                $types = 'модуль ввода-вывода';
                $types1 = 'модуля ввода-вывода';
                $keywords = 'PLC, ПЛК, Модули ввода вывода, контроллеры управления, ' . $r->model . ', ' . $r->brand . '';
                $description = 'Модули ввода-вывода, ' . $r->model . ', ' . $r->brand . ' для PLC, программируемых логических контроллеров управления ' . $r->brand . ' - оптимальное сочетание цены и работоспособности';
            };
            break;
        case 'transmitter':
            $types = 'пульт управления';
            $types1 = 'пульта управления';
            $keywords = 'PLC, ПЛК, Передатчик, пульт управления, удаленное управление, управление контроллером, ' . $r->model . ', ' . $r->brand . '';
            $description = 'Пульт управления, ' . $r->model . ', ' . $r->brand . ' для PLC, программируемых логических контроллеров управления ' . $r->brand . ' серии ' . $r->series . '- оптимальное сочетание цены и работоспособности';
            break;
    }





    $onst = show_stock($r, 1);

    $min_table = mini_controllers($r->model, 5, 10, 350); // mins_in_row, mins_max, table_width
//$im1=get_big_pic($r->model);
//echo $r->model;
//if (empty($min_table)) {$min_table = "<table width='350' bfcolor='red'><tr>".$all_images."</tr></table>";};

    if (!empty($ipath)) {
        $im1 = $ipath;
    };
    $im1 = 'images/controllers/' . strtolower($r->brand) . '/' . $r->model . '/' . $r->model . '_1.png';
    $bim1 = 'images/controllers/' . strtolower($r->brand) . '/' . $r->model . '/lg/' . $r->model . '_1.png';
    $default_im1 = 'images/controllers/' . strtolower($r->brand) . '/default/' . $r->series . '.png';
    $default_bim1 = 'images/controllers/' . strtolower($r->brand) . '/default/lg/' . $r->series . '.png';
    $alt = $types . ' ' . $r->model . ' ' . $r->brand;

    $b = '/' . $r->brand . '/i';
    if (preg_match($b, $r->model)) {
        $brand = '';
    } else {
        $brand = $r->brand;
    };
    if (file_exists("../sc/new.php")) {
        include("../sc/new.php");
    } else {
        $class = '';
    };


    if ($GLOBALS["net"] == 0) {
        if (!file_exists($GLOBALS["path_to_real_files"] . '/' . $bim1)) {
            if (!file_exists($GLOBALS["path_to_real_files"] . '/' . $default_bim1)) {
                $bim1 = '';
            } else {
                $bim1 = $default_bim1;
            };
        };
        if (!file_exists($GLOBALS["path_to_real_files"] . '/' . $im1)) {
            if (!file_exists($GLOBALS["path_to_real_files"] . '/' . $default_im1)) {
                $im1 = '';
            } else {
                $im1 = $default_im1;
            };
        };
    } else {
        $re = cu($GLOBALS["path_to_real_files"] . '/' . $bim1);
        if ($re[0] <= 0) {
            $re = cu($GLOBALS["path_to_real_files"] . '/' . $default_bim1);
            if ($re[0] <= 0) {
                $bim1 = '';
            } else {
                $bim1 = $default_bim1;
            };
        };


        $re = cu($GLOBALS["path_to_real_files"] . '/' . $im1);
        if ($re[0] <= 0) {
            $re = cu($GLOBALS["path_to_real_files"] . '/' . $default_im1);
            if ($re[0] <= 0) {
                $im1 = '';
            } else {
                $im1 = $default_im1;
            };
        };
    };


    $im1 = img($r->model, 1);

    $bim1 = imgbig($r->model, 1);
    $min_table = img_mini($r->model, 15, 5, 10, 350);
    $alt = $types . ' ' . $r->model . ' ' . $r->brand;
    if (!empty($bim1)) {
        $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt'></span></a>";
    } else {
        $kartinka = "
<img src='$im1' alt='$alt'>";
    };

    if (($r->retail_price != '0') AND ( $r->retail_price != '')) {
        $priceb = "<td width=60 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td>";
    } else {
        $priceb = "<td width=60 colspan='2' style='display: initial;
padding: 0px 20px;
border: none;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >по&nbsp;запросу</td>";
    };
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/sc/analog.php')) {
        include($_SERVER['DOCUMENT_ROOT'] . '/sc/analog.php');
    };
    $prices_out .= "
<center>
" . $nav . "<br>
<h1>" . $title . "</h1>
<table width=1100px  height=400px>
<tr ><td colspan=2 height=50px>

<table><tr><td width=840 align=left bfcolor=#cccccc></td><td width=120>
 <div class=pan_price_big title='Розничная цена'> Цена с НДС </div></td>" . $priceb . "</tr></table>
<div class=hc1>&nbsp;</div>" . $analog . "<br>
</td></tr>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div><style>
#body_cont nav {margin: 3px auto 15px 0px;}
h1 {text-align:left;width: 1100px;  margin: auto;margin-bottom: 20px;} nav {color: gray;  text-align: left;  padding: 0px 75px 0px;  font-size: 11px;
  font-family: Verdana, sans-serif;} nav a {color: gray;} #dd {text-align: center;} #dd img {max-height:300px;max-width:400px;} h2 {font-size: 14px;
color: gray;margin: 17px 10px 12px 10px;}.com_about {width: 200px;float: left;}.scheme {width: 700px;float: right;padding-left: 20px;}.com_about img {
width: 200px;}
.com {color: gray;}
.scheme table tr td {border: 1px solid gray;padding: 3px 15px;font-size: 11px;}
.gray {background-color: rgb(245, 245, 245);}
#analog {text-align: right;font-family: Verdana, 'Lucida Grande';font-size: 11px;color: gray;position: absolute;width: 300px;
margin-left: 700px;}
#analog a {color: black;}
.big_pan_name {
  margin: 0px;
  padding: 0px;
  color: black;
}
</style>
<br>
<center>
  $min_table
</td>


<td  valign=top>";
//----------------------------------right part content -----------------------
    $prices_out .= "
<script>
$(document).ready(function(){
 $('.mytab2 tr:even').addClass('gray');

	});
</script>	";

    function buttons($model) {
        $sql = "SELECT `model`,`retail_price` FROM `controllers` WHERE `model` = '$model' LIMIT 1 ";
        $res = mysql_query($sql) or die(mysql_error());
        $r = mysql_fetch_object($res);

        if (($r->retail_price != '0') AND ( $r->retail_price != '')) {
            //<td><div class=but_wr> <div  class='zakazbut' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div></div>  </td>
            $price = "<td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div></div> </td>

            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div></div>  </td>
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </div> </td>";
        } else {
//	<td><div class=but_wr> <div  class='zakazbut' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div></div>  </td>
            $price = "

            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div></div>  </td>
           ";
        };



        return $price;
    }

    $prices_out .= "
<div id=cont_rp>

<table style='width:100%;'>

 <tr><td colspan=3> &nbsp;</td></tr>
 <tr><td width=5>&nbsp;</td><td width=80 class=h2_text>Наличие: </td><td > $onst</td>
 <td>  </td>  </tr>

 </table><br>

<table ><tr>" . buttons($r->model) . "
 </tr>
 <tr><td colspan=4><br>   </td></tr>
 </table><div style='width:100%;' class=hc1> </div>

";




    /*
      <table><tr><td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div></div> </td>
      <td><div class=but_wr> <div  class='zakazbut' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div></div>  </td>
      <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div></div>  </td>
      <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </div> </td>
      </tr>
      <tr><td colspan=4><br><div class=hc1> </div>   </td></tr>
      </table>
     */

    $tick = "<img src='/images/tick.png' width=15>";
    $he = "height=38 class=hl_text";
    $vc = "valign=center";

    /* if (preg_match('/iR-COP/i', $r->model)) {

      $plus_table = '
      <tr><td width="30"><img src="/images/tick.png" width=15></td><td class="hl_text">Коммутационный модуль iR-COP входит в состав в модульной системы дистанционного ввода-вывода (Remote I/O)</td></tr>
      <tr><td width="30"><img src="/images/tick.png" width=15></td><td class="hl_text">Коммутация по протоколу CANopen</td></tr>';
      } */

    if ($r->text_detail_short) {
        $plus_table = $r->text_detail_short;
    } else {
        $plus_table = "";
    }
    $prices_out .= "<br>
<table width=100% class='text_detail_short'>

$plus_table" .
            "</table>
<style>.hl_text a {text-decoration:none;color:blue;} .hl_text a:hover {text-decoration:none;} .hl_text {padding-bottom: 10px;}
.text_detail_short td{vertical-align:top;}
</style>
</div>
";



// --------------------- end right part content -----------------------

    $prices_out .= "</td></tr></table>"; // end big table
//$vars=show_pc_variants($num);

    function price($model) {
        $sql = "SELECT `model`,`retail_price` FROM `controllers` WHERE `model` = '$model' AND `modification`='1' LIMIT 1 ";
        $res = mysql_query($sql) or die(mysql_error());
        $r = mysql_fetch_object($res);

        if (($r->retail_price != '0') AND ( $r->retail_price != '')) {
            $price = "<span class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</span><span class=val_name title='Нажмите для пересчета в РУБ'> USD </span>";
        } else {
            $price = "<span style='' class='zakazbut inline' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >Цена&nbsp;по&nbsp;запросу</span>";
        };



        return $price;
    }

//----------------------------------------end pics ----------------------------


    $bg1 = "style='background: #fefefe';";
    $bg2 = "style='background: #f5f5f5';";
    $table_start = "<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";

    $us_tr_l = '<tr><td class=par_name1 >';
    $us_tr_l1 = '</td><td class=par_val1 >';
//----------------------------tab1 -----------------------------------------


    $dop = "";

    $arch = "";

    $mount = "";
    if (($r->wall_mount == "есть") OR ( $r->wall_mount == "yes")) {
        $mount .= "в стену";
    } else {
        $mount .= $r->wall_mount;
    };


    $usb_drv = "";

    if ($r->diagonal == 0) {
        $display_char = '';
        $without = '';
    };

    $pixel_pitch = '';
    $response_time = '';
    $view_angle = '';


    if (!empty($r->cpu_type)) {
        $cpu_type = "<tr><td class=par_name1 >Процессор</td><td class=par_val1 >$r->cpu_type</td></tr>";
    };
    if (!empty($r->cpu_speed)) {
        $cpu_speed = "<tr><td class=par_name1 >Частота</td><td class=par_val1 >$r->cpu_speed МГц</td></tr>";
    };
//  if (!empty($r->ram)) {$ram = "<tr><td class=par_name1 >ОЗУ</td><td class=par_val1 >$r->ram Мб</td></tr>";};
    if (!empty($r->rtc)) {
        $rtc = "<tr><td class=par_name1 >RTC ( часы реального времени )</td><td class=par_val1 >" . ($r->rtc ? $r->rtc : '-') . "</td></tr>";
    };

    $params = $cpu_type . $cpu_speed . $ram . $rtc;



    $sp_data1 .= '<span class=hpar>Параметры</span><br>' .
            $table_start . $params;

    if ((preg_match('/A-51/i', $r->model)) OR ( preg_match('/A-618/i', $r->model))) {
        $sp_data1 .= $us_tr_l . 'Базовый контроллер IOs</td>' . $us_tr_l1 . '12 IOs</td></tr>' .
                ( preg_match('/D/i', $r->model) ? $us_tr_l . 'Дисплей</td>' . $us_tr_l1 . '2&#8243; (модификация с литерой &#0171;D&#0187; в названии)</td></tr>' : '' ) .
                '<tr><td class=par_name1 rowspan=22>Функциональные возможности</td>' . $us_tr_l1 .
                'Создание управляющих программ в функциональном блоке: диаграммы (FBD) или релейной диаграммы (LAD)</td></tr>' .
                '<tr><td class=par_val1>4-осевое синхронное движение 50 кГЦ ШИМ (всего 400 кГц)</td></tr>';
    };

    if (preg_match('/A-52/i', $r->model)) {
        $sp_data1 .= $us_tr_l . 'Базовый контроллер IOs</td>' . $us_tr_l1 . '12 IOs</td></tr>' .
                $us_tr_l . 'Дисплей</td>' . $us_tr_l1 . '2&#8243; (литера &#0171;D&#0187; в названии — у всех моделей в серии)</td></tr>' .
                '<tr><td class=par_name1 rowspan=22>Функциональные возможности</td>' . $us_tr_l1 .
                'Создание управляющих программ в функциональном блоке: диаграммы (FBD) или релейной диаграммы (LAD)</td></tr>' . //all
                '<tr><td class=par_val1>4-осевое синхронное движение 100 кГЦ ШИМ (всего 400 кГц)</td></tr>';
    };

    if (($r->brand == 'Yottacontrol') AND ( $r->type == 'controller') AND ( (preg_match('/A-6/i', $r->model)) OR ( preg_match('/A-5/i', $r->model)))) {
        $sp_data1 .= '<tr><td class=par_val1>возможно изменение конкретного параметра непосредственно во время работы контроллера</td></tr>' .
                '<tr><td class=par_val1>multi AUTO-PI (пропорционально-интегральная) синхронная функция </td></tr>' .
                '<tr><td class=par_val1>многоязычное меню </td></tr>' .
                '<tr><td class=par_val1>расширенные настройки парольной защиты и безопасности</td></tr>' .
                '<tr><td class=par_val1>текстовый дисплей может быть предварительно настроен с двумя языками</td></tr>' .
                '<tr><td class=par_val1>встроенный стандартный высокочастотный счетчик (250 кГц на вход, всего 1000 кГц)</td></tr>' .
                '<tr><td class=par_val1>защита карты памяти от копирования и установка пароля </td></tr>' .
                '<tr><td class=par_val1>непосредственное подключение кодировщика и мультидатчиков</td></tr>' .
                '<tr><td class=par_val1>встроенный драйвер шагового двигателя (требуется непосредственное подключение)</td></tr>' .
                '<tr><td class=par_val1>функция логирования (на сменные micro-SD)</td></tr>' .
                '<tr><td class=par_val1>разнообразные шаблоны, текстовые шаблоны, прокрутка текста, графический блок, индикаторы</td></tr>' .
                '<tr><td class=par_val1>104 FBD интегрированные функции, 97 LD встроенные функции</td></tr>' .
                '<tr><td class=par_val1>функция астрономических часов</td></tr>' .
                '<tr><td class=par_val1>функция цифрового осциллографа в реальном времени </td></tr>' .
                '<tr><td class=par_val1>функции высшей математики</td></tr>' .
                '<tr><td class=par_val1>присвоение имен блокам, комментарии к программе</td></tr>' .
                '<tr><td class=par_val1>пользовательская таблица истинности (без логического анализа)</td></tr>' .
                '<tr><td class=par_val1>множественная функция коммуникационных параметров</td></tr>' .
                '<tr><td class=par_val1>быстрый расчет нелинейных уравнений</td></tr>' .
                '<tr><td class=par_val1>генератор случайных чисел</td></tr>';
    };

    if (($r->model == 'A-52x')) {
        $sp_data1 .= '<tr><td class=par_val1>двунаправленный передатчик A-3288 с улучшенной функцией текстовых сообщений, возможностью редактирования программы контроллера и непосредственного изменения параметров, режимом ожидания</td></tr>' .
                '<tr><td class=par_val1>подключение к точке доступа Wi-Fi, также поддержка режимов Station и Ad-hoc; WPA2-PSK(AES); связь посредством Internet Of Things (IOT), удаленное управление</td></tr>' .
                '<tr><td class=par_val1>возможность установки Wi-Fi как 3-х портового шлюза / сервера последовательных портов  Modbus</td></tr>' .
                '<tr><td class=par_val1>регулируемая мощность передачи</td></tr>' .
                '<tr><td class=par_val1>взаимообмен данными между контроллерами</td></tr>' .
                '<tr><td class=par_val1>мониторинг посредством Microsoft IE и Google Chrome</td></tr>' .
                '<tr><td class=par_val1>возможность использования как контроллер и как модуль ( Master / Slave )</td></tr>';
    };

    if ((preg_match('/A-2/i', $r->model)) OR ( preg_match('/A-118/i', $r->model))) {
        if (preg_match('/A-2/i', $r->model)) {

            $points = '4000';
        } else {
            $points = '10000';
        };
        $sp_data1 .= '<tr><td class=par_name1 rowspan=8>Функциональные возможности</td>' . $us_tr_l1 .
                'FBD и LD системы</td></tr>' .
                '<tr><td class=par_val1>вывод информации на дисплей (108x64)</td></tr>' .
                '<tr><td class=par_val1>парольная защита </td></tr>' .
                '<tr><td class=par_val1>36 встроенных функций, функции предварительного тестирования</td></tr>' .
                '<tr><td class=par_val1>возможна связь до 1024 функциональных блоков</td></tr>' .
                '<tr><td class=par_val1>логирование </td></tr>' .
                '<tr><td class=par_val1>полная поддержка Modbus-протокола</td></tr>' .
                '<tr><td class=par_val1>расширяемость до ' . $points . ' точек</td></tr>';
    };

    if (($r->brand == 'Yottacontrol') AND ( $r->series == 'A-10x')) {

        $sp_data1 .= '<tr><td class=par_name1>Радиус действия</td>' . $us_tr_l1 . 'до 100 метров от контроллера</td></tr>' .
                '<tr><td class=par_name1 rowspan=4>Функциональные возможности</td>' . $us_tr_l1 .
                'работает со всеми поставляемыми контроллерами ' . $r->brand . '</td></tr>' .
                '<tr><td class=par_val1>парольная защита </td></tr>' .
                '<tr><td class=par_val1>двойной сторожевой таймер </td></tr>' .
                '<tr><td class=par_val1>индикатор пониженного напряжения питания </td></tr>';
    };

    if (($r->brand == 'Yottacontrol') AND ( ($r->series == 'A-12x') OR ( $r->series == 'A-18x'))) {

        $sp_data1 .= '<tr><td class=par_name1 rowspan=4>Функциональные возможности</td>' . $us_tr_l1 .
                'работает со всеми поставляемыми контроллерами ' . $r->brand . '</td></tr>' .
                '<tr><td class=par_val1>парольная защита </td></tr>' .
                '<tr><td class=par_val1>двойной сторожевой таймер </td></tr>' .
                '<tr><td class=par_val1>индикатор пониженного напряжения питания </td></tr>';
    };

    if ($r->transistor == '1') {
        if ($row[pnp] == '1')
            $a = ' PNP-';
        elseif ($row[npn] == '1')
            $a = ' NPN-';
        else
            $a = '';
        $o_ch = '100 кГц (транзисторный ' . $a . 'выход)';
    } else {
        if ($row[relay_power] == '1')
            $a = 'силовое ';
        else
            $a = '';
        $o_ch = '30 Гц (' . $a . 'реле)';
    };

    if (($r->brand == 'Yottacontrol') AND ( $r->type == 'controller')) {
        $sp_data1 .= //$us_tr_l.'Дата-кабель</td>'.$us_tr_l1.'mini-USB (60см), RS-485 или RS-232</td></tr>'.
                $us_tr_l . 'Максимальная частота на выходе</td>' . $us_tr_l1 . $o_ch . '</td></tr>' .
                $us_tr_l . 'Максимальная частота на входе</td>' . $us_tr_l1 . '250 кГц (всего 1000 кГц)</td></tr>';
    };


    if (($r->brand == 'Yottacontrol') AND ( $r->type == 'module')) {
        $sp_data1 .= $us_tr_l . 'Максимальная частота на выходе</td>' . $us_tr_l1 . 'реле / транзистор — 10 Гц </td></tr>' .
                $us_tr_l . 'Максимальная частота на входе</td>' . $us_tr_l1 . '10 Гц</td></tr>';
    };
    if ($r->input_impedance != '') {
        $input_impedance = $us_tr_l . 'Входное сопротивление</td>' . $us_tr_l1 . '' . $r->input_impedance . '</td></tr>';
    };
    if ($r->input_accuracy != '') {
        $input_accuracy = $us_tr_l . 'Входная точность</td>' . $us_tr_l1 . '' . $r->input_accuracy . '</td></tr>';
    };
    if ($r->sampling_rate != '') {
        $sampling_rate = $us_tr_l . 'Частота замера</td>' . $us_tr_l1 . '' . $r->sampling_rate . '</td></tr>';
    };
    if ($r->temperature_ranges != '') {
        $temperature_ranges = $us_tr_l . 'Диапазоны температур</td>' . $us_tr_l1 . '' . $r->temperature_ranges . '</td></tr>';
    };
    if (($r->baud_rate != '')) {
        $sp_data1 .= $us_tr_l . 'Скорость передачи данных</td>' . $us_tr_l1 . $r->baud_rate . '</td></tr>';
    };


    $sp_data1 .= $input_impedance . $input_accuracy . $sampling_rate . $temperature_ranges;

    $sp_data1 .= '</table><br><br>';




// $modbus="RTU, ASCII, Master, Slave";
// if($r->ethernet!="") $modbus.=", TCP/IP";
// $modbus=$us_tr_l.'Поддержка Modbus'.$us_tr_l1.$modbus.'</td></tr>';
    if ($r->os != "")
        $modbus = "";

    //$mpi=$us_tr_l.'Поддержка MPI'.$us_tr_l1.'187,5 K</td></tr>';
    if ($r->os != "")
        $mpi = "";

    if (!empty($r->rgb)) {
        $rgb = $us_tr_l . 'RGB видеосигнал</td>' . $us_tr_l1 . $r->rgb . '</td></tr>';
    } else {
        $rgb = '';
    };
    if (!empty($r->dc_input)) {
        $dc_input = $us_tr_l . 'DC вход</td>' . $us_tr_l1 . $r->dc_input . '</td></tr>';
    } else {
        $dc_input = '';
    };
    if (!empty($r->av_input)) {
        $av_input = $us_tr_l . 'AV вход</td>' . $us_tr_l1 . $r->av_input . '</td></tr>';
    } else {
        $av_input = '';
    };
    if (!empty($r->dvi_d)) {
        $dvi_d = $us_tr_l . 'DVI-D сигнал</td>' . $us_tr_l1 . $r->dvi_d . '</td></tr>';
    } else {
        $dvi_d = '';
    };
    if (!empty($r->ts_rs232)) {
        $ts_rs232 = $us_tr_l . 'RS232 сенсорного экрана</td>' . $us_tr_l1 . $r->ts_rs232 . '</td></tr>';
    } else {
        $ts_rs232 = '';
    };
    if (!empty($r->ts_usb)) {
        $ts_usb = $us_tr_l . 'USB сенсорного экрана</td>' . $us_tr_l1 . $r->ts_usb . '</td></tr>';
    } else {
        $ts_usb = '';
    };
    if (!empty($r->s_video)) {
        $s_video = $us_tr_l . 'S-Video сигнал</td>' . $us_tr_l1 . $r->s_video . '</td></tr>';
    } else {
        $s_video = '';
    };
    if (!empty($r->ethernet_full)) {
        $ethernet_full = $us_tr_l . 'Ethernet</td>' . $us_tr_l1 . $r->ethernet_full . '</td></tr>';
    } elseif
    ((!empty($r->ethernet)) AND ( $r->ethernets != 0)) {
        $ethernet_full = $us_tr_l . 'Ethernet</td>' . $us_tr_l1 . $r->ethernet . '</td></tr>';
    } else {
        $ethernet_full = '';
    };
    if (!empty($r->serial_full)) {
        $serial_full = $us_tr_l . 'Последовательный интерфейс</td>' . $us_tr_l1 . $r->serial_full . '</td></tr>';
    } else {
        $serial_full = '';
    };
    if (!empty($r->usb_host)) {
        $usb_host = $us_tr_l . 'USB хост</td>' . $us_tr_l1 . $r->usb_host . '</td></tr>';
    } else {
        $usb_host = '';
    };
    if (!empty($r->usb_client)) {
        $usb_client = $us_tr_l . 'USB клиент</td>' . $us_tr_l1 . $r->usb_client . '</td></tr>';
    } else {
        $usb_client = '';
    };
    if (!empty($r->serial)) {
        $serial = $us_tr_l . 'Последовательный порт</td>' . $us_tr_l1 . $r->serial . ' ' . $r->serial_full . '</td></tr>';
    } else {
        $serial = '';
    };
    if (!empty($r->parallel_port)) {
        $parallel_port = $us_tr_l . 'Парралельный порт</td>' . $us_tr_l1 . $r->parallel_port . '</td></tr>';
    } else {
        $parallel_port = '';
    };
    if (!empty($r->can_bus)) {
        $can_bus = $us_tr_l . 'CAN BUS</td>' . $us_tr_l1 . $r->can_bus . '</td></tr>';
    } else {
        $can_bus = '';
    };
    if (!empty($r->modbus_support)) {
        $modbus_support = $us_tr_l . 'Поддержка Modbus</td>' . $us_tr_l1 . $r->modbus_support . $r->modbus_comment . '</td></tr>';
    } else {
        $modbus_support = '';
    };
    if (!empty($r->video_input)) {
        $video_input = $us_tr_l . 'Видеовход</td>' . $us_tr_l1 . $r->video_input . '</td></tr>';
    } else {
        $video_input = '';
    };
    if (!empty($r->pci_slot)) {
        $pci_slot = $us_tr_l . 'Слот расширения PCI</td>' . $us_tr_l1 . $r->pci_slot . '</td></tr>';
    } else {
        $pci_slot = '';
    };
    if (!empty($ps2)) {
        $ps2 = $us_tr_l . 'PS/2</td>' . $us_tr_l1 . $ps2 . '</td></tr>';
    } else {
        $ps2 = '';
    };
    if (!empty($r->sdcard)) {
        if ($r->brand == 'Yottacontrol' AND $r->model != 'A-52x') {
            $sdadd = ', 1 слот (модификация с литерой &#0171;M&#0187; в названии)';
        }
        $sdcard = $us_tr_l . 'Слот карт памяти</td>' . $us_tr_l1 . $r->sdcard . $sdadd . '</td></tr>';
    } else {
        $sdcard = '';
    };
    if (!empty($r->mic_in)) {
        $mic_in = $us_tr_l . 'Микрофонный вход</td>' . $us_tr_l1 . $r->mic_in . '</td></tr>';
    } else {
        $mic_in = '';
    };
    if (!empty($r->linear_out)) {
        $linear_out = $us_tr_l . 'Линейный выход</td>' . $us_tr_l1 . $r->linear_out . '</td></tr>';
    } else {
        $linear_out = '';
    };
    if (!empty($r->speakers)) {
        $speakers = $us_tr_l . 'Динамики</td>' . $us_tr_l1 . $r->speakers . '</td></tr>';
    } else {
        $speakers = '';
    };
    if (!empty($r->vga_port)) {
        $vga_port = $us_tr_l . 'VGA порт</td>' . $us_tr_l1 . $r->vga_port . ' разъем</td></tr>';
    } else {
        $vga_port = '';
    };
    if (!empty($r->audio)) {
        $audio = $us_tr_l . 'Аудио порт</td>' . $us_tr_l1 . $r->audio . ' разъем</td></tr>';
    } else {
        $audio = '';
    };
    if (!empty($r->wifi)) {
        $wifi = $us_tr_l . 'Wi-Fi</td>' . $us_tr_l1 . $r->wifi . '</td></tr>';
    } else {
        $wifi = '';
    };
//if (!empty($r->voltage)) {$voltage = $us_tr_l.'DC Power вход</td>'.$us_tr_l1.''.$r->voltage_min .'-'.$r->voltage_max  .' VDC</td></tr>';} else {$voltage='';};
    $interfaces = $ethernet_full . $serial_full . $usb_host . $usb_client . $serial . $parallel_port . $can_bus . $video_input . $vga_port . $pci_slot . $ps2 . $sdcard . $mic_in . $linear_out .
            $speakers . $audio . $rgb . $dc_input . $av_input . $dvi_d . $ts_rs232 . $ts_usb . $s_video . $wifi . $voltage;


    if (!empty($r->case_material)) {
        $case_material = $us_tr_l . 'Материал корпуса</td>' . $us_tr_l1 . $r->case_material . '</td></tr>';
    } else {
        $case_material = '';
    };
    if (!empty($r->front_ip)) {
        $front_ip = $us_tr_l . 'Степерь защиты лицевой панели </td>' . $us_tr_l1 . $r->front_ip . '</td></tr>';
    } else {
        $front_ip = '';
    };
    if (!empty($r->degree_of_protection)) {
        $degree_of_protection = $us_tr_l . 'Степерь защиты</td>' . $us_tr_l1 . $r->degree_of_protection . '</td></tr>';
    } else {
        $degree_of_protection = '';
    };
    if (empty($r->cpu_fan)) {
        $fan = $us_tr_l . 'Охлаждение</td>' . $us_tr_l1 . 'безвентиляторное</td></tr>';
    } else {
        $fan = $us_tr_l . 'Охлаждение</td>' . $us_tr_l1 . 'вентилятор</td></tr>';
    };
    if (!empty($mount)) {
        $mount = $us_tr_l . 'Крепление</td>' . $us_tr_l1 . $mount . '</td></tr>';
    } else {
        $mount = '';
    };
    if (!empty($r->cutout)) {
        $cutout = $us_tr_l . 'Посадочное отверстие</td>' . $us_tr_l1 . $r->cutout . ' мм</td></tr>';
    } else {
        $cutout = '';
    };
    if (!empty($r->dimentions)) {
        $dimentions = $us_tr_l . 'Габариты</td>' . $us_tr_l1 . $r->dimentions . ' мм</td></tr>';
    } else {
        $dimentions = '';
    };
    if (!empty($r->power_connector)) {
        $power_connector = $us_tr_l . 'Разъем питания</td>' . $us_tr_l1 . $r->power_connector . '</td></tr>';
    } else {
        $power_connector = '';
    };
    if (!empty($r->netto)) {
        $netto = $us_tr_l . 'Вес (нетто / брутто)</td>' . $us_tr_l1 . $r->netto . ' / ' . $r->weight . ' кг</td></tr>';
    } else {
        $netto = '';
    };
    if (!empty($r->set)) {
        $set = $us_tr_l . 'Комплект поставки ' . $us_tr_l1 . $r->set . '</td></tr>';
    } else {
        $set = '';
    };
    $Design = $case_material . $dimentions . $cutout . $fan . $front_ip . $degree_of_protection . $mount . $power_connector . $netto . $set;




//if ($r->DI_isol == '1') {$diisol = ' изолированные';};
    if ($r->DI_full != '') {

        $di = $us_tr_l . 'Дискретные входы</td>' . $us_tr_l1 . '' . $r->DI_full . $diisol . '</td></tr>';
    } else
    if ($r->DI > 0) {

        $di = $us_tr_l . 'Дискретные входы</td>' . $us_tr_l1 . '' . $r->DI . 'DI' . $diisol . '</td></tr>';
    };

//if ($r->DO_isol == '1') {$doisol = ', изолированные';}

    if ($r->DO_full != '') {

        $do = $us_tr_l . 'Дискретные выходы</td>' . $us_tr_l1 . '' . $r->DO_full . $doisol . '</td></tr>';
    } elseif ($r->DO > '0') {
        if (($r->pnp == 1) AND ( $r->pnp == 1)) {
            $pnpn = ' ( подключение PNP и NPN устройств ) ';
        } elseif ($r->pnp == 1) {
            $pnpn = ' ( подключение PNP устройств ) ';
        } elseif ($r->npn == 1) {
            $pnpn = ' ( подключение NPN устройств ) ';
        };
        $do = $us_tr_l . 'Дискретные выходы</td>' . $us_tr_l1 . '' . $r->DO . '' . $pnpn . '' . $doisol . '</td></tr>';
    };



    if ($r->AI_full != '') {
        $ai = $us_tr_l . 'Аналоговые входы</td>' . $us_tr_l1 . '' . $r->AI_full . '</td></tr>';
    } else
    if ($r->AI > 0) {

        $ai = $us_tr_l . 'Аналоговые входы</td>' . $us_tr_l1 . '' . $r->AI . 'AI</td></tr>';
    };

    if ($r->AO_full != '') {
        $ao = $us_tr_l . 'Аналоговые выходы</td>' . $us_tr_l1 . '' . $r->AO_full . '</td></tr>';
    } else
    if ($r->AO > 0) {
        $ao = $us_tr_l . 'Аналоговые выходы</td>' . $us_tr_l1 . '' . $r->AO . 'AI</td></tr>';
    };


    if (preg_match('/-T/i', $r->model)) {
        $t_r = 'транзисторный';
    } else {
        $t_r = 'релейный';
    };




    $sp_data1 .= '<span class=hpar>Интерфейсы</span><br>' .
            $table_start .
            $di . $do . $ai . $ao .
            $interfaces;

    $sp_data1 .= '</table><br><br>';



    $sp_data1 .= '<span class=hpar>Конструкция</span><br>' . $table_start . $Design . '</table><br><br>';




    // if(($r->os!="") or ($r->type !='monitor')) {
    if ($r->software != '') {
        $sp_data1 .= "<span class=hpar>ПO</span><br>";
        $sp_data1 .= $table_start;

        $sp_data1 .= $us_tr_l . 'ПО</td>' . $us_tr_l1 . 'Бесплатное: <span style="text-decoration:underline;cursor:pointer;" onclick="doclick(\'tabs-4\')">' . $r->software . $r->software_comment . '</td></tr>';


        $sp_data1 .= "</table><br><br>";
    };
//};
    if (!empty($r->temp_operating)) {
        $tempo = $us_tr_l . 'Рабочая температура</td>' . $us_tr_l1 . $r->temp_operating . ' &#8451;</td></tr>';
    };
    if (!empty($r->vibration)) {
        $vibr = $us_tr_l . 'Вибрация</td>' . $us_tr_l1 . $r->vibration . '</td></tr>';
    };
    if (!empty($r->shock)) {
        $shok = $us_tr_l . 'Шоковая нагрузка</td>' . $us_tr_l1 . $r->shock . '</td></tr>';
    };

    if (!empty($r->power_adapter)) {
        $powero = $us_tr_l . 'Питание</td>' . $us_tr_l1 . $r->power_adapter . '</td></tr>';
    };
    if (!empty($r->temp_storage)) {
        $tempsto = $us_tr_l . 'Температура хранения</td>' . $us_tr_l1 . $r->temp_storage . '</td></tr>';
    };
    if (!empty($r->humidity)) {
        $hum = $us_tr_l . 'Влажность при хранении</td>' . $us_tr_l1 . $r->humidity . '</td></tr>';
    };


//if (!empty($r->current)) {$current = $us_tr_l.'Потребляемый ток</td>'.$us_tr_l1.$r->current.'A';};

    $expluatation = $tempo . $vibr . $shok . $tempsto . $hum;




    $sp_data1 .= '<span class=hpar>Эксплуатация и хранение</span><br>' .
            $table_start . $powero;

    if (($r->brand == 'Yottacontrol') AND ( $r->type == 'controller')) {
        $sp_data1 .= $us_tr_l . 'Защита</td>' . $us_tr_l1 . 'от перегрузки по току, перегрева; снижения выходного напряжения</td></tr>';
    };
    if (($r->brand == 'Yottacontrol') AND ( $r->type == 'module')) {
        $sp_data1 .= $us_tr_l . 'Защита</td>' . $us_tr_l1 . 'от скачков напряжения, быстрых электрических переходных процессов, статического электричества</td></tr>';
    };







    if (($r->brand == 'Yottacontrol') AND ( $r->type == 'module')) {
        $sp_data1 .= $us_tr_l . 'Сопротивление изоляции</td>' . $us_tr_l1 . '5000VDC</td></tr>';
    };


    $sp_data1 .= $current . $expluatation;



    $sp_data1 .= '</table><br><br>';

// $sp_data1.=  "</table></div><br><br>";
    //$sp_data1.= '</div>';
//---------------------end tab1 -------------------------
//-------------spec ---------------------------

    $imagepath = 'images/controllers/' . strtolower($r->brand) . '/dim';
    $default_imagepath = 'images/controllers/' . strtolower($r->brand) . '/dim/default';
    $dimensions = '';
    $queryd = "SELECT * FROM `dimensions_controllers` WHERE `model`='{$r->model}' AND `img_path`<>'' LIMIT 1;";

    $queryd = mysql_query($queryd) or die("ошибка запроса0213" . $queryd);
    $jd = mysql_num_rows($queryd);
    if ($jd > 0) {
        $rowd = mysql_fetch_assoc($queryd);
        if (!empty($rowd[img_path])) {
            $dimensions = '<center><img style="max-width:955px;" src="/images/controllers' . $rowd[path] . '/' . $rowd[img_path] . '"></center>';
        };
    };

    if (empty($dimensions)) {

        if ($GLOBALS["net"] == 0) {

            if (file_exists($GLOBALS["path_to_real_files"] . '/' . $imagepath . '/' . $r->model . '.png')) {
                $dimensions = '<center><img  style="max-width:955px;" src="/' . $imagepath . '/' . $r->model . '.png"></center>';
            } elseif (file_exists($GLOBALS["path_to_real_files"] . '/' . $default_imagepath . '/' . $r->series . '.png')) {
                $dimensions = '<center><img style="max-width:955px;" src="/' . $default_imagepath . '/' . $r->series . '.png"></center>';
            };
        } else {
            $re = cu($GLOBALS["path_to_real_files"] . '/' . $imagepath . '/' . $r->model . '.png');
            if ($re[0] > 0) {
                $dimensions = '<center><img style="max-width:955px;" src="/' . $imagepath . '/' . $r->model . '.png"></center>';
            } else {
                $re = cu($GLOBALS["path_to_real_files"] . '/' . $default_imagepath . '/' . $r->series . '.png');
                if ($re[0] > 0) {
                    $dimensions = '<center><img style="max-width:955px;" src="/' . $default_imagepath . '/' . $r->series . '.png"></center>';
                } else {
                    $dimensions = '';
                };
            };
        };
    };



    if ($r->brand == 'Yottacontrol') {
        if (preg_match('/61/', $r->model)) {
            $scheme = '
<div style="float:left;width:540px;">
<h3>Подключение NPN и PNP датчиков<br />и AC ко входам </h3>	<br /><br />
<img src="/images/controllers/yottacontrol/A-61-inputs.png" style="width:540px;">
</div>
<div style="float:left;width:363px;">
<h3>Подключение устройств к транзисторным и релейным выходам</h3>	<br /><br />
<img src="/images/controllers/yottacontrol/A-61-outputs.png"  style="width:363px;">
<br /><br /><br /></div>';
        } else if (preg_match('/A-2/', $r->model)) {
            $scheme = '
<div style="float:left;width:897px;">
<img src="/images/controllers/yottacontrol/' . $r->parent . '-contacts_1.png" style="max-width:897px;">
</div>';
        } else if ((($r->type == 'controller') OR ( $r->type == 'module')) AND ( $r->series != 'A-118')) {
            $scheme = '
<div style="float:left;width:445px;">
<h3>Подключение NPN и PNP датчиков<br />ко входам </h3>	<br /><br />
<img src="/images/controllers/yottacontrol/A-51-inputs.png" style="width:400px;">
</div>
<div style="float:left;width:445px;">
<h3>Подключение устройств<br />к транзисторным и релейным выходам</h3>	<br /><br />
<img src="/images/controllers/yottacontrol/A-51-outputs.png"  style="width:400px;">
<br /><br /><br /></div>';
        };

        $parent_modul = str_replace('x', '', $r->parent);

        if ((($r->type == 'controller') AND ( $r->series != 'A-118')) OR ( $r->model == 'A-2060')) {
            $scheme .= '<h3>Контакты контроллеров ' . $r->parent . '</h3><br /><br />';
            if (preg_match('/518/', $r->model)) {

                $scheme .= '<div style="position:absolute;padding-top: 134px;  color: blue;
  width: 897px;">
<div style="  float: left;
  margin-left: 133px;">
<span class="">' . $parent_modul . '</span>&nbsp;&#903;&nbsp;<span class="">' . $parent_modul . 'D</span>&nbsp;&#903;&nbsp;<span class="">' . $parent_modul . 'M</span></div>
<div style="  margin-left: 179px;
  float: left;">
<span class="">' . $parent_modul . '-T</span>&nbsp;&#903;&nbsp;<span class="">' . $parent_modul . 'D-T</span>&nbsp;&#903;&nbsp;<span class="">' . $parent_modul . 'M-T</span></div>
</div>';
            };
            $scheme .= '<img src="/images/controllers/yottacontrol/' . $r->parent . '-contacts.png"  style="max-width:897px;">';
        };
        if ($r->series == 'A-118') {
            $scheme .= '<img src="/images/controllers/yottacontrol/' . $r->parent . '-contacts.png"  style="max-width:897px;">';
        };
    };
    if ($r->series == 'iR') {

        $scheme .= '<img src="/images/controllers/weintek/contacts/' . $r->model . '.png"  style="max-width:897px;"><br /><br />';
    };


    $komplect = '';
    if (($r->brand == 'Yottacontrol') AND ( $r->type == 'controller')) {
        $komplect = '<li class="urlup" data="accessories"><a href="#tabs-5">КОМПЛЕКТУЮЩИЕ</a></li>';
    };
    if (($r->type == 'coupler') OR ( $r->type == 'module')) {
        $sxemy = "<li class='urlup' data='scheme'><a href='#tabs-3'>СХЕМЫ</a></li>";
    };
    $vyvod = '<br><br>
<div style="width:1100px; min-height: 500px; overflow: auto; text-align:left;">
<div id="tabs">
  <ul>
    <li class="urlup" data="functions"><a href="#tabs-1">ХАРАКТЕРИСТИКИ</a></li>
    <li class="urlup" data="dimensions"><a href="#tabs-2">ГАБАРИТЫ</a></li>
    ' . $sxemy . '
    <li class="urlup" data="software"><a href="#tabs-4">СКАЧАТЬ</a></li>
	' . $komplect . '
  </ul>
  <div id="tabs-1">
  <h2>Технические характеристики ' . $types1 . ' ' . $r->model . '</h2>'
            . $r->features . '

  </div>
  <div id="tabs-2"><h2>Габариты ' . $types1 . ' ' . $r->model . '</h2>
  ' . $dimensions . '<br /><br />
  </div>';


    if (!empty($scheme)) {

        $vyvod .= '<div id="tabs-3">
  <div class=connectors>
  <h2>Схема соединения ' . $types1 . ' ' . $r->model . '</h2>' . $scheme . '
  </div></div>
  ';
    };
    // echo  $vyvod.show_com_connector($r->model).'</div>';

    $prices_out .= $vyvod;

    if (!empty($_GET[tab])) {
        if ($_GET[tab] == 'accessories') {
            $uuu = '$(\'a[href="#tabs-5"]\').click();';
        } else if ($_GET[tab] == 'functions') {
            $uuu = '$(\'a[href="#tabs-1"]\').click();';
        } else if ($_GET[tab] == 'software') {
            $uuu = '$(\'a[href="#tabs-4"]\').click();';
        } else if ($_GET[tab] == 'dimensions') {
            $uuu = '$(\'a[href="#tabs-2"]\').click();';
        } else if ($_GET[tab] == 'scheme') {
            $uuu = '$(\'a[href="#tabs-3"]\').click();';
        };
    };

    $prices_out .= "
<script>
	$(document).ready(function(){
var urlbase = '$CANONICAL';
	$uuu
 $('.urlup').click(function() {
	 var dat = $(this).attr('data');
var nnew = 'https://'+location.hostname+urlbase+'?tab='+dat;

  if(nnew != window.location){
            window.history.pushState(null, null, nnew);
        }

	});

	});

function doclick(e) {

$('a[href=#'+e+']').click();

}
</script>";


    //---------------------download section -------------------------------- ------------------------------

    $usb = "";



    if ($r->software != "") {

    }


//$file = '/home/weblec/public_html/test_weinteknet/drivers';

    if (!empty($r->brochure)) {
        $brochure = $r->brochure;
    } else {
        $brochure = $r->model . '.pdf';
    };

    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . 'manuals/' . $brochure)) {
            $ine = 1;
            $fs = (sprintf("%u", filesize($root_php . 'manuals/' . $brochure)) + 0) / 1000;
            $t = date("d-m-Y", filemtime($root_php . 'manuals/' . $brochure));
        } elseif (file_exists($root_php . '' . strtolower($r->brand) . '/manuals/' . $brochure)) {
            $ine = 2;
            $fs = (sprintf("%u", filesize($root_php . '' . strtolower($r->brand) . '/manuals/' . $brochure)) + 0) / 1000;
            $t = date("d-m-Y", filemtime($root_php . '' . strtolower($r->brand) . '/manuals/' . $brochure));
        } else {
            $ine = 0;
        };
    } else {
        $re = cu($root_php . '/manuals/' . $brochure);
        $re1 = cu($root_php . '/' . strtolower($r->brand) . '/manuals/' . $brochure);
        if ($re[0] > 0) {
            $ine = 1;
            $t = date("d-m-Y", $re[1]);
            $fs = (sprintf("%u", $re[0]) + 0) / 1000;
        } elseif ($re1[0] > 0) {
            $ine = 2;
            $t = date("d-m-Y", $re1[1]);
            $fs = (sprintf("%u", $re1[0]) + 0) / 1000;
        } else {
            $ine = 0;
        };
    };
    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    if ($ine == 1) {
        if ($r->brochure_text) {
            $brochure_text = $r->brochure_text;
        } else {
            $brochure_text = "Брошюра на $types $r->model";
        }
        $soft5 = "
 <tr><td><div class=down_item> $brochure_text </div></td>
   <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
   <td><div class=down_item><a href='/manuals/$brochure'><img src=/images/manual.jpg></a></div></td></tr>
 ";
    } elseif ($ine == 2) {
        //  $fs = (sprintf("%u", filesize($root_php.''.strtolower($r->brand).'/manuals/'.$r->model.'.pdf'))+0)/1000;
//$s =  ceil($fs/1000);
//$s =  round($fs/1000, 2);
        $soft5 = "
 <tr><td><div class=down_item> Брошюра на $types $r->model </div></td>
   <td><div class=dt_item>" . $t . "<br />(eng)<br />" . $s . "</div></td>
   <td><div class=down_item><a href='/'.strtolower($r->brand).'/manuals/$r->model.pdf'><img src=/images/manual.jpg></a></div></td></tr>
 ";
    } else {
        $soft5 = '';
    };


    if (preg_match('/iR-/i', $r->model)) {
        $viewerPath = 'manuals/Remote_IO_Product_Specification.pdf';

        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $viewerPath)) {
                $fs = (sprintf("%u", filesize($root_php . $viewerPath)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $viewerPath));
            };
        } else {
            $re = cu($root_php . '/' . $viewerPath);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            };
        };

        if ($fs > 1000) {
            $s = round($fs / 1000, 2) . '&nbsp;Мб';
        } else {
            $s = round($fs, 0) . '&nbsp;Кб';
        };

        $soft20 = "
	 <tr><td><div class=down_item>Брошюра с описанием системы дистанционного ввода-вывода Weintek Remote I/O</div></td>
	 <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>
	 <td><div class=down_item><a href='/$viewerPath'><img src=/images/manual.jpg></a></div></td></tr>
	 ";
    };





    if (preg_match('/^(iR-.*?|A-10|A-12|A-18).*?/i', $r->model)) {


        $softName = 'Руководство по настройке и эксплуатации ' . $types1 . ' ' . $r->model;
        $ver = '';

        $so = "/manuals/{$r->model}_DataSheet.pdf";



        if ($GLOBALS["net"] == 0) {


            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        } else {


            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        };




        if ($fsso > 1000) {
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
        } else {
            $sso = round($fsso, 0) . '&nbsp;Кб';
        };


        $soft7 = "
 <tr><td><div class=down_item style='  font-weight: normal;'> <strong>$softName</strong></div></td>
   <td><div class=dt_item>" . $tso . "<br>(eng)<br />" . $sso . "</div></td>
   <td><div class=down_item><a href='" . $so . "'><img src=/images/manual.jpg></a></div></td></tr>
 ";
    }


    if (preg_match('/^A-10[56].*?/i', $r->model)) {


        $softName = 'Коды Modbus ' . $types1 . ' ' . $r->model;
        $ver = '';

        $so = '/manuals/Yottacontrol-A-105-106-modbus-codes.pdf';



        if ($GLOBALS["net"] == 0) {


            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        } else {


            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        };




        if ($fsso > 1000) {
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
        } else {
            $sso = round($fsso, 0) . '&nbsp;Кб';
        };


        $soft8 = "
 <tr><td><div class=down_item style='  font-weight: normal;'> <strong>$softName</strong></div></td>
   <td><div class=dt_item>" . $tso . "<br>(eng)<br />" . $sso . "</div></td>
   <td><div class=down_item><a href='" . $so . "'><img src=/images/manual.jpg></a></div></td></tr>
 ";
    }


    if (preg_match('/^A-101.*?/i', $r->model)) {


        $softName = 'Спецификация ' . $types1 . ' ' . $r->model;
        $ver = '';

        $so = '/manuals/Yottacontrol-A-101-features.pdf';



        if ($GLOBALS["net"] == 0) {


            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
        } else {


            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
        };




        if ($fsso > 1000) {
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
        } else {
            $sso = round($fsso, 0) . '&nbsp;Кб';
        };


        $soft8 = "
 <tr><td><div class=down_item style='  font-weight: normal;'> <strong>$softName</strong></div></td>
   <td><div class=dt_item>" . $tso . "<br>(eng)<br />" . $sso . "</div></td>
   <td><div class=down_item><a href='" . $so . "'><img src=/images/manual.jpg></a></div></td></tr>
 ";
    }


    /*     * *************************************************************************** */

    if (true) {

        if ($GLOBALS["net"] == 0) {

            if (file_exists($GLOBALS["EBPro_version"])) {
                $ver = file_get_contents($GLOBALS["EBPro_version"]);
            };
            $so = $GLOBALS["EBPro_link"];
            $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
            $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
            $ma = $GLOBALS["EBPro_manual_link"];
            $tma = date("d-m-Y", filemtime($path_to_real_files . $ma));
            $fsma = (sprintf("%u", filesize($path_to_real_files . $ma)) + 0) / 1000;
        } else {
            //  $re = cu($GLOBALS["EBPro_version"]);

            $ver = cu_content($GLOBALS["EBPro_version"]);
            $so = $GLOBALS["EBPro_link"];
            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
            $ma = $GLOBALS["EBPro_manual_link"];
            $re2 = cu($path_to_real_files . $ma);
            $tma = date("d-m-Y", $re2[1]);
            $fsma = (sprintf("%u", $re2[0]) + 0) / 1000;
        };



        $soft_EBPRO_1 = " <tr><td><div class=down_item>  Программное обеспечение $r->software $ver</div>
   <div class=down_item_descr> Программное обеспечение $r->software применяется для создания пользовательских проектов для операторских панелей Weintek<br>
   Использование ПО $r->software полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.
   $usb
   </div></td>
   <td><div class=dt_item>" . $tso . "<br>(рус)<br />" . $sso . "</div>
   </td> </td><td><div class=down_item><a href='$so'><img src=/images/soft.jpg></a><div> </td> </tr>";

        $soft_EBPRO_2 = "<tr><td><div class=down_item>  Руководство к ПО $r->software  </div></td>
   <td><div class=dt_item>" . $tma . "<br>(eng)<br />" . $sma . "</div></td>
   <td><div class=down_item><a href='$ma'><img src=/images/manual.jpg></a></div></td></tr> ";


        $update_date_file_path = "http://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/update_date.txt";
        $update_date = strip_tags(file_get_contents($update_date_file_path));
        $soft_EBPRO_2_2 = "<tr><td><div class=down_item>Онлайн руководство пользователя EasyBuilder Pro V6.00.01 на английском языке</div></td>
   <td><div class=dt_item>$update_date</div></td>
   <td><div class=down_item><a href='/weintek-easybuilderpro-user-manual-en/'><img src='/images/link-external-big.png'></a></div></td></tr>";

        $soft_EBPRO_3 = "<tr><td><div class=down_item> Руководство по подключению контроллеров (PLC) к  панели оператора $r->model </div>
   <div class=down_item_descr> В руководстве описано подключение к более, чем 100 PLC различных производителей,
   даны схемы распайки кабелей для подключения панели оператора $r->model к этим PLC, описаны регистры, к которым дают доступ
   драйвера данных PLC. <br> Все драйверы для всех PLC, упомянутых в данном руководстве, уже установлены в операторской панели $r->model. <br>
   При подключении панели  оператора $r->model к конкретному PLC настоятельно рекомендуется ознакомиться с соответсвующим разделом данного руководства.
   </td>

   <td><div class=dt_item>" . $PLC_date . "<br>(eng)<br />" . $splc . "</div></td>
   <td><div class=down_item><a href='$PLC_connect_guide'><img src=/images/manual.jpg></a></div></td></tr>";
    }
    /*     * *************************************************************************** */




    $accessories = '
<div style="display:inline-block;margin-bottom:20px;  width: 100%;">
<h3>AMB128 — расширение карт памяти </h3>

<img src="/images/controllers/' . strtolower($r->brand) . '/A-controller-memory-card-AMB28.png" style="float:left;">

  <table id="" style="float:right;  width: 225px;  margin-top: 40px;">
  <tr>
<td style=""><br />Драйвера для PC</td>

  </tr>
    <tr>
<td style="font-weight: normal;">Windows 98 / ME / 2000 / XP / Vista / 7 / 8 /
Server 2008 / WinCE / Linux / MacDC </td>
  </tr>
    <tr>
<td><br />Габариты</td>
  </tr>
    <tr>
<td style="font-weight: normal;">25.7*39.7*16.8 мм</td>
  </tr>
  <tr>
<td><br />Рабочая температура</td>
  </tr>
  <tr>
<td style="font-weight: normal;">от -10 до +55 °C</td>
  </tr>
  <tr>
<td><br />Степень защиты</td>
  </tr>
  <tr>
<td style="font-weight: normal;">IP20</td>
  </tr>

  </table>

<img src="/images/controllers/' . strtolower($r->brand) . '/dim/A-controller-memory-card-AMB28.png" style=" width: 360px;  margin: auto;
  margin-top: 40px;
">
<p><br /><br />Устройство совместимо с PC (через USB-соединение) и PLC</p>
</div>
';
    /* $accessories .= '<div style="display:inline-block;margin-bottom:20px;  width: 100%;  margin-top: 20px;">
      <h3 style="  width: 575px;
      float: left;">ASPS — однофазный блок питания </h3>
      <img src="/images/controllers/'.strtolower($r->brand).'/ASPS.png" style="float:right;">

      <table id="amb128" class="mytab2" style="float:left;  width: 575px;  margin-top: 20px;">
      <tr><td>Питание</td>   <td style="font-weight: normal;">100/240 VAC</td>     </tr>
      <tr>	<td>Напряжение на выходе</td>   <td style="font-weight: normal;">24/48 VDC</td>    </tr>
      <tr>    <td>Ток (max) при 24VDC</td>  <td style="font-weight: normal;">2.0A</td>   </tr>
      <tr>  <td>Отклонение (max) выходного напряжения</td>    <td style="font-weight: normal;">-+8%</td>    </tr>
      <tr>    <td>Пульсация: </td>   <td style="font-weight: normal;">100 мВ</td>     </tr>
      <tr>    <td>Эффективность</td>   <td style="font-weight: normal;">> 75%</td>    </tr>
      <tr><td>Крепление</td>   <td style="font-weight: normal;">На DIN-рейку или скрытый монтаж</td>    </tr>
      <tr> <td>Габариты</td>  <td style="font-weight: normal;">73*90*60.3 мм</td>    </tr>
      <tr><td>Рабочая температура</td>  <td style="font-weight: normal;">от -10 до +55 °C</td>   </tr>
      <tr><td>Частота на входе</td>      <td style="font-weight: normal;">50 / 60 Гц</td>    </tr>
      <tr>  <td>Предохранитель</td>  <td style="font-weight: normal;">&#10004;</td>      </tr>
      <tr>  <td>Защита от перегрузки по току</td>  <td style="font-weight: normal;">&#10004;</td>    </tr>
      <tr>    <td>LED-индикатор питания</td>   <td style="font-weight: normal;">&#10004;</td>    </tr>
      </table>
      <style>
      #amb128 td { padding: 7px 7px 6px 7px;border: 1px dotted gray;}
      </style>
      </div>
      ';
     */

    $komplects = '';
    if (($r->brand == 'Yottacontrol') AND ( $r->type == 'controller')) {
        $komplects = '<div id="tabs-5">
  <div class=connectors>
  <h2>Комплектующие ' . $types1 . ' ' . $r->model . '</h2><br />' . $accessories . '
  </div></div>';
    };
    
    $arResult["element"]["files"] = get_products_files($r->model);
    ob_start();?>


    <div id='tabs-4'>
  <div class=connectors>
  <h2>Файлы для работы с <?=$types?>ом <?=$r->model?></h2>
  </div>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование</div></td><td width=100><div class=down_h>  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>
   <?
   echo $soft7;
   echo $soft5;
   echo $soft8;
   echo $soft20;

  softwares($r->software, $r->model, '0');
  
?>

   <?
                                foreach ($arResult["element"]["files"] as $file) {
                                    ?>

                                    <tr>

                                        <td class="text_align_left">
                                           <div class="down_item">
                                                       <?
                                                       echo $file["name"];
                                                       if ($file["language"])
                                                           echo " (" . $file["language"] . ")";
                                                       ?></div>
                                          
                                        </td>
                                        <td>
                                            <div class="dt_item">
                                                
                                            
                                            <?
                                            $prim = "";
                                            if ($file["type"])
                                                $prim .= ", " . $file["type"];
                                            if ($file["date"])
                                                $prim .= ", " . $file["date"];
                                            if ($file["size"])
                                                $prim .= ", " . $file["size"];
                                            echo $prim = substr($prim, 2);
                                            ?>
                                            </div>
                                        </td>
                                        <td  class="text_align_center">
                                         <?
                                         
                                         $format = new SplFileInfo($file["path"]);
                                         switch ($format->getExtension()) {
                                                case 'zip':
                                                    $format_img = '/images/soft.jpg';   
                                                    break;
                                                case 'pdf':
                                                    $format_img = '/images/manual.jpg';  
                                                    break;
                                            }
                                         ?>
                                            <div class=down_item><a href='<?= $file["path"] ?>'><img src="<?=$format_img?>"></a></div></td>
                                        </td>
                                    </tr>


                                    <?
                                }
                                
   echo $soft_EBPRO_1;
   echo $soft_EBPRO_2;
   echo $soft_EBPRO_2_2;
                                ?>
   
   </table>
   <br /> <br />
  </div>
<?=$komplects?>

</div><br /><br />
</div>
    <?
    
    $ob_result = ob_get_contents();
    ob_end_clean();
    $prices_out .=$ob_result;
    
    


    $prices_out .= "<br><br>";
//-----------------end content

    
    
    if(!empty($r->meta_title)){
        $TITLE = $r->meta_title;
    } else {
        $TITLE = $title;
    }
    
    if(!empty($r->meta_description)){
        $DESCRIPTION = $r->meta_description;
    } else {
        $DESCRIPTION = $description;
    }
    
    if(!empty($r->meta_keywords)){
        $KEYWORDS = $r->meta_keywords;
    } else {
        $KEYWORDS = $keywords;
    }  

    
    

    $out .= $prices_out;
} else {

    //header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/404.php');
};
?>