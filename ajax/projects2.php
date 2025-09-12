<?php

@header("Content-Type: text/html; charset=windows-1251");
define("bullshit", 1);
include "../sc/dbcon.php";
//include ("../sc/lib_new.php");
//  require_once("admin/modules/functions.php");
//$MAIN_HTTP_PATH = "/";

database_connect();
mysql_query("SET NAMES 'cp1251'");

global $APATH;
global $net;
$APATH = 'http://www.rusavtomatika.com';

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


    // установка соединени€
    $conn_id = ftp_connect($ftp_server);
    // вход с именем пользовател€ и паролем
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
    ftp_pasv($conn_id, true);

    //ftp_chdir($conn_id, $dir);
    ftp_set_option($conn_id, FTP_TIMEOUT_SEC, 3600);
    //$buff = ftp_nlist($conn_id, $dir);
    //$msize = ftp_size($conn_id, $dir.'/'.$buff[$i]);
    //$mtime = ftp_mdtm($conn_id, $serf);
    //$t =  date("U", $mtime);
};


if (!empty($_GET["find_projects"])) {
    $kolvo = 0;
    $unique = array();
//    $ask_d = iconv('UTF-8', 'windows-1251', (trim(strip_tags($_POST["ask_drivers"]))));
    $ask_d = (trim(strip_tags($_GET["find_projects"])));
    $ask_d = iconv('UTF-8', 'windows-1251', $ask_d);
    $d_image = '<img title="—качать" src="/images/download.png">';
    $query = "SELECT * FROM `w_projects` WHERE `category` LIKE '%{$ask_d}%' AND `show`='1' ORDER BY `date` DESC;";
    $result = mysql_query($query) or die("dberror1");
    $j = mysql_numrows($result);

    $kolvo = $kolvo + $j;
    if ($j > 0) {
        for ($i = 0; $i < $j; $i++) {
            $row = mysql_fetch_assoc($result);
            $as = strtoupper($ask_d);
            $sask = '/' . $as . '/i';
            $name = preg_replace($sask, '<span class="blue">' . $as . '</span>', $row["name"]);
//            $na = iconv('UTF-8', 'windows-1251', $row[name]);
            $na = $row["name"];
            if (!empty($row["stext"])) {
//                $text = iconv('UTF-8', 'windows-1251', $row[stext]);
                $text = $row["stext"];
            } else {
                $text = '';
            };

            if (isset($row["img_big"]) and $row["img_big"] != "") {
                $detail_picture = $row["img_big"];
            } else {
                $detail_picture = $row["img"];
            }
            $down .= '<tr><td><a href="' . $detail_picture . '" rel="lightbox[1]" >'
                    . '<div class="preview_picture_wrapper"><div class="preview_picture" style="background-image:url(\'' .
                    $row["img"] . '\')" title="' . $row["name"] . '"></div></div></a></td>
<td colspan="4"><div class="name_text"><h3>' . $name . '</h3>' . $text . '</div></td>
</tr>
';

            if (!empty($row["path"])) {
                $file = $WTPATH . $row[path];
                if ($GLOBALS["net"] == 0) {
                    $t = date("d-m-Y", filemtime($file));
                    $tu = date("U", filemtime($file));
                    $fs = (sprintf("%u", filesize($file)) + 0) / 1024;
                } else {

//                    $mtime = ftp_mdtm($conn_id, $file);
                    $mtime = ftp_mdtm($conn_id, $row["path"]);
                    $t = date("d-m-Y", $mtime);
                    $tu = date("U", $mtime);
//                    $fs = (sprintf("%u", ftp_size($conn_id, $file)) + 0) / 1024;
                    $fs = (sprintf("%u", ftp_size($conn_id, $row["path"])) + 0) / 1024;
                };

                $now = time();
                if ($now - 864000 < $tu) {
                    $new = ' style="color: #0066E7;"';
                } else {
                    $new = '';
                };

//$s =  ceil($fs/1024);

                $s = round($fs / 1024, 2);
                $s .= '&nbsp;ћб';
                /* echo $s . "!!!";
                  if ($s > 1) {
                  $s .= '&nbsp;ћб';
                  } else {
                  $s = $s * 100;
                  $s .= '&nbsp; б';
                  }; */
                if (!empty($row[author])) {
                    $author = $row[author];
                } else {
                    $author = 'Weintek Labs., Inc.';
                };
                if (!empty($row[model])) {
                    $p = $row[po] . '<br /><span style="color:#0066E7;">' . $row[model] . '</span>';
                } else {
                    $p = $row[po];
                };
                list($date_first, $date_second) = explode(' ', $row['date']);
                list($God, $Mes, $Day) = explode('-', $date_first);
                $date = $Day . '.' . $Mes . '.' . $God;
                $down .= '
<tr style="text-align:center;"><td>јвтор: ' . $author . '</td><td>' . $p . '</td><td>' . $date . '</td><td>–азмер: ' . $s . '</td><td><a href="' . $row[path] . '">' . $d_image . '</a></td>
</tr>
';
            } else {
                $down .= '
<tr><td colspan="5">&nbsp;</td><td>&nbsp;</td>
</tr>
';
            };


            $down .= '<tr class="h3"><td colspan="5">&nbsp;</td></tr>';
            if (!in_array($row[name], $unique)) {
                $unique[] = $row[name];
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

//$a = preg_match("/[^ый\b]|[^ой\b]|[^а€\b]|[^ое\b]|[^ые\b]|[^ому\b]|а\b|о\b|у\b|е\b|ого\b|ему\b|и\b|ых\b|ох\b|и€\b|ий\b|ь\b|€\b|он\b|ют\b|ат\b]/Uui", $a,$ab);
//$a = preg_replace('/а$/ui', '', $a);4
//            $avv = iconv('UTF-8', 'windows-1251', $a);
            $avv = $a;
            if (preg_match("/(ому|ого|ему)$/ui", $avv)) {
                $a = substr($a, 0, -3);
                $avv = $a;
            };
            if (preg_match("/(ов|ый|ой|а€|ое|ые|ых|ох|и€|ий|он|ют|ат|ом)$/ui", $avv)) {
                $a = substr($a, 0, -2);
                $avv = $a;
            };
            if (preg_match("/(а|о|у|и|€)$/ui", $avv)) {
                $a = substr($a, 0, -1);
                $avv = $a;
            };
//$avv = iconv('windows-1251','UTF-8',$avv);
//print_r($avv);
//$a = $ab[0];
            $a = preg_replace("/EB(.*)Pro/i", 'EasyBuilder Pro', $a);
            $query = "SELECT * FROM `w_projects` WHERE (`name` LIKE '%{$ask_array[$x]}%' OR `stext` LIKE '%{$a}%' OR `model` LIKE '%{$a}%' OR `po` LIKE '%{$a}%')  AND `show`='1' ORDER BY `date` DESC;";
            $result = mysql_query($query) or die("dberror2");
            $j = mysql_numrows($result);
            for ($i = 0; $i < $j; $i++) {
                $row = mysql_fetch_assoc($result);
                if (!in_array($row[name], $unique)) {
                    $unique[] = $row[name];
                    $kolvo++;
                    $as = strtoupper($a);
                    $sask = '/' . $as . '/i';
                    $name = preg_replace($sask, '<span class="blue">' . $as . '</span>', $row[name]);
//                    $na = iconv('UTF-8', 'windows-1251', $row["name"]);
                    $na = $row["name"];

                    if (!empty($row["stext"])) {
//                        $text = iconv('UTF-8', 'windows-1251', $row[stext]);
                        $text = $row["stext"];
                    } else {
                        $text = '';
                    };

                    if (isset($row["img_big"]) and $row["img_big"] != "") {
                        $detail_picture = $row["img_big"];
                    } else {
                        $detail_picture = $row["img"];
                    }
                    $down .= '<tr><td><a href="' . $detail_picture . '" rel="lightbox[1]" >'
                            . '<div class="preview_picture_wrapper"><div class="preview_picture" style="background-image:url(\'' .
                            $row["img"] . '\')" title="' . $row["name"] . '"></div></div></a></td>
<td colspan="4"><div class="name_text"><h3>' . $name . '</h3>' . $text . '</div></td>
</tr>
';
                    if (!empty($row[path])) {
                        $file = $WTPATH . $row[path];
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
                            $s .= '&nbsp;ћб';
                        } else {
                            $s = $s * 100;
                            $s .= '&nbsp; б';
                        };
                        if (!empty($row["author"])) {
                            $author = $row["author"];
                        } else {
                            $author = 'Weintek Labs., Inc.';
                        };
                        $date = $row['date'];
//$title = $row[title];
                        list($date_first, $date_second) = explode(' ', $row['date']);
                        list($God, $Mes, $Day) = explode('-', $date_first);
                        $date = $Day . '.' . $Mes . '.' . $God;
                        if (!empty($row["model"])) {
                            $p = $row["po"] . '<br /><span style="color:#0066E7;">' . $row["model"] . '</span>';
                        } else {
                            $p = $row["po"];
                        };
                        $down .= '
<tr style="text-align:center;"><td>јвтор: ' . $author . '</td><td>' . $p . '</td><td>' . $date . '</td><td>–азмер: ' . $s . '</td><td><a href="' . $row["path"] . '">' . $d_image . '</a></td>
</tr>
';
                    } else {
                        $down .= '
<tr><td colspan="5">&nbsp;</td><td>&nbsp;</td>
</tr>
';
                    };


                    $down .= '<tr class="h3"><td colspan="5">&nbsp;</td></tr>';
                };
            };
        };
    };
//};
//$result = array_unique($name_space);
//$data = iconv("utf-8", "windows-1251", $data);
//$array = array('siemens'->'',);

    if ($kolvo != 0) {
        $down = '<div id="drive-table"><table class="model-param download">' . $down . '</table></div>';
    } else {
        $down = 'nothing';
    };
    echo $down;
} else {
    echo 'pusto';
};
?>