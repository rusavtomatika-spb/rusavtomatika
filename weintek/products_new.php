<?php



session_start();

define("bullshit", 1);

include "../sc/dbcon.php";

include ("../sc/lib_new.php");



//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));



database_connect();

mysql_query("SET NAMES 'cp1251'");

temp0("weintek");

top_buttons();

basket();

temp1_no_menu();

show_price_val();

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

echo "<article>";

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



$min_table = miniatures($r->model, 5, 10, 350); // mins_in_row, mins_max, table_width

$im1 = get_big_pic($r->model);

$alt = get_kw("alt");

if (file_exists("../sc/new.php")) {

    include("../sc/new.php");

} else {

    $class = '';

};

echo "

<center>

<br><br>

<table width=1000px  height=400px>

<tr ><td colspan=2 height=50px>

<table><tr><td width=840 align=left bfcolor=#cccccc><h1 class=\"big_pan_name" . $class . "\">������ ��������� $r->diagonal\" <b>$r->brand $r->model</b> </h1></td><td width=50>

 <div class=pan_price_big title='��������� ����'> ���� </div></td><td width=60 class=prpr title='������� ��� ��������� � ���' >$r->retail_price</td><td class=val_name title='������� ��� ��������� � ���'> USD </td></tr></table>

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

 <tr><td width=5>&nbsp;</td><td width=80 class=h2_text>�������: </td><td > $onst</td>

 <td>  </td>  </tr>



 </table><br>



 <table><tr><td><div class=but_wr><div  class='zakazbut addToCart' idm='$r->model'><span>� �������</span></div></div> </td>

            <td><div class=but_wr> <div  class='zakazbut' idm='$r->model' onclick='show_compare(this)'><span>� ���������</span></div></div>  </td>

            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>����� � 1 ����</span></div></div>  </td>

            <td><div class=but_wr><div  class='zakazbut' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>�������� ������</span></div> </div> </td>

 </tr>

 <tr><td colspan=4><br><div class=hc1> </div>   </td></tr>

 </table>



";



$im = "<img src='../images/tick.png' width=15 style='vertical-align: middle;'>";

$he = "height=40 class=hl_text";

$vc = "valign=center";

if ($r->case_material != "�������")

    $cm = "<tr><td>$im </td><td $he>����� ����������� ������</td></tr>";

else

    $cm = "";



$proj_load = "";

if ($r->usb_client != "")

    $proj_load .= "� �� �� USB";

if ($r->ethernet != "") {

    if ($proj_load != "")

        $proj_load .= ", ";

    $proj_load .= "� �� �� Ethernet";

}



if ($r->usb_host != "")

    $proj_load .= ", � ������";

if ($r->sdcard != "")

    $proj_load .= ", � SD �����";



$proj_load1 .= "<tr><td>$im </td><td $he>�������� �������:$proj_load</td></tr>";



if ($r->os != "")

    $proj_load1 = "";





$os1 = "<tr><td valign=center>$im </td><td valign=middle $he>��: $r->software (����������)</td></tr> ";

if ($r->os != "")

    $os1 = "<tr><td valign=center>$im </td><td valign=middle $he>������ � ������������ �������� $r->os .NET $r->dotnet</td></tr> ";





$inter = $r->serial;

if ($r->ethernet != "")

    $inter .= ", Ethernet";

if ($r->usb_host != "")

    $inter .= ", USB host";

if ($r->sdcard != "")

    $inter .= ", SD �����";

if ($r->can_bus != "")

    $inter .= ", CAN";

if ($r->linear_out != "")

    $inter .= ", �������� ����� �����";



$remote = "";

if ($r->ethernet != "" && $r->os == "")

    $remote = "<tr><td>$im </td><td $he>��������� ������ �� VNC, FTP, EasyAccess </td></tr>";

if ($r->ethernet != "" && $r->os != "")

    $remote = "<tr><td>$im </td><td $he>��������� ������ �� VNC, FTP </td></tr>";



$fastgr = "";

if ($r->series == "iE")

    $fastgr = "<tr><td>$im </td><td $he>������� ������ � �������� <br>( �� 10 ��� �������, ��� � ������ ������ )</td></tr>";

$isoports = "";

if ($r->series == "iE")

    $isoports = "<tr><td>$im </td><td $he>������ �������������� �������� ���� ������</td></tr>";



$speed = "";

if ($r->series == "MT8000XE")

    $speed = "<tr><td>$im </td><td $he>��������� 1���, ����� ��������</td></tr>";



echo "<br>

<table width=100%>

$speed

$os1

<tr><td width=30>$im </td><td $he>���������� �������� � ����������</td></tr>

$cm

<tr><td>$im </td><td $he>$inter</td></tr>

$remote

$proj_load1

$fastgr

