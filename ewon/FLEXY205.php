<?php
session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include("../sc/lib_new.php");
include("../sc/vars.php");
//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));
global $mysqli_db;

database_connect();


$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);
//echo $_SERVER['QUERY_STRING'];
$CANONICAL = $var_to_array;

//---------------content ---------------------


$blockI = $blockM = $blockX = $blockB = $blockA  = 0;


$num = "FLEXY205";
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);


$title = 'EWON Flexy 205, ���� ������������� ��������� ����� (IIoT) � VPN-������';
$keywords = ', ���� IIoT, ������������, VPN, ������, eWON, Flexy, vpn-������, ��������, ����������, ���������, ������, ������������';
$description = 'eWON Flexy 205 - ��� ������������� ���� ������������� ���������� ����� (IIoT) � ������������� � ���������� ���������� ������� ��� ������������������ �����������.';
$vars = show_pc_variants($num);

$nav = '<br /><nav><a href="/">�������</a>&nbsp;/&nbsp;<a href="/ewon/">eWON VPN-������� � VPN-�������</a>&nbsp;/&nbsp;EWON FLEXY 205, ���� IIoT � VPN-������</nav>';
/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;��� ����� 4 ���.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;���� �� �������: ���, ���, ����</div>";
 */

$onst = show_stock($r, 1);

//$min_table = miniatures($num, 5, 10, 350); // mins_in_row, mins_max, table_width
//$im1 = get_big_pic($num);
$alt = get_kw("alt");


//echo "!!!!!!!!!!!!!!!!!" . $num;
//-----------------end content


$template_file = 'head_canonical.html';
//$head = head($template_file, $title, $description, $keywords, '<link rel="stylesheet" type="text/css" href="/ewon/ewon_styles.css" />', '<script type="text/javascript" src="/ewon/ewon_scripts.js"></script>');
$imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";
ob_start();?>


<meta property='og:title' content='<?=$title?>' />
<meta property="og:image" content="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>" />
<meta property='og:site_name' content='�������������' />
<link rel='image_src' href="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>">

<?$expansionParam = ob_get_clean();

//$head = head($template_file, $title, $description, $keywords);
$head = setHeaderExpansionParam($template_file, $title, $description, $keywords, '<link rel="stylesheet" type="text/css" href="/ewon/ewon_styles.css" />', '<script type="text/javascript" src="/ewon/ewon_scripts.js"></script>', $expansionParam);

$head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);

echo $head;
?>
    <link rel="stylesheet" type="text/css" href="/ewon/template_style.css"/>
    <div id="mes_backgr"></div>
    <div id="body_cont">
<? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width="100%" bgcolor="white">
        <tr height="93">
            <td width="300px">
                <a href="/"><img src="/images/logo2017.png"/></a>
            </td>
            <td></td>
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
add_to_basket();
popup_messages();
temp2();


