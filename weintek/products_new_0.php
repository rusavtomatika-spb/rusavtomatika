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
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;��� ����� 4 ���.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;���� �� �������: ���, ���, ����</div>";
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
<table><tr><td width=840 align=left bfcolor=#cccccc><div class=big_pan_name>$r->diagonal\" &nbsp; ������ ��������� <b>$r->brand $r->model</b> </div></td><td width=50>
 <div class=pan_price_big title='��������� ����'> ���� </div></td><td width=50 class=prpr title='������� ��� ��������� � ���' >$r->retail_price</td><td class=val_name title='������� ��� ��������� � ���'> USD </td></tr></table>
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
 <tr><td width=5>&nbsp;</td><td width=80 class=h2_text>�������: </td><td > $onst</td>
 <td>  </td>  </tr>

 </table><br>

 <table><tr><td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>� �������</span></div></div> </td>
            <td><div class=but_wr> <div  class='zakazbut' idm='$r->model'onclick='show_compare(this)'><span>� ���������</span></div></div>  </td>
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model'><span>����� � 1 ����</span></div></div>  </td>
            <td><div class=but_wr><div  class='zakazbut' idm='$r->model'><span>�������� ������</span></div> </div> </td>
 </tr>
 <tr><td colspan=4><br><div class=hc1> </div>   </td></tr>
 </table>

";

$im = "<img src='../images/tick.png' width=15 style='vertical-align: middle;'>";
$he = "height=40 class=hl_text";
$vc = "valign=center";
echo "<br>
<table width=100%>
<tr><td valign=center>$im </td><td valign=middle $he>�� EasyBuilder8000</td></tr>
<tr><td width=30>$im </td><td $he>����������� ������</td></tr>
<tr><td>$im </td><td $he>4 COM �����</td></tr>
<tr><td>$im </td><td $he>�������� �������: miniUSB, USB, Ethernet</td></tr>
<tr><td>$im </td><td $he>2000 ����</td></tr>
<tr><td>$im </td><td $he>2000 ����</td></tr>



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
 <tr><td class=par_name1 $bg1>���������</td><td class=par_val1 $bg1></td></tr>
 <tr><td class=par_name1 $bg2>����������</td><td class=par_val1 $bg2>$r->resolution</td></tr>
 <tr><td class=par_name1 $bg1>�������</td><td class=par_val1  $bg1>$r->brightness</td></tr>
 <tr><td class=par_name1 $bg2>�������������</td><td class=par_val1 $bg2>$r->contrast</td></tr>
 <tr><td class=par_name1 $bg1>���������</td><td class=par_val1 $bg1>$r->colors</td></tr>

 $white_line
 <tr><td class=par_name1 $bg2>��� �������</td><td class=par_val1 $bg2>$r->touch</td></tr>
 <tr><td class=par_name1 $bg1>���������</td><td class=par_val1 $bg1>$r->cpu_type</td></tr>
 <tr><td class=par_name1 $bg2>�������</td><td class=par_val1 $bg2>$r->cpu_speed</td></tr>
 <tr><td class=par_name1 $bg1>���</td><td class=par_val1 $bg1>$r->ram</td></tr>
 <tr><td class=par_name1 $bg2>Flash ( ���������� )</td><td class=par_val1 $bg2>$r->flash</td></tr>

 $white_line

 <tr><td class=par_name1 $bg1>����. ����������</td><td class=par_val1 $bg1>$r->serial_full</td></tr>
 <tr><td class=par_name1 $bg2>��������� MPI</td><td class=par_val1 $bg2>187,5 K</td></tr>
 <tr><td class=par_name1 $bg1>USB Host</td><td class=par_val1 $bg1>$r->usb_host</td></tr>
 <tr><td class=par_name1 $bg2>USB Client</td><td class=par_val1 $bg2>$r->usb_client</td></tr>
 <tr><td class=par_name1 $bg1>SD �����</td><td class=par_val1 $bg1>$r->sdcard</td></tr>
 <tr><td class=par_name1 $bg2>Ethernet</td><td class=par_val1 $bg2>$r->ethernet</td></tr>
 <tr><td class=par_name1 $bg1>�����</td><td class=par_val1 $bg1>$r->audio</td></tr>
 <tr><td class=par_name1 $bg2>���������</td><td class=par_val1 $bg2>$r->video_input</td></tr>
 <tr><td class=par_name1 $bg1>CAN</td><td class=par_val1 $bg1>$r->can_bus</td></tr>

 $white_line

 <tr><td class=par_name1 $bg1>���������� �������</td><td class=par_val1 $bg1>$r->voltage</td></tr>
 <tr><td class=par_name1 $bg2>������������ ���</td><td class=par_val1 $bg2>$r->current</td></tr>

 $white_line";



$sp_data1 .= " $white_line ";



if ($r->software == "EasyBuilder8000")
    $sp_data1 .= " <tr><td class=par_name1 $bg2>�� ��� ���������� �������</td><td class=par_val1 $bg2>EasyBuilder8000</td></tr> ";

if ($r->software == "EasyBuilderPro")
    $sp_data1 .= " <tr><td class=par_name1 $bg2>�� ��� ���������� �������</td><td class=par_val1 $bg2>EasyBuilderPro</td></tr> ";

if ($r->software == "")
    $sp_data1 .= "
 <tr><td class=par_name1 $bg2>������������ �������</td><td class=par_val1 $bg2>$r->os</td></tr> ";

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
<td><a href=$eb8000 class=skach title=$altstr> ������� EasyBuilder 8000 v$vv </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$eb8000ug' class=skach title=$altstr target=_blank> ������� �������� �� </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/PLC_connection_guide.pdf' class=skach title=$altstr target=_blank>���-�� �� ����������� PLC </a> </td>

