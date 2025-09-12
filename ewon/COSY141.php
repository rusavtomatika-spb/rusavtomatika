<?php
session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");
include ("../sc/vars.php");
//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));
global $mysqli_db;
database_connect();
mysqli_query($mysqli_db,"SET NAMES 'cp1251'");

$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);
//echo $_SERVER['QUERY_STRING'];
$CANONICAL = $var_to_array;

//echo "sss=".$_SERVER['SCRIPT_FILENAME'];
//echo "sss=".$_SERVER['DOCUMENT_ROOT'];
//---------------content ---------------------
$out = <<<EOD
<link rel="stylesheet" type="text/css" href="/ewon/template_style.css" /> 
<script>
function dich(num)
 {
   $("#dd").html("<img src='"+num+"'>");
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



  </script>
EOD;



//$num="MT8070iH";
//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$num = "COSY141";
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";

$res = mysqli_query($mysqli_db, $sql) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);



$title = 'EWON COSY-141, промышленный VPN-роутер  — удаленный доступ к оборудованию';
$keywords = 'промышленный, VPN, роутер, eWON, COSY, COSY 141, vpn-роутер, облачный, защищенный, удаленный';
$description = 'Промышленный VPN-роутер eWON COSY 141 - защищенное подключение к оборудованию через Интернет. Легкость и безопасность удаленного управления производством.';
$vars = show_pc_variants($num);

$nav = '<br /><nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/ewon/">eWON VPN-роутеры и VPN-серверы</a>&nbsp;/&nbsp;Промышленный VPN-роутер ' . $r->model . '</nav>';
/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;есть на складах: СПБ, МСК, КИЕВ</div>";
 */

$onst = show_stock($r, 1);

$min_table = miniatures($num, 5, 10, 350); // mins_in_row, mins_max, table_width
$im1 = get_big_pic($num);
$alt = get_kw("alt");



?>
<link rel="stylesheet" type="text/css" href="/ewon/template_style.css" /> <?
$name = 'EWON COSY-141';
$type = 'ПРОМЫШЛЕННЫЙ VPN-ROUTER';
ob_start();
include dirname(__FILE__) . '/templates/price_block.php';
$out .= ob_get_clean();
/*
$out .= "
<style>
h1 {  font-family: Verdana, 'Lucida Grande';  font-size: 15px;  font-weight: normal;}
</style>
<article><center>
" . $nav . "<br>
<table width=1000px  height=400px>
<tr ><td colspan=2 height=50px>
<table><tr><td width=840 align=left bfcolor=#cccccc><div class=big_pan_name><h1><b>EWON COSY-141</b>, ПРОМЫШЛЕННЫЙ VPN-ROUTER</h1></div></td><td width=120>
 <div class=pan_price_big title='Розничная цена'> Цена с НДС </div></td><td width=60 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> EUR </td></tr></table>
<div class=hc1>&nbsp;</div><br>
</td></tr>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
<img src='$im1' width=400 alt='$alt'> </div>
<br>
<center>
   $min_table
</td>


<td  valign=top>";
*/

//----------------------------------right part content -----------------------
$out .= "
<div id=cont_rp>
";

$im = "<img src='/images/tick.png' width=15 style='vertical-align: middle;'>";
$he = "height=40 class=hl_text";
$vc = "valign=center";
$out .= "<br>
<table width=100%>
<tr><td valign=center>$im </td><td valign=middle $he>Простое подключение к LAN  на объекте</td></tr>
<tr><td width=30>$im </td><td $he>Cтандартные порты 443 (HTTPS) и 1194 (UDP)</td></tr>
<tr><td>$im </td><td $he>Возможность разрешать VPN доступ внешним выключателем </td></tr>
<tr><td>$im </td><td $he>Питание 24 VDC </td></tr>
<tr><td>$im </td><td $he>Установка на DIN рейку</td></tr>
<tr><td>$im </td><td $he>Облачная технология</td></tr>
<tr><td>$im </td><td $he>1 x SUBD9 последовательный порт RS232, RS485 или MPI/PROFIBUS (12Mbits) на выбор</td></tr>


</table>
<br>
<a style=\"text-decoration:none;font-size:17px;display:block;width:350px;overflow:hidden;padding:15px;background: rgba(0,255,0,0.1); font-weight: bold\" href=\"/video/ewon-cosy-131-vpn-router-bystryy-start-nachalnaya-nastroyka/\" >
                        <img src=\"/images/video/ewon131video.jpg\" style=\"float:right;width: 100px;\" />
                        Видео по быстрой настройке роутера eWON
                    </a>