$isoports









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

    $dop = "<tr><td class=par_name1 $bg1>��������� ������ � ������</td><td class=par_val1 $bg1>FTP(������, �������, ������ �������), VNC (��������� ������),<br>

   EasyAccess (��������� ������, �������� ������� )</td></tr>

   <tr><td class=par_name1 $bg2>Ftp ������ � ������ ������</td><td class=par_val1 $bg2>" . ($r->ftp_access_hmi_mem ? "����" : "-") . "</td></tr>

   <tr><td class=par_name1 $bg1>Ftp ������ � SD ����� � ������</td><td class=par_val1 $bg1>" . ($r->ftp_access_sd_usb ? "����" : "-") . "</td></tr>

   ";

} else

    $dop = "";



$arch = "������ ������";

if ($r->usb_host != "")

    $arch .= ", ������";

if ($r->sdcard != "")

    $arch .= ", SD �����";



$modbus = "RTU, ASCII, Master, Slave";

if ($r->ethernet != "")

    $modbus .= ", TCP/IP";



$modbus = "<tr><td class=par_name1 $bg2>��������� Modbus</td><td class=par_val1 $bg2>$modbus</td></tr>";

if ($r->os != "")

    $modbus = "";



$mpi = "<tr><td class=par_name1 $bg1>��������� MPI</td><td class=par_val1 $bg1>187,5 K</td></tr>";

if ($r->os != "")

    $mpi = "";



$mount = "";

if ($r->wall_mount != "")

    $mount .= "� �����";

if ($r->vesa75 != "")

    $mount .= ", VESA 75x75";

if ($r->vesa100 != "")

    $mount .= ", VESA 100x100";





$usb_drv = "<tr><td class=par_name1 $bg2>�������� USB (��� �������� ������� � �� � ������ )</td><td class=par_val1 $bg2>��������������� ��� ��������� $r->software</td></tr>";

if ($r->usb_client == "")

    $usb_drv = "";



$sp_data1 = "

 <div style='width:90%;'><br />

 <span class=hpar>�������</span><br>

 $table_start

 <tr><td class=par_name1 $bg1>���������</td><td class=par_val1 $bg1>$r->diagonal\"</td></tr>

 <tr><td class=par_name1 $bg2>����������</td><td class=par_val1 $bg2>$r->resolution</td></tr>

 <tr><td class=par_name1 $bg1>�������</td><td class=par_val1  $bg1>$r->brightness ��/�2</td></tr>

 <tr><td class=par_name1 $bg2>�������������</td><td class=par_val1 $bg2>$r->contrast</td></tr>

 <tr><td class=par_name1 $bg1>���������</td><td class=par_val1 $bg1>$r->colors ������</td></tr>

 <tr><td class=par_name1 $bg2>��� ���������</td><td class=par_val1 $bg2>$r->backlight</td></tr>

 <tr><td class=par_name1 $bg1>����� ����� ���������</td><td class=par_val1 $bg1>$r->backlight_life �</td></tr>

 <tr><td class=par_name1 $bg2>��� �������</td><td class=par_val1 $bg2>$r->touch</td></tr>

 </table><br><br>



 <span class=hpar>���������</span><br>

 $table_start



 <tr><td class=par_name1 $bg1>���������</td><td class=par_val1 $bg1>$r->cpu_type</td></tr>

 <tr><td class=par_name1 $bg2>�������</td><td class=par_val1 $bg2>$r->cpu_speed ���</td></tr>

 <tr><td class=par_name1 $bg1>���</td><td class=par_val1 $bg1>$r->ram ��</td></tr>

 <tr><td class=par_name1 $bg2>Flash ( ���������� )</td><td class=par_val1 $bg2>$r->flash ��</td></tr>

 <tr><td class=par_name1 $bg1>RTC ( ���� ��������� ������� )</td><td class=par_val1 $bg1>" . ($r->rtc ? $r->rtc : '-') . "</td></tr>

 <tr><td class=par_name1 $bg2>���������� �������</td><td class=par_val1 $bg2>$r->voltage_min-$r->voltage_max � DC</td></tr>

 <tr><td class=par_name1 $bg1>������������ ���</td><td class=par_val1 $bg1>$r->current �</td></tr>

 </table><br><br>



 <span class=hpar>����������</span><br>

 $table_start

 <tr><td class=par_name1 $bg1>���������������� ����������</td><td class=par_val1 $bg1>$r->serial_full</td></tr>

 $modbus

 $mpi

 <tr><td class=par_name1 $bg2>USB Host</td><td class=par_val1 $bg2>" . ($r->usb_host ? $r->usb_host : '-') . "</td></tr>

 <tr><td class=par_name1 $bg1>USB Client</td><td class=par_val1 $bg1>" . ($r->usb_client ? $r->usb_client : '-') . "</td></tr>

 <tr><td class=par_name1 $bg2>���� SD �����</td><td class=par_val1 $bg2>" . ($r->sdcard ? $r->sdcard : '-') . "</td></tr>

 <tr><td class=par_name1 $bg1>Ethernet</td><td class=par_val1 $bg1>" . ($r->ethernet ? $r->ethernet : '-') . "</td></tr>

 <tr><td class=par_name1 $bg2>�������� ����������</td><td class=par_val1 $bg2>" . ($r->linear_out ? $r->linear_out : '-') . "</td></tr>

 <tr><td class=par_name1 $bg1>���������</td><td class=par_val1 $bg1>" . ($r->video_input ? $r->video_input : '-') . "</td></tr>

 <tr><td class=par_name1 $bg2>CAN</td><td class=par_val1 $bg2>" . ($r->can_bus ? $r->can_bus : '-') . "</td></tr>

 </table><br><br>



 <span class=hpar>�����������</span><br>

 $table_start

 <tr><td class=par_name1 $bg1>�������� �������</td><td class=par_val1 $bg1>$r->case_material</td></tr>

 <tr><td class=par_name1 $bg2>������� ������ �� ������</td><td class=par_val1 $bg2>IP65</td></tr>

 <tr><td class=par_name1 $bg2>������ ����������</td><td class=par_val1 $bg2>" . ($r->cpu_fan ? "����������" : "����������������") . "</td></tr>

 <tr><td class=par_name1 $bg1>�������� ���������</td><td class=par_val1 $bg1>$mount</td></tr>

 <tr><td class=par_name1 $bg1>�������� ��������</td><td class=par_val1 $bg1>$r->set</td></tr>

 <tr><td class=par_name1 $bg1>������ �������</td><td class=par_val1 $bg1>$r->power_connector</td></tr>

 <tr><td class=par_name1 $bg2>��������</td><td class=par_val1 $bg2>$r->dimentions ��</td></tr>

 <tr><td class=par_name1 $bg1>����� ��� �������</td><td class=par_val1 $bg1>$r->cutout ��</td></tr>

 <tr><td class=par_name1 $bg2>���</td><td class=par_val1 $bg2>$r->netto ��</td></tr>

 <tr><td class=par_name1 $bg1>������� �����������</td><td class=par_val1 $bg1>$r->temp_min&deg - $r->temp_max&deg</td></tr>

 </table><br><br>



  <span class=hpar>�O</span><br>

 $table_start";



