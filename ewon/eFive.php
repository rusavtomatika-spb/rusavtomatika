<?php
session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");
include ("../sc/vars.php");
//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));




$blockI = $blockM = $blockX = $blockB = $blockA = $soft8 = $tab = $uuu = '';

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
<link rel="stylesheet" type="text/css" href="/ewon/template_style.css" />
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
$num = "eFive";
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysqli_query($mysqli_db, $sql) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);


$title = 'eWON eFive, промышленный VPN-сервер, организация VPN-сети, SCADA опрос удаленных контроллеров и датчиков';
$keywords = 'промышленный, VPN, роутер, сервер, eWON, eFive, vpn-роутер, vpn-сервер, облачный, защищенный, удаленный, доступ, оборудование, защищенная сеть';
$description = 'Промышленный VPN-сервер eWON eFive - организация защищенной VPN-сети через Интернет для подключение оборудования к SCADA в режиме on-line.';
$vars = show_pc_variants($num);

$nav = '<br /><nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/ewon/">eWON VPN-роутеры и VPN-серверы</a>&nbsp;/&nbsp;Промышленный VPN-сервер ' . $r->model . '</nav>';
/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;есть на складах: СПБ, МСК, КИЕВ</div>";
 */

$onst = show_stock($r, 1);

$min_table = miniatures($num, 5, 10, 350); // mins_in_row, mins_max, table_width
$im1 = get_big_pic($num);
$alt = get_kw("alt");


$bim1 = 'images/ewon/' . $r->model . '/lg/' . $r->model . '_1.png';


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
    if (file_exists($GLOBALS["path_to_real_files"] . '/images/ewon/' . $r->model . '/lg/' . $r->model . '_1.png')) {
        $bim1 = '/images/ewon/' . $r->model . '/lg/' . $r->model . '_1.png';
    } else {
        $bim1 = '';
    };
} else {
    $re = cu($GLOBALS["path_to_real_files"] . '/images/ewon/' . $r->model . '/lg/' . $r->model . '_1.png');
    if ($re[0] > 0) {
        $bim1 = '/images/ewon/' . $r->model . '/lg/' . $r->model . '_1.png';
    } else {
        $bim1 = '';
    };
};


if (!empty($bim1)) {
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt'></span></a>";
} else {
    $kartinka = "
<img src='$im1' alt='$alt'>";
};

if (file_exists("../sc/new.php")) {
    include("../sc/new.php");
} else {
    $class = '';
};


$name = 'EWON eFive';
$type = 'ПРОМЫШЛЕННЫЙ VPN-СЕРВЕР';
ob_start();
include dirname(__FILE__) . '/templates/price_block.php';
$out = ob_get_clean();

ob_start();



//----------------------------------right part content -----------------------
$out .= "
<div id=cont_rp>

";

$im = "<img src='/images/tick.png' width=15 style=''>";
$st = ' style="vertical-align: text-top;"';
$he = "style='  padding-bottom: 10px;' class=hl_text";
$vc = "valign=center";
$out .= "<br>
<table width=100%>
<tr><td $st>$im </td><td valign=middle $he>Получение SCADA данных от оборудования в реальном времени через Интернет</td></tr>
<tr><td$st>$im </td><td $he>Соединение до 200 PLC, HMI и др. устройств через 1&nbsp;сервер eFive</td></tr>
<tr><td$st>$im </td><td $he>Возможность использования протоколов: PPI, MPI, Profibus, ISO TCP, DF1, EtherNet/IP, Modbus RTU, Modbus TCP, FINS Hostlink, FINS TCP и др.</td></tr>
<tr><td $st width=30>$im </td><td $he>Безопасное VPN-соединение</td></tr>
<tr><td $st >$im </td><td $he>Легкая установка и настройка с помощью мастера</td></tr>
</table>
<img src='/images/ewon/scada.png' alt='получение данных SCADA в реальном времени' title='получение данных SCADA в реальном времени' style='float:left;     margin: 30px 70px 0px 30px' />
<img src='/images/ewon/secure.png' alt='безопасное соединение через Интернет' title='безопасное соединение через Интернет' style='float:left;   margin: 30px 70px 0px 0px;' />
<img src='/images/ewon/easy.png' alt='легкая установка и настройка с помощью мастера' title='легкая установка и настройка с помощью мастера' style='float:left;   margin: 30px 0px 0px 0px;' />
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

