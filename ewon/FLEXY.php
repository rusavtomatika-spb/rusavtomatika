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


$title = 'EWON Flexy, ������������ VPN-������  � ��������� ������ � ������������';
$keywords = '������������, VPN, ������, eWON, Flexy, vpn-������, ��������, ����������, ���������, ������, ������������';
$description = '������������ VPN-������ eWON Flexy - ���������� ����������� � ������������ ����� ��������. ������-���������� ��� ����������� ����������� 3G, HSUPA, Wi-Fi, Ethernet WAN, RS232/485/422 - ��������, �������� � ����������������.';
$vars = show_pc_variants($num);

$nav = '<br /><nav><a href="/">�������</a>&nbsp;/&nbsp;<a href="/ewon/">eWON VPN-������� � VPN-�������</a>&nbsp;/&nbsp;������������ VPN-������ ' . $r->model . '</nav>';
/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;��� ����� 4 ���.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;���� �� �������: ���, ���, ����</div>";
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
<table><tr><td width=840 align=left bfcolor=#cccccc><div class=big_pan_name><h1><b>EWON FLEXY</b>, ������������ VPN-ROUTER</h1></div></td><td width=120>
 <div class=pan_price_big title='��������� ����'> ���� � ��� </div></td><td width=60 class=prpr title='������� ��� ��������� � ���' >$r->retail_price</td><td class=val_name title='������� ��� ��������� � ���'> EUR </td></tr></table>
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
<tr><td valign=center>$im </td><td valign=middle $he>������� ����������� � LAN  �� �������</td></tr>
<tr><td width=30>$im </td><td $he>C���������� ����� 443 (HTTPS) � 1194 (UDP)</td></tr>
<tr><td>$im </td><td $he>����������� ��������� VPN ������ ������� ������������ </td></tr>
<tr><td>$im </td><td $he>������� 24 VDC </td></tr>
<tr><td>$im </td><td $he>��������� �� DIN �����</td></tr>
<tr><td>$im </td><td $he>�������� ����������</td></tr>


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
<strong>eWON Flexy</strong> - ��� ������ ������������ ��������� <strong>M2M ������</strong>, ���������������� ��� ������� ����������� ���������
�������� ������������� � �������� ����������� ����������� VPN ������.<br /><br />
������-���������� ��������� ��� ������ ������ ����������� ����������� �������������� ����������, �������� ������ � ����� ����������������� �������, Ethernet WAN, 3G + HSUPA � Wi-Fi �������.
� ������� <strong>eWON Flexy</strong> ������������� ������������ � ��������� ����������� ����� �������� ��������� �������
� ����������� ������������ ������������, ���������� ��������� ������������  ( ������������ ��� �� Ethernet, ��� � �� COM, ���� MPI ),  ������������ �������
��������� � ��� �������, ������������� ����������� � IP-�����. <br>��� ��� ����� ������ ��� ��������� �������, ��� �����������
������� ������� �� ������������ �������.<br /><br />

<strong>eWON Flexy</strong> ��������� ��������� � <strong>Talk2M</strong>, �������� �������� eWON ( ���������� ). <strong>Talk2M</strong> ������������ ���������� VPN ���������� ����� �������������
� ��������� ��������. ��� ���� ������� �� ����� ���������� IP. eWON Flexy � Talk2M ������������ ������� ������ ������� � ������������, ������������� � ����, ���, ���
������������ �� ����� �������� �������� � ������� IT.<br /><br />

<strong>VPN ������</strong> ������ ������������ � ��������� ���� �� �������, ��� ���� �� ��������� ������������� ������������� �������������� ����.
������ ���������� ����������� ����� 443 (HTTPS) � 1194 (UDP).<br /><br />
</div>






";

$out .= "<br><span class=big_pan_name><b>��������� �����������:</b></span> <br><br>" . $vars;

$bg1 = "style='background: #fefefe';";
$bg2 = "style='background: #f5f5f5';";
$table_start = "<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";


//----------------------------tab1 -----------------------------------------


if ($r->ethernet != "" && $r->software != "") {
    $dop = "<tr><td class=par_name1 >��������� ������ � ����������</td><td class=par_val1 >FTP(������, �������, ������ �������), VNC (��������� ������),<br>
   EasyAccess (��������� ������, �������� ������� )</td></tr>
   <tr><td class=par_name1 >Ftp ������ � ������ ����������</td><td class=par_val1 >" . ($r->ftp_access_hmi_mem ? "����" : "-") . "</td></tr>
   <tr><td class=par_name1 >Ftp ������ � SD ����� � ������</td><td class=par_val1 >" . ($r->ftp_access_sd_usb ? "����" : "-") . "</td></tr>
   ";
} else
    $dop = "";

