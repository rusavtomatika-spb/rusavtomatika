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
        <a href="/">�������</a>&nbsp;/&nbsp;<a href="/weintek/">������ ���������, ��������� ���������� � �������� Weintek</a>&nbsp;/&nbsp;������ ��������� Weintek ����� eMT600
    </nav>
</div>

<?
//---------------content ---------------------
include 'inc_functions.php';
show_weintek_series(
        'Open HMI', '��������� ���������� Weintek ����� Open HMI eMT600', $link = '', $text = "��������� ���������� Weintek ����� eMT600 ��������� � 2012 ����. ��� �������� ������������ ����� MT600. �� ��������� ����������� Weintek ����� eMT600 ����������� ������������ ������� Windows CE 6.0", true
);
//show_series_open_hmi_emt();


temp3();
?>