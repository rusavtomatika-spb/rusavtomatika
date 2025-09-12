<?php
session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/series_MT8000XE.png",
    "openGraph_title" => "Панели оператора Weintek серия MT8000XE",
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
//---------------content ---------------------

include 'inc_functions.php';
echo "<div class='block_content'>";
?>
    <div>
        <nav>
            <a href="/">Главная</a>&nbsp;/&nbsp;<a href="/weintek/">Панели оператора, панельные компьютеры и мониторы Weintek</a>&nbsp;/&nbsp;Панели оператора Weintek серия MT8000XE
        </nav>
    </div>

<?
echo "<article>";
show_weintek_series(
        'MT8000XE', 'Панели оператора Weintek серия MT8000XE', $link = '', $text = "Сенсорные панели оператора серии MT8000XE появились в 2013 году. Отличительными особенностями этой серии операторских панелей Weintek являются быстрый процессор Cortex A8, с тактовой частотой 1 ГГц, графический сопроцессор, ускоряющий до 15 раз загрузку страниц, насыщенных графикой, новый дизайн (более светлые цвета и компактный корпус), гальваническая изоляция всех портов, а также влагозащитное покрытие платы. С 2016 года во все панели серии XE добавлена поддержка протокола <a href='/mqtt/'>MQTT</a>.", true
);
echo "</article></div>";
//show_series_xe();


temp3();
?>