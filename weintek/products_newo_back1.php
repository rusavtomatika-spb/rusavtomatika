<?php
session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");

//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));

database_connect();




//echo "sss=".$_SERVER['SCRIPT_FILENAME'];
//echo "sss=".$_SERVER['DOCUMENT_ROOT'];
//---------------content ---------------------

$prices_out = '
<script>
function dich(num)
 {
   $("#dd").html("<img src=\'"+num+"\'>");
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



  </script> ';


$var_array = explode("/", $_SERVER['REQUEST_URI']);
$levels = count($var_array);
$end_page = $levels - 1;

//$num="MT8070iH";
//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$num = str_replace(".php", "", $var_array[$end_page]);

$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_object($res);
//echo basename($_SERVER['PHP_SELF']);
/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;есть на складах: СПБ, МСК, КИЕВ</div>";
 */

if ($r->type == 'hmi') {
    $type = 'ПАНЕЛЬ ОПЕРАТОРА';
    $title = 'Панель оператора ' . $r->model;
};
if ($r->type == 'panel_pc') {
    $type = 'ПАНЕЛЬНЫЙ КОМПЬЮТЕР';
    $title = 'Панельный компьютер ' . $r->model;
};
if ($r->type == 'open_hmi') {
    $type = 'OPEN HMI';
    $title = 'Open HMI ' . $r->model;
};
if ($r->type == 'machine-tv-interface') {
    $type = 'ИНТЕРФЕЙС MACHINE-TV';
    $title = 'Интерфейс Machine-TV ' . $r->model;
};
if ($r->type == 'cloud_hmi') {
    $type = 'ОБЛАЧНЫЙ ИНТЕРФЕЙС';
    $title = 'Облачный интерфейс ' . $r->model . ' Weintek';
    $keywords = 'Облачный, интерфейс, ' . $r->model . ', промышленный, Weintek, панельный, компьютер, диагональ';
    $description = 'Облачный интерфейс ' . $r->model . ' Weintek - промышленные компьютеры последнего поколения';
};
if ($r->type == 'monitor') {
    $type = 'ВСТРАИВАЕМЫЙ ПРОМЫШЛЕННЫЙ МОНИТОР';
    $title = $r->diagonal . '&quot; Встраиваемый промышленный монитор ' . $r->model;
    $keywords = 'Встраиваемый, промышленный, монитор, ' . $r->model . ', IFC, диагональ ' . $r->diagonal . '&quot;';
    $description = 'Встраиваемый промышленный монитор ' . $r->model . 'с диагональю ' . $r->diagonal . '&quot; - оптимальное сочетание цены и качества';
};

$onst = show_stock($r, 1);

$min_table = miniatures($r->model, 5, 10, 350); // mins_in_row, mins_max, table_width
//$im1=get_big_pic($r->model);
//echo $r->model;
$query_images = "SELECT * FROM `gallery` WHERE `model`='{$r->model}' ORDER BY `id`;";
//var_dump($r);
$query_images_result = mysql_query($query_images) or die("ошибка запроса022" . $query_images);
$iimg = mysql_num_rows($query_images_result);
$all_images = '';
//echo $iimg;
if ($iimg > 0) {

//$all_image .= '<table width="350" bfcolor="red"><tbody><tr>';
    for ($ij = 1; $ij <= $iimg; $ij++) {
        $img_row = mysql_fetch_assoc($query_images_result);
//var_dump($img_row);
//echo $_SERVER['DOCUMENT_ROOT'];

        if ($r->type == 'monitor') {
            $path = 'monitors/img/';
            if (file_exists($root_php . $path . $img_row[s_img_path])) {
                $im1 = $path . $img_row[s_img_path];
            };
        } elseif ($r->type == 'cloud_hmi') {
            $path = 'weintek/img/';

            if (file_exists($root_php . $path . $img_row[s_img_path])) {
                $im1 = $path . $img_row[s_img_path];
            };
        } elseif ($r->type == 'hmi') {
            $path = 'weintek/img/';

            if (file_exists($root_php . $path . $img_row[s_img_path])) {
                $im1 = $path . $img_row[s_img_path];
            };
        };


        if ($ij == 1) {

            $ipath = $path . $img_row[img_path];
            $i_b_path = $img_row[img_path];
//echo $ipath.'path';
        };
        if ($img_row[alt] != '') {
            $img_alt = $img_row[alt];
        } else {
            $img_alt = $type . ' ' . $r->model . ' Изображение №' . $ij;
        };
        $all_images .= '<td onclick="dich(&quot;/' . $path . $img_row[img_path] . '&quot;,&quot;/' . $path . $img_row[img_path] . '&quot;);">
<img src="/' . $path . $img_row[img_path] . '" width="50" alt="' . $img_alt . '"></td>';
    };
//$all_image .'</tr></tbody></table>';
} else {
    $ipath = '';
};

if (empty($min_table)) {
    $min_table = $all_images;
};
if (!empty($ipath)) {
    $im1 = $ipath;
};

$alt = get_kw("alt");

$b = '/' . $r->brand . '/i';
if (preg_match($b, $r->model)) {
    $brand = '';
} else {
    $brand = $r->brand;
};

$prices_out .= "
<center>
<br><br>
<table width=1000px  height=400px>
<tr ><td colspan=2 height=50px>
<table><tr><td width=840 align=left bfcolor=#cccccc><h1 class=big_pan_name>$type $r->diagonal&quot; <b>$brand $r->model</b> </h1></td><td width=50>
 <div class=pan_price_big title='Розничная цена'> ЦЕНА </div></td><td width=60 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td></tr></table>
<div class=hc1>&nbsp;</div><br>
</td></tr>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
<img src='/$im1' alt='$alt'></div><style>#dd {text-align: center;} #dd img {max-height:300px;max-width:400px;} h2 {font-size: 14px;
color: gray;
margin: 17px 10px 12px 10px;}.com_about {
width: 200px;
float: left;}
.scheme {
width: 700px;
float: right;
padding-left: 20px;
}
.com_about img {
width: 200px;
}
.com {color: gray;}
.scheme table tr td {border: 1px solid gray;
padding: 3px 15px;
font-size: 11px;}
.gray {background-color: rgb(245, 245, 245);}
</style>
<br>
<center>
  <table width='350' bfcolor='red'><tr>$min_table</tr></table>
