<?php
session_start();
define("bullshit",1);


include_once $_SERVER['DOCUMENT_ROOT']."/sc/dbcon.php";
include_once ($_SERVER['DOCUMENT_ROOT']."/sc/lib_new.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/sc/lib_controllers.php");

//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));

//database_connect();
//mysql_query("SET NAMES 'cp1251'");



//echo "sss=".$_SERVER['SCRIPT_FILENAME'];
//echo "sss=".$_SERVER['DOCUMENT_ROOT'];
//---------------content ---------------------




//$var_array = explode("/",$_SERVER['REQUEST_URI']);
//$levels = count($var_array);
//$end_page = $levels - 1;

//$num="MT8070iH";   
//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$num=str_replace(".php", "", $var_array[$levels]);

$sql="SELECT * FROM `controllers` WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($res) > 0) {
$r=mysql_fetch_object($res);
//echo basename($_SERVER['PHP_SELF']);
/*
if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;��� ����� 4 ���.</div>";
 else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;���� �� �������: ���, ���, ����</div>";
*/





    $series = array('A-51'=>'series_a51','A-10x'=>'series_a10x','A-52'=>'series_a52','A-61'=>'series_a61','A-118'=>'series_a1','A-218'=>'series_a2');

if (preg_match('/[0-9]{2,}/',$r->model)) {$modul = str_replace('x','',$r->model);};

$kolvo = children($r->model);

if ($r->type == 'controller') {
if ($kolvo > 1) {$type='PLC, �����������';} else {$type='PLC, ����������';};	
 //$title = $r->brand.' '.$r->model.' � '.strtolower($type).' ���������� �� ������ �� �������� ����';
 $title='���, PLC, ��������������� ���������� ����������� Yottacontrol, ��������� �����������, �� ������';
};
if ($r->type == 'module'){
	if ($kolvo > 1) {$type='������ �����-������';} else {$type='������ �����-������';};	
//$title = $r->brand.' ����� '.$r->model.' � '.strtolower($type).' ��� PLC '.$r->brand.' �� ������ �� �������� ����';
if ($r->model == 'A-2060x') {
	  $title='���, PLC, ������-���������� �����-������ Yottacontrol '.$r->model.', ��������� �����������, �� ������';
} else {
 $title='���, PLC, ������������� ������ �����-������ Yottacontrol, ��������� �����������, �� ������';
};
if ($r->model == 'A-3016') {
//$type='����������� �����-������'; $title = $r->brand.' '.$r->model.' � ����������� �����-������ ��� PLC '.$r->brand.' �� ������ �� �������� ����';
 $title='���, PLC, ����������� �����-������ Yottacontrol, ��������� �����������, �� ������';
};
};
if ($r->type == 'transmitter') {
if ($kolvo > 1) {$type='������ ����������';} else {$type='����� ����������';};	
 $title = $r->brand.' '.$r->model.' � '.strtolower($type).' ���������� PLC ����� '.$r->series.' � �������� ������ �� ������ �� �������� ����';
};

if (!preg_match('/x/i',$r->model)) {$x='x';} else {$x='';};
$nav = '<nav><a href="/">�������</a>&nbsp;/&nbsp;<a href="/plc/yottacontrol/">�����������</a>&nbsp;/&nbsp;'.$type.' '.$r->model.$x.'</nav>';
$type = strtoupper($type);
switch ($r->type)  {
case 'controller':
$types = '�����������';
$types1 = '������������';
$keywords = 'PLC, ���, ���������� ����������, '.$r->model.', '.$r->brand.', �����������' ;
$description = 'PLC, ��������������� ���������� ���������� ����������, '.$r->model.', '.$r->brand.' - ����������� ��������� ���� � �����������������';
break;
case 'module':
if ($r->model == 'A-3016') {
$types = '����������� �����-������';
$types1 = '����������� �����-������';
$keywords = 'PLC, ���, ����������� ����� ������, ����������� ����������, '.$r->model.', '.$r->brand.'' ;
$description = '����������� �����-������, '.$r->model.', '.$r->brand.' ��� PLC, ��������������� ���������� ������������ ���������� '.$r->brand.' - ����������� ��������� ���� � �����������������';
} else {
$types = '������ �����-������';
$types1 = '������� �����-������';
$keywords = 'PLC, ���, ������ ����� ������, ����������� ����������, '.$r->model.', '.$r->brand.'' ;
$description = '������ �����-������, '.$r->model.', '.$r->brand.' ��� PLC, ��������������� ���������� ������������ ���������� '.$r->brand.' - ����������� ��������� ���� � �����������������';
};
break;
case 'transmitter':
$types = '����� ����������';
$types1 = '������ ����������';
$keywords = 'PLC, ���, ����������, ����� ����������, ��������� ����������, ���������� ������������, '.$r->model.', '.$r->brand.'' ;
$description = '����� ����������, '.$r->model.', '.$r->brand.' ��� PLC, ��������������� ���������� ������������ ���������� '.$r->brand.' ����� '.$r->series.'- ����������� ��������� ���� � �����������������';
break;
}





$onst=show_stock($r,1);

//$min_table=mini_controllers($r->model, 5, 10, 350); // mins_in_row, mins_max, table_width
//$im1=get_big_pic($r->model);


//echo $r->model;

	  
//if (empty($min_table)) {$min_table = "<table width='350' bfcolor='red'><tr>".$all_images."</tr></table>";};


$im1=img($r->model,1);
$bim1=imgbig($r->model,1);
$min_table=img_mini($r->model,15, 5, 10, 350);

$alt=$types.' '.$r->model.' '.$r->brand;


