<?
$document_root=$_SERVER['DOCUMENT_ROOT'];

include ("$document_root/sc/vars.php");
include ("$document_root/sc/kw.php");


function ifc_modif_decode($r)
{
$a=explode("-", $r->model);
$mod=$a[1];

if($r->speakers!="") $spe=", динамики"; else $spe="";
if($r->voltage_min==$r->voltage_max) $vo="$r->voltage_min В";
else $vo="$r->voltage_min-$r->voltage_max В";

$out="RAM ".($r->ram/1000)." Гб, $vo$spe, $r->hdd_type $r->hdd_size_gb Гб " ;

return $out;


}


function remain_days($date)
{
     $now = time(); // or your date as well
     $your_date = strtotime($date);
     $datediff = $your_date-$now;
     return floor($datediff/(60*60*24));

}

function stime($format, $tm)
{

 if($tm=="0000-00-00") return "";
 //import locale;
   // locale.setlocale(locale.LC_ALL, 'ru_RU.UTF-8');
 //setlocale(LC_ALL,'ru_RU.CP1251','ru_RU','rus'); 
 //setlocale(LC_ALL, 'ru_RU');
 //$result = setlocale(LC_ALL, 'ru_RU','rus_RUS','Russian');
// $mone=array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
 $mone=array("янв.", "фев.", "мар.", "апр.", "мая", "июня", "июля", "авг.", "сент.", "окт.", "ноя.", "дек.");
 $m=$mone[(int)strftime('%m',strtotime($tm))-1];
 
 
  $out= strftime('%d',strtotime($tm))." ".$m;
  

 return $out;

}

function show_pc_variants($model)
{

//$sql="SELECT * FROM `products_all` WHERE  `modification`=1 AND `model` LIKE '$model%' ";
$sql="SELECT * FROM `products_all` WHERE  `modification`=1 AND `parent`='$model' ";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==0)  return "";
$out="<table class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=1000>
<tr class=hed><td >Модель</td><td width=270>Спецификация</td><td width=190>Наличие</td><td width=70>Цена</td><td width=280>Действия</td></tr>";
while ($r=mysql_fetch_object($res))
{
$spec=ifc_modif_decode($r);
$out.="<tr><td width=170 class=modif_name>$r->model</td><td>$spec</td><td>".show_stock($r,3)."</td>
<td><span class=prpr title='Нажмите для пересчета в РУБ' style='font-size:11px;'>$r->retail_price</span><span class=val_name title='Нажмите для пересчета в РУБ' style='font-size:11px;'> USD </span></td>
 
<td style='padding:8px;'><span class='zakazbut2 addToCart' idm='$r->model'>В корзину</span>
 &nbsp <span class=zakazbut2 idm='$r->model' onclick='show_compare(this)'>В сравнение</span>
 &nbsp <span class=zakazbut2 idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'>Получить скидку</span>
 </td>
</tr>";

}
$out.="</table>";
return $out;
}


function set_db_var($name, $value)
{
$sql="SELECT * FROM `variables` WHERE `name`='$name' ";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==0) 
  {
   // create variable
   $sql="INSERT INTO `variables` (name, value) VALUES ( '$name', '$value')";
   $res=mysql_query($sql) or die(mysql_error());
   return true;
  }
 else
  {
   // update variable
  $sql="UPDATE `variables` SET `value`='$value'  WHERE `name`='$name' ";
  $res=mysql_query($sql) or die(mysql_error());
  return true;
  }

}

function get_db_var($varname)
{
$sql="SELECT * FROM `variables` WHERE `name`='$varname' ";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)>1) return "more then 1 var";
if(!$r=mysql_fetch_object($res)) return "no var";
return $r->value;
}

function get_models_expected_date($model)
{
$sql="SELECT * FROM `products_all` WHERE `model`='$model' ";
$res=mysql_query($sql) or die(mysql_error());
if(!$r=mysql_fetch_object($res)) return "";
$brand=$r->brand;
//echo $brand;
//
$sql="SELECT * FROM `orders_on_way` WHERE `brand`='$brand' AND `blocked`='0' AND `arrived`='0' ";
$res=mysql_query($sql) or die(mysql_error());
$out="";
while($r=mysql_fetch_object($res))
 {
  $id=$r->id;
 // echo $id.", ";
  $sql="SELECT * FROM `orders_on_way_detailed` WHERE `order_id`='$id' AND `model`='$model' ";
  $res1=mysql_query($sql) or die(mysql_error());
  if(mysql_num_rows($res1)>0) return  $r->arrive_date;
 }

return "";

}


function get_order_on_way_id($order, $brand)  // returns order object from datyabase that accords order need to be shown 
{
$sql="SELECT * FROM  `orders_on_way` WHERE `brand` = '$brand' AND `blocked` = 0 ORDER BY `id` ASC";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)<$order) return false;
$out="";
$i=0;
while($r=mysql_fetch_object($res))
{
if($i==$order) break;
$i++;
}
return $r;

}


function show_models_on_way($model, $order, $brand)
{
$sql="SELECT * FROM  `orders_on_way` WHERE `brand` = '$brand' AND `blocked` = 0 ORDER BY `id` ASC";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)<$order) return false;
$out="";
$i=0;
while($r=mysql_fetch_object($res))
{
if($i==$order) break;  
$i++;
}
$order_id=$r->id;

$sql="SELECT * FROM  `orders_on_way_detailed` WHERE `model`= '$model' AND`order_id`='$order_id' ";
$res=mysql_query($sql) or die(mysql_error());
$sum=0;
while($r=mysql_fetch_object($res))
{
$sum+=$r->amount;
}
//if($sum==0) $sum="";
return  $sum;
}



function show_reserved_amount($model, $stock)
{
$sql="SELECT * FROM  `reservations` WHERE `model`= '$model' AND `stock` = '$stock' AND `blocked` = 0 ";
$res=mysql_query($sql) or die(mysql_error());
$sum=0;
while($r=mysql_fetch_object($res))
 {
  $sum+=$r->amount;
 }
 
// if($sum==0) $sum=" ";

return $sum;
}

function xor_this($string) {

// Let's define our key here
 $key = ('magic_key');

 // Our plaintext/ciphertext
 $text =$string;

 // Our output text
 $outText = '';

 // Iterate through each character
 for($i=0;$i<strlen($text);)
 {
     for($j=0;($j<strlen($key) && $i<strlen($text));$j++,$i++)
     {
         $outText .= $text{$i} ^ $key{$j};
         //echo 'i='.$i.', '.'j='.$j.', '.$outText{$i}.'<br />'; //for debugging
     }
 }  
 return $outText;
}


function random_str($len)
{

$arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z',
'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z',
'1','2','3','4','5','6','7','8','9','0');

//$arr = array('1','2','3','4','5','6','7','8','9','0');

$string="";
for($i = 0; $i < $len; $i++){
$index = rand(0, count($arr) - 1);
$string.= $arr[$index];
}

return $string;
}

function random_num($len)
{

$arr = array('1','2','3','4','5','6','7','8','9','0');

//$arr = array('1','2','3','4','5','6','7','8','9','0');

$string="";
for($i = 0; $i < $len; $i++){
$index = rand(0, count($arr) - 1);
$string.= $arr[$index];
}

return $string;
}


