<?php

session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");

//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));

global $mysqli_db;
database_connect();
mysqli_query($mysqli_db, "SET NAMES 'cp1251'");

temp0("weintek");
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

//echo "sss=".$_SERVER['SCRIPT_FILENAME'];
//echo "sss=".$_SERVER['DOCUMENT_ROOT'];
//---------------content ---------------------
?>
<script>
    function dich(num)
    {
        $("#dd").html("<img src='" + num + "'>");
    }
    /*
     $(function() {
     $( "#tabs" ).tabs({
     event: "mouseover"
     });
     });
     */
    $(function () {
        $("#tabs").tabs();
    });



</script>
<?

//$num="MT8070iH";
$num = str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";


$res = mysqli_query($mysqli_db, $sql) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);



/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;есть на складах: СПБ, МСК, КИЕВ</div>";
 */

$onst = show_stock($r, 1);

$min_table = miniatures($r->model, 5, 10, 350); // mins_in_row, mins_max, table_width
$im1 = get_big_pic($r->model);
$alt = get_kw("alt");

echo "
<center>
<br><br>
<table width=1000px  height=400px>
<tr ><td colspan=2 height=50px>
<table><tr><td width=840 align=left bfcolor=#cccccc><h1 class=big_pan_name>7\" <strong>ПАНЕЛЬ ОПЕРАТОРА с ОС ANDROID</strong> $r->model</b> </h1></td><td width=50>
 <div class=pan_price_big title='Розничная цена'> ЦЕНА </div></td><td width=60 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td></tr></table>
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
echo "
<div id=cont_rp>

<table><width=100%>

 <tr><td colspan=3> &nbsp;</td></tr>
 <tr><td width=5>&nbsp;</td><td width=80 class=h2_text>Наличие: </td><td > $onst</td>
 <td>  </td>  </tr>

 </table><br>

 <table><tr><td><div class=but_wr><div  class='zakazbut addToCart' idm='$r->model'><span>В корзину</span></div></div> </td>
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
if ($r->case_material != "Пластик")
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

$proj_load1 .= "<tr><td>$im </td><td $he>Загрузка проекта:$proj_load</td></tr>";

if ($r->os != "")
    $proj_load1 = "";


$os1 = "<tr><td valign=center>$im </td><td valign=middle $he>ПО: $r->software (бесплатное)</td></tr> ";
if ($r->os != "")
    $os1 = "<tr><td valign=center>$im </td><td valign=middle $he>Панель с операционной системой $r->os .NET $r->dotnet</td></tr> ";


$inter = $r->serial;
if ($r->ethernet != "")
    $inter .= ", Ethernet";
if ($r->usb_host != "")
    $inter .= ", USB host";
if ($r->sdcard != "")
    $inter .= ", SD карта";
if ($r->can_bus != "")
    $inter .= ", CAN";
if ($r->linear_out != "")
    $inter .= ", линейный аудио выход";

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

echo "<br>
<table width=100%>

<tr><td width=30>$im </td><td $he>ОС Android 4.0</td></tr>
<tr><td width=30>$im </td><td $he>Загрузка приложений с маркета</td></tr>
<tr><td width=30>$im </td><td $he>Процессор Cortex-A9 1.2 ГГц</td></tr>
<tr><td width=30>$im </td><td $he>Емкостной сенсорный дисплей</td></tr>
<tr><td width=30>$im </td><td $he>Ethernet, Wi-Fi,  RS-485</td></tr>
<tr><td width=30>$im </td><td $he>Поворотный экран</td></tr>



</table>
</div>
";



// --------------------- end right part content -----------------------

echo "</td></tr></table>"; // end big table
//----------------------------------------end pics ----------------------------


$bg1 = "style='background: #fefefe';";
$bg2 = "style='background: #f5f5f5';";
$table_start = "<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";


//----------------------------tab1 -----------------------------------------


