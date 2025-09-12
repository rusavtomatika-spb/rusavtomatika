<?php
session_start();
define("bullshit",1);
include "../dbcon.php";
include ("../sc/lib.php");
include ("../sc/lib222.php");

database_connect();

function show_eb_ver()
{$ver=file("../eb8000/version.txt");
//echo "Current EB8000 version ";
$res="";
for($i=0;$i<count($ver);$i++)
$res.=$ver[$i];
return $res;
}

function show_pro_ver()
{$ver=file("../ebpro/version.txt");
//echo "Current EB8000 version ";
$res="";
for($i=0;$i<count($ver);$i++)
$res.=$ver[$i];
return $res;
}

$num="MT6050i";

$num1=$num;
if($num=="MT615XH") $num1="MT615XH_XPE";
if($num=="MT612XH") $num1="MT612XH_XPE";
if($num=="MT610XH") $num1="MT610XH_XPE";

$sql="SELECT * FROM goods WHERE `name` = '$num1' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);
if($r->on_stock_spb >0 || $r->on_stock_moskow >0 ) $prod_on_stock=1; else $prod_on_stock=0;

if( ($num=="MT615XH" || $num=="MT612XH" || $num=="MT610XH" ) &&  $prod_on_stock==0)     //if no XPE on stock check XCE version
 {
  if($num=="MT612XH") $num1="MT612XH_XCE";
  if($num=="MT610XH") $num1="MT610XH_XCE";

  $sql="SELECT * FROM goods WHERE `name` = '$num1' ";
  $res = mysql_query($sql) or die(mysql_error());
  $r=mysql_fetch_object($res);
  if($r->on_stock_spb >0 || $r->on_stock_moskow >0 ) $prod_on_stock=1; else $prod_on_stock=0;

 }
 
 

$sql="SELECT * FROM weintek_panels WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);


temp001("$r->model, Weintek, панели оператора Weintek, операторские панели Weintek, описание Weintek, MPI");

echo "<div align=center>"; buttons_top();echo"</div>";
temp1();
//--------------------content -----------------------------
//$num=1;
$im=$GLOBALS['img_html'];
$root=$GLOBALS['root_html'];
$eb500=$GLOBALS['html_eb500'];
$eb8000=$GLOBALS['html_eb8000'];
$eb500ug=$GLOBALS['html_eb500_ug'];
$eb8000ug=$GLOBALS['html_eb8000_ug'];



echo"

<style>
.par_name1{
font-family:Verdana;
font-size:12px;
color: FA9B3F;
font-weight:bold;
text-decoration:none
}
.par_val1{
font-family:Verdana;
font-size:12px;
color: black;
font-weight:bold;
text-decoration:none
}
h1{
font-family:Verdana;
font-size:16px;
color: black;
font-weight:bold;
text-decoration:none
}

h2{
font-family:Verdana;
font-size:14px;
color: 000080;
font-weight:bold;
text-decoration:none
}

.plc{
font-family:Verdana;
font-size:12px;
color: red;
font-weight:bold;
text-decoration:none
}
a.plc{
font-family:Verdana;
font-size:12px;
color: red;
font-weight:bold;
text-decoration:none
}
a.plc:hover{
font-family:Verdana;
font-size:12px;
color: blue;
font-weight:bold;
text-decoration:none
}
a.skach{
font-family:Verdana;
font-size:10px;
color: black;
font-weight:bold;
text-decoration:none
}
a.skach:hover{
font-family:Verdana;
font-size:10px;
color: 000080;
font-weight:bold;
text-decoration:none
}
</style>";


$series=$r->series;//params($num,11,1);


$altstr="'операторские панели, сенсорные панели, HMI, Weintek, EasyView, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder'";

?>
<script>

function dich(num)
 {
  
   
   $("#dd").html("<img src='"+num+"'>");
  
 }


</script>
<?





//--------------------------------- серия 6000-----------------------------------------------------
echo"
<table width=100%><tr>
<td width=250 valign=top>";
//------------------------левый столбец ( меню) -------------------
//left_menu(1);
left_menu_new();
//-------------------------end левый столбец -----------------------
echo "
</td>
<td>";

if($prod_on_stock=="1") $fff="<img src=$im/stamp.jpg>"; else $fff="<img src=$im/blank.jpg>";

