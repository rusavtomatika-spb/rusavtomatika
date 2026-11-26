<?php

$start = microtime(true);

session_start();

define("bullshit", 1);

include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";

include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");

include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_controllers.php");



database_connect();



//temp0("weintek");

//top_buttons();

//temp1_no_menu();

//show_price_val();

//basket();

//temp2();

//---------------content ---------------------

//add_to_basket();

//popup_messages();

$vta = (explode('?', $_SERVER['REQUEST_URI']));



$var_to_array = str_replace("/index.php", "/", $vta[0]);

$var_to_array = str_replace("index.php", "", $var_to_array);

//echo $_SERVER['QUERY_STRING'];

$CANONICAL = $var_to_array;

//var_dump($_SERVER);

//$var_to_array = str_replace("/index.php", "", $_SERVER['REQUEST_URI']);

$var_to_array = str_replace(".php", "", $var_to_array);

//echo $var_to_array;

if (preg_match('/\/$/i', $var_to_array)) {

    $var_to_array = substr($var_to_array, 0, -1);

};

//if (preg_match('/^\//i',$var_to_array)) {$var_to_array = substr($var_to_array, 1);	};

$var_array = explode("/", $var_to_array);

//var_dump($var_array);

$levels = count($var_array);

$levels = $levels - 1;



//echo $levels;

