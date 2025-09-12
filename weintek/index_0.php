<?php
session_start();
define("bullshit",1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");


database_connect();

temp0("weintek");
top_buttons();
temp1();
left_menu();
basket();


temp2();
//---------------content ---------------------
?>

  <style> 
  
  </style>
<?

add_to_basket();


?>
<input id="phone1" type="text" onclick='ts()' />
<?
//show_ifc("IFC-608RF");

popup_messages();

//------------------------------series 6000 -------------------------------------------

show_series_6000();

//----------------------------series 8000 -------------------------------------

show_series_8000();

//-----------------------series EMT -----------------------------

show_series_emt();

//-----------------------------------series IE ---------------------------

show_series_ie();


//----------------------series OpenHMI

show_series_open_hmi();



//-----------------end content

temp3();

?>