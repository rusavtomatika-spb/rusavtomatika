<?php
session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/series_MT8000XE.png",
    "openGraph_title" => "������ ��������� Weintek ����� MT8000XE",
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
//---------------content ---------------------

include 'inc_functions.php';
echo "<div class='block_content'>";
?>
    <div>
        <nav>
            <a href="/">�������</a>&nbsp;/&nbsp;<a href="/weintek/">������ ���������, ��������� ���������� � �������� Weintek</a>&nbsp;/&nbsp;������ ��������� Weintek ����� MT8000XE
        </nav>
    </div>

<?
echo "<article>";
show_weintek_series(
        'MT8000XE', '������ ��������� Weintek ����� MT8000XE', $link = '', $text = "��������� ������ ��������� ����� MT8000XE ��������� � 2013 ����. �������������� ������������� ���� ����� ������������ ������� Weintek �������� ������� ��������� Cortex A8, � �������� �������� 1 ���, ����������� �����������, ���������� �� 15 ��� �������� �������, ���������� ��������, ����� ������ (����� ������� ����� � ���������� ������), �������������� �������� ���� ������, � ����� ������������� �������� �����. � 2016 ���� �� ��� ������ ����� XE ��������� ��������� ��������� <a href='/mqtt/'>MQTT</a>.", true
);
echo "</article></div>";
//show_series_xe();


temp3();
?>