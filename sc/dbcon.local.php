<?

include $_SERVER["DOCUMENT_ROOT"]."/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/include/redirect.php";

define("ERRORS", 1);

if (!function_exists('mysql_connect')) {
    function mysql_connect($host = null, $user = null, $pass = null) {
        global $mysqli_db;
        if (!$mysqli_db) {
            $host = $host ?: "127.0.1.29";
            $user = $user ?: "root";
            $pass = $pass ?: "";
            $mysqli_db = mysqli_connect($host, $user, $pass, "", 3306);
            if ($mysqli_db) {
                mysqli_set_charset($mysqli_db, "utf8");
            }
        }
        return $mysqli_db;
    }
    function mysql_select_db($dbname, $link = null) {
        global $mysqli_db;
        return mysqli_select_db($mysqli_db ? $link : null, $dbname);
    }
    function mysql_query($query, $link = null) {
        global $mysqli_db;
        return mysqli_query($mysqli_db ? $link : null, $query);
    }
    function mysql_fetch_assoc($result) {
        return mysqli_fetch_assoc($result);
    }
    function mysql_num_rows($result) {
        return mysqli_num_rows($result);
    }
}

if (ERRORS) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
if (!defined('bullshit'))
    exit;
/*
if ($_SERVER['SERVER_NAME'] != "www.rusavtomatika.com" AND !isset($_GET["indexindex"])) {
    if (((preg_match("/moisait/i", $_SERVER['SERVER_NAME'])) OR (preg_match("/test/i", $_SERVER['SERVER_NAME']))) AND (empty($_COOKIE['m']))) {
        header("HTTP/1.0 404 Not Found");
        exit;
    };
}
*/

//-------------------------------------------------------home------------------------------------
//global $root_php;
//$root_php= "z:/home/localhost/www/travel";
//-----------------------------------------------------work-------------------------------------

global $site_description;
$site_description = "Weintek, операторские панели, панели оператора, операторская панель, панель оператора, HMI, склад, официальный дистрибьютор, скидки, низкие цены";
global $keywords;
$keywords = "операторская панель, панель оператора, автоматизация оборудования, разработка ПО,операторские панели, панели оператора, сенсорные панели, HMI, Weintek, EasyView, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО, разработка PLC,
контроллер, логический контроллер, разработка плат, EasyBuilder, MT505, MT8056, привод окон, привод кранов,
электро шаровые краны, автоматика для теплиц, люксметр, контроллер теплиц";
global $keywords_weintek;
$keywords_weintek = "MT6070iH, MT6050i, MT6100i, WT3010, MT8050i, MT8070iH, MT8100i, MT8104XH, MT8121X, MT8104iH, MT8150X, MT607i, MT610i, MT610XH, MT612XH, MT615XH, eMT3070A, eMT3105P, 
eMT3120A, eMT3150A, CANopen, BACnet,
операторские панели, панели оператора, операторская панель, панель оператора, дистрибьютор Weintek,дистрибутор Weintek, склад Weintek, скидки Weintek, опт Weintek, поставки Weintek, продажи Weintek,
цены Weintek, Weintek Санкт-Петербург, подключение Weintek, установка Weintek, поддержка Weintek, проект Weintek,
разработка Weintek, EasyBuilder, софт Weintek, контроллер Weintek, совместить Weintek, консультации Weintek, интеграция Weintek, системы автоматики, системы автоматизации, автоматизация";
global $descr_weintek;
$descr_weintek = "Weintek, панели оператора, операторские панели, операторская панель, панель оператора, HMI, поставки всего модельного ряда операторских панелей Weintek со склада в Санкт-Петербурге";
global $keywords_pc;
$keywords_pc = "панельные компьютеры, промышленные панельные компьютеры, panel PC, рабочая станция, промышленные PC, панельные PC, встраиваемые PC, встраиваемые
рабочие станции, Windows CE, системы автоматики, системы автоматизации, автоматизация";
global $keywords_ifc;
$keywords_ifc = "панельные ПК, встраиваемые ПК, промышленные ПК, панельные компьютеры, промышленные панельные компьютеры, panel PC, рабочая станция,
промышленные PC, панельные PC, встраиваемые PC, встраиваемые компьютеры, встраиваемые рабочие станции, Windows CE, WinCE, промышленный ПК с WinCE, 
встраиваемый ПК с WinCE, панельный ПК с WinCE, системы автоматики, системы автоматизации, автоматизация, BOX-PC, mini PC, мини PC, мини компьютер,
car PC, тонкий клиент, thin client, компактные компьютеры, автомобильные компьютеры, компактные ПК, car PC";
global $descr_ifc;
$descr_ifc = "Панельные ПК, встраиваемые ПК, промышленные ПК, box PC, mini PC, мини компьютеры, тонкий клиент, thin client, поставки промышленных панельных компьютеров IFC со склада в Санкт-Петербурге";
global $keywords_variton;
$keywords_variton = "частотные преобразователи, преобразователи частоты, частотники, инверторы, Variton, Варитон, частотный привод, регулируемый привод,
привод асинхронных двигателей, инвертор Modbus, позиционирование, ПИД-регулятор, векторное управление, частотное управление, аналоговый вход, релейный выход,
аналоговый выход, частотное регулирование, частотно-регулируемый привод, регулятор частоты, частотный регулятор, плавный пуск";
global $descr_variton;
$descr_variton = "Поставки бюджетных частотных преобразователей Variton со склада в Санкт-Петербурге";
global $keywords_transp;
$keywords_transp = "Транспортный компьютеры, компьютеры для транспорта, автомобильные компьютеры, морозостойкие компьютеры, морозостойкий транспортный компьютер,
компьютер для транспорта Linux, компьютер для троллейбуса, компьютер для трамвая, компьютер для электровоза, компьютер для автобуса";
global $descr_transp;
$descr_transp = "Поставки морозостойких компьютеров для транспорта, транспортных компьютеров, со склада в Санкт-Петербурге";
global $descr_sborka;
$descr_sborka = "сборка электрошкафов, электрощитов, шкафов автоматики, шкафов силовых на заказ по заданию клиента в Санкт-Петербурге";
global $keywords_sborka;
$keywords_sborka = "сборка электрошкафов, сборка электрощитов, сборка распределительных щитов, сборка шкафов управления, сборка шкафов автоматики, сборка силовых шкафов";
global $root_php;
//$root_php= "~/public-html/rusavtomatika";

