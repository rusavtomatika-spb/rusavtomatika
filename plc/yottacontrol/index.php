<?php
$start = microtime(true);
session_start();
define("bullshit", 1);

include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_controllers.php");


$section_setup = '.section.php';
if (file_exists($section_setup)) {
    include $section_setup;
}
database_connect();

//temp0("weintek");
//top_buttons();
//temp1_no_menu();
//show_price_val();
//basket();
//temp2();
//---------------content ---------------------
//add_to_basket();
//popup_messages();
$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);
//echo $_SERVER['QUERY_STRING'];
$CANONICAL = $var_to_array;
//var_dump($_SERVER);
//$var_to_array = str_replace("/index.php", "", $_SERVER['REQUEST_URI']);
$var_to_array = str_replace(".php", "", $var_to_array);
//echo $var_to_array;
if (preg_match('/\/$/i', $var_to_array)) {
    $var_to_array = substr($var_to_array, 0, -1);
};
//if (preg_match('/^\//i',$var_to_array)) {$var_to_array = substr($var_to_array, 1);	};
$var_array = explode("/", $var_to_array);
//var_dump($var_array);
$levels = count($var_array);
$levels = $levels - 1;

//echo $levels;
if ($levels == 2) {

    $out = '<div style="width:1150px;margin:auto;"><br><br><center><h1>ПЛК, PLC, программируемые логические контроллеры Yottacontrol, бюджетные контроллеры, со склада</h1></center>' . add_style();

    $DESCRIPTION = 'PLC, программируемые логические контроллеры управления (ПЛК) со склада по отличной цене. Модули. Расширяемость до 10000 точек. Большой выбор, в наличии на складе, доставка по России.';
    $KEYWORDS = 'контроллеры ПЛК, программируемые контроллеры, программируемые логические программируемые модули, управление PLC, PLC, Yottacontrol, официальный представитель';
    $TITLE = 'ПЛК, PLC, программируемые логические контроллеры Yottacontrol, бюджетные контроллеры, со склада';


//----------------------series 51

    $out .= show_controllers_yotta_a52_1();

//----------------------series 51

    $out .= show_controllers_yotta_a51_1();

//-----------------------18x-----------------------------

    $out .= show_controllers_yotta_a18x_1();

//-----------------------12x-----------------------------

    $out .= show_controllers_yotta_a12x_1();

//-----------------------10x-----------------------------

    $out .= show_controllers_yotta_a10x_1();

//-----------------------------------61 ---------------------------
//$out .= show_controllers_yotta_a61_1();
//----------------------------2 -------------------------------------
//$out .= show_controllers_yotta_a2_1();
//------------------------------1 -------------------------------------------
//$out .= show_controllers_yotta_a1();
//-----------------------------------52 ---------------------------
//$out .= show_controllers_yotta_a52_1();

    $out .= '<br /><br /><br />
<div style="width:90%;margin:auto;">
<div class="head_block"><h2 style="  color: rgb(89, 44, 44);text-shadow: 1px 1px 1px white;  font-size: 15px;">Характеристики ПЛК Yottacontrol</h2></div>
<h3>Программирование</h3><br />
Все PLC программируются с помощью <a href="/soft/Yottacontrol/YottaEdit.rar" download>бесплатного ПО YottaEditor (скачать)</a>.

<a rel="lightbox[2]" href="/images/controllers/yottacontrol/YottaEdit_screen.png"><img alt="Бесплатное ПО YottaEditor для программирования ПЛК Yottacontrol"  title="Бесплатное ПО YottaEditor для программирования ПЛК Yottacontrol" src="/images/controllers/yottacontrol/YottaEdit_screen.png" style="max-width: 185px;float:right;  margin-right: -6px;"></a><br /><br />

Документация по работе с редактором <a href="/manuals/YottaEditor.chm.zip" download>YottaEditor (скачать)</a>.<br /><br />

В контроллеры серии A-51 проект загружается по кабелю USB — miniUSB, на ПК нужно <a href="/soft/Yottacontrol/A5x_USB_driver.rar" download>установить драйвера (скачать)</a>,
также проект можно загрузить через любой COM-порт контроллера (способ загрузки выбирается в YottaEditor).<br /><br />


<br />

<a id="biglightbox" href="/images/controllers/yottacontrol/A-3016/lg/A-3016_1.png" rel="lightbox[3]">
<img src="/images/controllers/yottacontrol/A-3016/A-3016_1.png" alt="радиомодуль ввода-вывода A-3016 Yottacontrol" style="max-width: 275px;float: right;margin: 20px -57px 0px -54px;"></a>

<a id="biglightbox" href="/images/controllers/yottacontrol/A-51x/lg/A-51x_14.png" rel="lightbox[3]">
<img src="/images/controllers/yottacontrol/A-51x/A-51x_14.png" alt="PLC Yottacontrol серия A-51" style="  max-width: 220px;  float: left;  margin: 4px -20px 0px -58px;"></a>
<h3>Общие характеристики</h3><br />

К PLC Yottacontrol можно подключить 255 модулей ввода-вывода.

<br /><br />

Все контроллеры имеют напряжение питания 10-30 VDC, кроме тех, где явно указано 220VAC power.<br /><br />

Во всех контроллерах есть часы реального времени RTC.<br /><br />

Токи: выход реле — 5 А резистивная нагрузка, 2А индуктивная, выход транзистор — 1.75 A.<br /><br />

Частоты: выход реле макс. частота — 30 Гц, транзисторный выход 100 кГц, вход макс. — 250 кГц.<br /><br /><br />

Документация на серию A-51 в pdf: <a href="/manuals/Yottacontrol-2016-A-51.pdf" target="_blanck">открыть в новой вкладке</a>, документация на серию A-52 в pdf: <a href="/manuals/Yottacontrol-2016-A-52.pdf" target="_blanck">открыть в новой вкладке</a>, документация на модули в pdf: <a href="/manuals/Yottacontrol-2016-A-10x.pdf" target="_blanck">открыть в новой вкладке</a>.<br /><br /><br />

</div><br />

';


    $out .= '
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
 ' . "
 function v_korzinu1(o)
{
//alert(o.innerHTML);
//alert($(o).attr('idm'));
chosen_item=$(o).attr('idm');
//var x=$(o).position().left-150;
var x=900;
var y=$(o).position().top;
ask_kol(x, y);

}
  " . '
  </script>
 <style>
 .zakazbut3.yes {
  cursor: pointer;
}
.zakazbut3 {
  -moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
  -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9) );
  background: -moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#f9f9f9", endColorstr="#e9e9e9");
  background-color: #f9f9f9;
  box-shadow: inset 0px 0px 2px gray;
  border: none;
  position: absolute;
  margin-top: -6px;
