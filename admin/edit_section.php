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
/* ?>
  <pre>
  <?    var_dump($_GET) ?>
  </pre>
  <? */
if (isset($_GET["id"])) {
    $section_id = intval($_GET["id"]);
    if (isset($_GET["action"]) and $_GET["action"] == "edit_section") {
        $result = $db_work->edit_catalog_section($section_id, $_GET);
        if (isset($result) and $result["success"] == true) {
            echo "<div class='success_message'>" . $result["message"] . "</div>";
            if (isset($_GET["submit_and_close"])) {
                header('Refresh:0; list_sections.php?success=' . $result["success"] . '&message=' . urlencode($result["message"]));
            }
        }
    }
} else {
    echo "что то не так";
    exit();
}
?>
<h1>Редактирование раздела <?= $section_id ?></h1>
<div class="notes-area">
    <?
    $row = $db_work->get_catalog_section_by_id($section_id);
    $list_catalog_section_fields_text = $db_work->get_list_catalog_section_fields_text(Array("sort" => "name", "sort_direction" => "ASC"));
    ?>
</div>
<form action="/admin/edit_section.php" method="get">
    <input type="hidden" name="action" value="edit_section">
    <input type="hidden" name="id" value="<?= $row["id"] ?>">
    <table>
        <tr>
            <td colspan="2" class="td_buttons">
                <div class="sticky">
                    <input type="reset" value="Сбросить поля к исходным">
                    <input type="submit" value="Применить">
                    <input name="submit_and_close" type="submit" value="Сохранить и закрыть">
                    <input type="button" onclick="history.back();" value="Вернуться назад"/>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col1">ID раздела:</td>
            <td><b><?= $row["id"] ?></b></td>
        </tr>
        <tr>
            <td class="col1">Наименование раздела (рус):</td>
            <td><input type="text" name="name" value="<?= $row["name"] ?>"></td>
        </tr>
        <tr>
            <td>Код раздела (eng):</td>
            <td><a href="#" class="translit_code">+</a><input type="text" name="code"  value="<?= $row["code"] ?>"></td>
        </tr>
        <tr>
            <td>Родительский код раздела:</td>
            <td><input type="text" name="parent_code"  value="<?= $row["parent_code"] ?>"></td>
        </tr>
        <tr>
            <td>Путь к изображению:</td>
            <td><input type="text" name="picture_preview"  value="<?= $row["picture_preview"] ?>"></td>
        </tr>
        <tr>
            <td>Текст анонса:</td>
            <td><textarea class="preview" name="text_preview"><?= $row["text_preview"] ?></textarea></td>
        </tr>
        <tr>
            <td>Текст подробного описания:</td>
            <td><textarea class="preview" name="text_detail"><?= $row["text_detail"] ?></textarea></td>
        </tr>
        <tr>
            <td>Дополнительный текст 1:</td>
            <td><textarea class="preview" name="extra_text1"><?= $row["extra_text1"] ?></textarea></td>
        </tr>
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title"  value="<?= $row["title"] ?>"></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><input type="text" name="description"  value="<?= $row["description"] ?>"></td>
        </tr>
        <tr>
            <td>Keywords:</td>
            <td><input type="text" name="keywords"  value="<?= $row["keywords"] ?>"></td>
        </tr>
        <tr>
            <td>Template element:</td>
            <td><input type="text" name="template_element"  value="<?= $row["template_element"] ?>"></td>
        </tr>
        <tr>
            <td colspan="2" class="td_left"><h3>Привязка полей элементов к этому разделу</h3></td>
        </tr>
        <tr>
            <td colspan="2" class="td_left">
                <?
                if ($row["element_fields_text"] != "") :
                    $element_fields_text = preg_split("/[\s,]+/", trim($row["element_fields_text"]));
                    foreach ($element_fields_text as $value) {
                        //echo "=" . $value . "=<br>";
                        if ($value != "")
                            $chosen_fields[] = $value;
                    }
                endif;
                ?>
                <div class="blockofcols_container">
                    <div class="blockofcols_row">
                        <div class="col-3">
                            <?
                            $x = 0;
                            $max_x = 10;
                            foreach ($list_catalog_section_fields_text as $value) {
                                if ($x++ > $max_x) {
                                    echo '</div><div class="col-3">';
                                    $x = 0;
                                }
                                if (isset($chosen_fields) and in_array($value["id"], $chosen_fields))
                                    $checked = 'checked="checked"';
                                else
                                    $checked = "";
                                ?><div class="edit_section_checkbox_bind"><input  type="checkbox"  name="bind_fields[]" value="<?= $value["id"] ?>"  id="field<?= $value["id"] ?>" <?= $checked ?> /><label for="field<?= $value["id"] ?>"><?= $value["name"] ?> (<?= $value["id"] ?>)</label></div><?
                            }
                            ?>
                        </div>
                    </div>
                </div>



            </td>
        </tr>
        <tr>
            <td colspan="2" class="td_buttons">
                <input type="reset" value="Сбросить поля к исходным">
                <input type="submit" value="Применить">
                <input name="submit_and_close" type="submit" value="Сохранить и закрыть">
                <input type="button" onclick="history.back();" value="Вернуться назад"/>
            </td>
        </tr>

    </table>
</form>

<div></div>



<? include $core_admin_path . 'template/footer.php'; ?>