function show_banner_product($model)
{
$sql="SELECT * FROM products_all WHERE `model` = '$model' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);
$im=get_big_pic($model);
$bt="<img src=/images/th_up.png>";
$trh="height=40";
$ml=get_link_to_model($model);
// <span style='width: 200px; display: inline-block;'></span>
//<span valign=center>Цена: $r->retail_price USD</span>  <span class=button_podr style='float:right;' onclick='window.location=\"$ml\"'> Подробнее </span>
if($r->brand=="IFC")
{
$out= "
<div class=banner> 
<table><tr>
<td width=400><a href=$ml><img src=$im></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban>$r->diagonal\" Панельный компьютер <strong> $r->model </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
<tr $trh><td>$bt</td><td><div class=ban_list> Промышленный панельный компьютер с сенсорным дисплеем</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Полностью готов к использованию, 2Gb RAM и 16Gb SSD уже установлены</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Пылевлагозащита по фронту (IP65)</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Порты: $r->serial, 2хGb LAN, $r->usb_host, VGA, LPT</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price USD </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr> 

</table> 


</h2>
</div>
</td></tr>
</table>
</div> 
";
} // end IFC brand
return $out;
}

function show_product_mixed($model)
{
$sql="SELECT * FROM products_all WHERE `model` = '$model' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);

if($r->type=="hmi" || $r->type=="open_hmi")
{
return show_panel1($model);
}
if($r->type=="panel_pc")
{
return show_ifc($model);
}
}

function block_sql($str){

//return preg_replace("/[^0-9]+/", "", $str);
//return eregi("[^A-Za-z0-9.]", $str);
$a1=array("'",'"', "[", "]", "(", ")", "\\", "/");
//$a2=array("&#39;","&quot;", "", "", "", "", "", "");
$a2=array("X","X","X", "X", "X", "X", "X", "X"); 
//$a2=array("", "", "", ""); 
return str_replace($a1, $a2, $str);

}


function show_model_price($model)
{
$sql="SELECT * FROM products_all WHERE `model` = '$model' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);

$out="<span class=prpr style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</span>
<span class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </span>
";
return $out;
}

function get_link_to_model($model)
{
$sql="SELECT * FROM products_all WHERE `model` = '$model' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);
if($r->parent!="") 

$model=$r->parent;


if($r->brand=="APLEX" || $r->brand=="IFC")
return "/panelnie-computery/".strtolower($r->brand)."/$model.php";
else
return "/".strtolower($r->brand)."/$model.php";
}

function get_small_pic($model)
{

$sql="SELECT * FROM products_all WHERE `model` = '$model' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);


$fps_im="/images/".strtolower($r->brand)."/$r->pic_small";

//$_SERVER['DOCUMENT_ROOT']
if(file_exists($GLOBALS["path_to_real_files"].$fps_im)) return $fps_im;  // if exists return from database
else return get_big_pic($r->model);
}

function get_big_pic($model)
{
if($model=="") return "";
$sql="SELECT * FROM products_all WHERE `model` = '$model' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);

if($r->parent!="") 
$sql="SELECT * FROM products_all WHERE `model` = '$r->parent' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);


//$_SERVER['DOCUMENT_ROOT']

if($r->pic_big!="")
{
$fps_im="/images/".strtolower($r->brand)."/$r->pic_big";
if(file_exists($GLOBALS["path_to_real_files"].$fps_im)) return $fps_im;  // if exists return from database
}

$imgroot="/images/".strtolower($r->brand)."/$r->model";
$imfo=$GLOBALS["path_to_real_files"].$imgroot;


if(file_exists($imfo))
{
   $files = scandir($imfo);
   return $imgroot."/".$files[2];
}
else return "";

}

function miniatures($model,$mins_in_row, $mins_max, $table_width)
{
$sql="SELECT * FROM products_all WHERE `model` = '$model' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);
if($r->parent!="") 
$sql="SELECT * FROM products_all WHERE `model` = '$r->parent' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);


$imgroot="/images/".strtolower($r->brand)."/$r->model";
$imfo=$GLOBALS["path_to_real_files"].$imgroot."/sm";

$miniatures_in_raw=$mins_in_row;


if(file_exists($imfo))
{
$files = scandir($imfo);

$miniatures=sizeof($files)-2;


$min_table="<table width=$table_width bfcolor=red><tr>";
$mc=0;

if($miniatures>$mins_max) $miniatures=$mins_max;

$alt=get_kw( "alt" );

for($i=0;$i<$miniatures; $i++)
 {
  $j=$i+1;
  $min_table.="<td onclick='dich(\"$imgroot/$r->model"."_$j.png\");'><img src=$imgroot/sm/$r->model"."_$j.png width=50 alt='$alt'></td>";
  $mc++;
  if($mc==$miniatures_in_raw) {$mc=0; $min_table.="</tr><tr>";}
 }
  while($mc<$miniatures_in_raw)
  {
   $mc++;
   $min_table.="<td></td>";
  
  }
  
  $min_table.="</tr></table>";  
  //$im1="/images/panel/$r->model/$r->model"."_1.png";
  
  if($miniatures==1) $min_table="";
 }
 
else
{ 
$min_table="";
//$im1="/images/panel/$r->pic_big";
} 

return $min_table;
}

/*
//--------------------------------------------- load miniatures ---------------------
$imgroot="/images/panel/$r->model";
$imfo=$document_root.$imgroot."/sm";

$miniatures_in_raw=5;


if(file_exists($imfo))
{
$files = scandir($imfo);

$miniatures=sizeof($files)-2;
//echo $miniatures;

$min_table="<table width=350px bfcolor=red><tr>";
$mc=0;
for($i=0;$i<$miniatures; $i++)
 {
  $j=$i+1;
  $min_table.="<td onclick='dich(\"$imgroot/$r->model"."_$j.png\");'><img src=$imgroot/sm/$r->model"."_$j.png width=50></td>";
  $mc++;
  if($mc==$miniatures_in_raw) {$mc=0; $min_table.="</tr><tr>";}
 }
  while($mc<$miniatures_in_raw)
  {
   $mc++;
   $min_table.="<td></td>";
  
  }
  
  $min_table.="</tr></table>";  
  $im1="/images/panel/$r->model/$r->model"."_1.png";
  
  if($miniatures==1) $min_table="";
 }
 
else
{ 
$min_table="";
$im1="/images/panel/$r->pic_big";
} 

//-------------------------------end load miniature -------------------------------


*/


function get_file_date($file)
{
$document_root=$GLOBALS["path_to_real_files"];
$filename=$document_root.$file;
//return $filename;
if(file_exists($filename) )
{
$out=date("d-m-y", filemtime($filename));
$fs=filesize($filename);

if($fs>1000000)
 { 
  $fso=round($fs/1000,0);
  $fso=round($fso/1000,3);
  return  $out."<br>".$fso." MB";
 }
else{
    if($fs>1000)
      {
       $fso=$fs%1000;
	   return  $out."<br>".$fso." KB";
      }
       else 
	   return    $out."<br>".$fs." B";
   }
   
    

}
else return "no file";
}