</td>


<td  valign=top>";
//----------------------------------right part content -----------------------
$prices_out .= "
<script>
$(document).ready(function(){
 $('.mytab2 tr:even').addClass('gray');

	});
</script>	";
$prices_out .= "
<div id=cont_rp>

<table><width=100%>

 <tr><td colspan=3> &nbsp;</td></tr>
 <tr><td width=5>&nbsp;</td><td width=80 class=h2_text>Наличие: </td><td > $onst</td>
 <td>  </td>  </tr>

 </table><br>

 <table><tr><td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div></div> </td>
            <td><div class=but_wr> <div  class='zakazbut' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div></div>  </td>
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div></div>  </td>
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </div> </td>
 </tr>
 <tr><td colspan=4><br><div class=hc1> </div>   </td></tr>
 </table>

";

$im = "<img src='../images/tick.png' width=15 style='vertical-align: middle;'>";
$he = "height=40 class=hl_text";
$vc = "valign=center";
if (($r->case_material != "Пластик") AND ( $r->type != 'monitor'))
    $cm = "<tr><td>$im </td><td $he>Литой алюминиевый корпус</td></tr>";
else
    $cm = "";

$proj_load = "";
if ($r->usb_client != "")
    $proj_load .= "с ПК по USB";
if ($r->ethernet != "") {
    if ($proj_load != "")
        $proj_load .= ", ";
    $proj_load .= "с ПК по Ethernet";
}

if ($r->usb_host != "")
    $proj_load .= ", с флешки";
if ($r->sdcard != "")
    $proj_load .= ", с SD карты";

if (!empty($proj_load)) {
    $proj_load1 .= "<tr><td>$im </td><td $he>Загрузка проекта:$proj_load</td></tr>";
} else {
    $proj_load1 = '';
};

if ($r->os != "")
    $proj_load1 = "";

if (!empty($r->software)) {
    $os1 = "<tr><td valign=center>$im </td><td valign=middle $he>ПО: $r->software (бесплатное)</td></tr> ";
};
if ($r->os != "")
    $os1 = "<tr><td valign=center>$im </td><td valign=middle $he>Панель с операционной системой $r->os .NET $r->dotnet</td></tr> ";


$inter = $r->serial;

if ($r->ethernet != "") {
    if (!empty($inter)) {
        $inter .= ", Ethernet";
    } else {
        $inter .= "Ethernet";
    };
};
if ($r->usb_host != "")
    $inter .= ", USB host";
if ($r->sdcard != "")
    $inter .= ", SD карта";
if ($r->can_bus != "")
    $inter .= ", CAN";
if ($r->linear_out != "")
    $inter .= ", линейный аудио выход";
if (!empty($inter)) {
    $inter1 = '<tr><td>' . $im . '</td><td ' . $he . '>' . $inter . '</td></tr>';
} else {
    $inter1 = '';
};

