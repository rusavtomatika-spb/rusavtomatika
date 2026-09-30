<?php
define('admin', true);

$core_admin_path = $_SERVER['DOCUMENT_ROOT'] . '/admin/';
include_once $core_admin_path . 'template/header.php';
include_once $core_admin_path . 'menu.php';
require_once $core_admin_path . 'classes/functions.php';
@header("Content-Type: text/html; charset=utf-8");

$db_work = new DBWORK();
$errors  = array();
$success = '';

$form_fields = array(
    'model', 'model_fullname', 'type', 'brand', 's_name', 'series', 'articuls',
    'section', 'retail_price', 'currency', 'onstock', 'sort',
    'pic_small', 'pic_big',
    'h1', 'title', 'description', 'keywords', 'short_name', 'page_path',
    'text_preview', 'text_features', 'text_detail', 'text_seo',
    'diagonal', 'resolution', 'colors', 'cpu_type', 'ram', 'flash',
    'voltage', 'temp_operating', 'netto',
    'status', 'new_product', 'discontinued',
);

$arguments = array_fill_keys($form_fields, '');
$arguments['currency']    = 'USD';
$arguments['status']      = '1';
$arguments['new_product'] = '0';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['action']) && $_POST['action'] === 'add_element') {
    foreach ($form_fields as $f) {
        $arguments[$f] = isset($_POST[$f]) ? trim($_POST[$f]) : '';
    }

    if ($arguments['model'] === '') $errors[] = 'Поле «Модель» обязательно';
    if ($arguments['type'] === '')  $errors[] = 'Поле «Тип» обязательно';
    if ($arguments['brand'] === '') $errors[] = 'Поле «Бренд» обязательно';

    if (count($errors) === 0) {
        $result = $db_work->add_product_element($arguments);
        if (!empty($result['success'])) {
            $success = $result['message'];
            if (isset($_POST['submit_and_close'])) {
                header('Location: /admin');
                exit;
            }
            $arguments = array_fill_keys($form_fields, '');
            $arguments['currency']    = 'USD';
            $arguments['status']      = '1';
            $arguments['new_product'] = '0';
        } else {
            $errors[] = isset($result['message']) ? $result['message'] : 'Ошибка добавления';
        }
    }
}

$brands = $db_work->get_brands();
$types  = $db_work->get_types();
$series = $db_work->get_series();
if (!is_array($brands)) $brands = array();
if (!is_array($types))  $types  = array();
if (!is_array($series)) $series = array();
?>
<h1>Добавление элемента</h1>

<div class="notes-area">
    <?php foreach ($errors as $e): ?>
        <div class="error_message"><?= htmlspecialchars($e) ?></div>
    <?php endforeach; ?>
    <?php if ($success): ?>
        <div class="success_message"><?= htmlspecialchars($success) ?></div>
        <script>setTimeout(function(){ location.href='/admin'; }, 2000);</script>
    <?php endif; ?>
</div>

