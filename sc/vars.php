<?
$EB8000_link = "/soft/EB8000/EB8000_setup.zip";
$EB8000_manual_link = "/manuals/UserManualEB8000.pdf";
$EBPro_link = "/soft/EBPro/EBpro_setup.zip";
$EBPro_manual_link = "/manuals/EBPro_Manual_All_In_One.pdf";
$PLC_connect_guide = "/manuals/PLC_connection_guide.pdf";



global $APATH;
global $root_php;
//global $WTPATH;
if (preg_match("/weblec/i", $_SERVER['DOCUMENT_ROOT'])) {
    $APATH = '/home/weblec/public_html/rusavtomatika.com';
//$WTPATH = '/home/weblec/public_html/test_weinteknet';
    global $net;
    $net = 0;
    $root_php = $APATH . '/upload_files/';
} else {
    global $net;
//$APATH = 'https://www.rusavtomatika.com';
    $APATH = '';
    $root_php = 'https://www.rusavtomatika.com/upload_files';

//$WTPATH = 'https://www.test.weintek.net';
    $net = 1;
};

global $path_to_real_files;
if (preg_match("/weblec/i", $_SERVER['DOCUMENT_ROOT'])) {
    $path_to_real_files = $APATH . "/upload_files";
} else {
    $path_to_real_files = 'https://www.rusavtomatika.com/upload_files';
};
global $EB8000_version;
$EB8000_version = $GLOBALS["path_to_real_files"] . "/soft/EB8000/version.txt";

global $EBPro_version;
$EBPro_version = $GLOBALS["path_to_real_files"] . "/soft/EBPro/version.txt";

global $usd_rate_file;
$usd_rate_file = $_SERVER['DOCUMENT_ROOT'] . "/usdrate.txt";

global $SKWorkshop_version;
$SKWorkshop_version = $GLOBALS["path_to_real_files"] . "/soft/SKWorkshop/version.txt";

global $SKWorkshop_link;
$SKWorkshop_link = "/soft/SKWorkshop/setup_SKWorkshopv5_0_2.rar";

global $EA20_link;
$EA20_link = "/soft/EasyAccess/EasyAccess20_setup.zip";
global $EA20_version;
$EA20_version = $GLOBALS["path_to_real_files"] . "/soft/EasyAccess/version.txt";
global $EA20_manual_link;
$EA20_manual_link = "/soft/EasyAccess/EasyAccess20_manual.pdf";
?>