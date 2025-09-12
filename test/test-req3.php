<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма заказа</title>
    <!-- Подключаем Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4 text-center">Форма заказа товара</h2>
			<p><?
				echo '<table border="1">';
foreach ($_SERVER as $key => $value) {
    echo "<tr><td>$key</td><td>$value</td></tr>";
}
echo '</table>';
				?></p>
            
            <form action="" id="require_price" method="post">
                <div class="mb-3">
                    <label for="formphone" class="form-label">Телефон:</label>
                    <input class="form-control" type="tel" name="tel" id="formphone" placeholder="+7 (___) ___ __ __" required value="+7 (921) 935-67-37">
                </div>
                
                <div class="mb-3">
                    <label for="formmodel" class="form-label">Модель:</label>
                    <input name="model" id="formmodel" class="form-control" value="Модель">
                </div>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Имя:</label>
                    <input type="text" name="name" value="" placeholder="Ваше имя" aclass="form-control" value="Вася">
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Контактный телефон:</label>
                    <input type="tel" name="phone" value="" placeholder="Контактный телефон" class="form-control" value="+7 (921) 935-67-37">
                </div>
                
                <div class="mb-3">
                    <label for="type" class="form-label">Тип запроса:</label>
                    <input name="type" value="Запрос цены">
                </div>
                
                <div class="mb-3">
                    <label for="product_id" class="form-label">ID продукта:</label>
                    <input name="product_id" value="996">
                </div>
                
                <div class="mb-3">
                    <label for="formcompany" class="form-label">Название организации:</label>
                    <input autocomplete="off" id="formcompany" name="dd" type="text" class="form-control" value="Хер">
                </div>
                
                <div class="mb-3">
                    <label for="forminn" class="form-label">ИНН:</label>
                    <input id="forminn" name="forminn" type="text" class="form-control" value="987987987">
                </div>
                
                <div class="mb-3">
                    <label for="kpp" class="form-label">КПП:</label>
                    <input id="kpp" name="kpp" type="text" class="form-control" value="64654654">
                </div>
                
                <div class="mb-3">
                    <label for="ogrn" class="form-label">ОГРН:</label>
                    <input id="ogrn" name="ogrn" type="text" class="form-control" value="321321321">
                </div>
                
                <div class="mb-3">
                    <label for="address" class="form-label">Адрес:</label>
                    <input id="address" name="address" type="text" class="form-control" value="г Москва, Пятницкое шоссе, д 32">
                </div>
                
                <div class="mb-3">
                    <label for="formemail" class="form-label">Email:</label>
                    <input id="formemail" type="text" name="mail" class="form-control" value="maxbel@mail.ru">
                </div>
                
                <div class="mb-3">
                    <label for="formdop" class="form-label">Комментарий:</label>
                    <textarea id="formdop" name="comment" rows="3" class="form-control">КомментарийКомментарийКомментарийКомментарий</textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100 mb-2">Отправить заказ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Подключаем Bootstrap JS и Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Получаем POST-данные
if ( $_SERVER[ "REQUEST_METHOD" ] === "POST" ) {
  // Параметры подключения к базе данных
//  $user = "belmax_weintek2";
//  $pass = '8NjfT9XE';
//  $host = '92.53.96.171';
//  $dbnm = "belmax_weintek2";
	
$user = "belmax_wtemp";
$pass = 'AV1kSa7d';
$host = 'vh236.timeweb.ru';
$dbnm = "belmax_wtemp";
	

    try {
        // Устанавливаем соединение с базой данных
        $pdo = new PDO("mysql:host=$host;dbname=$dbnm;charset=utf8mb4", $user, $pass, array(PDO::ATTR_PERSISTENT => true));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Режим отображения ошибок

        // Извлекаем данные из формы
        $person_name = !empty($_POST['name']) ? $_POST['name'] : '';
        $tel = !empty($_POST['tel']) ? $_POST['tel'] : ''; // Используем оба телефона
        $tel .= !empty($_POST['phone']) && empty($tel) ? $_POST['phone'] : '';
        $mail = !empty($_POST['mail']) ? $_POST['mail'] : '';
        $model = !empty($_POST['model']) ? $_POST['model'] : '';
        $comment = !empty($_POST['formdop']) ? $_POST['formdop'] : '';
        $company_name = !empty($_POST['dd']) ? $_POST['dd'] : '';
        $inn = !empty($_POST['forminn']) ? $_POST['forminn'] : '';
        $ogrn = !empty($_POST['ogrn']) ? $_POST['ogrn'] : '';
        $kpp = !empty($_POST['kpp']) ? $_POST['kpp'] : '';
        $adres = !empty($_POST['address']) ? $_POST['address'] : '';
        $type = $_POST['type']; // Значение кнопки submit ("Запрос цены", "Получить звонок")
        $product_id = !empty($_POST['product_id']) ? intval($_POST['product_id']) : '';
        $site = 'rusavtomatika'; // Можно задать статическое значение сайта
        $current_date = date('Y-m-d'); // Текущая дата

        // Готовим SQL-запрос на вставку данных
        $sql = "
          INSERT INTO rekvests (`type`, `company_name`, `person_name`, `wn_request_id`, `wn_product_id`,
                               `model`, `comment`, `data`, `site`, `product_id`, `tel`, `mail`, `inn`, `ogrn`, `kpp`, `adres`)
                   VALUES (:type, :company_name, :person_name, '', '', :model, :comment, :data, :site, :product_id, :tel, :mail, :inn, :ogrn, :kpp, :adres)";

        // Подготовленный запрос
        $stmt = $pdo->prepare($sql);

        // Выполняем запрос с подставленными параметрами
        $stmt->execute([
            ':type' => $type,
            ':company_name' => $company_name,
            ':person_name' => $person_name,
            ':model' => $model,
            ':comment' => $comment,
            ':data' => $current_date,
            ':site' => $site,
            ':product_id' => $product_id,
            ':tel' => $tel,
            ':mail' => $mail,
            ':inn' => $inn,
            ':ogrn' => $ogrn,
            ':kpp' => $kpp,
            ':adres' => $adres
        ]);

        // Сообщаем пользователю о результате
        echo '<p>Запрос успешно сохранён.</p>';
    } catch (PDOException $e) {
        die("Ошибка базы данных: " . $e->getMessage()); // Отображаем ошибку
    }
}
?>