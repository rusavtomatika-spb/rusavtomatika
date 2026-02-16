<?php

include $_SERVER["DOCUMENT_ROOT"]."/config.php";

include $_SERVER["DOCUMENT_ROOT"]."/include/redirect.php";

define("ERRORS", 1);

if (ERRORS) {

    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);

    ini_set('display_errors', 1);

    ini_set('display_startup_errors', 1);

}

if (!defined('bullshit'))

    exit;



if ($_SERVER['SERVER_NAME'] != "www.rusavtomatika.com" AND !isset($_GET["indexindex"])) {

    if (((preg_match("/moisait/i", $_SERVER['SERVER_NAME'])) OR (preg_match("/test/i", $_SERVER['SERVER_NAME']))) AND (empty($_COOKIE['m']))) {

        header("HTTP/1.0 404 Not Found");

        exit;

    };

}







//-------------------------------------------------------home------------------------------------

//global $root_php;

//$root_php= "z:/home/localhost/www/travel";

//-----------------------------------------------------work-------------------------------------



global $site_description;
$site_description = "Weintek, ������������ ������, ������ ���������, ������������ ������, ������ ���������, HMI, �����, ����������� ������������, ������, ������ ����";
global $keywords;
$keywords = "������������ ������, ������ ���������, ������������� ������������, ���������� ��,������������ ������, ������ ���������, ��������� ������, HMI, Weintek, EasyView, ���������,
���������������� ���������, ����������� ���������, �������, ��������� �������, ���������� ��, ���������� PLC,
����������, ���������� ����������, ���������� ����, EasyBuilder, MT505, MT8056, ������ ����, ������ ������,
������� ������� �����, ���������� ��� ������, ��������, ���������� ������";
global $keywords_weintek;
$keywords_weintek = "MT6070iH, MT6050i, MT6100i, WT3010, MT8050i, MT8070iH, MT8100i, MT8104XH, MT8121X, MT8104iH, MT8150X, MT607i, MT610i, MT610XH, MT612XH, MT615XH, eMT3070A, eMT3105P, 
eMT3120A, eMT3150A, CANopen, BACnet,
������������ ������, ������ ���������, ������������ ������, ������ ���������, ������������ Weintek,����������� Weintek, ����� Weintek, ������ Weintek, ��� Weintek, �������� Weintek, ������� Weintek,
���� Weintek, Weintek �����-���������, ����������� Weintek, ��������� Weintek, ��������� Weintek, ������ Weintek,
���������� Weintek, EasyBuilder, ���� Weintek, ���������� Weintek, ���������� Weintek, ������������ Weintek, ���������� Weintek, ������� ����������, ������� �������������, �������������";
global $descr_weintek;
$descr_weintek = "Weintek, ������ ���������, ������������ ������, ������������ ������, ������ ���������, HMI, �������� ����� ���������� ���� ������������ ������� Weintek �� ������ � �����-����������";
global $keywords_pc;
$keywords_pc = "��������� ����������, ������������ ��������� ����������, panel PC, ������� �������, ������������ PC, ��������� PC, ������������ PC, ������������
������� �������, Windows CE, ������� ����������, ������� �������������, �������������";
global $keywords_ifc;
$keywords_ifc = "��������� ��, ������������ ��, ������������ ��, ��������� ����������, ������������ ��������� ����������, panel PC, ������� �������,
������������ PC, ��������� PC, ������������ PC, ������������ ����������, ������������ ������� �������, Windows CE, WinCE, ������������ �� � WinCE, 
������������ �� � WinCE, ��������� �� � WinCE, ������� ����������, ������� �������������, �������������, BOX-PC, mini PC, ���� PC, ���� ���������,
car PC, ������ ������, thin client, ���������� ����������, ������������� ����������, ���������� ��, car PC";
global $descr_ifc;
$descr_ifc = "��������� ��, ������������ ��, ������������ ��, box PC, mini PC, ���� ����������, ������ ������, thin client, �������� ������������ ��������� ����������� IFC �� ������ � �����-����������";
global $keywords_variton;
$keywords_variton = "��������� ���������������, ��������������� �������, ����������, ���������, Variton, �������, ��������� ������, ������������ ������,
������ ����������� ����������, �������� Modbus, ����������������, ���-���������, ��������� ����������, ��������� ����������, ���������� ����, �������� �����,
���������� �����, ��������� �������������, ��������-������������ ������, ��������� �������, ��������� ���������, ������� ����";
global $descr_variton;
$descr_variton = "�������� ��������� ��������� ���������������� Variton �� ������ � �����-����������";
global $keywords_transp;
$keywords_transp = "������������ ����������, ���������� ��� ����������, ������������� ����������, ������������� ����������, ������������� ������������ ���������,
��������� ��� ���������� Linux, ��������� ��� �����������, ��������� ��� �������, ��������� ��� �����������, ��������� ��� ��������";
global $descr_transp;
$descr_transp = "�������� ������������� ����������� ��� ����������, ������������ �����������, �� ������ � �����-����������";
global $descr_sborka;
$descr_sborka = "������ �������������, ������������, ������ ����������, ������ ������� �� ����� �� ������� ������� � �����-����������";
global $keywords_sborka;
$keywords_sborka = "������ �������������, ������ ������������, ������ ����������������� �����, ������ ������ ����������, ������ ������ ����������, ������ ������� ������";