$arch = "������ ����������";
if ($r->usb_host != "")
    $arch .= ", ������";
if ($r->sdcard != "")
    $arch .= ", SD �����";

$modbus = "RTU, ASCII, Master, Slave";
if ($r->ethernet != "")
    $modbus .= ", TCP/IP";

$modbus = "<tr><td class=par_name1 >��������� Modbus</td><td class=par_val1 >$modbus</td></tr>";
if ($r->os != "")
    $modbus = "";

$mpi = "<tr><td class=par_name1 >��������� MPI</td><td class=par_val1 >187,5 K</td></tr>";
if ($r->os != "")
    $mpi = "";

$mount = "";
if ($r->wall_mount != "")
    $mount .= "� �����";
if ($r->vesa75 != "")
    $mount .= ", VESA 75x75";
if ($r->vesa100 != "")
    $mount .= ", VESA 100x100";

$sp_data1 = "
 <div style='width:90%;'>

<br />
 <span class=hpar>���������</span><br>
 $table_start


 <tr><td class=par_name1 >������</td><td class=par_val1 >IP ����������, IP ����������, NAT, ������, ������� �������������, DHCP ������ </td></tr>
 <tr><td class=par_name1 >��������</td><td class=par_val1 >��������� ���������� �� Talk2M �� HTTPS(���� 443 ��� UDP 1193)</td></tr>
 <tr><td class=par_name1 >VPN �������</td><td class=par_val1 >Open VPN 2.0 ����� SSL UDP ���� HTTPS</td></tr>
 <tr><td class=par_name1 >VPN ������������</td><td class=par_val1 >
 ������ VPN ������ �������� �� ������������� SSL/TLS ��� �������������� ������ � IPSec ESP �������� ��� ����������� ������������� ������� �� UDP. ��� ������������
 X509 PKI ( �������������� ���������� ����� ) ��� �������������� ������, TLS ������� ��� ������ �������, �����-����������� EVP (DES, 3DES, AES, BF ) ���������
 ��� ���������� ������ �������, � HMAC-SHA1 �������� ��� �������������� ������ �������.


 </td></tr>
 <tr><td class=par_name1 >�������������</td><td class=par_val1 >���������� ���� ��������� �������, ������ ��������� �� http,
 ���� �������������� �� NTP</td></tr>
 </table><br><br>

 <span class=hpar>���������� ���������� �����������</span><br>
 $table_start
 <tr><td class=par_name1 >���������� ���������� ���������� Ethernet - Serial </td><td class=par_val1 >
 <table style=\"width: 100%;\">
 <tr><td width=80>MODBUS TCP</td><td><-> MODBUS RTU</td></tr>
 <tr><td>XIP </td><td> <-> UNITELWAY</td></tr>
 <tr><td> Ethernet/IP </td><td> <-> DF1 </td></tr>
 <tr><td>FINS TCP </td><td> <-> FINS Hostlink</td></tr>
 <tr><td>ISO TCP </td><td> <-> PPI,MPI(S7) ��� PROFIBUS (S7)</td></tr>
 <tr><td>VCOM </td><td><-> ASCII </td></tr></table>
 </td></tr>


  </table><br><br>

 <span class=hpar>����������</span><br>
 $table_start
 <tr><td class=par_name1 >���������� ��� ���������</td><td class=par_val1 >���������� ��� ��������� � ��������� �������� ��� ������������ � ������������
 (�� ����� �������������� �� ) ������� �������������� ( �����/������) � �������� ������ ��� ������������. �������� ������� ���������������� �������� �
 � �����������. </td></tr>
<tr><td class=par_name1 >���������� �������</td><td class=par_val1 >FTP ������ � ������ ��� ������������, ���������� �������� � �������� ������</td></tr>
 <tr><td class=par_name1 >������������</td><td class=par_val1 >SNMP V1 � MIB2, ���� �� FTP </td></tr>

 </table><br><br>

 <span class=hpar>�����������</span><br>
 $table_start
 <tr><td class=par_name1 >�������� �������</td><td class=par_val1 >������</td></tr>
 <tr><td class=par_name1 >������ ����������</td><td class=par_val1 >����������������</td></tr>
 <tr><td class=par_name1 >�������� ���������</td><td class=par_val1 >�� ��� ����� EN50022-�����������</td></tr>
 <tr><td class=par_name1 >������ �������</td><td class=par_val1 >2� ���������� � ���������</td></tr>
 <tr><td class=par_name1 >���������� �������</td><td class=par_val1 >12-24 VDC </td></tr>
 <tr><td class=par_name1 >������������ ��������</td><td class=par_val1 >30 ��</td></tr>
 <tr><td class=par_name1 >��������</td><td class=par_val1 >134�89�80 ��</td></tr>
 <tr><td class=par_name1 >���</td><td class=par_val1 >< 500 ��</td></tr>
 <tr><td class=par_name1 >������� �����������</td><td class=par_val1 >-25&deg ~ +70&deg</td></tr>
  <tr><td class=par_name1 >����������� ��������</td><td class=par_val1 >-40&deg ~ +70&deg</td></tr>
    <tr><td class=par_name1 >������������� ���������</td><td class=par_val1 >�� 10 �� 95% (��� �����������)</td></tr>
 ";



