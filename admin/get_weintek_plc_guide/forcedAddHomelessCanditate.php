<?
header('Content-Type: text/html; charset=utf-8');
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST["password"] !== "3319333"){exit;}
define("bullshit", 1);
    global $mysqli_db;
    global $db;
    include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
    database_connect();

    $query = "SELECT title, original_file_name, original_url FROM `documents` WHERE `section` = 'Weintek' and `subSection` = 'Руководства по подключению ПЛК' and `candidate` = '1' ;";
    $outMysqlStrings = '';
    $outMysqlQuery = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
    $rows = mysqli_num_rows($outMysqlQuery);

    if ($rows > 0) {

        for ($row = 0; $row < $rows; $row++) {
            $current_row = mysqli_fetch_assoc($outMysqlQuery);
            $outMysqlStrings[] = $current_row;
        }

$counter = 0;


foreach ($outMysqlStrings as $key => $value) {

  $arrResult[$counter]["driver"] = $value["title"];
  $arrResult[$counter]["fn"] = $value["original_file_name"];
  $arrResult[$counter]["fnUrl"] = $value["original_url"];

  $counter++;
}

    } ;

echo json_encode($arrResult);
