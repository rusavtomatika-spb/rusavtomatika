<?

/*
[10:07:34] ����� ���������: eMT610P - ������ �� ARMPAC-510
[10:08:08] ����� ���������: eMT612A - ������ �� ARMPAC-512
[10:08:22] ����� ���������: eMT615A ����� � ������������ ��� ������
*/
$analogs = array('MT8100iE'=>'MT8101iE','eMT607A'=>'ARMPAC-507','eMT610P'=>'ARMPAC-510','eMT612A'=>'ARMPAC-512');

$analog = '';

if (isset($analogs[$r->model]) and $analogs[$r->model] != '') {
global $mysqli_db;
$sqlp="SELECT `retail_price`,`brand` FROM products_all WHERE `model` = '{$analogs[$r->model]}' LIMIT 1";
$resp = mysqli_query($mysqli_db,$sqlp) or die(mysqli_error($mysqli_db));
$rp=mysqli_fetch_object($resp);

if ($rp->brand == 'IFC') {$ap = 'panelnie-computery/ifc/';}
elseif ($rp->brand == 'APLEX') {$ap = 'panelnie-computery/aplex/';}
elseif ($rp->brand == 'eWON') {$ap = 'ewon/';}
else {$ap = strtolower($rp->brand).'/';};
if (($rp->retail_price != '') AND ($rp->retail_price != '0') AND ($rp->retail_price < $r->retail_price)) {

$analog = '<div id="analog">������ �������: <a href="/'.$ap.$analogs[$r->model].'.php">'.$analogs[$r->model].'</a></div>';
} else {
$analog = '<div id="analog">������: <a href="/'.$ap.$analogs[$r->model].'.php">'.$analogs[$r->model].'</a></div>';
};
};



?>