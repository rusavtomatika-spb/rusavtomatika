<?php

@header("Content-Type: text/html; charset=windows-1251");
define("bullshit", 1);
include "../sc/dbcon.php";
//include ("../sc/lib_new.php");
//  require_once("admin/modules/functions.php");
//$MAIN_HTTP_PATH = "/";
database_connect();
mysql_query("SET NAMES 'cp1251'");
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
  // ��������� ����������
  $conn_id = ftp_connect($ftp_server);
  // ���� � ������ ������������ � �������
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

if (!empty($_GET["ask_drivers"])) {
    $ask_d = trim(strip_tags($_GET["ask_drivers"]));
    $ask_d = iconv('UTF-8', 'windows-1251', $ask_d);
    $d_image = '<img title="�������" src="/images/download.png">';
    $query = "SELECT * FROM `w_alibraries` WHERE `btext` LIKE '%{$ask_d}%' ORDER BY `btext`;";
    $result = mysql_query($query) or die("dberror1");
    $j = mysql_numrows($result);
    $kolvo = $kolvo + $j;
    if ($j > 0) {
        for ($i = 0; $i < $j; $i++) {
            $row = mysql_fetch_assoc($result);
            if (!in_array($row[name], $unique)) {
                $unique[] = $row[name];
                $kolvo++;

                $jpg = $row[img] . '.jpg';
                $gif = $row[img] . '.gif';
//                $nam = iconv('windows-1251', 'UTF-8', $row[name]);
                $nam = $row[name];
                $na = $row[sys_name];



                if ($na != '') {

                    $down .= '<tr class="changeimg"><td rowspan="5"><img class="jpg" src="' . $jpg . '"><img class="gif" src="' . $gif . '"></td>
<td colspan="3"><h3>' . $nam . '</h3>' . $row[btext] . '</td>
</tr>';
                    $zip = '<a href="' . $na . '" download>' . $d_image . '</a>';
                    $tu = $row[utime];
                    $t = date("d-m-Y", $tu);
                    $s = $row[size];

                    $now = time();
                    if ($now - 864000 < $tu) {
                        $new = ' style="color: #0066E7;"';
                    } else {
                        $new = '';
                    };


                    if ($s > 1) {
                        $s .= '&nbsp;��';
                    } else {
                        $s = $s * 100;
                        $s .= '&nbsp;��';
                    };

                    $down .= '<tr class="t_row"' . $new . '><td colspan="3">' . $row[alt] . '</td></tr>
<tr class="t_row"' . $new . '>
<td><span title="���� ���������� �����">' . $t . '</span></td><td>' . $s . '</td>
<td>' . $zip . '</td></tr>';


                    $author = $row[author];
                    $down .= '<tr class="t_row"><td colspan="3" class="easy">' . $row[easybuilder] . '</td></tr>
<tr class="t_row"><td colspan="3">�����: ' . $author . '</td></tr>';



                    $down .= '<tr class="h3"><td colspan="4">&nbsp;</td></tr>';
                };

                if (!in_array($row[name], $unique)) {
                    $unique[] = $row[name];
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

//$a = preg_match("/[^��\b]|[^��\b]|[^��\b]|[^��\b]|[^��\b]|[^���\b]|�\b|�\b|�\b|�\b|���\b|���\b|�\b|��\b|��\b|��\b|��\b|�\b|�\b|��\b|��\b|��\b]/Uui", $a,$ab);
//$a = preg_replace('/�$/ui', '', $a);4
//            $avv = iconv('windows-1251', 'UTF-8', $a);
            $avv = $a;
            if (preg_match("/(���|���|���)$/ui", $avv)) {
                $a = substr($a, 0, -3);
                $avv = $a;
            };
            if (preg_match("/(��|��|��|��|��|��|��|��|��|��|��|��|��|��)$/ui", $avv)) {
                $a = substr($a, 0, -2);
                $avv = $a;
            };
            if (preg_match("/(�|�|�|�|�)$/ui", $avv)) {
                $a = substr($a, 0, -1);
                $avv = $a;
            };
//$avv = iconv('windows-1251','UTF-8',$avv);
//print_r($avv);
//$a = $ab[0];
            $a = preg_replace("/EB(.*)Pro/i", 'EasyBuilder Pro', $a);
            $query = "SELECT * FROM `w_alibraries` WHERE `name` LIKE '%{$a}%' OR `btext` LIKE '%{$a}%' ORDER BY `btext`;";
            $result = mysql_query($query) or die("dberror2");
            $j = mysql_numrows($result);
            for ($i = 0; $i < $j; $i++) {
                $row = mysql_fetch_assoc($result);
                if (!in_array($row[name], $unique)) {
                    $unique[] = $row[name];
                    $kolvo++;

                    $jpg = $row[img] . '.jpg';
                    $gif = $row[img] . '.gif';
//                    $nam = iconv('windows-1251', 'UTF-8', $row[name]);
                    $nam = $row[name];
                    /*
                      if ($GLOBALS["net"] == 0) {
                      if (!file_exists($jpg)) {
                      $image_s=imagecreatefromgif($gif);
                      imagejpeg($image_s, $jpg, 85);
                      };
                      };
                     */
                    $na = $row[sys_name];



                    if ($na != '') {

                        $down .= '<tr class="changeimg"><td rowspan="5"><img class="jpg" src="' . $jpg . '"><img class="gif" src="' . $gif . '"></td>
<td colspan="3"><h3>' . $nam . '</h3>' . $row[btext] . '</td>
</tr>';
                        $zip = '<a href="' . $na . '" download>' . $d_image . '</a>';
                        $tu = $row[utime];
                        $t = date("d-m-Y", $tu);
                        $s = $row[size];

                        $now = time();
                        if ($now - 864000 < $tu) {
                            $new = ' style="color: #0066E7;"';
                        } else {
                            $new = '';
                        };


                        if ($s > 1) {
                            $s .= '&nbsp;��';
                        } else {
                            $s = $s * 100;
                            $s .= '&nbsp;��';
                        };

                        $down .= '<tr class="t_row"' . $new . '><td colspan="3">' . $row[alt] . '</td></tr>
<tr class="t_row"' . $new . '>
<td><span title="���� ���������� �����">' . $t . '</span></td><td>' . $s . '</td>
<td>' . $zip . '</td></tr>';


                        $author = $row[author];
                        $down .= '<tr class="t_row"><td colspan="3" class="easy">' . $row[easybuilder] . '</td></tr>
<tr class="t_row"><td colspan="3">�����: ' . $author . '</td></tr>';



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
            $d_name = '��������/��������';
        } else {
            $koltostring = $kolvo + '';
            $last = substr($koltostring, -1);
            $koltostring = $koltostring + 0;
            if ($koltostring == 1) {
                $d_name = '����������';
            } elseif (($koltostring > 1) AND ( $koltostring < 5)) {
                $d_name = '����������';
            } else {
                $d_name = '���������';
            };
        };
        $down = '<div id="drive-table"><div id="drive-note" ><span style="font-weight: normal;">' .
                $kolvo . ' ' . $d_name . ' ������������� ������� "' . $ask_d .
                '"</span>&nbsp;&nbsp;</div><table class="model-param download">' . $down . '</table></div>';
    } else {
        $down = 'nothing';
    };
    echo $down;
} else {
    echo 'pusto';
};
?>