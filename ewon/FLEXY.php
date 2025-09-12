<?php
header("HTTP/1.1 301 Moved Permanently");
header("Location: /ewon/FLEXY201.php");
exit();

session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");
include ("../sc/vars.php");
//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));

global $mysqli_db;
database_connect();
mysqli_query($mysqli_db, "SET NAMES 'cp1251'");

$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);
//echo $_SERVER['QUERY_STRING'];
$CANONICAL = $var_to_array;

//echo "sss=".$_SERVER['SCRIPT_FILENAME'];
//echo "sss=".$_SERVER['DOCUMENT_ROOT'];
//---------------content ---------------------
$outs = <<<EOD
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


$outs .= <<<EOD
<script>
$(document).ready(function(){
 $('.mytab2 > tbody > tr:even').addClass('gray');

	});
</script>
EOD;
//$num="MT8070iH";
//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$num = "FLEXY";
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";

$res = mysqli_query($mysqli_db, $sql) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);


$title = 'EWON Flexy, промышленный VPN-роутер  — удаленный доступ к оборудованию';
$keywords = 'промышленный, VPN, роутер, eWON, Flexy, vpn-роутер, облачный, защищенный, удаленный, доступ, оборудование';
$description = 'Промышленный VPN-роутер eWON Flexy - защищенное подключение к оборудованию через Интернет. Модули-расширения для подключения посредством 3G, HSUPA, Wi-Fi, Ethernet WAN, RS232/485/422 - простота, гибкость и функциональность.';
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

$out = "
<style>
h1 {  font-family: Verdana, 'Lucida Grande';  font-size: 15px;  font-weight: normal;}
</style>
<center>
" . $nav . "<br>
<table width=1000px  height=400px>
<tr ><td colspan=2 height=50px>
<table><tr><td width=840 align=left bfcolor=#cccccc><div class=big_pan_name><h1><b>EWON FLEXY</b>, ПРОМЫШЛЕННЫЙ VPN-ROUTER</h1></div></td><td width=120>
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


</table>
</div>
";



// --------------------- end right part content -----------------------

$out .= "</td></tr></table>"; // end big table
//----------------------------------------end pics ----------------------------


$out .= "
<style>
#rou_desc{
text-align:justify;
width:1000px;
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
<iframe width='480' height='270' src='//www.youtube.com/embed/KxHauD-fb6M?rel=0' frameborder='0' allowfullscreen></iframe>&nbsp;&nbsp;&nbsp;
<iframe width='480' height='270' src='//www.youtube.com/embed/tvXV9RfOPiA?rel=0' frameborder='0' allowfullscreen></iframe><br><br>
<div id=rou_desc>
<strong>eWON Flexy</strong> - это первый промышленный модульный <strong>M2M роутер</strong>, спроектированный для легкого подключения удаленных
объектов автоматизации к Интернет посредством защищенного VPN канала.<br /><br />
Модули-расширения позволяют без лишних усилий «построить» необходимый дополнительный функционал, доступны модули с двумя последовательными портами, Ethernet WAN, 3G + HSUPA и Wi-Fi модулей.
С помощью <strong>eWON Flexy</strong> производители оборудования и системные интеграторы могут удаленно проводить наладку
и техническое обслуживание оборудования, отлаживать программы контроллеров  ( подключенных как по Ethernet, так и по COM, либо MPI ),  операторских панелей
загружать в них проекты, просматривать изображения с IP-камер. <br>Все это можно делать без посещения объекта, что существенно
снижает затраты на обслуживания объекта.<br /><br />

<strong>eWON Flexy</strong> полностью совместим с <strong>Talk2M</strong>, облачным сервисом eWON ( бесплатным ). <strong>Talk2M</strong> обеспечивает безопасное VPN соединение между пользователем
и удаленным роутером. При этом роутеру не нужен выделенный IP. eWON Flexy и Talk2M обеспечивают простой доступ роутеру и оборудованию, подключенному к нему, так, что
пользователю не нужно обладать знаниями в области IT.<br /><br />

<strong>VPN роутер</strong> просто подключается к локальной сети на объекте, при этом не требуется значительного вмешательства администратора сети.
Роутер использует стандартные порты 443 (HTTPS) и 1194 (UDP).<br /><br />
</div>






";

$out .= "<br><span class=big_pan_name><b>Возможные модификации:</b></span> <br><br>" . $vars;