$remote = "";
if ($r->ethernet != "" && $r->os == "")
    $remote = "<tr><td>$im </td><td $he>Удаленный доступ по VNC, FTP, EasyAccess </td></tr>";
if ($r->ethernet != "" && $r->os != "")
    $remote = "<tr><td>$im </td><td $he>Удаленный доступ по VNC, FTP </td></tr>";

$fastgr = "";
if ($r->series == "iE")
    $fastgr = "<tr><td>$im </td><td $he>Быстрая работа с графикой <br>( до 10 раз быстрее, чем в других сериях )</td></tr>";
$isoports = "";
if ($r->series == "iE")
    $isoports = "<tr><td>$im </td><td $he>Полная гальваническая изоляция всех портов</td></tr>";

$speed = "";
if ($r->series == "MT8000XE")
    $speed = "<tr><td>$im </td><td $he>Процессор 1ГГц, СУПЕР скорость</td></tr>";
if (!empty($r->touch)) {
    $touch = "<tr><td>$im </td><td $he>Сенсорный экран: $r->touch</td></tr>";
};
if ((!empty($r->touch)) AND ( $r->type == 'monitor')) {
    $touch = "<tr><td>$im </td><td $he>Сенсорный экран c закаленным стеклом </td></tr>";
};
if (($r->type == 'monitor') AND ( $r->diagonal >= 6)) {
    $glas = "<tr><td>$im </td><td $he>Тонкое модульное исполнение и прочная конструкция</td></tr>";
};


if ($r->brand == 'Weintek') {
    $quality = 'Высочайшее качество и надежность';
} else {
    $quality = 'Оптимальное соотношение цены и качества';
};
if ($r->type == 'monitor') {
    if ($r->diagonal >= 10) {
        $glas2 = "<tr><td>$im </td><td $he>VGA + DVI + Audio входы</td></tr>";
    } elseif ($r->diagonal >= 8) {
        $glas2 = "<tr><td>$im </td><td $he>VGA + Audio входы</td></tr>";
    } else {
        $glas2 = "<tr><td>$im </td><td $he>VGA вход</td></tr>";
    };

    $poverplag = '<tr><td>' . $im . '</td><td ' . $he . '>Выход сенсора экрана — USB</td></tr>
<tr><td>' . $im . '</td><td ' . $he . '>Hапряжение питания монитора 12 VDC, в комплекте идет блок питания 220VAC - 12 VDC</td></tr>
<tr><td>' . $im . '</td><td ' . $he . '>Пылевлагозащита по фронту ( IP65 )</td></tr>

';
};
$prices_out .= "<br>
<table width=100%>
$speed
$os1
<tr><td width=30>$im </td><td $he>$quality</td></tr>
$cm
$inter1
$remote
$proj_load1
$fastgr
$isoports

$glas
$touch
$glas2

$poverplag

</table>
</div>
";



// --------------------- end right part content -----------------------

$prices_out .= "</td></tr></table>"; // end big table
//----------------------------------------end pics ----------------------------


$bg1 = "style='background: #fefefe';";
$bg2 = "style='background: #f5f5f5';";
$table_start = "<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";

$us_tr_l = '<tr><td class=par_name1 >';
$us_tr_l1 = '</td><td class=par_val1 >';
//----------------------------tab1 -----------------------------------------


if ($r->ethernet != "" && $r->software != "") {
    $dop = "<tr><td class=par_name1 >Удаленный доступ к панели</td><td class=par_val1 >FTP(архивы, рецепты, журнал событий), VNC (удаленная работа),<br>
   EasyAccess (удаленная работа, загрузка проекта )</td></tr>
   <tr><td class=par_name1 >Ftp доступ к памяти панели</td><td class=par_val1 >" . ($r->ftp_access_hmi_mem ? "Есть" : "-") . "</td></tr>
   <tr><td class=par_name1 >Ftp доступ к SD карте и флешке</td><td class=par_val1 >" . ($r->ftp_access_sd_usb ? "Есть" : "-") . "</td></tr>
   ";
} else
    $dop = "";

$arch = "память панели";
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


$usb_drv = "<tr><td class=par_name1 >Драйвера USB (для загрузки проекта с ПК в панель )</td><td class=par_val1 >устанавливаются при установке $r->software</td></tr>";
if ($r->usb_client == "")
    $usb_drv = "";

