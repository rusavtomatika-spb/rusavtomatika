<?php
//$start = microtime(true);
//session_start();
define("bullshit", 1);
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/iecon.png",
    "openGraph_title" => "Modbus модули ввода-вывода IECON",
    "openGraph_siteName" => "Русавтоматика"
);

include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_controllers.php");

database_connect();
mysql_query("SET NAMES 'cp1251'");
$TITLE = "Mодуль ввод-вывод IECON c Modbus, заказать в Москве и Санкт-Петербурге, доставка России";
$KEYWORDS = "Modbus, модули ввода-вывода, IECON";
$DESCRIPTION = "Универсальные модули ввода-вывода поддерживающие протокол MODBUS";

//---------------content ---------------------


$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);

$CANONICAL = $var_to_array;

$var_to_array = str_replace(".php", "", $var_to_array);

if (preg_match('/\/$/i', $var_to_array)) {
    $var_to_array = substr($var_to_array, 0, -1);
};

$var_array = explode("/", $var_to_array);

$levels = count($var_array);
$levels = $levels - 1;


$file = $_SERVER['DOCUMENT_ROOT'] . '/modules/products_new.php';
if (file_exists($file)) {
    include_once($file);
};



$out .= '</div>';

//-----------------end content
//echo microtime(true) - $start;

$template_file = 'head_canonical.html';
$head = head($template_file, $TITLE, $DESCRIPTION, $KEYWORDS);
$head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);



echo $head;
?>
<div id='mes_backgr'> </div>
<div id='body_cont' >
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width='100%' bgcolor='white'><tr height='93'><td width='300px'>
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
//show_price_val();
    add_to_basket();
    popup_messages();

    temp2();
    echo "<article>";
    echo $out;
    echo "</article>";
    temp3();
    ?>