
<?php
session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");
include ("../sc/vars.php");
//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));
global $mysqli_db;
database_connect();
mysqli_query($mysqli_db,"SET NAMES 'cp1251'");


$blockI = $blockM = $blockS = "";

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
$num = "COSY131";
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysqli_query($mysqli_db, $sql) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);


$title = 'EWON COSY-131, ������������ VPN-������  � ��������� ������ � ������������';
$keywords = '������������, VPN, ������, eWON, COSY-131, vpn-������, ��������, ����������, ���������, ������, ������������';
$description = '������������ VPN-������ eWON COSY-131 - ���������� ����������� � ������������ ����� ��������. ������-���������� ��� ����������� ����������� 3G, Wi-Fi, Ethernet WAN, USB - ��������, �������� � ����������������.';
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

if ($r->retail_price == '0') {
    $toprice = "<td width=60 colspan='2' style='display: initial;
padding: 0px 20px;
border: none;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >��&nbsp;�������</td>";
} else {
    $toprice = "<td width=60 class=prpr title='������� ��� ��������� � ���' >$r->retail_price</td><td class=val_name title='������� ��� ��������� � ���'> EUR </td>";
};

$name = 'EWON COSY-131';
$type = '������������ VPN-ROUTER';

ob_start();
include dirname(__FILE__) . '/templates/price_block.php';
$out = ob_get_clean();

//----------------------------------right part content -----------------------
$out .= "
<div id=cont_rp>

";

$im = "<img src='/images/tick.png' width=15 style='vertical-align: middle;'>";
$he = "height=40 class=hl_text";
$vc = "valign=center";
$out .= "<br>
<table width=100%>
<tr><td valign=center>$im </td><td valign=middle $he>������� ����������� � LAN �� �������</td></tr>
<tr><td>$im </td><td $he>������������ �����������: Wi-Fi, ������� ����</td></tr>
<tr><td>$im </td><td $he>���������� ���������� � Firewall</td></tr>
<tr><td width=30>$im </td><td $he>������������� ����������� ����� 443 (HTTPS) � 1194 (UDP)</td></tr>
<tr><td>$im </td><td $he>����������� ��������� VPN-������� ������� ��������������</td></tr>
<tr><td>$im </td><td $he>USB-���������� ���������</td></tr>
<tr><td>$im </td><td $he>���� SD-����</td></tr>
<tr><td>$im </td><td $he>��������� �� DIN ����� � ������� 24VDC</td></tr>
<tr><td>$im </td><td $he>�������� ����������</td></tr>


</table>
<a style=\"text-decoration:none;font-size:17px;display:block;width:386px;overflow:hidden;padding:15px;background: rgba(0,255,0,0.1); font-weight: bold\" href=\"/video/ewon-cosy-131-vpn-router-bystryy-start-nachalnaya-nastroyka/\" >
                            <img src=\"/images/video/ewon131video.jpg\" style=\"float:right;width: 100px;\" />
                            ���������� ����� �� ������� ��������� ������� eWON                                                             
</a>
</div>
";



// --------------------- end right part content -----------------------

$out .= "</td></tr></table>"; // end big table
//----------------------------------------end pics ----------------------------


$out .= "
<style>
#rou_desc{
text-align:justify;
width:100%;
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
<iframe width='480' height='270' src='//www.youtube.com/embed/4sjXli_lUSI?rel=0' frameborder='0' allowfullscreen></iframe>&nbsp;&nbsp;&nbsp;
<iframe width='480' height='270' src='https://www.youtube.com/embed/piigvSrcIcY?rel=0' frameborder='0' allowfullscreen></iframe>
<br><br>
<div id=rou_desc>
<strong>eWON Cosy 131</strong> - ��� ������������ <strong>VPN ������</strong>, ���������������� ��� �������� ����������� ���������
�������� ������������� � �������� ����������� ����������� VPN ������.<br>
� ������� eWON Cosy 131 ������������� ������������ � ��������� ����������� ����� �������� ��������� �������
� ����������� ������������ ������������, ���������� ��������� ������������  ( ������������ ��� �� Ethernet, ��� � � ������� USB ),  ������������ �������
��������� � ��� �������, ������������� ����������� � IP-����� � ������������ � ������������ �����������. <br>��� ��� ����� ������ ��� ��������� �������, ��� �����������
������� ������� �� ������������ �������.<br><br>