if ($r->diagonal == 0) {
    $display_char = '';
    $without = '( без дисплея )';
} else {
    if (empty($r->backlight)) {
        if ($r->type == 'monitor') {
            $backlight = '<tr><td class=par_name1 >Тип подсветки</td><td class=par_val1 >LED</td></tr>';
        };
        if (!empty($r->backlight_life)) {
            $backlight .= '<tr><td class=par_name1 >Время наработки на отказ</td><td class=par_val1 >' . $r->backlight_life . ' ч</td></tr>';
        };
    } else {

        $backlight = '<tr><td class=par_name1 >Тип подсветки</td><td class=par_val1 >' . $r->backlight . '</td></tr>
 <tr><td class=par_name1 >Время жизни подсветки</td><td class=par_val1 >' . $r->backlight_life . ' ч</td></tr>';
    };

    if ($r->type == 'monitor') {
        $toucho = 'Резистивный с USB контроллером';
    } else {
        $toucho = $r->touch;
    };
    $display_char = " <tr><td class=par_name1>Яркость</td><td class=par_val1  >$r->brightness кд/м2</td></tr>
 $backlight
 <tr><td class=par_name1>Контрастность</td><td class=par_val1 >$r->contrast</td></tr>
 <tr><td class=par_name1>Цветность</td><td class=par_val1 >$r->colors цветов</td></tr>

 <tr><td class=par_name1>Тип сенсора</td><td class=par_val1 >$toucho</td></tr>";
    $without = '';
};
if (!empty($r->pixel_pitch)) {
    $pixel_pitch = $us_tr_l . 'Размер пикселя</td>' . $us_tr_l1 . $r->pixel_pitch . '</td></tr>';
} else {
    $pixel_pitch = '';
};
if (!empty($r->response_time)) {
    $response_time = $us_tr_l . 'Время ответа</td>' . $us_tr_l1 . $r->response_time . ' мс</td></tr>';
} else {
    $response_time = '';
};
if (!empty($r->view_angle)) {
    $view_angle = $us_tr_l . 'Угол обзора</td>' . $us_tr_l1 . $r->view_angle . '</td></tr>';
} else {
    $view_angle = '';
};

$sp_data1 = '
 <div style="width:90%;">
 <span class=hpar>Дисплей</span><br>' .
        $table_start .
        '<tr><td class=par_name1>Диагональ</td><td class=par_val1 >' . $r->diagonal . '&quot; ' . $without . '</td></tr>
 <tr><td class=par_name1>Разрешение</td><td class=par_val1 >' . $r->resolution . '</td></tr>' .
        $display_char . $pixel_pitch . $response_time . $view_angle . '
 </table><br><br>';



if (!empty($r->cpu_type)) {
    $cpu_type = "<tr><td class=par_name1 >Процессор</td><td class=par_val1 >$r->cpu_type</td></tr>";
};
if (!empty($r->cpu_speed)) {
    $cpu_speed = "<tr><td class=par_name1 >Частота</td><td class=par_val1 >$r->cpu_speed МГц</td></tr>";
};
if (!empty($r->ram)) {
    $ram = "<tr><td class=par_name1 >ОЗУ</td><td class=par_val1 >$r->ram Мб</td></tr>";
};
if (!empty($r->flash)) {
    $flash = "<tr><td class=par_name1 >Flash ( встроенный )</td><td class=par_val1 >$r->flash Мб</td></tr>";
};
if (!empty($r->rtc)) {
    $rtc = "<tr><td class=par_name1 >RTC ( часы реального времени )</td><td class=par_val1 >" . ($r->rtc ? $r->rtc : '-') . "</td></tr>";
};

$params = $cpu_type . $cpu_speed . $ram . $flash . $rtc;
if (!empty($params)) {
    $sp_data1 .= '<span class=hpar>Параметры</span><br>' .
            $table_start . $params . '</table><br><br>';
};
/*
  $sp_data1 .="<span class=hpar>Интерфейсы</span><br>
  $table_start
  <tr><td class=par_name1 >Последовательные интерфейсы</td><td class=par_val1 >$r->serial_full</td></tr>
  $modbus
  $mpi
  <tr><td class=par_name1 >USB Host</td><td class=par_val1 >".($r->usb_host?$r->usb_host:'-')."</td></tr>
  <tr><td class=par_name1 >USB Client</td><td class=par_val1 >".($r->usb_client?$r->usb_client:'-')."</td></tr>
  <tr><td class=par_name1 >Слот SD карты</td><td class=par_val1 >".($r->sdcard?$r->sdcard:'-')."</td></tr>
  <tr><td class=par_name1 >Ethernet</td><td class=par_val1 >".($r->ethernet?$r->ethernet:'-')."</td></tr>
  <tr><td class=par_name1 >Линейный аудиовыход</td><td class=par_val1 >".($r->linear_out?$r->linear_out:'-')."</td></tr>
  <tr><td class=par_name1 >Видеовход</td><td class=par_val1 >".($r->video_input?$r->video_input:'-')."</td></tr>
  <tr><td class=par_name1 >CAN</td><td class=par_val1 >".($r->can_bus?$r->can_bus:'-')."</td></tr>
  </table><br><br>";
 */

