<?php
ini_set('error_reporting', E_ALL && ~e_deprecated);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=utf-8');

define("bullshit", 1);
global $mysqli_db;
global $db;
include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
database_connect();

$file = "https://docs.google.com/feeds/download/spreadsheets/Export?key=1ZUHidY6L0gfo7vzMuUf0ZgHbzTNlMaQBKbuHhHY-rlE&exportFormat=csv&gid=0";
?>
<div style="padding: 20px;font-size: 18px;line-height: 2">

<?php
echo "fIle " . $file;
//echo "fIle " . __DIR__ . "/table_products.csv";
echo "<br>";
echo "<a target='_blank' href='/discounted/'>https://www.rusavto.moisait.net/discounted/</a>";
echo "<br>";
echo "<a href='/discounted/parser.php?action=update'>Обновить базу</a>";
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_GET["action"];
?>
    </div>
<?php





$fields = array("section","type","brand","model","name","link","price","quantity","position","detail_type","reason_of_markdown","preview_picture","images");
?>

    <table>
        <?php
        $row = 1;
        if (($handle = fopen($file, "r")) !== FALSE) {
//            if (($handle = fopen(__DIR__ . "/table_products.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);

                ?>
                <tr>
                    <?
                    $row++;
                    for ($c = 0; $c < $num; $c++) {

                        $insert_data[$fields[$c]] = $data[$c];

                        echo "<td>". $data[$c] . "</td>";
                    }
                    if($_SERVER['HTTP_HOST'] == "www.rusavto.moisait.net" and isset($_GET["action"]) and $_GET["action"] == "update" and isset($insert_data["model"]) and $row>2){
                        echo "<td>";
                        if (!test_model_already_exists($insert_data["model"])){
                            insert_product($insert_data);
                        }else{
                            update_product($insert_data);
                        }
                        echo "</td>";
                    }
                    ?>
                </tr>
                <?
            }
            if($_SERVER['HTTP_HOST'] == "www.rusavto.moisait.net" and isset($_GET["action"]) and $_GET["action"] == "update") delete_not_flagged();
            fclose($handle);
        } ?>
    </table>
<?php

function test_model_already_exists($model)
{
    global $mysqli_db;
    mysqli_set_charset($mysqli_db, "utf8");
    $query = "SELECT id, model FROM `discounted` WHERE model = '$model'";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    $row = mysqli_fetch_assoc($result);
    return $row["id"];
}

function insert_product($arr_data)
{
    if (isset($arr_data["model"])) {
        global $mysqli_db;
        $query = "INSERT INTO `discounted`";
        $query .= "(`id`, `section`, `type`, `brand`, `model`, `name`, `link`, `price`, `quantity`, `position`, `detail_type`, `reason_of_markdown`, `preview_picture`, `images`, `flag`) VALUES ";
        $query .= "(NULL, '{$arr_data['section']}', '{$arr_data['type']}', '{$arr_data['brand']}', '{$arr_data['model']}', '{$arr_data['name']}', '{$arr_data['link']}', '{$arr_data['price']}',";
        $query .= "'{$arr_data['quantity']}', {$arr_data['position']}, '{$arr_data['detail_type']}', '{$arr_data['reason_of_markdown']}', '{$arr_data['preview_picture']}', '{$arr_data['images']}', 'new');";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        if ($result) echo "<span style='color: red'>inserted</span>";
        return;
    } else return false;
}
function update_product($arr_data)
{
    if (isset($arr_data["model"])) {
        global $mysqli_db;
        $query = "UPDATE `discounted` SET `section` = '{$arr_data['section']}', `type` = '{$arr_data['type']}', `brand` = '{$arr_data['brand']}', `name` = '{$arr_data['name']}',";
        $query .= " `link` = '{$arr_data['link']}', `price` = '{$arr_data['price']}', `quantity` = '{$arr_data['quantity']}', `position` = '{$arr_data['position']}', `detail_type` = '{$arr_data['detail_type']}', `reason_of_markdown` = '{$arr_data['reason_of_markdown']}', `preview_picture` = '{$arr_data['preview_picture']}', `images` = '{$arr_data['images']}', `flag` = 'updated' WHERE `model` = '{$arr_data['model']}';";
        $result =  mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        if ($result) echo "<span style='color: red'>updated</span>";
    } else return false;
}

function delete_not_flagged()
{
    global $mysqli_db;
    $query = "DELETE FROM `discounted` WHERE `flag` = '';";
    $result =  mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    $query = "UPDATE `discounted` SET `flag` = ''";
    $result =  mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
}


?>