$sp_data1 .= "</table></div>";



//---------------------end tab1 -------------------------
//-------------spec ---------------------------
$out .= "<br><br>
<div style='width:1100px; min-height: 500px; overflow: auto; '>
<div id='tabs'>
  <ul>
     <li class='urlup' data='functions'><a href='#tabs-1'>��������������</a></li>
     <li class='urlup' data='dimensions'><a href='#tabs-2'>��������</a></li>

     <li class='urlup' data='software'><a href='#tabs-4'>�������</a></li>
	<li class='urlup' data='accessories'><a href='#tabs-5'>������</a></li>
  </ul>
  <div id='tabs-1'>
     <h2>����������� �������������� $r->model</h2>
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
  <h2>�������� $r->model</h2>
  <div style='position:absolute;margin: 50px 0px 0px 193px;'>���&nbsp;�������</div>
  <div style='position:absolute;margin: 50px 0px 0px 729px;'>���&nbsp;������</div>
  <div style='position:absolute;margin: 410px 0px 0px 193px;'>���&nbsp;�����</div>
  <div style='position:absolute;margin: 410px 0px 0px 729px;'>���&nbsp;�����</div>
  <img src='/images/ewon/dim/FLEXY.png'>
  </div>";
} else {
    $out .= " <div id='tabs-2'>
  �������� 134�89�80 ��
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
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    $soft7 = "
 <tr><td><div class=down_item>���������� �� ��������� �������� ������ Flexy (101/201, 102/202, 103/203) </div></td>
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
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    $soft5 = "
 <tr><td><div class=down_item>������� (datasheet) Flexy (101/201, 102/202, 103/203) </div></td>
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
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    $soft1 = "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLX 3101  </div></td>
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
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    $soft2 = "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLB 3202  </div></td>
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
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    $soft3 = "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLA 3301  </div></td>
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
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    $soft11 = "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLX 3401  </div></td>
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
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    $soft12 = "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLA 3501  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLA3501.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft12 = '';
};



if (file_exists('software/eCatcherSetup.exe')) {


    if ($s > 1) {
        $s .= '&nbsp;��';
    } else {
        $s = $s * 1000;
        $s .= '&nbsp;��';
    };
    $ver = @file_get_contents("software/eCatcher.txt");
    if (!empty($ver)) {
        $ver = '(' . $ver . ')';
    };
    $soft8 = "
 <tr><td><div class=down_item> eCatcher, ����������� ����������� eWON <span style=\"font-weight:normal\">Talk2M connector,
Services Free + and Pro</span> ��� vpn-������� Flexy $ver</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/software/eCatcherSetup.exe' > <img src=/vpn-routers/software/eCatcher.png style=\"width: 33px;\"></a></div></td></tr>
 ";
} else {
    $soft8 = '';
};