<strong>eWON Cosy 131</strong> ��������� ��������� � <strong>Talk2M</strong>, �������� �������� eWON ( ���������� ). <strong>Talk2M</strong> ������������ ���������� VPN ���������� ����� �������������
� ��������� ��������. ��� ���� ������� �� ����� ���������� IP. eWON Cosy 131 � Talk2M ������������ ������� ������ ������� � ������������, ������������� � ����, ���, ���
������������ �� ����� �������� �������� � ������� IT.

<strong>VPN ������</strong> ������ ������������ � ��������� ���� �� �������, ��� ���� �� ��������� ������������� ������������� �������������� ����.
������ ���������� ����������� ����� 443 (HTTPS) � 1194 (UDP).
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
 <tr><td class=par_name1 >��������</td><td class=par_val1 >��������� ���������� �� Talk2M �� HTTPS (���� 443 ��� UDP 1194)</td></tr>
 <tr><td class=par_name1 >VPN �������</td><td class=par_val1 >Open VPN 2.0 ����� SSL ���� HTTPS</td></tr>
 <tr><td class=par_name1 >VPN ������������</td><td class=par_val1 >
 ������ VPN ������ �������� �� ������������� SSL/TLS ��� �������������� ������ � IPSec ESP �������� ��� ����������� ������������� ������� �� UDP. ��� ������������
 X509 PKI ( �������������� ���������� ����� ) ��� �������������� ������, TLS ������� ��� ������ �������, �����-����������� EVP ( DES, 3DES, AES, BF ) ���������
 ��� ���������� ������ �������, � HMAC-SHA1 �������� ��� �������������� ������ �������.


 </td></tr>
 <tr><td class=par_name1 >�������������</td><td class=par_val1 >���������� ���� ��������� �������, ������ ��������� �� http,
 ���� �������������� �� NTP</td></tr>
 </table><br><br>


 <span class=hpar>����������</span><br>
 $table_start
 <tr><td class=par_name1 >���������� ��� ���������</td><td class=par_val1 >���������� ��� ��������� � ��������� �������� ��� ������������ � ������������
 (�� ����� �������������� �� ). ������� �������������� ( �����/������ ) � �������� ������ ��� ������������. </td></tr>
<tr><td class=par_name1 >���������� �������</td><td class=par_val1 >FTP ������ � ������ ��� ������������, ���������� ��������</td></tr>
 <tr><td class=par_name1 >������������</td><td class=par_val1 >SNMP V1 � MIB2, ���� �� FTP </td></tr>
  <tr><td class=par_name1 >WAN Ethernet</td><td class=par_val1 >������������� �� 0 �� 3 ������ 10/100 �� Ethernet</td></tr>
    <tr><td class=par_name1 >LAN Ethernet</td><td class=par_val1 >������������� �� 0 �� 4 ������ 10/100 �� Ethernet</td></tr>
	    <tr><td class=par_name1 >��������� �����������</td><td class=par_val1 >USB-����</td></tr>
			    <tr><td class=par_name1 >���� ���� ������</td><td class=par_val1 >SD</td></tr>
