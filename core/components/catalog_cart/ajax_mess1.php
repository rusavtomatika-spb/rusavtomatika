<?

define("bullshit", 1);
/*include "../sc/dbcon.php";
include ("../sc/lib_new.php");*/

//$s=$_SERVER["HTTP_ORIGIN"];
$s = $_SERVER["HTTP_REFERER"];
//$s=$URL_REF['host'];
//$s="dsdssdd";

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_POST["name"])) {
        $name = $_POST["name"];
        $name = iconv("UTF-8", "cp1251", $name);
    } else
        $name = "";
    if (isset($_POST["company"])) {
        $company = $_POST["company"];
        $company = iconv("UTF-8", "cp1251", $company);
    } else
        $company = "";
    if (isset($_POST["phone"]))
        $phone = $_POST["phone"];
    else
        die("no phone");
    if (isset($_POST["email"]))
        $email = $_POST["email"];
    else
        die("no email");
    if (isset($_POST["dostavka"])){
        $dostavka = $_POST["dostavka"];
        $dostavka = iconv("UTF-8", "cp1251", $dostavka);
    }
    else
        die("no dost");
    if (isset($_POST["basket"])) {
        $basket = $_POST["basket"];
        //$basket = iconv("ASCII", "cp1251", $basket);

    } else
        die("no dost");
    if (isset($_POST["file"])) {
        $file = str_replace($_SERVER["DOCUMENT_ROOT"], '', $_POST["file"]);
    } else
        $file = "";

    //file_put_contents("text.txt", print_r(mb_detect_encoding($basket, "auto"), true));
    //echo "it's ok phone $name $company $phone $email $dostavka $basket file: $file";
    $ip = $_SERVER['REMOTE_ADDR'];


    $subj = "Заказ: $name $company $phone $email";
    //$subj = iconv("cp1251", "UTF-8", $subj);


    $text_us1 = "<html><h1>Заказ продукции</h1>";

    $text_us2 = "<div style='background: #dff3df;padding: 20px'>
<b>Доставка: </b>&nbsp;$dostavka<br><br><b>Компания: </b>&nbsp;$company &nbsp; &nbsp; &nbsp; <b>Имя: </b>&nbsp;$name &nbsp; &nbsp; &nbsp; <b>Телефон: </b>&nbsp;$phone &nbsp; &nbsp; &nbsp; <b>Email: </b>&nbsp;$email<br><br>
<b>IP: </b>&nbsp;$ip <br><br></div>";



    if ($file)
        $text_us2 .= "<hr><br>Прикрепленный файл: <a target='_blank' href='$file'><b>$file</b></a><br>";
    $text_us2 .= "</html>";

    $text_us1 = iconv("cp1251", "UTF-8", $text_us1);
    $text_us2 = iconv("cp1251", "UTF-8", $text_us2);

//-----------------send to us ----------------------------------
    /*    $mail0 = "plesk@mail.ru";
        $mail1 = "agk@fam-electric.ru";
        $mail2 = "kiv@fam-electric.ru";*/
    $mail3 = "sales@rusavtomatika.com";
    /*    $mail4 = "valovenko@mail.ru";*/
    //$mail5 = "dm@rusavtomatika.com";

    if ($file != "" && file_exists($file)) {
        $m = XMail('no-reply@rusavtomatika.com', "dm@rusavtomatika.com", $subj, $text_us1.$basket.$text_us2, $file);
        $m = XMail('no-reply@rusavtomatika.com', $mail3, $subj, $text_us1.$basket.$text_us2, $file);
        //unlink($file);
    } else {
        $m = send_message("dm@rusavtomatika.com", $subj,  $text_us1.$basket.$text_us2);
        $m = send_message($mail3, $subj,  $text_us1.$basket.$text_us2);
        //send_message($mail4, $subj, $text_us);
    }

    $mobnum = "79219334120";
    $message = "request $phone";

    if($m) { echo "true";}
    else{ echo "false";}

//$body=file_get_contents("http://sms.ru/sms/send?api_id=f7234600-eab9-25d4-393a-d847ef01cae3&to=$mobnum&text=".urlencode(iconv("windows-1251","utf-8",$message)));
} else
    echo "false";


function send_message(

    $email, // email получателя
    $subj, // тема письма
    $text // текст письма
)
{

    $subj = iconv("CP1251", "UTF-8", $subj);
    $subj = '=?utf-8?B?' . base64_encode($subj) . '?=';
//    $name_from = "no-reply@rusavtomatika.com"; // имя отправителя
//    $email_from = "no-reply@rusavtomatika.com"; // email отправителя
    $name_from = "Rusavtomatika.com"; // имя отправителя
    $email_from = "no-reply@rusavtomatika.com"; // email отправителя
    $name_to = ""; // имя получателя
    $data_charset = "UTF-8"; // кодировка переданных данных
    $send_charset = "UTF-8"; // кодировка письма
    $html = TRUE; // письмо в виде html или обычного текста
    $reply_to = FALSE;

    if ($email == "admin")
//        $email = "plesk@mail.ru";
        $email = "sales@rusavtomatika.com";


    $to = mime_header_encode($name_to, $data_charset, $send_charset) . ' <' . $email . '>';

    $subject = mime_header_encode($subj, $data_charset, $send_charset);
    $from = mime_header_encode($name_from, $data_charset, $send_charset)
        . ' <' . $email_from . '>';
    if ($data_charset != $send_charset) {
        $body = iconv($data_charset, $send_charset, $body);
    }

    $headers = "From: $from\r\n";
    $type = ($html) ? 'html' : 'plain';
    $headers .= "Content-type: text/$type; charset=$send_charset\r\n";
    $headers .= "Mime-Version: 1.0\r\n";
    if ($reply_to) {
        $headers .= "Reply-To: $reply_to";
    }


    return mail($to, $subj, $text, $headers);
//    return mail($to, $subject, $text, $headers);
}

function mime_header_encode($str, $data_charset, $send_charset)
{
    if ($data_charset != $send_charset) {
        $str = iconv($data_charset, $send_charset, $str);
    }
    return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}


?>