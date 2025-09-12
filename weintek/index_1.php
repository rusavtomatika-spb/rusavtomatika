<?php

$start = microtime(true);
session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");


database_connect();

temp0("weintek");
top_buttons();
basket();
temp1_no_menu();
show_price_val();
//temp1();
//left_menu();


temp2();
//---------------content ---------------------

add_to_basket();




popup_messages();

//show_com_connector("MT6070iH");

echo '<center><h1 style="    width: 1050px;">Панели оператора, операторские панели, Weintek, сенсорные панели оператора и интерфейсы со&nbsp;склада в&nbsp;России</h1></center><br />
<div style="width: 1050px;margin:auto;margin-bottom: -58px;"><div style="width: 1050px;display:inline-block;text-align:right;margin:auto;padding:0px;    ' . "font-family: Arial, 'MS Sans Serif', sans-serif;" . '"><div style="text-align:center;float:right;"><a href="//www.rusavtomatika.com/upload_files/weintek/distributor_certificate_fam_electric.jpg" rel="lightbox[1]" style="font-size:small;color:black;"><img src="//www.rusavtomatika.com/images/weintek/distributor_certificate_fam_electric-small.jpg" alt="Сертификат официального дистрибьютора Weintek"></a></div></div></div>
<style>a h2.series_name {text-decoration:none;cursor:pointer;} td a {text-decoration:none;}</style>';

//----------------------series CloudHMI

show_series_cloud_hmi();

//-----------------------------------series iP ---------------------------

show_series_ip();

//-----------------------------------series IE ---------------------------

show_series_ie();

//-----------------------------------series XE ---------------------------
show_series_xe();


//------------------------------series 6000 -------------------------------------------

show_series_6000();

//----------------------------series 8000 -------------------------------------

show_series_8000();

//-----------------------series EMT -----------------------------

show_series_emt();




//----------------------series OpenHMI

show_series_open_hmi();

show_series_open_hmi_emt();

//----------------------series mTV

show_series_mTV();



//-----------------end content
//echo microtime(true) - $start;
temp3();
?>