</tr> ";
}


if ($r->software == "EasyBuilderPro") {
    $vv = "3.2"; //show_pro_ver();
    $sp_data2 .= "
<tr>
<td width=40 ><a href='../ebpro/EBpro_setup.zip' > <img src=$im/soft.jpg border=0 alt=$altstr> </a></td>
<td><a href='../ebpro/EBpro_setup.zip' class=skach title=$altstr> ������� EasyBuilder Pro v$vv </a> </td>

<td width=40 ><a href=$root/manuals/EBPro_Manual_All_In_One.pdf target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/EBPro_Manual_All_In_One.pdf' class=skach title=$altstr target=_blank> ������� �������� �� </a> </td>

<td width=40 ><a href=$eb8000ug target=_blank > <img src=$im/manual.jpg border=0 alt=$altstr> </a></td>
<td><a href='$root/manuals/PLC_connection_guide.pdf' class=skach title=$altstr target=_blank>���-�� �� ����������� PLC </a> </td>

</tr> ";
}


$sp_data2 .= "
<tr>
<td width=40 ><a href=$root/manuals/" . $r->model . ".pdf target=_blank> <img src=$im/manual.jpg  border=0 alt=$altstr></a></td>
<td><a href='$root/manuals/" . $r->model . ".pdf' class=skach title=$altstr target=_blank> ������� �������� ������</a></td>

<td width=40 ><a href=$root/install/$r->install_doc target=_blank> <img src=$im/manual.jpg  border=0 alt=$altstr></a></td>
<td><a href='$root/install/$r->install_doc' class=skach title=$altstr target=_blank>������� ���-�� �� ��������� ������</a></td>";

if ($r->software)
    $sp_data2 .= "
<td width=40 ></td>
<td><a href='$root/weintek/plclist.php' class=skach title='������ ������������, � �������� ���������� ������ Weintek' target=_blank>����������� �����������</a></td>";

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
    <li><a href='#tabs-1'>��������������</a></li>
    <li><a href='#tabs-2'>��������</a></li>
    <li><a href='#tabs-3'>�����</a></li>
    <li><a href='#tabs-4'>�������</a></li>
  </ul>
  <div id='tabs-1'>
    $sp_data1
  </div>
  <div id='tabs-2'>
  <img src='../images/panel/dim/$r->model.png'>
  </div>
  <div id='tabs-3'>
  <div class=connectors>
  COM-����� ������ ��������� $r->model
  </div><br><br>
  ";

show_com_connector($r->model);

echo "</div>";

//---------------------download section -------------------------------- ------------------------------
if ($r->series == "MT6000i" || $r->series == "MT8000i")
    $usb = "<br>USB �������� ��� ����������� ������ $r->model � �� ���������������
  ������������� ��� ��������� EasyBuilder8000";
else
    $usb = "";

echo "
  <div id='tabs-4'>
  <div class=connectors>
  ����� ��� ������ �  ������� ��������� $r->model
  </div><br><br>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  ������������ </div></td><td><div class=down_h>  ����, ������</div></td><td><div class=down_h> ������</div></td></tr>
   <tr><td><div class=down_item>  ����������� ����������� EasyBuilder8000 v4.65.06</div>
   <div class=down_item_descr> ����������� ����������� EasyBuilder8000 ����������� ��� �������� ���������������� �������� ��� ������������ ������� Weintek ���������
   �����: <br>
   ����� MT6000i, ����� MT8000i<br>
   ������������� �� EasyBuilder8000 ��������� ���������, �� ������ ��������� �� � ������������ �� ��� �����-���� �����������.
   $usb
   </div></td>
   <td><div class=dt_item>";
echo get_file_date($EB8000_link);
echo "<br>(���)</div>
   </td> </td><td><div class=down_item><a href='$EB8000_link'><img src=/images/soft.jpg></a><div> </td> </tr>

   <tr><td><div class=down_item>  ����������� � �� EasyBuilder8000  </div></td>
   <td><div class=dt_item>";
echo get_file_date($EB8000_manual_link);
echo "<br>(eng)</div></td>
   <td><div class=down_item><a href='$EB8000_manual_link'><img src=/images/manual.jpg></a></div></td></tr>

   <tr><td><div class=down_item> ������� �� ������ ��������� $r->model </div></td>
   <td><div class=dt_item>";
echo get_file_date("/manuals/$r->model.pdf");
echo "<br>(eng)</div></td>
   <td><div class=down_item><a href='/manuals/$r->model.pdf'><img src=/images/manual.jpg></a></div></td></tr>

   <tr><td><div class=down_item> ����������� �� ��������� ������������ ������ $r->model </div></td>
   <td><div class=dt_item>";
echo get_file_date("/install/$r->install_doc");
echo "<br>(eng)</div></td>
   <td><div class=down_item><a href='/install/$r->install_doc' > <img src=/images/manual.jpg></a></div></td></tr>



   <tr><td><div class=down_item> ����������� �� ����������� ������������ (PLC) �  ������ ��������� $r->model </div>
   <div class=down_item_descr> � ����������� ������� ����������� � �����, ��� 100 PLC ��������� ��������������,
   ���� ����� �������� ������� ��� ����������� ������ ��������� $r->model � ���� PLC, ������� ��������, � ������� ���� ������
   �������� ������ PLC. <br> ��� �������� ��� ���� PLC, ���������� � ������ �����������, ��� ����������� � ������������ ������ $r->model. <br>
   ��� ����������� ������  ��������� $r->model � ����������� PLC ������������ ������������� ������������ � �������������� �������� ������� �����������.
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