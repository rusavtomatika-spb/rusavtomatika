<?php

function ewon_modif_decode($r) {
    $ef = $yo = $cpu = $text = $ram = $ports = $vo = $spe = $hdd = $gb = '';
/*    var_dump_pre($r);
    $a = explode("-", $r->model);
    $mod = $a[1];*/
//if ($r->parent == 'IFC-BOX4000') {$cpu = $r->cpu_type.' ';}  else {$cpu ='';};
    if ($r->speakers != "")
        $spe = "�������� ";
    else
        $spe = "";
    if (($r->voltage_min != '') AND ( $r->voltage_max != '0')) {
        if ($r->voltage_min == $r->voltage_max)
            $vo = "$r->voltage_min" . "&nbsp;� ";
        else
            $vo = "$r->voltage_min-$r->voltage_max" . "&nbsp;� ";
    } else {
        $vo = '';
    };
    if (($r->hdd_size_gb != '') AND ( $r->hdd_size_gb != '0')) {
        $gb = '' . $r->hdd_size_gb . ' �� ';
    } else {
        $gb = '';
    };
    if (($r->hdd_type != '') AND ( $r->hdd_type != '0')) {
        $hdd = '' . $r->hdd_type . ' ';
    } else {
        $hdd = '';
    };
    if ($r->model == 'COSY141') {
        $ports = 'SUBD9 ';
    } elseif ($r->model == 'COSY141 MPI') {
        $ports = 'MPI/PROFIBUS ';
    } else {
        $ports = '';
    };
    if ($r->model == 'EC61330') {
        $ports = '4xLAN/WAN, USB, ';
    } elseif ($r->model == 'EC6133C') {
        $ports = '4xLAN/WAN, USB, Wi-Fi, ';
    } elseif ($r->model == 'EC6133D') {
        $ports = '4xLAN/WAN, USB, 3G, ';
    };
    $arrParents = explode(" ", $r->parent);

    if (in_array('FLEXY201', $arrParents) or in_array('FLEXY205', $arrParents)) {
        $text = $r->spec_modif . '';
        if ($r->model != 'FLEXY 201') {
            $vo = '';
        };
        $text = str_replace('<br />', ' ', $text);
        $text = str_replace('<br>', ' ', $text);
    } else {
        $text = '';
    };
    if (($r->ram != '') AND ( $r->ram != '0')) {
        $ram = "RAM " . ($r->ram / 1000) . " �� ";
    } else {
        $ram = '';
    };
    $yo = '';


    if ($r->parent == 'eFive') {
        $efive = array();
        if ($r->model == 'eFive 25') {
            $efi = '50 ������������� �����������,';
        } else if ($r->model == 'eFive 100') {
            $efi = '200 ������������� �����������,';
        };
        if (!empty($r->ethernet)) {
            $efive[] = $r->ethernet;
        };
        if (!empty($r->serial_full)) {
            $efive[] = $r->serial_full;
        };
        if (!empty($r->usb_host)) {
            $efive[] = $r->usb_host;
        };
        $ef = $efi . implode(', ', $efive) . '';
        $hdd = '';
    };

    $out = $ef . $yo . $cpu . $text . $ram . $ports . $vo . $spe . $hdd . $gb;

    return $out;
}