<form action="/admin/add_element.php" method="post">
    <input type="hidden" name="action" value="add_element">
    <table>
        <tr>
            <td colspan="2" class="td_buttons">
                <input type="reset" value="Сбросить поля">
                <input type="submit" value="Добавить">
                <input name="submit_and_close" value="Сохранить и закрыть" type="submit">
                <input type="button" onclick="history.back();" value="Вернуться назад">
                <input type="button" onclick="location.href='/admin'" value="Вернуться в список">
            </td>
        </tr>

        <tr><td class="col1">Модель (model) *:</td>
            <td><input type="text" name="model" maxlength="50" required
                       value="<?= htmlspecialchars($arguments['model']) ?>"></td></tr>

        <tr><td>Полное название (model_fullname):</td>
            <td><input type="text" name="model_fullname" maxlength="256"
                       value="<?= htmlspecialchars($arguments['model_fullname']) ?>"></td></tr>

        <tr><td>Тип (type) *:</td>
            <td>
                <select name="type" required>
                    <option value="">-- выберите --</option>
                    <?php foreach ($types as $t):
                        $code  = isset($t['code']) ? $t['code'] : '';
                        $label = !empty($t['short_name']) ? $t['short_name'] : $code;
                    ?>
                        <option value="<?= htmlspecialchars($code) ?>"
                            <?= $arguments['type'] === $code ? 'selected' : '' ?>>
                            <?= htmlspecialchars($label) ?> (<?= htmlspecialchars($code) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td></tr>

        <tr><td>Бренд (brand) *:</td>
            <td>
                <select name="brand" required>
                    <option value="">-- выберите --</option>
                    <?php foreach ($brands as $b):
                        $code = isset($b['code']) ? $b['code'] : '';
                        $name = isset($b['name']) ? $b['name'] : $code;
                    ?>
                        <option value="<?= htmlspecialchars($code) ?>"
                            <?= $arguments['brand'] === $code ? 'selected' : '' ?>>
                            <?= htmlspecialchars($name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td></tr>

        <tr><td>Короткое название (s_name):</td>
            <td><input type="text" name="s_name" maxlength="255"
                       value="<?= htmlspecialchars($arguments['s_name']) ?>"></td></tr>

        <tr><td>Серия (series):</td>
            <td>
                <select name="series">
                    <option value="">-- не выбрано --</option>
                    <?php foreach ($series as $s):
                        $code  = isset($s['name']) ? $s['name'] : '';
                        $label = !empty($s['name_russian']) ? $s['name_russian'] : $code;
                    ?>
                        <option value="<?= htmlspecialchars($code) ?>"
                            <?= $arguments['series'] === $code ? 'selected' : '' ?>>
                            <?= htmlspecialchars($label) ?> [<?= htmlspecialchars($code) ?>]
                        </option>
                    <?php endforeach; ?>
                </select>
            </td></tr>

        <tr><td>Артикулы (articuls):</td>
            <td><input type="text" name="articuls"
                       value="<?= htmlspecialchars($arguments['articuls']) ?>"></td></tr>

        <tr><td>Раздел (section):</td>
            <td><input type="text" name="section" maxlength="256"
                       value="<?= htmlspecialchars($arguments['section']) ?>"></td></tr>

        <tr><td>Диагональ (diagonal):</td>
            <td><input type="number" step="0.1" name="diagonal"
                       value="<?= htmlspecialchars($arguments['diagonal']) ?>"></td></tr>

        <tr><td>Разрешение (resolution):</td>
            <td><input type="text" name="resolution" maxlength="128"
                       value="<?= htmlspecialchars($arguments['resolution']) ?>"></td></tr>

        <tr><td>Цвета (colors):</td>
            <td><input type="text" name="colors" maxlength="256"
                       value="<?= htmlspecialchars($arguments['colors']) ?>"></td></tr>

        <tr><td>Сортировка (sort):</td>
            <td><input type="number" name="sort"
                       value="<?= htmlspecialchars($arguments['sort']) ?>"></td></tr>

        <tr><td>Цена (retail_price):</td>
            <td><input type="number" name="retail_price"
                       value="<?= htmlspecialchars($arguments['retail_price']) ?>"></td></tr>

        <tr><td>Валюта (currency):</td>
            <td>
                <select name="currency">
                    <?php foreach (array('USD','RUR','EUR') as $c): ?>
                        <option value="<?= $c ?>" <?= $arguments['currency'] === $c ? 'selected' : '' ?>><?= $c ?></option>
                    <?php endforeach; ?>
                </select>
            </td></tr>

        <tr><td>В наличии (onstock):</td>
            <td><input type="number" name="onstock"
                       value="<?= htmlspecialchars($arguments['onstock']) ?>"></td></tr>

        <tr><td>Картинка анонса (pic_small):</td>
            <td><input type="text" name="pic_small" maxlength="60"
                       value="<?= htmlspecialchars($arguments['pic_small']) ?>"></td></tr>

        <tr><td>Картинка детальная (pic_big):</td>
            <td><input type="text" name="pic_big" maxlength="60"
                       value="<?= htmlspecialchars($arguments['pic_big']) ?>"></td></tr>

        <tr><td>H1:</td>
            <td><input type="text" name="h1" maxlength="255"
                       value="<?= htmlspecialchars($arguments['h1']) ?>"></td></tr>

        <tr><td>Title:</td>
            <td><input type="text" name="title" maxlength="255"
                       value="<?= htmlspecialchars($arguments['title']) ?>"></td></tr>

        <tr><td>Description:</td>
            <td><input type="text" name="description" maxlength="1024"
                       value="<?= htmlspecialchars($arguments['description']) ?>"></td></tr>

        <tr><td>Keywords:</td>
            <td><input type="text" name="keywords" maxlength="255"
                       value="<?= htmlspecialchars($arguments['keywords']) ?>"></td></tr>

        <tr><td>Короткое имя (short_name):</td>
            <td><input type="text" name="short_name" maxlength="255"
                       value="<?= htmlspecialchars($arguments['short_name']) ?>"></td></tr>

        <tr><td>URL страницы (page_path):</td>
            <td><input type="text" name="page_path" maxlength="50"
                       value="<?= htmlspecialchars($arguments['page_path']) ?>"></td></tr>

        <tr><td>Текст анонса (text_preview):</td>
            <td><textarea class="anons" name="text_preview" rows="6"><?= htmlspecialchars($arguments['text_preview']) ?></textarea></td></tr>

        <tr><td>Характеристики (text_features):</td>
            <td><textarea class="features" name="text_features" rows="8"><?= htmlspecialchars($arguments['text_features']) ?></textarea></td></tr>

        <tr><td>Текст детальный (text_detail):</td>
            <td><textarea class="detail" name="text_detail" rows="12"><?= htmlspecialchars($arguments['text_detail']) ?></textarea></td></tr>

        <tr><td>SEO-текст (text_seo):</td>
            <td><textarea class="seo" name="text_seo" rows="8"><?= htmlspecialchars($arguments['text_seo']) ?></textarea></td></tr>

        <tr><td>Процессор (cpu_type):</td>
            <td><input type="text" name="cpu_type" maxlength="255"
                       value="<?= htmlspecialchars($arguments['cpu_type']) ?>"></td></tr>

        <tr><td>RAM, Мб (ram):</td>
            <td><input type="number" name="ram"
                       value="<?= htmlspecialchars($arguments['ram']) ?>"></td></tr>

        <tr><td>Flash, Мб (flash):</td>
            <td><input type="number" step="0.1" name="flash"
                       value="<?= htmlspecialchars($arguments['flash']) ?>"></td></tr>

        <tr><td>Питание (voltage):</td>
            <td><input type="text" name="voltage" maxlength="20"
                       value="<?= htmlspecialchars($arguments['voltage']) ?>"></td></tr>

        <tr><td>Рабочая температура (temp_operating):</td>
            <td><input type="text" name="temp_operating"
                       value="<?= htmlspecialchars($arguments['temp_operating']) ?>"></td></tr>

        <tr><td>Вес нетто (netto):</td>
            <td><input type="text" name="netto" maxlength="10"
                       value="<?= htmlspecialchars($arguments['netto']) ?>"></td></tr>

        <tr><td>Статус (status):</td>
            <td>
                <select name="status">
                    <?php foreach (array('1'=>'Активен','0'=>'Неактивен','2'=>'Архив') as $k=>$v): ?>
                        <option value="<?= $k ?>" <?= $arguments['status'] === $k ? 'selected' : '' ?>>
                            <?= $v ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td></tr>

        <tr><td>Новый товар (new_product):</td>
            <td>
                <select name="new_product">
                    <option value="0" <?= $arguments['new_product'] === '0' ? 'selected' : '' ?>>Нет</option>
                    <option value="1" <?= $arguments['new_product'] === '1' ? 'selected' : '' ?>>Да</option>
                </select>
            </td></tr>

        <tr><td>Снят с производства (discontinued):</td>
            <td>
                <select name="discontinued">
                    <option value="">—</option>
                    <option value="0" <?= $arguments['discontinued'] === '0' ? 'selected' : '' ?>>Производится</option>
                    <option value="1" <?= $arguments['discontinued'] === '1' ? 'selected' : '' ?>>Снят с производства</option>
                </select>
            </td></tr>
    </table>
</form>

<?php include $core_admin_path . 'template/footer.php';