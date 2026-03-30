<?php
session_start();

// Подключаемся к базе данных (уже реализовано)
database_connect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

      // Получаем IP пользователя
      $userIp = $_SERVER['REMOTE_ADDR'];

      // Используем указанный токен
      $apiToken = '43790424b5f130';

      // Получаем данные пользователя через ipinfo.io
      $data = getUserDataFromIPInfo($userIp, $apiToken);

      // Формируем запрос на сохранение данных
      $query = "
          INSERT INTO news_sender (email, ip, hostname, city, region, country, lat, lng, org, postal, timezone)
          VALUES ('$email', '$userIp', '" . addslashes($data['hostname']) . "', '" . addslashes($data['city']) . "', '" . addslashes($data['region']) . "', '" . addslashes($data['country']) . "', '" . ($data['loc'][0] ?? '') . "', '" . ($data['loc'][1] ?? '') . "', '" . addslashes($data['org']) . "', '" . addslashes($data['postal']) . "', '" . addslashes($data['timezone']) . "')
      ";

      // Выполняем запрос
      $res = mysql_query($query) or die(mysql_error());

      if ($res) {
          echo '<h3>Спасибо за подписку!</h3>';
      } else {
          echo '<h3>Что-то пошло не так... Попробуйте позже.</h3>';
      }
}

// Функция для получения данных о пользователе
function getUserDataFromIPInfo($ipAddress, $token) {
      $url = "https://ipinfo.io/$ipAddress?token=$token";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);

      if (!$response) {
          return [];
      }

      return json_decode($response, true);
}
?>