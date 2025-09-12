<?php
session_start();
define("bullshit",1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");


database_connect();

temp0("weintek");
top_buttons();
temp1_no_menu();
show_price_val();
//temp1();
//left_menu();


temp2();
//---------------content ---------------------

show_series_open_hmi();


temp3();

?>