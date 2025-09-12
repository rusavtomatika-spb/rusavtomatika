<?php
session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");
$lts_file = $_SERVER['DOCUMENT_ROOT'] . '/sc/alts.php';
database_connect();
mysql_query("SET NAMES 'cp1251'");

$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);
$CANONICAL = $var_to_array;


$title = "Weintek аксессуары для панелей оператора";
//---------------content ---------------------


    $template_file = 'head_canonical.html';

    $head = head($template_file, $title, $description, $keywords);

    $head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);

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
        show_price_val();

        add_to_basket();
        popup_messages();
        temp2();
  echo "<article>";
        include "aksessuary-content.php";
        echo "</article>";
        temp3(); // include footer
        ?>
