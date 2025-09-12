<?php
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://www.rusavtomatika.com/weintek/");
exit();

session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");


global $mysqli_db;
database_connect();
mysqli_query($mysqli_db,"SET NAMES 'cp1251'");
temp0("weintek");
top_buttons();
temp1_no_menu();
show_price_val();

//temp1();
//left_menu();


temp2();
?>
<div style="margin: 20px auto 10px;width: 90%;">
    <nav>
        <a href="/">Главная</a>&nbsp;/&nbsp;<a href="/weintek/">Панели оператора, панельные компьютеры и мониторы Weintek</a>&nbsp;/&nbsp;Панели оператора Weintek серия eMT600
    </nav>
</div>

<?
//---------------content ---------------------
include 'inc_functions.php';
show_weintek_series(
        'Open HMI', 'Панельные компьютеры Weintek серия Open HMI eMT600', $link = '', $text = "Панельные компьютеры Weintek серии eMT600 появились в 2012 году. Они являются продолжением серии MT600. На панельных компьютерах Weintek серии eMT600 установлена операционная система Windows CE 6.0", true
);
//show_series_open_hmi_emt();


temp3();
?>