</div>
";



// --------------------- end right part content -----------------------

$out .= "</td></tr></table>"; // end big table
//----------------------------------------end pics ----------------------------


$out .= "
<style>
#rou_desc{
text-align:justify;
width:100%;
font-family: Verdana, 'Lucida Grande';
font-size: 14px;

}
#dd {text-align: center;} #dd img {max-height:300px;max-width:400px;} h2 {font-size: 14px;
color: gray;
margin: 17px 10px 12px 10px;}.com_about {
width: 200px;
float: left;}
.scheme {
width: 600px;
float: right;
}

.com {color: gray;margin-bottom: 50px;}
.scheme table tr td {border: 1px solid gray;
padding: 3px 15px;
font-size: 11px;}
.gray {background-color: rgb(245, 245, 245);}
</style>
<br><br>
<!--<iframe width='480' height='270' src='//www.youtube.com/embed/KxHauD-fb6M?rel=0' frameborder='0' allowfullscreen></iframe>&nbsp;&nbsp;&nbsp;
<iframe width='480' height='270' src='//www.youtube.com/embed/vMcib9baDAk?rel=0' frameborder='0' allowfullscreen></iframe> -->

<br><br>
<div id=rou_desc>
<strong>eWON Cosy</strong> - это промышленный <strong>VPN роутер</strong>, спроектированный для простого подключения удаленных
объектов автоматизации к Интернет посредством защищенного VPN канала.<br>
С помощью eWON Cosy производители оборудования и системные интеграторы могут удаленно проводить наладку
и техническое обслуживание оборудования, отлаживать программы контроллеров  ( подключенных как по Ethernet, так и по COM, либо MPI ),  операторских панелей
загружать в них проекты, просматривать изображения с IP-камер. <br>Все это можно делать без посещения объекта, что существенно
снижает затраты на обслуживания объекта.<br><br>

<strong>eWON Cosy</strong> полностью совместим с <strong>Talk2M</strong>, облачным сервисом eWON ( бесплатным ). <strong>Talk2M</strong> обеспечивает безопасное VPN соединение между пользователем
и удаленным роутером. При этом роутеру не нужен выделенный IP. eWON Cosy и Talk2M обеспечивают простой доступ роутеру и оборудованию, подключенному к нему, так, что
пользователю не нужно обладать знаниями в области IT.

<strong>VPN роутер</strong> просто подключается к локальной сети на объекте, при этом не требуется значительного вмешательства администратора сети.
Роутер использует стандартные порты 443 (HTTPS) и 1194 (UDP).
</div>



";

$out .= "<br><span class=big_pan_name><b>Возможные модификации:</b></span> <br><br>" . $vars;

$bg1 = "style='background: #fefefe';";
$bg2 = "style='background: #f5f5f5';";
$table_start = "<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";
$outs = <<<EOD
<script>
$(document).ready(function(){
 $('.mytab2 > tbody > tr:even').addClass('gray');

	});
</script>
EOD;


//----------------------------tab1 -----------------------------------------


if ($r->ethernet != "" && $r->software != "") {
    $dop = "<tr><td class=par_name1 >Удаленный доступ к устройству</td><td class=par_val1 >FTP(архивы, рецепты, журнал событий), VNC (удаленная работа),<br>
   EasyAccess (удаленная работа, загрузка проекта )</td></tr>
   <tr><td class=par_name1 >Ftp доступ к памяти устройства</td><td class=par_val1 >" . ($r->ftp_access_hmi_mem ? "Есть" : "-") . "</td></tr>
   <tr><td class=par_name1 >Ftp доступ к SD карте и флешке</td><td class=par_val1 >" . ($r->ftp_access_sd_usb ? "Есть" : "-") . "</td></tr>
   ";
} else
    $dop = "";

$arch = "память устройства";
if ($r->usb_host != "")
    $arch .= ", флешка";
if ($r->sdcard != "")
    $arch .= ", SD карта";

$modbus = "RTU, ASCII, Master, Slave";
if ($r->ethernet != "")
    $modbus .= ", TCP/IP";

$modbus = "<tr><td class=par_name1 >Поддержка Modbus</td><td class=par_val1 >$modbus</td></tr>";
if ($r->os != "")
    $modbus = "";

$mpi = "<tr><td class=par_name1 >Поддержка MPI</td><td class=par_val1 >187,5 K</td></tr>";
if ($r->os != "")
    $mpi = "";

$mount = "";
if ($r->wall_mount != "")
    $mount .= "в стену";
