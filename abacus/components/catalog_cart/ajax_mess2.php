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
        $name = strip_tags($_POST["name"]);
    } else
        $name = "";
    if (isset($_POST["company"])) {
        $company = $_POST["company"];
        $company = strip_tags($company);
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
    if (isset($_POST["inn"]))
        $inn = $_POST["inn"];
    else
        die("no inn");
    if (isset($_POST["kpp"]))
        $kpp = $_POST["kpp"];
    else
        die("no kpp");
    if (isset($_POST["ogrn"]))
        $ogrn = $_POST["ogrn"];
    else
        die("no ogrn");
    if (isset($_POST["address"]))
        $address = $_POST["address"];
    else
        die("no address");
    if (isset($_POST["status"]))
        $status = $_POST["status"];
    else
        die("no status");
    if (isset($_POST["dop"]))
        $dop = $_POST["dop"];
    else
        die("no dop");
    if (isset($_POST["dostavka"])){
        $dostavka = $_POST["dostavka"];

    }
    else
        die("no dost");
    if (isset($_POST["basket"])) {
        $basket = $_POST["basket"];
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
    //$mail3 = "sales@rusavtomatika.com";
    $mail3 = "maxbelousov@ya.ru";
        /*$mail3 = "valovenko@mail.ru";*/
    //$mail5 = "dm@rusavtomatika.com";

    if ($status == "urlico") {
        $m = send_message($mail3, $subj,  $text_us1.$basket.$text_us2u);
    } else {
        $m = send_message($mail3, $subj,  $text_us1.$basket.$text_us2f);
    }

    $mobnum = "79219334120";
    $message = "request $phone";

    if($m) { echo "true";}
    else{ echo "false";}


} else
    echo "false";


function send_message(

    $email, // email получателя
    $subj, // тема письма
    $text // текст письма
)
{
    $subj = '=?utf-8?B?' . base64_encode($subj) . '?=';
    $name_from = "Rusavtomatika.com"; // имя отправителя
    $email_from = "no-reply@rusavtomatika.com"; // email отправителя
    $name_to = ""; // имя получателя
    $data_charset = "UTF-8"; // кодировка переданных данных
    $send_charset = "UTF-8"; // кодировка письма
    $html = TRUE; // письмо в виде html или обычного текста
    $reply_to = FALSE;
    if ($email == "admin") {
        $email = "maxbelousov@ya.ru";
    }
    $to = $name_to . ' <' . $email . '>';

    $subject = mime_header_encode($subj, $data_charset, $send_charset);
    $from = $name_from . ' <' . $email_from . '>';

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
/*    if ($data_charset != $send_charset) {
        $str = strip_tags($data_charset, $send_charset, $str);
    }*/
    return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}


?>