" . '
<div class="feat_cont" style="   width: 1150px;
  background: rgb(239, 239, 239);
  padding: 0px;
  border-top: 1px groove white;
  margin: 10px 0px 15px -1px;
  border-bottom: 1px solid rgb(110, 110, 110);
  box-shadow: gray 0px 2px 3px;
  background-color: rgb(211, 215, 220);
  background-image: -webkit-gradient( linear, left top, right bottom, color-stop(0, rgb(232, 240, 250)), color-stop(1, rgb(189, 189, 189)) );
  background-image: -o-linear-gradient(right bottom, rgb(232, 240, 250) 0%, rgb(189, 189, 189) 100%);
  background-image: -moz-linear-gradient(right bottom, rgb(232, 240, 250) 0%, rgb(189, 189, 189) 100%);
  background-image: -webkit-linear-gradient(right bottom, rgb(232, 240, 250) 0%, rgb(189, 189, 189) 100%);
  background-image: -ms-linear-gradient(right bottom, rgb(232, 240, 250) 0%, rgb(189, 189, 189) 100%);
  background-image: linear-gradient(to right bottom, rgb(232, 240, 250) 0%, rgb(189, 189, 189) 100%);

  ">
<div class="feat1" style="padding: 30px;border-top: none; text-align: center;">
' . "
<iframe width='480' height='270' src='//www.youtube.com/embed/KxHauD-fb6M?rel=0' frameborder='0' allowfullscreen style='  margin-right: 20px;  width: 482px'></iframe>&nbsp;&nbsp;&nbsp;
<iframe width='480' height='270' src='//www.youtube.com/embed/ri1ntFxVVUc?rel=0' frameborder='0' allowfullscreen></iframe>
" . '
</div>



</div>


' . "



<br><br>
<div id=rou_desc style='margin: 10px auto;'>
<img src='/images/ewon/efive-scheme.png' style='float:right;  margin-left: 37px;  width: 482px;margin-bottom: 20px;'>
<strong>Сервер eWON eFive</strong> — легкая организация VPN-сети, в которую включены все ваши удаленные объекты с оборудованием (PLC, HMI, датчики, и т.д. ) с&nbsp;постоянным подключением всех удаленных устройств к SCADA.
<br /><br />
Это дает  возможность SCADA постоянно опрашивать устройства, как будто они в&nbsp;локальной сети.<br /><br /><br />
<center><strong>eWON eFive = Firewall + VPN-сервер</strong></center><br /><br />


На стороне SCADA устанавливается VPN-сервер eFIVE.<br /><br />
Сервер eFIVE обеспечивает поддержание VPN-сети и преобразование удаленных IP-адресов в локальные для удобства опроса SCADA.<br /><br />
На стороне удаленного оборудования устанавливаются VPN-роутеры eWON.<br /><br />
</div>






";