/*  //------- old     panel image

echo "
<div> 


<table width=100%>
<tr><td align=middle>$fff </td><td align=middle class=plc>Панели Weintek <br> работают со следующими PLC:</td></tr>
<tr><td align=right >
<img src=$im/panel/$r->pic_big width=250 alt=$altstr>
</td><td width=350 align =middle>";

if($num=="MT8070iH" || $num=="MT8050i" || $num=="MT8100i" || $num=="MT8121X" || $num=="MT8104XH" || $num=="MT8150X"  || $num=="MT8104iH")

echo "<img src=$im/kontar_plc.jpg>";

echo "
<img src=$im/weintek-plc.jpg alt='weintek+овен, weintek+сегнетикс, weintek+сименс, weintek+mitsubishi, weintek+omron, weintek+delta'>
</td></tr>
<tr><td> </td><td align=middle> <a href=$root/weintek/plclist.php class=plc> И множеством других, <br> cм. полный список >>></a></td></tr>
</table>
 ";
 
 */    //--------------end old panel image
 
$im1="../images/panel/$r->model/$r->model"."_1.png";
$im2="../images/panel/$r->model/$r->model"."_2.png";
$im3="../images/panel/$r->model/$r->model"."_3.png";
$im4="../images/panel/$r->model/$r->model"."_4.png";

$im1_sm="../images/panel/$r->model/sm/$r->model"."_1.png";
$im2_sm="../images/panel/$r->model/sm/$r->model"."_2.png";
$im3_sm="../images/panel/$r->model/sm/$r->model"."_3.png";
$im4_sm="../images/panel/$r->model/sm/$r->model"."_4.png";
 
 //bgcolor=#eeeeee
 
echo "
<center>
<br><br>
<table width=700px  height=400px> 
<tr ><td colspan=2 height=30px> 
<table><tr><td width=550 align=left><div class=big_pan_name>$r->diagonal &nbsp; ПАНЕЛЬ ОПЕРАТОРА <b>$r->model</b> </div></td><td width=50>
 <div class=pan_price_big> ЦЕНА </div></td><td width=50 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td></tr></table>
<div class=hc1>&nbsp;</div>
</td></tr>
<tr ><td valign=top align=left width=400px>
<div id=dd>
<img src=$im1  alt=$altstr> </div>
<br>
<center>
<table width=350px><tr>
            
             <td onclick='dich(\"$im1\");'><img src=$im1_sm width=50></td>
             <td onclick='dich(\"$im2\");'><img src=$im2_sm width=50></td>
			 <td onclick='dich(\"$im3\");'><img src=$im3_sm width=50></td>
 			 <td onclick='dich(\"$im4\");'><img src=$im4_sm width=50></td>
 </tr></table>      
</td>
<td width=300px> asa </td>
</tr></table>"; // end big table
 

 

$bg1="bgcolor=effdf6";//bgdedede";
$bg2="bgcolor=fbfeb2";//cdcdcd";
$bg_white="bgcolor=ffffff";
$white_line="<tr><td class=par_name1 $bg_white> &nbsp; </td><td class=par_val1 $bg_white>  &nbsp;</td></tr>";

//----------------------------spec1-----------------------------------------
//$r->diagonal
$sp_data1="
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
 


 $sp_data1.= " $white_line ";



 if($r->software=="EasyBuilder8000")
 $sp_data1.= " <tr><td class=par_name1 $bg2>ПО для разработки экранов</td><td class=par_val1 $bg2>EasyBuilder8000</td></tr> ";

 if($r->software=="EasyBuilderPro")
 $sp_data1.= " <tr><td class=par_name1 $bg2>ПО для разработки экранов</td><td class=par_val1 $bg2>EasyBuilderPro</td></tr> ";

 if($r->software=="")
 $sp_data1.= "
 <tr><td class=par_name1 $bg2>Операционная система</td><td class=par_val1 $bg2>$r->os</td></tr> ";

$sp_data1.= "
</table>
";
//--------------------------end spec1 ------------------------------------------------


//-------------------------spec2---------------------------

