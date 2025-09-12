<?



if (!defined('bullshit'))

    exit;



if (((preg_match("/moisait/i", $_SERVER['SERVER_NAME'])) OR ( preg_match("/test/i", $_SERVER['SERVER_NAME']))) AND ( empty($_COOKIE['m']))) {

    header("HTTP/1.0 404 Not Found");

    exit;

};

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





$root_php = $_SERVER['DOCUMENT_ROOT'] . '/';

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

$temp_img_html = $root_html . "temp/images";   // ���� � ��������� �������



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

$admin_reply_address = "no-reply@rusavtomatika.com";     // ����� ����� � �������� ������ ������

global $admin_email;

$admin_email = "plesk@mail.ru";    //  admin's email

global $admin1_email;

$admin1_email = "rentweekend@mail.ru";    //  admin's email







global $test_mode;

$test_mode = 1;            // �������� ����� !!!! �� ������ ���������

global $site_name;

$site_name = "www.rusavtomatika.com";







global $contact_phone;                   //���������� �������

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

$image_file_size = 100000; //���� ������ ����������� � ������;

global $image_file_number;

$image_file_number = 20; // ���� ���-�� �����������

global $code_string;

$code_string = "44";    // ������� �����������



function database_connect() {



    $host = "localhost"; // ��� �����

    $port = "3307";      // ����� �����, 3306 - �� ���������

    if ($_SERVER['DOCUMENT_ROOT'] == './') {



        $user = "weblec_den";      // ��� ������������

        $pass = '646111';  // ������

        $dbnm = "weblec_weintek";      // ��� ��

    } elseif (preg_match("/www.test.rusavtomatika.com/i", $_SERVER['HTTP_HOST'])) {

        $dbnm = "weblec_weintek_test"; 

        $user =  'weblec_testuser';        

        $pass = '243344'; 

    } elseif ($_SERVER['HTTP_HOST'] == "www.rusavto.valovenko2.tmweb.ru") {

        $user = "valovenko2_rusav";      // ��� ������������

        $pass = 'mTJeJ6Sk';  // ������

        $dbnm = "valovenko2_rusav";      // ��� ��

    } elseif (preg_match("/moisait/i", $_SERVER['DOCUMENT_ROOT'])) {

        $user = "moisait_olga";      // ��� ������������

        $pass = 'olgaglr';  // ������

        $dbnm = "moisait_ra";      // ��� ��

    } elseif (preg_match("/olgaglr/i", $_SERVER['DOCUMENT_ROOT'])) {



        $port = "";      // ����� �����, 3306 - �� ���������

        $user = "olgaglr_rusavto";      // ��� ������������

        $pass = 'pGrk5V2S';  // ������

        $dbnm = "olgaglr_rusavto";      // ��� ��

    } else {

        $user = "weblec_olga";      // ��� ������������

        $pass = 'olgaglr';  // ������

        $dbnm = "weblec_olga-ra";      // ��� ��

    };

    /*

      echo "!!!!!!!!!!!!!!!!!!!!!";

      echo $_SERVER['DOCUMENT_ROOT'];

      echo "<br>";

      echo $user;

      echo "<br>";

      echo $pass;

      echo "<br>";

      echo $dbnm;

      echo "<br>";

     */



    $h = empty($port) ? $host : $host . ":" . $port;



    $db = mysql_connect($h, $user, $pass); // ����������� � �������� ��

    

    if (!$db) { // ���� ����������� �� �������

        print("Datebase connection failed.");

        // ����� ������ � ��������� ���������� �������

        exit();

    }

    mysql_query("SET NAMES cp1251");







// ����� �������� ���� ������ ��� ������

    if (!mysql_select_db($dbnm)) { // ���� ��� ����� ��

        print("Datebase select failed.");

        // ����� ������ � ��������� ���������� �������

        exit();

    }

}



?>