if ($r->type == 'monitor') {

    $interfaces = $us_tr_l . 'Выход сенсора экрана</td>' . $us_tr_l1 . 'USB</td></tr>' .
            $us_tr_l . 'Разъем питания</td>' . $us_tr_l1 . '2,1mm Jack</td></tr>';
    if ($r->diagonal >= 10) {
        $interfaces = $us_tr_l . 'Видео-входы</td>' . $us_tr_l1 . 'VGA + DVI</td></tr>' .
                $us_tr_l . 'Аудио-вход</td>' . $us_tr_l1 . '3,5 Jack</td></tr>' .
                $interfaces;
    } elseif ($r->diagonal >= 8) {
        $interfaces = $us_tr_l . 'Видео-вход</td>' . $us_tr_l1 . 'VGA</td></tr>' .
                $us_tr_l . 'Аудио-вход</td>' . $us_tr_l1 . '3,5 Jack</td></tr>' .
                $interfaces;
    } else {
        $interfaces = $us_tr_l . 'Видео-вход</td>' . $us_tr_l1 . 'VGA</td></tr>' .
                $interfaces;
    };
} else {
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
    if (!empty($r->voltage)) {
        $voltage = $us_tr_l . 'DC Power вход</td>' . $us_tr_l1 . 'Стандарт —' . $r->voltage . ' (' . $r->voltage_min . '-' . $r->voltage_max . ' V)</td></tr>';
    } else {
        $voltage = '';
    };
    $interfaces = $ethernet_full . $serial_full . $usb_host . $serial . $parallel_port . $pci_slot . $ps2 . $mic_in . $linear_out .
            $speakers . $vga_port . $audio . $voltage . $rgb . $dc_input . $av_input . $dvi_d . $ts_rs232 . $ts_usb . $s_video;
};
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
if (!empty($fan)) {
    $fan = $us_tr_l . 'Охлаждение</td>' . $us_tr_l1 . $fan . '</td></tr>';
} else {
    $fan = '';
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
    $power_connector = $us_tr_l . 'Разъем питания</td>' . $us_tr_l1 . $r->power_connector . ' мм</td></tr>';
} else {
    $power_connector = '';
};
if (!empty($r->netto)) {
    $netto = $us_tr_l . 'Вес (нетто / брутто)</td>' . $us_tr_l1 . $r->netto . ' / ' . $r->weight . ' кг</td></tr>';
} else {
    $netto = '';
};
if (!empty($r->set)) {
    $set = '<tr class="t_row"><td colspan="4">Комплектация: ' . $r->set . '</td></tr>';
} else {
    $set = '';
};
$Design = $case_material . $front_ip . $fan . $mount . $cutout . $dimentions . $power_connector . $netto . $set;

$sp_data1 .= '<span class=hpar>Интерфейсы</span><br>' .
        $table_start . $interfaces
        . '</table><br><br>';





/*
  $sp_data1 .="<span class=hpar>Конструкция</span><br>
  $table_start
  <tr><td class=par_name1 >Материал корпуса</td><td class=par_val1 >$r->case_material</td></tr>
  <tr><td class=par_name1 >Степень защиты по фронту</td><td class=par_val1 >IP65</td></tr>
  <tr><td class=par_name1 >Способ охлаждения</td><td class=par_val1 >".($r->cpu_fan?"вентилятор":"безвентиляторное")."</td></tr>
  <tr><td class=par_name1 >Варианты установки</td><td class=par_val1 >$mount</td></tr>
  <tr><td class=par_name1 >Комплект поставки</td><td class=par_val1 >$r->set</td></tr>
  <tr><td class=par_name1 >Разъем питания</td><td class=par_val1 >$r->power_connector</td></tr>
  <tr><td class=par_name1 >Габариты</td><td class=par_val1 >$r->dimentions мм</td></tr>
  <tr><td class=par_name1 >Вырез под посадку</td><td class=par_val1 >$r->cutout мм</td></tr>
  <tr><td class=par_name1 >Вес</td><td class=par_val1 >$r->netto кг</td></tr>
  <tr><td class=par_name1 >Рабочая температура</td><td class=par_val1 >$r->temp_min&deg - $r->temp_max&deg</td></tr>
  </table><br><br>";
 */
$sp_data1 .= '<span class=hpar>Конструкция</span><br>' . $table_start . $Design . '</table><br><br>';