function show_com_connector($panel)  //main func for show all panels connectors
{
if(!file_exists("com_port/$panel.txt")) {echo "no file"; return;}
$f=file_get_contents("com_port/$panel.txt");
$conns=explode("#" , $f);  // get connectors;
//echo "connectors=$conns[0] <br>";

for($i=0;$i<sizeof($conns); $i++)
 {
  $con_d=explode("---",$conns[$i]);
  $conn_d1=explode("--",$con_d[0]);
  if($conn_d1[1]=="M") { $imcon="/images/com_m.png"; $typcon="DB-9 M ( Папа )"; }
  if($conn_d1[1]=="F") {$imcon="/images/com_f.png"; $typcon="DB-9 F ( Мама )"; }

  
  
  echo "<table width=950 class=pins_tab><tr><td width=300 valign=top align=left> 
  <div class=pins_its>
  <span class=conn_name>Наименование разъема:</span>
  <br><div class=conn_name1 $conn_d1[0]</div><br>
  <span class=conn_name>Тип разъема: </span>
  <br><div class=conn_name1>$typcon</div> <br>
  <img src=$imcon width=200>
  </div>
  <td valign=top align=left>
  ";
  show_com_ports($con_d[1]);
  echo "</td></tr></table><br><br><br>";
 
 }



//$a=explode("\n", $f);


}

function show_com_ports($connector)  // show one connector
{
$a=explode("\n", $connector);
$ports=sizeof($a);
//echo "ports=$ports<br>";
echo "<table cellpadding=0 cellspacing=0 ><tr><td>
<table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc>
<tr><td><div class=pins_its_h>Pin #</div></td></tr>
<tr><td><div class=pins_its> 1</div></td></tr>
<tr><td><div class=pins_its>2</div></td></tr>
<tr><td><div class=pins_its>3</div></td></tr>
<tr><td><div class=pins_its>4</div></td></tr>
<tr><td><div class=pins_its>5</div></td></tr>
<tr><td><div class=pins_its>6</div></td></tr>
<tr><td><div class=pins_its>7</div></td></tr>
<tr><td><div class=pins_its>8</div></td></tr>
<tr><td><div class=pins_its>9</div></td></tr>
</table>
</td>";
/*
echo "<td>";
    show_1_port($a[0]);
	echo "</td>";
echo "</tr></table>";
*/

for($y=1;$y<$ports-1;$y++)  // from 1 because becaus 0 is before first \n
  {
    echo "<td valign=top>";
    show_1_port($a[$y]);
	echo "</td>";
  }
  echo "</tr></table>";
 
}

function show_1_port($port)   // show one port
{

$b=explode("=", $port);
//echo "<br>";
$c=explode("|", $b[1]);
$pins= sizeof($c);
//echo $pins;
echo "<table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc>
<tr><td><div class=pins_its_h>$b[0]</div></td></tr>";



for($i=1;$i<10;$i++)
 {
  $out="";
   for($j=0; $j<$pins; $j++)
   {
    $p=explode(" ", $c[$j]);
    if($p[0]==$i) 
    $out= $p[1];
	
   }
   if($out=="") $out=" &nbsp"; 
    echo "<tr><td ><div class=pins_its> $out</div></td></tr>";
    
  }
 
echo "</table>";


}


function comp_pan($mod, $p)
{
$sql="SELECT * FROM products_all WHERE `model` = '$mod' ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);

$fo=strtolower($r->brand);
if($fo=="weintek") $fo=panel;
$imp="/images/$fo/$r->model/$r->model"."_1.png";
$arr=array();
$pn=array();
array_push($arr, $r->model);   array_push($pn, "Модель");   
array_push($arr, $r->series);  array_push($pn, "Серия"); 
array_push($arr, $r->brand);   array_push($pn, "Бренд"); 
array_push($arr, $r->type);    array_push($pn, "Тип"); 

array_push($arr, $r->diagonal."\"");   array_push($pn, "Диагональ"); 
array_push($arr, $r->resolution); array_push($pn, "Разрешение");
array_push($arr, $r->colors); array_push($pn, "Цветность");
array_push($arr, $r->brightness);  array_push($pn, "Яркость"); 
array_push($arr, $r->contrast);    array_push($pn, "Контраст"); 
array_push($arr, $r->veiw_angle);    array_push($pn, "Угол обзора, &deg"); 
array_push($arr, $r->backlight);   array_push($pn, "Подсветка");
array_push($arr, $r->backlight_life); array_push($pn, "Время подсветки");  
array_push($arr, $r->touch);       array_push($pn, "Сенсор"); 

array_push($arr, "empty"); array_push($pn, "&nbsp Параметры");
 


array_push($arr, $r->cpu_type);   array_push($pn, "Процессор"); 
array_push($arr, $r->cpu_speed);  array_push($pn, "Частота, МГц"); 
array_push($arr, $r->chipset);  array_push($pn, "Чипсет"); 
array_push($arr, $r->graphics);  array_push($pn, "Графика"); 
array_push($arr, $r->audio);       array_push($pn, "Аудио"); 
array_push($arr, $r->ram);        array_push($pn, "ОЗУ, Мб"); 
array_push($arr, $r->ram_type);        array_push($pn, "Тип ОЗУ"); 
array_push($arr, $r->ram_slots);        array_push($pn, "Кол-во слотов ОЗУ"); 
array_push($arr, $r->ram_max);        array_push($pn, "Макс. объем ОЗУ, Мб"); 
array_push($arr, $r->flash);       array_push($pn, "Flash, Мб"); 
array_push($arr, "$r->hdd_size_gb $r->hdd_type");       array_push($pn, "Жесткий диск"); 
array_push($arr, $r->rtc);       array_push($pn, "Часы реального времени"); 
array_push($arr, $r->power);    array_push($pn, "Мощность, Вт"); 
array_push($arr, $r->current);    array_push($pn, "Потребляемый ток, А"); 
array_push($arr, "$r->voltage_min-$r->voltage_max");    array_push($pn, "Напряжение, В"); 

array_push($arr, "empty"); array_push($pn, "&nbsp Интерфейсы");

array_push($arr, $r->serial_full); array_push($pn, "СОМ порты"); 
array_push($arr, $r->usb_host);    array_push($pn, "USB host"); 
array_push($arr, $r->usb_client);  array_push($pn, "USB client"); 
array_push($arr, $r->ethernet);    array_push($pn, "Ethernet"); 
array_push($arr, $r->sdcard);     array_push($pn, "SD карта"); 

array_push($arr, $r->linear_out);       array_push($pn, "Линейный аудиовыход "); 
array_push($arr, $r->video_input); array_push($pn, "Видео вход"); 

array_push($arr, "empty"); array_push($pn, "&nbsp Конструкция");


array_push($arr, $r->case_material); array_push($pn, "Корпус");
array_push($arr, $r->cpu_fan?"вентилятор":"безвентиляторное" ); array_push($pn, "Тип охлаждения");

array_push($arr, $r->dimentions); array_push($pn, "Размеры, мм"); 
array_push($arr, $r->cutout);      array_push($pn, "Вырез под посадку, мм"); 
array_push($arr, $r->netto);      array_push($pn, "Вес, кг"); 
array_push($arr, "$r->temp_min-$r->temp_max");   array_push($pn, "Рабочая темп-ра, &degC"); 

array_push($arr, "empty"); array_push($pn, "&nbsp ПО");

array_push($arr, $r->os);           array_push($pn, "ОС"); 
array_push($arr, $r->software);     array_push($pn, "ПО"); 
array_push($arr, $r->vnc);          array_push($pn, "VNC сервер"); 

$out="";
$out.="<table>


<tr><td>$r->dimentions &nbsp</td></tr>
<tr><td>$r->netto &nbsp</td></tr>
<tr><td>$r->temp &nbsp</td></tr>
<tr><td>$r->temp_min &nbsp</td></tr>
<tr><td>$r->temp_max &nbsp</td></tr>
<tr><td>$r->brutto &nbsp</td></tr>
<tr><td>$r->video_input &nbsp</td></tr>
<tr><td>$r->os &nbsp</td></tr>



</table>
";
if($p==1)
return $arr;
else return $pn;
}


