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
<h1>Список разделов</h1>
<?
if (isset($_GET["message"])) {
    if ($_GET["success"]) {
        echo "<div class='success_message'>" . strip_tags(urldecode($_GET["message"])) . "</div>";
    } else
        echo "<div class='error_message'>" . strip_tags(urldecode($_GET["message"])) . "</div>";
}

if (isset($_GET["action"]) and isset($_GET["id"])) {
    if ($_GET["action"] == "delete_section") {
        $db_work = new DBWORK();
        $result = $db_work->delete_catalog_section(intval($_GET["id"]));
        if ($result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
        } else {
            echo "<div class='error_message'>" . $result["message"] . "</div>";
        }
        header('Refresh:0; list_sections.php?success=' . $result["success"] . '&message=' . urlencode($result["message"]));
    }
}



$db_work = new DBWORK();
$result = $db_work->get_list_catalog_sections();
if (!empty($result)) {
    echo "<table>";
    echo "<tr>";
    echo "<th>id</th><th>name</th><th>code</th><th>parent_code</th><th>редактировать</th><th>+ подраздел</th><th>+ элемент</th><th>удалить</th>";

    echo "</tr>";
    foreach ($result as $row) {
        if ($row['parent_code']) {
            $sub_section = "sub_section";
            $mark = "-> ";
        } else {
            $sub_section = "";
            $mark = "";
        }
        echo "<tr>";
        echo "<td class='id td_center'>";
        echo $row['id'];
        echo "</td>";
        echo "<td class='name " . $sub_section . "'>";
        echo $mark . $row['name'];
        echo "</td>";
        echo "<td class='code'>";
        echo $row['code'];
        echo "</td>";
        echo "<td>";
        echo $row['parent_code'];
        echo "</td>";
        echo "<td class='td_center'>";
        echo '<a class="" href="/admin/edit_section.php?id=' . $row['id'] . '">редактировать</a>';
        echo "</td>";
        echo "<td class='td_center'>";
        echo '<a class="" href="/admin/add_section.php?parent_code=' . $row['code'] . '">+&nbsp;подраздел</a>';
        echo "</td>";
        echo "<td class='td_center'>";
        echo '<a class="" href="/admin/add_element.php?section_code=' . $row['code'] . '">+&nbsp;элемент</a>';
        echo "</td>";
        echo "<td class='td_center'>";
        echo '<a class="check_delete" href="?action=delete_section&id=' . $row['id'] . '">удалить</a>';
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<? include $core_admin_path . 'template/footer.php'; ?>