<?
header('Content-Type: text/html;  charset=utf-8');
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST["password"] !== "3319333"){exit;}


$to = 'valovenko@ya.ru';
//$to = 'melnikov@fam-drive.ru, valovenko@yandex.ru';

/*$to = '';*/
$name = 'Русавтоматика БОТ';
$email = 'valovenko@ya.ru';

ob_start();?>
<h1>Обновление раздела 'Документы' - выполнено </h1>
<p>Были загружены/обновлены "руководства по подключению ПЛК" в разделе Документы с сайта "https://www.weintek.com/globalw/Software/PLC.htm"</p>
<hr>
<?


if(!empty($_POST["newDoc"])){
  $counter_new = 1;
  echo "<br><b>Новые документы:</b><br>";
  foreach ($_POST["newDoc"] as $key => $value) {
    echo $counter_new . ". <a href='" . $value["fnUrl"] . "'>" . $value["driver"] . "</a><br>";
  $counter_new++;
  }
}else{
  $counter_new = 0;
  echo "нечего добавлять";
}

if(!empty($_POST["updateDoc"])){
    echo "<br><b>Обновленные документы:</b><br>";
  $counter_update = 1;
  foreach ($_POST["updateDoc"] as $key => $value) {

    echo $counter_update . ". <a href='" . $value["fnUrl"] . "'>" . $value["driver"] . "</a><br>";
    $counter_update++;
  }
}else{
  $counter_update = 0;
  echo "нечего обновлять";
}
/*
?>
<br>
<br>
<hr>
<hr>
<br>
<br>

<b>Анекдот с anekdot.ru</b><br>
<?$siteAnekdot = file_get_contents("https://www.anekdot.ru/random/anekdot/", false);


$startAnek = stripos($siteAnekdot, '<div class="text">');
$startAnek = $startAnek + 18;
$endAnek = stripos($siteAnekdot, '</div>', $startAnek );
$lengthAnek = $endAnek - $startAnek;
$coreAnek = substr($siteAnekdot, $startAnek, $lengthAnek);
echo $coreAnek;*/
?>


<? $message = ob_get_clean();


$subject = "Раздел документы - добавлено " . $counter_new . ", обновлено " . $counter_update;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

$headers .= "To: $name <$email>" . "\r\n";
$headers .= "From: Русавтоматика БОТ <notification@moisait.net>" . "\r\n";

$success = mail($to, $subject, $message, $headers);
