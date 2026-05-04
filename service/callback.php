<?php
ob_clean();
ob_start();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
    if(!isset($_POST["ph"])) die("no phone");

    define("bullshit",1);
    include "../sc/dbcon.php";
    include ("../sc/lib_new.php");

    $phone = stripslashes($_POST["ph"]);
    $phone_out = "";
    $ip = $_SERVER['REMOTE_ADDR'];
    $subj = "RA Callback $phone  IP=$ip";

    $mail3 = "sales@rusavtomatika.com";
    $mail4 = "lox75v@mail.ru";

    send_message($mail3, $subj, "");
    send_message($mail4, $subj, "");

    for($i = 0; $i < strlen($phone); $i++)
    {
        if(ctype_digit($phone[$i]))
            $phone_out .= $phone[$i];
        else die("неправильный номер, пожалуйста, введите только цифры");
    }

    if(strlen($phone_out) < 11) die("неправильный номер, должно быть не менее 11 цифр");

    if(date("H") > 18 || date("H") < 9) die("Пожалуйста, позвоните в рабочее время с 9:00 до 18:00 по Москве в будние дни");
    if(date("w") == 6 || date("w") == 0) die("Пожалуйста, позвоните в рабочее время с 9:00 до 18:00 по Москве в будние дни");

    @file_get_contents("https://vpbx.sipout.net/c2c?key=4415e0fff5b65794b068d435901b23ab-1375221561&ac=3000604&ph=$phone_out");
    
    ob_clean();
    echo "OK";
    exit;
}
else echo "I don't think so";
?>