function children_menu_e($num, $link_to_product = "") {
    global $mysqli_db;
    $o = '';
    $sql = "SELECT * FROM `products_all` WHERE `parent` like '%$num%' ORDER BY `sort`, `index` ";
    //echo "<br>";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_num_rows($res);

    if ($r == 0) {
        $sql = "SELECT * FROM `products_all` WHERE `model` = '$num' ";
        $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
        $r = mysqli_num_rows($res);
    };

    if ($r > 0) {
        $o .= '<ul class="submenu_controllers">';
        for ($i = 0; $i < $r; $i++) {
            $row = mysqli_fetch_array($res);
            mysqli_data_seek($res, $i);
            $rr = mysqli_fetch_object($res);

            $outs = array();

            $add = ewon_modif_decode($rr);

            if ($row["onstock"] > '0' OR $row["onstock_spb"] > '0' OR $row["onstock_msk"] > '0' OR $row["onstock_kiv"] > '0') {
                $stock = 'background:url(/images/tick14.png) center center no-repeat;  ';
            } else {
                $stock = '';
            };


            if (($row["retail_price"] != '0') AND ( $row["retail_price"] != '')) {
                $priceb = "<div class=val_name style='float:right;  font-size: 13px;' title='������� ��� ��������� � ���'>EUR </div><div class=prpr style='  font-size: 13px;float: right;margin-right: 5px;' title='������� ��� ��������� � ���'>$row[retail_price]</div>";

                $basket = '<div idm="' . $row[model] . '" class="zakazbut3 yes addToCart" title="� �������"><div>&nbsp;</div></div>';
            } else {
                $priceb = "
<div style='' class='zakazbut init' idm='$row[model]' onclick='show_backup_call(6, \"$row[model]\")' >��&nbsp;�������</div>";
                $basket = '';
            };
            /*
              if (!empty($row['parent'])) {
              $pag = $row['parent'];
              } else {
              $pag = $row['model'];
              }; */
            $pag = $num;
            /*
              if ($row[new_product]) {
              $new_product = "new_product";
              $add = '<span class="new_product_label">�������!</span>' . $add;
              } else {
              $new_product = "";
              } */

            ob_start();
            if ($link_to_product) {
                ?>
                <li><div class="submenu_controller">
                        <a href="/ewon/<?= $link_to_product ?>.php">
                            <span class="name"><?= $row["model"] ?></span>
                            <span style="  width: 695px;"><?= $add ?></span>
                        </a>
                        <span style="width:90px;"><?= $priceb ?></span>
                        <span style="margin-left: 33px;width: 14px; <?= $stock ?>">
                            <span class="green">&nbsp;</span></span><?= $basket ?></div>
                </li>
                <?
            } else {
                ?>
                <li><div class="submenu_controller">
                        <a href="/ewon/<?= $pag ?>.php">
                            <span class="name"><?= $row["model"] ?></span>
                            <span style="  width: 695px;"><?= $add ?></span>
                        </a>
                        <span style="width:90px;"><?= $priceb ?></span>
                        <span style="margin-left: 33px;width: 14px; <?= $stock ?>">
                            <span class="green">&nbsp;</span></span><?= $basket ?></div>
                </li>
                <?
            }
            $o .= ob_get_contents();
            ob_end_clean();
        }
        $o .= '</ul>';
    };
    return $o;
}

