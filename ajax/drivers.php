<?php

@header("Content-Type: text/html; charset=utf-8");
global $APATH;
global $net;
$down = "";
if (preg_match("/weblec/i", $_SERVER['DOCUMENT_ROOT'])) {
    $APATH = '/home/weblec/public_html/rusavtomatika.com';
    $WTPATH = '/home/weblec/public_html/rusavtomatika.com/upload_files';
    $net = 0;
} else {

    $APATH = 'http://www.rusavtomatika.com';
    $WTPATH = '';
    $net = 1;
    $ftp_server = '51.254.18.36';
    $ftp_user_name = 'upload_olga@weblector.ru';
    $ftp_user_pass = 'olgaglr';
// установка соединения
    $conn_id = ftp_connect($ftp_server);
// вход с именем пользователя и паролем
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
    ftp_pasv($conn_id, true);

//ftp_chdir($conn_id, $dir);
    ftp_set_option($conn_id, FTP_TIMEOUT_SEC, 3600);
//$buff = ftp_nlist($conn_id, $dir);
//$msize = ftp_size($conn_id, $dir.'/'.$buff[$i]);
//$mtime = ftp_mdtm($conn_id, $serf);
//$t =  date("U", $mtime);
};

function trans($input) {
    $gost = array(
        "Є" => "YE", "І" => "I", "Ѓ" => "G", "і" => "i", "№" => "-", "є" => "ye", "ѓ" => "g",
        "А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d",
        "Е" => "e", "Ё" => "yo", "Ж" => "zh",
        "З" => "z", "И" => "i", "Й" => "j", "К" => "k", "Л" => "l",
        "М" => "m", "Н" => "n", "О" => "o", "П" => "p", "Р" => "r",
        "С" => "s", "Т" => "t", "У" => "u", "Ф" => "f", "Х" => "x",
        "Ц" => "c", "Ч" => "ch", "Ш" => "sh", "Щ" => "shh", "Ъ" => "",
        "Ы" => "y", "Ь" => "", "Э" => "e", "Ю" => "yu", "Я" => "ya",
        "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d",
        "е" => "e", "ё" => "yo", "ж" => "zh",
        "з" => "z", "и" => "i", "й" => "j", "к" => "k", "л" => "l",
        "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
        "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "x",
        "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "shh", "ъ" => "",
        "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
        " " => " ", "," => "", "!" => "", "&laquo;" => "", "&raquo;" => "",
        "#" => "-", "$" => "", "%" => "", "^" => "", "&" => "", "*" => "",
        "(" => "", ")" => "", "+" => "", "=" => "", ";" => "", ":" => "",
        "'" => "", "\"" => "", "~" => "", "`" => "", "?" => "", "/" => "",
        "[" => "", "]" => "", "{" => "", "}" => "", "|" => "", "." => ""
    );

    return strtr($input, $gost);
}

function sinn($input) {
    $sins = array(
        "arkus" => "arcus",
        "baknet" => "bacnet",
        "modbas" => "modbus",
        "simens" => "siemens",
        "seimens" => "siemens",
        "simins" => "siemens",
        "siemins" => "siemens",
        "micubishi" => "mitsubishi",
        "mizubishi" => "mitsubishi",
        "misubishi" => "mitsubishi",
        "schnaider" => "schneider",
        "shneider" => "schneider",
        "yaskava" => "yaskawa",
        "tashiba" => "toshiba",
        "rokwell" => "rockwell",
        "moller" => "moeller",
        "hitahi" => "hitachi",
        "fanuk" => "fanuc",
        "danfos" => "danfoss"
    );
    return strtr($input, $sins);
}

