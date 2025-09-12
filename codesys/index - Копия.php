<?php
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
global $TITLE, $DESCRIPTION,$KEYWORDS, $extra_openGraph;
$extra_openGraph = array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/easybuilderpro.png",
    "openGraph_title" => "Easybuilder Pro",
    "openGraph_siteName" => "Русавтоматика"
);

$TITLE = 'Easybuilder Pro V6 Weintek | EasybuilderPro | EBPro | изибилдер про | изибилдерпро | скачать на русском | ';
$DESCRIPTION = 'EasyBuilder Pro является бесплатно распространяемым программным обеспечением для программирования панелей оператора компании Weintek, с поддержкой русского языка.';
$KEYWORDS = 'Easybuilder Pro, скачать, на русском, Weintek, ПО EasyBuilder Pro, EBPro, Easy Builder';

$serii = '
<a href="/weintek/series_MT8000iE.php">MT8000iE</a>,
<a href="/weintek/series_eMT3000.php">eMT3000</a>,
<a href="/weintek/series_MT8000XE.php">MT8000XE</a>,
<a href="/weintek/CloudHMI.php">cMT</a>,
<a href="/weintek/mTV-100.php">mTV</a>
';
global $extra_styles;
$extra_styles = '<link rel="stylesheet" type="text/css" href="/easybuilder-pro/easybuilder-pro.css" />';

include $_SERVER["DOCUMENT_ROOT"] . "/config.php";
if (EX != "_") {
    global $CONTENT_ON_WIDE_SCREEN;
    $CONTENT_ON_WIDE_SCREEN = false;
    require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
} else {
    ob_start();
    define("bullshit", 1);
    define("MAIN_FILE_EXECUTED", TRUE);
    require_once($_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
    global $kw;
    $kw = array(
        array(
            "path" => array("/easybuilder-pro/index.php"),
            "title" => 'Easybuilder Pro v6 Weintek | EasybuilderPro | EBPro | изибилдер про | изибилдерпро | скачать на русском |  ',
            "descr" => 'EasyBuilder Pro является бесплатно распространяемым программным обеспечением для программирования панелей оператора компании Weintek, с поддержкой русского языка.',
            "kw" => 'Easybuilder Pro, скачать, на русском, Weintek, ПО EasyBuilder Pro, EBPro, Easy Builder',
        ));

    temp0("weintek");
    top_buttons();
    basket();
    temp1_no_menu();
    show_price_val();
    temp2();

}

//header('Content-Type: text/html; charset=windows-1251');



/****************/
$arrArchive_ebpro_setup = CUtilities::kama_parse_csv_file("https://www.rusavtomatika.com/upload_files/soft/EBPro/archive_ebpro_setup.csv", 'UTF-8');
//$arrArchive_ebpro_setup = CUtilities::kama_parse_csv_file(__DIR__ ."/archive_ebpro_setup.txt", 'UTF-8');

/****************/
/*
if ($GLOBALS["net"] == 0) {

    if (file_exists($GLOBALS["EBPro_version"])) {
        $ver = file_get_contents($GLOBALS["EBPro_version"]);
    };
    $so = $GLOBALS["EBPro_link"];
    $tso = date("d-m-Y", filemtime($path_to_real_files . $so));
    $fsso = (sprintf("%u", filesize($path_to_real_files . $so)) + 0) / 1000;
    $ma = $GLOBALS["EBPro_manual_link"];
    $tma = date("d-m-Y", filemtime($path_to_real_files . $ma));
    $fsma = (sprintf("%u", filesize($path_to_real_files . $ma)) + 0) / 1000;
} else {
    //  $re = cu($GLOBALS["EBPro_version"]);

    $ver = cu_content($GLOBALS["EBPro_version"]);
    $so = $GLOBALS["EBPro_link"];
    $re1 = cu($path_to_real_files . $so);
    $tso = date("d-m-Y", $re1[1]);
    $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
    $ma = $GLOBALS["EBPro_manual_link"];
    $re2 = cu($path_to_real_files . $ma);
    $tma = date("d-m-Y", $re2[1]);
    $fsma = (sprintf("%u", $re2[0]) + 0) / 1000;
};*/
if (EX != "_") {

}else{
    include "../easybuilder-pro - Копия/content_old_template.php";
}



if (EX != "_") {
    include "../easybuilder-pro - Копия/content.php";
    echo $extra_styles;
    require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
}else{
    $buffer = ob_get_clean();
    echo $buffer;
    temp3();

if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {

    $buffer = explode("<!--ajax-->", $buffer);
    echo $buffer[1];
} else {
    if (isset($header_url) and $header_url != "") {
        header("Location: " . $header_url);
        exit();
    }

}
}

?>