$name = 'EWON FLEXY 205';
$type = '���� IIoT � VPN-������';
ob_start();
include dirname(__FILE__) . '/templates/price_block.php';
echo ob_get_clean();
?>


    <div id=cont_rp>

        <br>
        <table width=100%>

            <tbody>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text"><b>�������� ����������:</b> ��������� ���� ������ �� ��������� IIot, ���������
                    ����������,
                    ��������� ������
                </td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">���� IIoT ������������ ����������� ���������� ���</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">�������� ����������� � ����: Ethernet, 4G, 3G, WiFi</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">������� ������������������ ��������� ������</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">������ OPC UA � Modbus</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">
                    ��������� �� DIN ����� � ������� 24VDC<br>
                    ���������� � ������� ������ �������� �������� ��� ��������� � ������������������ ����
                </td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">������� ��������� ����� ���������� ���-���������</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">��������� <a target="_blank" href="/mqtt/">MQTT</a></td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">SD �����, �������������� ��� �������� ����� � ������������</td>
            </tr>
            </tbody>
        </table>
        <a style="text-decoration:none;font-size:17px;display:block;width:350px;overflow:hidden;padding:15px;background: rgba(0,255,0,0.1); font-weight: bold"
           href="/video/ewon-cosy-131-vpn-router-bystryy-start-nachalnaya-nastroyka/">
            <img src="/images/video/ewon131video.jpg" style="float:right;width: 100px;"/>
            ����� �� ������� ��������� ������� eWON
        </a>
    </div>
    </td></tr></table>
    <style>
        #rou_desc {
            text-align: justify;
            width: 100%;
            font-family: Verdana, 'Lucida Grande';
            font-size: 14px;

        }

        #dd {
            text-align: center;
        }

        #dd img {
            max-height: 300px;
            max-width: 400px;
        }

        h2 {
            font-size: 14px;
            color: gray;
            margin: 17px 10px 12px 10px;
        }

        .com_about {
            width: 200px;
            float: left;
        }

        .scheme {
            width: 600px;
            float: right;
        }

        .com {
            color: gray;
            margin-bottom: 50px;
        }

        .scheme table tr td {
            border: 1px solid gray;
            padding: 3px 15px;
            font-size: 11px;
        }

        .gray {
            background-color: rgb(245, 245, 245);
        }

        .image-right {
            float: right;
            margin: 0 0 20px 20px;
            transition: 0.3s;
        }

        a .image-right {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transform: scale(0.98);
        }

        a:hover .image-right {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            transform: scale(1);
        }

        .open_big {
            transition: 0.3s;
        }

        a .open_big {
            transform: scale(0.98);
        }

        a:hover .open_big {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            transform: scale(1);
        }

    </style>
    <br><br>
    <div id=rou_desc>
        <p>
            <a href="/images/ewon/FLEXY205/article-ewon-flexy205.png" rel="lightbox">
                <img class="image-right" src="/images/ewon/FLEXY205/article-ewon-flexy205_sm.png"/>
            </a>
            eWON Flexy 205 - ��� ������������� <b>���� ������������� ���������� �����
                (IIoT)</b> � <b>�������������</b> � ���������� ���������� ������� ��� ������������������ �����������.
            �� ������������ <b>��������� ������</b> ����� <b>VPN</b> � �������� ��� �������������� ����������� eWON
            Talk2M, � ����� ��������� ��������
            ����������� � ��������������, ��������� ������ ����� � ������������� ������� ��������������� �����������
            ������� ��� �������� � ����� ��������� �������� ����������� ������������������ (���), ����������� ���
            ������� � ����������������� ������������ ������������.</p>
        <p>������ � ����� ��������� �� ����� ���� ����������� �������� ���������� ����������� �����������
            ������������ �� ���� ��������� �������������� ���� ���������� ��� ������� ��� � ���������� �� ����
            �������������. �� ������ ������� ��� ��������� ������� ��� �������������������, ��������� ��� ����������.
            ����� ����, ���������� ����������� ���������� ������ � ����������� ������� ��� �������� ��������� � �������
            ���������� ����������� ���������������� Talk2M (API), �������� �������� HTTPs ��� <b>MQTT</b> � ���������
            ������
            �������������� ����������.</p>
        <p>������� ��������������� ��������� ������������ �������������� ������, ���������� �������� ��������,
            ��������, �� ������ ��������� ������, �� � <b>���� ������</b>. � �� �� ����� ������������ ��������������
            �������
            ������ ����� ���������� ����������, ����� ���������� � ������������������ ����. ��������� <b>��������
                ������������ ���� ����������</b>
            � <b>������������� � ���</b> ������� ������� ��� ���������� �������� ��������� ������ IIoT ���
            ������������������ �����������.</p>
        <p>����� ����, HMS � eWON ����� ������������ � ���������� � ����� ������������ ����������� ��� IIoT, �����
            ���������� ��������� �������,
            ���������� � �������������� ������� ��� �������� ������������������, ���������� �������, ������� ����������
            � ������������ ������������ � ���������� ������������ ������, ���������� �� ������������ ������������. ���
            ����������� ����������� ����������� ��� IIoT ����������� � ����������� ��� ������������� �
            eWON Flexy 205.</p>
    </div>

<?
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
 ";
?>
    <br><span class=big_pan_name><b>��������� �����������:</b></span> <br><br>