ob_start();?>

<?if($r->os != ""):?>

    <tr><td class=par_name1 <?=$bg2?>>������������� ������������ �������</td><td class=par_val1 <?=$bg2?>><?=$r->os?></td></tr>

<?else:?>

    <tr><td class=par_name1 <?=$bg2?>>�� ��� ���������� ��������</td><td class=par_val1 <?=$bg2?>>$r->software</td></tr>

    <tr><td class=par_name1 <?=$bg1?>>������������ ���������� ������� � �������</td><td class=par_val1 <?=$bg1?>>1999</td></tr>

    <?if($r->codesys != 0):?>

        <tr><td class=par_name1 <?=$bg1?>>��������� Codesys</td><td class=par_val1 <?=$bg1?>>����</td></tr>

    <?endif;?>

    <?=$usb_drv?>

    <tr><td class=par_name1 <?=$bg1?>>�������� ��� ������ � �������������</td><td class=par_val1 <?=$bg1?>>��� ����������� � ������</td></tr>

    <tr><td class=par_name1 <?=$bg2?>>����������� ���������� ������� ������</td><td class=par_val1 <?=$bg2?>><?=$arch?></td></tr>

    <tr><td class=par_name1 <?=$bg1?>>������� �������� ������� � ������</td><td class=par_val1 <?=$bg1?>><?=$proj_load?></td></tr>

    <tr><td class=par_name1 <?=$bg1?>>������������ ������ �������</td><td class=par_val1 <?=$bg1?>><?=$r->project_size_mb?> ��</td></tr>

    <tr><td class=par_name1 <?=$bg1?>>����� ������ ��� ���������� ������� � ������</td><td class=par_val1 <?=$bg1?>><?=$r->history_data_size_mb?> ��</td></tr>

    <tr><td class=par_name1 <?=$bg2?>>����������� �������� ���������������� ����������</td><td class=par_val1 <?=$bg2?>>����</td></tr>

    <?=$dop?>

    <tr><td class=par_name1 <?=$bg1?>>������������ �������</td><td class=par_val1 <?=$bg1?>>��������, ��� � ���� � ������, �� � �� �������� ���������� �������� ������. ���������� ��������� �������

    ���������������� ����������� �����. ����������� ����� ������������ ������ ���� �������������, ������� ������������� <?=$r->software?></td></tr>

<?endif;?>



</table></div><br><br>