if ($levels == 2) {



    $out = '<center><h1>���, PLC, ��������������� ���������� ����������� Mikrodev, ��������� �����������, �� ������</h1></center>' . add_style() . '<br /><br />

<div style="width:90%;margin:auto;">� 2006 ���� �������� Mikrodev � �������� ������ � �������� ���������������� �� ������������ �������������, ������ ������� �������� ��������������, �������� ������ ������ �� ����������� ������������������� ���������� � ������������ ��������� ���������.<br /><br />

<strong>PLC Mikrodev</strong> ��������������� �������� ��������������� �������������, ���������������� ������� �� 1024 �����, ���������� flash-�������, ���������� ���������� Modbus �/��� Canbus, ������� ���������� �������� ���������� (9~36 VDC), ������� ������������ -10~50&#8451;, ����� ���������� ��������� - �� DIN-����� � �� ��� �����, ������������� ��������� ��� ������� ����������� � ��������������� ����� �� ������ ������� ��� � �������, � ����� ������� �������� ����������� �� ���������� DIO, AIO, RTD (���������� ����� ��� ������������� ��������), �� ������� COM, Ethernet, GSM ������, Wi-Fi � �������.

<br /><br />

<strong>���������� �� ��� ������ � PLC</strong> ����������� ��������� Mikrodev: Mirkodiagram � ��� �������� FBD-��������, Mikrodev Scada ��� �������� PLC � ������ ������, ����� � ��������� ������ � ���, � ����� ������������������ �� ��� ���������� �����������. �������� �������� � ��� �������������� � ������� USB-���������� (������-���������� � ���������).<br /><br />

���� �������� <strong>����������� ������������� Mikrodev � ������ � �������</strong>, ���������� PLC, ������-���������� ���, ��������� ������ ��� ��� ������������ �������� Mikrodev. <br /><br />��������� ���������������: CE, EN 55011 (����� B). </div>

';



    $DESCRIPTION = 'PLC, ��������������� ���������� ����������� ���������� (���) �� ������ �� �������� ����. ������. ������������� �� 1024 �����. ������� �����, � ������� �� ������, �������� �� ������ � �������.';

    $KEYWORDS = '����������� ���, ��������������� �����������, ��������������� ���������� ��������������� ������, ���������� PLC, PLC, Mikrodev, ����������� �������������';

    $TITLE = '���, PLC, ��������������� ���������� ����������� Mikrodev, ��������� �����������, �� ������';



    function children_menu_mkd($num) {

        $sql = "SELECT * FROM `controllers` WHERE `parent` = '$num' ";

        $res = mysql_query($sql) or die(mysql_error());



        $r = mysql_num_rows($res);



        if ($r == 0) {

            $sql = "SELECT * FROM `controllers` WHERE `model` = '$num' ";

            $res = mysql_query($sql) or die(mysql_error());



            $r = mysql_num_rows($res);

        };



        if ($r > 0) {

            $o .= '<ul class="submenu_controllers">';

            for ($i = 0; $i < $r; $i++) {

                $row = mysql_fetch_array($res);

                $add = array();

                $outs = array();



                if ($row['DI'] > 0) {

                    $add[] = $row['DI'] . 'DI';

                };

                if ($row['AI_full'] != '') {

                    $add[] = $row['AI_full'];

                } else

                if ($row['AI'] > 0) {

                    $add[] = $row['AI'] . 'AI';

                };

                if ($row['DO'] > 0) {

                    if (($row[transistor] == '1')) {

                        if ($row[pnp] == '1')

                            $a = ' PNP';

                        elseif ($row[npn] == '1')

                            $a = ' NPN';

                        else

                            $a = '';

                        $add[] = $row['DO'] . 'DO' . ' (����������' . $a . ')';

                    } else {

                        if ($row[relay_power] == '1')

                            $a = '(������� ����)';

                        else if ($row[relay] == '1')

                            $a = '(����)';

                        else

                            $a = '';

                        $add[] = $row['DO'] . 'DO' . $a;

                    };

                } else if ($row[relay] > 0) {

                    $add[] = $row['relay'] . 'RO';

                };



                if ($row['AO'] > 0) {

                    $add[] = $row['AO'] . 'AO';

                };



                if ($row['tc'] > 0) {

                    $add[] = $row['tc'] . 'RTD (������������������)';

                };



                if ($row['loadcell'] > 0) {

                    $add[] = $row['loadcell'] . 'x16LoadCells ';

                };



                if ($row['serial_full'] != '') {

                    $add[] = $row['serial_full'];

                };

                if ($row['usb_hosts'] > 0) {

                    $add[] = 'USB2.0x' . $row['usb_hosts'] . '(����)';

                };





                if (($row['diagonal'] != '') AND ( $row['diagonal'] != '0')) {

                    $add[] = 'LCD-������� 2x16 ��������';

                };



                if (($row['ethernet'] != '')) {

                    $add[] = 'Ethernet';

                };



                if (($row['wifi'] != '')) {

                    $add[] = 'Wi-Fi';

                };

                if (($row['sim'] != '')) {

                    if ($row['sim'] != '����')

                        $add[] = $row['sim'];

                    else

                        $add[] = 'GSM (GPRS)';

                };





                if ($row['can_bus'] != '') {

                    if ($row['can_bus'] != '����')

                        $add[] = $row['can_bus'];

                    else

                        $add[] = 'Canbus';

                };



                if ($row['modbus_support'] != '') {

                    if ($row['modbus_support'] != '����')

                        $add[] = $row['modbus_support'];

                    else

                        $add[] = 'Modbus';

                };



                if ($row[onstock] > '0' OR $row[onstock_spb] > '0' OR $row[onstock_msk] > '0' OR $row[onstock_kiv] > '0') {

                    $stock = '<span class="green"><img src="/images/tick.png" width="14"></span>';

                } else {

                    $stock = '<span class="green" style="width:14px;"></span>';

                };





                if (($row[retail_price] != '0') AND ( $row[retail_price] != '')) {

                    $priceb = "<div class=val_name style='float:right;  font-size: 13px;' title='������� ��� ��������� � ���'>USD </div><div class=prpr style='  font-size: 13px;float: right;margin-right: 5px;' title='������� ��� ��������� � ���'>$row[retail_price]</div>";



                    $basket = '<div idm="' . $row[model] . '" class="zakazbut3 yes addToCart" title="� �������"><img src="/images/into-cart.png"></div>';

                } else {

                    $priceb = "

<div style='' class='zakazbut init' idm='$row[model]' onclick='show_backup_call(6, \"$row[model]\")' >��&nbsp;�������</div>";

                    $basket = '';

                };



                $o .= '<li><div class="submenu_controller">' . $basket . '<a href="/plc/mikrodev/' . $row[model] . '.php"><span class="name">' . $row[model] . '</span> <span style="  width: 660px;">' . implode(', ', $add) . '</span></a><span style="width:90px;">' . $priceb . '</span><span style="margin-left: 35px;">' . $stock . '</span>

</div>

</li>';

            }

            $o .= '</ul>';

        };

        return $o;

    }



    function show_controllers_mp100_plc() {



        $alt = 'PLC Mikrodev ����� MP100';



        $h = h();

//$min_table=mini_controllers('A-61', 5, 10, 350);

//$im1 = 'images/controllers/mikrodev/A-218x/A-218x_1.png';

//$bim1 = 'images/controllers/mikrodev/A-218x/lg/A-218x_1.png';

//$im1=img('MP100L',1);

//$bim1=imgbig('MP100L',1);

        $im1 = '/images/controllers/mikrodev/MP100L/MP100L_1.png';

        $bim1 = $im1;

        $kartinka = "

<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" />

<img src='$im1' alt='$alt' style='width: 300px;  margin-top: 40px;  margin-left: 50px;'></span></a>";





        $a1 = '<div class="head_block" >';

        $a2 = '</div>';

        $tick = '<img src="/images/tick.png" width="15"> ';



        $out = "<br><br>



$a1<$h id='mikrodev-plc' class=series_name>PLC Mikrodev ����� MP100</$h>$a2





<table style='  width: 1050px;  margin: auto;'>

<tr ><td valign=top align=center valign=center width=500px bfcolor=#eeeeee>

<div id=dd style='height:300px;'>

$kartinka</div>

<center>

  $min_table</center>

</td><td>

" . '<table width="100%">



<tbody>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������������ ����� ������ � �������: 800</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������ ��� �������: 2 �� flash</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������������� ��: 320 DIO (128DI, 128TO, 64RO), 96 AIO (32AI, 32RTD (PT100-PT1000-NTC), 32AO)</td></tr>



<tr><td width="30">' . $tick . '</td><td  class="hl_text">FBD-���������������� (�������� ����� USB � ��)</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� � �������� �������</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">��������� Canbus, Modbus TCP / RTU</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">Ethernet / GSM / RS485, BACnet MS / TP �� �����</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">����������� ����������� SCADA</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� � ������� ����������� �������</td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">���������� I/O �� 1024 �����</td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">������� �����������: -10~50&#8451;</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� ������� 9~36 VDC </td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">�����������: CE, EN 55011 (����� B)</td></tr>

' .

                "</tbody></table>

</td></tr></table>" .

                '

<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">

<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">������</span> <span style="  width: 669px;">��������������</span></a><span style="width:90px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>

<div style="width: 1050px;  margin: auto;   display: table; ">

<div class="" style="  ">



<div class="co">

<div class="congroup">



</div>

' . children_menu_mkd('MP100') . '

' . children_menu_mkd('MP100L') . '

</div>







</div></div>

' .

                $about;



        if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {

            $out .= '<br /><br />';

        };

        return $out;

    }



    function show_controllers_mp200_plc() {



        $alt = 'PLC Mikrodev ����� MP200';



        $h = h();

//$min_table=mini_controllers('A-61', 5, 10, 350);

//$im1 = 'images/controllers/mikrodev/A-218x/A-218x_1.png';

//$bim1 = 'images/controllers/mikrodev/A-218x/lg/A-218x_1.png';

//$im1=img('MP100L',1);

//$bim1=imgbig('MP100L',1);

        $im1 = '/images/controllers/mikrodev/MP200G/MP200G_1.png';

        $bim1 = $im1;

        $kartinka = "

<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" />

<img src='$im1' alt='$alt' style='width: 300px;  margin-top: 40px;  margin-left: 50px;'></span></a>";





        $a1 = '<div class="head_block" >';

        $a2 = '</div>';

        $tick = '<img src="/images/tick.png" width="15"> ';



        $out = "<br><br>



$a1<$h id='mikrodev-plc' class=series_name>PLC Mikrodev ����� MP200</$h>$a2





<table style='  width: 1050px;  margin: auto;'>

<tr ><td valign=top align=center valign=center width=500px bfcolor=#eeeeee>

<div id=dd style='height:300px;'>

$kartinka</div>

<center>

  $min_table</center>

</td><td>

" . '<table width="100%">



<tbody>



<tr><td width="30">' . $tick . '</td><td  class="hl_text">������������ ����� ������ � �������: 1500</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������ ��� �������: 4 �� flash</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">����������������� ������: 4 ���� FRAM</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������������� ��: 640 DIO (256DI, 256TO, 128RO), 192 AIO (64AI, 32RTD (PT100-PT1000-NTC), 64AO) </td></tr>



<tr><td width="30">' . $tick . '</td><td  class="hl_text">FBD-���������������� (�������� ����� USB � ��)</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� � �������� �������</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">��������� Canbus, Modbus TCP / RTU</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">Ethernet / GSM / RS485, BACnet MS / TP �� �����</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">����������� ����������� SCADA</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� � ������� ����������� �������</td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">���������� I/O �� 1024 �����</td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">������� �����������: -10~50&#8451;</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� ������� 9~36 VDC </td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">�����������: CE, EN 55011 (����� B)</td></tr>

' .

                "</tbody></table>

</td></tr></table>" .

                '

<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">

<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">������</span> <span style="  width: 669px;">��������������</span></a><span style="width:90px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>

<div style="width: 1050px;  margin: auto;   display: table; ">

<div class="" style="  ">





<div class="co">

<div class="congroup">



</div>

' . children_menu_mkd('MP200') . '

' . children_menu_mkd('MP200L') . '

' . children_menu_mkd('MP200G') . '

' . children_menu_mkd('MP200E') . '

' . children_menu_mkd('MP201') . '

' . children_menu_mkd('MP201X') . '

</div>





</div></div>

' .

                $about;



        if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {

            $out .= '<br /><br />';

        };

        return $out;

    }



    function show_controllers_mp1100_plc() {



        $alt = 'PLC Mikrodev ����� MP1100';



        $h = h();

//$min_table=mini_controllers('A-61', 5, 10, 350);

//$im1 = 'images/controllers/mikrodev/A-218x/A-218x_1.png';

//$bim1 = 'images/controllers/mikrodev/A-218x/lg/A-218x_1.png';

//$im1=img('MP100L',1);

//$bim1=imgbig('MP100L',1);

        $im1 = '/images/controllers/mikrodev/MP1100L/MP1100L_1.png';

        $bim1 = $im1;

        $kartinka = "

<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" />

<img src='$im1' alt='$alt' style='width: 300px;  margin-top: 40px;  margin-left: 50px;'></span></a>";





        $a1 = '<div class="head_block" >';

        $a2 = '</div>';

        $tick = '<img src="/images/tick.png" width="15"> ';



        $out = "<br><br>



$a1<$h id='mikrodev-plc' class=series_name>PLC Mikrodev ����� MP1100</$h>$a2





<table style='  width: 1050px;  margin: auto;'>

<tr ><td valign=top align=center valign=center width=500px bfcolor=#eeeeee>

<div id=dd style='height:300px;'>

$kartinka</div>

<center>

  $min_table</center>

</td><td>

" . '<table width="100%">



<tbody>



<tr><td width="30">' . $tick . '</td><td  class="hl_text">������������ ����� ������ � �������: 800</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������ ��� �������: 4 �� flash</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">����������������� ������: 4 ���� FRAM</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������������� ��: 320 DIO (128DI, 128TO, 64RO), 192 AIO (64AI, 32RTD (PT100-PT1000-NTC), 64AO) </td></tr>



<tr><td width="30">' . $tick . '</td><td  class="hl_text">FBD-���������������� (�������� ����� USB � ��)</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� � �������� �������</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">��������� Canbus, Modbus TCP / RTU</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">Ethernet / GSM / RS485, BACnet MS / TP �� �����</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">����������� ����������� SCADA</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� � ������� ����������� �������</td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">���������� I/O �� 1024 �����</td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">������� �����������: -10~50&#8451;</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� ������� 9~36 VDC </td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">�����������: CE, EN 55011 (����� B)</td></tr>

' .

                "</tbody></table>

</td></tr></table>" .

                '

<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">

<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">������</span> <span style="  width: 669px;">��������������</span></a><span style="width:90px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>

<div style="width: 1050px;  margin: auto;   display: table; ">

<div class="" style="  ">





<div class="co">

<div class="congroup">



</div>

' . children_menu_mkd('MP1100') . '

' . children_menu_mkd('MP1100L') . '

</div>



</div></div>

' .

                $about;



        if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {

            $out .= '<br /><br />';

        };

        return $out;

    }



    function show_controllers_mod_plc() {



        $alt = '������ Mikrodev';



        $h = h();

//$min_table=mini_controllers('A-61', 5, 10, 350);

//$im1 = 'images/controllers/mikrodev/A-218x/A-218x_1.png';

//$bim1 = 'images/controllers/mikrodev/A-218x/lg/A-218x_1.png';

        $im1 = img('XIO200.LC2', 1);

        $bim1 = imgbig('XIO200.LC2', 1);

        $im1 = '/images/controllers/mikrodev/XIO200.Q32/XIO200.Q32_1.png';

        $bim1 = $im1;



        $kartinka = "

<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" />

<img src='$im1' alt='$alt' style='width: 300px;  margin-top: 40px;  margin-left: 50px;'></span></a>";





        $a1 = '<div class="head_block" >';

        $a2 = '</div>';

        $tick = '<img src="/images/tick.png" width="15"> ';



        $out = "<br><br>



$a1<$h id='mikrodev-xio' class=series_name>������ Mikrodev ��� ����� MP100, MP200</$h>$a2





<table style='  width: 1050px;  margin: auto;'>

<tr ><td valign=top align=center valign=center width=500px bfcolor=#eeeeee>

<div id=dd style='height:300px;'>

$kartinka</div>

<center>

  $min_table</center>

</td><td>

" . '<table width="100%">



<tbody>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������ � ����������� ��������� ��������� �����������</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">1�� ���� I/O �� ���� Canbus </td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������� ������</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">��������� ��������������� ��� �������� �����</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������� ����������� -10~50&#8451;</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� ������� 9~36 VDC </td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">���������������: CE, EN 55011 ( ����� B )</td></tr>

' .

                "</tbody></table>

</td></tr></table>" .

                '

<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">

<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">������</span> <span style="  width: 669px;">��������������</span></a><span style="width:90px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>

<div style="width: 1050px;  margin: auto;   display: table; ">

<div class="" style="  ">



<div class="co">

<div class="congroup">

<div class="conparams" style="  display: inline-block;">

<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">XIO200</span></h3>

</div>

</div>

' . children_menu_mkd('XIO200.I16') . '

' . children_menu_mkd('XIO200.I32') . '

' . children_menu_mkd('XIO200.Q16') . '

' . children_menu_mkd('XIO200.Q32') . '

' . children_menu_mkd('XIO200.AI4') . '

' . children_menu_mkd('XIO200.AI8') . '

' . children_menu_mkd('XIO200.AQ4') . '

' . children_menu_mkd('XIO200.AQ8') . '

' . children_menu_mkd('XIO200.Y8') . '

' . children_menu_mkd('XIO200.Y16') . '

' . children_menu_mkd('XIO200.P4') . '

' . children_menu_mkd('XIO200.P8') . '

' . children_menu_mkd('XIO200.LC1') . '

' . children_menu_mkd('XIO200.LC2') . '

</div>





</div></div>

' .

                $about;



        if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {

            $out .= '<br /><br />';

        };

        return $out;

    }



    function show_controllers_rmod_plc() {



        $alt = '��������� ������ Mikrodev';



        $h = h();

//$min_table=mini_controllers('A-61', 5, 10, 350);

//$im1 = 'images/controllers/mikrodev/A-218x/A-218x_1.png';

//$bim1 = 'images/controllers/mikrodev/A-218x/lg/A-218x_1.png';

        $im1 = img('XIO200.LC2', 1);

        $bim1 = imgbig('XIO200.LC2', 1);



        $im1 = '/images/controllers/mikrodev/RIO201G/RIO201G_1.png';

        $bim1 = $im1;



        $kartinka = "

<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" />

<img src='$im1' alt='$alt' style='width: 300px;  margin-top: 40px;  margin-left: 50px;'></span></a>";





        $a1 = '<div class="head_block" >';

        $a2 = '</div>';

        $tick = '<img src="/images/tick.png" width="15"> ';



        $out = "<br><br>



$a1<$h id='mikrodev-rio' class=series_name>��������� ������ Mikrodev</$h>$a2





<table style='  width: 1050px;  margin: auto;'>

<tr ><td valign=top align=center valign=center width=500px bfcolor=#eeeeee>

<div id=dd style='height:300px;'>

$kartinka</div>

<center>

  $min_table</center>

</td><td>

" . '<table width="100%">



<tbody>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">��������� I/O ��� SCADA, PLC, HMI ��� OPC-�������.</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">�������� ������: ������ ������� �����, ����������� �� ���� �������� �� ������</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">��������� IP-���������� MODBUS / TCP, DNP3, IEC 60870-5-104, MODBUS RTU ����� TCP, IEC 60870-5-101 ����� TCP</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">��������� ���������� ���������� MODBUS RTU, DNP3, IEC 60870-5-101, BACNET MS / TP</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">RIO200S, RIO201S � ������ �� ������������ ������� 3�� RS485 / 422 / 232, �������������� ��������</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">RIO200G, RIO201G � ���������� ����� GSM / GPRS; ��������� 850/900/1800/1900 ���; �������� � ����� sms</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">RIO200W, RIO201W � ���������� ����� Wi-Fi; IEEE 802.11 b/g/n</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">RIO200E, RIO201E � ���������� Ethernet; 10/100 ����</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">������� ����������� -10~50&#8451;</td></tr>

<tr><td width="30">' . $tick . '</td><td  class="hl_text">���������� ������� 9~36 VDC </td></tr>

<tr><td width="30">' . $tick . '</td><td class="hl_text">���������������: CE, EN 55011 ( ����� B )</td></tr>

' .

                "</tbody></table>

</td></tr></table>" .

                '

<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">

<div class="submenu_controller" style="  background-color: rgb(219, 207, 207);"><span class="name">������</span> <span style="  width: 669px;">��������������</span></a><span style="width:90px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>

<div style="width: 1050px;  margin: auto;   display: table; ">

<div class="" style="  ">



<div class="co">

<div class="congroup">

<div class="conparams" style="  display: inline-block;">

<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">ETHERNET I/O</span></h3>

</div>

</div>

' . children_menu_mkd('RIO200E') . '

' . children_menu_mkd('RIO201E') . '

</div>



<div class="co">

<div class="congroup">

<div class="conparams" style="  display: inline-block;">

<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">GSM / GPRS I/O</span></h3>

</div>

</div>

' . children_menu_mkd('RIO200G') . '

' . children_menu_mkd('RIO201G') . '

</div>



<div class="co">

<div class="congroup">

<div class="conparams" style="  display: inline-block;">

<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">Wi-Fi I/O</span></h3>

</div>

</div>

' . children_menu_mkd('RIO200W') . '

' . children_menu_mkd('RIO201W') . '

</div>



<div class="co">

<div class="congroup">

<div class="conparams" style="  display: inline-block;">

<h3 class="pan_price"><span style="  color: rgb(121, 89, 89);">SERIAL I/O</span></h3>

</div>

</div>

' . children_menu_mkd('RIO200S') . '

' . children_menu_mkd('RIO201S') . '

</div>



</div></div>

' .

                $about;



        if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {

            $out .= '<br /><br />';

        };

        return $out;

    }



//----------------------PLC



    $out .= show_controllers_mp100_plc();



    $out .= show_controllers_mp200_plc();



    $out .= show_controllers_mp1100_plc();



    $out .= show_controllers_mod_plc();



    $out .= show_controllers_rmod_plc();



//----------------------------------------------------





    $out .= '<br /><br /><br />

<div style="width:90%;margin:auto;">

<div class="head_block"><h2 style="  color: rgb(89, 44, 44);text-shadow: 1px 1px 1px white;  font-size: 15px;">�� ��� Mikrodev</h2></div><br />

<h3>�������� ��������</h3><br />

<a href="/images/controllers/mikrodev/microdiagram.png" rel="lightbox[1]">

<img src="/images/controllers/mikrodev/microdiagram.png" style="float:right;    width: 445px;margin-bottom:30px;"></a>

��� PLC ��������������� � ������� <a href="/soft/Mikrodev/mikrosetup.rar" download>����������� FBD �� Mikrodiagram (�������)</a> ����������� USB2.0-������ (������ � ��������).

<br /><br />

������� ������������ �� Windows XP, Windows Vista, Windows Vista, Windows 8 , Windows 8.1, Macintosh OSX, Linux 3.x.x, Linux 2.6.x.

<br /><br />

��������� ���������� � IEC 61131 (3 ���������).

<br /><br />

3 ������ ������:

<ul style="margin-left:60px;"><li>����� ������������</li>

<li>����� ���������� � ��������� ����������� ������ ��� ����� � PLC</li>

<li>����� ����������� � ��������� ����������� ��������� PLC � �������� �������</li>

</ul>

<br /><br />

������� ���� � ���������� ����������� �� ����-������ PLC.

<br /><br /><br />

<h3>SCADA</h3><br />

<img src="/images/controllers/mikrodev/microdev-scada.png" style="float:left;margin-bottom:20px;    margin-right: 35px;">

�������� Mikrodev Scada ��������� ����� ��������� ������� ���������� ����� �������������� ��������� (drag & drop). � ���������� � ������������ ���������� ���������, ����� ������� ���� �����������. �������� ����� ���� ����������� ����������� ���������� �������. �������� ��������������� ����� ��������� ������������ ������� ��������� � ������� � ������ �������.<br /><br />

������� ������������ ������������� ����������� � ���������� ��������.<br /><br />

Mikrodev Scada ��������� ���������� ��������� ���� �������� ���������� � ����������� ��������� ������. ����� ����������� � ���� ������. ������� ����� ������������� �� ����� ����������. <br /><br />

�������� ������� - ��������� �������� � �������� ������������� ����������.



Mikrodev Scada ������������ ���� MDVScript ��� �������� ����������� � �������� �����.<br /><br />

������ ������� ��������� ��������� ������ � ����������� ����, � ����� ������������ ����� � XML � HTML.<br /><br />

������� ����� ��������������� ����������, �������� MODBUS. <br /><br />

PGSQL � SQLite ���� ������ ����� �������������� ��� ������ ������.

<br /><br />

������������: ���� � ������� ���������� �������. 256 ������� ������� �������������.

<br /><br />

�������������� ������������ �������: Windows XP, Windows 7, Windows 8, Linux<br /><br />

��������� ��������� ����� �������������� � Windows, Linux, MacOS, � ����� ��������� �������� Android � iPhone.

<br /><br />

</div><br />



';





    $out .= "<script type='text/javascript' src='/js/highslide1.js'></script>" . '

<script>

function dich(num,link)

 {

if (link != "0") {

   $("#dd").html("<a id=\"biglightbox\" href=\'"+link+"\' rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"���������\"><img class=\"lupa\" src=\"/images/zoom.png\" /><img src=\'"+num+"\'\"></span></a>");

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

 ' . "

 function v_korzinu1(o)

{

//alert(o.innerHTML);

//alert($(o).attr('idm'));

chosen_item=$(o).attr('idm');

//var x=$(o).position().left-150;

var x=900;

var y=$(o).position().top;

ask_kol(x, y);



}

  " . '

  </script>

 <style>

 .zakazbut3.yes {

  cursor: pointer;

}

.zakazbut3 {

  -moz-box-shadow: inset 0px 1px 0px 0px #ffffff;

  -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;

  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9) );

  background: -moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );

  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#f9f9f9", endColorstr="#e9e9e9");

  background-color: #f9f9f9;

  box-shadow: inset 0px 0px 2px gray;

  border: none;

  position: absolute;

  margin-top: -6px;

padding: 6px 13px 2px 12px;

  margin-left: 972px;

}