$out .= "<br><div style='width:100%;display:block;margin: 0px 75px;'><span class=big_pan_name><b>Возможные модификации:</b></span></div>" . $vars;

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

 <span class=hpar style='width:357px;float:left;  text-align: left;'>Фунционал</span>	<br>
 $table_start


 <tr><td class=par_name1 >VPN</td><td class=par_val1 style='text-align:left;'>True SSL/TLS VPN (Open VPN)</td>
 <tr><td class=par_name1 >Шифрование</td><td class=par_val1 style='text-align:left;'>DES, 3DES, AES, 128/192/256-бит</td>
 <tr><td class=par_name1 >Аутентификация</td><td class=par_val1 style='text-align:left;'>PSK (предопределенные ключи), X.509 и CA (электронная подпись)</td>
 <tr><td class=par_name1 >Маршрутизация</td><td class=par_val1 style='text-align:left;'>VPN-мост на основе динамических адаптируемых таблиц</td>


 </td></tr>



  </table><br><br>

 <span class=hpar style='width:357px;float:left;  text-align: left;'>Параметры</span><span class=hpar style='width:250px;  '>eFive 25</span><span class=hpar style='  width: 248px;'>eFive 100</span><br>
 $table_start


 <tr><td class=par_name1 >Подключение VPN-роутеров eWON</td><td class=par_val1 style='width:243px;' >50 одновременных подключений</td><td class=par_val1 >200 одновременных подключений</td></tr>
 <tr><td class=par_name1 >Пропускная способность</td><td class=par_val1 >25 Мб/с</td><td class=par_val1 >55 Мб/с</td></tr>
 <tr><td class=par_name1 >Ethernet</td><td class=par_val1 >4 x 10/100/1000 Мб/с (RJ45)</td><td class=par_val1 >6 x 10/100/1000 Мб/с (RJ45)</td></tr>
  <tr><td class=par_name1 >USB</td><td class=par_val1 colspan='2'>2 x USB</td></tr>
   <tr><td class=par_name1 >Жесткий диск</td><td class=par_val1 colspan='2'>SSD для буферизации данных</td></tr>

 <tr><td class=par_name1 >COM-порты</td><td class=par_val1 >1 x RS-232 (DB9)</td><td class=par_val1 >1 x RS-232 (RJ45)</td></tr>


 <tr><td class=par_name1 >Питание</td><td class=par_val1 >адаптер 12V - 5A (в комплекте)</td><td class=par_val1 >230 VAC, 3 A max.</td></tr>


 </td></tr>



  </table><br><br>



 <span class=hpar style='width:357px;float:left;  text-align: left;'>ПО</span>	<br>
 $table_start


 <tr><td class=par_name1 >Бесплатное ПО</td><td class=par_val1 style='text-align:left;'>eGrabIt — VPN-клиент для ПК от производителя</td>


 </td></tr>



  </table><br><br>


 <span class=hpar style='width:357px;float:left;  text-align: left;'>Конструкция</span><span class=hpar style='width:250px;'>eFive 25</span><span class=hpar style='  width: 248px;'>eFive 100</span><br>
 $table_start
 <tr><td class=par_name1 >Материал корпуса</td><td class=par_val1 colspan=2>металл</td></tr>
  <tr><td class=par_name1 >Габариты</td><td class=par_val1 style='width:243px;' >44 x 230 x 152.1 мм</td><td class=par_val1 >44 x 430 x 248 мм</td></tr>
   <tr><td class=par_name1 >Рабочая температура</td><td class=par_val1 >0&deg ~ +40&deg</td><td class=par_val1 >0&deg ~ +45&deg</td></tr>
     <tr><td class=par_name1 >Охлаждение</td><td class=par_val1 >безвентиляторное</td><td class=par_val1 >вентилятор</td></tr>
   <tr><td class=par_name1 >Варианты установки</td><td class=par_val1 >настольное размещенение</td><td class=par_val1 >в стойку</td></tr>


 ";



$sp_data1 .= "</table><br><br>

 <span class=hpar style='width:357px;float:left;  text-align: left;'>Качество и безопасность</span>	<br>
 $table_start


 <tr><td class=par_name1 >Сертификаты</td><td class=par_val1 style='text-align:left;'>FCC/CE/ROHS</td>


 </td></tr>
</table>

 <style>.mytab2 tr td {text-align:center;  height: 20px;} .mytab2 tr td:first-child {text-align:left;}
 .mytab2{
    margin: 10px auto
 }
 
 </style>
 </div>";



//---------------------end tab1 -------------------------
//-------------spec ---------------------------
$out .= "<br><br>
<div style='width:100%; min-height: 500px; overflow: auto; margin: 10px auto;'>
<div id='tabs'>
  <ul>
     <li class='urlup' data='functions'><a href='#tabs-1'>ХАРАКТЕРИСТИКИ</a></li>
     <li class='urlup' data='dimensions'><a href='#tabs-2'>ГАБАРИТЫ</a></li>

     <li class='urlup' data='software'><a href='#tabs-4'>СКАЧАТЬ</a></li>
  </ul>
  <div id='tabs-1'>
     <h2>Технические характеристики $r->model</h2>
    $sp_data1 <br><br>
  </div>";


