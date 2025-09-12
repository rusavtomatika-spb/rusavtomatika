<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && !empty($_POST['phone'])) {
    $message .= 'Телефон: ' . $_POST['phone'] . '<br>';
    $message .= 'Модель: ' . $_POST['model'] . ' ';
    $mailTo = "sales@rusavtomatika.com"; // Ваш e-mail
    $headers= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: noreply-frp@rusavtomatika.com <noreply-frp@rusavtomatika.com>\r\n";
    $subject = "Запрос цены с сайта RA"; // Тема сообщения
    if(mail($mailTo, $subject, $message, $headers)) {
        echo "Спасибо, мы свяжемся с вами в самое ближайшее время!"; 
	forwardPostRequest('https://zu19.tw1.ru/work/bdtest.php');
    } else {
        echo "Сообщение не отправлено!";
    }
}

function writeToLog($message) {
    $logFilePath = __DIR__ . '/errors.txt'; // путь к файлу журнала
    file_put_contents($logFilePath, '[' . date('Y-m-d H:i:s') . '] ' . $message . "\n", FILE_APPEND);
}

function forwardPostRequest($url) {
    // Получаем данные из текущего POST-запроса
    $data = $_POST;

    // Инициализируем cURL сессию
    $ch = curl_init();

    // Настраиваем опции сессии
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,                     // адрес цели
        CURLOPT_POST => true,                    // используем метод POST
        CURLOPT_POSTFIELDS => http_build_query($data), // преобразуем массив в строку для передачи
        CURLOPT_RETURNTRANSFER => true,          // вернём результат обратно в PHP
        CURLOPT_FOLLOWLOCATION => true,          // следуем за переадресациями
        CURLOPT_HEADER => false                  // нам нужны только тело ответа
    ]);

    // Выполняем запрос
    $response = curl_exec($ch);

    // Проверяем наличие ошибок
    if(curl_errno($ch)) {
        return ['error' => curl_error($ch)];
    }

    // Закрываем соединение
    curl_close($ch);

    // Возвращаем ответ
    return $response;
}



?>