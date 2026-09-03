<?php
define('admin', true);
if (0) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
$core_admin_path = $_SERVER['DOCUMENT_ROOT'] . '/admin/';
include_once $core_admin_path . 'template/header.php';
include_once $core_admin_path . 'menu.php';
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

$result = $db_work->get_list_catalog_sections();
echo "<div class='block_list_elements_sectionlinks'>";
if (isset($_GET['section_code'])) {
    echo "<a href='?'>ВСЕ разделы</a> ";
} else {
    echo "<a class='active' href='?'>ВСЕ разделы</a> ";
}
foreach ($result as $row) {
    if (isset($_GET['section_code']) and $_GET['section_code'] == $row['code'])
        $active = "active";
    else
        $active = "";
    echo "<a class='$active' href='?section_code=" . $row['code'] . "' >" . $row['name'] . " (" . $row['id'] . ")</a> ";
}
echo "</div>";
if (isset($_GET['section_code']))
    $section_code = strip_tags($_GET['section_code']);
else
    $section_code = "";

$result = $db_work->get_list_catalog_elements($section_code);
if (!empty($result)) {
    echo "<table>";
    echo "<tr>";
    echo "<th colspan='7' ></th>";
    echo "<th  style='width:20%;' class='td_center'><a class='add_link' href='/admin/add_element.php?section_code=$section_code'>Добавить элемент</a></th>";
    echo "</tr>";
    echo "<tr>";
    echo "<th class='id td_center'>id</th><th>name</th><th>code</th>"
    . "<th class='td_center' style='width:5%;'>price</th>"
    . "<th class='td_center' style='width:5%;'>in_stock</th>"
    . "<th class='td_center'>редактировать</th>"
    . "<th class='td_center' style='width:20%;'>переместить <a href='/admin/list_elements.php?action=recalculate_positions&section_code=$section_code'>пересчитать по сотням</a></th>"
    . "<th class='td_center'>удалить</th>";
    echo "</tr>";
    $counter = 0;
    if (is_array($result)) {
        foreach ($result as $row) {
            $counter++;
            if ($row['section_code']) {
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
            echo '<a class="" href="/admin/edit_element.php?id=' . $row['id'] . '">' . $row['id'] . '</a>';
            echo "</td>";
            echo "<td class='name'>";
            echo '<a class="" href="/admin/edit_element.php?id=' . $row['id'] . '">' . $row['name'] . '</a>';
            echo "</td>";
            echo "<td class='code'>";
            echo $row['code'];
            echo "</td>";
            echo "<td class='td_center price'>";
            echo $row['price'];
            echo "</td>";
            echo "<td class='td_center in_stock'>";
            echo $row['in_stock'];
            echo "</td>";
            echo "<td class='td_center'>";
            echo '<a class="" href="/admin/edit_element.php?id=' . $row['id'] . '">редактировать</a>';
            echo "</td>";
            echo "<td class='td_center'>";
            if (!isset($_GET["section_code"]))
                $_GET["section_code"] = "";
            ?>
            <form class="set_position_form" action="/admin/list_elements.php" method="get">
                <input type="hidden" name="action" value="set_position">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <input type="hidden" name="section_code" value="<?= $_GET["section_code"] ?>">
                <input class="set_position_text" type="text" name="position" value="<?= $row['position'] ?>">
                <input class="set_position_button" type="submit" value="ok">
            </form>
            <?
            echo '<a class="" href="/admin/list_elements.php?action=move_up&section_code=' . $_GET["section_code"] . '&id=' . $row['id'] . '">вверх</a> &nbsp; ';
            echo '<a class="" href="/admin/list_elements.php?action=move_down&section_code=' . $_GET["section_code"] . '&id=' . $row['id'] . '">вниз</a>';
            echo "</td>";
            echo "<td class='td_center'>";
            if (isset($_GET["section_code"])) {
                echo '<a class="check_delete" href="?action=delete_element&section_code=' . $_GET["section_code"] . '&id=' . $row['id'] . '">удалить</a>';
            } else {
                echo '<a class="check_delete" href="?action=delete_element&&id=' . $row['id'] . '">удалить</a>';
            }
            echo "</td>";
            echo "</tr>";
        }
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
?>

<? include $core_admin_path . 'template/footer.php'; ?>