<?

$vta = (explode('?',$_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php/", "", $vta[0]);

$var_to_array = str_replace("/index.php", "", $var_to_array);

$CANONICAL = $var_to_array;

$var_to_array = str_replace(".php/", "", $var_to_array);
$var_to_array = str_replace(".php", "", $var_to_array);
$var_to_array = str_replace("//", "/", $var_to_array);

$var_array = explode("/",$var_to_array);
$levels = count($var_array);
$end_page = $levels - 1;

if (($end_page == 2) AND ($var_array[$end_page] != '')) {include ("products_newo.php");} else { 
//$num="MT8070iH";   
//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));


session_start();
define("bullshit",1);
include $_SERVER['DOCUMENT_ROOT']."/sc/dbcon.php";
include $_SERVER['DOCUMENT_ROOT']."/sc/lib_new.php";


database_connect();
mysql_query("SET NAMES 'cp1251'");
//---------------content ---------------------






$outs = "<h1 class=series_name>������������ �������� ( ������������, ��������� )</h1>";

$outs .= "<br><center><div class=series_descr>
�������� IFC ( ����� ) ��� ���������������� ������������� ������������ <strong>������������ ���������</strong>, ���������� ����� 10 ���. �������� IFC ��������� �����������, 
� �������� ��������� ���������� ����������. <strong>�������� IFC</strong> � ������� �� ���������� �����.<br /><br />

�������������� ����� ����������� ��������� ������� � LED ����������, 6 �� ����- � �������������� �������� ������ � ���������� �������, ������ ��������� ����������, ������� ����������� � ������� ������ ������������ ��������� ������ <strong>�������� IFC</strong> ��������� ����������� � ���������� ���������������� ���������� � ����� �����.<br /><br />
<strong>���������� ����� ����������</strong> ( 5,7&Prime; � 22&Prime; ) ��������� ��������� ����������� ������ ��� ������� ������ ������. 
</div></center><br /><br />";


$outs .= "<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
$outs .= show_ifc("IFC-M057");
$outs .= "</td><td align=center valign=top>";
$outs .= show_ifc("IFC-M080");  // end row 
$outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_ifc("IFC-M104");
$outs .= "</td><td align=center valign=top>";
$outs .= show_ifc("IFC-M121");  // end row 
$outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_ifc("IFC-M150");
$outs .= "</td><td align=center valign=top>";
$outs .= show_ifc("IFC-M170");  // end row 
$outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
$outs .= show_ifc("IFC-M190");
$outs .= "</td><td align=center valign=top>";
$outs .= show_ifc("IFC-M220");  // end row 
$outs .= "</td></tr>

</table></center><br /><br />";



//------------------end content---------------


$template_file = 'head.html';

$title = '������������ �������� ( ������������, ��������� )';
$keywords = '�������, IFC, LED, 5,7&Prime;, 22&Prime; ���������, VGA, DVI, USB, ������, �����������, ����������, ���������, ������������, ������������, 8&Prime;, 10.4&Prime; , 15&Prime;, 17&Prime;, 19&Prime;, 22&Prime;';
$description = '������������ LED �������� IFC � ���������� 5,7&Prime;-22&Prime; � ����������� ������� 12 V, ��������, ��������, ����������������, ������ ������, IP65 �������� ������, ����� VGA, DVI, Audio, USB-����� � ��������� ����';

$head = head($template_file,$title,$description,$keywords);

echo $head;
top_menu();
usd_rate();
search();
compare();
backup_call();
top_buttons();
temp1_no_menu();
show_price_val();
//temp1();
//left_menu();
basket();


temp2();
add_to_basket();

popup_messages();
echo $outs;
temp3();
};
?>