function cosy131() {
    $about = '';
    $alt = 'VPN-������ COSY-131';

    $h = 'h2';
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-5188x/A-5188x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-5188x/lg/A-5188x_1.png';
    $im1 = '/images/ewon/vpn-router/COSY131/580/COSY131_1.webp';
    $bim1 = '';
    $kartinka = "
<a href='/ewon/COSY131.php'><img src='$im1' alt='$alt' style='' loading='lazy'></a>";


    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';

    $out = "<br><br>

$a1<$h id='plc-a-51' class=series_name><a style='text-decoration: none;color:#000;' href='/ewon/COSY131.php'>VPN-������ COSY-131</a></$h>$a2


<table style='  width: 1040px;  margin: auto;'>
<tr ><td valign='top' align=center width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>

</td><td>
" . '<table width="100%" style="  margin-top: 20px;">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">������� ����������� � LAN �� �������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">������������ �����������: Wi-Fi, ������� ����</a></td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">���������� ���������� � Firewall</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">������������� ����������� ����� 443 (HTTPS) � 1194 (UDP)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">����������� ��������� VPN-������� ������� ��������������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">USB-���������� ���������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">��������� �� DIN ����� � ������� 24VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">�������� ����������</td></tr>

</tbody></table>

                            <a style="text-decoration:none;font-size:17px;display:block;width:386px;overflow:hidden;padding:15px;background: rgba(0,255,0,0.1); font-weight: bold" href="/video/ewon-cosy-131-vpn-router-bystryy-start-nachalnaya-nastroyka/" >
                            <img src="/images/video/ewon131video.jpg" style="float:right;width: 100px;" />
                            ���������� ����� �� ������� ��������� ������� eWON                                                             
                            </a>
                        

' .
            "
</td></tr></table>" .
            '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="border-top:1px solid #d9d9d9;  background-color: #bce9bc;"><span class="name">������</span> <span style="  width: 705px;">��������������</span></a><span style="width:84px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>
<div style="width: 1040px;  margin: auto;   display: table;">
<div class="" style="  ">

<div class="co">
<div class="congroup">

</div>
' . children_menu_e('COSY131') . '
</div>


</div></div>
' .
            $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function cosy141() {
    $about = '';
    $alt = 'VPN-������ COSY-141';

    $h = 'h2';
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-5188x/A-5188x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-5188x/lg/A-5188x_1.png';
    $im1 = '/images/ewon/vpn-router/COSY141/580/COSY141_1.webp';
    $bim1 = '';
    $kartinka = "
<a href='/ewon/COSY141.php'><img src='$im1' alt='$alt' style='' loading='lazy'></a>";

    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';

    $out = "<br><br>

$a1<$h id='plc-a-51' class=series_name><a style='text-decoration: none;color:#000;' href='/ewon/COSY141.php'>VPN-������ COSY-141</a></$h>$a2


<table style='  width: 1040px;  margin: auto;'>
<tr ><td valign='top' align=center  width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>

</td><td>
" . '<table width="100%" style="  margin-top: 20px;">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">������� ����������� � LAN �� �������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">���������� ���������� � Firewall</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">������������� ����������� ����� 443 (HTTPS) � 1194 (UDP)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">����������� ��������� VPN-������� ������� ��������������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">1 x SUBD9 ���������������� ���� RS232, RS485 ��� MPI/PROFIBUS (12Mbits) �� �����</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">��������� �� DIN ����� � ������� 24VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">�������� ����������</td></tr>

</tbody></table>
<a style="text-decoration:none;font-size:17px;display:block;width:350px;overflow:hidden;padding:15px;background: rgba(0,255,0,0.1); font-weight: bold" href="/video/ewon-cosy-131-vpn-router-bystryy-start-nachalnaya-nastroyka/" >
                        <img src="/images/video/ewon131video.jpg" style="float:right;width: 100px;" />
                        ����� �� ������� ��������� ������� eWON
                    </a>

' .
            "
</td></tr></table>" .
            '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="border-top:1px solid #d9d9d9;  background-color: #bce9bc;"><span class="name">������</span> <span style="  width: 705px;">��������������</span></a><span style="width:84px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>
<div style="width: 1040px;  margin: auto;   display: table;">
<div class="" style="  ">

<div class="co">
<div class="congroup">

</div>
' . children_menu_e('COSY141') . '
</div>


</div></div>
' .
            $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function flexy() {
    $about = '';
    $alt = 'VPN-������ FLEXY';

    $h = 'h2';
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-5188x/A-5188x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-5188x/lg/A-5188x_1.png';
    $im1 = '/images/ewon/vpn-router/FLEXY201/580/FLEXY201_1.webp';
    $bim1 = '';
    $kartinka = "
<a href='/ewon/FLEXY.php'><img src='$im1' alt='$alt' loading='lazy'></a>";

    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';

    $out = "<br><br>

$a1<$h id='plc-a-51' class=series_name><a style='text-decoration: none;color:#000;' href='/ewon/FLEXY201.php'>��������� VPN-������ FLEXY 201</a></$h>$a2


<table style='  width: 1040px;  margin: auto;'>
<tr ><td valign='top' align=center  width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>

</td><td>
" . '<table width="100%" style="  margin-top: 20px;">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">������� ����������� � LAN �� �������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">���������� ���������� � Firewall</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">������������� ����������� ����� 443 (HTTPS) � 1194 (UDP)</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">����������� ��������� VPN-������� ������� ��������������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">3 ������ ����������: Etharnet, 3G, COM</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">��������� �� DIN ����� � ������� 24VDC</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">�������� ����������</td></tr>

</tbody></table>
<a style="text-decoration:none;font-size:17px;display:block;width:350px;overflow:hidden;padding:15px;background: rgba(0,255,0,0.1); font-weight: bold" href="/video/ewon-cosy-131-vpn-router-bystryy-start-nachalnaya-nastroyka/" >
                        <img src="/images/video/ewon131video.jpg" style="float:right;width: 100px;" />
                        ����� �� ������� ��������� ������� eWON
                    </a>

' .
            "
</td></tr></table>" .
            '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="border-top:1px solid #d9d9d9;  background-color: #bce9bc;"><span class="name">������</span> <span style="  width: 705px;">��������������</span></a><span style="width:84px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>
<div style="width: 1040px;  margin: auto;   display: table;">
<div class="" style="  ">

<div class="co">
<div class="congroup">

</div>
' . children_menu_e('FLEXY201') . '
</div>


</div></div>
' .
            $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}

function flexy205() {
    ob_start();
    ?>
    <br><br>
    <div class="head_block" ><h2 id="plc-a-51" class="series_name"><a style="text-decoration: none;color:#000;" href="/ewon/FLEXY205.php">���� IIoT � VPN-������ - FLEXY 205</a></h2></div>
    <table style="width: 1040px;  margin: auto;">
        <tr><td colspan="2">
                <p>������������� ���� ������������� ���������� �����
                    (IIoT) � ������������� � ���������� ���������� �������
                    ��� ������������������ �����������. <b>EWON FLEXY 205</b> ������������
                    ��������� ������ ����� VPN � �������� ��� ��������������
                    ����������� eWON Talk2M,� ����� ��������� ��������
                    ����������� � ��������������, ��������� ������ �����
                    � ������������� ������� ��������������� �����������
                    ������� ��� �������� � ����� ��������� ��������
                    ����������� ������������������ (���), ����������� ���
                    ������� � ����������������� ������������ ������������.</p>
            </td></tr>

        <tr ><td valign="top" align="center"  width="450px" bfcolor="#eeeeee">
                <div id=dd style="height:300px;">
                    <a href="/ewon/FLEXY205.php"><img src="/images/ewon/vpn-router/FLEXY205/580/FLEXY205_7.webp" alt="VPN-������ FLEXY205" loading="lazy"></a>
                </div>
            </td><td>
                <table width="100%" style="  margin-top: 20px;">
                    <tbody>


                        <tr><td class="td_tick"></td><td class="hl_text"><b>�������� ����������:</b> ��������� ���� ������ �� ��������� IIot, ��������� ����������,
                                ��������� ������</td></tr>
                        <tr><td class="td_tick"></td><td class="hl_text">���� IIoT ������������ ����������� ���������� ���</td></tr>
                        <tr><td class="td_tick"></td><td class="hl_text">�������� ����������� � ����: Ethernet, 4G, 3G, WiFi</td></tr>
                        <tr><td class="td_tick"></td><td class="hl_text">������� ������������������ ��������� ������</td></tr>
                        <tr><td class="td_tick"></td><td class="hl_text">������ OPC UA � Modbus</td></tr>
                        <tr><td class="td_tick"></td><td class="hl_text">
                                ��������� �� DIN ����� � ������� 24VDC<br>
                                ���������� � ������� ������ �������� �������� ��� ��������� � ������������������ ����</td></tr>
                        <tr><td class="td_tick"></td><td class="hl_text">������� ��������� ����� ���������� ���-���������</td></tr>
                        <tr><td class="td_tick"></td><td class="hl_text">��������� <a target="_blank" href="/mqtt/">MQTT</a></td></tr>
                        <tr><td class="td_tick"></td><td class="hl_text">SD �����, �������������� �������� ����� � ������������</td></tr>
                    </tbody>
                </table>
                <a style="text-decoration:none;font-size:17px;display:block;width:350px;overflow:hidden;padding:15px;background: rgba(0,255,0,0.1); font-weight: bold" href="/video/ewon-cosy-131-vpn-router-bystryy-start-nachalnaya-nastroyka/" >
                    <img src="/images/video/ewon131video.jpg" style="float:right;width: 100px;" />
                    ����� �� ������� ��������� ������� eWON
                </a>
            </td>
        </tr>
    </table>
    <div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
        <div class="submenu_controller" style="border-top:1px solid #d9d9d9;  background-color: #bce9bc;"><span class="name">������</span> <span style="  width: 705px;">��������������</span></a><span style="width:84px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>
    <div style="width: 1040px;  margin: auto;   display: table;">
        <div class="" style="  ">

            <div class="co">
                <div class="congroup">

                </div>
                <? echo children_menu_e('FLEXY205'); ?>
            </div>
        </div>
    </div>
    <?
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
}

function efive() {
    $about = '';
    $alt = 'VPN-������ eFive';

    $h = 'h2';
//$min_table=mini_controllers('A-61', 5, 10, 350);
//$im1 = 'images/controllers/yottacontrol/A-5188x/A-5188x_1.png';
//$bim1 = 'images/controllers/yottacontrol/A-5188x/lg/A-5188x_1.png';
    $im1 = '/images/ewon/vpn-router/eFive/580/eFive_1.webp';
    $bim1 = '';
    $kartinka = "
<img src='$im1' alt='$alt' style=''>";
    $kartinka = "
<a href='/ewon/eFive.php'><img src='$im1' alt='$alt' style='' loading='lazy'></a>";

    $a1 = '<div class="head_block" >';
    $a2 = '</div>';

    $tick = '<img src="/images/tick.png" width="15"> ';

    $out = "<br><br>

$a1<$h id='plc-a-51' class=series_name><a style='text-decoration: none;color:#000;' href='/ewon/eFive.php'>VPN-������� eFive</a></$h>$a2


<table style='  width: 1040px;  margin: auto;'>
<tr ><td valign='top' align=center  width=450px bfcolor=#eeeeee>
<div id=dd style='height:300px;'>
$kartinka</div>
</td><td>
" . '<table width="100%" style="  margin-top: 20px;">

<tbody>
<tr><td width="30">' . $tick . '</td><td class="hl_text">��������� SCADA ������ �� ������������ � �������� ������� ����� ��������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">���������� �� 200 PLC, HMI � ��. ��������� ����� 1 ������ eFive</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">����������� ������������� ����������: PPI, MPI, Profibus, ISO TCP, DF1, EtherNet/IP, Modbus RTU, Modbus TCP, FINS Hostlink, FINS TCP � ��.</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">50 / 200 ������������ ������������ VPN-�������� eWON</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">������ ���������� ��������� <br />� ������� �������</td></tr>
<tr><td width="30">' . $tick . '</td><td class="hl_text">���������� VPN-����������</td></tr>
</tbody></table>

' .
            "
</td></tr></table>" .
            '
<div style="width: 1040px;  margin: auto;  margin-top: 30px; display: table;">
<div class="submenu_controller" style="border-top:1px solid #d9d9d9;  background-color: #bce9bc;"><span class="name">������</span> <span style="  width: 705px;">��������������</span></a><span style="width:84px;">���� � ���</span><span style="margin-left: 7px;">�������</span></div></div>
<div style="width: 1040px;  margin: auto;   display: table;">
<div class="" style="  ">

<div class="co">
<div class="congroup">

</div>
' . children_menu_e('eFive') . '
</div>


</div></div>
' .
            $about;

    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        $out .= '<br /><br />';
    };
    return $out;
}
