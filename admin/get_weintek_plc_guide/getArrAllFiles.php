<?
header('Content-Type: text/html; charset=utf-8');
//$_POST = json_decode(file_get_contents('php://input'), true);
//if($_POST["password"] !== "3319333"){exit;}

$value = "https://www.weintek.com/globalw/Download/Download.aspx";
$fullSite = file_get_contents($value, false);

$startParsing = stripos($fullSite, 'var availableTags = ');
$startParsing = $startParsing + 20;
$endParsing = stripos($fullSite, ';autoComplateWord(availableTags);', $startParsing );
$lengthParsing = $endParsing - $startParsing;
$coreParsing = substr($fullSite, $startParsing, $lengthParsing);

$coreParsing = preg_replace('/([{,])(\s*)([A-Za-z0-9_\-]+?)\s*:/','$1"$3":',utf8_encode($coreParsing));
$coreParsing = str_replace("},]", "}]", $coreParsing);

echo $coreParsing;