if ($r->ethernet != "" && $r->software != "") {
    $dop = "<tr><td class=par_name1 $bg1>Удаленный доступ к панели</td><td class=par_val1 $bg1>FTP(архивы, рецепты, журнал событий), VNC (удаленная работа),<br>
   EasyAccess (удаленная работа, загрузка проекта )</td></tr>
   <tr><td class=par_name1 $bg2>Ftp доступ к памяти панели</td><td class=par_val1 $bg2>" . ($r->ftp_access_hmi_mem ? "Есть" : "-") . "</td></tr>
   <tr><td class=par_name1 $bg1>Ftp доступ к SD карте и флешке</td><td class=par_val1 $bg1>" . ($r->ftp_access_sd_usb ? "Есть" : "-") . "</td></tr>
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

$modbus = "<tr><td class=par_name1 $bg2>Поддержка Modbus</td><td class=par_val1 $bg2>$modbus</td></tr>";
if ($r->os != "")
    $modbus = "";

$mpi = "<tr><td class=par_name1 $bg1>Поддержка MPI</td><td class=par_val1 $bg1>187,5 K</td></tr>";
if ($r->os != "")
    $mpi = "";

$mount = "";
if ($r->wall_mount != "")
    $mount .= "в стену";
if ($r->vesa75 != "")
    $mount .= ", VESA 75x75";
if ($r->vesa100 != "")
    $mount .= ", VESA 100x100";


$usb_drv = "<tr><td class=par_name1 $bg2>Драйвера USB (для загрузки проекта с ПК в панель )</td><td class=par_val1 $bg2>устанавливаются при установке $r->software</td></tr>";
if ($r->usb_client == "")
    $usb_drv = "";

$sp_data1 = "
 <div style='width:90%;'>
 <span class=hpar>Дисплей</span><br>
 $table_start
 <tr><td class=par_name1 $bg1>Диагональ</td><td class=par_val1 $bg1>$r->diagonal\"</td></tr>
 <tr><td class=par_name1 $bg2>Разрешение</td><td class=par_val1 $bg2>$r->resolution</td></tr>
 <tr><td class=par_name1 $bg1>Яркость</td><td class=par_val1  $bg1>$r->brightness кд/м2</td></tr>
 <tr><td class=par_name1 $bg2>Контрастность</td><td class=par_val1 $bg2>$r->contrast</td></tr>
 <tr><td class=par_name1 $bg1>Цветность</td><td class=par_val1 $bg1>$r->colors цветов</td></tr>
 <tr><td class=par_name1 $bg2>Тип подсветки</td><td class=par_val1 $bg2>$r->backlight</td></tr>
 <tr><td class=par_name1 $bg1>Время жизни подсветки</td><td class=par_val1 $bg1>$r->backlight_life ч</td></tr>
 <tr><td class=par_name1 $bg2>Тип сенсора</td><td class=par_val1 $bg2>$r->touch</td></tr>
 </table><br><br>

 <span class=hpar>Параметры</span><br>
 $table_start

 <tr><td class=par_name1 $bg1>Процессор</td><td class=par_val1 $bg1>$r->cpu_type</td></tr>
 <tr><td class=par_name1 $bg2>Частота</td><td class=par_val1 $bg2>$r->cpu_speed МГц</td></tr>
 <tr><td class=par_name1 $bg1>ОЗУ</td><td class=par_val1 $bg1>$r->ram Мб</td></tr>
 <tr><td class=par_name1 $bg2>Flash ( встроенный )</td><td class=par_val1 $bg2>$r->flash Мб</td></tr>
 <tr><td class=par_name1 $bg1>RTC ( часы реального времени )</td><td class=par_val1 $bg1>" . ($r->rtc ? $r->rtc : '-') . "</td></tr>
 <tr><td class=par_name1 $bg2>Напряжение питания</td><td class=par_val1 $bg2>$r->voltage_min-$r->voltage_max В DC</td></tr>
 <tr><td class=par_name1 $bg1>Потребляемый ток</td><td class=par_val1 $bg1>$r->current А</td></tr>
 </table><br><br>

 <span class=hpar>Интерфейсы</span><br>
 $table_start
 <tr><td class=par_name1 $bg1>Последовательные интерфейсы</td><td class=par_val1 $bg1>RS-485</td></tr>
 $modbus
 $mpi
 <tr><td class=par_name1 $bg2>USB Host</td><td class=par_val1 $bg2>есть(на тыльной стороне)</td></tr>
 <tr><td class=par_name1 $bg1>USB Client</td><td class=par_val1 $bg1> - </td></tr>
 <tr><td class=par_name1 $bg2>Слот microSD карты</td><td class=par_val1 $bg2> micro SD</td></tr>
 <tr><td class=par_name1 $bg1>Ethernet</td><td class=par_val1 $bg1>есть </td></tr>
 <tr><td class=par_name1 $bg2>Звуковая система/td><td class=par_val1 $bg2>динамики 2х 1Wt</td></tr>
 </table><br><br>

 <span class=hpar>Конструкция</span><br>
 $table_start
 <tr><td class=par_name1 $bg1>Материал корпуса</td><td class=par_val1 $bg1>$r->case_material</td></tr>
 <tr><td class=par_name1 $bg2>Степень защиты по фронту</td><td class=par_val1 $bg2>IP65</td></tr>
 <tr><td class=par_name1 $bg2>Способ охлаждения</td><td class=par_val1 $bg2>" . ($r->cpu_fan ? "вентилятор" : "безвентиляторное") . "</td></tr>
 <tr><td class=par_name1 $bg1>Варианты установки</td><td class=par_val1 $bg1>$mount</td></tr>
 <tr><td class=par_name1 $bg1>Комплект поставки</td><td class=par_val1 $bg1>$r->set</td></tr>
 <tr><td class=par_name1 $bg1>Разъем питания</td><td class=par_val1 $bg1>$r->power_connector</td></tr>
 <tr><td class=par_name1 $bg2>Габариты</td><td class=par_val1 $bg2>$r->dimentions мм</td></tr>
 <tr><td class=par_name1 $bg1>Вырез под посадку</td><td class=par_val1 $bg1>$r->cutout мм</td></tr>
 <tr><td class=par_name1 $bg2>Вес</td><td class=par_val1 $bg2>$r->netto кг</td></tr>
 <tr><td class=par_name1 $bg1>Рабочая температура</td><td class=par_val1 $bg1>$r->temp_min&deg - $r->temp_max&deg</td></tr>
 </table><br><br>

  <span class=hpar>ПO</span><br>
 $table_start";
if ($r->os != "")
    $sp_data1 .= "
 <tr><td class=par_name1 $bg2>Установленная операционная система</td><td class=par_val1 $bg2>$r->os</td></tr>
 <tr><td class=par_name1 $bg2>.NET framework</td><td class=par_val1 $bg2>$r->dotnet</td></tr>
 <tr><td class=par_name1 $bg2>ПО</td><td class=par_val1 $bg2>с панелью не поставляется никакое ПО. В EasyBuilder8000 и EasyBuilderPro нельзя
 разработать проект для этой панели. Для разработки проектов необходимо использовать любую среду для создания проектов для $r->os, например Visual Studio</td></tr>

 ";
else
    $sp_data1 .= "
 <tr><td class=par_name1 $bg2>ПО для разработки проектов</td><td class=par_val1 $bg2>$r->software</td></tr>
 <tr><td class=par_name1 $bg1>Максимальное количество экранов в проекте</td><td class=par_val1 $bg1>1999</td></tr>
 $usb_drv
 <tr><td class=par_name1 $bg1>Драйвера для работы с контроллерами</td><td class=par_val1 $bg1>уже установлены в панели</td></tr>
 <tr><td class=par_name1 $bg2>Возможность сохранения архивов данных</td><td class=par_val1 $bg2>$arch</td></tr>
 <tr><td class=par_name1 $bg1>Способы загрузки проекта в панель</td><td class=par_val1 $bg1>$proj_load</td></tr>
 <tr><td class=par_name1 $bg1>Максимальный размер проекта</td><td class=par_val1 $bg1>$r->project_size_mb Мб</td></tr>
 <tr><td class=par_name1 $bg1>Объем памяти для сохранения архивов в панели</td><td class=par_val1 $bg1>$r->history_data_size_mb Мб</td></tr>

 <tr><td class=par_name1 $bg2>Возможность создания пользовательских протоколов</td><td class=par_val1 $bg2>Есть</td></tr>
  $dop
 <tr><td class=par_name1 $bg1>Операционная система</td><td class=par_val1 $bg1>возможно, она и есть в панели, но к ее функциям невозможно получить доступ. Невозможно запускать никакие
пользовательские исполняемые файлы. Программист может
  пользоваться только теми возможностями, которые предоставляет $r->software </td></tr>
    ";

$sp_data1 .= "</table></div><br><br>";




//---------------------end tab1 -------------------------
//-------------spec ---------------------------
echo "<br><br>
<div style='width:1100px; min-height: 500px; overflow: auto; '>
<div id='tabs'>
  <ul>
    <li><a href='#tabs-1'>ХАРАКТЕРИСТИКИ</a></li>
    <li><a href='#tabs-2'>ГАБАРИТЫ</a></li>
    <li><a href='#tabs-3'>СХЕМЫ</a></li>
    <li><a href='#tabs-4'>СКАЧАТЬ</a></li>
  </ul>
  <div id='tabs-1'>
    $sp_data1
  </div>
  <div id='tabs-2'>
  <img src='../images/weintek/dim/$r->model.png'>
  </div>
  <div id='tabs-3'>
  <div class=connectors>
  COM-порты панели оператора $r->model
  </div><br><br>
  ";

show_com_connector($r->model);

echo "</div>";

//---------------------download section -------------------------------- ------------------------------
if ($r->series == "MT6000i" || $r->series == "MT8000i" || $r->series = "eMT3000")
    $usb = "<br>USB драйвера для подключения панели $r->model к ПК устанавливаются
  автоматически при установке $r->software";
else
    $usb = "";

if ($r->software == "EasyBuilder8000") {
    $ver = file_get_contents($GLOBALS["EB8000_version"]);
    $so = $GLOBALS["EB8000_link"];
    $ma = $GLOBALS["EB8000_manual_link"];
    $serii = "Серия MT6000i, Серия MT8000i";
} else if ($r->software == "EasyBuilderPro") {
    $ver = file_get_contents($GLOBALS["EBPro_version"]);
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

echo "
  <div id='tabs-4'>
  <div class=connectors>
  Файлы для работы с  панелью оператора $r->model
  </div><br><br>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование </div></td><td width=100><div class=down_h>  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>

   $soft1
   $soft2

   <tr><td><div class=down_item> Брошюра на панель оператора $r->model </div></td>
   <td><div class=dt_item>";
echo get_file_date("/manuals/$r->model.pdf");
echo "<br>(eng)</div></td>
   <td><div class=down_item><a href='/manuals/$r->model.pdf'><img src=/images/manual.jpg></a></div></td></tr>

   <tr><td><div class=down_item> Руководство по установке операторской панели $r->model </div></td>
   <td><div class=dt_item>";
echo get_file_date("/install/$r->install_doc");
echo "<br>(eng)</div></td>
   <td><div class=down_item><a href='/install/$r->install_doc' > <img src=/images/manual.jpg></a></div></td></tr>

   $soft3


   </table>

  </div>
</div>
</div>
";


echo"<br><br>";
//-----------------end content

temp3();
?>