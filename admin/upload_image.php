<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/admin_dbcon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/databases.php';

$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : (isset($_GET['id']) ? (int)$_GET['id'] : 0);
$message = '';

// Если GET запрос с id — показываем форму
if ($product_id > 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $db_work = new DBWORK();
    $product = $db_work->get_catalog_element_by_id($product_id);
    if (!$product) {
        die("Товар не найден");
    }
}

// Обработка загрузки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img']) && $product_id > 0) {
    
    $db_work = new DBWORK();
    $arProduct = $db_work->get_catalog_element_by_id($product_id);
    
    if ($arProduct) {
        $model_secured = str_replace(array(" ", "/", "®"), "_", $arProduct["model"]);
        $brand = strtolower($arProduct['brand']);
        $type = $arProduct['type'];
        
        $base_path = $_SERVER["DOCUMENT_ROOT"] . "/images/{$brand}/{$type}/{$model_secured}/";
        
        // Все нужные папки (включая те, что ожидает фронтенд)
        $folders = array('67', '130', '150', '190', '580', '1330', 'lg', 'md', 'sm');
        
        // Создаём папки
        foreach ($folders as $folder) {
            $folder_path = $base_path . $folder . "/";
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
        }
        
        // Определяем следующий номер
        $existing = @scandir($base_path . "1330/");
        $max_num = 0;
        if ($existing) {
            foreach ($existing as $f) {
                if ($f != '.' && $f != '..' && preg_match('/' . preg_quote($model_secured, '/') . '_(\d+)\./', $f, $matches)) {
                    $max_num = max($max_num, (int)$matches[1]);
                }
            }
        }
        $next_num = $max_num + 1;
        
        $ext = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, array('png', 'jpg', 'jpeg', 'gif', 'webp'))) {
            die("Неподдерживаемый формат. Используйте PNG, JPG, GIF или WEBP");
        }
        
        $filename = $model_secured . "_" . $next_num . "." . $ext;
        $source_file = $base_path . $filename;
        
        // Сохраняем оригинал
        if (move_uploaded_file($_FILES['img']['tmp_name'], $source_file)) {
            // Копируем во все папки
            foreach ($folders as $folder) {
                copy($source_file, $base_path . $folder . "/" . $filename);
            }
            $message = "Файл успешно загружен: " . $filename;
            
            // Редирект обратно на страницу товара
            header('Location: /admin/edit_element.php?index=' . $product_id);
            exit;
        } else {
            $message = "Ошибка при загрузке файла";
        }
    } else {
        $message = "Товар не найден";
    }
}

// Если нет POST и нет ID в GET — показываем форму ввода ID
if ($product_id == 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Загрузка изображений</title>
        <style>
            body { font-family: Arial; padding: 20px; }
            input { padding: 8px; margin: 10px 0; }
            input[type="submit"] { background: #007bff; color: white; border: none; padding: 10px 20px; cursor: pointer; }
        </style>
    </head>
    <body>
        <h1>Загрузка изображений</h1>
        <form method="get">
            <label>ID товара:</label><br>
            <input type="number" name="id" required>
            <br>
            <input type="submit" value="Далее">
        </form>
    </body>
    </html>
    <?php
    exit;
}

// Показываем форму загрузки
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Загрузка изображений</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        .info { background: #e2f0ff; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .success { background: #d4edda; padding: 15px; margin: 15px 0; color: #155724; border-radius: 5px; }
        input[type="file"] { margin: 10px 0; }
        input[type="submit"] { background: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📸 Загрузка изображений</h1>
        
        <?php if ($message): ?>
            <div class="success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        
        <div class="info">
            <strong>Товар:</strong> <?= htmlspecialchars($product['brand']) ?> / <?= htmlspecialchars($product['model']) ?><br>
            <strong>ID:</strong> <?= $product_id ?>
        </div>
        
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
            <label>Выберите изображение:</label><br>
            <input type="file" name="img" accept="image/png,image/jpeg,image/gif,image/webp">
            <br>
            <input type="submit" value="Загрузить">
        </form>
        
        <p><a href="/admin/edit_element.php?index=<?= $product_id ?>">← Вернуться к товару</a></p>
    </div>
</body>
</html>