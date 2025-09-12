<?

define("bullshit", 1);
include "../sc/dbcon.php";
include ("../sc/lib_new.php");

//$s=$_SERVER["HTTP_ORIGIN"];
$s = $_SERVER["HTTP_REFERER"];
//$s=$URL_REF['host'];
//$s="dsdssdd";

echo "sss=$s";

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
    if (isset($_POST["dostavka"]))
        $dostavka = $_POST["dostavka"];
    else
        die("no dost");
    if (isset($_POST["basket"])) {
        $basket = $_POST["basket"];
        $basket = iconv("UTF-8", "cp1251", $basket);
    } else
        die("no dost");
    if (isset($_POST["file"]))
        $file = $_POST["file"];
    else
        $file = "";


    echo "it's ok phone $name $company $phone $email $dostavka $basket file: $file";
    $ip = $_SERVER['REMOTE_ADDR'];

    $subj = "Новый заказ: $name $company";
    //$subj = iconv("cp1251", "UTF-8", $subj);
    $text_us = "<html>
Заказ продукции<br>
$basket<br><br>
Доставка: $dostavka<br>
Компания: $company<br>
Имя: $name<br>
Телефон: $phone<br>
Email: $email<br>
IP: $ip <br>";
    if ($file)
        $text_us .= "Прикрепленный файл: <a target='_blank' href='$file'>$file</a><br>";
    $text_us .= "</html>";

    $text_us = iconv("cp1251", "UTF-8", $text_us);

//-----------------send to us ----------------------------------
    $mail0 = "plesk@mail.ru";
    $mail1 = "agk@fam-electric.ru";
    $mail2 = "kiv@fam-electric.ru";
    $mail3 = "valovenko@ya.ru";
    $mail4 = "valovenko@mail.ru";
    $mail5 = "sales@rusavtomatika.com";

    if ($file != "" && file_exists($file)) {

        $m = XMail('no-reply@rusavtomatika.com', $mail0, $subj, $text_us, $file);
        $m = XMail('no-reply@rusavtomatika.com', $mail5, $subj, $text_us, $file);
        //$m = XMail('no-reply@rusavtomatika.com', $mail3, $subj, $text_us, $file);
        //$m = XMail('RA <valovenko@ya.ru>', $mail4, $subj, $text_us, $file);
        unlink($file);
    } else {
        send_message($mail0, $subj, $text_us);
        send_message($mail5, $subj, $text_us);
        //send_message($mail3, $subj, $text_us);
        //send_message($mail4, $subj, $text_us);
    }

    $mobnum = "79219334120";
    $message = "request $phone";

//$body=file_get_contents("http://sms.ru/sms/send?api_id=f7234600-eab9-25d4-393a-d847ef01cae3&to=$mobnum&text=".urlencode(iconv("windows-1251","utf-8",$message)));
} else
    echo " I don't think so";
?>