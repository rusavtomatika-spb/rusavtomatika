<?php

include $_SERVER["DOCUMENT_ROOT"]."../config.php";

if(EX != "_"){

    header($_SERVER['SERVER_PROTOCOL'] . " 301 Moved Permanently");

    header('Location: https://' . $_SERVER['HTTP_HOST'] ."/privacy/");

    exit();

}

session_start();

define("bullshit", 1);

include ("../sc/dbcon.php");

include ("../sc/lib_new.php");


?>

<br><br>



<?



$title = 'Weintek, ������� ��������� ����� eMT, cMT, cMT3151, mTV, iE/iER, XE';

$keywords = 'Weintek, ������� ��������� ����� eMT, cMT, cMT3151, mTV, iE/iER, XE';

$description = '������ �������, �����, ������������� �����, ������������, ��������� ������, �����������, ���������, ����������� �����������, �������, ������, ������������� ��� ������, MQTT.';



global $extra_openGraph;

$extra_openGraph = Array(

    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/weintek-stavnenie-seriy.png",

    "openGraph_title" => "Weintek, ������� ��������� �����",

    "openGraph_siteName" => "�������������"

);



$template_file = 'head.html';





$head = head($template_file, $title, $description, $keywords);



echo $head;

?>


<div id='body_cont' >

    <? include $_SERVER["DOCUMENT_ROOT"] . "../include_utf_8/header_menu.php"; ?>

    <table width='100%' bgcolor='white'><tr height='93'><td width='300px'>

                <a href="/"><img src="/images/logo2017.png" /></a>

            </td>

            <td> </td>

        </tr>

    </table>

    <?

    top_menu();

//usd_rate();

    search();

    compare();

    backup_call();

    top_buttons();

    basket();

    temp1_no_menu();

    show_price_val();

    add_to_basket();

    popup_messages();

    temp2();

    temp3();

    ?>