$sp_data2 = "
<table width=80%>
<tr><td class=par_name1 $bg1>Материал корпуса</td><td class=par_val1 $bg1>$r->case_material</td></tr>
 <tr><td class=par_name1 $bg2>Посадочное отверстие</td><td class=par_val1 $bg2>$r->cutout</td></tr>
 <tr><td class=par_name1 $bg1>Вес</td><td class=par_val1 $bg1>$r->netto</td></tr>
 <tr><td class=par_name1 $bg2>Рабочая температура</td><td class=par_val1 $bg2>$r->temp</td></tr>";

 if($r->case_material=="Алюминий")
 $sp_data2.=" <tr><td class=par_name1 $bg1>Степень защиты</td><td class=par_val1 $bg1>IP66 ( по фронту )</td></tr>";
 else
  $sp_data2.=" <tr><td class=par_name1 $bg1>Степень защиты</td><td class=par_val1 $bg1>IP65 ( по фронту )</td></tr>";

 $sp_data2.="</table>";


//-----------------------------end spec2-----------------------------------

//echo "<script>  var specif1=\"$sp_data1\"; var specif2=\"$sp_data2\"; </script>";
/*
//var specif1=<?php echo "$sp_data1"; ?>;
//var specif2=<?php echo "$sp_data2"; ?>;

//var specif2="kjahkajhasdsdsdasd";
*/
?>
<script>


function spec(num)
{

specif2="kjahkajhasdsdsdasd лорорлорлорлор";
//alert("sdsdsds");
 switch(num)
 {
   case 1:
   $("#sp1").css('color', '#777777');
   $("#specdiv").html(specif2);
   //alert(specif2);
   
   break;

 }



}

</script>
<?


echo "
<br>
<table width=700px><tr><td width=200px><div id=sp1 onclick='spec(1);'>Характеристики</div></td>   
                       <td width=200px><div id=sp2>Габариты</div></td> 
					   <td <div id=sp3>Схемы</div></td> 
					   <td <div id=sp4>Скачать</div></td> 
					   </tr></table>


<br><br>";




echo "<div id=specdiv> $sp_data1 </div>";


echo"<br>
<table width=80%>";


if($r->software=="EasyBuilder8000")
{
$vv=show_eb_ver();
echo"
<tr>
<td width=40 ><a href=$eb8000 > <img src=$im/soft.jpg border=0 alt=$altstr> </a></td>
<td><a href=$eb8000 class=skach title=$altstr> Скачать EasyBuilder 8000 v$vv </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$eb8000ug' class=skach title=$altstr target=_blank> Скачать описание ПО </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/PLC_connection_guide.pdf' class=skach title=$altstr target=_blank>Рук-во по подключению PLC </a> </td>

</tr> ";
}


if($r->software=="EasyBuilderPro")
{
$vv=show_pro_ver();
echo"
<tr>
<td width=40 ><a href='../ebpro/EBpro_setup.zip' > <img src=$im/soft.jpg border=0 alt=$altstr> </a></td>
<td><a href='../ebpro/EBpro_setup.zip' class=skach title=$altstr> Скачать EasyBuilder Pro v$vv </a> </td>

<td width=40 ><a href=$root/manuals/EBPro_Manual_All_In_One.pdf target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/EBPro_Manual_All_In_One.pdf' class=skach title=$altstr target=_blank> Скачать описание ПО </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/PLC_connection_guide.pdf' class=skach title=$altstr target=_blank>Рук-во по подключению PLC </a> </td>

</tr> ";
}


echo"
<tr>
<td width=40 ><a href=$root/manuals/".$r->model.".pdf target=_blank> <img src=$im/manual.jpg  border=0 alt=$altstr></a></td>
<td><a href='$root/manuals/".$r->model.".pdf' class=skach title=$altstr target=_blank> Скачать описание панели</a></td>

<td width=40 ><a href=$root/install/$r->install_doc target=_blank> <img src=$im/manual.jpg  border=0 alt=$altstr></a></td>
<td><a href='$root/install/$r->install_doc' class=skach title=$altstr target=_blank>Скачать рук-во по установке панели</a></td>";

 if($r->software)
echo"
<td width=40 ></td>
<td><a href='$root/weintek/plclist.php' class=skach title='список контроллеров, с которыми совместимы панели Weintek' target=_blank>Совместимые контроллеры</a></td>";

echo"
</tr></table>
</td></tr></table>

";
//

//---------------------------------- end series 6000---------------------------------------






//---------------------end content------------------------
temp2();
//echo "bottom";
echo "<div align=center>"; buttons_top();echo"</div>";
$kw=$GLOBALS["keywords_weintek"];
temp3($kw);

?>