if (($r->os != "") or ( $r->type != 'monitor')) {
    $sp_data1 .= "<span class=hpar>ПO</span><br>";
    $sp_data1 .= $table_start;



    if ($r->os != "")
        $sp_data1 .= "
 <tr><td class=par_name1>Установленная операционная система</td><td class=par_val1 >$r->os</td></tr>
 <tr><td class=par_name1>.NET framework</td><td class=par_val1 >$r->dotnet</td></tr>
 <tr><td class=par_name1>ПО</td><td class=par_val1 >с панелью не поставляется никакое ПО. В EasyBuilder8000 и EasyBuilderPro нельзя
 разработать проект для этой панели. Для разработки проектов необходимо использовать любую среду для создания проектов для $r->os, например Visual Studio</td></tr>

 ";
    elseif ($r->type != 'monitor')
        $sp_data1 .= "
 <tr><td class=par_name1>ПО для разработки проектов</td><td class=par_val1 >$r->software</td></tr>
 <tr><td class=par_name1>Максимальное количество экранов в проекте</td><td class=par_val1 >1999</td></tr>
 $usb_drv
 <tr><td class=par_name1>Драйвера для работы с контроллерами</td><td class=par_val1 >уже установлены в панели</td></tr>
 <tr><td class=par_name1>Возможность сохранения архивов данных</td><td class=par_val1 >$arch</td></tr>
 <tr><td class=par_name1>Способы загрузки проекта в панель</td><td class=par_val1 >$proj_load</td></tr>
 <tr><td class=par_name1>Максимальный размер проекта</td><td class=par_val1 >$r->project_size_mb Мб</td></tr>
 <tr><td class=par_name1>Объем памяти для сохранения архивов в панели</td><td class=par_val1 >$r->history_data_size_mb Мб</td></tr>

 <tr><td class=par_name1>Возможность создания пользовательских протоколов</td><td class=par_val1 >Есть</td></tr>
  $dop
 <tr><td class=par_name1>Операционная система</td><td class=par_val1 >возможно, она и есть в панели, но к ее функциям невозможно получить доступ. Невозможно запускать никакие
пользовательские исполняемые файлы. Программист может
  пользоваться только теми возможностями, которые предоставляет $r->software </td></tr>
    ";
    $sp_data1 .= "</table><br><br>";
};
if (!empty($r->temp_operating)) {
    $tempo = $us_tr_l . 'Рабочая температура</td>' . $us_tr_l1 . $r->temp_operating . '</td></tr>';
};
if (!empty($r->vibration)) {
    $vibr = $us_tr_l . 'Вибрация</td>' . $us_tr_l1 . $r->vibration . '</td></tr>';
};
if (!empty($r->shock)) {
    $shok = $us_tr_l . 'Шоковая нагрузка</td>' . $us_tr_l1 . $r->shock . '</td></tr>';
};

if ($r->type == 'monitor') {
    $powero = $us_tr_l . 'Напряжение питания</td>' . $us_tr_l1 . $r->voltage . ' VDC</td></tr>';
};
if (!empty($r->temp_storage)) {
    $tempsto = $us_tr_l . 'Температура хранения</td>' . $us_tr_l1 . $r->temp_storage . '</td></tr>';
};
if (!empty($r->humidity)) {
    $hum = $us_tr_l . 'Влажность при хранении</td>' . $us_tr_l1 . $r->humidity . '</td></tr>';
};
if (!empty($r->current)) {
    $current = $us_tr_l . 'Потребляемый ток</td>' . $us_tr_l1 . $r->current . 'А</td></tr>';
};
$expluatation = $tempo . $vibr . $shok . $tempsto . $hum . $current;

if (!empty($expluatation)) {
    $sp_data1 .= '<span class=hpar>Эксплуатация и хранение</span><br>' .
            $table_start . $powero . $expluatation .
            '</table><br><br>';
};
// $sp_data1.=  "</table></div><br><br>";

$sp_data1 .= '</div>';


//---------------------end tab1 -------------------------
//-------------spec ---------------------------

if (preg_match("/IFC/i", $r->model)) {
    $imagepath = 'img/dim';
} else {
    $imagepath = 'images/dim';
};


