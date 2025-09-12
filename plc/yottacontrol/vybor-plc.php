<?php
session_start();
define("bullshit", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php");
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_controllers.php");


database_connect();
mysql_query("SET NAMES 'cp1251'");



//---------------content ---------------------

$d_image = '<img title="Скачать" src="/images/manual.png">';

$out = '  ';
$out = '
  <style>

#tabstable {   font-family: Verdana, "Lucida Grande"; }

#tabstable td {  border: 1px solid silver; font-size: small; padding:3px 5px; text-align: center; }

#tabstable tr:first-child td {font-weight:bold;}

#tabstable td:first-child {text-align:left;}

#tabstable .h2 {  height: 20px;
  background: rgb(205, 186, 186);
  min-height: 20px;}

 h2 {  color: rgb(245, 245, 245);
  text-shadow: 1px 1px 1px black;
  text-transform: uppercase;
  text-align: center;
  color:white !important;
  margin: 5px 0px 5px 0px;}
 </style>

 ';





$out .= '<br><br>
<div style="width:1100px; min-height: 500px; overflow: auto;   margin: auto;  margin-bottom: 40px;">
<h1 style="  margin: auto;  width: 90%;  text-align: center;">Выбор ПЛК, PLC Yottacontrol</h1><br /><br />
<div id="tabstable" style="  margin: auto;border:none;">

   ' . '


 <table class="tabs" id="tabs" cellpadding="0" cellspacing="0" style="margin:auto;  border: none;">
<tbody>
			<tr height="20">
			<td class="h2" colspan="11" height="20" style="height:20px;">
				<h2>Серия A-52 с Wi-Fi</h2></td>
		</tr>

			<tr height="20">
			<td  colspan="11" height="20" style="border:none;"></tr>

				<tr height="40" style="font-weight:bold;">