if ($r->vesa75 != "")
    $mount .= ", VESA 75x75";
if ($r->vesa100 != "")
    $mount .= ", VESA 100x100";

$sp_data1 = "
 <div style='width:90%;'>

<br />
 <span class=hpar>Параметры</span><br>
 $table_start


 <tr><td class=par_name1 >Роутер</td><td class=par_val1 >IP фильтрация, IP форвардинг, NAT, Прокси, Таблица маршрутизации, DHCP клиент </td></tr>
 <tr><td class=par_name1 >Интернет</td><td class=par_val1 >исходящее соединение на Talk2M по HTTPS(порт 443 или UDP 1193)</td></tr>
 <tr><td class=par_name1 >VPN туннель</td><td class=par_val1 >Open VPN 2.0 через SSL UDP либо HTTPS</td></tr>
 <tr><td class=par_name1 >VPN безопасность</td><td class=par_val1 >
 Модель VPN защиты основана на использовании SSL/TLS для аутентификации сессии и IPSec ESP протокол для безопасного транспортного туннеля по UDP. Она поддерживает
 X509 PKI ( инфраструктура публичного ключа ) для аутентификации сессии, TLS протокл для обмена ключами, шифро-независимый EVP (DES, 3DES, AES, BF ) интерфейс
 для шифрования данных туннеля, и HMAC-SHA1 алгоритм для аутентификации данных туннеля.


 </td></tr>
 <tr><td class=par_name1 >Процессор</td><td class=par_val1 >OARM clocked @ 75Mhz</td></tr>
 <tr><td class=par_name1 >SDRAM</td><td class=par_val1 >16Mb</td></tr>
 <tr><td class=par_name1 >Flash память</td><td class=par_val1 >32Mb</td></tr>

 <tr><td class=par_name1 >Синхронизация</td><td class=par_val1 >встроенные часы реального времени, ручная настройка по http,
 либо автоматическая по NTP</td></tr>
 </table><br><br>

 <span class=hpar>Встроенные конвертеры интерфейсов</span><br>
 $table_start
 <tr><td class=par_name1 >Встроенные конверторы протоколов Ethernet - Serial </td><td class=par_val1 >
 <table style=\"width: 100%;\">
 <tr><td width=80>MODBUS TCP</td><td><-> MODBUS RTU</td></tr>
 <tr><td>XIP </td><td> <-> UNITELWAY</td></tr>
 <tr><td> Ethernet/IP </td><td> <-> DF1 </td></tr>
 <tr><td>FINS TCP </td><td> <-> FINS Hostlink</td></tr>
 <tr><td>ISO TCP </td><td> <-> PPI,MPI(S7) или PROFIBUS (S7)</td></tr>
 <tr><td>VCOM </td><td><-> ASCII </td></tr></table>
 </td></tr>


  </table><br><br>

 <span class=hpar>Интерфейсы</span><br>
 $table_start
 <tr><td class=par_name1 >Встроенный ВЕБ Интерфейс</td><td class=par_val1 >встроенный веб интерфейс с Мастерами настроек для конфигурации и обслуживания
 (не нужно дополнительное ПО ) Базовая аутентификация ( логин/пароль) и контроль сессии для безопасности. Возможно создать пользовательскую страницу с
 с интерфейсом. </td></tr>
<tr><td class=par_name1 >Управление файлами</td><td class=par_val1 >FTP клиент и сервер для конфигурации, обновления прошивки и переноса данных</td></tr>
 <tr><td class=par_name1 >Обслуживание</td><td class=par_val1 >SNMP V1 с MIB2, либо по FTP </td></tr>
  <tr><td class=par_name1 >Последовательный интерфейс</td><td class=par_val1 >$r->serial_full</td></tr>
    <tr><td class=par_name1 >Ethernet</td><td class=par_val1 >$r->ethernet</td></tr>
 </table><br><br>

 <span class=hpar>Конструкция</span><br>
 $table_start
 <tr><td class=par_name1 >Материал корпуса</td><td class=par_val1 >$r->case_material</td></tr>
 <tr><td class=par_name1 >Способ охлаждения</td><td class=par_val1 >$r->cpu_fan</td></tr>
 <tr><td class=par_name1 >Варианты установки</td><td class=par_val1 >$r->wall_mount</td></tr>
 <tr><td class=par_name1 >Разъем питания</td><td class=par_val1 >2х контактный с фиксацией</td></tr>
 <tr><td class=par_name1 >Напряжение питания</td><td class=par_val1 >12-24 VDC </td></tr>
 <tr><td class=par_name1 >Потребляемая мощность</td><td class=par_val1 >$r->power Вт</td></tr>
 <tr><td class=par_name1 >Габариты</td><td class=par_val1 >$r->dimentions мм</td></tr>
 <tr><td class=par_name1 >Вес</td><td class=par_val1 >< 500 гр</td></tr>
 <tr><td class=par_name1 >Рабочая температура</td><td class=par_val1 >-20&deg ~ +70&deg</td></tr>
  <tr><td class=par_name1 >Относительная влажность</td><td class=par_val1 >от 0 до 80% (без конденсации)</td></tr>
 ";