$bg1 = "style='background: #fefefe';";
$bg2 = "style='background: #f5f5f5';";
$table_start = "<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";


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

 </table><br><br>

 <span class=hpar>Конструкция</span><br>
 $table_start
 <tr><td class=par_name1 >Материал корпуса</td><td class=par_val1 >металл</td></tr>
 <tr><td class=par_name1 >Способ охлаждения</td><td class=par_val1 >безвентиляторное</td></tr>
 <tr><td class=par_name1 >Варианты установки</td><td class=par_val1 >на ДИН рейку EN50022-совместимый</td></tr>
 <tr><td class=par_name1 >Разъем питания</td><td class=par_val1 >2х контактный с фиксацией</td></tr>
 <tr><td class=par_name1 >Напряжение питания</td><td class=par_val1 >12-24 VDC </td></tr>
 <tr><td class=par_name1 >Потребляемая мощность</td><td class=par_val1 >30 Вт</td></tr>
 <tr><td class=par_name1 >Габариты</td><td class=par_val1 >134х89х80 мм</td></tr>
 <tr><td class=par_name1 >Вес</td><td class=par_val1 >< 500 гр</td></tr>
 <tr><td class=par_name1 >Рабочая температура</td><td class=par_val1 >-25&deg ~ +70&deg</td></tr>
  <tr><td class=par_name1 >Температура хранения</td><td class=par_val1 >-40&deg ~ +70&deg</td></tr>
    <tr><td class=par_name1 >Относительная влажность</td><td class=par_val1 >от 10 до 95% (без конденсации)</td></tr>
 ";



$sp_data1 .= "</table></div>";



//---------------------end tab1 -------------------------
//-------------spec ---------------------------
$out .= "<br><br>
<div style='width:1100px; min-height: 500px; overflow: auto; '>
<div id='tabs'>
  <ul>
     <li class='urlup' data='functions'><a href='#tabs-1'>ХАРАКТЕРИСТИКИ</a></li>
     <li class='urlup' data='dimensions'><a href='#tabs-2'>ГАБАРИТЫ</a></li>

     <li class='urlup' data='software'><a href='#tabs-4'>СКАЧАТЬ</a></li>
	<li class='urlup' data='accessories'><a href='#tabs-5'>МОДУЛИ</a></li>
  </ul>
  <div id='tabs-1'>
     <h2>Технические характеристики $r->model</h2>
    $sp_data1
  </div>";


if ($GLOBALS["net"] == 0) {
    $file = $path_to_real_files . '/images/ewon/dim/FLEXY.png';
    if (file_exists($file)) {
        $yes = 1;
    }
} else {
    $file = $root_php . '/images/ewon/dim/FLEXY.png';
    $re = cu($file);
    if ($re[0] > 0) {
        $yes = 1;
    };
};
if ($yes == 1) {
    $out .= " <div id='tabs-2' style=''>
  <h2>Габариты $r->model</h2>
  <div style='position:absolute;margin: 50px 0px 0px 193px;'>Вид&nbsp;спереди</div>
  <div style='position:absolute;margin: 50px 0px 0px 729px;'>Вид&nbsp;справа</div>
  <div style='position:absolute;margin: 410px 0px 0px 193px;'>Вид&nbsp;слева</div>
  <div style='position:absolute;margin: 410px 0px 0px 729px;'>Вид&nbsp;сзади</div>
  <img src='/images/ewon/dim/FLEXY.png'>
  </div>";
} else {
    $out .= " <div id='tabs-2'>
  Габариты 134х89х80 мм
  </div>";
};



//---------------------download section -------------------------------- ------------------------------
$file = 'install/Flexy.pdf';

if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . $file)) {
        $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . $file));
    } else {
        $blockI = 1;
    };
} else {

    $re = cu($root_php . '/' . $file);

    if ($re[0] > 0) {
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $blockI = 1;
    };
};


if ($blockI != 1) {


    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft7 = "
 <tr><td><div class=down_item>Инструкция по установке базового модуля Flexy (101/201, 102/202, 103/203) </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/Flexy.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft7 = '';
};

$file = 'manuals/Flexy.pdf';
if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . $file)) {
        $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
//$s =  ceil($fs/1000);
    } else {
        $blockM = 1;
    };
} else {
    $re = cu($root_php . '/' . $file);
    if ($re[0] > 0) {
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $blockM = 1;
    };
};



if ($blockM != 1) {


    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft5 = "
 <tr><td><div class=down_item>Брошюра (datasheet) Flexy (101/201, 102/202, 103/203) </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/manuals/Flexy.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft5 = '';
};


$file = 'install/FLX3101.pdf';
if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . $file)) {
        $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . $file));
    } else {
        $blockX = 1;
    };
} else {
    $re = cu($root_php . '/' . $file);
    if ($re[0] > 0) {
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $blockX = 1;
    };
};

