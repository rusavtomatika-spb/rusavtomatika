<?php
// session_start();
define( "bullshit", 1 );
header('Content-Type: text/html; charset=utf-8');
include_once $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
database_connect();
global $mysqli_db,$mysql_db;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    // Проверка валидности email адреса
    if (!$email) {
        echo json_encode(['success' => false, 'message' => 'Некорректный email']);
        exit();
    }

    // Получаем IP пользователя
    $userIp = $_SERVER['REMOTE_ADDR'];

    // Используем указанный токен
    //$apiToken = 'ipb_live_7zPixBjHSd7GfiLr0Rh81rch6kVVpXJtZqPBwSio';
    $data_podp = date('Y-m-d');

    // Получаем данные пользователя через ipinfo.io
    //$data = getUserDataFromIPInfo($userIp, $apiToken);

    // Сначала проверяем наличие e-mail в базе данных
    $checkQuery = "SELECT COUNT(*) FROM subscriptions WHERE email='$email'";
    $result = $mysqli_db->query($checkQuery);
    $count = $result->fetch_row()[0];

    if ($count > 0) {
        echo json_encode(['success' => false, 'message' => 'Вы уже подписаны на рассылку.']);
        exit();
    }

    // Готовим массив значений для вставки
    $values = array_map('addslashes', [
        $email,
        $userIp,
//        isset($data['data']['hostname']) ? $data['data']['hostname'] : '',
//        isset($data['data']['location']['city']['name']) ? $data['data']['city']['name'] : '',
//        isset($data['data']['location']['region']['name']) ? $data['data']['region']['name'] : '',
//        isset($data['data']['location']['country']['alpha2']) ? ['data']['location']['country']['alpha2'] : '',
//        isset($data['data']['location']['latitude']) ? $data['data']['location']['latitude'] : '',
//        isset($data['data']['location']['longitude']) ? $data['data']['location']['longitude'] : '',
//        isset($data['data']['connection']['organization']) ? ['data']['connection']['organization'] : '',
//        isset($data['data']['location']['zip']) ? $data['data']['location']['zip'] : '',
//        isset($data['data']['timezone']['id']) ? $data['data']['timezone']['id'] : '',
        $data_podp
    ]);

    // Запрашиваем вставку данных
    $query = "
        INSERT INTO subscriptions (email, ip, data_podp)
        VALUES ('" . implode("','", $values) . "')
    ";

    if ($mysqli_db->connect_error) {
        http_response_code(500); // Внутренняя ошибка сервера
        echo json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных.']);
        exit();
    }

    // Выполняем запрос
    if ($mysqli_db->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Что-то пошло не так...']);
    }

    // Закрываем соединение
    $mysqli_db->close();
} else {
    http_response_code(405); // Метод не разрешён
    echo json_encode(['success' => false, 'message' => 'Метод не разрешён.']);
}


?>