function show_stock($r,$mode)
{
 if($mode==1) $cl="onstock"; // big letters
 if($mode==2) $cl="onstock2"; // small letters
 if($mode==3) $cl="onstock2"; // small letters and no "на складе"
 
 
 if($r->onstock_spb==0 && $r->onstock_msk==0 && $r->onstock_kiv==0 && $r->onstock_ptg==0) 
 {
  $med=get_models_expected_date($r->model);
 //
  if($mode==3)
  {
  if($med=="")
  return "под заказ ";
  $med1=remain_days($med);
  $med=stime("", $med);
  return "ожидается через $med1 дней";
  
   }
  
 
  if($med=="")
  return "<div class=$cl> <img src='/images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ </div>";
  $med1=remain_days($med);
  $med=stime("", $med);
  return "<div class=$cl title='$med'> <img src='/images/red_sq.gif' >&nbsp;&nbsp;&nbsp;ожидается через $med1 дней</div>";
 }
 
 
 $co=0;
 $out="";
 $v=0;
 if($r->onstock_spb>0)
 { $out.="<span title='Санкт-Петербург'>СПБ</span>"; $v=1; $co++; }

 if($r->onstock_msk>0)
 {
 if($v==1) { $out.=", ";}
 $out.="МСК";
 $v=1;
 $co++;
 }
 
 if($r->onstock_kiv>0)
 {
 if($v==1) { $out.=", ";}
 $out.="КИЕВ";
 $co++;
 }
 if($r->onstock_ptg>0)
 {
 if($v==1) { $out.=", ";}
 $out.="<span title='Пятигорск'>ПГСК</span>";
 $co++;
 }
 

 if($co==1) $s="на складе:"; else  $s="на складах:";
 $out1="<div class=$cl> <img src='/images/green_sq.gif' >&nbsp;&nbsp;&nbsp $s  $out</div>";
 
 if($mode==3) 
  $out1=$out;
 return $out1;

}


function add_to_basket()
{
if(defined('basket_shit')) return;
define('basket_shit', 1);

echo "
<div id=amount_q>
<table><tr><td >
 <span id=modn>11</span>&nbsp &nbsp </td><td width=50>
Кол-во: </td><td>
<table cellpadding=0 cellspacing=0 border=0>
<tr><td class= am_td><input type=text id=items_amount></td><td>

<table cellpadding=0 cellspacing=0>
<tr><td class=am_td width=20 align=center><img src=/images/but_plus.png width=12 onclick='am_inc();'></tr></tr>
<tr><td class=am_td width=20 align=center><img src=/images/but_minus.png width=12 onclick='am_dec();'></tr></tr>
</table>
</td></tr></table>
</td></tr></table>
<center>
<br>
<span class=zakazbut onclick='add_item();'>OK</span> &nbsp 
<span class=zakazbut onclick='cancel_add_item();'>Отмена</span>

</center>
</div>
<br><br>
";

} 
 
function popup_messages()
{
if(defined('popup_shit')) return;
define('popup_shit', 1);
echo "
<div id=mes_container>
<div id=mes_header onclick='hide_popup();'>
Сообщение
</div>
<div id=mes_body>

body
</div>
</div>
<div id=mes_backgr> </div>
";
//---------------------- popmes 1 --
echo "
<div id=popmes1 style='display:none;'>

Для обсуждения скидки <br>
сообщите нам свой телефонный номер<br>
<input id='phone' type=text >
<br><br>
<table width=100%>
<td width=50% align=center>
<span class=orangebut onclick='get_discount_form()'>Отправить</span>
</td><td align=center>
<span class=orangebut onclick='hide_popup()'>Закрыть</span>
</td></table>

<div id=form_out> </div>

</div>
";

}	
	
	
	
function basket()
{

if(defined('basket_shit1')) return;
define('basket_shit1', 1);

echo "
<div id=slided> 
<br>
<div id=basket_container>
<div id=basket>
<center><span class=bask_head style='font-size: 15px;'>Корзина</span></center><br>
<div id=resba> </div>
<br><center>
<span class=bask_head style='font-size: 15px; cursor: pointer;' onclick='window.location=\"/oformit_zakaz.php\"' >Оформить</span> 
&nbsp &nbsp 
<span class=bask_head style='font-size: 15px; cursor: pointer;' onclick='clean_basket();' >Очистить</span> </center>
</div></div></div>

<div id=basket_small onclick='ts()'>
<table width=100%><tr><td width=40><img src='/images/cart2.png' width=30 ></td><td><div id=bask_sm_text> </div></td></tr></table>
</div>
";




}

function show_series_open_hmi()
{
echo "<br><br>";

echo "<div class=series_name>Серия OpenHMI </div>";

echo "<br><center><div class=series_descr>Серия 8000 появилясь в 2000 году и сразу же стала очень популярна во всем мире. Отличительной
особенностью серии 6000 был впервые примененый широкоугольный дисплей. Теперь уже большинство производителей панелей оператора 
предлагают широкоугольные дисплеи.  </div></center><br>";

echo "<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT607i");
echo "</td><td align=center valign=top>";
echo show_panel1("MT612XH");   // end row 
echo "</td></tr>    
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT610i");
echo "</td><td align=center valign=top>";
echo show_panel1("MT615XH");  // end row 
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT610XH");
echo "</td><td align=center valign=top>";
echo "</td></tr></table></center>";
}


function show_series_ie()
{
echo "<br><br>";

echo "<div class=series_name>Серия  iE </div>";

echo "<br><center><div class=series_descr>Серия 8000 появилясь в 2000 году и сразу же стала очень популярна во всем мире. Отличительной
особенностью серии 6000 был впервые примененый широкоугольный дисплей. Теперь уже большинство производителей панелей оператора 
предлагают широкоугольные дисплеи.   </div></center><br>";

echo "<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT8070iE");
echo "</td><td align=center valign=top>";
echo show_panel1("MT8100iE");   // end row 
echo "</td></tr></table></center>";

}



function show_series_emt()
{
echo "<br><br>";

echo "<div class=series_name>Серия  eMT3000 </div>";

echo "<br><center><div class=series_descr>Серия 8000 появилясь в 2000 году и сразу же стала очень популярна во всем мире. Отличительной
особенностью серии 6000 был впервые примененый широкоугольный дисплей. Теперь уже большинство производителей панелей оператора 
предлагают широкоугольные дисплеи.  </div></center><br>";

echo "<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("eMT3070A");
echo "</td><td align=center valign=top>";
echo show_panel1("eMT3105P");   // end row 
echo "</td></tr>    
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("eMT3120A");
echo "</td><td align=center valign=top>";
echo show_panel1("eMT3150A");  // end row 
echo "</td></tr></table></center>";


}


