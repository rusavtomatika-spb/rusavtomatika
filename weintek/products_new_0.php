<?php

session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");

//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));

database_connect();

temp0("weintek");
top_buttons();
basket();
temp1_no_menu();
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
$res = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_object($res);

/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;есть на складах: СПБ, МСК, КИЕВ</div>";
 */

$onst = show_stock($r, 1);

//--------------------------------------------- load miniatures ---------------------
$imgroot = "/images/panel/$r->model";
$imfo = $document_root . $imgroot . "/sm";

$miniatures_in_raw = 5;


if (file_exists($imfo)) {
    $files = scandir($imfo);

    $miniatures = sizeof($files) - 2;
//echo $miniatures;

    $min_table = "<table width=350px bfcolor=red><tr>";
    $mc = 0;
    for ($i = 0; $i < $miniatures; $i++) {
        $j = $i + 1;
        $min_table .= "<td onclick='dich(\"$imgroot/$r->model" . "_$j.png\");'><img src=$imgroot/sm/$r->model" . "_$j.png width=50></td>";
        $mc++;
        if ($mc == $miniatures_in_raw) {
            $mc = 0;
            $min_table .= "</tr><tr>";
        }
    }
    while ($mc < $miniatures_in_raw) {
        $mc++;
        $min_table .= "<td></td>";
    }

    $min_table .= "</tr></table>";
    $im1 = "/images/panel/$r->model/$r->model" . "_1.png";

    if ($miniatures == 1)
        $min_table = "";
}

else {
    $min_table = "";
    $im1 = "/images/panel/$r->pic_big";
}

//-------------------------------end load miniature -------------------------------

echo "
<center>
<br><br>
<table width=1000px  height=400px>
<tr ><td colspan=2 height=50px>
<table><tr><td width=840 align=left bfcolor=#cccccc><div class=big_pan_name>$r->diagonal\" &nbsp; ПАНЕЛЬ ОПЕРАТОРА <b>$r->brand $r->model</b> </div></td><td width=50>
 <div class=pan_price_big title='Розничная цена'> ЦЕНА </div></td><td width=50 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td></tr></table>
<div class=hc1>&nbsp;</div><br>
</td></tr>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
<img src='$im1' width=400 alt=$altstr> </div>
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

 <table><tr><td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div></div> </td>
            <td><div class=but_wr> <div  class='zakazbut' idm='$r->model'onclick='show_compare(this)'><span>В сравнение</span></div></div>  </td>
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model'><span>Заказ в 1 клик</span></div></div>  </td>
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model'><span>Получить скидку</span></div> </div> </td>
 </tr>
 <tr><td colspan=4><br><div class=hc1> </div>   </td></tr>
 </table>

";

$im = "<img src='../images/tick.png' width=15 style='vertical-align: middle;'>";
$he = "height=40 class=hl_text";
$vc = "valign=center";
echo "<br>
<table width=100%>
<tr><td valign=center>$im </td><td valign=middle $he>ПО EasyBuilder8000</td></tr>
<tr><td width=30>$im </td><td $he>Алюминиевый корпус</td></tr>
<tr><td>$im </td><td $he>4 COM порта</td></tr>
<tr><td>$im </td><td $he>Загрузка проекта: miniUSB, USB, Ethernet</td></tr>
<tr><td>$im </td><td $he>2000 окон</td></tr>
<tr><td>$im </td><td $he>2000 окон</td></tr>



</table>
</div>
";



// --------------------- end right part content -----------------------

echo "</td></tr></table>"; // end big table
//----------------------------------------end pics ----------------------------
//$bg1="bgcolor=effdf6";//bgdedede";
$bg1 = "style='background: #f0f0f0';"; //bgdedede";
$bg2 = "style='background: #dedede';"; //bgdedede";
//$bg2="bgcolor=fbfeb2";//cdcdcd";
$bg_white = "bgcolor=ffffff";
$white_line = "<tr><td class=par_name1 $bg_white> &nbsp; </td><td class=par_val1 $bg_white>  &nbsp;</td></tr>";