$sp_data1 .= "</table></div><br><br>";



//---------------------end tab1 -------------------------
//-------------spec ---------------------------
$out .= "<br><br>
<div class='tabs_wrapper' style='width:100%; min-height: 500px; overflow: auto; '>
<div id='tabs'>
  <ul>
     <li class='urlup' data='functions'><a href='#tabs-1'>ХАРАКТЕРИСТИКИ</a></li>
    <li class='urlup' data='dimensions'><a href='#tabs-2'>ГАБАРИТЫ</a></li>

     <li class='urlup' data='software'><a href='#tabs-4'>СКАЧАТЬ</a></li>
  </ul>
  <div id='tabs-1'>
    <h2>Технические характеристики $r->model</h2>
    $sp_data1
  </div> ";


$file = $path_to_real_files . '/images/ewon/dim/COSY141.png';
if ($GLOBALS["net"] == 0) {
    if (file_exists($file)) {
        $yes = 1;
    } else {
        $yes = 0;
    };
} else {
    $re = cu($file);
    if ($re[0] > 0) {
        $yes = 1;
    } else {
        $yes = 0;
    };
};
if ($yes == 1) {
    $out .= " <div id='tabs-2' style=''>
  <h2>Габариты $r->model</h2>
  <div style='position:absolute;margin: 25px 0px 0px 72px;'>Вид&nbsp;спереди</div>
  <div style='position:absolute;margin: 25px 0px 0px 694px;'>Вид&nbsp;справа</div>
  <div style='position:absolute;margin: 650px 0px 0px 72px;'>Вид&nbsp;слева</div>
  <div style='position:absolute;margin: 650px 0px 0px 694px;'>Вид&nbsp;сзади</div>
  <div style='position: absolute;
margin: 759px 0px 0px 228px;

width: 136px;
border: 1px dotted gray;
padding: 10px;
background-color: rgb(247, 247, 247);'>Защелка для крепления к рейке &#937;-образной формы. Зацепите блок на верхней кромке рейки и двигайте вниз до щелчка.</div>
  <img src='/images/ewon/dim/COSY141.png'>
  </div>";
} else {
    $out .= " <div id='tabs-2'>
  Габариты 135х122х38 мм
  </div>";
};



//---------------------download section -------------------------------- ------------------------------
$file = $path_to_real_files . '/install/COSY141.pdf';
if ($GLOBALS["net"] == 0) {
    if (file_exists($file)) {
        $yes = 1;
        $fs = (sprintf("%u", filesize($file)) + 0) / 1000;
        $tu = date("d-m-Y", filemtime($file));
    } else {
        $yes = 0;
    };
} else {
    $re = cu($file);
    if ($re[0] > 0) {
        $yes = 1;
        $tu = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $yes = 0;
    };
};
if ($yes == 1) {


//$s =  ceil($fs/1000);
    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft7 = "
 <tr><td><div class=down_item>Инструкция по установке COSY141 </div></td>
   <td><div class=dt_item>" . $tu . "<br>$s</div></td>
   <td><div class=down_item><a href='/install/COSY141.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft7 = '';
};



if ($GLOBALS["net"] == 0) {
    $file = $path_to_real_files . '/manuals/COSY141.pdf';
    if (file_exists($file)) {
        $yes = 1;
        $fs = (sprintf("%u", filesize($file)) + 0) / 1000;
        $tu = date("d-m-Y", filemtime($file));
    } else {
        $yes = 0;
    };
} else {
    $file = $root_php . '/manuals/COSY141.pdf';
    $re = cu($file);
    if ($re[0] > 0) {
        $yes = 1;
        $tu = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $yes = 0;
    };
};


if ($yes == 1) {
    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft1 = "
 <tr><td><div class=down_item>Брошюра (datasheet) COSY141 </div></td>
   <td><div class=dt_item>" . $tu . "<br>$s</div></td>
   <td><div class=down_item><a href='/manuals/COSY141.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft1 = '';
};