if ($_SERVER['DOCUMENT_ROOT'] != '/home/weblec/public_html/test_ra') {
    $root_php = "/home/weblec/public_html/rusavtomatika.com/";
} else {
    $root_php = "/home/weblec/public_html/test_ra/";
};

global $img_php;
$img_php = $root_php . "images";
global $temp_img_php;
$temp_img_php = $root_php . "temp/images";
global $root_html;
//$root_html="http://localhost/rusavtomatika";
$root_html = "http://www.rusavtomatika.com";
global $img_html;
$img_html = $root_html . "/images";
global $temp_img_html;
$temp_img_html = $root_html . "temp/images";   // путь к картинкам шаблона
global $html_eb500;
$html_eb500 = $root_html . "/soft/EB500v274.msi";
global $html_eb500_ug;
$html_eb500_ug = $root_html . "/manuals/eb500ug.pdf";
global $html_eb8000;
$html_eb8000 = "http://www.weintek.net/eb8000/EB8000_setup.zip";
global $html_eb8000_ug;
$html_eb8000_ug = $root_html . "/manuals/UserManualEB8000.pdf";
global $admin_reply_address;
$admin_reply_address = "no-reply@rusavtomatika.com";     // адрес якобы с которого прищло письмо
global $admin_email;
$admin_email = "plesk@mail.ru";    //  admin's email
global $admin1_email;
$admin1_email = "rentweekend@mail.ru";    //  admin's email
global $test_mode;
$test_mode = 1;            // ТЕСТОВЫЙ РЕЖИМ !!!! НЕ ЗАБЫТь ОТКЛЮЧИТЬ
global $site_name;
$site_name = "www.rusavtomatika.com";
global $contact_phone;                   //контактный телефон
$contact_phone = "8-921-222-22-22";
global $payment_addr;
$payment_addr = "payment@rentweekend.com";   //
global $base_php;
$base_php = $root_php . "/base/";
global $base_html;
$base_html = $root_html . "/base/";
global $temp_html;
$temp_html = $root_html . "temp/";
global $temp_php;
$temp_php = $root_php . "temp/";
global $image_file_size;
$image_file_size = 100000; //макс размер изображения в байтах;
global $image_file_number;
$image_file_number = 20; // макс кол-во изображений
global $code_string;
$code_string = "44";    // кодовое изображение

function database_connect() {
    global $db;
    global $mysqli_db;

    if (!$db) {
        $host = "127.0.1.29";
        $port = 3306; 
        $user = "root";
        $pass = '';
        $dbnm = "rusavtomatika";

        $mysqli_db = mysqli_connect($host, $user, $pass, $dbnm, $port);

        if (!$mysqli_db) {
            echo "[inc_database_credentials.php]" . PHP_EOL;
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit();
        }
        
        mysqli_set_charset($mysqli_db, "utf8");
        $db = $mysqli_db;
    }
}

?>