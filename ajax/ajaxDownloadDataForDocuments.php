<?
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: https://www.rusavto.moisait.net');


$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST["password"] !== "3319333"){exit;}

$remoteUrl = $_SERVER['DOCUMENT_ROOT'] . "/upload_files/";
$arrResult = [];
$arrDownload = [];

$counter = 0;
if(!empty($_POST["data"]["newDocument"])){
  foreach ($_POST["data"]["newDocument"] as $value) {

  $newPath = $remoteUrl . $value["fn"];
    $resultDownload = file_put_contents ( $newPath, file_get_contents($value["fnUrl"]) );

    if($resultDownload !== false){

      $arrResult["successDownload"][$counter] = $value['driver'];
      $counter++;
    }


  }
}

if(!empty($_POST["data"]["updateDocument"])){
  foreach ($_POST["data"]["updateDocument"] as $value) {

  $newPath = $remoteUrl . $value["fn"];
    $resultDownload = file_put_contents ( $newPath, file_get_contents($value["fnUrl"]) );

    if($resultDownload !== false){
      $arrResult["successDownload"][$counter] = $value['driver'];
      $counter++;
    }


  }
}

echo json_encode($arrResult);