<?
echo $vars;

//---------------------end tab1 -------------------------
//-------------spec ---------------------------
?><br><br>
    <div class="tabs_wrapper" style='width:100%; min-height: 500px; overflow: auto; '>
    <div id='tabs'>
        <ul>
            <li class='urlup' data='functions'><a href='#tabs-1'>��������������</a></li>
            <li class='urlup' data='dimensions'><a href='#tabs-2'>��������</a></li>

            <li class='urlup' data='software'><a href='#tabs-4'>�������</a></li>
            <li class='urlup' data='accessories'><a href='#tabs-5'>������</a></li>
        </ul>
        <div id='tabs-1'>
            <h2>����������� �������������� <?= $r->model ?></h2>


            <div style='width:90%;'>

                <br/>
                <span class=hpar>���������</span><br>
                <table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>
                    <tr>
                        <td class=par_name1>����������</td>
                        <td class=par_val1>4 x RJ45 Ethernet 10/100 Mb . ������������� LAN/WAN �����, ���� 1 ������
                            LAN
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>�������������</td>
                        <td class=par_val1>����� LAN � WAN Ethernet � ���� ����� Ethernet � COM</td>
                    </tr>
                    <tr>
                        <td class=par_name1>������������� ����� Ethernet � COM</td>
                        <td class=par_val1>
                            MODBUS TCP -> MODBUS RTU;<br> XIP -> UNITELWAY;<br> EtherNet/IP� -> DF1;<br>
                            FINS TCP -> FINS Hostlink;<br>ISO TCP -> PPI, MPI (S7) ��� PROFIBUS (S7);<br>
                            VCOM -> ASCII
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>��������� ������ �������</td>
                        <td class=par_val1>OPC UA, Modbus, MQTT, SNMP</td>
                    </tr>
                    <tr>
                        <td class=par_name1>�������</td>
                        <td class=par_val1>
                            ����������� �� email, SMS, FTP, SNMP. 4 ������: low, lowlow, high, highhigh + deadband and
                            activation delay. ������� ������� �� http � ����� FTP, ���� �������: ALM, RTN, ACK and END
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>������� �������</td>
                        <td class=par_val1>���������� ���� ��� ������ ������, 1 ���. ��������� �����. ������� �������
                            ����� FTP ��� E-mail.
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>���������� ��� ������ ���� ������</td>
                        <td class=par_val1>SD card (������� ���� � ������������,
                            ��������, ���������, ����������� Talk2M)
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>������</td>
                        <td class=par_val1>IP ����������, IP ����������, NAT, ������, ������� �������������, DHCP
                            ������
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>VPN �������</td>
                        <td class=par_val1>Open VPN 2.0 ����� SSL UDP ���� HTTPS</td>
                    </tr>
                    <tr>
                        <td class=par_name1>VPN ������������</td>
                        <td class=par_val1>
                            ������ VPN ������ �������� �� ������������� SSL/TLS ��� �������������� ������ � IPSec ESP
                            �������� ��� ����������� ������������� ������� �� UDP. ��� ������������
                            X509 PKI ( �������������� ���������� ����� ) ��� �������������� ������, TLS ������� ���
                            ������ �������, �����-����������� EVP (DES, 3DES, AES, BF ) ���������
                            ��� ���������� ������ �������, � HMAC-SHA1 �������� ��� �������������� ������ �������.
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>�������������</td>
                        <td class=par_val1>���������� ���� ��������� �������, ������ ��������� �� http,
                            ���� �������������� �� NTP
                        </td>
                    </tr>
                    <tr>
                        <td class="par_name1">���������� �������</td>
                        <td class="par_val1">FTP ������ � ������ ��� ������������, ���������� �������� � ��������
                            ������
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>���������� ��� ���������</td>
                        <td class=par_val1>���������� ��� ��������� � ��������� �������� ��� ������������ � ������������
                            (�� ����� �������������� �� ) ������� �������������� ( �����/������) � �������� ������ ���
                            ������������. �������� ������� ���������������� �������� �
                            � �����������.
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>������������</td>
                        <td class=par_val1>SNMP V1 � MIB2, ���� �� FTP</td>
                    </tr>
                    <tr>
                        <td class=par_name1>����� ����� ������</td>
                        <td class=par_val1>2xDI (0-12/24VDC, �������� 1.5kV), 1xDO (�������� ��������� MOSFET 200mA,
                            �������� 1.5kV)
                        </td>
                    </tr>
                </table>

                <br><br>


                <span class=hpar>�����������</span><br>
                <table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>
                    <tr>
                        <td class=par_name1>�������� �������</td>
                        <td class=par_val1>�������</td>
                    </tr>
                    <tr>
                        <td class=par_name1>������ ����������</td>
                        <td class=par_val1>����������������</td>
                    </tr>
                    <tr>
                        <td class=par_name1>�������� ���������</td>
                        <td class=par_val1>�� ��� ����� EN50022-�����������</td>
                    </tr>
                    <tr>
                        <td class=par_name1>������ �������</td>
                        <td class=par_val1>��������</td>
                    </tr>
                    <tr>
                        <td class=par_name1>���������� �������</td>
                        <td class=par_val1>12-24 VDC +/-20%,</td>
                    </tr>
                    <tr>
                        <td class=par_name1>������������ ��������</td>
                        <td class=par_val1>����������� ������� �� ������������� ���� ����������</td>
                    </tr>
                    <tr>
                        <td class=par_name1>��������</td>
                        <td class=par_val1>133x122x55 ��(� x � x � )</td>
                    </tr>
                    <tr>
                        <td class=par_name1>���</td>
                        <td class=par_val1>280�� (��� ���� ����������)</td>
                    </tr>
                    <tr>
                        <td class=par_name1>������� �����������</td>
                        <td class=par_val1>-25&deg ~ +70&deg</td>
                    </tr>
                    <tr>
                        <td class=par_name1>����������� ��������</td>
                        <td class=par_val1>-40&deg ~ +70&deg</td>
                    </tr>
                    <tr>
                        <td class=par_name1>������������� ���������</td>
                        <td class=par_val1>�� 10 �� 95% (��� �����������)</td>
                    </tr>

                </table>
            </div>


        </div>
        <?
        if ($GLOBALS["net"] == 0) {
            $file = $path_to_real_files . '/images/ewon/dim/FLEXY205.png';
            if (file_exists($file)) {
                $yes = 1;
            }
        } else {
            $file = $root_php . '/images/ewon/dim/FLEXY205.png';
            $re = cu($file);
            if ($re[0] > 0) {
                $yes = 1;
            };
        };
        if ($yes == 1) {
            ?>
            <div id='tabs-2' style=''>
            <h2>�������� <?= $r->model ?></h2>
            <img src='/images/ewon/dim/FLEXY205.png'>
            </div><? } else {
            ?>
            <div id='tabs-2'>
                �������� 55�133�122 ��
            </div><?
        };


        //---------------------download section -------------------------------- ------------------------------
        $file = 'install/Flexy205.pdf';

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
 <tr><td><div class=down_item>���������� �� ��������� �������� ������ Flexy205</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/Flexy205.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft7 = '';
        };

        $file = 'manuals/Flexy205.pdf';
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
 <tr><td><div class=down_item>������� (datasheet) Flexy 205</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/manuals/Flexy205.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
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


        /**/
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
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLX3401  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLX3401.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft11 = '';
        };
        /**/

        /* FLB3271.pdf */
        $file = 'install/FLB3271.pdf';
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
            $soft11 .= "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLB3271  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLB3271.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        }
        /**/
        /* FLB3204.pdf */
        $file = 'install/FLB3204.pdf';
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
            $soft11 .= "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLB3204  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLB3204.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        }
        /**/
        /**/
        /* FLC3701.pdf */
        $file = 'install/FLC3701.pdf';
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
            $soft11 .= "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLC3701</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLC3701.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        }
        /**/
        /* FLB3204.pdf */
        $file = 'install/FLB3204.pdf';
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
            $soft11 .= "
 <tr><td><div class=down_item>���������� �� ��������� ����� ���������� Flexy FLB3204  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLB3204.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        }
        /**/


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
        ?>
        <div id='tabs-4'>
            <div class=connectors>
                <h2>����� ��� ������ � <?= $r->model ?></h2><br/><br/>
            </div>

            <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
                <tr>
                    <td>
                        <div class=down_h> ������������</div>
                    </td>
                    <td>
                        <div class=down_h> ����, ������</div>
                    </td>
                    <td>
                        <div class=down_h> ������</div>
                    </td>
                </tr>


                <?
                echo $soft8;
                echo $soft9;
                echo $soft7;
                echo $soft5;
                echo $soft1;
                echo $soft2;
                echo $soft3;
                echo $soft11;
                echo $soft12;
                ?>

            </table>

        </div>

        <div id="tabs-5">
            <br/><br/>
            <h3>�����-����������</h3>


            <table class="mytab2">
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-2.png"/>
                    </td>
                    <td width="10%"><b>FLX 3101</b></td>
                    <td>����� ���������� Ethernet ��� eWON Flexy ������ WAN Ethernet ��� ����������� �������������
                        ������������ � ���������.

                    </td>
                    <td><a href="/install/FLX3101.pdf">���������� �� ��������� � PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-3.png"/>
                    </td>
                    <td><b>FLB 3202</b></td>
                    <td>����� ���������� 3G ��� eWON Flexy Pentaband ����� ��� ����� � �������������� 2G, 3G ��� 3G +
                        ���� ������� ����� �� 7,3 ��/��� ��� ���������� � 2 ��/��� ��������.
                    </td>
                    <td><a href="/install/FLB3202.pdf">���������� �� ��������� � PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-1.png"/>
                    </td>
                    <td><b>FLA 3301</b></td>
                    <td>����� ���������� 1*RS232/422/485+1*RS232 ��� eWON Flexy ������� ���������������� ���� ���
                        ����������� ����� RS232/485/422 ���������, ����������� ���������� ������� ��� ����� ������ �
                        �������������� ��������� ���������� eWON Flexy I/O.
                    </td>
                    <td><a href="/install/FLA3301.pdf">���������� �� ��������� � PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-7.png"/>
                    </td>
                    <td><b>FLX 3401</b></td>
                    <td> I/O-����� 8 x DI (0~10 VDC - 16 bits) ����. 4 x AI (0~12/24 VDC) ����. 2 x DO (3A/34V VAC/VDC)
                        ����.
                    </td>
                    <td><a href="/install/FLX3401.pdf">���������� �� ��������� � PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-FLB-3271.png"/>
                    </td>
                    <td><b>FLB 3271</b></td>
                    <td>����� ���������� WiFi 802.11 b,g,n WiFi/WLAN</td>
                    <td><a href="/install/FLB3271.pdf">���������� �� ��������� � PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-FLB-3204.png"/>
                    </td>
                    <td><b>FLB 3204</b></td>
                    <td>����� ���������� 4G LTE ����������� � WWW ����� �������� ���������. �������: 4G: B7(2600),
                        B1(2100), B3(1800), B8(900), B20(800)MHz 3G: B1(2100), B8(900) MHz 2G: B3(1800), B8(900) MHz
                    </td>
                    <td><a href="/install/FLB3204.pdf">���������� �� ��������� � PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-FLB-3601.png"/>
                    </td>
                    <td><b>FLB 3601</b></td>
                    <td>����� ���������� 3 USB ����� ��� A (����)</td>
                    <td><a href="/install/FLB3601.pdf">���������� �� ��������� � PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-FLC-3701.png"/>
                    </td>
                    <td><b>FLC 3701</b></td>
                    <td>����� ���������� MPI ������ SUBD9 (����). ��� ������ ����������� �� ��������� MPI.</td>
                    <td><a href="/install/FLC3701.pdf">���������� �� ��������� � PDF</a></td>
                </tr>

            </table>
        </div>
        <br/><br/></div><br/><br/>
<?
//echo $outs;

if (!empty($_GET['tab'])) {
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
}
;
?>

<?
/**/
echo "</article></div>";
temp3();
?>