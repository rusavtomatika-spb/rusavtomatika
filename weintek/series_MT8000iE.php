<?php
session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");
global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/series_MT8000iE.png",
    "openGraph_title" => "Панели оператора Weintek серия MT8000iE",
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
            <a href="/">Главная</a>&nbsp;/&nbsp;<a href="/weintek/">Панели оператора, панельные компьютеры и мониторы Weintek</a>&nbsp;/&nbsp;Панели оператора Weintek серия MT8000iE
        </nav>
    </div>
<?

echo "<article>";
show_weintek_series(
        'MT8000iE', 'Панели оператора Weintek серия MT8000iE', $link = '', $text = "Сенсорные панели оператора Weintek серии MT8000iE появились в 2013 году. Их отличительными особенностями являются быстрый процессор Cortex A8, графический сопроцессор, ускоряющий до десяти раз загрузку страниц, насыщенных графикой, новый дизайн (более светлые цвета и компактный корпус), гальваническая изоляция всех портов, влагозащитное покрытие платы. Операторские панели этой серии не имеют порта USB slave (за исключением MT6070iE), поэтому загрузка проекта с ПК возможна только через Ethernet. У нас вы можете купить панели оператора серии MT8000iE, которые мы поставляем напрямую от производителя.", true
);
echo "</article></div>";
//show_series_ie();


temp3();
?>