if ($GLOBALS["net"] == 0) {
    $file = $path_to_real_files . '/images/ewon/dim/eFive.jpg';
    if (file_exists($file)) {
        $yes = 1;
    }
} else {
    $file = $root_php . '/images/ewon/dim/eFive.jpg';
    $re = cu($file);
    if ($re[0] > 0) {
        $yes = 1;
    };
};
if ($yes == 1) {
    $out .= " <div id='tabs-2' style=''>
  <h2>Габариты $r->model</h2>" . '
<div style="position:absolute;margin: 246px 0px 0px 451px;font-weight: bold;  color: blue;">eFive 25</div>
<div style="position:absolute;margin: 968px 0px 0px 341px;font-weight: bold;  color: blue;">eFive 100</div>
' . "
  <img src='/images/ewon/dim/eFive.jpg' style='width:950px;'>
  </div>";
} else {
    $out .= " <div id='tabs-2'>
  Габариты 44 x 230 x 152.1 мм / 44 x 430 x 248 мм
  </div>";
};





//---------------------download section -------------------------------- ------------------------------
$file = 'install/eFive.pdf';

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
 <tr><td><div class=down_item>Начало работы с eFive</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/eFive.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft7 = '';
};

$file = 'manuals/eFive.pdf';
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
 <tr><td><div class=down_item>Брошюра (datasheet) eFive</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/manuals/eFive.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft5 = '';
};


$file = 'install/eFive-25.pdf';
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
 <tr><td><div class=down_item>Инструкция по установке eFive 25</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/eFive-25.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft1 = '';
};

$file = 'install/eFive-100.pdf';
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
 <tr><td><div class=down_item>Инструкция по установке eFive 100</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/eFive-100.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft2 = '';
};

$file = 'manuals/eFive-system-and-VPN-configuration.pdf';
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
    $soft21 = "
 <tr><td><div class=down_item>Инструкция по конфигурации системы и VPN eFive</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/manuals/eFive-system-and-VPN-configuration.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft21 = '';
};


$file = 'manuals/eFive-eGrabit.pdf';
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
 <tr><td><div class=down_item>Инструкция по сетевому подключению с помошью утилиты eGrabIt</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/manuals/eFive-eGrabit.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft3 = '';
};



/*
  if 	(file_exists('soft/eWON/egrabitsetup.exe')) {


  if ($s>1) {$s .='&nbsp;Мб';} else {$s = $s*1000;$s.='&nbsp;Кб';};
  $ver = @file_get_contents("soft/eWON/egrabitsetup.txt");
  if (!empty($ver)) {$ver = '('.$ver.')';};
  $soft8 = "
  <tr><td><div class=down_item> eGrabIt, программное обеспечение eWON <span style=\"font-weight:normal\">дня настройки сетевых подключений</span> vpn-сервера eFive $ver</div></td>
  <td><div class=dt_item>$t<br>$s</div></td>
  <td><div class=down_item><a href='/soft/eWON/egrabitsetup.exe' > <img src=/vpn-routers/soft/eGrabit_icon.png style=\"width: 33px;\"></a></div></td></tr>
  ";


  } else {$soft8 = '';};
 */

$out .= "
  <div id='tabs-4'>
  <div class=connectors>
  <h2>Файлы для работы с vpn-сервером $r->model</h2><br /><br />
  </div>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование </div></td><td><div class=down_h>  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>


$soft5
$soft7
$soft1
$soft2
$soft21
$soft3
$soft8

   </table>
 <br />   <br />
  </div>

";

$out .= '

</div>


<br /><br /><br />' . $outs;


if (!empty($_GET['tab'])) {
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
$imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";
ob_start();?>


    <meta property='og:title' content='<?=$title?>' />
    <meta property="og:image" content="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>" />
    <meta property='og:site_name' content='Русавтоматика' />
    <link rel='image_src' href="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>">

<?$expansionParam = ob_get_clean();

$template_file = 'head_canonical.html';
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
    echo "<article>";
    echo $out;
    echo "</article>";
    temp3();
    ?>