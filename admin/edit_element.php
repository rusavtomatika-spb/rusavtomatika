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
$row = array();
$db_work = new DBWORK();
if (isset($_GET["id"])) {
    $element_id = intval($_GET["id"]);
    if (isset($_POST["action"]) and $_POST["action"] == "edit_element") {

        $result = $db_work->edit_catalog_element($element_id, $_POST);
        if (isset($result) and $result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
            if (isset($_POST["submit_and_close"])) {
                header('Refresh:0; list_elements.php?success=' . $result["success"] . '&element_id=' . $result["element_id"] . '&section_code=' . $_POST["section_code"] . '&message=' . urlencode($result["message"]));
            }
        }
    }
} else {
    echo "что то не так";
    exit();
}
?>
<h1>Редактирование элемента <?= $element_id ?></h1>
<div class="notes-area">
    <div>
        <?
        $row = $db_work->get_catalog_element_by_id($element_id);
        $list_catalog_element_fields_text = $db_work->get_list_catalog_element_fields_text(Array("id" => $element_id));
        //var_dump($list_catalog_element_fields_text);
        ?>
    </div>
</div>
<form action="/admin/edit_element.php?id=<?= $row["id"] ?>" method="post">
    <input type="hidden" name="action" value="edit_element">
    <input type="hidden" name="id" value="<?= $row["id"] ?>">
    <table>
        <tr>
            <td colspan="2" class="td_buttons">
                <div class="sticky">
                    <input type="reset" value="Сбросить поля к исходным">
                    <input type="submit" value="Применить">
                    <input name="submit_and_close" type="submit" value="Сохранить и закрыть">
                    <input type="button" onclick="history.back();" value="Вернуться назад"/>
                    <input type="button" onclick="javascript:document.location.href = '/admin/list_elements.php?section_code=<?= $row["section_code"] ?>';" value="Вернуться в раздел"/>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col1">ID элемента:</td>
            <td><b><?= $row["id"] ?></b></td>
        </tr>
        <tr>
            <td class="col1">Наименование элемента (рус):</td>
            <td><input type="text" name="name" value="<?= $row["name"] ?>"></td>
        </tr>
        <tr>
            <td class="col1">H1:</td>
            <td><input type="text" name="h1" value="<?= $row["h1"] ?>"></td>
        </tr>
        <tr>
            <td>Код элемента (eng):</td>
            <td><a href="#" class="translit_code">+</a><input type="text" name="code"  value="<?= $row["code"] ?>"></td>
        </tr>
        <tr>
            <td>Код родительского раздела:</td>
            <td>
                <?
                $db_list_catalog_sections = new DBWORK();
                $sections = $db_list_catalog_sections->get_list_catalog_sections();
                ob_start();
                echo '<select name="section_code">';
                foreach ($sections as $value) {
                    if ($row["section_code"] == $value["code"])
                        $selected = "selected='selected'";
                    else
                        $selected = "";
                    echo "<option " . $selected . " value='" . $value["code"] . "'>";
                    echo $value["name"] . " (" . $value["id"] . ") (" . $value["code"] . ")";
                    echo "</option>";
                }
                echo "</select>";
                $sections_html = ob_get_contents();
                ob_end_clean();

                echo $sections_html;
                ?></td>
        </tr>
        <tr>
            <td>Цена:</td>
            <td><input type="text" name="price"  value="<?= $row["price"] ?>"></td>
        </tr>
        <tr>
            <td>Наличие:</td>
            <td><input type="text" name="in_stock"  value="<?= $row["in_stock"] ?>"></td>
        </tr>
        <tr>
            <td>Путь к изображению для анонса:</td>
            <td><input type="text" name="picture_preview"  value="<?= stripslashes($row["picture_preview"]) ?>"></td>
        </tr>
        <tr>
            <td>Путь к изображению для карточки:</td>
            <td><input type="text" name="picture_detail"  value="<?= stripslashes($row["picture_detail"]) ?>"></td>
        </tr>
        <tr>
            <td>Текст анонса:</td>
            <td><textarea class="preview" name="text_preview"><?= stripslashes($row["text_preview"]) ?></textarea></td>
        </tr>
        <tr>
            <td>Текст подробного описания:</td>
            <td><textarea class="preview" name="text_detail"><?= stripslashes($row["text_detail"]) ?></textarea></td>
        </tr>
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title"  value="<?= stripslashes($row["title"]) ?>"></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><input type="text" name="description"  value="<?= stripslashes($row["description"]) ?>"></td>
        </tr>
        <tr>
            <td>Keywords:</td>
            <td><input type="text" name="keywords"  value="<?= stripslashes($row["keywords"]) ?>"></td>
        </tr>
        <tr>
            <td colspan="2" class="td_left"><h3>Дополнительные поля </h3></td>
        </tr>
        <? if (is_array($list_catalog_element_fields_text)): ?>
            <?
            foreach ($list_catalog_element_fields_text as $value) {
                if (!isset($value["value"]["value"])) {
                    $value["value"]["value"] = "";
                }
                if (!isset($value["value"]["value_rus"])) {
                    $value["value"]["value_rus"] = "";
                }
                ?>
                <tr>
                    <td><?= $value["name"] ?><br>(<?= $value["code"] ?>):
                    </td>
                    <td>
                        <?
                        switch ($value["type"]) {
                            case "textarea":
                                ?>

                                <textarea  name="extra_fields[][<?= $value["id"] ?>]" id="<?= $value["code"] ?>"><?= stripslashes($value["value"]["value"]) ?></textarea>
                                <textarea name="extra_fields_rus[][<?= $value["id"] ?>]" id="<?= $value["code"] ?>"><?= stripslashes($value["value"]["value_rus"]) ?></textarea>
                                <?
                                break;
                            case "files":
                                ?>
                                <input  type="text"  name='extra_fields[][<?= $value["id"] ?>]' value="<?= stripslashes($value["value"]["value"]) ?>"   />
                                <input  type="hidden"  name='extra_fields_rus[][<?= $value["id"] ?>]' value=" " />
                                <?
                                break;

                            default:
                                // var_dump($value);
                                if ($value["id"] == 22)
                                    echo '<div>' . $row["code"] . '</div>';
                                ?>
                                <input  type="text"  name='extra_fields[][<?= $value["id"] ?>]' value="<?= stripslashes($value["value"]["value"]) ?>"   />
                                <input  type="text"  name='extra_fields_rus[][<?= $value["id"] ?>]' value="<?= stripslashes($value["value"]["value_rus"]) ?>"   />
                                <?
                                break;
                        }
                        ?>
                    </td>
                </tr>
                <?
            }
            ?>
        <? endif; ?>
        <tr>
            <td colspan="2" class="td_buttons">
                <input type="reset" value="Сбросить поля к исходным">
                <input type="submit" value="Применить">
                <input name="submit_and_close" type="submit" value="Сохранить и закрыть">
                <input type="button" onclick="history.back();" value="Вернуться назад"/>
                <input type="button" onclick="javascript:document.location.href = '/admin/list_elements.php?section_code=<?= $row["section_code"] ?>';" value="Вернуться в раздел"/>
            </td>
        </tr>

    </table>
</form>

<div></div>



<? include $core_admin_path . 'template/footer.php'; ?>