$prices_out = '
<script>
function dich(num,link)
 {    
 var alt="'.$alt.'";
if (link != "0") {
   $("#dd").html("<a id=\"biglightbox\" href=\'"+link+"\' rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" /><img  src=\'"+num+"\' alt=\'"+alt+"\'></span></a>");  
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

  if (!empty($bim1)) {
$kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt'></span></a>";

} else {
$kartinka = "
<img src='$im1' alt='$alt'>";
};

    $extra_openGraph = Array(
        "openGraph_image" => $im1,
        "openGraph_title" => $title,
        "openGraph_siteName" => "�������������"
    );

function kinder_price($model) {
$sql="SELECT `model`,`retail_price` FROM `controllers` WHERE `parent` = '$model' AND `retail_price`<>'0' ORDER BY `retail_price` LIMIT 1";
$res = mysql_query($sql) or die(mysql_error());


$price[0]= "<td width=60 colspan='2' style='display: initial;
padding: 0px 20px;
border: none;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >��&nbsp;�������</td>";
$price[1] = '';
$rows = mysql_num_rows($res);
if ($rows > 0) {
$r=mysql_fetch_object($res);

if (($r->retail_price != '0') AND ($r->retail_price != '')) {
$price[0]= "<td width=80 style='text-align:center;'><span class=prpr title='������� ��� ��������� � ���' >$r->retail_price</span></td><td class=val_name title='������� ��� ��������� � ���'> USD </td>";
$price[1] = '��';
};

};

return $price;
}


/*
if (($r->retail_price != '0') AND ($r->retail_price != '')) {
$priceb= "<td width=60 class=prpr title='������� ��� ��������� � ���' >$r->retail_price</td><td class=val_name title='������� ��� ��������� � ���'> USD </td>";
} else {
$priceb= "<td width=60 colspan='2' style='display: initial;
padding: 0px 20px;
border: none;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >��&nbsp;�������</td>";
};
*/

$priceb = kinder_price($r->model);

if (file_exists($_SERVER['DOCUMENT_ROOT'].'/sc/analog.php')) {
include($_SERVER['DOCUMENT_ROOT'].'/sc/analog.php');
};
$prices_out .= "
<center>
".$nav."<br>
<h1>".$title."</h1>
<table width=1000px  height=400px>   
<tr ><td colspan=2 height=50px> 

<table><tr><td width=840 align=left bfcolor=#cccccc><h2 class=\"big_pan_name".$class."\">$type <strong>$r->model</strong> </h2></td><td width=80 style='text-align:right;'>
 <div class=pan_price_big title='��������� ����'> ���� ".$priceb[1]."</div></td>".$priceb[0]."</tr></table>
<div class=hc1>&nbsp;</div>".$analog."<br>
</td></tr>
<tr ><td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div><style>h1 {text-transform: uppercase;font-size: 14px;text-align:left;width: 1000px;  margin: auto;margin-bottom: 20px;} nav {color: gray;  text-align: left;  padding: 0px 75px 0px;  font-size: 11px;
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




$prices_out .= "
<div id=cont_rp>

<table><width=100%>

 <tr><td colspan=3> &nbsp;</td></tr>
 <tr><td width=5>&nbsp;</td><td width=80 class=h2_text>�������: </td><td > $onst</td>
 <td>  </td>  </tr>

 </table><br>
 


";


$im="<img src='/images/tick.png' width=15 style='vertical-align: middle;'>";
$he="height=38 class=hl_text";
$vc="valign=center";


$pluses = array();
if ($r->spec_modif != '') {
$pluses[] = $r->spec_modif;
};

$pluses[] = '����������� ����������� ���� � ��������';

if ($r->DI_isol == '1') {$diisol = ' �������������';};
if ($r->DI_full !='') {

$pluses[] = '���������� �����: '.$r->DI_full.''.$diisol;
} else 
if ($r->DI > 0) {

$pluses[] = '���������� �����: '.$r->DI.'DI'.$diisol;
};

if ($r->DO_isol == '1') {$doisol = ', �������������';}

if ($r->DO_full != '') {
$pluses[]  = '���������� ������: '.$r->DO_full.''.$doisol;
} elseif ($r->DO > '0') {
	
if (($r->pnp == 1) AND ($r->pnp == 1)) {
$pnpn = ' (����������� PNP � NPN ���������) ';
} elseif ($r->pnp == 1) {$pnpn = ' (����������� PNP ���������) ';} elseif ($r->npn == 1) {$pnpn = ' (����������� NPN ���������) ';};	
	
	
$pluses[]  = '���������� ������: '.$r->DO.''.$pnpn.$doisol;
};



if ($r->AI_full !='') {

$pluses[] = '���������� �����: '.$r->AI_full;
} else 
if ($r->AI > 0) {
$pluses[] = '���������� �����: '.$r->AI.'AI';
};

if ($r->AO_full !='') {

$pluses[] = '���������� ������: '.$r->AO_full;
} else 
if ($r->AO > 0) {
$pluses[] = '���������� ������: '.$r->AO.'AI';
};


if (($r->brand == 'Yottacontrol') AND ($r->type == 'module')) {
$pluses[] = '����������� �� ����� ������������� '.$r->brand.' � ������������ Modbus';

};

if (($r->brand == 'Yottacontrol') AND ($r->model == 'A-3016')) {

$pluses[] = '������ �������� �� 100 ������ �� �����������';
};

$yotta = array();
if (!empty($r->serial_full)) {$yotta[] = $r->serial_full.' ( Modbus )';};
if (!empty($r->usb_host)) {$yotta[] = $r->usb_host;};
if (!empty($r->ethernet)) {$yotta[] = $r->ethernet;};
if (!empty($yotta)) {
$pluses[] = implode(', ',$yotta);
 };

 if (!empty($r->power_adapter)) {
$pluses[] = $r->power_adapter;
};

if (!empty($pluses)) {
$plus_table = "<tr><td width=30>$im </td><td $he>".implode("</td></tr><tr><td width=30>$im </td><td $he>",$pluses)."</td></tr>";
};
$prices_out .= "<br>
<table width=100%>

$plus_table
".'<tr><td width="30"><img src="/images/tick.png" width="15" style="vertical-align: middle;"> </td><td height="38" class="hl_text">���������� ����������� �����������</td></tr>'."

</table>
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
$price= "<span class=prpr title='������� ��� ��������� � ���' >$r->retail_price</span><span class=val_name title='������� ��� ��������� � ���'> USD </span>";
} else {
$price= "<span style='' class='zakazbut inline' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >����&nbsp;��&nbsp;�������</span>";
};



return $price;
}

function v_korzinu($model) {
$sql="SELECT `model`,`retail_price` FROM `controllers` WHERE `model` = '$model' AND `modification`='1' LIMIT 1 ";
$res = mysql_query($sql) or die(mysql_error());
$r=mysql_fetch_object($res);

if (($r->retail_price != '0') AND ($r->retail_price != '')) {
$price= 'class="zakazbut3 yes addToCart" title="� �������"';
} else {
$price= 'class="zakazbut3" title="��� �����"';
};



return $price;
}


if ((preg_match('/A-1188/i', $r->model)) OR (preg_match('/A-1189/i', $r->model))) {
	
if (preg_match('/A-1189/i', $r->model)) {$analog = '
<tr class="">
<td colspan="6">���������� �����: 4AI(10-���)</td>
</tr>
';};
	
$table_body .='
<tr class="hed gray" style="  border-bottom: 1px solid gray;">
<td><a href="/plc/yottacontrol/'.$modul.'S.php"><span  class="model_name">'.$modul.'S</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'.php"><span  class="model_name">'.$modul.'</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D.php"><span  class="model_name">'.$modul.'D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'S-T.php"><span  class="model_name">'.$modul.'S-T</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'-T.php"><span  class="model_name">'.$modul.'-T</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D-T.php"><span  class="model_name">'.$modul.'D-T</span></a></td>
</tr>

<tr class="">
<td><a href="/plc/yottacontrol/'.$modul.'S.php"><img src="'.img($modul.'S',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'.php"><img src="'.img($modul,1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D.php"><img src="'.img($modul.'D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'S-T.php"><img src="'.img($modul.'S-T',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'-T.php"><img src="'.img($modul.'-T',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D-T.php"><img src="'.img($modul.'D-T',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
</tr>
<tr class="">
<td colspan="6">���������� �����: 8DI</td>
</tr>
'.$analog.'
<tr class="">
<td colspan="3">���������� ������: 4DO (����)</td>
<td colspan="3">���������� ������: 4DO (����������)</td>
</tr>
<tr class="">
<td>-</td>
<td>I/O LED</td>
<td>������� 2&#8243;</td>
<td>-</td>
<td>I/O LED</td>
<td>������� 2&#8243;</td>
</tr>
<tr class="">
<td colspan="6">COM-�����: 2 x RS-485, 1 x RS-232 ��� 1 x RS-232</td>
</tr>

<tr class="hed gray narrow">
<td><span  >'.stock_controllers($modul.'S').'</span></td>
<td><span  >'.stock_controllers($modul).'</span></td>
<td><span  >'.stock_controllers($modul.'D').'</span></td>
<td><span  >'.stock_controllers($modul.'S-T').'</span></td>
<td><span  >'.stock_controllers($modul.'-T').'</span></td>
<td><span  >'.stock_controllers($modul.'D-T').'</span></td>
</tr>
<tr class="gray">
<td>'.price($modul.'S').'</td>
<td>'.price($modul).'</td>
<td>'.price($modul.'D').'</td>
<td>'.price($modul.'S-T').'</td>
<td>'.price($modul.'-T').'</td>
<td>'.price($modul.'D-T').'</td>
</tr>
<td idm="'.$modul.'S" '.v_korzinu($modul.'S').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'" '.v_korzinu($modul).'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'D" '.v_korzinu($modul.'D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'S-T" '.v_korzinu($modul.'S-T').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'-T" '.v_korzinu($modul.'-T').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'D-T" '.v_korzinu($modul.'D-T').'><img src="/images/into-cart.png"></td>
</tr>';
};


if ((preg_match('/A-218/i', $r->model))) {
$table_body .='
<tr class="hed gray" style="  border-bottom: 1px solid gray;">
<td><a href="/plc/yottacontrol/'.$modul.'8-D.php"><span  class="model_name">'.$modul.'8-D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'8D-D.php"><span  class="model_name">'.$modul.'8D-D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'8-A.php"><span  class="model_name">'.$modul.'8-A</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'8D-A.php"><span  class="model_name">'.$modul.'8D-A</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'9-D.php"><span  class="model_name">'.$modul.'9-D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'9D-D.php"><span  class="model_name">'.$modul.'9D-D</span></a></td>
</tr>

<tr class="">
<td><a href="/plc/yottacontrol/'.$modul.'8-D.php"><img src="'.img($modul.'8-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-218" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'8D-D.php"><img src="'.img($modul.'8D-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-218" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'8-A.php"><img src="'.img($modul.'8-A',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-218" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'8D-A.php"><img src="'.img($modul.'8D-A',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-218" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'9-D.php"><img src="'.img($modul.'9-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-218" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'9D-D.php"><img src="'.img($modul.'9D-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-218" style="width:100px;"></a></td>
</tr>
<tr class="">
<td colspan="4">���������� �����: 8DI (�������������)</td>
<td colspan="2">���������� �����: 4DI (�������������)</td>
</tr>
<tr class="">
<td colspan="4">-</td>
<td colspan="2">���������� �����: 4(10-���)</td>
</tr>
<tr class="">
<td colspan="6">���������� ������: 4DO (����)</td>
</tr>
<tr class="">
<td>-</td>
<td>������� 2&#8243;</td>
<td>-</td>
<td>������� 2&#8243;</td>
<td>-</td>
<td>������� 2&#8243;</td>
</tr>
<tr class="">
<td colspan="6">COM-�����: 1 x RS-485</td>
</tr>
<tr class="">
<td colspan="2">10~30 VDC</td>
<td colspan="2">10/240 VAC</td>
<td colspan="2">10~30 VDC</td>
</tr>
<tr class="hed gray narrow">
<td><span  >'.stock_controllers($modul.'8-D').'</span></td>
<td><span  >'.stock_controllers($modul.'8D-D').'</span></td>
<td><span  >'.stock_controllers($modul.'8-A').'</span></td>
<td><span  >'.stock_controllers($modul.'8D-A').'</span></td>
<td><span  >'.stock_controllers($modul.'9-D').'</span></td>
<td><span  >'.stock_controllers($modul.'9D-D').'</span></td>
</tr>
<tr class="gray">
<td>'.price($modul.'8-D').'</td>
<td>'.price($modul.'8D-D').'</td>
<td>'.price($modul.'8-A').'</td>
<td>'.price($modul.'8D-A').'</td>
<td>'.price($modul.'9-D').'</td>
<td>'.price($modul.'9D-D').'</td>
</tr>
<td idm="'.$modul.'8-D" '.v_korzinu($modul.'8-D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'8D-D" '.v_korzinu($modul.'8D-D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'8-A" '.v_korzinu($modul.'8-A').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'8D-A" '.v_korzinu($modul.'8D-A').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'9-D" '.v_korzinu($modul.'9-D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'9D-D" '.v_korzinu($modul.'9D-D').'><img src="/images/into-cart.png"></td>
</tr>';
};

if ((preg_match('/A-5188/i', $r->model)) OR (preg_match('/A-5189/i', $r->model))) {
	
	if ($r->model == 'A-5188x') {
	$inputs = '<tr class=""><td colspan="6">���������� �����: 8DI (������: <5VDC, �������: >8.5VDC)</td></tr>';	
		
		
	} else {
			$inputs =  '<tr class=""><td colspan="6">���������� �����: 4DI (������: <5VDC, �������: >8.5VDC)</td></tr>
						<tr class=""><td colspan="6">���������� �����: 4AI (0~10VDC)</td></tr>';
		
	};	
	
$table_body .='
<tr class="hed gray" style="  border-bottom: 1px solid gray;">
<td><a href="/plc/yottacontrol/'.$modul.'.php"><span  class="model_name">'.$modul.'</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D.php"><span  class="model_name">'.$modul.'D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'M.php"><span  class="model_name">'.$modul.'M</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'-T.php"><span  class="model_name">'.$modul.'-T</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D-T.php"><span  class="model_name">'.$modul.'D-T</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'M-T.php"><span  class="model_name">'.$modul.'M-T</span></a></td>
</tr>

<tr class="">
<td><a href="/plc/yottacontrol/'.$modul.'.php"><img src="'.img($modul,1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-51" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D.php"><img src="'.img($modul.'D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-51" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'M.php"><img src="'.img($modul.'M',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-51" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'-T.php"><img src="'.img($modul.'-T',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-51" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D-T.php"><img src="'.img($modul.'D-T',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-51" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'M-T.php"><img src="'.img($modul.'M-T',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-51" style="width:100px;"></a></td>
</tr>
'.$inputs.'
<tr class="">
<td colspan="3">���������� ������: 4DO (����)</td>
<td colspan="3">���������� ������: 4DO (����������)</td>
</tr>
<tr class="">
<td>-</td>
<td>������� 2&#8243;</td>
<td>micro-SD</td>
<td>-</td>
<td>������� 2&#8243;</td>
<td>micro-SD</td>
</tr>
<tr class="">
<td colspan="6">COM-�����: 2 x RS-485, 1 x RS-232</td>
</tr>
<tr class="">
<td colspan="6">1 x USB</td>
</tr>
<tr class="hed gray narrow">
<td><span  >'.stock_controllers($modul).'</span></td>
<td><span  >'.stock_controllers($modul.'D').'</span></td>
<td><span  >'.stock_controllers($modul.'M').'</span></td>
<td><span  >'.stock_controllers($modul.'-T').'</span></td>
<td><span  >'.stock_controllers($modul.'D-T').'</span></td>
<td><span  >'.stock_controllers($modul.'M-T').'</span></td>
</tr>
<tr class="gray">
<td>'.price($modul).'</td>
<td>'.price($modul.'D').'</td>
<td>'.price($modul.'M').'</td>
<td>'.price($modul.'-T').'</td>
<td>'.price($modul.'D-T').'</td>
<td>'.price($modul.'M-T').'</td>
</tr>
<td idm="'.$modul.'" '.v_korzinu($modul).'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'D" '.v_korzinu($modul.'D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'M" '.v_korzinu($modul.'M').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'-T" '.v_korzinu($modul.'-T').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'D-T" '.v_korzinu($modul.'D-T').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'M-T" '.v_korzinu($modul.'M-T').'><img src="/images/into-cart.png"></td>
</tr>';
};



if ((preg_match('/A-6188.*?A/i', $r->model))) {
$table_body .='
<tr class="hed gray"  style="border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px; "><span  class="model_name">������</span></td>
<td style="width:250px;"><a href="/plc/yottacontrol/A-6188-A.php"><span  class="model_name">A-6188-A</span></a></td>
<td style="width:250px;"><a href="/plc/yottacontrol/A-6188D-A.php"><span  class="model_name">A-6188D-A</span></a></td>
<td style="width:250px;"><a href="/plc/yottacontrol/A-6188M-A.php"><span  class="model_name">A-6188M-A</span></a></td>
</tr>

<tr class="">
<td></td>
<td><a href="/plc/yottacontrol/A-6188-A.php"><img src="'.img('A-6188-A',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-6188-A" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-6188D-A.php"><img src="'.img('A-6188D-A',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-6188D-A" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-6188M-A.php"><img src="'.img('A-6188M-A',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-6188M-A" style="width:100px;"></a></td>
</tr>
<tr class="">
<td style="text-align: left;  padding-left: 40px;">�����������</td>
<td>-</td>
<td>������� 2&#8243;</td>
<td>micro-SD</td>
</tr>
<tr>
<td style="text-align: left;  padding-left: 40px;">���������� �����</td>
<td colspan="3">8 DI </td>
</tr>

<tr>
<td style="text-align: left;  padding-left: 40px;">���������� ������</td>
<td colspan="3">4 (�������������), ���� </td>
</tr>



<tr style="">
<td style="text-align: left;  padding-left: 40px;">COM-�����</td>
<td colspan="3">1 x RS-485 (Modbus)</td>
</tr>

<tr style="  border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px;">�������</td>
<td colspan="3">'.$r->power_adapter.'</td>
</tr>

<tr class="hed gray narrow">
<td style="text-align: left;  padding-left: 40px;">�������</td>
<td><span  >'.stock_controllers('A-6188-A').'</span></td>
<td><span  >'.stock_controllers('A-6188D-A').'</span></td>
<td><span  >'.stock_controllers('A-6188M-A').'</span></td>
</tr>
<tr class="gray narrow">
<td style="text-align: left;  padding-left: 40px;">����</td>
<td>'.price('A-6188-A').'</td>
<td>'.price('A-6188D-A').'</td>
<td>'.price('A-6188M-A').'</td>
</tr>
<tr class="gray">
<td style="text-align: left;  padding-left: 40px;">�������� � �������</td>
<td idm="A-6188-A" '.v_korzinu('A-6188-A').'><img src="/images/into-cart.png"></td>
<td idm="A-6188D-A" '.v_korzinu('A-6188D-A').'><img src="/images/into-cart.png"></td>
<td idm="A-6188M-A" '.v_korzinu('A-6188M-A').'><img src="/images/into-cart.png"></td>
</tr>';
} else 
if ((preg_match('/A-6188/i', $r->model)) OR (preg_match('/A-6189/i', $r->model))) {

	if ($r->model == 'A-6188x') {
	$inputs = '<tr class=""><td colspan="6">���������� �����: 8DI (������: <5VDC, �������: >8.5VDC)</td></tr>';	
		
		
	} else {
			$inputs =  '<tr class=""><td colspan="6">���������� �����: 4DI (������: <5VDC, �������: >8.5VDC)</td></tr>
						<tr class=""><td colspan="6">���������� �����: 4AI (0~10VDC)</td></tr>';
		
	};
$table_body .='
<tr class="hed gray" style="  border-bottom: 1px solid gray;">
<td><a href="/plc/yottacontrol/'.$modul.'-D.php"><span  class="model_name">'.$modul.'-D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D-D.php"><span  class="model_name">'.$modul.'D-D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'M-D.php"><span  class="model_name">'.$modul.'M-D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'T-D.php"><span  class="model_name">'.$modul.'T-D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'DT-D.php"><span  class="model_name">'.$modul.'DT-D</span></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'MT-D.php"><span  class="model_name">'.$modul.'MT-D</span></a></td>
</tr>

<tr class="">
<td><a href="/plc/yottacontrol/'.$modul.'-D.php"><img src="'.img($modul.'-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-61" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'D-D.php"><img src="'.img($modul.'D-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-61" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'M-D.php"><img src="'.img($modul.'M-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-61" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'T-D.php"><img src="'.img($modul.'T-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-61" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'DT-D.php"><img src="'.img($modul.'DT-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-61" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/'.$modul.'MT-D.php"><img src="'.img($modul.'MT-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� A-61" style="width:100px;"></a></td>
</tr>
'.$inputs.'
<tr class="">
<td colspan="3">���������� ������: 4DO (����)</td>
<td colspan="3">���������� ������: 4DO (����������)</td>
</tr>
<tr class="">
<td>-</td>
<td>������� 2&#8243;</td>
<td>micro-SD</td>
<td>-</td>
<td>������� 2&#8243;</td>
<td>micro-SD</td>
</tr>
<tr class="">
<td colspan="6">COM-�����: 1 x RS-485</td>
</tr>

<tr class="hed gray narrow">
<td><span  >'.stock_controllers($modul.'-D').'</span></td>
<td><span  >'.stock_controllers($modul.'D-D').'</span></td>
<td><span  >'.stock_controllers($modul.'M-D').'</span></td>
<td><span  >'.stock_controllers($modul.'T-D').'</span></td>
<td><span  >'.stock_controllers($modul.'DT-D').'</span></td>
<td><span  >'.stock_controllers($modul.'MT-D').'</span></td>
</tr>
<tr class="gray">
<td>'.price($modul.'-D').'</td>
<td>'.price($modul.'D-D').'</td>
<td>'.price($modul.'M-D').'</td>
<td>'.price($modul.'T-D').'</td>
<td>'.price($modul.'DT-D').'</td>
<td>'.price($modul.'MT-D').'</td>
</tr>
<td idm="'.$modul.'-D" '.v_korzinu($modul.'-D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'D-D" '.v_korzinu($modul.'D-D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'M-D" '.v_korzinu($modul.'M-D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'T-D" '.v_korzinu($modul.'T-D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'DT-D" '.v_korzinu($modul.'DT-D').'><img src="/images/into-cart.png"></td>
<td idm="'.$modul.'MT-D" '.v_korzinu($modul.'MT-D').'><img src="/images/into-cart.png"></td>
</tr>';
};



if ((preg_match('/A-52/i', $r->model))) {
$table_body .='
<tr class="hed gray" style="  border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px; "><span  class="model_name">������</span></td>
<td><a href="/plc/yottacontrol/A-5288D.php"><span  class="model_name">A-5288D</span></a></td>
<td><a href="/plc/yottacontrol/A-5288D-T.php"><span  class="model_name">A-5288D-T</span></a></td>
<td><a href="/plc/yottacontrol/A-5289D.php"><span  class="model_name">A-5289D</span></a></td>
<td><a href="/plc/yottacontrol/A-5288D-T.php"><span  class="model_name">A-5289D-T</span></a></td>
<td><a href="/plc/yottacontrol/A-5290D.php"><span  class="model_name">A-5290D</span></a></td>
</tr>

<tr class="">
<td></td>
<td><a href="/plc/yottacontrol/A-5288D.php"><img src="'.img('A-5288D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.' ������ A-5288D" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-5288D-T.php"><img src="'.img('A-5288D-T',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-5289D.php"><img src="'.img('A-5289D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-5288D-T.php"><img src="'.img('A-5288D-T',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-5290D.php"><img src="'.img('A-5290D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.' ������ A-5290D" style="width:100px;"></a></td>
</tr>

<tr class="">
<td style="text-align: left;  padding-left: 40px;">�������</td>
<td  colspan="5">2&#8243;</td>
</tr>

<tr class="">
<td style="text-align: left;  padding-left: 40px;">���������� �����</td>
<td colspan="2"> 8DI </td>
<td colspan="2"> 4DI </td>
<td colspan="1"> 2DI </td>
</tr>

<tr class="">
<td style="text-align: left;  padding-left: 40px;">���������� �����</td>
<td colspan="2"> � </td>
<td colspan="2"> 4AI </td>
<td colspan="1"> 4AI (������) </td>
</tr>

<tr class="">
<td style="text-align: left;  padding-left: 40px;">���������� ������</td>
<td> 4DO (����)</td>
<td> 4DO (����������)</td>
<td> 4DO (����)</td>
<td> 4DO (����������)</td>
<td> 2DO (PNP)</td>
</tr>

<tr class="">
<td style="text-align: left;  padding-left: 40px;">���������� ������</td>
<td colspan="4"> � </td>
<td> 2AO </td>
</tr>



<tr class="">
<td style="text-align: left;  padding-left: 40px;">COM-�����</td>
<td colspan="4">2 x RS-485, 1 x RS-232</td>
<td colspan="1">1 x RS-485</td>
</tr>

<tr class="">
<td style="text-align: left;  padding-left: 40px;">USB</td>
<td colspan="5">1 x USB2.0</td>
</tr>

<tr class="">
<td style="text-align: left;  padding-left: 40px;">Wi-Fi</td>
<td colspan="5">1 x Wi-Fi (�� 7 �����������, 2.4GHz IEEE 802.11 b/g)</td>
</tr>


<tr class="hed gray narrow">
<td style="text-align: left;  padding-left: 40px;">�������</td>
<td><span  >'.stock_controllers('A-5288D').'</span></td>
<td><span  >'.stock_controllers('A-5288D-T').'</span></td>
<td><span  >'.stock_controllers('A-5289D').'</span></td>
<td><span  >'.stock_controllers('A-5288D-T').'</span></td>
<td><span  >'.stock_controllers('A-5290D').'</span></td>
</tr>
<tr class="gray">
<td style="text-align: left;  padding-left: 40px;">����</td>
<td>'.price('A-5288D').'</td>
<td>'.price('A-5288D-T').'</td>
<td>'.price('A-5289D').'</td>
<td>'.price('A-5289D-T').'</td>
<td>'.price('A-5290D').'</td>
</tr>
<tr class="gray">
<td style="text-align: left;  padding-left: 40px;">�������� � �������</td>
<td idm="A-5288D" '.v_korzinu('A-5288D').'><img src="/images/into-cart.png"></td>
<td idm="A-5288D-T" '.v_korzinu('A-5288D-T').'><img src="/images/into-cart.png"></td>
<td idm="A-5289D" '.v_korzinu('A-5289D').'><img src="/images/into-cart.png"></td>
<td idm="A-5288D-T" '.v_korzinu('A-5288D-T').'><img src="/images/into-cart.png"></td>
<td idm="A-5290D" '.v_korzinu('A-5290D').'><img src="/images/into-cart.png"></td>
</tr>';
};


if ((preg_match('/A-10x/i', $r->model))) {
$table_body .='
<tr class="hed gray" style="  border-bottom: 1px solid gray;">
<td><a href="/plc/yottacontrol/A-1057.php"><span  class="model_name">A-1057</span></a></td>
<td><a href="/plc/yottacontrol/A-1058.php"><span  class="model_name">A-1058</span></a></td>
<td><a href="/plc/yottacontrol/A-1068.php"><span  class="model_name">A-1068</span></a></td>
<td><a href="/plc/yottacontrol/A-1069.php"><span  class="model_name">A-1069</span></a></td>
<td><a href="/plc/yottacontrol/A-1051.php"><span  class="model_name">A-1051</span></a></td>
<td><a href="/plc/yottacontrol/A-1055.php"><span  class="model_name">A-1055</span></a></td>
<td><a href="/plc/yottacontrol/A-1055S.php"><span  class="model_name">A-1055S</span></a></td>
<td><a href="/plc/yottacontrol/A-1060.php"><span  class="model_name">A-1060</span></a></td>
</tr>

<tr class="">
<td><a href="/plc/yottacontrol/A-1057.php"><img src="'.img('A-1057',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1058.php"><img src="'.img('A-1058',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1068.php"><img src="'.img('A-1068',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1069.php"><img src="'.img('A-1069',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1051.php"><img src="'.img('A-1051',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1055.php"><img src="'.img('A-1055',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1055S.php"><img src="'.img('A-1055S',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1060.php"><img src="'.img('A-1060',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' ����� '.$modul.'" style="width:100px;"></a></td>
</tr>
<tr class="">
<td colspan="8" style="padding: 0px;
  background: whitesmoke;">���������� �����</td>
</tr>
<tr class="">
<td colspan="4">-</td>
<td>16 DI<br />�������������</td>
<td colspan="3">8 DI<br />�������������</td>
</tr>
<tr class="">
<td colspan="8" style="padding: 0px;
  background: whitesmoke;">���������� ������</td>
</tr>
<tr class="" style="  border-bottom: 1px solid gray;">
<td>12 DO<br />(PNP ����������)</td>
<td>12 DO<br />(NPN ����������)</td>
<td>8 DO<br />(���������� ����)</td>
<td>8 DO<br />(������� ����)</td>
<td>-</td>
<td>8 DO<br />(NPN ����������)</td>
<td>8 DO<br />(PNP ����������)</td>
<td>4 DO<br />(������� ����)</td>
</tr>
<tr class="">
<td colspan="8" style="padding: 0px;
  background: whitesmoke;">COM-�����</td>
</tr>
<tr class="">
<td colspan="8">1 x RS-485</td>
</tr>

<tr class="hed gray narrow">
<td><span  >'.stock_controllers('A-1057').'</span></td>
<td><span  >'.stock_controllers('A-1058').'</span></td>
<td><span  >'.stock_controllers('A-1068').'</span></td>
<td><span  >'.stock_controllers('A-1069').'</span></td>
<td><span  >'.stock_controllers('A-1051').'</span></td>
<td><span  >'.stock_controllers('A-1055').'</span></td>
<td><span  >'.stock_controllers('A-1055S').'</span></td>
<td><span  >'.stock_controllers('A-1060').'</span></td>
</tr>
<tr class="gray narrow">
<td>'.price('A-1057').'</td>
<td>'.price('A-1058').'</td>
<td>'.price('A-1068').'</td>
<td>'.price('A-1069').'</td>
<td>'.price('A-1051').'</td>
<td>'.price('A-1055').'</td>
<td>'.price('A-1055S').'</td>
<td>'.price('A-1060').'</td>
</tr>
<td idm="A-1057" '.v_korzinu('A-1057').'><img src="/images/into-cart.png"></td>
<td idm="A-1058" '.v_korzinu('A-1058').'><img src="/images/into-cart.png"></td>
<td idm="A-1068" '.v_korzinu('A-1068').'><img src="/images/into-cart.png"></td>
<td idm="A-1069" '.v_korzinu('A-1069').'><img src="/images/into-cart.png"></td>
<td idm="A-1051" '.v_korzinu('A-1051').'><img src="/images/into-cart.png"></td>
<td idm="A-1055" '.v_korzinu('A-1055').'><img src="/images/into-cart.png"></td>
<td idm="A-1055S" '.v_korzinu('A-1055S').'><img src="/images/into-cart.png"></td>
<td idm="A-1060" '.v_korzinu('A-1060').'><img src="/images/into-cart.png"></td>
</tr>';
};

if ((preg_match('/A-101/i', $r->model))) {
$table_body .='
<tr class="hed gray"  style="border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px; "><span  class="model_name">������</span></td>
<td style="width:385px;"><a href="/plc/yottacontrol/A-1010.php"><span  class="model_name">A-1010</span></a></td>
<td style="width:385px;"><a href="/plc/yottacontrol/A-1012.php"><span  class="model_name">A-1012</span></a></td>
</tr>

<tr class="">
<td></td>
<td><a href="/plc/yottacontrol/A-1010.php"><img src="'.img('A-1010',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-1010" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1012.php"><img src="'.img('A-1012',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-1012" style="width:100px;"></a></td>

</tr>

<tr>
<td style="text-align: left;  padding-left: 40px;">���������� �����</td>
<td>-</td>
<td>2 DI, ������������� </td>
</tr>

<tr>
<td style="text-align: left;  padding-left: 40px;">���������� ������</td>
<td>4 NPN</td>
<td>2 PNP </td>
</tr>

<tr>
<td style="text-align: left;  padding-left: 40px;">���������� �����</td>
<td>8 (0~10VDC)</td>
<td>4 ������� (V,I,J,K,PT-100...) </td>
</tr>

<tr class="" >
<td style="text-align: left;  padding-left: 40px;">���������� ������</td>
<td>2 (0~10VDC)</td>
<td>2 (0~20mA/4~20mA)</td>
</tr>

<tr style="  border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px;">COM-�����</td>
<td colspan="2">1 x RS-485 (Modbus)</td>
</tr>

<tr class="hed gray narrow">
<td style="text-align: left;  padding-left: 40px;">�������</td>
<td><span  >'.stock_controllers('A-1010').'</span></td>
<td><span  >'.stock_controllers('A-1012').'</span></td>
</tr>
<tr class="gray narrow">
<td style="text-align: left;  padding-left: 40px;">����</td>
<td>'.price('A-1010').'</td>
<td>'.price('A-1012').'</td>
</tr>
<tr class="gray">
<td style="text-align: left;  padding-left: 40px;">�������� � �������</td>
<td idm="A-1010" '.v_korzinu('A-1010').'><img src="/images/into-cart.png"></td>
<td idm="A-1012" '.v_korzinu('A-1012').'><img src="/images/into-cart.png"></td>

</tr>';
};

if ((preg_match('/A-18/i', $r->model))) {
$table_body .='
<tr class="hed gray"  style="border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px; "><span  class="model_name">������</span></td>
<td style="width:385px;"><a href="/plc/yottacontrol/A-1851.php"><span  class="model_name">A-1851</span></a></td>
<td style="width:385px;"><a href="/plc/yottacontrol/A-1860.php"><span  class="model_name">A-1860</span></a></td>
</tr>

<tr class="">
<td></td>
<td><a href="/plc/yottacontrol/A-1851.php"><img src="'.img('A-1851',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-1851" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-1860.php"><img src="'.img('A-1860',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-1860" style="width:100px;"></a></td>

</tr>

<tr>
<td style="text-align: left;  padding-left: 40px;">���������� �����</td>
<td>16 DI, ������������� </td>
<td>8 DI, ������������� </td>
</tr>

<tr>
<td style="text-align: left;  padding-left: 40px;">���������� ������</td>
<td>-</td>
<td>2 (������� ����)</td>
</tr>


<tr style="  border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px;">USB</td>
<td colspan="2">1 x USB2.0</td>
</tr>

<tr style="  border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px;">LAN</td>
<td colspan="2">1 x 10/100 Ethernet</td>
</tr>

<tr class="hed gray narrow">
<td style="text-align: left;  padding-left: 40px;">�������</td>
<td><span  >'.stock_controllers('A-1851').'</span></td>
<td><span  >'.stock_controllers('A-1860').'</span></td>
</tr>
<tr class="gray narrow">
<td style="text-align: left;  padding-left: 40px;">����</td>
<td>'.price('A-1851').'</td>
<td>'.price('A-1860').'</td>
</tr>
<tr class="gray">
<td style="text-align: left;  padding-left: 40px;">�������� � �������</td>
<td idm="A-1851" '.v_korzinu('A-1851').'><img src="/images/into-cart.png"></td>
<td idm="A-1860" '.v_korzinu('A-1860').'><img src="/images/into-cart.png"></td>

</tr>';
};

if ((preg_match('/A-2060/i', $r->model))) {
$table_body .='
<tr class="hed gray"  style="border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px; "><span  class="model_name">������</span></td>
<td style="width:385px;"><a href="/plc/yottacontrol/A-2060-D.php"><span  class="model_name">A-2060-D</span></a></td>
<td style="width:385px;"><a href="/plc/yottacontrol/A-2060-A.php"><span  class="model_name">A-2060-A</span></a></td>
</tr>

<tr class="">
<td></td>
<td><a href="/plc/yottacontrol/A-2060-D.php"><img src="'.img('A-2060-D',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-2060-D" style="width:100px;"></a></td>
<td><a href="/plc/yottacontrol/A-2060-A.php"><img src="'.img('A-2060-A',1).'" alt="'.ucfirst(strtolower($type)).' '.$brand.' A-2060-A" style="width:100px;"></a></td>

</tr>

<tr>
<td style="text-align: left;  padding-left: 40px;">���������� �����</td>
<td colspan="2">8 DI, ������������� </td>
</tr>

<tr>
<td style="text-align: left;  padding-left: 40px;">���������� ������</td>
<td colspan="2">4 (����), �������������</td>
</tr>


<tr style="  border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px;">COM-�����</td>
<td colspan="2">1 x RS-485 (Modbus)</td>
</tr>

<tr style="  border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px;">USB</td>
<td colspan="2">1 x USB</td>
</tr>

<tr style="  border-bottom: 1px solid gray;">
<td style="text-align: left;  padding-left: 40px;">�������/td>
<td>10~30 VDC</td>
<td>100/240 VAC</td>
</tr>

<tr class="hed gray narrow">
<td style="text-align: left;  padding-left: 40px;">�������</td>
<td><span  >'.stock_controllers('A-2060-A').'</span></td>
<td><span  >'.stock_controllers('A-2060-D').'</span></td>
</tr>
<tr class="gray narrow">
<td style="text-align: left;  padding-left: 40px;">����</td>
<td>'.price('A-1010').'</td>
<td>'.price('A-1012').'</td>
</tr>
<tr class="gray">
<td style="text-align: left;  padding-left: 40px;">�������� � �������</td>
<td idm="A-2060-A"  '.v_korzinu('A-2060-A').'><img src="/images/into-cart.png"></td>
<td idm="A-2060-D"  '.v_korzinu('A-2060-D').'><img src="/images/into-cart.png"></td>

</tr>';
};



if (!empty($table_body)) {
$prices_out .=  "<br><span class=big_pan_name><b>��������� �����������:</b></span> <br><br>";
$prices_out .='<table id="modifs" class="" cellpadding="0" cellspacing="0" border="1" bordercolor="#cccccc" width="1000">
<tbody>'.$table_body.'</tbody></table>';
};


$prices_out .='<style>
#modifs td {text-align:center;padding: 6px;   font-family: Verdana, "Lucida Grande";  height: 20px;
  font-size: 11px;}
  
#modifs tr:last-child td {height: 11px;}
  
#modifs td .zakazbut2 { 
  margin-bottom: 0px;} 
  
#modifs td > div  {
  width: 135px;
   }
#modifs td .prpr, #modifs td .val_name {  font-size: 12px;}  
#modifs td  .prpr {}
.model_name {   display: inline-block; width: 100px; line-height: 25px;  font-weight: bold;  font-size: 12px;}

.zakazbut.inline {  padding: 0px;
  border: none;
  background: none;  box-shadow: none;}
  
.zakazbut3 {
  -moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
  -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;

  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9) );
  background: -moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#f9f9f9", endColorstr="#e9e9e9");
  background-color: #f9f9f9;
  color: #666666;
  font-family: arial;
  font-size: 10px;
  text-decoration: none;
  text-shadow: 1px 1px 0px #ffffff;

 
  text-align: center;
    font-weight: bold;
  box-shadow: inset 0px 0px 2px gray;
  border: none;

}  

.zakazbut3.yes {
 cursor: pointer;
	
}

.zakazbut3.yes:hover {
  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9) );
  background: -moz-linear-gradient( center top, #e9e9e9 5%, #f9f9f9 100% );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#e9e9e9", endColorstr="#f9f9f9");
  background-color: #e9e9e9;
    box-shadow: inset 1px 1px 2px gray;
}
.zakazbut3 img
{  opacity: 0.2;  margin-bottom: 1px;
  height: 17px;}
  .zakazbut3.yes img {opacity: 0.5}
.zakazbut3.yes:hover img {opacity: 0.8;     margin-bottom: 0px; margin-top: 1px;}  
#modifs tr.narrow td {padding:0px;}
.stocks {  color: rgb(90, 126, 179);}
  </style><br />
';


//----------------------------------------end pics ----------------------------


 $bg1="style='background: #fefefe';";
 $bg2="style='background: #f5f5f5';"; 
 $table_start="<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";
 
$us_tr_l = '<tr><td class=par_name1 >';
 $us_tr_l1 = '</td><td class=par_val1 >';
//----------------------------tab1 -----------------------------------------
 




 $sp_data1 .= $table_start;

if ((preg_match('/A-518/i',$r->model)) OR (preg_match('/A-618/i',$r->model))) {
  $sp_data1 .= 

  '<tr><td class=par_val1>�������� ����������� �������� � �������������� �����: ��������� (FBD) ��� �������� ��������� (LAD)</td></tr>'. 
  '<tr><td class=par_val1>4-������ ���������� �������� 50 ��� ��� (����� 400 ���)</td></tr>';
};

  if (($r->model == 'A-52x')) {
  $sp_data1 .= 

  '<tr><td class=par_val1>�������� ����������� �������� � �������������� �����: ��������� (FBD) ��� �������� ��������� (LAD)</td></tr>'. //all
  '<tr><td class=par_val1>4-������ ���������� �������� 100 ��� ��� (����� 400 ���)</td></tr>';

  };
  
   if (($r->brand == 'Yottacontrol') AND ($r->type == 'controller') AND ((preg_match('/A-6/i',$r->model)) OR (preg_match('/A-5/i',$r->model)))) {
   $sp_data1 .= 
 '<tr><td class=par_val1>�������� ��������� ����������� ��������� ��������������� �� ����� ������ �����������</td></tr>'.
 '<tr><td class=par_val1>Multi AUTO-PI (���������������-������������) ���������� ������� </td></tr>'.
 '<tr><td class=par_val1>������������ ���� </td></tr>'.
 '<tr><td class=par_val1>����������� ��������� ��������� ������ � ������������</td></tr>'.	
 '<tr><td class=par_val1>��������� ������� ����� ���� �������������� �������� � ����� �������</td></tr>'.
 '<tr><td class=par_val1>���������� ����������� ��������������� ������� (250 ��� �� ����, ����� 1000 ���)</td></tr>'. 
 '<tr><td class=par_val1>������ ����� ������ �� ����������� � ��������� ������ </td></tr>'. 
 '<tr><td class=par_val1>���������������� ����������� ����������� � ��������������</td></tr>'. 
 '<tr><td class=par_val1>���������� ������� �������� ��������� (��������� ���������������� �����������)</td></tr>'. 
 '<tr><td class=par_val1>������� ����������� (�� ������� micro-SD)</td></tr>'. 
 '<tr><td class=par_val1>������������� �������, ��������� �������, ��������� ������, ����������� ����, ����������</td></tr>'. 
 '<tr><td class=par_val1>104 FBD ��������������� �������, 97 LD ���������� �������</td></tr>'.  
 '<tr><td class=par_val1>������� ��������������� �����</td></tr>'. 
 '<tr><td class=par_val1>������� ��������� ������������ � �������� ������� </td></tr>'. 
 '<tr><td class=par_val1>������� ������ ����������</td></tr>'. 
 '<tr><td class=par_val1>���������� ���� ������, ����������� � ���������</td></tr>'. 
 '<tr><td class=par_val1>���������������� ������� ���������� (��� ����������� �������)</td></tr>'. 
 '<tr><td class=par_val1>������������� ������� ���������������� ����������</td></tr>'. 
 '<tr><td class=par_val1>������� ������ ���������� ���������</td></tr>'. 
 '<tr><td class=par_val1>��������� ��������� �����</td></tr>';
};

  if (($r->model == 'A-52x')) {
    $sp_data1 .= 
  '<tr><td class=par_val1>��������������� ���������� A-3288 � ���������� �������� ��������� ���������, ������������ �������������� ��������� ����������� � ����������������� ��������� ����������, ������� ��������</td></tr>'.
  '<tr><td class=par_val1>����������� � ����� ������� Wi-Fi, ����� ��������� ������� Station � Ad-hoc; WPA2-PSK(AES); ����� ����������� Internet Of Things (IOT), ��������� ����������</td></tr>'.
  '<tr><td class=par_val1>����������� ��������� Wi-Fi ��� 3-� ��������� ����� / ������� ���������������� ������  Modbus</td></tr>'.
  '<tr><td class=par_val1>������������ �������� ��������</td></tr>'.
  '<tr><td class=par_val1>����������� ������� ����� �������������</td></tr>'.
  '<tr><td class=par_val1>���������� ����������� Microsoft IE � Google Chrome</td></tr>'.
  '<tr><td class=par_val1>����������� ������������� ��� ���������� � ��� ������ ( Master / Slave )</td></tr>';
  
  };
  
if  ((preg_match('/A-2/i',$r->model)) OR (preg_match('/A-118/i',$r->model))) {
if (preg_match('/A-2/i',$r->model)) {
	
$points = '4000';	
} else {
$points = '10000';	
	
};
$sp_data1 .= 
'<tr><td class=par_val1>FBD � LD �������</td></tr>'.
'<tr><td class=par_val1>����� ���������� �� ������� (108x64)</td></tr>'. 
'<tr><td class=par_val1>��������� ������ </td></tr>'. 
'<tr><td class=par_val1>36 ���������� �������, ������� ���������������� ������������</td></tr>'. 
'<tr><td class=par_val1>�������� ����� �� 1024 �������������� ������</td></tr>'. 
'<tr><td class=par_val1>����������� </td></tr>'. 
'<tr><td class=par_val1>������ ��������� Modbus-���������</td></tr>'. 
'<tr><td class=par_val1>������������� �� '.$points.' �����</td></tr>';

};  

if  (($r->brand == 'Yottacontrol') AND (($r->series == 'A-10x') OR ($r->series == 'A-18x'))) {

$sp_data1 .= 
'<tr><td class=par_val1>�������� �� ����� ������������� � ���������� Modbus</td></tr>'.
'<tr><td class=par_val1>��������� ������ </td></tr>'. 
'<tr><td class=par_val1>������� ���������� ������ </td></tr>'. 
'<tr><td class=par_val1>��������� ����������� ���������� ������� </td></tr>';

};

 $sp_data1 .='</table><br><br>';






 


//---------------------end tab1 -------------------------



$prices_out .= '<br><br> 
<div style="width:1100px; min-height: 500px; overflow: auto; ">
<div id="tabs">
  <ul>
    <li class="urlup" data="functions"><a href="#tabs-1">�������</a></li>';
	
 if   (($r->brand == 'Yottacontrol') AND ($r->type == 'controller')) {
$prices_out .= '<li class="urlup" data="accessories"><a href="#tabs-2">�������������</a></li>';	
 };
 $prices_out .= '<li class="urlup" data="software"><a href="#tabs-3">����������� �����������</a></li>';	
$prices_out .=  '</ul> 
  <div id="tabs-1"><br />
  <h2>�������������� ����������� '.$types1.' '.$r->model.'</h2><br />
    <div style="width:90%">'.$sp_data1.'</div>
  </div>';

 // $mainname = $_SERVER['REQUEST_URI'];
  
 if (!empty($_GET[tab])) { 
 if ($_GET[tab] == 'accessories') {$uuu = '$(\'a[href="#tabs-2"]\').click();';}
 else if ($_GET[tab] == 'functions') {$uuu = '$(\'a[href="#tabs-1"]\').click();';}
  else if ($_GET[tab] == 'software') {$uuu = '$(\'a[href="#tabs-3"]\').click();';};
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


</script>";

	
	
  //---------------------download section -------------------------------- ------------------------------

  

 

$accessories = '
<div style="display:inline-block;margin-bottom:20px;  width: 100%;">
<h3>AMB128 � ���������� ���� ������ </h3>

<img src="/images/controllers/'.strtolower($r->brand).'/A-controller-memory-card-AMB28.png" style="float:left;">

  <table id="" style="float:right;  width: 225px;  margin-top: 40px;">
  <tr>
<td style=""><br />�������� ��� PC</td>

  </tr>
    <tr>
<td style="font-weight: normal;">Windows 98 / ME / 2000 / XP / Vista / 7 / 8 /
Server 2008 / WinCE / Linux / MacDC </td>
  </tr>
    <tr>
<td><br />��������</td>   
  </tr>
    <tr>
<td style="font-weight: normal;">25.7*39.7*16.8 ��</td>   
  </tr>
  <tr>
<td><br />������� �����������</td> 
  </tr>
  <tr>
<td style="font-weight: normal;">�� -10 �� +55 �C</td> 
  </tr>
  <tr>
<td><br />������� ������</td> 
  </tr>
  <tr>
<td style="font-weight: normal;">IP20</td> 
  </tr>

  </table>

<img src="/images/controllers/'.strtolower($r->brand).'/dim/A-controller-memory-card-AMB28.png" style=" width: 360px;  margin: auto;
  margin-top: 40px;
">
<p><br /><br />���������� ���������� � PC (����� USB-����������) � PLC</p>
</div>
';

  
$komplects ='';
	if   (($r->brand == 'Yottacontrol') AND ($r->type == 'controller')) {
$komplects = '<div id="tabs-2"><br />
  <div class=connectors>
  <h2>������������� ������������ '.$r->model.'</h2><br />'.$accessories.'
  </div></div>';
};  
  
  
  
  
$prices_out .= $komplects;


$prices_out .= '<div id="tabs-3"><br />
  <div class=connectors>
  <h2>���������� ����������� ����������� '.$r->model.'</h2><br /></div>
  '.softwares($r->software,$r->model,'1').'<br /><br />
  </div>';

$prices_out .= "</div><br><br><br>";
//-----------------end content

$DESCRIPTION = $description;
$KEYWORDS = $keywords;
$TITLE = $title;

$out .=$prices_out;
} else {
	
header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
header('Location: http://'.$_SERVER['HTTP_HOST'].'/404.php');
	
};
?>