<?php
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
if(EX != "_"){
    include $_SERVER["DOCUMENT_ROOT"]."/ewon_/index.php";
    exit();
}


session_start();
define("bullshit", 1);
include "../sc/dbcon.php";

include ("../sc/lib_new.php");

//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$section_setup = '.section.php';
if (file_exists($section_setup)) {
    include $section_setup;
}

global $mysqli_db;
database_connect();
mysqli_query($mysqli_db, "SET NAMES 'cp1251'");

include ("ewon_functions.php");

$template_file = 'head.html';

$title = 'EWON ������������ VPN-������� VPN-������� ����� IIoT � ��������� ������ � ������������';
$keywords = '������������, ����� IIoT, VPN-������, VPN, ������, eWON, Flexy, COSY, vpn-������, ��������, ����������, ���������, ������, ������������, COSY-141';
$description = '������������ VPN-�������, VPN-�������, ����� IIoT eWON � ���������� ����������� � ������������ ����� ��������. COSY-141, Flexy, ������-���������� ��� ����������� ����������� 3G, 4G, HSUPA, Wi-Fi, Ethernet WAN, RS232/485/422 - ��������, �������� � ����������������';


$head = head($template_file, $title, $description, $keywords, '<link rel="stylesheet" type="text/css" href="/ewon/ewon_styles.css" />', '<script type="text/javascript" src="/ewon/ewon_scripts.js"></script>');