<td>ПЛК</td>
<td>Экран</td>
<td>DI</td>
<td>DO</td>
<td>AI</td>
<td>AO</td>
<td>RS-485</td>
<td>RS-432</td>
<td>USB2.0</td>
<td>micro SD</td>
<td>Wi-Fi</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5288D.php">A-5288D</a></td>
<td>2&Prime;</td>
<td>8</td>
<td>4, реле</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&#10003;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5288D-T.php">A-5288D-T</a></td>
<td>2&Prime;</td>
<td>8</td>
<td>4, транз.</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&#10003;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5289D.php">A-5289D</a></td>
<td>2&Prime;</td>
<td>4</td>
<td>4, реле</td>
<td>4 (0~10VDC)</td>
<td>&nbsp;</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&#10003;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5289D-T.php">A-5289D-T</a></td>
<td>2&Prime;</td>
<td>4</td>
<td>4, транз.</td>
<td>4 (0~10VDC)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&#10003;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5290D.php">A-5290D</a></td>
<td>2&Prime;</td>
<td>2</td>
<td>2, транз.</td>
<td>4 &times; 0~20mA/0~10V/<br />датчик (PT-100,J,K...</td>
<td>2</td>
<td>1</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&#10003;</td>
</tr>
			<tr height="20"><td colspan="11" height="20" style="border:none;"></tr>

		<tr height="20">
			<td class="h2" colspan="11" height="20" style="height:20px;width:1077px;">
				<h2>ПЛК, PLC контороллеры с поддержкой Modbus</h2></td>
		</tr>
	<tr height="20"><td colspan="11" height="20" style="border:none;"></tr>
				<tr height="40" style="font-weight:bold;">
<td>ПЛК</td>
<td>Экран</td>
<td>DI</td>
<td>DO</td>
<td>AI</td>
<td>AO</td>
<td>RS-485</td>
<td>RS-432</td>
<td>USB2.0</td>
<td>micro SD</td>
<td>Wi-Fi</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5188.php">A-5188</a></td>
<td>&nbsp;</td>
<td>8</td>
<td>4, реле</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5188-T.php">A-5188-T</a></td>
<td>&nbsp;</td>
<td>8</td>
<td>4, транз.</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5188D.php">A-5188D</a></td>
<td>2&Prime;</td>
<td>8</td>
<td>4, реле</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5188D-T.php">A-5188D-T</a></td>
<td>2&Prime;</td>
<td>8</td>
<td>4, транз.</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5188D-T.php">A-5188M</a></td>
<td>&nbsp;</td>
<td>8</td>
<td>4, реле</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5188M-T.php">A-5188M-T</a></td>
<td>&nbsp;</td>
<td>8</td>
<td>4, транз.</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5189.php">A-5189</a></td>
<td>&nbsp;</td>
<td>4</td>
<td>4, реле</td>
<td>4</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5189.php">A-5189-T</a></td>
<td>&nbsp;</td>
<td>4</td>
<td>4, транз.</td>
<td>4</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5189.php">A-5189D</a></td>
<td>2&Prime;</td>
<td>4</td>
<td>4, реле</td>
<td>4</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5189D-T.php">A-5189D-T</a></td>
<td>2&Prime;</td>
<td>4</td>
<td>4, транз.</td>
<td>4</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5189M.php">A-5189M</a></td>
<td>&nbsp;</td>
<td>4</td>
<td>4, реле</td>
<td>4</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5189M-T.php">A-5189M-T</a></td>
<td>&nbsp;</td>
<td>4</td>
<td>4, транз.</td>
<td>4</td>
<td>&nbsp;</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5190.php">A-5190</a></td>
<td>&nbsp;</td>
<td>4</td>
<td>2, транз.</td>
<td>2</td>
<td>2</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-5190D.php">A-5190D</a></td>
<td>2&Prime;</td>
<td>4</td>
<td>2, транз.</td>
<td>2</td>
<td>2</td>
<td>2</td>
<td>1</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tr>
			<tr height="20"><td colspan="11" height="20" style="border:none;"></tr>
</tbody>
</table>


<table class="tabs"  id="tabs"  cellpadding="0" cellspacing="0" style="margin:auto;  border: none;" >
<tbody>
<tr height="20">
			<td class="h2" colspan="8" height="20" style="height:20px;">
				<h2>Модули ввода-вывода c поддержкой Modbus</h2></td>
		</tr>

			<tr height="20">
			<td  colspan="8" height="20" style="border:none;"></tr>
<tr style="font-weight:bold;">
<td>Модуль</td>
<td>DI</td>
<td>DO</td>
<td>AI</td>
<td>&nbsp;</td>
<td>RS-485</td>
<td>USB2.0</td>
<td>Сеть</td>
</tr>
<tr height="20">
			<td  colspan="8" height="20" style="border:none;font-weight:bold;text-align:center;">Универсальные модули ввода-вывода с Ethernet (10/100) Yottacontrol серия A-18</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1851.php">A-1851</a></td>
<td>16</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>Ethernet</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1860.php">A-1860</a></td>
<td>8</td>
<td>4, силовое реле</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="20">
			<td  colspan="8" height="20" style="border:none;font-weight:bold;text-align:center;">Универсальные модули ввода-вывода с Wi-Fi Yottacontrol серия A-12</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1212.php">A-1212</a></td>
<td>2</td>
<td>16-bit: 2 &times; 0/4~20mA,<br />2 &times; PT-100/1000(-200 ~ 600&deg;C)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>1</td>
<td>Wi-Fi</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1219.php">A-1219</a></td>
<td>2</td>
<td>16-bit: 8 &times; 0/4~20mA,J,K,T,E,R<br />,S,B,Thermistor(-100 ~ +1800&deg;C)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>1</td>
<td>Wi-Fi</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1251.php">A-1251</a></td>
<td>16</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>1</td>
<td>Wi-Fi</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1255.php">A-1255</a></td>
<td>2</td>
<td>4, привод мотора</td>
<td>4&times;12-bit &times; 0~10V</td>
<td>&nbsp;</td>
<td>1</td>
<td>1</td>
<td>Wi-Fi</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1260.php">A-1260</a></td>
<td>2</td>
<td>4, силовое реле</td>
<td>4&times;12-bit &times; 0~10V</td>
<td>&nbsp;</td>
<td>1</td>
<td>1</td>
<td>Wi-Fi</td>
</tr>
</tr>
<tr height="20">
			<td  colspan="8" height="20" style="border:none;font-weight:bold;text-align:center;">Универсальные модули ввода-вывода Yottacontrol серий A-10, A-30</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1051.php">A-1051</a></td>
<td>16</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1055.php">A-1055</a></td>
<td>8</td>
<td>8 (PNP)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1055S.php">A-1055S</a></td>
<td>8</td>
<td>8 (NPN)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1057.php">A-1057</a></td>
<td>&nbsp;</td>
<td>12 (NPN)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1058.php">A-1058</a></td>
<td>&nbsp;</td>
<td>12 (PNP)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1060.php">A-1060</a></td>
<td>8</td>
<td>4, силовое реле</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1068.php">A-1068</a></td>
<td>&nbsp;</td>
<td>8, реле</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1069.php">A-1069</a></td>
<td>&nbsp;</td>
<td>8, силовое реле</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-3016.php">A-3016*</a></td>
<td>6</td>
<td>7 (PNP)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1010.php">A-1010</a></td>
<td>&nbsp;</td>
<td>8, 0~10VDC</td>
<td>2</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="/plc/yottacontrol/A-1010.php">A-1012</a></td>
<td>2</td>
<td>4 &times; V,I,J,K,PT-100...</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>


<p>
	&nbsp;</p>



   ' . '

  </div></div><style>
  #table_of_contents {
  list-style: none;
  font-size: 13px;
  width: 969px;
  margin: auto;
  margin-top: 15px;
  height: 20px;
  }
  #table_of_contents li {float: left;
  margin-right: 15px;}
  #table_of_contents li a {color: rgb(22, 22, 124); text-decoration:none;}
  #table_of_contents li a:hover {text-decoration:underline;}
  #table_of_contents {font-family: Verdana, "Lucida Grande";}
  .gray {  background-color: rgb(242, 242, 242);}
  </style>
<script>
$(document).ready(function(){
$(".tabs td").mouseenter( function() {

var par = $(this).parent("tr");

var inn = $(par).index(this);
var inp = $(".tabs tr").index(par);

$(".tabs td").removeClass("gray");

var ht = $(this).text();

if ((ht != "") && (ht != " ")) {

$(this).addClass("gray");

};

//$(par).children("td").addClass("gray");

//$(".tabs tr").eq(inn).addClass("gray");

});

$(".tabs").mouseleave(function() {

	$(".tabs td").removeClass("gray");

});

});
</script>

  ';



$title = 'Выбор ПЛК, PLC Yottacontrol';
$keywords = 'Выбор ПЛК, PLC, Yottacontrol, программируемые логические контроллеры';
$description = 'Сводная таблица характеристик бюджетных программируемых логических контроллеров Yottacontrol';

$template_file = 'head.html';

$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/sc/" . $template_file);
$head = str_replace('[>TITLE<]', $title, $head);
$head = str_replace('[>DESCRIPTION<]', $description, $head);
$head = str_replace('[>KEYWORDS<]', $keywords, $head);


echo $head;
?>
<div id='mes_backgr'> </div>
<div id='body_cont' >
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
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





    echo $out;



    temp3();
    ?>