<?php

session_start();
define("bullshit", 1);
include ("../sc/dbcon.php");
include ("../sc/lib_new.php");


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

echo "<br><br>";

echo "<h1 class=series_name>������ ��������� Weintek �����  MT8000iE </h1>";

echo "<br><center><div class=series_descr><strong>������ ���������</strong> ����� MT8000iE ��������� � 2013 ����. �������������� ������������� ����� �������� ������� ��������� Cortex A8,
 ����������� �����������, ���������� �� 10 ��� �������� �������, ���������� ��������,
 ����� ������ ( ����� ������� ����� � ���������� ������ ), �������������� �������� ���� ������, ������������� �������� �����.<strong>������ ���������</strong> ���� ����� �� ����� �����
 USB  slave ( ����� MT6070iE ), ��� ��� �������� ������� � �� �������� ������ ����� Ethernet.

  </div></center><br>";

echo "<center><table width=90%>

<tr height=300><td width=50% align=center valign=top>";
echo show_panel1("cMT-SVR-100");
echo "</td><td align=center valign=top>";
echo show_panel1("cMT-iV5");   // end row
echo "</td></tr>

</table></center>";



temp3();
?>