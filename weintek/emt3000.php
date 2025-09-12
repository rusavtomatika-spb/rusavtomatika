<?php
session_start();
define("bullshit",1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");


database_connect();

temp0("weintek");
top_buttons();
temp1_no_menu();
//temp1();
//left_menu();


temp2();
//---------------content ---------------------

show_series_emt();


temp3();

?>