function show_series_8000()
{
echo "<br><br>";

echo "<div class=series_name>Серия 8000 </div>";

echo "<br><center><div class=series_descr>Серия 8000 появилясь в 2000 году и сразу же стала очень популярна во всем мире. Отличительной
особенностью серии 6000 был впервые примененый широкоугольный дисплей. Теперь уже большинство производителей панелей оператора 
предлагают широкоугольные дисплеи.  </div></center><br>";

echo "<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT8050i");
echo "</td><td align=center valign=top>";
echo show_panel1("MT8100i");   // end row 
echo "</td></tr>    
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT8070iH");
echo "</td><td align=center valign=top>";
echo show_panel1("MT8104iH");  // end row 
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT8104XH");
echo "</td><td align=center valign=top>";
echo show_panel1("MT8150X");  // end row 
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT8121X");
echo "</td> <td> </td>
</tr></table></center>";

}


function show_series_6000()
{
echo "<br><br>";

echo "<div class=series_name>Серия 6000i </div>";

echo "<br><center><div class=series_descr>Серия 6000i появилясь в 2000 году и сразу же стала очень популярна во всем мире ,благодаря отличному
соотношению цена/качество, а также удобству загрузки проекта с ПК по USB кабелю. Отличительной
особенностью серии 6000i был впервые в мире примененый на панелях оператора широкоугольный дисплей. В настоящее время, усвоив успешный опыт Weintek,
большинство производителей операторских панелей также 
предлагают широкоугольные дисплеи.  </div></center><br>";

echo "<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT6050i");
echo "</td><td align=center valign=top>";
echo show_panel1("MT6100i");
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("MT6070iH");
echo "</td> <td> </td>
</tr></table></center>";


}


//------------------------------------------------- function show ifc-----------------------------------------
function show_ifc($num)
{
$im="/images";
$altstr="операторские панели, сенсорные панели, HMI, Weintek, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder";


database_connect();


$sql="SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());

$r=mysql_fetch_object($res);


$inter=$r->serial;
if($r->ethernet) $inter.=", Ethernet";
if($r->sdcard) $inter.=", SD карта";
if($r->usb_host) $inter.=", USB host";


$fo="ifc";

if($r->series=="ARCHMI") $fo="aplex";
if($r->series=="RF") $fo="ifc";

//echo strpos($r->model, "ARCH");
//echo "$fo $r->model";

//$imm="$im/$fo/$r->model/$r->model"."_1.png";
$imm=get_big_pic($r->model);
$alt="$r->diagonal\" $r->model, ".get_kw( "alt" );
//$imm="/images/panel/$r->model/$r->model"."_2.png";
//pan_name11
//<tr height=5><td colspan=3> </td></tr>
 $out= "
 <div class=pan_sm_cont> 
 <table width=100%>
 <tr><td class=pan_price colspan=2 >$r->diagonal\" &nbsp;Панельный компьютер $r->model 
 <div class=hc11> &nbsp;</div> </td><td></td></tr>
 
 <tr>
 <td width=180 class=price11 align=left height=180 valign=middle> <a href=/panelnie-computery/$fo/$r->model.php>
 <img src='$imm' width=130 border=0 alt='$alt'></a>";

 $onst=show_stock($r,2);

//<tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
 //<tr><td colspan=3>  &nbsp</td></tr>
 
 $bw="90px";
 $tdw="120px";
 // right column
 $out.=" </td><td  class=pan_price valign=top align=left>

 <table><width=100%>
 <tr><td width=140>&nbsp </td><td width=40><div class=pan_price>Цена</div></td><td width=40> <div class=prpr style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</div></td>
 <td><div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div></td></tr>
 

 <tr><td colspan=3 height=20> &nbsp </td></tr>
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>

 <table>
 <tr height=50><td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
 </tr height=50><tr>
     <td width=$tdw align=rigth>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </td>
  </tr></table>

 </td>
 </tr></table>";
 
 $disp="$r->diagonal, $r->resolution, $r->sensor";
 

 $out.= "<div class=bor><table width=100% cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=70 >Диагональ</td><td class=par_val11 width=90 >$r->diagonal\"</td>
 <td class=par_name11 width=90>Разрешение</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >CPU</td><td class=par_val11>$r->cpu_type</td>
 <td class=par_name11>RAM</td><td class=par_val11>$r->ram</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3>$inter</td></tr>


 </table></div>
 </div>";
 
 return $out;

}


//------------------------------------------------- function show panel1------------------------------------------
function show_panel1($num)
{
$im="/images";
$altstr="операторские панели, сенсорные панели, HMI, Weintek, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder";


database_connect();


$sql="SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());

$r=mysql_fetch_object($res);


$inter=$r->serial;
if($r->ethernet) $inter.=", Ethernet";
if($r->sdcard) $inter.=", SD карта";
if($r->usb_host) $inter.=", USB host";
if($r->can_bus) $inter.=", CAN";

//$im/panel/$r->pic_small
$fo="weintek";
if( $r->brand=="Weintek") $fo="weintek";
if( $r->brand=="Samkoon") $fo="samkoon";

if($r->software=="") {$poos="ОС"; $poos1=$r->os;} else {$poos="ПО"; $poos1=$r->software;}


//$imm="$im/panel/$r->pic_small";
$imm=get_small_pic($r->model);
$alt="$r->diagonal\" $r->model, ".get_kw( "alt" );
//$imm="/images/panel/$r->model/$r->model"."_2.png";
//pan_name11
//<tr height=5><td colspan=3> </td></tr>
 $out= "
 <div class=pan_sm_cont>
 <table width=100%>
 <tr><td class=pan_price colspan=2 >$r->diagonal\" &nbsp;Панель оператора $r->model 
 <div class=hc11> &nbsp;</div> </td><td></td></tr>
 
 <tr>
 <td width=180 class=price11 align=left height=180 valign=middle> <a href=/$fo/$r->model.php>
 <img src='$imm' width=130 border=0 alt='$alt'></a>";

 $onst=show_stock($r,2);

//<tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
 //<tr><td colspan=3>  &nbsp</td></tr>
 
 $bw="90px";
 $tdw="120px";
 // right column
 $out.=" </td><td  class=pan_price valign=top align=left>

 <table><width=100%>
 <tr><td width=140>&nbsp </td><td width=40><div class=pan_price>Цена</div></td><td width=40> <div class=prpr style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</div></td>
 <td><div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div></td></tr>
 

 <tr><td colspan=3 height=20> &nbsp </td></tr>
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>

 <table>
 <tr height=50><td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
 </tr height=50><tr>
     <td width=$tdw align=rigth>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </td>
  </tr></table>

 </td>
 </tr></table>";

 $out.= "<div class=bor><table width=100% cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=90 >Диагональ</td><td class=par_val11 width=70 >$r->diagonal\"</td>
 <td class=par_name11 width=90>Разрешение</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >Цветность</td><td class=par_val11>$r->colors</td>
 <td class=par_name11>$poos</td><td class=par_val11>$poos1</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3>$inter</td></tr>


 </table></div>
 </div>";
 
 return $out;

}
//------------------------------end show panel----------------------------------------------------------------