//----------------------------tab1 -----------------------------------------
$sp_data1 = "
<table width=80%>
 <tr><td class=par_name1 $bg1>Диагональ</td><td class=par_val1 $bg1></td></tr>
 <tr><td class=par_name1 $bg2>Разрешение</td><td class=par_val1 $bg2>$r->resolution</td></tr>
 <tr><td class=par_name1 $bg1>Яркость</td><td class=par_val1  $bg1>$r->brightness</td></tr>
 <tr><td class=par_name1 $bg2>Контрастность</td><td class=par_val1 $bg2>$r->contrast</td></tr>
 <tr><td class=par_name1 $bg1>Цветность</td><td class=par_val1 $bg1>$r->colors</td></tr>

 $white_line
 <tr><td class=par_name1 $bg2>Тип сенсора</td><td class=par_val1 $bg2>$r->touch</td></tr>
 <tr><td class=par_name1 $bg1>Процессор</td><td class=par_val1 $bg1>$r->cpu_type</td></tr>
 <tr><td class=par_name1 $bg2>Частота</td><td class=par_val1 $bg2>$r->cpu_speed</td></tr>
 <tr><td class=par_name1 $bg1>ОЗУ</td><td class=par_val1 $bg1>$r->ram</td></tr>
 <tr><td class=par_name1 $bg2>Flash ( встроенный )</td><td class=par_val1 $bg2>$r->flash</td></tr>

 $white_line

 <tr><td class=par_name1 $bg1>Посл. интерфейсы</td><td class=par_val1 $bg1>$r->serial_full</td></tr>
 <tr><td class=par_name1 $bg2>Поддержка MPI</td><td class=par_val1 $bg2>187,5 K</td></tr>
 <tr><td class=par_name1 $bg1>USB Host</td><td class=par_val1 $bg1>$r->usb_host</td></tr>
 <tr><td class=par_name1 $bg2>USB Client</td><td class=par_val1 $bg2>$r->usb_client</td></tr>
 <tr><td class=par_name1 $bg1>SD карта</td><td class=par_val1 $bg1>$r->sdcard</td></tr>
 <tr><td class=par_name1 $bg2>Ethernet</td><td class=par_val1 $bg2>$r->ethernet</td></tr>
 <tr><td class=par_name1 $bg1>Аудио</td><td class=par_val1 $bg1>$r->audio</td></tr>
 <tr><td class=par_name1 $bg2>Видеовход</td><td class=par_val1 $bg2>$r->video_input</td></tr>
 <tr><td class=par_name1 $bg1>CAN</td><td class=par_val1 $bg1>$r->can_bus</td></tr>

 $white_line

 <tr><td class=par_name1 $bg1>Напряжение питания</td><td class=par_val1 $bg1>$r->voltage</td></tr>
 <tr><td class=par_name1 $bg2>Потребляемый ток</td><td class=par_val1 $bg2>$r->current</td></tr>

 $white_line";



$sp_data1 .= " $white_line ";



if ($r->software == "EasyBuilder8000")
    $sp_data1 .= " <tr><td class=par_name1 $bg2>ПО для разработки экранов</td><td class=par_val1 $bg2>EasyBuilder8000</td></tr> ";

if ($r->software == "EasyBuilderPro")
    $sp_data1 .= " <tr><td class=par_name1 $bg2>ПО для разработки экранов</td><td class=par_val1 $bg2>EasyBuilderPro</td></tr> ";

if ($r->software == "")
    $sp_data1 .= "
 <tr><td class=par_name1 $bg2>Операционная система</td><td class=par_val1 $bg2>$r->os</td></tr> ";

$sp_data1 .= "
</table>
";

$sp_data2 = "";
$sp_data2 .= "<table width=80%><tr>  ";




if ($r->software == "EasyBuilder8000") {
    $vv = "1.2"; //=show_eb_ver();
    $sp_data2 .= "
<tr>
<td width=40 ><a href=$eb8000 > <img src=$im/soft.jpg border=0 alt=$altstr> </a></td>
<td><a href=$eb8000 class=skach title=$altstr> Скачать EasyBuilder 8000 v$vv </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$eb8000ug' class=skach title=$altstr target=_blank> Скачать описание ПО </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/PLC_connection_guide.pdf' class=skach title=$altstr target=_blank>Рук-во по подключению PLC </a> </td>

</tr> ";
}


