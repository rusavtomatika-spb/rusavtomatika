<?
header('Content-Type: text/html; charset=utf-8');
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST["password"] !== "3319333"){exit;}

$value = "https://www.weintek.com/globalw/Software/getPLC2.aspx?selType=Com";
echo file_get_contents($value);
