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

echo "<h1 class=series_name>ѕанели оператора Weintek сери€  MT8000iE </h1>";

echo "<br><center><div class=series_descr><strong>ѕанели оператора</strong> серии MT8000iE по€вил€сь в 2013 году. ќтличительными особенност€ми серии €вл€ютс€ быстрый процессор Cortex A8,
 графический сопроцессор, ускор€ющий до 10 раз загрузку страниц, насыщенных графикой,
 новый дизайн ( более светлые цвета и компактный корпус ), гальваническа€ изол€ци€ всех портов, влагозащитное покрытие платы.<strong>ѕанели оператора</strong> этой серии не имеет порта
 USB  slave ( кроме MT6070iE ), так что загрузка проекта с ѕ  возможна только через Ethernet.

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