if (file_exists('software/eCatcherSetup.exe')) {

    $fs = (sprintf("%u", filesize('software/eCatcherSetup.exe')) + 0) / 1000;
//$s =  ceil($fs/1000);
    $s = round($fs / 1000, 2);
    if ($s > 1) {
        $s .= '&nbsp;Мб';
    } else {
        $s = $s * 100;
        $s .= '&nbsp;Кб';
    };
    $ver = @file_get_contents("software/eCatcher.txt");
    if (!empty($ver)) {
        $ver = '(' . $ver . ')';
    };
    $soft8 = "
 <tr><td><div class=down_item> eCatcher, программное обеспечение eWON <span style=\"font-weight:normal\">Talk2M connector,
Services Free + and Pro</span> для vpn-роутера COSY-141 $ver</div></td>
   <td><div class=dt_item>" . date("d-m-Y", filemtime('software/eCatcherSetup.exe')) . "<br>$s</div></td>
   <td><div class=down_item><a href='/vpn-routers/software/eCatcherSetup.exe' > <img src=/vpn-routers/software/eCatcher.png style=\"width: 33px;\"></a></div></td></tr>
 ";
} else {
    $soft8 = '';
};

if (file_exists('software/eCatcherSetup.exe')) {

    $fs = (sprintf("%u", filesize('software/eBuddySetup.exe')) + 0) / 1000;
    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };

    if (!empty($ver)) {
        $ver = '(' . $ver . ')';
    };
    $soft9 = "
 <tr><td><div class=down_item> eBuddy, программное обеспечение eWON <span style=\"font-weight:normal\">поможет найти, назначить IP-адресс, обновить прошивку, осуществить резервное копирование и восстановление параметров </span> для vpn-роутера COSY-141</div></td>
   <td><div class=dt_item>" . date("d-m-Y", filemtime('software/eBuddySetup.exe')) . "<br>$s</div></td>
   <td><div class=down_item><a href='/vpn-routers/software/eBuddySetup.exe' > <img src=/vpn-routers/software/eBuddy.png style=\"width: 33px;\"></a></div></td></tr>
 ";
} else {
    $soft9 = '';
};



$out .= "
  <div id='tabs-4'>
  <div class=connectors>
  <h2>Файлы для работы с  vpn-роутером $r->model</h2><br /><br />
  </div>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование </div></td><td><div class=down_h>  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>

 $soft8
 $soft9
$soft7
$soft1

   </table>
   <br /> <br />
  </div>
</div>
</div>
";


$out .= $outs . "<br><br>";
$uuu = "";
if (!empty($_GET["tab"])) {
    if ($_GET["tab"] == 'accessories') {
        $uuu = '$(\'a[href="#tabs-5"]\').click();';
    } else if ($_GET["tab"] == 'functions') {
        $uuu = '$(\'a[href="#tabs-1"]\').click();';
    } else if ($_GET["tab"] == 'software') {
        $uuu = '$(\'a[href="#tabs-4"]\').click();';
    } else if ($_GET["tab"] == 'dimensions') {
        $uuu = '$(\'a[href="#tabs-2"]\').click();';
    } else if ($_GET["tab"] == 'scheme') {
        $uuu = '$(\'a[href="#tabs-3"]\').click();';
    };
};

$out .= "
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

//-----------------end content



$template_file = 'head_canonical.html';
$imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";
ob_start();?>


<meta property='og:title' content='<?=$title?>' />
<meta property="og:image" content="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>" />
<meta property='og:site_name' content='Русавтоматика' />
<link rel='image_src' href="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>">

<?$expansionParam = ob_get_clean();

//$head = head($template_file, $title, $description, $keywords);
$head = setHeaderExpansionParam($template_file, $title, $description, $keywords, $expansionParam);


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
    search();
    compare();
    backup_call();
    top_buttons();
    basket();
    temp1_no_menu();
    show_price_val("euro");
//temp1();
//left_menu();
    /*
      echo "<br><br><div class=filter_case> <div class=filter>
      <center>ПОДБОР ПРОДУКЦИИ</center><br>
      СЕРИЯ 6000i<br>
      ДИАГОНАЛЬ 7\"<br>
      c SD картой
      c Ethernet
      с VNC сервером
      c алюмин. корпусом<br>";
     */
    add_to_basket();
    popup_messages();
    temp2();

    echo $out."</article>";

    temp3();
    ?>