<tr><td class=par_name1 >���������� ����� / ������</td><td class=par_val1 >2x DI, 1x DO</td></tr>
 </table><br><br>

 <span class=hpar>�����������</span><br>
 $table_start
 <tr><td class=par_name1 >�������� �������</td><td class=par_val1 >������</td></tr>
 <tr><td class=par_name1 >������ ����������</td><td class=par_val1 >����������������</td></tr>
 <tr><td class=par_name1 >�������� ���������</td><td class=par_val1 >�� ��� ����� EN50022-�����������</td></tr>
 <tr><td class=par_name1 >������ �������</td><td class=par_val1 >2� ���������� � ���������</td></tr>
 <tr><td class=par_name1 >���������� �������</td><td class=par_val1 >12-24 VDC +/-20%, LPS</td></tr>
 <tr><td class=par_name1 >������������ ��������</td><td class=par_val1 >30 ��</td></tr>
 <tr><td class=par_name1 >��������</td><td class=par_val1 >108 x 99 x 42 ��</td></tr>
 <tr><td class=par_name1 >���</td><td class=par_val1 >191 �� (EC61330)</td></tr>
 <tr><td class=par_name1 >������� �����������</td><td class=par_val1 >-25&deg ~ +70&deg</td></tr>
  <tr><td class=par_name1 >����������� ��������</td><td class=par_val1 >-40&deg ~ +70&deg</td></tr>
    <tr><td class=par_name1 >������������� ���������</td><td class=par_val1 >�� 10 �� 95% (��� �����������)</td></tr>

 </table><br><br>

  <span class=hpar>EC6133D (3G)</span><br>
 $table_start
 	    <tr><td class=par_name1 >�������</td><td class=par_val1 >GSM / GPRS / EDGE Quad-Band (850, 900, 1800, 1900 ���) - HSPA + UMTS
������ Pentaband (800/850, 900, AWS 1700, 1900, 2100 ���)</td></tr>
  	    <tr><td class=par_name1 >������ �������</td><td class=par_val1 >SMA (����)</td></tr>
 	    <tr><td class=par_name1 >�������</td><td class=par_val1 >������������ ��������</td></tr>
		 	    <tr><td class=par_name1 >���</td><td class=par_val1 >202 ��</td></tr>
 </table><br><br>

   <span class=hpar>EC6133C (Wi-Fi)</span><br>
 $table_start
 	    <tr><td class=par_name1 >WAN-�����������</td><td class=par_val1 >Ethernet ��� Wi-Fi 802.11 b/g/n</td></tr>
  	    <tr><td class=par_name1 >�������</td><td class=par_val1 >�� 1 �� 11 ������� (������������)</td></tr>
 	    <tr><td class=par_name1 >������������</td><td class=par_val1 >WPA2, WPA ��� WEP</td></tr>
  	    <tr><td class=par_name1 >������ �������</td><td class=par_val1 >�������� SMA </td></tr>
 	    <tr><td class=par_name1 >�������</td><td class=par_val1 >������ � ��������, ������� 2.4���, ������������� 50 ��, �������� 2.0 ���</td></tr>
		 	    <tr><td class=par_name1 >���</td><td class=par_val1 >199 ��</td></tr>



 ";



$sp_data1 .= "</table></div>";



//---------------------end tab1 -------------------------
//-------------spec ---------------------------
$out .= "<br><br>
<div class='tabs_wrapper' style='width:100%; min-height: 500px; overflow: auto; '>
<div id='tabs'>
  <ul>
     <li class='urlup' data='functions'><a href='#tabs-1'>��������������</a></li>
     <li class='urlup' data='dimensions'><a href='#tabs-2'>��������</a></li>

    <li class='urlup' data='software'><a href='#tabs-4'>�������</a></li>
  </ul>
  <div id='tabs-1'>
     <h2>����������� �������������� $r->model</h2>
    $sp_data1
  </div>";


