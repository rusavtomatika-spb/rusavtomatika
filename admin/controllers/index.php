<?php
//ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('admin', true);
define('CONTROLLERS', true);
global $ftpConnectionID;
$core_admin_path = $_SERVER['DOCUMENT_ROOT'] . '/admin/';
include $core_admin_path . 'template/header.php';
?><h1>Административная панель - Старый каталог CONTROLLERS</h1><?
include $core_admin_path . 'controllers/menu.php';
include $core_admin_path . 'controllers/classes/functions.php';
/* * *************************************************************************** */
/* $db_work = new DBWORK();
  $db_work->show_tables(); */
?>
<h1>Список ЭЛЕМЕНТОВ</h1>
<?
if (isset($_GET["message"])) {
    if ($_GET["success"]) {
        echo "<div class='success_message'>" . strip_tags(urldecode($_GET["message"])) . "</div>";
    } else
        echo "<div class='error_message'>" . strip_tags(urldecode($_GET["message"])) . "</div>";
}

if (isset($_GET["action"]) and isset($_GET["id"])) {
    if ($_GET["action"] == "delete_element") {
        $db_work = new DBWORK();
        $result = $db_work->delete_catalog_element(intval($_GET["id"]));
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    } elseif ($_GET["action"] == "move_up") {
        $db_work = new DBWORK();
        $result = $db_work->move_up_catalog_element(intval($_GET["id"]), $_GET["section_code"]);
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    } elseif ($_GET["action"] == "move_down") {
        $db_work = new DBWORK();
        $result = $db_work->move_down_catalog_element(intval($_GET["id"]), $_GET["section_code"]);
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    } elseif ($_GET["action"] == "set_position") {
        $db_work = new DBWORK();
        $result = $db_work->set_position_catalog_element(intval($_GET["id"]), intval($_GET["position"]));
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    }
}
if (isset($_GET["action"]) and $_GET["action"] == "recalculate_positions" and isset($_GET["section_code"]) and $_GET["section_code"] != "") {
    $db_work = new DBWORK();
    $result = $db_work->recalculate_positions_catalog_element($_GET["section_code"]);
    if ($result["success"] == true) {
        echo "<div class='success_message'>" . $result["message"] . "</div>";
    } else {
        echo "<div class='error_message'>" . $result["message"] . "</div>";
    }
    //header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
}




$db_work = new DBWORK();
if (isset($_GET["sort_by"])){
$result = $db_work->get_list_catalog_elements($_GET["sort_by"]);
}
else{$result = $db_work->get_list_catalog_elements();}

if (!empty($result)) {
    echo "<table>";
    
    echo "<colgroup>";
    echo "<col style='width:1%'>";
    echo "<col style='width:15%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "<col style='width:1%'>";
    echo "</colgroup>";
    echo "<tr>";
    echo "<th class='id td_center'><a class='";
    if ($_GET["sort_by"] == "index")
        echo "sort_active";
    echo "' href='?sort_by=index'>id</a></th><th>Images</th><th>Upload</th><th><a class='";
    if ($_GET["sort_by"] == "model")
        echo "sort_active";
    echo "' href='?sort_by=model'>name</a></th>";
    echo "<th>";
    echo "<a class='";
    if ($_GET["sort_by"] == "brand")
        echo "sort_active";
    echo "' href='?sort_by=brand'>brand</a>";
    echo "</th>"
    . "<th class='td_center' style='width:5%;'>Type</th>"
    
    . "<th class='td_center'>Edit</th>";
    echo "</tr>";
    $counter = 0;
    if (is_array($result)) {
        connectToFTP();    
        foreach ($result as $row) {
//            $imagesHtml = getImagesHtml($row);
            $imagesHtml = getRemoteFTPImagesHtml($row);
            
            $counter++;
            if (isset($row['section_code']) && $row['section_code']) {
                $sub_section = "sub_section";
                $mark = "-> ";
            } else {
                $sub_section = "";
                $mark = "";
            }
            if (isset($_GET["element_id"]) and ( $_GET["element_id"] == $row["id"])):
                echo "<tr class='tr_green'>";
            else:
                echo "<tr>";
            endif;
            echo "<td class='id td_center'>";
            echo '<a class="" href="/admin/controllers/edit_element.php?index=' . $row['index'] . '">' . $row['index'] . '</a>';
            echo "</td>";
            echo "<td class='td_right'>";
            echo '<div class="list_of_images" id="product_id_' . $row['index'] . '">'.$imagesHtml.'</div>';            
            echo "</td>";
            echo "<td>";
            echo '<form name="formUploadImage2" method="post" enctype="multipart/form-data"><input type="hidden" name="product_id" value="'.$row['index'].'"><input type="file" autocomplete="off" name="picture"><br><input disabled="disabled" autocomplete="off" type="submit" value="Загрузить"></form>';
            echo "</td>";
            echo "<td class='name'>";
            echo '<a class="" href="/admin/controllers/edit_element.php?index=' . $row['index'] . '">' . $row['model'] . '</a>';
            echo "</td>";
            echo "<td class='code'>";
            echo $row['brand'];
            echo "</td>";
            echo "<td class='td_left price'>";
            echo $row['type'];
            echo "</td>";
            echo "<td class='td_center'>";
            echo '<a class="" href="/admin/controllers/edit_element.php?index=' . $row['index'] . '">редактировать</a><br>';
            
if (isset($_GET["section_code"])) {
                echo '<a class="check_delete" href="?action=delete_element&section_code=' . $_GET["section_code"] . '&id=' . $row['index'] . '">удалить</a>';
            } else {
                echo '<a class="check_delete" href="?action=delete_element&&id=' . $row['index'] . '">удалить</a>';
            }            
            echo "</td>";
            
            echo "</tr>";
        }
        disconnectFTP();
        
            } else {
        echo "<tr>";
        echo "<th colspan='8'> - пусто - </th>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<th colspan='8' class='td_center'> Всего $counter строк </th>";
    echo "</tr>";
    echo "</table>";
}

/* * *************************************************************************** */
include $core_admin_path . 'template/footer.php';
?>