//------------------------------------------------- function show panel ------------------------------------------
function show_panel1_old($num)
{
$im="/images";
$altstr="операторские панели, сенсорные панели, HMI, Weintek, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder";


database_connect();


$sql="SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());

$r=mysql_fetch_object($res);


$inter=$r->serial;
if($r->ethernet) $inter.=", Ethernet";
if($r->sdcard) $inter.=", SD карта";
if($r->usb_host) $inter.=", USB host";


 echo "
 <div class=pan_sm_cont>
 <table width=300>
 <tr><td class=pan_name11 colspan=2 >$r->diagonal\" &nbsp;Панель оператора $r->model <div class=hc11> &nbsp;</div> </td><td></td></tr>
 <tr height=5><td colspan=3> </td></tr>
 <tr>
 <td width=180 class=price11 align=left> <a href=/weintek/".$r->model.".php><img src=$im/panel/$r->pic_small width=130 border=0 alt='$r->model, $altstr'></a>";

 //

 if($r->onstock==0) $onst="<div class=pan_name11> <img src=$im/red_sq.gif >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>"; 
 else $onst= "<div class=pan_name11><img src=$im/green_sq.gif >&nbsp;&nbsp;&nbsp;есть на складе</div>";


 echo" </td><td class=pan_price valign=top align=left>

 <table><width=100%>
 <tr><td width=40>Цена</td><td width=40> <div class=prpr style='font-size:10px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</div></td>
 <td><div class=val_name style='font-size:10px;'  title='Нажмите для пересчета в РУБ'>USD </div></td></tr>
 <tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
 <tr><td colspan=3>  &nbsp</td></tr>

 
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>
 <div class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div>

 </td>
 </tr></table>";

 echo "<div class=bor><table width=300 cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=70 >Диагональ</td><td class=par_val11 width=70 >$r->diagonal\"</td>
 <td class=par_name11 width=70>Разрешение</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >Цветность</td><td class=par_val11>$r->colors</td>
 <td class=par_name11>ПО</td><td class=par_val11>$r->software</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3>$inter</td></tr>


 </table></div>
 </div>";

}

function temp00($name)  // UTF8
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/ra.css" />
    
	<link rel="stylesheet" type="text/css" href="/css/menu5.css" />
	<link rel="stylesheet" type="text/css" href="/css/menu4.css" />
	<link rel="stylesheet" type="text/css" href="/css/tabs.css" />
	<link rel="stylesheet" type="text/css" href="/css/button.css" />
	<link rel="stylesheet" type="text/css" href="/css/tango/skin.css" />
	

    <meta http-equiv=Content-Type content=text/html; charset=utf-8>
    <title>dialog demo</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="/js/ra_scripts.js"></script>
	<script type="text/javascript" src="/js/s.js"></script>
	<script type="text/javascript" src="/js/jquery.maskedinput.js"></script>

	
	
	
	
	<script src="/js/search.js"></script>
	
	
	
</head>
<body>





<noscript>
  This page needs JavaScript activated to work.<br>
  Пожалуйста, включите Javascript чтобы просмотреть эту страницу
     
  <style>div { display:none; }</style>
</noscript>


<div id=body_cont >


<table width=100% bgcolor=white><tr><td width=300px>
<img src=../images/logo.jpg style="padding-left: 10px; cursor: pointer;" onclick='window.location="/"'>
</td><td> </td></tr></table>

<?
top_menu();
usd_rate();
search();
compare();

}

//------------------------------end show panel----------------------------------------------------------------

function temp0($name)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
     <title> <? echo get_kw( "title"); ?>   </title>
	 <meta name="description" content="<? echo get_kw( "descr"); ?>">
	 <meta name="keywords" content="<? echo get_kw( "kw"); ?>">
	 
    <link rel="stylesheet" type="text/css" href="/css/ra.css" />
    
	<link rel="stylesheet" type="text/css" href="/css/menu5.css" />
	<link rel="stylesheet" type="text/css" href="/css/menu4.css" />
	<link rel="stylesheet" type="text/css" href="/css/tabs.css" />
	<link rel="stylesheet" type="text/css" href="/css/button.css" />
	<link rel="stylesheet" type="text/css" href="/css/tango/skin.css" />
	

    <meta http-equiv=Content-Type content=text/html; charset=windows-1251>
    
	
    <link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="/js/ra_scripts.js"></script>
	<script type="text/javascript" src="/js/s.js"></script>
	<script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
	<script type="text/javascript" src="/js/sha512.js"></script>

	
	
	
	
	<script src="/js/search.js"></script>
	
	
	
</head>


<body>


<noscript>
  This page needs JavaScript activated to work.<br>
  Пожалуйста, включите Javascript чтобы просмотреть эту страницу
     
  <style>div { display:none; }</style>
</noscript>

<!--[if IE 7]>

Вы используете устаревший браузер Internet explorer 7<br>
Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
<style> div { display:none; }</style>
<![endif]-->

<!--[if IE 6]>

Вы используете устаревший браузер Internet explorer 6<br>
Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
<style> div { display:none; }</style>
<![endif]-->


<div id=mes_backgr> </div>
<div id=body_cont >

<table width=100% bgcolor=white><tr height=85><td width=300px>
<img src=/images/logo.jpg style="padding-left: 10px; cursor: pointer;" onclick='window.location="/"'>
</td><td> </td></tr></table>





<?
top_menu();
usd_rate();
search();
compare();
backup_call();
}

//<span class=zakazbut onclick='go_to_comparison()'>Сравнить</span> <span class=zakazbut onclick='hide_compare()'>Закрыть</span>

function compare()
{
echo "<div id=compare >
<br>
<span id=compare_h>Ваш список сравнения:</span>
<br><br>
<div id=compare_body> </div>


<div id=compare_message> </div>
<br><br>
<span class=zakazbut onclick='window.location=\"/comparison.php\"'>Сравнить</span> <span class=zakazbut onclick='hide_compare()'>Закрыть</span>


</div>";
}
//<span id=backup_call_h> </span>


function backup_call()
{
echo "<div id=backup_call >
<div id=backup_call_h> </div>

<div id=backup_call_body> </div>
<center>
+<input type=text class=phoneNumber name=phone>

<div id=backup_call_message> </div>
<br><br><center>
<span class=zakazbut onclick='backup_call_go()'>Звонок</span>  &nbsp &nbsp<span class=zakazbut onclick='backup_call_hide()'>Закрыть</span></center>


</div>

";
}


function search()
{
//<span class=searchbut onclick='gotosearch()'> &nbsp Искать</span>
echo "
<div id=search>
<input type=text id=tete value='поиск...' onclick='se_click()'> 
<img src='/images/search_btn.png' id=se_im onclick='gotosearch()'>
<div id=sho> </div>
</div>
";


}

function top_menu()
{
echo "<div class=menu_top_cont>
<div class=menu_top>
<a href='/'>ГЛАВНАЯ</a> |
<a href='/contacts.php'> КОНТАКТЫ </a>|
<a href='/podbor.php'> ПОДБОР </a>|
<a href='/comparison.php'> СРАВНЕНИЕ </a>|
<a href='/contacts.php'> СКАЧАТЬ</a> |
<a href='/contacts.php'> ФОРУМ </a> |
<a href='/support.php'> ТЕХ.ПОДДЕРЖКА </a>
</div>
</div>
";
}

