<?php
session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");
global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/series_MT8000iP.png",
    "openGraph_title" => "������ ��������� Weintek ����� MT8000iP",
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

//temp2();
?>
</td><!-- MAIN TABLE     end td left content -->
<td valign="top"> <!-- MAIN TABLE     td right content -->

    <div style="margin: 20px auto 10px;width: 90%;">
        <nav>
            <a href="/">�������</a>&nbsp;/&nbsp;<a href="/weintek/">������ ���������, ��������� ���������� � �������� Weintek</a>&nbsp;/&nbsp;������ ��������� Weintek ����� MT8000iP</nav>
    </div>
    <?
//---------------content ---------------------
   echo '<div class="block_content"><article>';
    include 'inc_functions.php';
    show_weintek_series(
            'iP', '������ ��������� Weintek ����� MT8000iP', $link = '', $text = '��������� ������ ��������� Weintek ����� MT8000iP 2016 ����.  �� �������������� ������������� �������� ������� ��������� Cortex A8, ������ ���������� ������. � ��� �� ������ ������ ������ ��������� ����� MT8000iP, ������� �� ���������� �������� �� �������������.', true
    );
//show_series_ip();

echo "</article></div>";
    temp3();
    ?>