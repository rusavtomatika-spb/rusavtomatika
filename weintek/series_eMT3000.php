<?php
session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/series_eMT3000.png",
    "openGraph_title" => "Панели оператора Weintek серия eMT3000",
    "openGraph_siteName" => "Русавтоматика"
);
global $mysqli_db;
database_connect();
mysqli_query($mysqli_db,"SET NAMES 'cp1251'");

temp0("weintek");
top_buttons();
basket();
temp1_no_menu();
show_price_val();
//temp1();
//left_menu();

add_to_basket();
popup_messages();

temp2();
echo "<div class='block_content'>";
echo "<article>";
?>
<div>
    <nav>
        <a href="/">Главная</a>&nbsp;/&nbsp;<a href="/weintek/">Панели оператора, панельные компьютеры и мониторы Weintek</a>&nbsp;/&nbsp;Панели оператора Weintek серия MT8000XE
    </nav>
</div>

<?
//---------------content ---------------------
include 'inc_functions.php';
show_weintek_series(
        'eMT3000', 'Панели оператора Weintek серия eMT3000', $link = '', $text = "Панели оператора Weintek серии eMT3000 появились в 2012 году. Отличительными особенностями этой серии по сравнению с сериями MT6000i и eMT8000i является более быстрый процессор, увеличенный объем ОЗУ и флэш-памяти, алюминиевый корпус, интерфейс CAN. Операторская панель Weintek eMT3070A имеет расширенный диапазон рабочих температур (от -20&#8451;). Также панели оператора этой серии программируется более новым ПО EasyBuilder Pro.", true
);
//show_series_emt();

echo "</article></div>";
temp3();
?>