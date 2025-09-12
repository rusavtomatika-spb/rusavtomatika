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
?>
<center>
    <h1 style="width: 1050px;">Панели оператора, операторские панели, Weintek, сенсорные панели оператора и интерфейсы со&nbsp;склада в&nbsp;России</h1>
</center>
<br />
<div style="width: 1050px;margin:auto;margin-bottom: -58px;">
    <div style="width: 1050px;display:inline-block;text-align:right;margin:auto;padding:0px;font-family: Arial, 'MS Sans Serif', sans-serif;">
        <div style="float:left;margin:0px 0 -10px 45px;width:600px;text-align:left;">
            <a style="text-decoration: underline;" target="_blank"  class="compare_table_link" href="/weintek-stavnenie-seriy.php"><span class="compare_table_icon"></span><span>Таблица сравнения всех серий по функционалу</span></a>
            <a style="text-decoration: underline;" target="_blank" class="download_linkext_online" href="/weintek-easybuilder-instrukciya-na-russkom/"><span>Онлайн руководство пользователя EasyBuilder Pro <b>на русском языке</b></span></a>
        </div>
        <div class="block_distributor_certificate_fam_electric">
            <a href="//www.rusavtomatika.com/upload_files/weintek/distributor_certificate_fam_electric.jpg" rel="lightbox[1]">
                <img src="//www.rusavtomatika.com/images/weintek/distributor_certificate_fam_electric-small.jpg" alt="Сертификат официального дистрибьютора Weintek">
                Сертификат официального дистрибьютора Weintek
            </a>
        </div>
    </div>
</div>
<style>
    a h2.series_name {text-decoration:none;cursor:pointer;} td a {text-decoration:none;}

    .block_distributor_certificate_fam_electric{text-align:right;float:right;margin-top: -30px;margin-right: 0px;}
    .block_distributor_certificate_fam_electric a{display: block;width: 315px;padding-top: 33px;text-decoration: underline;}
    .block_distributor_certificate_fam_electric img{float:right;margin:-18px 0 10px 20px;width:110px;display: block;box-shadow: 0 0 4px rgba(0,0,0,0.4);transition: 0.2s;}
    .block_distributor_certificate_fam_electric a:hover img{transform: scale(1.05);}

</style>
<?

//-----------------------------------series iP ---------------------------

show_series_ip();

//----------------------series CloudHMI

show_series_cloud_hmi();


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