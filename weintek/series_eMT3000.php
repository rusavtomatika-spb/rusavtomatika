<?php
session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/series_eMT3000.png",
    "openGraph_title" => "������ ��������� Weintek ����� eMT3000",
    "openGraph_siteName" => "�������������"
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
echo "<div class='block_content'>";
echo "<article>";
?>
<div>
    <nav>
        <a href="/">�������</a>&nbsp;/&nbsp;<a href="/weintek/">������ ���������, ��������� ���������� � �������� Weintek</a>&nbsp;/&nbsp;������ ��������� Weintek ����� MT8000XE
    </nav>
</div>

<?
//---------------content ---------------------
include 'inc_functions.php';
show_weintek_series(
        'eMT3000', '������ ��������� Weintek ����� eMT3000', $link = '', $text = "������ ��������� Weintek ����� eMT3000 ��������� � 2012 ����. �������������� ������������� ���� ����� �� ��������� � ������� MT6000i � eMT8000i �������� ����� ������� ���������, ����������� ����� ��� � ����-������, ����������� ������, ��������� CAN. ������������ ������ Weintek eMT3070A ����� ����������� �������� ������� ���������� (�� -20&#8451;). ����� ������ ��������� ���� ����� ��������������� ����� ����� �� EasyBuilder Pro.", true
);
//show_series_emt();

echo "</article></div>";
temp3();
?>