$query2 = "SELECT * FROM `com` WHERE `model`='{$r->model}';";
$h2_scheme = 'COM-порты устройства ' . $r->model;
$query2 = mysql_query($query2) or die("ошибка запроса0212" . $query);
$j2 = mysql_num_rows($query2);
$scheme = '';
if ($j2 > 0) {
    for ($i2 = 0; $i2 < $j2; $i2++) {
        $row2 = mysql_fetch_assoc($query2);
        $sname = str_replace("\r\n", "<br />", $row2[name]);
        $scheme .= '<div class="com" style="display: inline-block;"><div class="com_about">Название разъема:<br />' . $sname . '<br /><br />Тип:<br />' . $row2[type] . '<img class="" src="/images/' . $row2[image] . '" /><br /></div>';
        $scheme .= '<div class="scheme">';
        $com = str_replace("\"", "", $row2[com]);
        $com = str_replace("(", " (", $com);
        $com = explode(",", $com);
        $coms = count($com);
        $contacts = str_replace("\"", "", $row2[contacts]);
        $contacts = explode(";", $contacts);
        $scheme .= '<table><tr><td>Pin #</td>';
        for ($d = 0; $d < $coms; $d++) {
            $scheme .= '<td>' . $com[$d] . '</td>';
        };
        $scheme .= '</tr>';
        $cc = 1;
        for ($c = 0; $c < 9; $c++) {
            $scheme .= '<tr><td>' . $cc . '</td>';
            $contact = explode(",", $contacts[$c]);
            for ($d = 0; $d < $coms; $d++) {

                $scheme .= '<td>' . $contact[$d] . '</td>';
            };
            $scheme .= '</tr>';
            $cc++;
        };
        $scheme .= '</table></div></div><br /><br />';
    };
} else {
    $scheme = 'У ' . $r->model . ' com-порты отсутствуют.';
};

if ($r->type == 'monitor') {
    $sxemy = '';
} else {
    $sxemy = "<li><a href='#tabs-3'>СХЕМЫ</a></li>";
};
$vyvod = '<br><br>
<div style="width:1100px; min-height: 500px; overflow: auto; ">
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">ХАРАКТЕРИСТИКИ</a></li>
    <li><a href="#tabs-2">ГАБАРИТЫ</a></li>
    ' . $sxemy . '
    <li><a href="#tabs-4">СКАЧАТЬ</a></li>
  </ul>
  <div id="tabs-1">
  <h2>Технические характеристики ' . $r->model . '</h2>
    ' . $sp_data1 . '
  </div>
  <div id="tabs-2"><h2>Габариты ' . $r->model . '</h2>
  <img src="/' . $imagepath . '/' . $r->model . '.png">
  </div>';
if ($r->type != 'monitor') {
    $vyvod .= '<div id="tabs-3">
  <div class=connectors>
  <h2>COM-порты панели оператора ' . $r->model . '</h2><br />' . $scheme . '
  </div></div>
  ';
};
// echo  $vyvod.show_com_connector($r->model).'</div>';

$prices_out .= $vyvod;


//---------------------download section -------------------------------- ------------------------------
if ($r->series == "MT6000i" || $r->series == "MT8000i" || $r->series = "eMT3000")
    $usb = "<br>USB драйвера для подключения панели $r->model к ПК устанавливаются
  автоматически при установке $r->software";
else
    $usb = "";

if ($r->software == "EasyBuilder8000") {
    if (file_exists($GLOBALS["EB8000_version"])) {
        $ver = file_get_contents($GLOBALS["EB8000_version"]);
    };
    $so = $GLOBALS["EB8000_link"];
    $ma = $GLOBALS["EB8000_manual_link"];
    $serii = "Серия MT6000i, Серия MT8000i";
} else if ($r->software == "EasyBuilderPro") {
    if (file_exists($GLOBALS["EBPro_version"])) {
        $ver = file_get_contents($GLOBALS["EBPro_version"]);
    };
    $so = $GLOBALS["EBPro_link"];
    $ma = $GLOBALS["EBPro_manual_link"];
    $serii = "Серия MT8000iE, Серия eMT3000";
}

