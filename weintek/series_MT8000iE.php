<?php
session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");
global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/series_MT8000iE.png",
    "openGraph_title" => "������ ��������� Weintek ����� MT8000iE",
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
            <a href="/">�������</a>&nbsp;/&nbsp;<a href="/weintek/">������ ���������, ��������� ���������� � �������� Weintek</a>&nbsp;/&nbsp;������ ��������� Weintek ����� MT8000iE
        </nav>
    </div>
<?

echo "<article>";
show_weintek_series(
        'MT8000iE', '������ ��������� Weintek ����� MT8000iE', $link = '', $text = "��������� ������ ��������� Weintek ����� MT8000iE ��������� � 2013 ����. �� �������������� ������������� �������� ������� ��������� Cortex A8, ����������� �����������, ���������� �� ������ ��� �������� �������, ���������� ��������, ����� ������ (����� ������� ����� � ���������� ������), �������������� �������� ���� ������, ������������� �������� �����. ������������ ������ ���� ����� �� ����� ����� USB slave (�� ����������� MT6070iE), ������� �������� ������� � �� �������� ������ ����� Ethernet. � ��� �� ������ ������ ������ ��������� ����� MT8000iE, ������� �� ���������� �������� �� �������������.", true
);
echo "</article></div>";
//show_series_ie();


temp3();
?>