<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$CACHE_PATH = $_SERVER["DOCUMENT_ROOT"]."/cache/";
ob_start();
$path = $_POST["page"]["pathname"].$_POST["page"]["search"];
$path = preg_replace("/\/|\?|=/",'_', $path);
$file = $CACHE_PATH.$path.".html";

if(!file_exists($CACHE_PATH)) {
    mkdir($CACHE_PATH);
}
//$html = iconv("utf-8", "windows-1251", $_POST["html"]);
file_put_contents($file, $_POST["html"]);

$buffer = ob_get_clean();
$out["buffer"] = $buffer;
echo json_encode($out);