padding: 6px 13px 2px 12px;
  margin-left: 972px;
}
.zakazbut3.yes:hover {
  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9) );
  background: -moz-linear-gradient( center top, #e9e9e9 5%, #f9f9f9 100% );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#e9e9e9", endColorstr="#f9f9f9");
  background-color: #e9e9e9;
  box-shadow: inset 1px 1px 2px gray;
  padding: 5px 12px 2px 12px;
}
.zakazbut3 img {
  opacity: 0.2;
  margin-bottom: 1px;
  height: 17px;
}
.zakazbut3.yes img {
  opacity: 0.5;
}
.zakazbut3.yes:hover img {
  opacity: 0.8;
  margin-bottom: 0px;
  margin-top: 1px;
}
 #body_cont {    }
 h1 {  font-size: 17px;}
 .links td {/*text-align:center;*/}
 .congroup {  margin-bottom: 2px; width:1020px; margin: 0px 5px 0px 5px; text-decoration: none;  display: table-cell;  float:left;   padding: 0px 10px;  box-shadow: 1px 1px 4px gray;  background:transparent;   transition: background-color .15s ease-out;}
 a .congroup:hover {  background: whitesmoke;  box-shadow: 1px 1px 4px rgb(73, 73, 73);}
 .congroup h3.pan_price {    width: 100px; float: left;  }
  .congroup span {  float: left;  margin-right: 10px;  width: 390px;}
 .congroup .countc span {width:auto;}
  .congroup div {float:left;}
  .instock {float:left;margin-left:20px;}
  .links {width: 100%;word-wrap: normal;}
  .submenu_controller span {float:left;  color: #666666;font-family: Verdana, "Lucida Grande";
  font-size: 13px;}
  .submenu_controller:hover {
    background: rgb(231, 225, 225);
  outline: 1px solid rgb(184, 172, 172);}
  .submenu_controller:hover .zakazbut3 {outline: 1px solid rgb(184, 172, 172); }
   .submenu_controller:hover span {color: rgb(18, 18, 18);}
  .submenu_controller span.green {  color: rgb(71, 191, 52);  float: initial !important;}
 </style>
  ';
} else if (preg_match('/x/i', $var_array[3])) {

    $file = $_SERVER['DOCUMENT_ROOT'] . '/plc/yottacontrol/products_newo.php';
    if (file_exists($file)) {
        include_once($file);
    };
} else {
    $file = $_SERVER['DOCUMENT_ROOT'] . '/plc/yottacontrol/products_new.php';
    if (file_exists($file)) {
        include_once($file);
    };
};

$out .= '</div>';

//-----------------end content
//echo microtime(true) - $start;
$template_file = 'head_canonical.html';

$head = head($template_file, $TITLE, $DESCRIPTION, $KEYWORDS);
$head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);



echo $head;
?>
<div id="mes_backgr"> </div>
<div id="body_cont">
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width="100%" bgcolor="white">
        <tr height="93">
            <td width="300px">
                <a href="/"><img src="/images/logo2017.png" /></a>
            </td>
            <td> </td>
        </tr>
    </table>
    <?
    top_menu();
    //usd_rate();
    search();
    compare();
    backup_call();
    top_buttons();
    basket();
    temp1_no_menu();
    show_price_val();
//temp1();
//left_menu();
    add_to_basket();
    popup_messages();

    temp2();
echo "<article>";
echo $out;
echo "</article>";
temp3();
    ?>