<? $sp_data1 .= ob_get_clean();













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

   <h2>����������� �������������� $r->model</h2>

    $sp_data1

  </div>

  <div id='tabs-2'>

   <h2>�������� $r->model</h2>

  <img src='../images/weintek/dim/$r->model.png'><br /><br />

  </div>

  <div id='tabs-3'>

  <div class=connectors>

  <h2>COM-����� ������ ��������� $r->model</h2><br />

  </div><br><br>

  ";



show_com_connector($r->model);



echo "</div>";



//---------------------download section -------------------------------- ------------------------------

if ($r->series == "MT6000i" || $r->series == "MT8000i" || $r->series = "eMT3000")

    $usb = "<br>USB �������� ��� ����������� ������ $r->model � �� ���������������

  ������������� ��� ��������� $r->software";

else

    $usb = "";



if ($r->software == "EasyBuilder8000") {

    $ver = file_get_contents($GLOBALS["EB8000_version"]);

    $so = $GLOBALS["EB8000_link"];

    $ma = $GLOBALS["EB8000_manual_link"];

    $serii = "����� MT6000i, ����� MT8000i";

} else if ($r->software == "EasyBuilderPro") {

    $ver = file_get_contents($GLOBALS["EBPro_version"]);

    $so = $GLOBALS["EBPro_link"];

    $ma = $GLOBALS["EBPro_manual_link"];

    $serii = "����� MT8000iE, ����� eMT3000";

}



if ($r->software != "") {

    $soft1 = " <tr><td><div class=down_item>  ����������� ����������� $r->software $ver</div>

   <div class=down_item_descr> ����������� ����������� $r->software ����������� ��� �������� ���������������� �������� ��� ������������ ������� Weintek ���������

   �����: <br>

   $serii<br>

   ������������� �� $r->software ��������� ���������, �� ������ ��������� �� � ������������ �� ��� �����-���� �����������.

   $usb

   </div></td>

   <td><div class=dt_item>" . get_file_date($so) . "<br>(���)</div>

   </td> </td><td><div class=down_item><a href='$so'><img src=/images/soft.jpg></a><div> </td> </tr>";



    $soft2 = "<tr><td><div class=down_item>  ����������� � �� $r->software  </div></td>

   <td><div class=dt_item>" . get_file_date($ma) . "<br>(eng)</div></td>

   <td><div class=down_item><a href='$ma'><img src=/images/manual.jpg></a></div></td></tr> ";



    $soft3 = "<tr><td><div class=down_item> ����������� �� ����������� ������������ (PLC) �  ������ ��������� $r->model </div>

   <div class=down_item_descr> � ����������� ������� ����������� � �����, ��� 100 PLC ��������� ��������������,

   ���� ����� �������� ������� ��� ����������� ������ ��������� $r->model � ���� PLC, ������� ��������, � ������� ���� ������

   �������� ������ PLC. <br> ��� �������� ��� ���� PLC, ���������� � ������ �����������, ��� ����������� � ������������ ������ $r->model. <br>

   ��� ����������� ������  ��������� $r->model � ����������� PLC ������������ ������������� ������������ � �������������� �������� ������� �����������.

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

  <h2>����� ��� ������ �  ������� ��������� $r->model</h2>

  </div><br><br>



   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>

   <tr><td><div class=down_h>  ������������ </div></td><td width=100><div class=down_h>  ����, ������</div></td><td><div class=down_h> ������</div></td></tr>



   $soft1

   $soft2";

echo "<tr><td><div class=down_item> ������� �� ������ ��������� $r->model </div></td>

   <td><div class=dt_item>";

echo get_file_date("/manuals/$r->model.pdf");

echo "<br>(eng)</div></td>

   <td><div class=down_item><a href='/manuals/$r->model.pdf'><img src=/images/manual.jpg></a></div></td></tr>";

if ($r->user_manual) {

    echo "<tr><td><div class=down_item> ����������� ������������ $r->model </div></td>

   <td><div class=dt_item>";

    echo get_file_date("/manuals/$r->user_manual");

    echo "<br>(eng)</div></td>

   <td><div class=down_item><a href='/manuals/$r->user_manual'><img src=/images/manual.jpg></a></div></td></tr>";

}

echo "<tr>";

echo "<td><div class=down_item> ����������� �� ��������� ������������ ������ $r->model </div></td>";

echo "<td><div class=dt_item>";

echo get_file_date("/install/$r->install_doc");

echo "<br>(eng)</div></td>";

echo "<td><div class=down_item><a href='/install/$r->install_doc' > <img src=/images/manual.jpg></a></div></td></tr>";

echo "$soft3

   </table>

   <br /> <br />

  </div>

</div><br /><br />

</div>

";





echo"<br><br>";

//-----------------end content

echo "</article>";

temp3();

?>