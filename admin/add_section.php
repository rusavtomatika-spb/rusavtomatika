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
$arguments = array();
?>
<h1>Добавление нового раздела</h1>
<div class="notes-area">
    <?
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "add_section") {
            $db_work = new DBWORK();
            $arguments["name"] = $_GET["name"];
            $arguments["code"] = $_GET["code"];
            $arguments["parent_code"] = $_GET["parent_code"];
            $arguments["picture_preview"] = $_GET["picture_preview"];
            $arguments["text_preview"] = $_GET["text_preview"];
            $arguments["text_detail"] = $_GET["text_detail"];
            $arguments["extra_text1"] = $_GET["extra_text1"];
            $arguments["title"] = $_GET["title"];
            $arguments["description"] = $_GET["description"];
            $arguments["keywords"] = $_GET["keywords"];
            $arguments["template_element"] = $_GET["template_element"];
            $result = $db_work->add_catalog_section($arguments);
            if ($result["success"] == true) {
                foreach ($arguments as $value) {
                    $value = "";
                }
                echo "<div class='success_message'>" . $result["message"] . "</div>";
            } else {
                echo "<div class='error_message'>" . $result["message"] . "</div>";
            }
        }
    }
    if (isset($result["success"]) and $result["success"] == true) {
        $arguments["name"] = "";
        $arguments["code"] = "";
        //$arguments["parent_code"] = "";
        $arguments["picture_preview"] = "";
        $arguments["text_preview"] = "";
        $arguments["text_detail"] = "";
        $arguments["extra_text1"] = "";
        $arguments["title"] = "";
        $arguments["description"] = "";
        $arguments["keywords"] = "";
        $arguments["template_element"] = "";
    } else {
        if (isset($_GET["name"])) {
            $arguments["name"] = $_GET["name"];
        } else {
            $arguments["name"] = "";
        }
        if (isset($_GET["code"])) {
            $arguments["code"] = $_GET["code"];
        } else {
            $arguments["code"] = "";
        }
        if (isset($_GET["parent_code"])) {
            $arguments["parent_code"] = $_GET["parent_code"];
        } else {
            $arguments["parent_code"] = "";
        }
        if (isset($_GET["picture_preview"])) {
            $arguments["picture_preview"] = $_GET["picture_preview"];
        } else {
            $arguments["picture_preview"] = "";
        }
        if (isset($_GET["text_preview"])) {
            $arguments["text_preview"] = $_GET["text_preview"];
        } else {
            $arguments["text_preview"] = "";
        }
        if (isset($_GET["text_detail"])) {
            $arguments["text_detail"] = $_GET["text_detail"];
        } else {
            $arguments["text_detail"] = "";
        }
        if (isset($_GET["extra_text1"])) {
            $arguments["extra_text1"] = $_GET["extra_text1"];
        } else {
            $arguments["extra_text1"] = "";
        }
        if (isset($_GET["title"])) {
            $arguments["title"] = $_GET["title"];
        } else {
            $arguments["title"] = "";
        }
        if (isset($_GET["description"])) {
            $arguments["description"] = $_GET["description"];
        } else {
            $arguments["description"] = "";
        }
        if (isset($_GET["keywords"])) {
            $arguments["keywords"] = $_GET["keywords"];
        } else {
            $arguments["keywords"] = "";
        }
        if (isset($_GET["template_element"])) {
            $arguments["template_element"] = $_GET["template_element"];
        } else {
            $arguments["template_element"] = "";
        }
    }
    ?>
</div>
<form action="/admin/add_section.php" method="get">
    <input type="hidden" name="action" value="add_section">
    <table>
        <tr>
            <td class="col1">Наименование раздела (рус):</td>
            <td><input type="text" name="name" value="<?= $arguments["name"] ?>"></td>
        </tr>
        <tr>
            <td>Код раздела (eng):</td>
            <td><a href="#" class="translit_code">+</a><input type="text" name="code"  value="<?= $arguments["code"] ?>"></td>
        </tr>
        <tr>
            <td>Родительский код раздела:</td>
            <td><input type="text" name="parent_code"  value="<?= $arguments["parent_code"] ?>"></td>
        </tr>
        <tr>
            <td>Путь к изображению:</td>
            <td><input type="text" name="picture_preview"  value="<?= $arguments["picture_preview"] ?>"></td>
        </tr>
        <tr>
            <td>Текст анонса:</td>
            <td><textarea class="preview" name="text_preview"><?= $arguments["text_preview"] ?></textarea></td>
        </tr>
        <tr>
            <td>Текст подробного описания:</td>
            <td><textarea class="preview" name="text_detail"><?= $arguments["text_detail"] ?></textarea></td>
        </tr>
        <tr>
            <td>Дополнительный текст 1:</td>
            <td><textarea class="preview" name="extra_text1"><?= $arguments["extra_text1"] ?></textarea></td>
        </tr>
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title"  value="<?= $arguments["title"] ?>"></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><input type="text" name="description"  value="<?= $arguments["description"] ?>"></td>
        </tr>
        <tr>
            <td>Keywords:</td>
            <td><input type="text" name="keywords"  value="<?= $arguments["keywords"] ?>"></td>
        </tr>
        <tr>
            <td>Template_element:</td>
            <td><input type="text" name="template_element"  value="<?= $arguments["template_element"] ?>"></td>
        </tr>
        <tr>
            <td colspan="2" class="td_buttons"><input type="reset" value="Сбросить поля"><input type="submit" value="Добавить">
                <input type="button" onclick="history.back();" value="Вернуться назад"/>
            </td>
        </tr>

    </table>
</form>



<? include $core_admin_path . 'template/footer.php'; ?>