if ($r->software != "") {
    $soft1 = " <tr><td><div class=down_item>  Программное обеспечение $r->software $ver</div>
   <div class=down_item_descr> Программное обеспечение $r->software применяется для создания пользовательских проектов для операторских панелей Weintek следующих
   серий: <br>
   $serii<br>
   Использование ПО $r->software полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.
   $usb
   </div></td>
   <td><div class=dt_item>" . get_file_date($so) . "<br>(рус)</div>
   </td> </td><td><div class=down_item><a href='$so'><img src=/images/soft.jpg></a><div> </td> </tr>";

    $soft2 = "<tr><td><div class=down_item>  Руководство к ПО $r->software  </div></td>
   <td><div class=dt_item>" . get_file_date($ma) . "<br>(eng)</div></td>
   <td><div class=down_item><a href='$ma'><img src=/images/manual.jpg></a></div></td></tr> ";

    $soft3 = "<tr><td><div class=down_item> Руководство по подключению контроллеров (PLC) к  панели оператора $r->model </div>
   <div class=down_item_descr> В руководстве описано подключение к более, чем 100 PLC различных производителей,
   даны схемы распайки кабелей для подключения панели оператора $r->model к этим PLC, описаны регистры, к которым дают доступ
   драйвера данных PLC. <br> Все драйверы для всех PLC, упомянутых в данном руководстве, уже установлены в операторской панели $r->model. <br>
   При подключении панели  оператора $r->model к конкретному PLC настоятельно рекомендуется ознакомиться с соответсвующим разделом данного руководства.
   </td>

   <td><div class=dt_item>" . get_file_date($PLC_connect_guide) . "<br>(eng)</div></td>
   <td><div class=down_item><a href='$PLC_connect_guide'><img src=/images/manual.jpg></a></div></td></tr>";
} else {
    $soft1 = "";
    $soft2 = "";
    $soft3 = "";
}
if ($r->type == 'monitor') {
    $types = 'встраиваемый промышленный монитор';
} elseif ($r->type == 'cloud_hmi') {
    $types = 'интерфейс';
} else {
    $types = 'панель оператора';
};
if ($r->type == 'monitor') {
    $types1 = 'встраиваемого промышленного монитора';
} elseif ($r->type == 'cloud_hmi') {
    $types1 = 'интерфейса';
} else {
    $types1 = 'панели оператора';
};
//$file = '/home/weblec/public_html/test_weinteknet/drivers';
if (file_exists($root_php . 'upload_files/manuals/' . $r->model . '.pdf')) {
    $soft5 = "
 <tr><td><div class=down_item> Брошюра на $types $r->model </div></td>
   <td><div class=dt_item>" . get_file_date("/manuals/$r->model.pdf") . "<br>(eng)</div></td>
   <td><div class=down_item><a href='/manuals/$r->model.pdf'><img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft5 = '';
};
if (file_exists($root_php . 'upload_files/install/' . $r->model . '.pdf')) {
    $soft6 = "
 <tr><td><div class=down_item> Руководство по установке " . $types1 . " $r->model </div></td>
   <td><div class=dt_item>" . get_file_date('/install/' . $r->install_doc . '.pdf') . "<br>(eng)</div></td>
   <td><div class=down_item><a href='/install/" . $r->model . ".pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} elseif (($r->install_doc != '') AND ( file_exists($root_php . 'upload_files/install/' . $r->install_doc))) {
    $soft6 = "
 <tr><td><div class=down_item> Руководство по установке " . $types1 . " $r->model </div></td>
   <td><div class=dt_item>" . get_file_date('/install/' . $r->install_doc) . "<br>(eng)</div></td>
   <td><div class=down_item><a href='/install/" . $r->install_doc . "' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft6 = '';
};


if (file_exists($root_php . 'monitors/manuals/' . $r->model . '.pdf')) {

    $fs = (sprintf("%u", filesize($root_php . 'monitors/manuals/' . $r->model . '.pdf')) + 0) / 1024;
//$s =  ceil($fs/1024);
    $s = round($fs / 1024, 2);
    if ($s > 1) {
        $s .= '&nbsp;Мб';
    } else {
        $s = $s * 100;
        $s .= '&nbsp;Кб';
    };
    $soft7 = "
 <tr><td><div class=down_item> Брошюра (datasheet) " . $types1 . " $r->model </div></td>
   <td><div class=dt_item>" . date("d-m-Y", filemtime($root_php . 'monitors/manuals/' . $r->model . '.pdf')) . "<br>$s</div></td>
   <td><div class=down_item><a href='/monitors/manuals/$r->model.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft7 = '';
};


$prices_out .= "
  <div id='tabs-4'>
  <div class=connectors>
  <h2>Файлы для работы с $typesом $r->model</h2>
  </div>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование </div></td><td width=100><div class=down_h>  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>

   $soft1
   $soft2
   $soft5
   $soft6
   $soft7


   $soft3


   </table>
   <br /> <br />
  </div>
</div>
</div>
";


$prices_out .= "<br><br>";
//-----------------end content



$template_file = 'head.html';

$head = file_get_contents("../sc/" . $template_file);
$head = str_replace('[>TITLE<]', $title, $head);
$head = str_replace('[>DESCRIPTION<]', $description, $head);
$head = str_replace('[>KEYWORDS<]', $keywords, $head);


echo $head;
?>
<div id='mes_backgr'> </div>
<div id='body_cont' >
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width='100%' bgcolor='white'><tr height='93'><td width='300px'>
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





    echo $prices_out;



    temp3();
    ?>