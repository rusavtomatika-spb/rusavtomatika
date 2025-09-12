<?php
session_start();
define("bullshit",1);
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
//---------------content ---------------------
echo "<article>";
show_series_open_hmi();
echo "</article>";

temp3();

?>