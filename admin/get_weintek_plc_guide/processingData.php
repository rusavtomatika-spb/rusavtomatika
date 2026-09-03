<?
header('Content-Type: text/html; charset=utf-8');

$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST["password"] !== "3319333"){exit;}

$arrResult = [];

if(empty($_POST["data"])){json_encode("no data"); exit;}
foreach ($_POST["data"] as $key => $models) {

  foreach ($models as $string => $value) {

    switch ($string) {
      case 'Model':
          $arrResult[$key]["model"] = $value;
        break;
      case 'Driver':
            $arrResult[$key]["driver"] = $value;
        break;
      case 'fnUrl':
            $arrResult[$key]["fnUrl"] = $value;
            $arrResult[$key]["hash"] = hash_file("md5", $value);
            $documentPdfDate = getDocumentPdfTime($value);
            if( $documentPdfDate !== "net resurce"){
              $arrResult[$key]["date"] = $documentPdfDate["documentDateYear"] . "-" . $documentPdfDate["documentDateMonth"] . "-" . $documentPdfDate["documentDateDay"];
            }

        break;
      case 'fn':
            $arrResult[$key]["fn"] = $value;
        break;
      case 'brand':
            $currentBrand = $value;
        break;
    }

  }
}
foreach ($arrResult as $key => $value) {
  $arrResult[$key]["brand"] = $currentBrand;
}
//var_dump($arrResult);
echo json_encode($arrResult);



function getDocumentPdfTime($filename)
{
  $file_headers = @get_headers($filename);


    if($file_headers[0] == 'HTTP/1.0 404 Not Found'){
          echo "The file $filename does not exist";
    } else if ($file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found'){
        echo "The file $filename does not exist, and I got redirected to a custom 404 page..";
    } else {

  $handle = fopen($filename, "r");


$counter = 0;
if(is_resource($handle)){
  while(!feof($handle))
  {

      $string = fgets($handle);

      $needle1 = "/CreationDate(D:";
      $needle11 = "/CreationDate (D:";
      $needle2 = 'CreateDate="';
      $needle3 = "<xmp:CreateDate>";

      $agas1 = strripos($string, $needle1);
      $agas11 = strripos($string, $needle11);
      $agas2 = strripos($string, $needle2);
      $agas3 = strripos($string, $needle3);


      if($agas1 !== FALSE){

          $posStartDate = $agas1 + 16;

          $documentDate = substr($string, $posStartDate, 8);

          $documentDateYear1 = substr($documentDate, 0, 4);
          $documentDateMonth1 = substr($documentDate, 4, 2);
          $documentDateDay1 = substr($documentDate, 6, 2);


      }elseif($agas11 !== FALSE){

          $posStartDate = $agas11 + 17;

          $documentDate = substr($string, $posStartDate, 8);

          $documentDateYear11 = substr($documentDate, 0, 4);
          $documentDateMonth11 = substr($documentDate, 4, 2);
          $documentDateDay11 = substr($documentDate, 6, 2);

      }elseif($agas2 !== FALSE){

          $posStartDate = $agas2 + 12;


          $documentDate = substr($string, $posStartDate, 10);

          $documentDateYear2 = substr($documentDate, 0, 4);
          $documentDateMonth2 = substr($documentDate, 5, 2);
          $documentDateDay2 = substr($documentDate, 8, 2);

      }elseif($agas3 !== FALSE){
          $posStartDate = $agas3 + 16;


          $documentDate = substr($string, $posStartDate, 10);

          $documentDateYear3 = substr($documentDate, 0, 4);
          $documentDateMonth3 = substr($documentDate, 5, 2);
          $documentDateDay3 = substr($documentDate, 8, 2);

      }

  $counter++;
  }

  if(isset($documentDateYear1)){
      $ArrDocumentPdfTime["documentDateYear"] = $documentDateYear1;
      $ArrDocumentPdfTime["documentDateMonth"] = $documentDateMonth1;
      $ArrDocumentPdfTime["documentDateDay"] = $documentDateDay1;
  }elseif(isset($documentDateYear11)){
      $ArrDocumentPdfTime["documentDateYear"] = $documentDateYear11;
      $ArrDocumentPdfTime["documentDateMonth"] = $documentDateMonth11;
      $ArrDocumentPdfTime["documentDateDay"] = $documentDateDay11;
  }elseif(isset($documentDateYear2)){
      $ArrDocumentPdfTime["documentDateYear"] = $documentDateYear2;
      $ArrDocumentPdfTime["documentDateMonth"] = $documentDateMonth2;
      $ArrDocumentPdfTime["documentDateDay"] = $documentDateDay2;
  }elseif(isset($documentDateYear3)){
      $ArrDocumentPdfTime["documentDateYear"] = $documentDateYear3;
      $ArrDocumentPdfTime["documentDateMonth"] = $documentDateMonth3;
      $ArrDocumentPdfTime["documentDateDay"] = $documentDateDay3;
  }
fclose($handle);

  return $ArrDocumentPdfTime;
}else{
  return "net resurce";
}

}
}
