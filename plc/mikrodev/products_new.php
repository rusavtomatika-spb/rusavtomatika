<?php
session_start();
define("bullshit",1);
include_once $_SERVER['DOCUMENT_ROOT']."/sc/dbcon.php";
include_once ($_SERVER['DOCUMENT_ROOT']."/sc/lib_new.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/sc/lib_controllers.php");
global $mysqli_db;
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
$num=str_replace(".php", "", $var_array[$levels]);

$sql="SELECT * FROM `controllers` WHERE `model` = '$num' ";

$res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
$r=mysqli_fetch_object($res);

$q = mysqli_num_rows($res);
if ($q > 0) {
//echo basename($_SERVER['PHP_SELF']);
/*
if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
 else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;есть на складах: СПБ, МСК, КИЕВ</div>";
*/

$series = array('A-51'=>'series_a51','A-10x'=>'series_a10x','A-52'=>'series_a52','A-61'=>'series_a61','A-118'=>'series_a1','A-218'=>'series_a2');



$kolvo = children($r->model);

if ($r->type == 'controller') {
if ($kolvo > 1) {$type='Контроллеры';} else {$type='Контроллер';};	
 $title = $r->brand.' '.$r->model.' — '.strtolower($type).' управления со склада по отличной цене';
  $title = 'ПЛК, PLC, программируемый логический контроллер Mikrodev '.$r->model.', бюджетный контроллер, со склада';
};
if ($r->type == 'module'){
	if ($kolvo > 1) {$type='Модули ввода-вывода';} else {$type='Модуль ввода-вывода';};	

  $title='Modbus модуль ввода-вывода Mikrodev '.$r->model.', бюджетный, со склада';


};



$nav = '<nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/plc/mikrodev/">Контроллеры Mikrodev</a>&nbsp;/&nbsp;'.$type.' '.$r->brand.' '.$r->model.'</nav>';

$type = strtoupper($type);
switch ($r->type)  {
case 'controller':
$types = 'контроллер';
$types1 = 'контроллера';
$keywords = 'PLC, ПЛК, Контроллер управления, '.$r->model.', '.$r->brand.', контроллеры' ;
$description = 'PLC, программируемый логический контроллер управления, '.$r->model.', '.$r->brand.' - оптимальное сочетание цены и работоспособности';
break;

case 'module':
$types = 'модуль ввода-вывода';
$types1 = 'модуля ввода-вывода';
$keywords = 'PLC, ПЛК, Модули ввода вывода, контроллеры управления, '.$r->model.', '.$r->brand.'' ;
$description = 'Модули ввода-вывода, '.$r->model.', '.$r->brand.' для PLC, программируемых логических контроллеров управления '.$r->brand.' - оптимальное сочетание цены и работоспособности';
break;
}





$onst=show_stock($r,1);

$min_table=mini_controllers($r->model, 5, 10, 350); // mins_in_row, mins_max, table_width
//$im1=get_big_pic($r->model);


//echo $r->model;

	  
//if (empty($min_table)) {$min_table = "<table width='350' bfcolor='red'><tr>".$all_images."</tr></table>";};

if (!empty($ipath)) {
$im1 = $ipath;
};
$im1 = '/images/controllers/'.strtolower($r->brand).'/'.$r->model.'/'.$r->model.'_1.png';
$bim1 = '/images/controllers/'.strtolower($r->brand).'/'.$r->model.'/lg/'.$r->model.'_1.png';
$default_im1 = '/images/controllers/'.strtolower($r->brand).'/'.$r->series.'/'.$r->series.'_1.png';
$default_bim1 = '/images/controllers/'.strtolower($r->brand).'/'.$r->series.'/lg/'.$r->series.'_1.png';
$alt=$types.' '.$r->model.' '.$r->brand;

$b = '/'.$r->brand.'/i';
if (preg_match($b, $r->model)) {
$brand = '';
} else {$brand = $r->brand;};
if (file_exists($_SERVER['DOCUMENT_ROOT']."/sc/new.php")) { include($_SERVER['DOCUMENT_ROOT']."/sc/new.php");} else {$class='';};


if ($GLOBALS["net"] == 0) {
if (!file_exists($GLOBALS["path_to_real_files"].$bim1)){
if (!file_exists($GLOBALS["path_to_real_files"].$default_bim1)) {
$bim1 = '';} else {$bim1 = $default_bim1; };};
if (!file_exists($GLOBALS["path_to_real_files"].$im1)){
if (!file_exists($GLOBALS["path_to_real_files"].$default_im1)) {
$im1 = '';} else {$im1 = $default_im1; };};

} else {
$re = cu($GLOBALS["path_to_real_files"].$bim1);
if ($re[0] <= 0) {
$re = cu($GLOBALS["path_to_real_files"].$default_bim1);
if ($re[0] <= 0) {
$bim1 = '';} else {$bim1 = $default_bim1; };};


$re = cu($GLOBALS["path_to_real_files"].$im1);
if ($re[0] <= 0) {
$re = cu($GLOBALS["path_to_real_files"].$default_im1);
if ($re[0] <= 0) {
$im1 = '';} else {$im1 = $default_im1; };};
};

if ($im1 =='') {
$im1=img($r->model,1);
$bim1=imgbig($r->model,1);
};
$min_table=img_mini($r->model,15, 5, 10, 350);

$alt=$types.' '.$r->model.' '.$r->brand;
  if (!empty($bim1)) {
$kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt'></span></a>";

} else {
$kartinka = "
<img src='$im1' alt='$alt'>";
};

if (($r->retail_price != '0') AND ($r->retail_price != '')) {
$priceb= "<td width=60 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td>";
} else {
$priceb= "<td width=60 colspan='2' style='display: initial;
padding: 0px 20px;
border: none;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >по&nbsp;запросу</td>";
};
if (file_exists($_SERVER['DOCUMENT_ROOT'].'/sc/analog.php')) {
include($_SERVER['DOCUMENT_ROOT'].'/sc/analog.php');
};
$prices_out .= "
<center>
".$nav."<br>
<h1>".$title."</h1>
<table width=1000px  height=400px>   
<tr ><td colspan=2 height=50px> 

<table><tr><td width=840 align=left bfcolor=#cccccc><h2 class=\"big_pan_name".$class."\">$type <strong> $r->model</strong> </h2></td><td width=50>
 <div class=pan_price_big title='Розничная цена'> ЦЕНА </div></td>".$priceb."</tr></table>
<div class=hc1>&nbsp;</div>".$analog."<br>
</td></tr>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div><style>h1 {text-transform: uppercase;font-size: 13px;text-align:left;width: 1000px;  margin: auto;margin-bottom: 20px;} nav {color: gray;  text-align: left;  padding: 0px 75px 0px;  font-size: 11px;
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
$sql="SELECT `model`,`retail_price` FROM `controllers` WHERE `model` = '$model' LIMIT 1 ";
   global $mysqli_db;
$res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
$r=mysqli_fetch_object($res);

if (($r->retail_price != '0') AND ($r->retail_price != '')) {
	//<td><div class=but_wr> <div  class='zakazbut' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div></div>  </td>
$price= "<td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div></div> </td>
            
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div></div>  </td>
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </div> </td>";
} else {
//	<td><div class=but_wr> <div  class='zakazbut' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div></div>  </td>
$price= "
            
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
 
<table ><tr>".buttons($r->model)."
 </tr>
 <tr><td colspan=4><br>   </td></tr>
 </table><div style='width:100%;' class=hc1> </div>

";


$tick="<img src='/images/tick.png' width=15>";
$he="height=38 class=hl_text";
$vc="valign=center";



if ((preg_match('/MP.*?0/i',$r->series)) AND ($r->type =='controller'))  {

$plus_table .= '
<tr><td width="30">'.$tick.'</td><td  class="hl_text">FBD-программирование (загрузка через USB с ПК), симуляция выполнения проекта на ПК без подключения PLC</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Библиотеки с большим количеством функций</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Мониторинг выполнения проекта на PLC в реальном времени</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Поддержка Canbus, Modbus TCP / RTU</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Ethernet / GSM / RS485, BACnet MS / TP на выбор</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Программное обеспечение SCADA от производителя</td></tr>
<tr><td width="30">'.$tick.'</td><td class="hl_text">Расширение I/O до 1024 точек с помощью модулей <a href="/plc/mikrodev/#mikrodev-xio">XIO</a> и <a href="/plc/mikrodev/#mikrodev-rio">RIO</a></td></tr>
<tr><td width="30">'.$tick.'</td><td class="hl_text">Рабочая температура: -10°~50° C </td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Напряжение питания 9~36 VDC </td></tr>
<tr><td width="30">'.$tick.'</td><td class="hl_text">Сертификаты: CE, EN 55011 (класс B)</td></tr>

';	
	
} else if ((preg_match('/XIO.*?0/i',$r->series)) AND ($r->type =='module'))  {

$plus_table .= '
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Гибкие и экономичные благодаря модульной конструкции</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">1Мб шина I/O на базе Canbus </td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Горячая замена</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Адресация переключателями или каналами связи</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Рабочая температура -10°~50° C </td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Напряжение питания 9~36 VDC </td></tr>
<tr><td width="30">'.$tick.'</td><td class="hl_text">Сертифицированы: CE, EN 55011 ( Class B )</td></tr>
';	
	
} else if ((preg_match('/RIO.*?0/i',$r->series)) AND (preg_match('/module/i',$r->type)))  {

$plus_table .= '
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Удаленный I/O для SCADA, PLC, HMI или OPC-сервера.</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Трансфер данных: данные другого блока, поступающие на вход выдаются на выходе</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Поддержка IP-протоколов MODBUS / TCP, DNP3, IEC 60870-5-104, MODBUS RTU через TCP, IEC 60870-5-101 через TCP</td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Поддержка сериальных протоколов MODBUS RTU, DNP3, IEC 60870-5-101, BACNET MS / TP</td></tr>';

if (($r->model == 'RIO200S') OR ($r->model == 'RIO201S')) {
$plus_table .= '
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Защита от статического разряда 3кВ RS485 / 422 / 232, гальваническая развязка</td></tr>';
};

if (($r->model == 'RIO200G') OR ($r->model == 'RIO201G')) {
$plus_table .= '
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Встроенный модем GSM / GPRS; диапазоны 850/900/1800/1900 МГц; отправка и прием sms</td></tr>';
};

if (($r->model == 'RIO200W') OR ($r->model == 'RIO201W')) {
$plus_table .= '
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Встроенный модем Wi-Fi; IEEE 802.11 b/g/n</td></tr>';
};
if (($r->model == 'RIO200E') OR ($r->model == 'RIO201E')) {
$plus_table .= '
<tr><td width="30">'.$tick.'</td><td  class="hl_text">RIO200E, RIO201E — встроенный Ethernet; 10/100 Мбит</td></tr>';
};

$plus_table .= '
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Рабочая температура -10°~50° C </td></tr>
<tr><td width="30">'.$tick.'</td><td  class="hl_text">Напряжение питания 9~36 VDC </td></tr>
<tr><td width="30">'.$tick.'</td><td class="hl_text">Сертифицированы: CE, EN 55011 ( Class B )</td></tr>
';	
	
}


$prices_out .= "<br>
<table width=100%>

$plus_table".


"</table>
<style>.hl_text a {text-decoration:none;color:blue;} .hl_text a:hover {text-decoration:none;} .hl_text {padding-bottom: 10px;}</style>
</div>
";



// --------------------- end right part content -----------------------
 
$prices_out .= "</td></tr></table>"; // end big table
//$vars=show_pc_variants($num);

function price($model) {
$sql="SELECT `model`,`retail_price` FROM `controllers` WHERE `model` = '$model' AND `modification`='1' LIMIT 1 ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);

if (($r->retail_price != '0') AND ($r->retail_price != '')) {
$price= "<span class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</span><span class=val_name title='Нажмите для пересчета в РУБ'> USD </span>";
} else {
$price= "<span style='' class='zakazbut inline' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >Цена&nbsp;по&nbsp;запросу</span>";
};



return $price;
}






//----------------------------------------end pics ----------------------------


 $bg1="style='background: #fefefe';";
 $bg2="style='background: #f5f5f5';"; 
 $table_start="<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";
 
$us_tr_l = '<tr><td class=par_name1 >';
 $us_tr_l1 = '</td><td class=par_val1 >';
//----------------------------tab1 -----------------------------------------
 

 $dop="";
  
  $arch="";
 
 $mount="";
if (($r->wall_mount=="есть") OR ($r->wall_mount=="yes")) {$mount.="в стену";} else {$mount.=$r->wall_mount;};


$usb_drv="";

if ($r->diagonal == 0) {$display_char = ''; $without = '';};

$pixel_pitch='';
$response_time='';
$view_angle='';


 if (!empty($r->cpu_type)) {$cpu_type ="<tr><td class=par_name1 >Процессор</td><td class=par_val1 >$r->cpu_type</td></tr>";};
  if (!empty($r->cpu_speed)) {$cpu_speed = "<tr><td class=par_name1 >Частота</td><td class=par_val1 >$r->cpu_speed МГц</td></tr>";};
//  if (!empty($r->ram)) {$ram = "<tr><td class=par_name1 >ОЗУ</td><td class=par_val1 >$r->ram Мб</td></tr>";};
   if (!empty($r->rtc)) { $rtc = "<tr><td class=par_name1 >RTC ( часы реального времени )</td><td class=par_val1 >".($r->rtc?$r->rtc:'-')."</td></tr>";};
 
$params = $cpu_type.$cpu_speed.$ram.$rtc;



 $sp_data1 .='<span class=hpar>Параметры</span><br>'.
 $table_start.$params;

if (preg_match('/L$/i',$r->model)) {
  $sp_data1 .= 
$us_tr_l.'Дисплей</td>'.$us_tr_l1.'2x16 символов LCD </td></tr>';
};



if (($r->series == 'MP100') AND ($r->type == 'controller'))  {

 $sp_data1 .=
$us_tr_l.'Время цикла'.$us_tr_l1.'< 0.17 мс</td></tr>'.
$us_tr_l.'Максимальное число блоков'.$us_tr_l1.'800</td></tr>'.
$us_tr_l.'Память под проекты'.$us_tr_l1.'2 Мб flash</td></tr>
';	
	
};

if (($r->series == 'MP200') AND ($r->type == 'controller'))  {


 $sp_data1 .=
$us_tr_l.'Время цикла'.$us_tr_l1.'< 0.17 мс</td></tr>'.
$us_tr_l.'Максимальное число блоков'.$us_tr_l1.'1500</td></tr>'.
$us_tr_l.'Память под проекты'.$us_tr_l1.'4 Мб flash</td></tr>'.
$us_tr_l.'Энергонезависимая память'.$us_tr_l1.'4 Кбит FRAM</td></tr>
';	
	
};

if (($r->series == 'MP1100') AND ($r->type == 'controller'))  {

 $sp_data1 .=
$us_tr_l.'Время цикла'.$us_tr_l1.'< 0.22 мс</td></tr>'.
$us_tr_l.'Максимальное число блоков'.$us_tr_l1.'800</td></tr>'.
$us_tr_l.'Память под проекты'.$us_tr_l1.'4 Мб flash</td></tr>'.
$us_tr_l.'Энергонезависимая память'.$us_tr_l1.'4 Кбит FRAM</td></tr>
';	

	
};





  
 




 


 $sp_data1 .='</table><br><br>';




// $modbus="RTU, ASCII, Master, Slave";
// if($r->ethernet!="") $modbus.=", TCP/IP";
 
// $modbus=$us_tr_l.'Поддержка Modbus'.$us_tr_l1.$modbus.'</td></tr>';
 if($r->os!="") $modbus="";
 
 //$mpi=$us_tr_l.'Поддержка MPI'.$us_tr_l1.'187,5 K</td></tr>';
 if($r->os!="") $mpi=""; 

if (!empty($r->rgb)) {$rgb = $us_tr_l.'RGB видеосигнал</td>'.$us_tr_l1.$r->rgb.'</td></tr>';} else {$rgb='';};
if (!empty($r->dc_input)) {$dc_input = $us_tr_l.'DC вход</td>'.$us_tr_l1.$r->dc_input.'</td></tr>';} else {$dc_input='';};
if (!empty($r->av_input)) {$av_input = $us_tr_l.'AV вход</td>'.$us_tr_l1.$r->av_input.'</td></tr>';} else {$av_input='';};
if (!empty($r->dvi_d)) {$dvi_d = $us_tr_l.'DVI-D сигнал</td>'.$us_tr_l1.$r->dvi_d.'</td></tr>';} else {$dvi_d='';};
if (!empty($r->ts_rs232)) {$ts_rs232 = $us_tr_l.'RS232 сенсорного экрана</td>'.$us_tr_l1.$r->ts_rs232.'</td></tr>';} else {$ts_rs232='';};
if (!empty($r->ts_usb)) {$ts_usb = $us_tr_l.'USB сенсорного экрана</td>'.$us_tr_l1.$r->ts_usb.'</td></tr>';} else {$ts_usb='';};
if (!empty($r->s_video)) {$s_video = $us_tr_l.'S-Video сигнал</td>'.$us_tr_l1.$r->s_video.'</td></tr>';} else {$s_video='';};
if (!empty($r->ethernet_full)) {$ethernet_full = $us_tr_l.'Ethernet</td>'.$us_tr_l1.$r->ethernet_full.'</td></tr>';} elseif
((!empty($r->ethernet)) AND ($r->ethernets != 0))
{$ethernet_full = $us_tr_l.'Ethernet</td>'.$us_tr_l1.$r->ethernet.'</td></tr>';}
else {$ethernet_full='';};
if (!empty($r->serial_full)) {$serial_full = $us_tr_l.'Последовательный интерфейс</td>'.$us_tr_l1.$r->serial_full.' <br />Защита от электростатического разряда 3 кВ, гальваническая развязка</td></tr>';} else {$serial_full='';};
if ((!empty($r->serial)) AND (empty($r->serial_full))) {$serial = $us_tr_l.'Последовательный порт</td>'.$us_tr_l1.$r->serial.' '.$r->serial_full.'</td></tr>';} else {$serial='';};

if (!empty($r->usb_host)) {$usb_host = $us_tr_l.'USB хост</td>'.$us_tr_l1.$r->usb_host.'</td></tr>';} else {$usb_host='';};
if (!empty($r->usb_client)) {$usb_client = $us_tr_l.'USB клиент</td>'.$us_tr_l1.$r->usb_client.'</td></tr>';} else {$usb_client='';};

if (!empty($r->parallel_port)) {$parallel_port = $us_tr_l.'Парралельный порт</td>'.$us_tr_l1.$r->parallel_port.'</td></tr>';} else {$parallel_port='';};
if (!empty($r->can_bus)) {$can_bus = $us_tr_l.'CANBUS</td>'.$us_tr_l1.$r->can_bus.'</td></tr>';} else {$can_bus='';};
if (!empty($r->modbus_support)) {$modbus_support = $us_tr_l.'Поддержка Modbus</td>'.$us_tr_l1.$r->modbus_support.$r->modbus_comment.'</td></tr>';} else {$modbus_support='';};
if (!empty($r->video_input)) {$video_input = $us_tr_l.'Видеовход</td>'.$us_tr_l1.$r->video_input.'</td></tr>';} else {$video_input='';};
if (!empty($r->pci_slot)) {$pci_slot = $us_tr_l.'Слот расширения PCI</td>'.$us_tr_l1.$r->pci_slot.'</td></tr>';} else {$pci_slot='';};
if (!empty($ps2)) {$ps2 = $us_tr_l.'PS/2</td>'.$us_tr_l1.$ps2.'</td></tr>';} else {$ps2='';};
if (!empty($r->sdcard)) {
if ($r->brand == 'Mikrodev' AND $r->model != 'A-52x') {$sdadd=', 1 слот (модификация с литерой &#0171;M&#0187; в названии)';}
$sdcard = $us_tr_l.'Слот карт памяти</td>'.$us_tr_l1.$r->sdcard.$sdadd.'</td></tr>';

} else {$sdcard='';};
if (!empty($r->mic_in)) {$mic_in = $us_tr_l.'Микрофонный вход</td>'.$us_tr_l1.$r->mic_in.'</td></tr>';} else {$mic_in='';};
if (!empty($r->linear_out)) {$linear_out = $us_tr_l.'Линейный выход</td>'.$us_tr_l1.$r->linear_out.'</td></tr>';} else {$linear_out='';};
if (!empty($r->speakers)) {$speakers = $us_tr_l.'Динамики</td>'.$us_tr_l1.$r->speakers.'</td></tr>';} else {$speakers='';};
if (!empty($r->vga_port)) {$vga_port = $us_tr_l.'VGA порт</td>'.$us_tr_l1.$r->vga_port.' разъем</td></tr>';} else {$vga_port='';};
if (!empty($r->audio)) {$audio = $us_tr_l.'Аудио порт</td>'.$us_tr_l1.$r->audio.' разъем</td></tr>';} else {$audio='';};
if (!empty($r->wifi)) {$wifi = $us_tr_l.'Wi-Fi</td>'.$us_tr_l1.$r->wifi.'</td></tr>';} else {$wifi='';};
//if (!empty($r->voltage)) {$voltage = $us_tr_l.'DC Power вход</td>'.$us_tr_l1.''.$r->voltage_min .'-'.$r->voltage_max  .' VDC</td></tr>';} else {$voltage='';};
$interfaces = $ethernet_full.$serial_full.$usb_host.$usb_client.$serial.$parallel_port.$can_bus.$video_input.$vga_port.$pci_slot.$ps2.$sdcard.$mic_in.$linear_out.
$speakers.$audio.$rgb.$dc_input.$av_input.$dvi_d.$ts_rs232.$ts_usb.$s_video.$wifi.$voltage;


if (!empty($r->case_material)) {$case_material = $us_tr_l.'Материал корпуса</td>'.$us_tr_l1.$r->case_material.'</td></tr>';} else {$case_material='';};
if (!empty($r->front_ip)) {$front_ip = $us_tr_l.'Степерь защиты лицевой панели </td>'.$us_tr_l1.$r->front_ip.'</td></tr>';} else {$front_ip='';};
if (empty($r->cpu_fan)) {$fan = $us_tr_l.'Охлаждение</td>'.$us_tr_l1.'безвентиляторное</td></tr>';} else {$fan = $us_tr_l.'Охлаждение</td>'.$us_tr_l1.'вентилятор</td></tr>';};
if (!empty($mount)) {$mount = $us_tr_l.'Крепление</td>'.$us_tr_l1.$mount.'</td></tr>';} else {$mount='';};
if (!empty($r->cutout)) {$cutout = $us_tr_l.'Посадочное отверстие</td>'.$us_tr_l1.$r->cutout.' мм</td></tr>';} else {$cutout='';};
if (!empty($r->dimentions)) {$dimentions = $us_tr_l.'Габариты</td>'.$us_tr_l1.$r->dimentions.' мм</td></tr>';} else {$dimentions='';};
if (!empty($r->power_connector)) {$power_connector = $us_tr_l.'Разъем питания</td>'.$us_tr_l1.$r->power_connector.'</td></tr>';} else {$power_connector='';};
if (!empty($r->netto)) {$netto = $us_tr_l.'Вес (нетто / брутто)</td>'.$us_tr_l1.$r->netto.' / '.$r->weight.' кг</td></tr>';} else {$netto='';};
if (!empty($r->set)) {$set = $us_tr_l.'Комплект поставки '.$us_tr_l1.$r->set.'</td></tr>';} else {$set='';};
$Design = $case_material.$dimentions.$cutout.$fan.$front_ip.$mount.$power_connector.$netto.$set;




//if ($r->DI_isol == '1') {$diisol = ' изолированные';};
if ($r->DI_full !='') {

$di = $us_tr_l.'Дискретные входы</td>'.$us_tr_l1.''.$r->DI_full.$diisol.'</td></tr>';

} else 
if ($r->DI > 0) {

$di = $us_tr_l.'Дискретные входы</td>'.$us_tr_l1.''.$r->DI.'DI'.$diisol.'</td></tr>';
};

//if ($r->DO_isol == '1') {$doisol = ', изолированные';}

if ($r->DO_full != '') {

$do =   $us_tr_l.'Дискретные выходы</td>'.$us_tr_l1.''.$r->DO_full.$doisol.'</td></tr>';
} elseif ($r->DO > '0') {
if (($r->pnp == 1) AND ($r->pnp == 1)) {
$pnpn = ' ( подключение PNP и NPN устройств ) ';
} elseif ($r->pnp == 1) {$pnpn = ' ( подключение PNP устройств ) ';} elseif ($r->npn == 1) {$pnpn = ' ( подключение NPN устройств ) ';};
$do =   $us_tr_l.'Дискретные выходы</td>'.$us_tr_l1.''.$r->DO.'DO '.$pnpn.''.$doisol.'</td></tr>';
};



if ($r->AI_full !='') {
$ai = $us_tr_l.'Аналоговые входы</td>'.$us_tr_l1.''.$r->AI_full.'</td></tr>';

} else 
if ($r->AI > 0) {

$ai = $us_tr_l.'Аналоговые входы</td>'.$us_tr_l1.''.$r->AI.'AI</td></tr>';
};

if ($r->AO_full !='') {
$ao = $us_tr_l.'Аналоговые выходы</td>'.$us_tr_l1.''.$r->AO_full.'</td></tr>';

} else 
if ($r->AO > 0) {
$ao = $us_tr_l.'Аналоговые выходы</td>'.$us_tr_l1.''.$r->AO.'AI</td></tr>';

};

if (($r->tc !='') AND  ($r->tc !=0))  {
$td = $us_tr_l.'Входы термодатчиков</td>'.$us_tr_l1.''.$r->tc.'RTD</td></tr>';

}




if (preg_match('/-T/i',$r->model)) {$t_r = 'транзисторный';} else {$t_r = 'релейный';};


 
 
$sp_data1 .='<span class=hpar>Интерфейсы</span><br>'.
 $table_start.
$di.$do.$ai.$ao.$td;
 
if (($r->series == 'MP100') AND ($r->type == 'controller'))  {

 $sp_data1 .=
$us_tr_l.'Max. DIO'.$us_tr_l1.'320 DIO (128DI, 128TO, 64RO)</td></tr>'.
$us_tr_l.'Max. AIO'.$us_tr_l1.'96 AIO (32AI, 32RTD (PT100-PT1000-NTC), 32AO) </td></tr>
';	
	
};

if (($r->series == 'MP200') AND ($r->type == 'controller'))  {


 $sp_data1 .=
$us_tr_l.'Max. DIO'.$us_tr_l1.'640 DIO (256DI, 256TO, 128RO)</td></tr>'.
$us_tr_l.'Max. AIO'.$us_tr_l1.'192 AIO (64AI, 32RTD (PT100-PT1000-NTC), 64AO) </td></tr>
';	
	
};

if (($r->series == 'MP1100') AND ($r->type == 'controller'))  {

 $sp_data1 .=
$us_tr_l.'Max. DIO'.$us_tr_l1.'320 DIO (128DI, 128TO, 64RO)</td></tr>'.
$us_tr_l.'Max. AIO'.$us_tr_l1.'192 AIO (64AI, 32RTD (PT100-PT1000-NTC), 64AO) </td></tr>
';	

	
};


	
	switch ($r->model)  {
case 'XIO200.P8':
 $sp_data1 .=
$us_tr_l.'Max. RTD'.$us_tr_l1.'PLC имеет 8 входов к которым можно подключить модули-расширения, CPU обрабатывает данные с 16 модулей с 8 входами = 128 термодатчиков может быть подключено.</td></tr>
';	
break;

case 'XIO200.P4':
 $sp_data1 .=
$us_tr_l.'Max. RTD'.$us_tr_l1.'PLC имеет 8 входов к которым можно подключить модули-расширения, CPU обрабатывает данные с 16 модулей с 4 входами = 64 термодатчиков может быть подключено.</td></tr>
';	
break;


}

$sp_data1 .= $interfaces;

 
 $sp_data1 .= '</table><br><br>';

 
  if (($r->type == 'controller'))  {
	  
  $sp_data1 .='<span class=hpar>Программирование</span><br>'.$table_start;
  
 $sp_data1 .=
$us_tr_l.'Программирование'.$us_tr_l1.'FBD (IEC 61131-3), бесплатное ПО Mikrodiagram от производителя</td></tr>'.
$us_tr_l.'Отладка'.$us_tr_l1.'Симуляция работы PLC в программе без связи с ПЛК</td></tr>'.
$us_tr_l.'Мониторинг PLC'.$us_tr_l1.'В реальном времени через Mikrodiagram</td></tr>'.
$us_tr_l.'Загрузка проектов'.$us_tr_l1.'через USB</td></tr>'.
$us_tr_l.'SCADA Редактор'.$us_tr_l1.'Mikrodev Scada — редактор от производителя</td></tr>
';	
  
  $sp_data1 .='</table><br><br>';
  
};
  

  $sp_data1 .='<span class=hpar>Конструкция</span><br>'.$table_start.$Design.'</table><br><br>';
 

  


 
 
 // if(($r->os!="") or ($r->type !='monitor')) {
 if ($r->software != '') {
 $sp_data1 .= "<span class=hpar>ПO</span><br>";
 $sp_data1 .= $table_start;

 $sp_data1 .= $us_tr_l.'ПО</td>'.$us_tr_l1.'Бесплатное: <span style="text-decoration:underline;cursor:pointer;" onclick="doclick(\'tabs-4\')">'.$r->software.$r->software_comment.'</td></tr>'; 

 
$sp_data1.=  "</table><br><br>"; 
};
//};	
if (!empty($r->temp_operating)) {$tempo =$us_tr_l.'Рабочая температура</td>'.$us_tr_l1.$r->temp_operating.'</td></tr>';};
if (!empty($r->vibration)) {$vibr = $us_tr_l.'Вибрация</td>'.$us_tr_l1.'0,5G (по трем осям каждые 2 часа)</td></tr>';}; //Вибрации нет в таблице
if (!empty($r->shock)) {$shok = $us_tr_l.'Шоковая нагрузка</td>'.$us_tr_l1.$r->shock.'</td></tr>';};

if (!empty($r->power_adapter)) {$powero = $us_tr_l.'Питание</td>'.$us_tr_l1.$r->power_adapter.'</td></tr>';};
if (!empty($r->temp_storage)) {$tempsto = $us_tr_l.'Температура хранения</td>'.$us_tr_l1.$r->temp_storage.'</td></tr>';};
if (!empty($r->humidity)) {$hum = $us_tr_l.'Влажность при хранении</td>'.$us_tr_l1.$r->humidity.'</td></tr>';};


//if (!empty($r->current)) {$current = $us_tr_l.'Потребляемый ток</td>'.$us_tr_l1.$r->current.'A';};
	
$expluatation = $tempo.$vibr.$shok.$tempsto.$hum;
	

	

$sp_data1 .='<span class=hpar>Эксплуатация и хранение</span><br>'.
 $table_start.$powero;
 

 
 //   if (($r->baud_rate != '')) {$sp_data1 .= $us_tr_l.'Скорость передачи</td>'.$us_tr_l1.$r->baud_rate.'</td></tr>'; };		
	
 

$sp_data1 .= 		$current.$expluatation;
 

  if (($r->brand == 'Mikrodev') AND ($r->type == 'controller')) {
$sp_data1 .=  $us_tr_l.'Сертификаты</td>'.$us_tr_l1.'CE, EN 55011 ( класс B )</td></tr>';
 };
	
	



 
 
$sp_data1 .=  '</table><br><br>';

// $sp_data1.=  "</table></div><br><br>"; 

 //$sp_data1.= '</div>';


//---------------------end tab1 -------------------------

//-------------spec ---------------------------

$imagepath = 'images/controllers/'.strtolower($r->brand).'/dim';
$default_imagepath = 'images/controllers/'.strtolower($r->brand).'/microdev-dim.png';
$dimensions = '';
$queryd = "SELECT * FROM `dimensions_controllers` WHERE `model`='{$r->model}' AND `img_path`<>'' LIMIT 1;";

	$queryd = mysql_query ($queryd) or die ("ошибка запроса0213".$queryd);
	$jd = mysql_num_rows($queryd);
  if ($jd>0) {
	  $rowd = mysql_fetch_assoc($queryd); 
	  if (!empty($rowd[img_path])) {
	 $dimensions = '<center><img style="max-width:955px;" src="/images/controllers'.$rowd[path].'/'.$rowd[img_path].'"></center>';  };
	  }; 

if ((empty($dimensions)) and (!preg_match('/MP1100/i',$r->model))) {
	  
if ($GLOBALS["net"] == 0) {	 
 
if (file_exists($GLOBALS["path_to_real_files"].'/'.$imagepath.'/'.$r->model.'.png')) {$dimensions = '<center><img  style="max-width:955px;" src="/'.$imagepath.'/'.$r->model.'.png"></center>';}
elseif (file_exists($GLOBALS["path_to_real_files"].'/'.$default_imagepath.'/'.$r->series.'.png')) {$dimensions = '<center><img style="max-width:955px;" src="/'.$default_imagepath.'/'.$r->series.'.png"></center>';};
 }
else {
$re = cu($GLOBALS["path_to_real_files"].'/'.$imagepath.'/'.$r->model.'.png');
if ($re[0] > 0) {
$dimensions = '<center><img style="max-width:955px;" src="/'.$imagepath.'/'.$r->model.'.png"></center>';
} else {
$re = cu($GLOBALS["path_to_real_files"].'/'.$default_imagepath);
if ($re[0] > 0) {
$dimensions = '<center><img style="max-width:955px;width: 451px;" src="/'.$default_imagepath.'"></center>';
} else {
$dimensions = '';};
};
};
};







$komplect ='';

//$komplect = '<li class="urlup" data="accessories"><a href="#tabs-5">КОМПЛЕКТУЮЩИЕ</a></li>';


//$sxemy = "<li class='urlup' data='scheme'><a href='#tabs-3'>СХЕМЫ</a></li>";

 
 if ($dimensions !='') {$dimtit = '<li class="urlup" data="dimensions"><a href="#tabs-2">ГАБАРИТЫ</a></li>';} else {$dimtit = '';};
 
$vyvod = '<br><br> 
<div style="width:1100px; min-height: 500px; overflow: auto; ">
<div id="tabs">
  <ul>
    <li class="urlup" data="functions"><a href="#tabs-1">ХАРАКТЕРИСТИКИ</a></li>
   '.$dimtit.'
    '.$sxemy.'
    <li class="urlup" data="software"><a href="#tabs-4">СКАЧАТЬ</a></li>
	'.$komplect.'
  </ul> 
  <div id="tabs-1">
  <h2>Технические характеристики '.$types1.' '.$r->model.'</h2><br />
    <div style="width:90%">'.$sp_data1.'</div>
  </div>
  <div id="tabs-2"><h2>Габариты '.$types1.' '.$r->model.'</h2>
  '.$dimensions.'<br /><br />
  </div>';


  if (!empty($scheme)) {
  
  $vyvod .= '<div id="tabs-3">
  <div class=connectors>
  <h2>Входы и выходы '.$types1.' '.$r->model.'</h2><br />'.$scheme.'
  </div></div>
  ';
};
 // echo  $vyvod.show_com_connector($r->model).'</div>';
 
  $prices_out .=  $vyvod;

  if (!empty($_GET[tab])) { 
 if ($_GET[tab] == 'accessories') {$uuu = '$(\'a[href="#tabs-5"]\').click();';}
 else if ($_GET[tab] == 'functions') {$uuu = '$(\'a[href="#tabs-1"]\').click();';}
  else if ($_GET[tab] == 'software') {$uuu = '$(\'a[href="#tabs-4"]\').click();';}
    else if ($_GET[tab] == 'dimensions') {$uuu = '$(\'a[href="#tabs-2"]\').click();';}
	    else if ($_GET[tab] == 'scheme') {$uuu = '$(\'a[href="#tabs-3"]\').click();';};
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

$usb="";
  

 
  if($r->software!="")
  {}
  

//$file = '/home/weblec/public_html/test_weinteknet/drivers';  

if (!empty($r->brochure)) {$brochure = $r->brochure;} else {$brochure = $r->model.'.pdf';};

if ($GLOBALS["net"] == 0) {
 if 	(file_exists($root_php.'manuals/'.$brochure)) {$ine = 1; 
 $fs = (sprintf("%u", filesize($root_php.'manuals/'.$brochure))+0)/1000;
$t = date("d-m-Y", filemtime($root_php.'manuals/'.$brochure));
 }
  elseif 	(file_exists($root_php.''.strtolower($r->brand).'/manuals/'.$brochure)) {
  $ine = 2; 
   $fs = (sprintf("%u", filesize($root_php.''.strtolower($r->brand).'/manuals/'.$brochure))+0)/1000;
   $t = date("d-m-Y", filemtime($root_php.''.strtolower($r->brand).'/manuals/'.$brochure));
  } else {
 $ine = 0; 
 };}
else {
 $re = cu($root_php.'/manuals/'.$brochure);
  $re1 = cu($root_php.'/'.strtolower($r->brand).'/manuals/'.$brochure);
 if 	($re[0] > 0) {$ine = 1; 
 $t =  date("d-m-Y", $re[1]);
$fs = (sprintf("%u", $re[0])+0)/1000;
 }
  elseif 	($re1[0] > 0) {
  $ine = 2; 
  $t =  date("d-m-Y", $re1[1]);
$fs = (sprintf("%u", $re1[0])+0)/1000;
  } else {
 $ine = 0; 
 };
};
if ($fs>1000) {$s =round($fs/1000, 2).'&nbsp;Мб';} else {$s = round($fs, 0).'&nbsp;Кб';};
 if 	($ine == 1) {
 $soft5 = "
 <tr><td><div class=down_item> Брошюра на $types $r->model </div></td>
   <td><div class=dt_item>".$t."<br>(eng)<br />".$s."</div></td>
   <td><div class=down_item><a href='/manuals/$brochure'><img src=/images/manual.jpg></a></div></td></tr> 
 ";

 
 
 } 
 
  elseif 	($ine == 2) {
 //  $fs = (sprintf("%u", filesize($root_php.''.strtolower($r->brand).'/manuals/'.$r->model.'.pdf'))+0)/1000;
//$s =  ceil($fs/1000);
//$s =  round($fs/1000, 2);
 $soft5 = "
 <tr><td><div class=down_item> Брошюра на $types $r->model </div></td>
   <td><div class=dt_item>".$t."<br />(eng)<br />".$s."</div></td>
   <td><div class=down_item><a href='/'.strtolower($r->brand).'/manuals/$r->model.pdf'><img src=/images/manual.jpg></a></div></td></tr> 
 ";

 
 
 } 
 else {$soft5 = '';};
 

 
 
$brochure = 'soft/Mikrodev/mikrosetup.rar';

if ($GLOBALS["net"] == 0) {
 if 	(file_exists($root_php.''.$brochure)) {$ine = 1; 
 $fs = (sprintf("%u", filesize($root_php.''.$brochure))+0)/1000;
$t = date("d-m-Y", filemtime($root_php.''.$brochure));
 } else {
 $ine = 0; 
 };}
else {
 $re = cu($root_php.'/'.$brochure);

 if 	($re[0] > 0) {$ine = 1; 
 $t =  date("d-m-Y", $re[1]);
$fs = (sprintf("%u", $re[0])+0)/1000;
 } else {
 $ine = 0; 
 };
};
if ($fs>1000) {$s =round($fs/1000, 2).'&nbsp;Мб';} else {$s = round($fs, 0).'&nbsp;Кб';};
 if 	($ine == 1) {
 $soft1 = "
 <tr><td><div class=down_item> FBD-редактор Mikrodiagram для создания проектов для $types1 $r->model </div></td>
   <td><div class=dt_item>".$t."<br>(eng)<br />".$s."</div></td>
   <td><div class=down_item><a href='/$brochure' download><img src=/images/soft.jpg></a></div></td></tr> 
 ";

 
 
 } 
 
  elseif 	($ine == 2) {
 //  $fs = (sprintf("%u", filesize($root_php.''.strtolower($r->brand).'/manuals/'.$r->model.'.pdf'))+0)/1000;
//$s =  ceil($fs/1000);
//$s =  round($fs/1000, 2);
 $soft1 = "
 <tr><td><div class=down_item> Брошюра на $types $r->model </div></td>
   <td><div class=dt_item>".$t."<br />(eng)<br />".$s."</div></td>
   <td><div class=down_item><a href='/'.strtolower($r->brand).'/manuals/$r->model.pdf'><img src=/images/manual.jpg></a></div></td></tr> 
 ";

 
 
 } 
 else {$soft1 = '';};
 


$accessories = '';

  
$komplects ='';

/*
$komplects = '<div id="tabs-5">
  <div class=connectors>
  <h2>Комплектующие '.$types1.' '.$r->model.'</h2><br />'.$accessories.'
  </div></div>';
*/
  
$prices_out .= " 
  <div id='tabs-4'>
  <div class=connectors>
  <h2>Файлы для работы с $typesом $r->model</h2>
  </div>
  
   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование </div></td><td width=100><div class=down_h>  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>
  
   $soft5
   $soft1
".softwares($r->software,$r->model,'0')."
  
   </table>
   <br /> <br />
  </div>".
    $komplects.
  
"</div><br /><br />
</div>
";


$prices_out .= "<br><br>";
//-----------------end content

$DESCRIPTION = $description;
$KEYWORDS = $keywords;
$TITLE = $title;

$out .=$prices_out;
} else {

//header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
header('Location: http://'.$_SERVER['HTTP_HOST'].'/404.php');
	
};
?>