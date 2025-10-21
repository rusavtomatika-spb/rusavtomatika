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

<h1>Добавление элемента</h1>
<div class="notes-area">
    <?
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "add_element") {
            $db_work = new DBWORK();
            $arguments["name"] = $_GET["name"];
            $arguments["h1"] = $_GET["h1"];
            $arguments["code"] = $_GET["code"];
            $arguments["section_code"] = $_GET["section_code"];
            $arguments["picture_preview"] = $_GET["picture_preview"];
            $arguments["picture_detail"] = $_GET["picture_detail"];
            $arguments["text_preview"] = $_GET["text_preview"];
            $arguments["text_detail"] = $_GET["text_detail"];
            $arguments["price"] = $_GET["price"];
            $arguments["in_stock"] = $_GET["in_stock"];
            $arguments["title"] = $_GET["title"];
            $arguments["description"] = $_GET["description"];
            $arguments["keywords"] = $_GET["keywords"];
            $result = $db_work->add_catalog_element($arguments);
            if ($result["success"] == true) {
                foreach ($arguments as $value) {
                    $value = "";
                }
                echo "<div class='success_message'>" . $result["message"] . "</div>";
                if (isset($_GET["submit_and_close"])) {
                    header('Refresh:0; list_elements.php?success=' . $result["success"] . '&section_code=' . $arguments["section_code"] . '&message=' . urlencode($result["message"]));
                }
            } else {
                echo "<div class='error_message'>" . $result["message"] . "</div>";
            }
        }
    }
    if (isset($result) and $result["success"] == true) {
        $arguments["name"] = "";
        $arguments["h1"] = "";
        $arguments["code"] = "";
        $arguments["price"] = "";
        $arguments["in_stock"] = "";
        $arguments["picture_preview"] = "";
        $arguments["picture_detail"] = "";
        $arguments["text_preview"] = "";
        $arguments["title"] = "";
        $arguments["description"] = "";
        $arguments["keywords"] = "";
    } else {
        if (isset($_GET["name"])) {
            $arguments["name"] = $_GET["name"];
        } else {
            $arguments["name"] = "";
        }
        if (isset($_GET["h1"])) {
            $arguments["h1"] = $_GET["h1"];
        } else {
            $arguments["h1"] = "";
        }
        if (isset($_GET["code"])) {
            $arguments["code"] = $_GET["code"];
        } else {
            $arguments["code"] = "";
        }
        if (isset($_GET["section_code"])) {
            $arguments["section_code"] = $_GET["section_code"];
        } else {
            $arguments["section_code"] = "";
        }
        if (isset($_GET["picture_preview"])) {
            $arguments["picture_preview"] = $_GET["picture_preview"];
        } else {
            $arguments["picture_preview"] = "";
        }
        if (isset($_GET["picture_detail"])) {
            $arguments["picture_detail"] = $_GET["picture_detail"];
        } else {
            $arguments["picture_detail"] = "";
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
        if (isset($_GET["price"])) {
            $arguments["price"] = $_GET["price"];
        } else {
            $arguments["price"] = "";
        }
        if (isset($_GET["in_stock"])) {
            $arguments["in_stock"] = $_GET["in_stock"];
        } else {
            $arguments["in_stock"] = "";
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
    }
    $sections_html = '<input type="text" name="section_code" value="' . htmlspecialchars($arguments["section_code"]) . '">';
    ?>
</div>
<form action="/admin/add_element.php" method="get">
    <input type="hidden" name="action" value="add_element">
    <table>
        <tr>
            <td colspan="2" class="td_buttons">
                <input type="reset" value="Сбросить поля">
                <input type="submit" value="Добавить">
                <input name="submit_and_close" value="Сохранить и закрыть" type="submit">
                <input type="button" onclick="history.back();" value="Вернуться назад"/>
                <input type="button" onclick="javascript:document.location.href = '/admin/list_elements.php?section_code=<?= $arguments["section_code"] ?>';" value="Вернуться в раздел"/>
            </td>
        </tr>
        <tr>
            <td class="col1">Наименование элемента (рус):</td>
            <td><input type="text" name="name" value="<?= $arguments["name"] ?>"></td>
        </tr>
        <tr>
            <td class="col1">H1:</td>
            <td><input type="text" name="h1" value="<?= $arguments["h1"] ?>"></td>
        </tr>
        <tr>
            <td>Код элемента (eng):</td>
            <td><a href="#" class="translit_code">+</a><input type="text" name="code"  value="<?= $arguments["code"] ?>"></td>
        </tr>
        <tr>
            <td>Код родительского раздела:</td>
            <td><?= $sections_html ?>
            </td>
        </tr>
        <tr>
            <td>Цена:</td>
            <td><input type="text" name="price"  value="<?= $arguments["price"] ?>"></td>
        </tr>
        <tr>
            <td>Наличие:</td>
            <td><input type="text" name="in_stock"  value="<?= $arguments["in_stock"] ?>"></td>
        </tr>
        <tr>
            <td>Путь к изображению для анонса:</td>
            <td><input type="text" name="picture_preview"  value="<?= $arguments["picture_preview"] ?>"></td>
        </tr>
        <tr>
            <td>Путь к изображению для карточки:</td>
            <td><input type="text" name="picture_detail"  value="<?= $arguments["picture_detail"] ?>"></td>
        </tr>
        <tr>
            <td>Текст анонса:</td>
            <td><textarea class="anons" name="text_preview"><?= $arguments["text_preview"] ?></textarea></td>
        </tr>
        <tr>
            <td>Текст карточки:</td>
            <td><textarea class="detail" name="text_detail"><?= $arguments["text_detail"] ?></textarea></td>
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
            <td colspan="2" class="td_buttons">
                <input type="reset" value="Сбросить поля">
                <input type="submit" value="Добавить">
                <input name="submit_and_close" value="Сохранить и закрыть" type="submit">
                <input type="button" onclick="history.back();" value="Вернуться назад"/>
                <input type="button" onclick="javascript:document.location.href = '/admin/list_elements.php?section_code=<?= $row["section_code"] ?>';" value="Вернуться в раздел"/>
            </td>
        </tr>
    </table>
</form>

<? include $core_admin_path . 'template/footer.php'; ?>