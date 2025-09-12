<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Тест</title>
</head>

<body>
<h2>Тест: <? echo (date("H:i:s")); ?></h2>
<?php
$homepage = file_get_contents('https://dl.weintek.com/');
$doc = new DOMDocument;
$doc->loadHTML($homepage);
$titles = $doc->getElementsByTagName('body');
$uptime = $titles->item(0)->nodeValue;
    if ($uptime == "Welcome to dl.weintek.com.") {echo "up";} else {echo "down";}
    ?>
</body>
</html>