<?
header('Content-Type: text/html; charset=utf-8');
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST["password"] !== "3319333"){exit;}
define("bullshit", 1);
global $mysqli_db;
global $db;
include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
database_connect();


$arrResult = [];
$arrNewDocuments = [];
$arrUpdateDocuments = [];

foreach ($_POST["data"] as $key => $value) {

  $value["driver"] = mb_convert_encoding($value["driver"], "windows-1251", "UTF-8");
  $value["fn"] = mb_convert_encoding($value["fn"], "windows-1251", "UTF-8");
  $value["fnUrl"] = mb_convert_encoding($value["fnUrl"], "windows-1251", "UTF-8");

  $query = "SELECT id,hash_local FROM `documents` WHERE `section` = 'Weintek' and `title` = '{$value["driver"]}' ;";
  $outMysqlStrings = '';
  $outMysqlQuery = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));

  $rows = mysqli_num_rows($outMysqlQuery);
  if ($rows > 0) {
    for ($row = 0; $row < $rows; $row++) {
      $current_row = mysqli_fetch_assoc($outMysqlQuery);
      $outMysqlStrings[] = $current_row;
    }



    if ($outMysqlStrings[0]["hash_local"] !== $value["hash"]) {
      $query = "UPDATE `moisait_ra`.`documents` SET `hash_local` = '{$value["hash"]}', `candidate` = '1', `date` = '{$value['date']}' WHERE `documents`.`title` = '{$value["driver"]}';";
      $outMysqlQuery = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
      $arrUpdateDocuments = array_merge($arrUpdateDocuments, $value);
      $arrResult["updateDocument"][] = $arrUpdateDocuments;
    }
  } else {
    $query = "INSERT INTO `moisait_ra`.`documents` (`id`, `title`, `section`, `subSection`, `brand`, `url_en`, `url_ru`, `date`, `format`, `description`, `position`, `hash_local`, `candidate`, `original_file_name`, `original_url`) VALUES (NULL, '{$value['driver']}', 'Weintek', 'Руководства по подключению ПЛК', '{$value["brand"]}' ,'https://www.rusavtomatika.com/upload_files/drivers/{$value["fn"]}', '', '{$value["date"]}', 'pdf', '', '', '{$value["hash"]}', '1', '{$value["fn"]}', '{$value["fnUrl"]}');";
      $outMysqlQuery = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
      $arrNewDocuments = array_merge($arrNewDocuments, $value);
      $arrResult["newDocument"][] = $arrNewDocuments;
    };

  }



  echo json_encode($arrResult);
