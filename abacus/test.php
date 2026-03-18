<?
header('Content-type: text/html; charset=UTF-8');
define('ENCODING', 'UTF-8');

define('PROLOG_INCLUDED', true);
if (!defined('bullshit')) {
    define('bullshit', 1);
}

if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/config.php';

include_once $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
database_connect();
global $mysqli_db,$mysql_db;
if ($mysqli_db){
    mysqli_query($mysqli_db, "SET NAMES utf8");
}else{
    mysql_query("SET NAMES utf8",$mysql_db);
}

// Функция для выполнения произвольного SQL-запроса
function executeSqlQuery($query) {
    // Проверка корректности входящего запроса
    if(empty(trim($query))) {
        trigger_error("Запрос не может быть пустым.", E_USER_ERROR);
        return false;
    }

    // Проверка на наличие запрещенных конструкций
    if(strpos(strtolower($query), ';') !== false ||
       strpos(strtolower($query), '--') !== false ||
       preg_match('/\/\*.*\*\/|\*/i', $query)) {
        trigger_error("Запрещено использование комментариев и множественных команд.", E_USER_ERROR);
        return false;
    }

    // Проверка связи с базой данных
    global $mysqli_db;
    if(!$mysqli_db) {
        trigger_error("Нет подключения к базе данных.", E_USER_ERROR);
        return false;
    }

    // Выполнение запроса
    $result = mysqli_query($mysqli_db, $query);

    // Обработка результата
    if ($result === false) {
        trigger_error("Ошибка при выполнении запроса: " . mysqli_error($mysqli_db), E_USER_WARNING);
        return false;
    }

    // Если запрос SELECT, вернем результат
    if (preg_match('/^\s*(select|show)\s+/i', trim($query))) {
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysqli_free_result($result);
        return $rows;
    }

    // Иначе вернем результат выполнения (число затронутых строк или булевый результат)
    return mysqli_affected_rows($mysqli_db);
}

// Функция вывода всех записей из таблицы views
function showAllViewsTable() {
    global $mysqli_db;

    // SQL-запрос для извлечения всех записей из таблицы views
    $query = "SELECT * FROM `views` ORDER BY `razdel` ASC, `views` DESC";

    // Выполняем запрос
    $result = mysqli_query($mysqli_db, $query);

    // Проверяем результат
    if (!$result) {
        die("Ошибка при получении данных: " . mysqli_error($mysqli_db));
    }

    // Проверяем, есть ли хотя бы одна запись
    if (mysqli_num_rows($result) > 0) {
        // Начинаем выводить HTML-таблицу
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Раздел</th><th>Item ID</th><th>Количество просмотров</th></tr>";

        // Перебираем каждую строку из результата
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['razdel']) . "</td>";
            echo "<td>" . htmlspecialchars($row['item_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['views']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Записи отсутствуют.";
    }

    // Освобождаем память
    mysqli_free_result($result);
}

// Функция для вывода всех данных из указанной таблицы
function displayTableContent($tableName) {
      global $mysqli_db;
  // Фильтрация входа для минимизации риска SQL-инъекций
    $safeTableName = mysqli_real_escape_string($mysqli_db, $tableName);

    // Проверка существования таблицы
    $checkTableQuery = "SHOW TABLES LIKE '" . $safeTableName . "'";
    $checkResult = mysqli_query($mysqli_db, $checkTableQuery);

    if (mysqli_num_rows($checkResult) != 1) {
        echo "Таблица '$tableName' не найдена.";
        return;
    }

    // Запрашиваем все данные из таблицы
    $query = "SELECT * FROM `$safeTableName`";
    $result = mysqli_query($mysqli_db, $query);

    if (!$result) {
        echo "Ошибка при выборе данных из таблицы: " . mysqli_error($mysqli_db);
        return;
    }

    // Получаем заголовки столбцов
    $fields = mysqli_fetch_fields($result);

    // Выводим таблицу
    echo "<table border='1'><caption>Содержание таблицы '$tableName'</caption>\n";
    echo "<thead><tr>";
    foreach ($fields as $field) {
        echo "<th>$field->name</th>";
    }
    echo "</tr></thead>\n";

    // Выводим строки
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($fields as $field) {
            echo "<td>" . htmlspecialchars($row[$field->name]) . "</td>";
        }
        echo "</tr>\n";
    }

    echo "</table>\n";

    // Освобождаем ресурс результата
    mysqli_free_result($result);
}


// Функция для получения списка всех таблиц в базе данных
function getDatabaseTables($mysqli_db) {
    // Выполняем запрос SHOW TABLES
    $result = mysqli_query($mysqli_db, "SHOW TABLES");

    // Массив для хранения названий таблиц
    $tables = [];

    // Преобразовываем результат в массив
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
    }

    // Освобождаем ресурс результата
    mysqli_free_result($result);

    return $tables;
}

//$tablesList = getDatabaseTables($mysqli_db);
//// Выводим список таблиц
//echo '<hr><pre>';
//print_r($tablesList);
//echo '</pre>';


displayTableContent('views');
//showAllViewsTable();

?>