.zakazbut3.yes:hover {

  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9) );

  background: -moz-linear-gradient( center top, #e9e9e9 5%, #f9f9f9 100% );

  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#e9e9e9", endColorstr="#f9f9f9");

  background-color: #e9e9e9;

  box-shadow: inset 1px 1px 2px gray;

  padding: 5px 12px 2px 12px;

}

.zakazbut3 img {

  opacity: 0.2;

  margin-bottom: 1px;

  height: 17px;

}

.zakazbut3.yes img {

  opacity: 0.5;

}

.zakazbut3.yes:hover img {

  opacity: 0.8;

  margin-bottom: 0px;

  margin-top: 1px;

}

 #body_cont {  font-family: Verdana, "Lucida Grande";

  font-size: 13px;

  color: black;}

 h1 {  font-size: 17px;}

 .links td {/*text-align:center;*/}

 .congroup {  margin-bottom: 2px; width:1020px; margin: 0px 5px 0px 5px; text-decoration: none;  display: table-cell;  float:left;   padding: 0px 10px;  box-shadow: 1px 1px 4px gray;  background:transparent;   transition: background-color .15s ease-out;}

 a .congroup:hover {  background: whitesmoke;  box-shadow: 1px 1px 4px rgb(73, 73, 73);}

 .congroup h3.pan_price {    width: 100px; float: left;  }

  .congroup span {  float: left;  margin-right: 10px;  width: 369px;}

 .congroup .countc span {width:auto;}

  .congroup div {float:left;}

  .instock {float:left;margin-left:20px;}

  .links {width: 100%;word-wrap: normal;}

  .submenu_controller span {float:left;  color: #666666;font-family: Verdana, "Lucida Grande";

  font-size: 13px;}

  .submenu_controller:hover {

    background: rgb(231, 225, 225);

  outline: 1px solid rgb(184, 172, 172);}

  .submenu_controller:hover .zakazbut3 {outline: 1px solid rgb(184, 172, 172); }

   .submenu_controller:hover span {color: rgb(18, 18, 18);}

  .submenu_controller span.green {  color: rgb(71, 191, 52);  float: initial !important;}

 </style>

  ';

} else {

    $file = $_SERVER['DOCUMENT_ROOT'] . '/plc/mikrodev/products_new.php';

    if (file_exists($file)) {

        include_once($file);

    };

};



//-----------------end content

//echo microtime(true) - $start;

$template_file = 'head_canonical.html';



$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/sc/" . $template_file);

$head = str_replace('[>TITLE<]', $TITLE, $head);

$head = str_replace('[>DESCRIPTION<]', $DESCRIPTION, $head);

$head = str_replace('[>KEYWORDS<]', $KEYWORDS, $head);

$head = str_replace('[>CANONICAL<]', 'http://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);







echo $head;

?>

<div id="mes_backgr"> </div>

<div id="body_cont">

    <? include $_SERVER["DOCUMENT_ROOT"] . "/include_utf_8/header_menu.php"; ?>

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

    //usd_rate();

    search();

    compare();

    backup_call();

    top_buttons();

    basket();

    temp1_no_menu();

    show_price_val();

//temp1();

//left_menu();





    temp2();

    add_to_basket();



    popup_messages();

    echo $out;

    temp3();

    ?>