if (!empty($_REQUEST["ask_drivers"])) {
//    $ask_drivers = iconv('UTF-8', 'windows-1251', $_REQUEST["ask_drivers"]);
    $ask_drivers = $_REQUEST["ask_drivers"];

    $d_image = '<img title="Скачать" src="/images/download.png">';


    $dir = $WTPATH . '/drivers';

    if ($GLOBALS["net"] == 0) {
        $files = scandir($dir);
    } else {
        $files = ftp_nlist($conn_id, $dir);
    };
    $j = count($files);
    $names = array();
    for ($i = 0; $i < $j; $i++) {
        $names[$i] = str_replace('/drivers/', '', $files[$i]);
        $files[$i] = str_replace('/drivers/', '', $files[$i]);
        $names[$i] = str_replace('_', ' ', $files[$i]);
        $names[$i] = str_replace('.pdf', '', $names[$i]);
    };

/*    echo "<pre>";
    var_dump($files[$i]);
    echo "</pre>";*/

    $key = array_search($ask_drivers, $names);
    if ($key != false) {
        $kolvo = 1;
        $file = $dir . '/' . $files[$key];
//if (preg_match("/pdf$/i", $files[$key])) {


        if ($GLOBALS["net"] == 0) {
            $t = date("d-m-Y", filemtime($file));
            $tu = date("U", filemtime($file));
            $fs = (sprintf("%u", filesize($file)) + 0) / 1024;
        } else {

            $mtime = ftp_mdtm($conn_id, $file);
            $t = date("d-m-Y", $mtime);
            $tu = date("U", $mtime);
            $fs = (sprintf("%u", ftp_size($conn_id, $file)) + 0) / 1024;
        };
        $now = time();
        if ($now - 864000 < $tu) {
            $new = ' style="color: #0066E7;"';
        } else {
            $new = '';
        };

//$s =  ceil($fs/1024);
        $s = round($fs / 1024, 2);
        if ($s > 1) {
            $s .= '&nbsp;Мб';
        } else {
            $s = $s * 100;
            $s .= '&nbsp;Кб';
        };
        $down .= '<tr class="t_row"' . $new . '><td><a href="/drivers/' . $files[$key] . '" target="_blanck" title="Открыть &laquo;Описание драйвера ' . $names[$key] . '&raquo; в браузере">' . $names[$key] . '</a></td>
<td><span title="Дата обновления файла">' . $t . '</span></td><td>' . $s . '</td>
<td><a href="/drivers/' . $files[$key] . '" download>' . $d_image . '</a></td></tr>';

//};
    } else {
        $kolvo = 0;
        $down = '';
        $name_space = array();
        $result_array = array();
        $asks = trans($ask_drivers);
        $ask = sinn($asks);
        if ($ask != '') {
            $ask_array = explode(' ', $ask);
            $z = count($ask_array);
            for ($i = 0; $i < $j; $i++) {
                for ($x = 0; $x < $z; $x++) {
                    $sask = '/' . $ask_array[$x] . '/i';
                    if (preg_match($sask, $names[$i])) {
                        if (!in_array($files[$i], $result_array)) {
                            $result_array[] = $files[$i];
                            $file = $dir . '/' . $files[$i];
                            if (preg_match("/pdf$/i", $files[$i])) {
                                if ($GLOBALS["net"] == 0) {
                                    $t = date("d-m-Y", filemtime($file));
                                    $tu = date("U", filemtime($file));
                                    $fs = (sprintf("%u", filesize($file)) + 0) / 1024;
                                } else {
                                    $mtime = ftp_mdtm($conn_id, $file);
                                    $t = date("d-m-Y", $mtime);
                                    $tu = date("U", $mtime);
                                    $fs = (sprintf("%u", ftp_size($conn_id, $file)) + 0) / 1024;
                                };
                                $now = time();
                                if ($now - 864000 < $tu) {
                                    $new = ' style="color: #0066E7;"';
                                } else {
                                    $new = '';
                                };

//$s =  ceil($fs/1024);
                                $s = round($fs / 1024, 2);
                                if ($s > 1) {
                                    $s .= '&nbsp;Мб';
                                } else {
                                    $s = $s * 100;
                                    $s .= '&nbsp;Кб';
                                };
                                $down .= '<tr class="t_row"' . $new . '><td><a href="/drivers/' . $files[$i] . '" target="_blanck" title="Открыть &laquo;Описание драйвера ' . $names[$i] . '&raquo; в браузере">' . $names[$i] . '</a></td>
<td><span title="Дата обновления файла">' . $t . '</span></td><td>' . $s . '</td>
<td><a href="/drivers/' . $files[$i] . '" download>' . $d_image . '</a></td></tr>';
                                $kolvo++;
                            };
                        };
                    };
//$name_ar = explode(' ',$name);
//array_push($name_space, $name_ar);
                };
            };
        };
    };
//$result = array_unique($name_space);
//$data = iconv("utf-8", "windows-1251", $data);
//$array = array('siemens'->'',);

    if ($kolvo != 0) {
        if (($kolvo > 4) AND ( $kolvo < 21)) {
            $d_name = 'драйверов';
        } else {
            $koltostring = $kolvo + '';
            $last = substr($koltostring, -1);
            $koltostring = $koltostring + 0;
            if ($koltostring == 1) {
                $d_name = 'драйвер';
            } elseif (($koltostring > 1) AND ( $koltostring < 5)) {
                $d_name = 'драйвера';
            } else {
                $d_name = 'драйверов';
            };
        };
        $down = '<div id="drive-table"><div id="drive-note" ><span>' . $kolvo . ' ' . $d_name . ' соответствуют запросу "' . $ask_drivers . '"</span>&nbsp;&nbsp;</div><table class="model-param download">' . $down . '</table></div>';
    } else {
        $down = 'nothing';
    };
    //$down = iconv('utf-8', 'windows-1251', $down);
    echo $down;
} else {
    echo 'pusto';
};
?>