function usd_rate()
{
$current_usd_rate = file_get_contents($GLOBALS["usd_rate_file"]);
echo "<div id=usdrate> 1 USD = <span id=curusd>$current_usd_rate </span> РУБ</div>";
}

//style="padding-left: 10px;"
//<li class='active'><a href='index.html'><span>HMI WEINTEK</span></a></li>
function top_buttons()
{

//$m1=" <div class=mytabhover><table ><tr><td  class=my_menuitem_sm >Панели оператора</td></tr><tr><td class=my_menuitem>WEINTEK</td></tr></table></div> "; 
$m1=" <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/weintek\"'><font size=1px>Панели оператора</font><br>WEINTEK</span></center></div> ";  
$m2=" <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/samkoon\"'><font size=1px>Панели оператора</font><br>SAMKOON</span></center></div> ";  
$m3=" <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/panelnie-computery/ifc\"'><font size=1px>Панельные компьютеры</font><br>IFC</span></center></div> ";  
$m4=" <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/panelnie-computery/aplex\"'><font size=1px>Панельные компьютеры</font><br>APLEX</span></center></div> ";  

// s
//<a href='/weintek/'>  </a>

echo "

<div id='cssmenut'>
<ul>
   <li class='has-sub'>  $m1 
     <ul>
         <li class='has-sub'><a href='/weintek/series6000i.php'><span>Серия МТ6000i</span></a>
            <ul>
               <li><a href='/weintek/MT6050i.php'><span class=my_span>4.3\"</span><span> MT6050i</span></a></li>
               <li><a href='/weintek/MT6070iH.php'><span class=my_span>7\"</span><span> MT6070iH</span></a></li>
               <li class='last'><a href='/weintek/MT6100i.php'><span class=my_span>10\"</span><span> MT6100i</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='/weintek/series8000i.php'><span>Серия MT8000i</span></a>
            <ul>
               <li><a href='/weintek/MT8050i.php'><span class=my_span>4.3\" </span><span> MT8050i</span></a></li>
               <li><a href='/weintek/MT8070iH.php'><span class=my_span>7\" </span><span>MT8070iH</span></a></li>
               <li><a href='/weintek/MT8100i.php'><span class=my_span>10\"  </span><span>MT8100i</span></a></li>
               <li><a href='/weintek/MT8104iH.php'><span class=my_span>10.4\"  </span><span>MT8104iH</span></a></li>
               <li><a href='/weintek/MT8104XH.php'><span class=my_span>10.4\"  </span><span>MT8104XH</span></a></li>
               <li><a href='/weintek/MT8121X.php'><span class=my_span>12.1\"  </span><span>MT8121X</span></a></li>
               <li class='last'><a href='/weintek/MT8150X.php'><span class=my_span>15\" </span><span>MT8150X</span></a></li>
            </ul>
         </li>
		 <li class='has-sub'><a href='/weintek/emt3000.php'><span>Серия eMT3000</span></a>
            <ul>
               <li><a href='/weintek/eMT3070A.php'><span class=my_span>7\" </span><span> eMT3070A</span></a></li>
               <li><a href='/weintek/eMT3105P.php'><span class=my_span>10\" </span><span>eMT3105P</span></a></li>
               <li><a href='/weintek/eMT3120A.php'><span class=my_span>12\"  </span><span>eMT3120A</span></a></li>
               <li class='last'><a href='/weintek/eMT3150A.php'><span class=my_span>15\" </span><span>eMT3150A</span></a></li>
            </ul>
         </li>
		 
		  <li class='has-sub'><a href='/weintek/series_ie.php'><span>Серия iE</span></a>
            <ul>
               <li><a href='/weintek/MT6070iE.php'><span class=my_span>7\" </span><span> MT6070iE</span></a></li>
               <li><a href='/weintek/MT8070iE.php'><span class=my_span>7\" </span><span>MT8070iE</span></a></li>
               <li class='last'><a href='/weintek/MT8100iE.php'><span class=my_span>10\" </span><span>MT8100iE</span></a></li>
            </ul>
         </li>
		 
		  <li class='has-sub'><a href='/weintek/open_hmi.php'><span>Серия MT600(Open HMI)</span></a>
            <ul>
               <li><a href='/weintek/MT607i.php'><span class=my_span>7\" </span><span> MT607i</span></a></li>
               <li class='last'><a href='/weintek/MT610i.php'><span class=my_span>10\" </span><span> MT610i</span></a></li>
             
            </ul>
         </li>
		 
		 <li class='has-sub'><a href='/weintek/series8_openhmi.php'><span>Серия eMT600(Open HMI)</span></a>
            <ul>
               <li><a href='/weintek/eMT607A.php'><span class=my_span>7\" </span><span> eMT607A</span></a></li>
               <li><a href='/weintek/eMT610P.php'><span class=my_span>10\" </span><span> eMT610P</span></a></li>
               <li><a href='/weintek/eMT612A.php'><span class=my_span>12\" </span><span> eMT612A</span></a></li>
               <li class='last'><a href='/weintek/eMT615A.php'><span class=my_span>15\" </span><span>eMT615A</span></a></li>
            </ul>
         </li>
		 
		  <li class='has-sub'><a href='/weintek/series8000i.php'><span>Серия mTV</span></a>
            <ul>
              
               <li class='last'><a href='/weintek/mTV-100.php'><span class=my_span> </span><span>mTV-100</span></a></li>
            </ul>
         </li>
      </ul>
   
   </li>
   <li class='has-sub'>$m2 
      <ul>
               <li><a href='/samkoon/SK-035AE.php'><span class=my_span>3.5\"</span><span> SK-035AE</span></a></li>
               <li><a href='/samkoon/SK-043AE.php'><span class=my_span>4.3\" </span><span>SK-043AE</span></a></li>
               <li><a href='/samkoon/SK-043AEB.php'><span class=my_span>4.3\" </span><span>SK-043AEB</span></a></li>
               <li><a href='/samkoon/SK-043ASB.php'><span class=my_span>4.3\" </span><span>SK-043ASB</span></a></li>
               <li><a href='/samkoon/SK-050AE.php'><span class=my_span>5\"</span><span> SK-050AE</span></a></li>
               <li><a href='/samkoon/SK-050AS.php'><span class=my_span>5\" </span><span>SK-050AS</span></a></li>
               <li><a href='/samkoon/SK-070BE.php'><span class=my_span>7\" </span><span>SK-070BE</span></a></li>
               <li><a href='/samkoon/SK-070BS.php'><span class=my_span>7\" </span><span>SK-070BS</span></a></li>
               <li><a href='/samkoon/SK-102AE.php'><span class=my_span>10\" </span><span>SK-102AE</span></a></li>
               <li class='last'><a href='/samkoon/SK-102AS.php'><span class=my_span>10\" </span><span>SK-102AS</span></a></li> 
      </ul>
   </li>
   <li class='has-sub'>$m3
           <ul>
               <li><a href='/panelnie-computery/ifc/IFC-608RF.php'><span class=my_span>8\"</span><span> IFC-608RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-610RF.php'><span class=my_span>10\" </span><span>IFC-610RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-612RF.php'><span class=my_span>12\" </span><span>IFC-612RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-615RF.php'><span class=my_span>15\" </span><span>IFC-615RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-617RF.php'><span class=my_span>17\"</span><span> IFC-617RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-619RF.php'><span class=my_span>19\" </span><span>IFC-619RF</span></a></li>
               <li class='last'><a href='/panelnie-computery/ifc/IFC-622RF.php'><span class=my_span>22\" </span><span>IFC-622RF</span></a></li> 
            </ul>
   
   </li>
   
     <li class='has-sub'>$m4
           <ul>
               <li><a href='/panelnie-computery/aplex/ARCHMI-707P.php'><span class=my_span>7\"</span><span>ARCHMI-707P</span></a></li>
               <li><a href='/panelnie-computery/aplex/ARCHMI-712P.php'><span class=my_span>12\"</span><span>ARCHMI-712P</span></a></li>
             
               <li class='last'><a href='/panelnie-computery/aplex/ARCHMI-715P.php'><span class=my_span>15\"</span><span>ARCHMI-715P</span></a></li> 
            </ul>
   
   </li>
   <li class='last'><a href='#'><span>ПРОЧЕЕ</span></a></li>
</ul>
</div>";



}