if ($blockX != 1) {

    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft1 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLX 3101  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLX3101.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft1 = '';
};

$file = 'install/FLB3202.pdf';
if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . $file)) {
        $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . $file));
    } else {
        $blockB = 1;
    };
} else {
    $re = cu($root_php . '/' . $file);
    if ($re[0] > 0) {
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $blockB = 1;
    };
};



if ($blockB != 1) {


    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft2 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLB 3202  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLB3202.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft2 = '';
};
$file = 'install/FLA3301.pdf';
if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . $file)) {
        $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . $file));
    } else {
        $blockA = 1;
    };
} else {
    $re = cu($root_php . '/' . $file);
    if ($re[0] > 0) {
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $blockA = 1;
    };
};

if ($blockA != 1) {


    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft3 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLA 3301  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLA3301.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft3 = '';
};



$file = 'install/FLX3401.pdf';
if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . $file)) {
        $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . $file));
    } else {
        $blockX = 1;
    };
} else {
    $re = cu($root_php . '/' . $file);
    if ($re[0] > 0) {
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $blockX = 1;
    };
};

if ($blockX != 1) {

    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft11 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLX 3401  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLX3401.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft11 = '';
};

$file = 'install/FLA3501.pdf';
if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . $file)) {
        $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
        $t = date("d-m-Y", filemtime($root_php . $file));
    } else {
        $blockX = 1;
    };
} else {
    $re = cu($root_php . '/' . $file);
    if ($re[0] > 0) {
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $blockX = 1;
    };
};

if ($blockX != 1) {

    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;Мб';
    } else {
        $s = round($fs, 0) . '&nbsp;Кб';
    };
    $soft12 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLA 3501  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLA3501.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft12 = '';
};



if (file_exists('software/eCatcherSetup.exe')) {


    if ($s > 1) {
        $s .= '&nbsp;Мб';
    } else {
        $s = $s * 1000;
        $s .= '&nbsp;Кб';
    };
    $ver = @file_get_contents("software/eCatcher.txt");
    if (!empty($ver)) {
        $ver = '(' . $ver . ')';
    };
    $soft8 = "
 <tr><td><div class=down_item> eCatcher, программное обеспечение eWON <span style=\"font-weight:normal\">Talk2M connector,
Services Free + and Pro</span> для vpn-роутера Flexy $ver</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/software/eCatcherSetup.exe' > <img src=/vpn-routers/software/eCatcher.png style=\"width: 33px;\"></a></div></td></tr>
 ";
} else {
    $soft8 = '';
};

if (file_exists('software/eCatcherSetup.exe')) {


    if ($s > 1) {
        $s .= '&nbsp;Мб';
    } else {
        $s = $s * 1000;
        $s .= '&nbsp;Кб';
    };

    if (!empty($ver)) {
        $ver = '(' . $ver . ')';
    };
    $soft9 = "
 <tr><td><div class=down_item> eBuddy, программное обеспечение eWON <span style=\"font-weight:normal\">поможет найти, назначить IP-адресс, обновить прошивку, осуществить резервное копирование и восстановление параметров </span> для vpn-роутера Flexy</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/software/eBuddySetup.exe' > <img src=/vpn-routers/software/eBuddy.png style=\"width: 33px;\"></a></div></td></tr>
 ";
} else {
    $soft9 = '';
};


if (file_exists($GLOBALS["EBPro_version"])) {
    $ver = file_get_contents($GLOBALS["EBPro_version"]);
} else {
    $ver = '';
};
$out .= "
  <div id='tabs-4'>
  <div class=connectors>
  <h2>Файлы для работы с vpn-роутером $r->model</h2><br /><br />
  </div>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование </div></td><td><div class=down_h>  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>




$soft8
$soft9
  $soft7
   $soft5
    $soft1
	  $soft2
	    $soft3
		$soft11
		$soft12

   </table>

  </div>

";

$out .= '
<div id="tabs-5">
    <div class=connectors>
  <h2>Базовые модули и карты-расширения FLEXY</h2><br />
  </div>
  <img src="/images/ewon/Extention/Flexy-with-modules.png" align="left" style="height: 146px;padding: 0px 146px 20px 0px;
