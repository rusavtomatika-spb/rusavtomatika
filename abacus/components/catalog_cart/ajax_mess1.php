<?

define("bullshit", 1);
/*include "../sc/dbcon.php";
include ("../sc/lib_new.php");*/

//$s=$_SERVER["HTTP_ORIGIN"];
$s = $_SERVER["HTTP_REFERER"];
//$s=$URL_REF['host'];
//$s="dsdssdd";
global $name,$company,$phone,$email,$inn,$kpp,$ogrn,$address,$status,$dop,$dostavka,$basket,$text_us2u,$refer,$models;

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_POST["name"])) {
        $name = strip_tags($_POST["name"]);
    } else $name = "";
    if (isset($_POST["company"]) && $_POST["status"]!="fizlico") {
        $company = $_POST["company"];
        $company = strip_tags($company);
    } else $company = "";
    if (isset($_POST["phone"]))
        $phone = $_POST["phone"];
    else $phone = "";
        //die("no phone");
    if (isset($_POST["email"]))
        $email = $_POST["email"];
    else $email = "";
        //die("no email");
    if (isset($_POST["inn"]) && $_POST["status"]!="fizlico")
        $inn = $_POST["inn"];
    else $inn = "";
        //die("no inn");
    if (isset($_POST["kpp"]) && $_POST["status"]!="fizlico")
        $kpp = $_POST["kpp"];
    else $kpp = "";
        //die("no kpp");
    if (isset($_POST["ogrn"]) && $_POST["status"]!="fizlico")
        $ogrn = $_POST["ogrn"];
    else $ogrn = "";
        //die("no ogrn");
    if (isset($_POST["address"]) && $_POST["status"]!="fizlico")
        $address = $_POST["address"];
    else $address = "";
        //die("no address");
    if (isset($_POST["status"]))
        $status = $_POST["status"];
    //else //die("no status");
    if (isset($_POST["dop"]))
        $dop = $_POST["dop"];
    else $dop = "";
        //die("no dop");
    if (isset($_POST["dostavka"])){
        $dostavka = $_POST["dostavka"];
    }
    //else //die("no dost");
    if (isset($_POST["basket"])) {
        $basket = $_POST["basket"];
    } //else die("no basket");
    if (isset($_POST["models"])) {
        $models = $_POST["models"];
    } //else die("no basket");
    if (isset($_POST["file"])) {
        $file = str_replace($_SERVER["DOCUMENT_ROOT"], '', $_POST["file"]);
    } else $file = "";

    //echo "it's ok $phone $name $company $phone $email $dostavka $basket file: $file";
    $ip = $_SERVER['REMOTE_ADDR'];


    $subj = "Заказ: $name $company $phone $email";
    $text_us1 = "<html><h1>Заказ продукции</h1>";
    $text_us2u = "<div style='background: #dff3df;padding: 20px'>
	<b>Доставка: </b>&nbsp;$dostavka<br><br>
	<b>Имя: </b>&nbsp;$name <br>
	<b>Телефон: </b>&nbsp;$phone <br>
	<b>Email: </b>&nbsp;$email<br>
	<b>Компания: </b>&nbsp;$company  <br>
	<b>ИНН: </b>&nbsp;$inn <br>
	<b>КПП: </b>&nbsp;$kpp <br>
	<b>ОГРН: </b>&nbsp;$ogrn <br>
	<b>Адрес: </b>&nbsp;$address<br> 
	<b>Примечание: </b>&nbsp;$dop<br><br>
	<b>IP: </b>&nbsp;$ip <br><br></div></html>";
    $text_us2f = "<div style='background: #dff3df;padding: 20px'>
	<b>Доставка: </b>&nbsp;$dostavka<br><br>
	<b>Имя: </b>&nbsp;$name <br>
	<b>Телефон: </b>&nbsp;$phone <br>
	<b>Email: </b>&nbsp;$email<br>
	<b>Адрес: </b>&nbsp;$address<br> 
	<b>Примечание: </b>&nbsp;$dop<br><br>
	<b>IP: </b>&nbsp;$ip <br><br></div></html>";

//-----------------send to us ----------------------------------
    /*    $mail0 = "plesk@mail.ru";
        $mail1 = "agk@fam-electric.ru";
        $mail2 = "kiv@fam-electric.ru";*/
    $mail3 = "sales@rusavtomatika.com";
    $mail5 = "maxbelousov@ya.ru";
        /*$mail3 = "valovenko@mail.ru";*/
    //$mail5 = "dm@rusavtomatika.com";

    $client_email = $_POST['email'];

        //send_message($mail4, $subj, $text_us);
    if ($status == "urlico") {
        $m = send_message("dm@rusavtomatika.com", $subj, $text_us1.$basket.$text_us2u, $client_email);
        $m = send_message($mail3, $subj, $text_us1.$basket.$text_us2u, $client_email);
        $m = send_message($mail5, $subj, $text_us1.$basket.$text_us2u, $client_email);
    } else {
        $m = send_message("dm@rusavtomatika.com", $subj, $text_us1.$basket.$text_us2f, $client_email);
        $m = send_message($mail3, $subj, $text_us1.$basket.$text_us2f, $client_email);
        $m = send_message($mail5, $subj, $text_us1.$basket.$text_us2f, $client_email);
    }
	//add_rekvest2db();
forwardPostRequest('https://zu19.tw1.ru/work/bdtest.php');
    file_put_contents("text.txt", print_r($_POST, true));
	
    $mobnum = "79219334120";
    $message = "request $phone";

    if($m) { echo "true";}
    else{ echo "false";}

} else
    echo "false";

function send_message($email_to, $subj, $text, $reply_email = '') {
    $subj = '=?utf-8?B?' . base64_encode($subj) . '?=';
    $name_from = "Rusavtomatika.com";
    $email_from = "no-reply@rusavtomatika.com";
    $name_to = "";
    $data_charset = "UTF-8";
    $send_charset = "UTF-8";
    $html = TRUE;
    
    if (filter_var($reply_email, FILTER_VALIDATE_EMAIL)) {
        $reply_to = $reply_email;
    } else {
        $reply_to = '';
    }
    
    if ($email_to == "admin") {
        $email_to = "sales@rusavtomatika.com";
    }
    
    $to = $name_to . ' <' . $email_to . '>';
    $subject = mime_header_encode($subj, $data_charset, $send_charset);
    $from = $name_from . ' <' . $email_from . '>';

    $headers = "From: $from\r\n";
    
    if ($reply_to) {
        $headers .= "Reply-To: $reply_to\r\n";
    }
    
    $type = ($html) ? 'html' : 'plain';
    $headers .= "Content-type: text/$type; charset=$send_charset\r\n";
    $headers .= "Mime-Version: 1.0\r\n";

    return mail($to, $subj, $text, $headers);
}

function mime_header_encode($str, $data_charset, $send_charset)
{
/*    if ($data_charset != $send_charset) {
        $str = strip_tags($data_charset, $send_charset, $str);
    }*/
    return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}
////////////////////////////////////////////////////////////////////
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