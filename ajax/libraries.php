<?php
@header("Content-Type: text/html; charset=utf-8");
define("bullshit", 1);
include "../sc/dbcon.php";
@header("Content-Type: text/html; charset=utf-8");
//include ("../sc/lib_new.php");
//  require_once("admin/modules/functions.php");
//$MAIN_HTTP_PATH = "/";
global $mysqli_db;
database_connect();
mysqli_query($mysqli_db, "SET NAMES 'utf8'");
$down = '';
$unique = array();
$kolvo = 0;
global $APATH;
global $net;
/*
  if (preg_match("/weblec/i",$_SERVER['DOCUMENT_ROOT'])) {
  $APATH = '/home/weblec/public_html/rusavtomatika.com';
  $WTPATH = '/home/weblec/public_html/rusavtomatika.com/upload_files';
  $net = 0;

  } else {

  $APATH = 'http://www.rusavtomatika.com';
  $WTPATH = '';
  $net = 1;
  $ftp_server = '5.9.94.42';
  $ftp_user_name='upload_olga@weblector.ru';
  $ftp_user_pass='olgaglr';
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
 */

if (!empty($_REQUEST["ask_drivers"])) {
    $ask_d = trim(strip_tags($_REQUEST["ask_drivers"]));
    //$ask_d = iconv('UTF-8', 'windows-1251', $ask_d);
    $d_image = '<img title="Скачать" src="/images/download.png">';
    $query = "SELECT * FROM `w_alibraries` WHERE `btext` LIKE '%{$ask_d}%' ORDER BY `btext`;";


    $result = mysqli_query($mysqli_db, $query) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
    $j = mysqli_num_rows($result);


    $kolvo = $kolvo + $j;
    if ($j > 0) {
        for ($i = 0; $i < $j; $i++) {
            $row = mysqli_fetch_assoc($result);
            if (!in_array($row["name"], $unique)) {
                $unique[] = $row["name"];
                $kolvo++;

                $jpg = "https://www.rusavtomatika.com/upload_files".$row["img"] . '.jpg';
                $gif = "https://www.rusavtomatika.com/upload_files".$row["img"] . '.gif';
//                $nam = iconv('windows-1251', 'UTF-8', $row["name"]);
                $nam = $row["name"];
                $na = $row["sys_name"];



                if ($na != '') {

                    $down .= '<tr class="changeimg"><td rowspan="5"><img class="jpg" src="' . $jpg . '"><img class="gif" src="' . $gif . '"></td>
<td colspan="3"><h3>' . $nam . '</h3>' . $row["btext"] . '</td>
</tr>';
                    $zip = '<a href="https://www.rusavtomatika.com' . $na . '" download>' . $d_image . '</a>';
                    $tu = $row["utime"];
                    $t = date("d-m-Y", $tu);
                    $s = $row["size"];

                    $now = time();
                    if ($now - 864000 < $tu) {
                        $new = ' style="color: #0066E7;"';
                    } else {
                        $new = '';
                    };


                    if ($s > 1) {
                        $s .= '&nbsp;Мб';
                    } else {
                        $s = $s * 100;
                        $s .= '&nbsp;Кб';
                    };

                    $down .= '<tr class="t_row"' . $new . '><td colspan="3">' . $row["alt"] . '</td></tr>
<tr class="t_row"' . $new . '>
<td><span title="Дата обновления файла">' . $t . '</span></td><td>' . $s . '</td>
<td>' . $zip . '</td></tr>';


                    $author = $row["author"];
                    $down .= '<tr class="t_row"><td colspan="3" class="easy">' . $row["easybuilder"] . '</td></tr>
<tr class="t_row"><td colspan="3">Автор: ' . $author . '</td></tr>';



                    $down .= '<tr class="h3"><td colspan="4">&nbsp;</td></tr>';
                };

                if (!in_array($row["name"], $unique)) {
                    $unique[] = $row["name"];
                };
            };
        };
    };
// else {



    $name_space = array();
    $result_array = array();
    if ($ask_d != '') {
        $ask_array = explode(' ', $ask_d);
        $z = count($ask_array);


        for ($x = 0; $x < $z; $x++) {
            $a = $ask_array[$x];

//$a = preg_match("/[^ый\b]|[^ой\b]|[^ая\b]|[^ое\b]|[^ые\b]|[^ому\b]|а\b|о\b|у\b|е\b|ого\b|ему\b|и\b|ых\b|ох\b|ия\b|ий\b|ь\b|я\b|он\b|ют\b|ат\b]/Uui", $a,$ab);
//$a = preg_replace('/а$/ui', '', $a);4
//            $avv = iconv('windows-1251', 'UTF-8', $a);
            $avv = $a;
            $pattern = "/(ому|ого|ему)$/ui";
            //$pattern = iconv('windows-1251//IGNORE', 'utf-8//IGNORE', $pattern);
            if (preg_match($pattern, $avv)) {
                $a = substr($a, 0, -3);
                $avv = $a;
            };
            $pattern = "/(ов|ый|ой|ая|ое|ые|ых|ох|ия|ий|он|ют|ат|ом)$/ui";
            //$pattern = iconv('windows-1251//IGNORE', 'utf-8//IGNORE', $pattern);
            if (preg_match($pattern, $avv)) {
                $a = substr($a, 0, -2);
                $avv = $a;
            };

            $pattern = "/(а|о|у|и|я)$/ui";
            //$pattern = iconv('windows-1251//IGNORE', 'utf-8//IGNORE', $pattern);
            if (preg_match($pattern, $avv)) {
                $a = substr($a, 0, -1);
                $avv = $a;
            };
//$avv = iconv('windows-1251','UTF-8',$avv);
//print_r($avv);
//$a = $ab[0];
            $a = preg_replace("/EB(.*)Pro/i", 'EasyBuilder Pro', $a);
            $query = "SELECT * FROM `w_alibraries` WHERE `name` LIKE '%{$a}%' OR `btext` LIKE '%{$a}%' ORDER BY `btext`;";

            $result = mysqli_query($mysqli_db, $query) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
            $j = mysqli_num_rows($result);

            for ($i = 0; $i < $j; $i++) {
                $row = mysqli_fetch_assoc($result);
                if (!in_array($row["name"], $unique)) {
                    $unique[] = $row["name"];
                    $kolvo++;

                    $jpg = $row["img"] . '.jpg';
                    $gif = $row["img"] . '.gif';
//                    $nam = iconv('windows-1251', 'UTF-8', $row["name"]);
                    $nam = $row["name"];
                    /*
                      if ($GLOBALS["net"] == 0) {
                      if (!file_exists($jpg)) {
                      $image_s=imagecreatefromgif($gif);
                      imagejpeg($image_s, $jpg, 85);
                      };
                      };
                     */
                    $na = $row["sys_name"];



                    if ($na != '') {

                        $down .= '<tr class="changeimg"><td rowspan="5"><img class="jpg" src="' . $jpg . '"><img class="gif" src="' . $gif . '"></td>
<td colspan="3"><h3>' . $nam . '</h3>' . $row["btext"] . '</td>
</tr>';
                        $zip = '<a href="' . $na . '" download>' . $d_image . '</a>';
                        $tu = $row["utime"];
                        $t = date("d-m-Y", $tu);
                        $s = $row["size"];

                        $now = time();
                        if ($now - 864000 < $tu) {
                            $new = ' style="color: #0066E7;"';
                        } else {
                            $new = '';
                        };


                        if ($s > 1) {
                            $s .= '&nbsp;Мб';
                        } else {
                            $s = $s * 100;
                            $s .= '&nbsp;Кб';
                        };

                        $down .= '<tr class="t_row"' . $new . '><td colspan="3">' . $row["alt"] . '</td></tr>
<tr class="t_row"' . $new . '>
<td><span title="Дата обновления файла">' . $t . '</span></td><td>' . $s . '</td>
<td>' . $zip . '</td></tr>';


                        $author = $row["author"];
                        $down .= '<tr class="t_row"><td colspan="3" class="easy">' . $row["easybuilder"] . '</td></tr>
<tr class="t_row"><td colspan="3">Автор: ' . $author . '</td></tr>';



                        $down .= '<tr class="h3"><td colspan="4">&nbsp;</td></tr>';
                    };
                };
            };
        };
    };
//};
//$result = array_unique($name_space);
//$data = iconv("utf-8", "windows-1251", $data);
//$array = array('siemens'->'',);

    if ($kolvo != 0) {
        if (($kolvo > 4) AND ( $kolvo < 21)) {
            $d_name = 'проектов/макросов';
        } else {
            $koltostring = strval($kolvo);
            $last = substr($koltostring, -1);
            $koltostring = $koltostring + 0;
            if ($koltostring == 1) {
                $d_name = 'библиотека';
            } elseif (($koltostring > 1) AND ( $koltostring < 5)) {
                $d_name = 'библиотеки';
            } else {
                $d_name = 'библиотек';
            };
        };
        $down = '<div id="drive-table"><div id="drive-note" ><span style="font-weight: normal;">' .
                $kolvo . ' ' . $d_name . ' соответствуют запросу "' . $ask_d .
                '"</span>&nbsp;&nbsp;</div><table class="model-param download">' . $down . '</table></div>';
    } else {
        $down = 'nothing';
    };
    echo $down;
} else {
    echo 'pusto';
};
?>