margin-top: -24px;">
<div style="display:block;float:right;width:600px;padding-bottom: 20px;">
<h3>3 базовых модуля</h3><br /><br />
<ul style="text-align: left;"><li>Flexy 101/201 : со свитчем 4x Ethernet LAN 10/100MB</li>
<li>Flexy 102/202 : с Ethernet 10/100MB и RS232/422/485 портами</li>
<li>Flexy 103/203 : c Ethernet 10/100MB и MPI портами</li></ul><br />
<ul style="text-align: left;list-style: square outside;"><li>Flexy 10X — без WAN/LAN/Serial маршрутизации (M2M Data Gateway)</li><li>
Flexy 20X - полнофункциональная версия (M2M Router)</li></ul></div>
<br /><br /><div style="width:950px;display: inline-block;
text-align: center;">
<div style="width:300px;float: left;"><img src="/images/ewon/Extention/modules-flexy-101-201.png" style="padding: 0px 10px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>Flexy 101/201</nobr></div>
<div style="width:300px;float: left;"><img src="/images/ewon/Extention/modules-flexy-102-202.png" style="padding: 0px 10px;" title="Flexy 102/202" alt="Flexy 102/202"><nobr>Flexy 102/202</nobr></div>
<div style="width:300px;float: left;"><img src="/images/ewon/Extention/modules-flexy-103-203.png" style="padding: 0px 10px;" title="Flexy 103/203" alt="Flexy 103/203"><nobr>Flexy 103/203</nobr></div></div><br />
<br /><br /><h3>Карты-расширения</h3>



<div style="width: 350px;
text-align: left;float:left;
padding-top: 20px;
display: inline-block;"><br /><p>&nbsp;</p>
&#9312; Двойной последовательный порт<br />
Подключение любых RS232/485/422 устройств для обеспечения удаленного доступа или сбора данных с использованием сервисной библиотеки eWON Flexy I/O.
<br /> <br />
&#9313; Ethernet WAN<br />
Доступ WAN Ethernet для подключения промышленного оборудования к Интернету.
<br /> <br />
&#9314; 3G + HSUPA <br />
Pentaband модем для связи с использованием 2G, 3G или 3G + сети сотовой связи до 7,3 Мб/сек для скачивания и 2 Мб/сек загрузки.
<br /> <br />



  </div><br /><br />

 <div style="float:right;">
<div style="width:180px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-1.png" style="padding: 0px 10px 0px 0px;  height: 265px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9312; FLA 3301</nobr><br /><nobr>Слоты: &#9679;&#9679;&#9675;&#9675;</nobr></div>
<div style="width:200px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-2.png" style="padding: 0px 20px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9313; FLX 3101</nobr><br /><nobr>Слоты: &#9679;&#9679;&#9679;&#9679;</nobr></div>
<div style="width:200px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-3.png" style="padding: 0px 20px 0px 10px;  height: 265px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9314; FLB 3202</nobr><br /><nobr>Слоты: &#9675;&#9675;&#9679;&#9679;</nobr></div>


</div>


  <div style="float:left;">
<div style="height:310px;  width: 200px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-7.png" style="padding: 0px 10px 0px 0px;  height: 265px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9315; FLX 3401</nobr><br /><nobr>Слоты: &#9679;&#9679;&#9679;&#9679;</nobr></div>
<div style="height:310px;  width: 200px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-8.png" style="padding: 0px 20px;  height: 265px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9316; FLA3501</nobr><br /><nobr>Слоты: &#9679;&#9679;&#9675;&#9675;</nobr></div>


</div>

<div style="width: 515px;float:right;
text-align: left;
padding-top: 20px;
display: inline-block;"><br /><p>&nbsp;</p>
&#9315; I/O-карта<br />
Дискретные входы 8 x DI (0~10 VDC - 16 bits) изол.<br />
Аналоговые входы 4 x AI (0~12/24 VDC) изол.<br />
Дискретные выходы 2 x DO (3A/34V VAC/VDC) изол.
<br /> <br />
&#9316; Модем<br />
Поддерживаемые стандарты: V.92/56K, V.34/33.6K, V.32bis/14.4K и
V.22bis/2400 bps<br />
Сжатие данных: V.44 and V.42bis, MNP 5<br />
Разъем: RJ11<br />
Индикатор активности на лицевой панели
<br /> <br />




  </div>



 <div style="text-align:left;width: 935px;float:left;padding:10px 0px;font-size: 13px;">
 Карты-расширения FLA предназначены для слотов с маркировкой "A" (два левых), FLB - для слотов "B" (два правых),<br />FLX могут работать в любом из четырех слотов.
 </p>
  </div>
</div><br /><br /></div><br /><br />' . $outs;


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
$head = head($template_file, $title, $description, $keywords);

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
    echo $out;
    temp3();
    ?>