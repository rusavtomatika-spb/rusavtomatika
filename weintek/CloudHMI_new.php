<?php
session_start();
define("bullshit", 1);
include("../sc/dbcon.php");
include("../sc/lib_new.php");
include("../sc/vars.php");

database_connect();
mysql_query("SET NAMES 'cp1251'");

//---------------content ---------------------


$outs = "";


$file = 'soft/EasyAccess/version.txt';

if ($GLOBALS["net"] == 0) {
    $ver = file_get_contents($root_php . $file);
} else {
    $ver = cu_content($root_php . '/' . $file);
};

$so = '/soft/cMTViewer/cMTViewer.zip';
$v = '/soft/cMTViewer/cMTViewer.txt';

if ($GLOBALS["net"] == 0) {

    if (file_exists($path_to_real_files . $v)) {
        $ver = file_get_contents($path_to_real_files . $v);
    };
    $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
    $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
} else {

    $ver = cu_content($root_php . $v);
    $re1 = cu($path_to_real_files . $so);
    $tso = date("d-m-Y", $re1[1]);
    $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
};

if ($fsso > 1000) {
    $sso = round($fsso / 1000, 2) . '&nbsp;��';
} else {
    $sso = round($fsso, 0) . '&nbsp;��';
};


$outs .= "<center><table width=90%>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_panel1("cMT-G01");
$outs .= "</td><td align=center valign=top>";
$outs .= show_panel1("cMT-G02");   // end row
$outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_panel1("cMT-HDMI");
$outs .= "</td><td align=center valign=top>";
$outs .= show_panel1("cMT-SVR-100");   // end row
$outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_panel1("cMT3072");
$outs .= "</td><td align=center valign=top>";
$outs .= show_panel1("cMT3090");   // end row
$outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_panel1("cMT-iV5");
$outs .= "</td><td align=center valign=top>";
$outs .= show_panel1("cMT-iPC10");   // end row
$outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_panel1("cMT3103");
$outs .= "</td><td align=center valign=top>";
$outs .= show_panel1("cMT-iPC15");   // end row
$outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_panel1("cMT3151");
$outs .= "</td><td align=center valign=top>";
//$outs .= show_panel1("");   // end row
$outs .= "</td></tr>

</table></center><br />";
$outs .= '';
$template_file = 'head.html';
$title = 'cMT ����� Weintek: ������ ���������, �������� ����������, ����� ������, ��������� ����������, ������������ ��������, ������ ��������� ����������';
$keywords = '������������, HMI, Cloud, Weintek, cMT-iV5, cMT-SVR, Cortex A9, ��������, ���������, ������, ����������, ���������, ���������, ������, ������������';
$description = 'Cloud HMI, �������� ��������� Weintek, �������������� ������ ������������ ������ �������������� ���������� 3-� ��������� � ������ �����, ���������� � iPad, Android-��������� � PC, ���������� ���������� ���������, �������� �����������, ������������� ������';

$head = head($template_file, $title, $description, $keywords);

echo $head;
?>
    <div id='mes_backgr'></div>
    <div id='body_cont'>
<? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width='100%' bgcolor='white'>
        <tr height='93'>
            <td width='300px'>
                <a href="/"><img src="/images/logo2017.png"/></a>
            </td>
            <td></td>
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
add_to_basket();
popup_messages();

temp2();
echo "<article><div class='block_content'>";
/*     * ******************************** */
?>������:
    <h1>Weintek ����� cMT: ������ ���������, �������� ����������, ����� ������, ��������� ����������, ������������ ��������, ������ ��������� ����������</h1>


    <div class="color_text_block"  style="text-align: center;">
        <strong>����� cMT</strong> - �������� ������������� ����� � ������� ��������� Weintek.
        � ��� � ������ �� ������ ����� ����������� ������ (���������� ������ �������� ������������ � ������ ������ ������������ ���������),
        �� ����� ����� �������� ���: ����� ������, �������� �������, ��������� ����������, ��������������� �����������.
    </div>
    <div style="text-align: center;margin-top: 27px;">
    <ul id="table_of_contents"  style="text-align: center;">
        <li><a href="#anchor_hmi">������ ��������� <span>&#8681</span></a></li>
        <li><a href="#anchor_cloud_hmi">�������� ���������� <span>&#8681</span></a></li>
        <li><a href="#anchor_panel_pc">��������� ���������� <span>&#8681</span></a></li>
        <li><a href="#anchor_monitor">�������� <span>&#8681</span></a></li>
        <li><a href="#anchor_Gateway">����� <span>&#8681</span></a></li>
        <li><a href="#anchor_monitor_cloud_hmi">������ ���. ���������� <span>&#8681</span></a></li>
    </ul>
    </div>

    <br>
    <h2 id="anchor_hmi" class='h2_style1'>������ ���������</h2>
<?
$component->show(array(
    "component_name" => "news.list",
    "component_template" => "main_page_type",
    "template_arguments" => array()),
    array(
        "table" => "products_all",
        "brand" => "Weintek",
        "type" => "hmi",
        "series" => "cMT",
        "order" => "diagonal",
    ));

?>
    <h2 id="anchor_cloud_hmi" class='h2_style1'>�������� ����������</h2>
<?
$component->show(array(
    "component_name" => "news.list",
    "component_template" => "main_page_type",
    "template_arguments" => array()), array(
    "table" => "products_all",
    "brand" => "Weintek",
    "type" => "cloud_hmi",
    "series" => "cMT",
    "order" => "index",
    "order_direction" => "DESC",
));

?>
    <h2 id="anchor_panel_pc" class='h2_style1'>��������� ����������</h2>
<?
$component->show(
    array(
        "component_name" => "news.list",
        "component_template" => "main_page_type",
        "template_arguments" => array()),
    array(
        "table" => "products_all",
        "brand" => "Weintek",
        "type" => "panel_pc",
        "series" => "cMT",
        "order" => "diagonal",
    ));
?>
    <h2 id="anchor_monitor" class='h2_style1'>��������</h2>
<?
$component->show(array(
    "component_name" => "news.list",
    "component_template" => "main_page_type",
    "template_arguments" => array()), array(
    "table" => "products_all",
    "brand" => "Weintek",
    "type" => "monitor",
    "series" => "cMT",
    "order" => "diagonal",
));
?>
    <h2 id="anchor_Gateway" class='h2_style1'>�����</h2>
<?
$component->show(array(
    "component_name" => "news.list",
    "component_template" => "main_page_type",
    "template_arguments" => array()), array(
    "table" => "products_all",
    "brand" => "Weintek",
    "type" => "Gateway",
    "series" => "cMT",
    "order" => "index",
    "order_direction" => "DESC",
));
?>
    <h2 id="anchor_monitor_cloud_hmi" class='h2_style1'>������ ��������� ����������</h2>
<?
$component->show(array(
    "component_name" => "news.list",
    "component_template" => "main_page_type",
    "template_arguments" => array()), array(
    "table" => "products_all",
    "brand" => "Weintek",
    "type" => "monitor_cloud_hmi",
    "series" => "cMT",
    "order" => "index",
    "order_direction" => "DESC",
));

echo "</div></article>";
/*     * ******************************** */
temp3();
?>