if (file_exists('software/eCatcherSetup.exe')) {


    if ($s > 1) {
        $s .= '&nbsp;��';
    } else {
        $s = $s * 1000;
        $s .= '&nbsp;��';
    };

    if (!empty($ver)) {
        $ver = '(' . $ver . ')';
    };
    $soft9 = "
 <tr><td><div class=down_item> eBuddy, ����������� ����������� eWON <span style=\"font-weight:normal\">������� �����, ��������� IP-������, �������� ��������, ����������� ��������� ����������� � �������������� ���������� </span> ��� vpn-������� Flexy</div></td>
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
  <h2>����� ��� ������ � vpn-�������� $r->model</h2><br /><br />
  </div>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  ������������ </div></td><td><div class=down_h>  ����, ������</div></td><td><div class=down_h> ������</div></td></tr>




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
  <h2>������� ������ � �����-���������� FLEXY</h2><br />
  </div>
  <img src="/images/ewon/Extention/Flexy-with-modules.png" align="left" style="height: 146px;padding: 0px 146px 20px 0px;
margin-top: -24px;">
<div style="display:block;float:right;width:600px;padding-bottom: 20px;">
<h3>3 ������� ������</h3><br /><br />
<ul style="text-align: left;"><li>Flexy 101/201 : �� ������� 4x Ethernet LAN 10/100MB</li>
<li>Flexy 102/202 : � Ethernet 10/100MB � RS232/422/485 �������</li>
<li>Flexy 103/203 : c Ethernet 10/100MB � MPI �������</li></ul><br />
<ul style="text-align: left;list-style: square outside;"><li>Flexy 10X � ��� WAN/LAN/Serial ������������� (M2M Data Gateway)</li><li>
Flexy 20X - ������������������� ������ (M2M Router)</li></ul></div>
<br /><br /><div style="width:950px;display: inline-block;
text-align: center;">
<div style="width:300px;float: left;"><img src="/images/ewon/Extention/modules-flexy-101-201.png" style="padding: 0px 10px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>Flexy 101/201</nobr></div>
<div style="width:300px;float: left;"><img src="/images/ewon/Extention/modules-flexy-102-202.png" style="padding: 0px 10px;" title="Flexy 102/202" alt="Flexy 102/202"><nobr>Flexy 102/202</nobr></div>
<div style="width:300px;float: left;"><img src="/images/ewon/Extention/modules-flexy-103-203.png" style="padding: 0px 10px;" title="Flexy 103/203" alt="Flexy 103/203"><nobr>Flexy 103/203</nobr></div></div><br />
<br /><br /><h3>�����-����������</h3>



<div style="width: 350px;
text-align: left;float:left;
padding-top: 20px;
display: inline-block;"><br /><p>&nbsp;</p>
&#9312; ������� ���������������� ����<br />
����������� ����� RS232/485/422 ��������� ��� ����������� ���������� ������� ��� ����� ������ � �������������� ��������� ���������� eWON Flexy I/O.
<br /> <br />
&#9313; Ethernet WAN<br />
������ WAN Ethernet ��� ����������� ������������� ������������ � ���������.
<br /> <br />
&#9314; 3G + HSUPA <br />
Pentaband ����� ��� ����� � �������������� 2G, 3G ��� 3G + ���� ������� ����� �� 7,3 ��/��� ��� ���������� � 2 ��/��� ��������.
<br /> <br />



  </div><br /><br />

 <div style="float:right;">
<div style="width:180px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-1.png" style="padding: 0px 10px 0px 0px;  height: 265px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9312; FLA 3301</nobr><br /><nobr>�����: &#9679;&#9679;&#9675;&#9675;</nobr></div>
<div style="width:200px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-2.png" style="padding: 0px 20px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9313; FLX 3101</nobr><br /><nobr>�����: &#9679;&#9679;&#9679;&#9679;</nobr></div>
<div style="width:200px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-3.png" style="padding: 0px 20px 0px 10px;  height: 265px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9314; FLB 3202</nobr><br /><nobr>�����: &#9675;&#9675;&#9679;&#9679;</nobr></div>


</div>


  <div style="float:left;">
<div style="height:310px;  width: 200px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-7.png" style="padding: 0px 10px 0px 0px;  height: 265px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9315; FLX 3401</nobr><br /><nobr>�����: &#9679;&#9679;&#9679;&#9679;</nobr></div>
<div style="height:310px;  width: 200px;float: left;"><img src="/images/ewon/Extention/flexy-extention-card-8.png" style="padding: 0px 20px;  height: 265px;" title="Flexy 101/201" alt="Flexy 101/201"><nobr>&#9316; FLA3501</nobr><br /><nobr>�����: &#9679;&#9679;&#9675;&#9675;</nobr></div>


</div>

<div style="width: 515px;float:right;
text-align: left;
padding-top: 20px;
display: inline-block;"><br /><p>&nbsp;</p>
&#9315; I/O-�����<br />
���������� ����� 8 x DI (0~10 VDC - 16 bits) ����.<br />
���������� ����� 4 x AI (0~12/24 VDC) ����.<br />
���������� ������ 2 x DO (3A/34V VAC/VDC) ����.
<br /> <br />
&#9316; �����<br />
�������������� ���������: V.92/56K, V.34/33.6K, V.32bis/14.4K �
V.22bis/2400 bps<br />
������ ������: V.44 and V.42bis, MNP 5<br />
������: RJ11<br />
��������� ���������� �� ������� ������
<br /> <br />




  </div>



 <div style="text-align:left;width: 935px;float:left;padding:10px 0px;font-size: 13px;">
 �����-���������� FLA ������������� ��� ������ � ����������� "A" (��� �����), FLB - ��� ������ "B" (��� ������),<br />FLX ����� �������� � ����� �� ������� ������.
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
      <center>������ ���������</center><br>
      ����� 6000i<br>
      ��������� 7\"<br>
      c SD ������
      c Ethernet
      � VNC ��������
      c ������. ��������<br>";
     */
    add_to_basket();
    popup_messages();
    temp2();
    echo $out;
    temp3();
    ?>