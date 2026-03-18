<?php
// Заголовки
header('Content-type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Дата в прошлом
header('Pragma: no-cache'); // HTTP/1.0

define('ENCODING', 'UTF-8');
define('PROLOG_INCLUDED', true);
if (!defined('bullshit')) {
    define('bullshit', 1);
}

ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Подключение к базе данных
require_once($_SERVER["DOCUMENT_ROOT"] . '/abacus/init.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/abacus/config.php');

include_once($_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php");
database_connect();
global $mysqli_db, $mysql_db;

if ($mysqli_db) {
    mysqli_query($mysqli_db, "SET NAMES utf8");
} else {
    mysql_query("SET NAMES utf8", $mysql_db);
}

// Получаем активный tab из GET
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'товары';

// Получаем параметры сортировки
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'views';
$sort_direction = isset($_GET['dir']) && strtolower($_GET['dir']) === 'asc' ? 'ASC' : 'DESC';

// Вспомогательные функции
function createSortLink($column, $current_sort_col, $current_dir) {
    $new_dir = ($current_sort_col === $column && $current_dir === 'ASC') ? 'DESC' : 'ASC';
    return '?tab=' . $GLOBALS['active_tab'] . '&sort=' . $column . '&dir=' . $new_dir;
}

function universalSort($a, $b, $sort_column, $sort_direction) {
    switch ($sort_column) {
        case 'views':
            $val_a = isset($a['views']) ? intval($a['views']) : 0;
            $val_b = isset($b['views']) ? intval($b['views']) : 0;
            break;
        default:
            $val_a = isset($a[$sort_column]) ? strtolower(trim($a[$sort_column])) : '';
            $val_b = isset($b[$sort_column]) ? strtolower(trim($b[$sort_column])) : '';
            break;
    }

    if ($sort_direction === 'ASC') {
        if ($val_a < $val_b) return -1;
        elseif ($val_a > $val_b) return 1;
        else return 0;
    } else {
        if ($val_a < $val_b) return 1;
        elseif ($val_a > $val_b) return -1;
        else return 0;
    }
}

// Подготовленный запрос для товаров
$sql_tovary = "
    SELECT pa.type AS type,
           pa.brand AS brand,
           pa.series AS series,
           pa.model AS model,
           COALESCE(v.views, 0) AS views
    FROM products_all pa
    LEFT JOIN views v ON pa.`index` = v.item_id AND v.razdel = 'products'
    WHERE v.views > 0;
";

$stmt_tovary = $mysqli_db->prepare($sql_tovary);
if (!$stmt_tovary || !$stmt_tovary->execute()) {
    die("Ошибка выполнения запроса товаров: " . ($stmt_tovary ? $stmt_tovary->error : "Не удалось подготовить запрос"));
}

$result_tovary = $stmt_tovary->get_result();

// Загрузка данных товаров
$results_tovary = [];
while ($row = $result_tovary->fetch_assoc()) {
    $results_tovary[] = $row;
}

// Сортировка товаров
usort($results_tovary, function($a, $b) use ($sort_column, $sort_direction) {
    return universalSort($a, $b, $sort_column, $sort_direction);
});

// Подготовленный запрос для статей
$sql_stati = "
    SELECT CONCAT('<a href=\'https://www.rusavtomatika.com/articles/', a.sys_name, '\' target=\'_blank\'>', a.name, '</a>') AS name,
           COALESCE(v.views, 0) AS views
    FROM articles a
    LEFT JOIN views v ON a.id = v.item_id AND v.razdel = 'articles'
    WHERE v.views > 0;
";

$stmt_stati = $mysqli_db->prepare($sql_stati);
if (!$stmt_stati || !$stmt_stati->execute()) {
    die("Ошибка выполнения запроса статей: " . ($stmt_stati ? $stmt_stati->error : "Не удалось подготовить запрос"));
}

$result_stati = $stmt_stati->get_result();

// Загрузка данных статей
$results_stati = [];
while ($row = $result_stati->fetch_assoc()) {
    $results_stati[] = $row;
}

// Сортировка статей
usort($results_stati, function($a, $b) use ($sort_column, $sort_direction) {
    return universalSort($a, $b, $sort_column, $sort_direction);
});

// Подготовленный запрос для новостей
$sql_news = "
    SELECT CONCAT('<a href=\'https://www.rusavtomatika.com/news/', n.sys_name, '\' target=\'_blank\'>', n.name, '</a>') AS name,
           COALESCE(v.views, 0) AS views
    FROM news n
    LEFT JOIN views v ON n.id = v.item_id AND v.razdel = 'news'
    WHERE v.views > 0;
";

$stmt_news = $mysqli_db->prepare($sql_news);
if (!$stmt_news || !$stmt_news->execute()) {
    die("Ошибка выполнения запроса новостей: " . ($stmt_news ? $stmt_news->error : "Не удалось подготовить запрос"));
}

$result_news = $stmt_news->get_result();

// Загрузка данных новостей
$results_news = [];
while ($row = $result_news->fetch_assoc()) {
    $results_news[] = $row;
}

// Сортировка новостей
usort($results_news, function($a, $b) use ($sort_column, $sort_direction) {
    return universalSort($a, $b, $sort_column, $sort_direction);
});

// Генерация основной страницы
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблицы товаров, статей и новостей</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">
    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?= $active_tab === 'товары' ? 'active' : '' ?>" id="tovary-tab" href="?tab=товары" role="tab" aria-controls="tovary" aria-selected="<?= $active_tab === 'товары' ?>">Товары</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active_tab === 'статьи' ? 'active' : '' ?>" id="stati-tab" href="?tab=статьи" role="tab" aria-controls="stati" aria-selected="<?= $active_tab === 'статьи' ?>">Статьи</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active_tab === 'новости' ? 'active' : '' ?>" id="news-tab" href="?tab=новости" role="tab" aria-controls="news" aria-selected="<?= $active_tab === 'новости' ?>">Новости</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade <?= $active_tab === 'товары' ? 'show active' : '' ?>" id="tovary" role="tabpanel" aria-labelledby="tovary-tab">
            <h2>Товары:</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><a href="<?= createSortLink('type', $sort_column, $sort_direction); ?>">Тип</a></th>
                        <th><a href="<?= createSortLink('brand', $sort_column, $sort_direction); ?>">Бренд</a></th>
                        <th><a href="<?= createSortLink('series', $sort_column, $sort_direction); ?>">Серия</a></th>
                        <th><a href="<?= createSortLink('model', $sort_column, $sort_direction); ?>">Модель</a></th>
                        <th><a href="<?= createSortLink('views', $sort_column, $sort_direction); ?>">Просмотры</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results_tovary as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['type'], ENT_QUOTES, ENCODING); ?></td>
                            <td><?= htmlspecialchars($row['brand'], ENT_QUOTES, ENCODING); ?></td>
                            <td><?= htmlspecialchars($row['series'], ENT_QUOTES, ENCODING); ?></td>
                            <td><?= htmlspecialchars($row['model'], ENT_QUOTES, ENCODING); ?></td>
                            <td><?= htmlspecialchars($row['views'], ENT_QUOTES, ENCODING); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade <?= $active_tab === 'статьи' ? 'show active' : '' ?>" id="stati" role="tabpanel" aria-labelledby="stati-tab">
            <h2>Статьи:</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><a href="<?= createSortLink('name', $sort_column, $sort_direction); ?>">Название</a></th>
                        <th><a href="<?= createSortLink('views', $sort_column, $sort_direction); ?>">Просмотры</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results_stati as $row): ?>
                        <tr>
                            <td><?= $row['name']; ?></td> <!-- Уже является ссылкой -->
                            <td><?= htmlspecialchars($row['views'], ENT_QUOTES, ENCODING); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade <?= $active_tab === 'новости' ? 'show active' : '' ?>" id="news" role="tabpanel" aria-labelledby="news-tab">
            <h2>Новости:</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><a href="<?= createSortLink('name', $sort_column, $sort_direction); ?>">Название</a></th>
                        <th><a href="<?= createSortLink('views', $sort_column, $sort_direction); ?>">Просмотры</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results_news as $row): ?>
                        <tr>
                            <td><?= $row['name']; ?></td> <!-- Уже является ссылкой -->
                            <td><?= htmlspecialchars($row['views'], ENT_QUOTES, ENCODING); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Закрываем подключения к базе данных
if (isset($stmt_tovary)) $stmt_tovary->close();
if (isset($stmt_stati)) $stmt_stati->close();
if (isset($stmt_news)) $stmt_news->close();
?>
</body>
</html>