function temp1()
{
echo "
<table width=100% cellpadding=0 cellspacing=0><tr><td valign=top width=250px>";// <!-- MAIN TABLE     td left menu -->

}

function temp1_no_menu()
{
echo "
<table width=100% cellpadding=0 cellspacing=0><tr><td valign=top width=0px>";// <!-- MAIN TABLE     td left menu -->

}

function left_menu()
{
?>
<br>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='index.html'><span>КАТАЛОГ</span></a></li>
   <li class='has-sub'><a href='#'><span>ПАНЕЛИ WEINTEK</span></a>
      <ul>
         <li class='has-sub'><a href='/weintek/series6000i.php'><span>Серия MT6000i</span></a>
            <ul>
			   <li><a href='#'><span>MT6050i</span></a></li>
               <li><a href='#'><span>MT6070iH</span></a></li>
			   <li class='last'><a href='#'><span>MT6100i</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='/weintek/series8000i.php'><span>Серия MT8000i</span></a>
            <ul>
               <li><a href='#'><span>MT8050i</span></a></li>
               <li><a href='#'><span>MT8070iH</span></a></li>
               <li class='last'><a href='#'><span>MT8100i</span></a></li>
               
            </ul>
         </li>
		  <li class='has-sub'><a href='#'><span>Серия eMT3000</span></a>
            <ul>
               <li><a href='#'><span>eMT3070A</span></a></li>
               <li><a href='#'><span>eMT3105P</span></a></li>
               <li><a href='#'><span>eMT3120A</span></a></li>
               <li><a href='#'><span>eMT3150A</span></a></li>                            
            </ul>
         </li>
		 
		 <li class='has-sub'><a href='#'><span>Серия iE</span></a>
            <ul>
               <li><a href='#'><span>MT8070iE</span></a></li>
               <li><a href='#'><span>MT8100iE</span></a></li>
                                        
            </ul>
         </li>
		 
		  <li class='has-sub'><a href='#'><span>Серия OPEN HMI</span></a>
            <ul>
               <li><a href='#'><span>MT607i</span></a></li>
               <li><a href='#'><span>MT610i</span></a></li>
               <li><a href='#'><span>MT610XH</span></a></li>
               <li><a href='#'><span>MT612XH</span></a></li>
               <li><a href='#'><span>MT615XH</span></a></li>
                                        
            </ul>
         </li>
		 
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>КОМПЬЮТЕРЫ IFC</span></a></li>
     <ul>
	 
	 </ul>
	 <li class='has-sub'><a href='#'><span>КОМПЬЮТЕРЫ APLEX</span></a></li>
     <ul>
	 
	 </ul> 
	 
   <li class='has-sub'><a href='#'><span>ПАНЕЛИ SAMKOON</span></a></li>
   <li class='has-sub'><a href='#'><span>КОНТРОЛЛЕРЫ</span></a></li>
   
   
</ul>
</div>



<?
}

function temp2()
{
?>
</td> 
<td valign=top> <!-- MAIN TABLE     td right content -->
<?
}

function temp3()
{
?>
</td></tr></table><!-- end main table -->

<div  id=footer>
<br><center>
&copy www.rusavtomatika.com 2008-2013
</center>
 </div>

</div> <!-- end main div -->


</body>

</html>


<?
}

//--------------------------------------- mail functions -------------------------------------------

function mime_header_encode($str, $data_charset, $send_charset) {
  if($data_charset != $send_charset) {
    $str = iconv($data_charset, $send_charset, $str);
  }
  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}


function send_message  (
                        $email, // email получателя

                        $subj, // тема письма
                        $text // текст письма

                        )


 {
     $name_from="RA no-reply"; // имя отправителя
     $email_from="no-reply@rusavtomatika.com"; // email отправителя
     $name_to=""; // имя получателя
     $data_charset="UTF-8"; // кодировка переданных данных
     $send_charset="UTF-8"; // кодировка письма
     $html = TRUE; // письмо в виде html или обычного текста
     $reply_to = FALSE;

  if($email=="admin") $email="plesk@mail.ru";


  $to = mime_header_encode($name_to, $data_charset, $send_charset)
                 . ' <' . $email . '>';
  $subject = mime_header_encode($subject, $data_charset, $send_charset);
  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
                     .' <' . $email_from . '>';
  if($data_charset != $send_charset) {
    $body = iconv($data_charset, $send_charset, $body);
  }
  $headers = "From: $from\r\n";
  $type = ($html) ? 'html' : 'plain';
  $headers .= "Content-type: text/$type; charset=$send_charset\r\n";
  $headers .= "Mime-Version: 1.0\r\n";
  if ($reply_to) {
      $headers .= "Reply-To: $reply_to";
  }



  return mail($to, $subj, $text, $headers);
}



function XMail( $from, $to, $subj, $text, $filename)
{
$subj=iconv("UTF-8", "CP1251", $subj);
$text=iconv("UTF-8", "CP1251", $text);
$f         = fopen($filename,"rb");
$un        = strtoupper(uniqid(time()));
$head      = "From: $from\n";
$head     .= "To: $to\n";
$head     .= "Subject: $subj\n";
$head     .= "X-Mailer: PHPMail Tool\n";
$head     .= "Reply-To: $from\n";
$head     .= "Mime-Version: 1.0\n";
$head     .= "Content-Type:multipart/mixed;";
$head     .= "boundary=\"----------".$un."\"\n\n";
$zag       = "------------".$un."\nContent-Type:text/html;\n";
$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
$zag      .= "------------".$un."\n";
$zag      .= "Content-Type: application/octet-stream;";
$zag      .= "name=\"".basename($filename)."\"\n";
$zag      .= "Content-Transfer-Encoding:base64\n";
$zag      .= "Content-Disposition:attachment;";
$zag      .= "filename=\"".basename($filename)."\"\n\n";
$zag      .= chunk_split(base64_encode(fread($f,filesize($filename))))."\n";


if (!mail("$to", "$subj", $zag, $head))
 return 0;
else
 return 1;
}



?>