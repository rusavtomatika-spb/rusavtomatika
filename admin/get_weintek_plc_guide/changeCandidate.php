<?
header('Content-Type: text/html; charset=utf-8');
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST["password"] !== "3319333"){exit;}
define("bullshit", 1);
    global $mysqli_db;
        global $db;
        include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
        database_connect();

if(!empty($_POST["data"])){
  foreach ($_POST["data"] as $value) {
  $query = "UPDATE `moisait_ra`.`documents` SET `candidate` = '0' WHERE `documents`.`title` = '{$value}';";
  $outMysqlQuery = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
  }
}
