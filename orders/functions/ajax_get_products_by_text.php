<?

define('MAIN_FILE_EXECUTED', true);
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
require_once 'model.php';
switch ($_POST["action"]) {
    case 'get_products':
        if (isset($_POST["text"]) and $_POST["text"] != "") {
            $text = mysqli_real_escape_string($db, $_POST["text"]);
            if (mb_detect_encoding($text) == 'UTF-8') {
                $text = iconv("utf-8", "windows-1251", $text);

            };
        }
        if (isset($_POST["brand"])) {
            $brand = strip_tags($_POST["brand"]);
            if (mb_detect_encoding($brand) == 'UTF-8') {
                $brand = iconv("utf-8", "windows-1251", $brand);
            }
        }

        if (isset($text) and strlen($text) > 0) {
            $condition = " WHERE name like '%{$text}%' ";
        } else $condition = '';
        if (isset($_POST["brand"]) and strlen($brand) > 0) {
            if ($condition == ''){
                $extra_condition = " WHERE `brand`='$brand' ";
            }else{
                $extra_condition = " and `brand`='$brand' ";
            }

        } else $extra_condition = '';
        $query = "SELECT name FROM ord_products $condition $extra_condition;";
        $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='filter_by_product__item'>" . $row['name'] . "</div>";
        }
        $out = array("status" => 1);


        break;

    default:
        $out = array("status" => 0);
        break;
}

$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
ob_end_clean();
echo json_encode($out);
?>