if ($GLOBALS["net"] == 0) {
    $file = $path_to_real_files . '/images/ewon/dim/COSY131.png';
    if (file_exists($file)) {
        $yes = 1;
    }
} else {
    $file = $root_php . '/images/ewon/dim/COSY131.png';
    $re = cu($file);
    if ($re[0] > 0) {
        $yes = 1;
    };
};
if ($yes == 1) {
    $out .= " <div id='tabs-2' style=''>
  <h2>�������� $r->model</h2>
  <div style='position:absolute;margin: 50px 0px 0px 249px;'>���&nbsp;�������</div>
  <div style='position:absolute;margin: 50px 0px 0px 528px;'>���&nbsp;�����</div>
  <div style='position:absolute;margin: 632px 0px 0px 47px;'>���&nbsp;�����</div>
  <div style='position:absolute;margin: 632px 0px 0px 492px;'>���&nbsp;�����</div>
  <img src='/images/ewon/dim/COSY131.png'>
  </div>";
} else {
    $out .= " <div id='tabs-2'>
  �������� 108 x 99 x 42 ��
  </div>";
};





//---------------------download section -------------------------------- ------------------------------
$file = 'install/COSY131.pdf';

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
 <tr><td><div class=down_item>���������� �� ��������� �������� ������ COSY-131 </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/COSY131.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft7 = '';
};

$file = 'manuals/COSY131.pdf';
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
 <tr><td><div class=down_item>������� (datasheet) COSY-131 </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/manuals/COSY131.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft5 = '';
};








$file = 'install/COSY131_start.pdf';
if ($GLOBALS["net"] == 0) {
    if (file_exists($root_php . $file)) {
        $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
//$s =  ceil($fs/1000);
    } else {
        $blockS = 1;
    };
} else {
    $re = cu($root_php . '/' . $file);
    if ($re[0] > 0) {
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
    } else {
        $blockS = 1;
    };
};



if ($blockS != 1) {


    if ($fs > 1000) {
        $s = round($fs / 1000, 2) . '&nbsp;��';
    } else {
        $s = round($fs, 0) . '&nbsp;��';
    };
    $soft1 = "
 <tr><td><div class=down_item>���������� &#0171;������� �����&#0187; COSY-131 </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/" . $file . "' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
} else {
    $soft1 = '';
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
Services Free + and Pro</span> ��� vpn-������� COSY-131 $ver</div></td>
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
 <tr><td><div class=down_item> eBuddy, ����������� ����������� eWON <span style=\"font-weight:normal\">������� �����, ��������� IP-������, �������� ��������, ����������� ��������� ����������� � �������������� ���������� </span> ��� vpn-������� COSY-131</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/software/eBuddySetup.exe' > <img src=/vpn-routers/software/eBuddy.png style=\"width: 33px;\"></a></div></td></tr>
 ";
} else {
    $soft9 = '';
};


$ver = '';
$out .= "
  <div id='tabs-4'>
  <div class=connectors>
  <h2>����� ��� ������ � vpn-�������� $r->model</h2><br /><br />
  </div>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  ������������ </div></td><td><div class=down_h>  ����, ������</div></td><td><div class=down_h> ������</div></td></tr>




$soft8
$soft9
$soft5
  $soft7
  $soft1






   </table>

  </div>

";
$uuu = "";
$out .= '
<br /><br /></div><br /><br />' . $outs;


if (!empty($_GET["tab"])) {
    if ($_GET[tab] == 'accessories') {
        $uuu = '$(\'a[href="#tabs-5"]\').click();';
    } else if ($_GET["tab"] == 'functions') {
        $uuu = '$(\'a[href="#tabs-1"]\').click();';
    } else if ($_GET["tab"] == 'software') {
        $uuu = '$(\'a[href="#tabs-4"]\').click();';
    } else if ($_GET["tab"] == 'dimensions') {
        $uuu = '$(\'a[href="#tabs-2"]\').click();';
    } else if ($_GET["tab"] == 'scheme') {
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
$imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";
ob_start();?>


<meta property='og:title' content='<?=$title?>' />
<meta property="og:image" content="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>" />
<meta property='og:site_name' content='�������������' />
<link rel='image_src' href="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>">

<?$expansionParam = ob_get_clean();

//$head = head($template_file, $title, $description, $keywords);
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
    echo $out."</article>";
    temp3();
    ?>