if ($r->software == "EasyBuilderPro") {
    $vv = "3.2"; //show_pro_ver();
    $sp_data2 .= "
<tr>
<td width=40 ><a href='../ebpro/EBpro_setup.zip' > <img src=$im/soft.jpg border=0 alt=$altstr> </a></td>
<td><a href='../ebpro/EBpro_setup.zip' class=skach title=$altstr> Скачать EasyBuilder Pro v$vv </a> </td>

<td width=40 ><a href=$root/manuals/EBPro_Manual_All_In_One.pdf target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/EBPro_Manual_All_In_One.pdf' class=skach title=$altstr target=_blank> Скачать описание ПО </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/PLC_connection_guide.pdf' class=skach title=$altstr target=_blank>Рук-во по подключению PLC </a> </td>

</tr> ";
}


$sp_data2 .= "
<tr>
<td width=40 ><a href=$root/manuals/" . $r->model . ".pdf target=_blank> <img src=$im/manual.jpg  border=0 alt=$altstr></a></td>
<td><a href='$root/manuals/" . $r->model . ".pdf' class=skach title=$altstr target=_blank> Скачать описание панели</a></td>

<td width=40 ><a href=$root/install/$r->install_doc target=_blank> <img src=$im/manual.jpg  border=0 alt=$altstr></a></td>
<td><a href='$root/install/$r->install_doc' class=skach title=$altstr target=_blank>Скачать рук-во по установке панели</a></td>";

if ($r->software)
    $sp_data2 .= "
<td width=40 ></td>
<td><a href='$root/weintek/plclist.php' class=skach title='список контроллеров, с которыми совместимы панели Weintek' target=_blank>Совместимые контроллеры</a></td>";

$sp_data2 .= "
</tr></table>

</td></tr></table>
";



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
  <img src='../images/panel/dim/$r->model.png'>
  </div>
  <div id='tabs-3'>
  <div class=connectors>
  COM-порты панели оператора $r->model
  </div><br><br>
  ";

show_com_connector($r->model);

echo "</div>";

//---------------------download section -------------------------------- ------------------------------
if ($r->series == "MT6000i" || $r->series == "MT8000i")
    $usb = "<br>USB драйвера для подключения панели $r->model к ПК устанавливаются
  автоматически при установке EasyBuilder8000";
else
    $usb = "";

echo "
  <div id='tabs-4'>
  <div class=connectors>
  Файлы для работы с  панелью оператора $r->model
  </div><br><br>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование </div></td><td><div class=down_h>  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>
   <tr><td><div class=down_item>  Программное обеспечение EasyBuilder8000 v4.65.06</div>
   <div class=down_item_descr> Программное обеспечение EasyBuilder8000 применяется для создания пользовательских проектов для операторских панелей Weintek следующих
   серий: <br>
   Серия MT6000i, Серия MT8000i<br>
   Использование ПО EasyBuilder8000 полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.
   $usb
   </div></td>
   <td><div class=dt_item>";
echo get_file_date($EB8000_link);
echo "<br>(рус)</div>
   </td> </td><td><div class=down_item><a href='$EB8000_link'><img src=/images/soft.jpg></a><div> </td> </tr>

   <tr><td><div class=down_item>  Руководство к ПО EasyBuilder8000  </div></td>
   <td><div class=dt_item>";
echo get_file_date($EB8000_manual_link);
echo "<br>(eng)</div></td>
   <td><div class=down_item><a href='$EB8000_manual_link'><img src=/images/manual.jpg></a></div></td></tr>

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



   <tr><td><div class=down_item> Руководство по подключению контроллеров (PLC) к  панели оператора $r->model </div>
   <div class=down_item_descr> В руководстве описано подключение к более, чем 100 PLC различных производителей,
   даны схемы распайки кабелей для подключения панели оператора $r->model к этим PLC, описаны регистры, к которым дают доступ
   драйвера данных PLC. <br> Все драйверы для всех PLC, упомянутых в данном руководстве, уже установлены в операторской панели $r->model. <br>
   При подключении панели  оператора $r->model к конкретному PLC настоятельно рекомендуется ознакомиться с соответсвующим разделом данного руководства.
   </td>

   <td><div class=dt_item>";
echo get_file_date($PLC_connect_guide);
echo "<br>(eng)</div></td>
   <td><div class=down_item><a href='$PLC_connect_guide'><img src=/images/manual.jpg></a></div></td></tr>

   </table>

  </div>
</div>
</div>
";


echo"<br><br>";
//-----------------end content

temp3();
?>