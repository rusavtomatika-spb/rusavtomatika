<?

session_start();
define("bullshit", 1);

$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/cincoze.png",
    "openGraph_title" => "Cincoze, ������������ ����������, ������������ ����������, ��������� ����������, ���������������� ����������, �� ������",
    "openGraph_siteName" => "�������������"
);

include $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
include $_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php";


database_connect();
mysql_query("SET NAMES 'cp1251'");
temp0("weintek");
top_buttons();
basket();
temp1_no_menu();
show_price_val();
//temp1();
//left_menu();


temp2();
//---------------content ---------------------

add_to_basket();

popup_messages();

//echo "<script type='text/javascript' src='/js/highslide.js".version('/js/highslide.js')."'></script>";

echo "<article>";
echo "<h1 style='    margin: 0px 50px;    text-align: center;'>Cincoze, ������������ ����������, ������������ ����������, ��������� ����������, ���������������� ����������, �� ������ � ������</h1><br>";

echo "<br><br><center><div class=series_descr style='display: inline-block;'>
<div style='    width: 210px;    float: right;    margin-left: 28px;'><center>
<a href='/images/oficialnyj-distribyutor-cincoze-sertifikat.jpg?ver=1' rel='lightbox[1]'><img border=0 src='/images/oficialnyj-distribyutor-cincoze-sertifikat_sm.jpg' title='������� ��� ����������'></a>
<br />��� ���������� �������������</center>
</div>
�������� Cincoze (�������) � ������������ � ������� ������������ ������������ ������, ������������ Cincoze ������������ � � ���, � � ������. ��������� ���������� � �������� Cincoze �������� � ���� ���������� � ����������������. <br><br>������������ ����� ��������� Cincoze Crystal, ������� �������� ������������ ��������� ���������� � ������������ ��������. ���������� � �������� Cincoze Crystal � ������������� ������� � ���������������� ����������� ������������ � ����������� � ��������� ��������, � �� ������� ���������� � 9~48�.
<br><br>������������ ������������ ���������� Cincoze Diamond � ���������������� ������������ ���������� � �������� ����������������� ������������� � Gb LAN, COM, USB3.0, USB2.0, SIM, CFast, VGA, DVI, DisplayPort � ����������� ���������, �� ������� ���������� � 9~48�. <br><br>
��� \"�������������\" �������� ����������� �������������� ������������ ����������� � ��������� Cincoze � ������, ������������ ������������ �������� �� �������������.<br><br>

</div></center>";

echo "<br /><br />
<h2 class=series_name id=panels>������������ ��������� ���������� Cincoze</h2><br />
<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("CV-108/P1001");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-110/P1001");   // end row
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("CV-112/P1001");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-112H/P1001");   // end row
echo "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("CV-115/P1001");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-W115/P1001");   // end row
echo "</td></tr>


<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("CV-117/P1001");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-119/P1001");   // end row
echo "</td></tr>

<tr height=330><td width=50% align=center valign=top>";
echo show_cincoze("CV-112/P2002");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-112/P2002E");   // end row
echo "</td></tr>

<tr height=330><td width=50% align=center valign=top>";
echo show_cincoze("CV-112H/P2002");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-112H/P2002E");   // end row
echo "</td></tr>

<tr height=330><td width=50% align=center valign=top>";
echo show_cincoze("CV-115/P2002");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-115/P2002E");   // end row
echo "</td></tr>

<tr height=330><td width=50% align=center valign=top>";
echo show_cincoze("CV-W115/P2002");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-W115/P2002E");   // end row
echo "</td></tr>


<tr height=330><td width=50% align=center valign=top>";
echo show_cincoze("CV-117/P2002");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-117/P2002E");   // end row
echo "</td></tr>

<tr height=330><td width=50% align=center valign=top>";
echo show_cincoze("CV-119/P2002");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-119/P2002E");   // end row
echo "</td></tr>

<tr height=330><td width=50% align=center valign=top>";
echo show_cincoze("CV-W121/P2002");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-W121/P2002E");   // end row
echo "</td></tr>



</table></center><br /><br />
<h2 class=series_name id=boxes>������������ ���������� Cincoze</h2><br />
<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("DA-1000");
echo "</td><td align=center valign=top>";
echo show_cincoze("DC-1100");   // end row
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("DS-1000");
echo "</td><td align=center valign=top>";
echo show_cincoze("DS-1002");   // end row
echo "</td></tr>

</table></center><br /><br />
<h2 class=series_name id=monitors>������������ �������� Cincoze</h2><br />
<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("CV-108/M1001");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-110/M1001");   // end row
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("CV-112/M1001");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-115/M1001");   // end row
echo "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("CV-W115/M1001");
echo "</td><td align=center valign=top>";
echo show_cincoze("CV-117/M1001");   // end row
echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
echo show_cincoze("CV-119/M1001");
echo "</td><td align=center valign=top>";
// end row
echo "</td></tr>

</table></center><br /><br />";
echo "</article>";


//------------------end content---------------
temp3();
?>