global $root_php;

//$root_php= "~/public-html/rusavtomatika";

if ($_SERVER['DOCUMENT_ROOT'] != './') {

    $root_php = "./";

} else {

    $root_php = "./";

};

global $img_php;
$img_php = $root_php . "images";
global $temp_img_php;
$temp_img_php = $root_php . "temp/images";
global $root_html;
//$root_html="http://localhost/rusavtomatika";
$root_html = "/";
global $img_html;
$img_html = $root_html . "/images";
global $temp_img_html;
$temp_img_html = $root_html . "temp/images";
global $html_eb500;
$html_eb500 = $root_html . "/soft/EB500v274.msi";
global $html_eb500_ug;
$html_eb500_ug = $root_html . "/manuals/eb500ug.pdf";
global $html_eb8000;
//$html_eb8000=$root_html."/soft/EB8000.msi";
//$html_eb8000="ftp://ftp.weintek.com/MT8000/EB8000_install/EB8000V420_20100906.zip";
//$html_eb8000=$root_html."/soft/EB8000setup.rar";
$html_eb8000 = "http://www.weintek.net/eb8000/EB8000_setup.zip";
global $html_eb8000_ug;
//$html_eb8000_ug="ftp://ftp.weintek.com/MT8000/eng/UserManual/UserManual_all_in_one/all-in-one.zip";
$html_eb8000_ug = $root_html . "/manuals/UserManualEB8000.pdf";
global $admin_reply_address;
$admin_reply_address = "no-reply@rusavtomatika.com";
global $admin_email;
$admin_email = "plesk@mail.ru";
global $admin1_email;
$admin1_email = "rentweekend@mail.ru";
global $test_mode;
$test_mode = 1;
global $site_name;
$site_name = "www.rusavtomatika.com";
global $contact_phone;
$contact_phone = "8-921-222-22-22";
global $payment_addr;
$payment_addr = "payment@rentweekend.com";
global $base_php;
$base_php = $root_php . "/base/";
global $base_html;
$base_html = $root_html . "/base/";
global $temp_html;
$temp_html = $root_html . "temp/";
global $temp_php;
$temp_php = $root_php . "temp/";
global $image_file_size;
$image_file_size = 100000; //���� ������ ����������� � ������;
global $image_file_number;
$image_file_number = 20; // ���� ���-�� �����������
global $code_string;
$code_string = "44";    // ������� �����������

function database_connect()

{
    global $db;

    global $mysqli_db;

    if (!$db) {

        $host = "localhost";

        $port = "3307";

        if ($_SERVER['DOCUMENT_ROOT'] == '/') {

            $user = "root";

            $pass = '123456';

            $dbnm = "rusavtomatika_db";

        } elseif (preg_match("/www.test.rusavtomatika.com/i", $_SERVER['HTTP_HOST'])) {

            $dbnm = "rusavtomatika_db";

            $user = 'root';

            $pass = '123456';

        } elseif (preg_match("/moisait/i", $_SERVER['DOCUMENT_ROOT'])) {

            $user = "root";

            $pass = '123456';

            $dbnm = "rusavtomatika_db";

        } elseif (preg_match("/olgaglr/i", $_SERVER['DOCUMENT_ROOT'])) {

            $port = "3307";

            $user = "root";

            $pass = '123456';

            $dbnm = "rusavtomatika_db";

        } else {

            $user = "root";

            $pass = '123456';

            $dbnm = "rusavtomatika_db";

        };

        $mysqli_db = mysqli_connect($host . ':' . $port, $user, $pass, $dbnm);

        if (!$mysqli_db) {

            echo "[inc_database_credentials.php]" . PHP_EOL;

            echo "������: ���������� ���������� ���������� � MySQL." . PHP_EOL;

            echo "��� ������ errno: " . mysqli_connect_errno() . PHP_EOL;

            echo "����� ������ error: " . mysqli_connect_error() . PHP_EOL;

            exit();

        } else mysqli_query($mysqli_db, "SET NAMES utf8");



/////////////////////////

///

///

///





        if (PHP_MAJOR_VERSION < 7 ) {

            $h = empty($port) ? $host : $host . ":" . $port;

            $db = mysql_connect($h, $user, $pass);

            if (!$db) {

                print("Database connection failed.");

                exit();

            }

            mysql_query("SET NAMES cp1251");

            if (!mysql_select_db($dbnm)) {

                print("Database select failed.");

                exit();

            }

        }











///

    }



   // file_put_contents($_SERVER["DOCUMENT_ROOT"]."/dbcon_dump.txt", date("H:i:s")." db:". print_r($db,true). " mysqli_db:".print_r($mysqli_db,true)."\n");





}



?>