echo $head;
?>
<div id="mes_backgr"> </div>
<div id="body_cont">
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width="100%" bgcolor="white">
        <tr height="93">
            <td width="300px">
                <a href="/"><img src="/images/logo2017.png" /></a>
            </td>
            <td> </td>
        </tr>
    </table>
    <?
    top_menu();
    search();
    compare();
    backup_call();
    top_buttons();
    basket();
    temp1_no_menu();
    show_price_val("euro");

    add_to_basket();
    popup_messages();
    temp2();
    ?>
    <br><br><article><center><h1>EWON VPN-�������, VPN-������� � ���� IIoT �� ������ � ������</h1></center>
    <div class="table_of_contents_wrapper">
        <ul class="table_of_contents">
            <li><a class="go_to" href="#FLEXY205">���� IIoT � VPN-������ <span>FLEXY 205 &#8681</span></a></li>
            <li><a class="go_to" href="#COSY-131">VPN-������ <span>COSY-131 &#8681;</span></a></li>
            <li><a class="go_to" href="#COSY-141">VPN-������  <span>COSY-141 &#8681;</span></a></li>
            <li><a class="go_to" href="#FLEXY">��������� VPN-������ <span>FLEXY 201 &#8681;</span></a></li>
            <li><a class="go_to" href="#eFive">VPN-�������  <span>eFive &#8681;</span></a></li>
        </ul>
    </div>
    <script>
        $(document).ready(function () {
            $('.go_to').click(function () { // ����� ���� �� ������ � ������� go_to
                var scroll_el = $(this).attr('href'); // ������� ���������� �������� href, ������ ���� ����������, �.�. �������� ���������� � # ��� .
                if ($(scroll_el).length != 0) { // �������� ������������� �������� ����� �������� ������
                    $('html, body').animate({scrollTop: $(scroll_el).offset().top}, 500); // ��������� ��������� � �������� scroll_el
                }
                return false; // ��������� ����������� ��������
            });
        });
    </script>
    <div class=rou_desc style='  margin: auto;'><br>������������ <strong>VPN-�������</strong> eWON ������� ��� �������� ����������� ���������
        �������� ������������� � �������� ����������� ����������� VPN ������. ��� ���� ��� ������������� � ������� ������������ VPN-�������, ��� ��� eWON ���������� ���� �������� ������ Talk2M.
        ����� �������, ������������ <strong>VPN-�������</strong> eWON - ��� ������� ������� ��� ���, ���� ����������
        �������� ������������, ����������, ��������� ��������, ���������� ������������.
        <br>
    </div>
    <center>

        <div class=rou_desc>



        </div>
        <div id="FLEXY205">
            <? echo flexy205(); ?>
        </div>
        <div id="COSY-131">
            <? echo cosy131(); ?>
        </div>
        <div id="COSY-141">
            <? echo cosy141(); ?>
        </div>
        <div id="FLEXY">
            <? echo flexy(); ?>
        </div>
        <div id="eFive">
            <? echo efive(); ?>
        </div>
        <br><br>
        <div style='width:1040px; text-align:justify;'>
            <div class=rou_desc>�������� eWON ( ������� ) - ����������� � ������������� ������������ VPN-��������. ����� �������� eWON ����� ������ ��������� � ����, �������������
                �������� VPN-������ Talk2M, ������� ��������� �������� ��������� ������������� ������������ � ��������� ����� ��������� ���� ��� ����������� ���������� �������� IP.<br><br>
                � ������� <strong>eWON Cosy</strong> ������������� ������������ � ��������� ����������� ����� �������� ��������� �������
                � ����������� ������������ ������������, ���������� ��������� ������������  ( ������������ ��� �� Ethernet, ��� � �� COM, ���� MPI ),  ������������ �������
                ��������� � ��� �������, ������������� ����������� � IP-�����. <br><br>
                <strong style='color:blue;'>����������� ������ � ������������� ��� ������ �� ������ ����������� ������� ������� �� ������������ ������� � �������� ������������������</strong>.<br><br>

                <strong>eWON Cosy</strong> ��������� ��������� � <strong>Talk2M</strong>, �������� �������� eWON ( ���������� ). <strong>Talk2M</strong> ������������ ���������� VPN ���������� ����� �������������
                � ��������� ��������. ��� ���� ������� �� ����� ���������� IP. eWON Cosy � Talk2M ������������ ������� ������ ������� � ������������, ������������� � ����, ���, ���
                ������������ �� ����� �������� �������� � ������� IT.

                <strong>VPN-������</strong> ������ ������������ � ��������� ���� �� �������, ��� ���� �� ��������� ������������� ������������� �������������� ����.
                ������ ���������� ����������� ����� 443 (HTTPS) � 1194 (UDP).<br><br>

                <strong>VPN-������</strong> eWON ��������������� �� ��������� �������, � �������� ��������� ��������� ������.<br><br>
                ������������, ������� ���������� ��������������, ������������ �� Ethernet � �������� \"MACHINE LAN\" (1-4), ����
                � ������� COM �����, ���� MPI.<br><br>
                ������ \"INTERNET\" <strong>VPN-�������</strong> ������������ � ��������� ���� �������.<br><br>
                ��� ���� ��� ������������� ��������������� ���-���� � ��������� ���� ������� ( ������������ �����, �������� IP � �.�. ).
            </div>
            <br><br>
            <img src="/images/ewon/ewon1.png">
            <br><br>

            <div class=rou_desc>
                ����� <strong>VPN-������</strong> eWON ����� ���� ��������� � ������ ������� � 3G, ���� 4G �������, ��� ���� �� ��������� �������������� � �������
                ����������� � ����������� IP. <strong>VPN-������</strong> eWON ������� ����������� � ���������� VPN ���������� ������ ���������� �������.
            </div>
            <br><br>
            <img src="/images/ewon/ewon_3g.png">
            <br><br>

            <div class=rou_desc>
                <strong>VPN-������</strong> eWON ��� ��������� ������������� ���������� VPN ���������� � �������� Talk2M. ��� ���� �� ����� ������ �����������
                <strong>VPN-�������</strong>, ��� ����� ���� ��������� ���� �����������, ���� ������ � 3G, ���� 4G �������. �� ����� ����� �������� ����������� IP-�����.<br><br>
                ������ Talk2M - ���
                ���������� ������, ������������ ��������� eWON. � ������ ������� Talk2M ������ ��������� ������������������ ��������, ������������� �� ����� ����,
                ����������� ������������ ����������� ������ VPN-�������� eWON. <br><br>
                ��� ������ <strong>VPN-������</strong> eWON ����������� � ������� Talk2M, �� ���������� ��������� ��� ����������� � ���� � ������ ��, ��
                ������� ����������� ���������� eCatcher. � ���������� eCatcher ����� ��� �������, ����������� � �������� ������������, ��� ����������� � ������ �� ��������, ����� �� �
                ��������� VPN-�������� ��������������� ���������� VPN ����������, � ��� ����������, ������������ � ����� �������,
                ���������� ��������, ��� ����� ��� ��������� � ����� ��������� ���� � ��, �� �������  ������� eCatcher.

            </div>
            <img src="/images/ewon/ewon2.png">
            <br><br>
            <div class=rou_desc>
                ��� ��������� �� �� ���������� eCatcher ������� ����������� ������� �������. ��� ����������� � ������� eCatcher ����� Talk2M � ���������� VPN-�������, ������ � ��� ���������
                ����������, ������������ � ����, ����������� � ����������� ��������� ����, �� IP-������ �������� � ����� ������ ���������� �������� ( �������� ��� ��������� )
                ���������� �� ��������� IP-������ ���������� VPN-������� ( �� ����� ���� ������������ ).<br><br>
                ��������, ��� PLC ����� ����� IP-����� 192.168.12.5, ������������ ������ 192.168.12.2, � IP ������
                192.168.12.3, �� ������ ������� �������� ������ � ������ ����������� �� ���� �������. <br><br>
                ���������� eVCOM ������� ����������� COM ���� �� ��, ��������� ����� VPN ���������� � COM ������ ���������� VPN-�������.
                �� ������ ������������ ����� ���������� ��� ������ � COM ������, ��� ���� ����������� � COM ������ ���������� ���������� �
                �������� �����, ��� ���� �� ��� ���� ���������� ��������������� � COM ����� ������ ��.  <br><br>

                ����� �������, � ��������� ����������� ����� �������� ������ ����� ��, ����������� ��� ������������ ���������. ��������, �� ���������� GX IEC Developer, STEP7,
                CX-Programmer, EasyBuilder, ���� ����� ������ �� ��� ������� � �������� �������� ��� PLC, ���� ������� ���������, � ��������� � ��������� ����������� ���,
                ��� ����� ��� ��������� �� ����� ������� �����. �� �����, ��� �� ������������ � ���������� - �� Ethernet, ���� �� COM �����, ���� �� MPI, �� �� ������������
                ����������.
            </div>
            <br><br>

            <img src="/images/ewon/ewon3.png">
            <br><br>
        </div>
    </center></article>

    <?
    temp3();
    ?>