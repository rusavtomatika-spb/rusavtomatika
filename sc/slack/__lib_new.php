<?
$document_root = $_SERVER['DOCUMENT_ROOT'];

include ("$document_root/sc/vars.php");
include ("$document_root/sc/kw.php");

@header("Content-Type: text/html; charset=windows-1251");

function version($file) {

    $ver = '?1';
    $f = $_SERVER['DOCUMENT_ROOT'] . $file;
    if (file_exists($f)) {

        $ver = '?' . filemtime($f);
    }

    return $ver;
}

function ftp_rus_connect($dir) {

    $ftp_server = '5.9.94.42';
    $ftp_user_name = 'upload_olga@weblector.ru';
    $ftp_user_pass = 'olgaglr';
// установка соединения
    $conn_id = ftp_connect($ftp_server);
// вход с именем пользователя и паролем
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
    ftp_pasv($conn_id, true);

//ftp_chdir($conn_id, $dir);
    ftp_set_option($conn_id, FTP_TIMEOUT_SEC, 3600);
    $buff = ftp_nlist($conn_id, $dir);
    return $buff;
}

function cu($url) {
    $curl = curl_init();
    $re = array();
    curl_setopt($curl, CURLOPT_URL, $url);
    //don't fetch the actual page, you only want headers
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    //stop it from outputting stuff to stdout
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // attempt to retrieve the modification date
    curl_setopt($curl, CURLOPT_FILETIME, true);

    $result = curl_exec($curl);
    //   echo $result;
    $result = str_replace("\r", " ", $result);
    $result = str_replace("\n", " ", $result);
    if (preg_match('|Content-Length:*?[^0-9]([0-9].*)[\s]Connection:|sei', $result, $arr))
        $title = $arr[1];
    else
        $title = '';
    $title = trim($title);
    if (strlen($title) > 2) {
        if (!is_nan($title)) {
            $re[0] = $title;
        };
    };
    $info = curl_getinfo($curl);
//    print_r($info);
    if ($info['filetime'] != -1) { //otherwise unknown
        $re[1] = $info['filetime'];
        //date("Y-m-d H:i:s", $info['filetime']); //etc
    };
    curl_close($curl);
    return $re;
}

function cu_content($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function show_price_val() {
    echo"
<div id=shpr onclick='recalc_valute()' style='z-index: 1;'>
Отобразить цены в РУБ
</div>";
}

function action_price($model) {
    $date = date("Y-m-d H:i:s");
    $sql = "SELECT * FROM `action` WHERE  `model`='{$model}' AND `date_from`<='{$date}' AND `date_to`>='{$date}'  LIMIT 1";

    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) == 0)
        return "";
    $r = mysql_fetch_object($res);
    $price = $r->price;
    return $price;
}

function ifc_modif_decode($r) {
    $a = explode("-", $r->model);
    $mod = $a[1];
    if ($r->parent == 'IFC-BOX4000') {
        $cpu = $r->cpu_type . ' ';
    } else {
        $cpu = '';
    };
    if ($r->speakers != "")
        $spe = "динамики ";
    else
        $spe = "";
    if (($r->voltage_min != '') AND ( $r->voltage_max != '0')) {
        if ($r->voltage_min == $r->voltage_max)
            $vo = "$r->voltage_min" . "&nbsp;В ";
        else
            $vo = "$r->voltage_min-$r->voltage_max" . "&nbsp;В ";
    } else {
        $vo = '';
    };
    if (($r->hdd_size_gb != '') AND ( $r->hdd_size_gb != '0')) {
        $gb = '' . $r->hdd_size_gb . ' Гб ';
    } else {
        $gb = '';
    };
    if (($r->hdd_type != '') AND ( $r->hdd_type != '0')) {
        $hdd = '' . $r->hdd_type . ' ';
    } else {
        $hdd = '';
    };
    if ($r->model == 'COSY141') {
        $ports = 'SUBD9 ';
    } elseif ($r->model == 'COSY141 MPI') {
        $ports = 'MPI/PROFIBUS ';
    } else {
        $ports = '';
    };
    if ($r->model == 'EC61330') {
        $ports = '4xLAN/WAN, USB, ';
    } elseif ($r->model == 'EC6133C') {
        $ports = '4xLAN/WAN, USB, Wi-Fi, ';
    } elseif ($r->model == 'EC6133D') {
        $ports = '4xLAN/WAN, USB, 3G, ';
    };
    if ($r->parent == 'FLEXY') {
        $text = $r->spec_modif . '<br />';
        if ($r->model != 'FLEXY 201') {
            $vo = '';
        };
    } else {
        $text = '';
    };
    if (($r->ram != '') AND ( $r->ram != '0')) {
        $ram = "RAM " . ($r->ram / 1000) . " Гб ";
    } else {
        $ram = '';
    };
    $yo = '';
    if ($r->brand == 'Yottacontrol') {
        $yotta = array();
        if (preg_match('/D/i', $r->model)) {
            $yotta[] = 'Дисплей 1.5&#8243;';
        };
        if (preg_match('/M/i', $r->model)) {
            $yotta[] = 'Micro-SD';
        };
        if (preg_match('/89/i', $r->model)) {
            $yotta[] = '4DI/4AI/4DO';
        };
        if (preg_match('/88/i', $r->model)) {
            $yotta[] = '8DI/4DO';
        };
        if (preg_match('/T/i', $r->model)) {
            $yotta[] = 'Транзисторный выход';
        } else {
            $yotta[] = 'Релейный выход';
        };
        if (!empty($r->usb_host)) {
            $yotta[] = $r->usb_host;
        };
        if (!empty($r->serial_full)) {
            $yotta[] = $r->serial_full;
        };
        $yo = implode(', ', $yotta) . ', ';
    };

    if ($r->parent == 'eFive') {
        $efive = array();
        if ($r->model == 'eFive 25') {
            $efi = '50 одновременных подключений,<br />';
        } else if ($r->model == 'eFive 100') {
            $efi = '200 одновременных подключений,<br />';
        };
        if (!empty($r->ethernet)) {
            $efive[] = $r->ethernet;
        };
        if (!empty($r->serial_full)) {
            $efive[] = $r->serial_full;
        };
        if (!empty($r->usb_host)) {
            $efive[] = $r->usb_host;
        };
        $ef = $efi . implode(', ', $efive) . '';
        $hdd = '';
    };

    $out = $ef . $yo . $cpu . $text . $ram . $ports . $vo . $spe . $hdd . $gb;

    if ((empty($out)) AND ( !empty($r->spec_modif))) {
        $out = $r->spec_modif;
    };

    return $out;
}

function remain_days($date) {
    $now = time(); // or your date as well
    $your_date = strtotime($date);
    $datediff = $your_date - $now;
    return floor($datediff / (60 * 60 * 24));
}

function stime($format, $tm) {

    if ($tm == "0000-00-00")
        return "";
    //import locale;
    // locale.setlocale(locale.LC_ALL, 'ru_RU.UTF-8');
    //setlocale(LC_ALL,'ru_RU.CP1251','ru_RU','rus');
    //setlocale(LC_ALL, 'ru_RU');
    //$result = setlocale(LC_ALL, 'ru_RU','rus_RUS','Russian');
// $mone=array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    $mone = array("янв.", "фев.", "мар.", "апр.", "мая", "июня", "июля", "авг.", "сент.", "окт.", "ноя.", "дек.");
    $m = $mone[(int) strftime('%m', strtotime($tm)) - 1];


    $out = strftime('%d', strtotime($tm)) . " " . $m;
    if (strpos($format, "Y") !== false)
        $out = strftime('%d', strtotime($tm)) . " " . $m . " " . strftime('%Y', strtotime($tm));
    if (strpos($format, ":") !== false)
        $out .= " " . strftime('%T', strtotime($tm));

    return $out;
}

function show_pc_variants($model) {

//$sql="SELECT * FROM `products_all` WHERE  `modification`=1 AND `model` LIKE '$model%' ";
    $sql = "SELECT * FROM `products_all` WHERE  `modification`=1 AND `parent`='$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) == 0)
        return "";
    $out = "<table class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=1000>
<tr class=hed><td >Модель</td><td width=270>Спецификация</td><td width=180>Наличие</td><td width=80>Цена с НДС</td><td width=280>Действия</td></tr>";

    while ($r = mysql_fetch_object($res)) {
        if ((preg_match("/eWON/i", $r->brand)) OR ( $r->brand == '2N')) {
            $ue = 'EUR';
        } else {
            $ue = 'USD';
        };

        if (($r->retail_price != '0') AND ( $r->retail_price != '')) {
            $priceb = "<td><span class=prpr title='Нажмите для пересчета в РУБ' style='font-size:11px;'>$r->retail_price</span><span class=val_name title='Нажмите для пересчета в РУБ' style='font-size:11px;'> $ue </span></td>";
        } else {
            $priceb = "
<td>по&nbsp;запросу</td>
";
        };


        $spec = ifc_modif_decode($r);
        $out .= "<tr><td width=170 class=modif_name>$r->model</td><td>$spec</td><td>" . show_stock($r, 3) . "</td>
" . $priceb . "

<td style='    padding: 9px 6px 0px 14px;'><span class=zakazbut2 idm='$r->model' onclick='v_korzinu(this)'>В корзину</span>
 &nbsp <span class=zakazbut2 idm='$r->model' onclick='show_compare(this)'>В сравнение</span>
 &nbsp <span class=zakazbut2 idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'>Получить скидку</span>
 </td>
</tr>";
    }
    $out .= "</table>";
    return $out;
}

function set_db_var($name, $value) {
    $sql = "SELECT * FROM `variables` WHERE `name`='$name' ";
    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) == 0) {
        // create variable
        $sql = "INSERT INTO `variables` (name, value) VALUES ( '$name', '$value')";
        $res = mysql_query($sql) or die(mysql_error());
        return true;
    } else {
        // update variable
        $sql = "UPDATE `variables` SET `value`='$value'  WHERE `name`='$name' ";
        $res = mysql_query($sql) or die(mysql_error());
        return true;
    }
}

function get_db_var($varname) {
    $sql = "SELECT * FROM `variables` WHERE `name`='$varname' ";
    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) > 1)
        return "more then 1 var";
    if (!$r = mysql_fetch_object($res))
        return "no var";
    return $r->value;
}

function get_models_expected_date($model) {
    $sql = "SELECT * FROM `products_all` WHERE `model`='$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    if (!$r = mysql_fetch_object($res))
        return "";
    $brand = $r->brand;
//echo $brand;
//
    $sql = "SELECT * FROM `orders_on_way` WHERE `brand`='$brand' AND `blocked`='0' AND `arrived`='0' ";
    $res = mysql_query($sql) or die(mysql_error());
    $out = "";
    while ($r = mysql_fetch_object($res)) {
        $id = $r->id;
        // echo $id.", ";
        $sql = "SELECT * FROM `orders_on_way_detailed` WHERE `order_id`='$id' AND `model`='$model' ";
        $res1 = mysql_query($sql) or die(mysql_error());
        if (mysql_num_rows($res1) > 0)
            return $r->arrive_date;
    }

    return "";
}

function get_order_on_way_id($order, $brand) {  // returns order object from datyabase that accords order need to be shown
    $sql = "SELECT * FROM  `orders_on_way` WHERE `brand` = '$brand' AND `blocked` = 0 ORDER BY `id` ASC";
    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) < $order)
        return false;
    $out = "";
    $i = 0;
    while ($r = mysql_fetch_object($res)) {
        if ($i == $order)
            break;
        $i++;
    }
    return $r;
}

function show_models_on_way($model, $order, $brand) {
    $sql = "SELECT * FROM  `orders_on_way` WHERE `brand` = '$brand' AND `blocked` = 0 ORDER BY `id` ASC";
    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) < $order)
        return false;
    $out = "";
    $i = 0;
    while ($r = mysql_fetch_object($res)) {
        if ($i == $order)
            break;
        $i++;
    }
    $order_id = $r->id;

    $sql = "SELECT * FROM  `orders_on_way_detailed` WHERE `model`= '$model' AND`order_id`='$order_id' ";
    $res = mysql_query($sql) or die(mysql_error());
    $sum = 0;
    while ($r = mysql_fetch_object($res)) {
        $sum += $r->amount;
    }
//if($sum==0) $sum="";
    return $sum;
}

function show_reserved_amount($model, $stock) {
    $sql = "SELECT * FROM  `reservations` WHERE `model`= '$model' AND `stock` = '$stock' AND `blocked` = 0 ";
    $res = mysql_query($sql) or die(mysql_error());
    $sum = 0;
    while ($r = mysql_fetch_object($res)) {
        $sum += $r->amount;
    }

// if($sum==0) $sum=" ";

    return $sum;
}

function xor_this($string) {

// Let's define our key here
    $key = ('magic_key');

    // Our plaintext/ciphertext
    $text = $string;

    // Our output text
    $outText = '';

    // Iterate through each character
    for ($i = 0; $i < strlen($text);) {
        for ($j = 0; ($j < strlen($key) && $i < strlen($text)); $j++, $i++) {
            $outText .= $text{$i} ^ $key{$j};
            //echo 'i='.$i.', '.'j='.$j.', '.$outText{$i}.'<br />'; //for debugging
        }
    }
    return $outText;
}

function random_str($len) {

    $arr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z',
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

//$arr = array('1','2','3','4','5','6','7','8','9','0');

    $string = "";
    for ($i = 0; $i < $len; $i++) {
        $index = rand(0, count($arr) - 1);
        $string .= $arr[$index];
    }

    return $string;
}

function random_num($len) {

    $arr = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

//$arr = array('1','2','3','4','5','6','7','8','9','0');

    $string = "";
    for ($i = 0; $i < $len; $i++) {
        $index = rand(0, count($arr) - 1);
        $string .= $arr[$index];
    }

    return $string;
}

/*
  Му участвуем в выставке <strong>Мир Климата 2014</strong>, которая пройдет <br> в Санкт-Петербурге в СКК с 30.10 по 01.11.<br><br>
  Приглашаем всех посетить наш стенд <font color=red>№ C8.2 </font>  <br><br>
  На стенде будут представлены <a href='/weintek'>панели оператора Weintek</a>,
  <a href='/panelnie-computery/ifc'> панельные компьютеры IFC</a>, <a href='/samkoon'>операторские панели Samkoon</a>,
  <a href='panelnie-computery/aplex'>панельные компьютеры с емкостным дисплеем Aplex.

 */

function show_banner_ad1() {
    $im = "/images/exhib.png";
    $out = "
<div class=banner>
<table><tr>
<td width=400><img src=$im></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban> Выставка Мир Климата 2014 </h1>
<h2 class=h2_ban>
<br>
Мы принимаем участиe в выставке \"Мир Климата 2014\", которая <br> пройдет с <font color=red>11го по 14е марта </font> в Москве в выставочном
комплексе \"Экспоцентр\".<br><br>

Приглашаем всех посетить наш стенд <b>№8E601</b>, павильон 8, зал 2.<br><br>


На стенде будет представлена продукция: панели оператора Weintek и Samkoon, панельные компьютеры  IFC и Aplex.




</h2>
</div>
</td></tr>
</table>
</div>
";

    return $out;
}

function show_banner_ad() {
    $im = "/images/cloud_hmi.png";
    $out = "
<div class=banner>
<table><tr>
<td width=400><img src=$im></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban>Семинар по продукции Weintek </h1>
<h2 class=h2_ban>
<br>
ООО \"Русавтоматика\", официальный дистрибьютор Weintek Labs. в России, проводит семинар, посвященный
продукции Weintek. <br><br> На семинаре будут выступать как сотрудники ООО \"Русавтоматика\", так и представители компании Weintek Labs. <br><br>
В ходе семинара будут представлены новинки Weintek - новая серия Cloud HMI.<br><br>
Семинар состоится  <font color=red>13 марта 2014</font> в Москве, в выставочном комплексе \"Экспоцентр\".<br><br>
<span class=button_podr onclick='window.location=\"/conf\"'> Подробнее </span>



</h2>
</div>
</td></tr>
</table>
</div>
";

    return $out;
}

function show_banner_product($model) {
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_object($res);
    $im = get_big_pic($model);
    $bt = "<img src=/images/th_up.png>";
    if ($model == 'IFC-BOX4000') {
        $trh = "height=38";
    } elseif (($model == 'ARCHMI-710P') OR ( $model == 'ARCHMI-707P') OR ( preg_match('/Flexy/i', $model)) OR ( preg_match('/COSY141/i', $model))) {
        $trh = "height=38";
    } else {
        $trh = "height=40";
    };

    $ml = get_link_to_model($model);
// <span style='width: 200px; display: inline-block;'></span>
//<span valign=center>Цена: $r->retail_price USD</span>  <span class=button_podr style='float:right;' onclick='window.location=\"$ml\"'> Подробнее </span>
    if (($r->brand == "IFC") AND ( ($r->series == 'i3') OR ( $r->series == 'RF'))) {

        if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
                or ( $r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
            $onst = "";
        else
            $onst = ", есть на складе";
        $out = "
<div class=banner>
<table><tr>
<td width=400><a href=$ml><img src=$im></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban>$r->diagonal\" Панельный компьютер <strong> $r->model </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
<tr $trh><td>$bt</td><td><div class=ban_list> Промышленный панельный компьютер с сенсорным дисплеем</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Процессор $r->cpu_type " . ($r->cpu_speed / 1000) . " ГГц </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Полностью готов к использованию, ОЗУ и жесткий диск уже установлены</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Пылевлагозащита по фронту (IP65)</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Порты: $r->serial, 2хGb LAN, $r->usb_host, VGA, LPT</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price USD$onst  </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end IFC brand

    if (($r->brand == "IFC") AND ( $r->series == 'BOX-PC')) {

        if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
                or ( $r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
            $onst = "";
        else
            $onst = ", есть на складе";
        if ((!empty($r->cpu_speed)) AND ( $r->cpu_speed != '0')) {
            $speed = $r->cpu_speed / 1000;
            $speed = ' ' . $seed . ' ГГц';
        } else {
            $speed = '';
        };
        if ((!empty($r->ram)) AND ( $r->ram != '0')) {
            $ram = $r->ram / 1000;
            $ram = $ram . ' Гб ' . $r->ram_type . ' ';
        } else {
            $ram = '';
        };
        if ($r->model != 'IFC-BOX4000') {
            $fan = ' безвентиляторный ';

            $reson = '';
        } else {
            $fan = ' ';

            $reson = '. Макс. разрешение ' . $r->resolution;
        };
        $out = "
<div class=banner>
<table><tr>
<td width=400><a href=$ml><img src=$im></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban>Встраиваемый компьютер <strong> $r->model </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
<tr $trh><td>$bt</td><td><div class=ban_list> Мощный" . $fan . "промышленный компьютер</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Процессор $r->cpu_type" . $speed . $reson . " </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Полностью готов к использованию, " . $ram . "ОЗУ и жесткий диск " . $r->hdd_size_gb . " " . $r->hdd_type . " уже установлены</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Возможна установка: " . $r->os . "</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Порты: $r->serial, 2хGb LAN, $r->usb_host, VGA, LPT</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price USD$onst  </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    }

    if ($r->brand == "Weintek") {
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if ($r->sd_card != "")
            $inter .= ", SD карта";
        if ($r->can_bus != "")
            $inter .= ", CAN";
        if ($r->linear_out != "")
            $inter .= ", линейный аудиовыход";

        if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
                or ( $r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
            $onst = "";
        else
            $onst = ", есть на складе";

        if (( $r->retail_price == '0') or ( $r->retail_price == '')) {
            $bprice = ' по запросу';
        } else {
            $bprice = ' ' . $r->retail_price . ' USD';
        };
        $reson = '';
        if (($r->model == 'MT8090XE') OR ( $r->model == 'MT8092XE')) {
            $reson = ', разрешение ' . $r->resolution;
        };
        $out = "
<div class=banner>
<table><tr>
<td width=400><a href=$ml><img src=$im></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban>$r->diagonal\" Панель оператора Weintek <strong> $r->model </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
<tr $trh><td>$bt</td><td><div class=ban_list> Операторская панель с сенсорным дисплеем$reson</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Высочайшее качество и надежность</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Порты: $inter </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Пылевлагозащита по фронту (IP65)</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $bprice$onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end Weintek brand


    if ($r->brand == "APLEX") {
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if ($r->sd_card != "")
            $inter .= ", SD карта";
        if ($r->can_bus != "")
            $inter .= ", CAN";
        if ($r->linear_out != "")
            $inter .= ", линейный аудиовыход";

        if (($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
                or ( $r->onstock_spb == "0" && $r->onstock_msk == "0" && $r->onstock_kiv == "0" && $r->onstock_ptg == "0"))
            $onst = "";
        else
            $onst = ", есть на складе";

        $im = "/images/aplex/$r->model/$r->model" . "_2.png";

        $reson = '';
        if ($r->model == 'ARCHMI-710P') {
            $im = "/images/aplex/$r->model/$r->model" . "_1.png";
            $reson = '. Разрешение ' . $r->resolution;
        };
        $out = "
<div class=banner>
<table><tr>
<td width=400><a href=$ml><img src=$im></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban>$r->diagonal\" Панельный компьютер Aplex  <strong> $r->model </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
<tr $trh><td>$bt</td><td><div class=ban_list> Процессор Atom N2600 ( 2 ядра ) 1,6 ГГц$reson</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Литой алюминиевый корпус, безвентиляторное охлаждение</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Емкостной сенсорный дисплей \"мультитач\", IP65 по фронту</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Порты: $inter </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Возможна установка Windows 7, Windows XP, Windows CE6.0 </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price USD$onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end Aplex brand


    if ($r->brand == "Samkoon") {
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if ($r->sd_card != "")
            $inter .= ", SD карта";
        if ($r->can_bus != "")
            $inter .= ", CAN";


        if ($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
            $onst = "";
        else
            $onst = ", есть на складе";

//$im="/images/aplex/$r->model/$r->model"."_2.png";

        $out = "
<div class=banner>
<table><tr>
<td width=400><a href=$ml><img src=$im></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban>$r->diagonal\" Панель оператора Samkoon  <strong> $r->model </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
<tr $trh><td>$bt</td><td><div class=ban_list> Бюджетная сенсорная панель оператора </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Бесплатное ПО SK Workshop</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Порты: $inter </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Пылевлагозащита по фронту (IP65)</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price USD$onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end Aplex brand

    if ($r->model == "mTV-100") {
        $im = "/images/weintek/mTV-100/mTV-100_5.png";
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if ($r->sdcard != "")
            $inter .= ", SD карта";
        if ($r->can_bus != "")
            $inter .= ", CAN";
        if ($r->linear_out != "")
            $inter .= ", линейный аудиовыход";

        if ($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
            $onst = "";
        else
            $onst = ", есть на складе";

        $out = "
<div class=banner>
<table><tr>
<td width=400><a href=$ml><img src=$im></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban> Machine-TV интерфейс Weintek <strong> $r->model </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
<tr $trh><td>$bt</td><td><div class=ban_list> Уникальное устройство, вывод данных с PLC на большой экран</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Выход HDMI разрешением 1280х720</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Порты: Ethernet, SD карта, USB, 3 COM порта</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Может работать дата-логгером, конвертером интерфейсов</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Установка на DIN рейку</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price USD $onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end mTV-100


    if ($r->model == "IFC-BOX2600") {
        $im = "/images/box-pc/IFC-BOX2600/IFC-BOX2600_1.png";
        $inter = $r->serial;
        if ($r->ethernet != "")
            $inter .= ", Ethernet";
        if ($r->usb_host != "")
            $inter .= ", USB";
        if ($r->sdcard != "")
            $inter .= ", SD карта";
        if ($r->can_bus != "")
            $inter .= ", CAN";
        if ($r->linear_out != "")
            $inter .= ", линейный аудиовыход";

        if ($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
            $onst = "";
        else
            $onst = ", есть на складе";


        $ml = "/promyshlennye-kompyutery-box-pc/IFC-BOX2600.php";
//$mm1="fuck";
        $out = "
<div class=banner>
<table><tr>
<td width=400><a href=$ml><img src=$im></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban> Встраиваемый компьютер <strong> IFC-BOX2600 </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
<tr $trh><td>$bt</td><td><div class=ban_list> Процессор Atom N2600, 2 ядра по 1,6 ГГц</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Безвентиляторное охлаждение</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Установлены 2 Гб ОЗУ, 32Гб SSD </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> 2xLAN, 6xRS232, 2xRS485, CFCARD slot, 4xUSB2.0, 6xDI, 6xDO</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price USD $onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>
";
    } // end IFC-BOX2600


    if ($r->brand == "eWON") {
        if (!preg_match("/COSY/i", $r->model)) {
            $tit = 'Первый промышленный модульный VPN-роутер';
            $im = "/images/ewon/Extention/Flexy-with-modules.png";
            $ml = "/ewon/FLEXY.php";
            $pluses = "
<tr $trh><td>$bt</td><td><div class=ban_list> Управление / отладка оборудования удаленно через Интернет </div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Базовый модуль: 4 x Ethernet и 4 слота для карт-расширений</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Карты-расширения: 2 x COM, Ethernet WAN, 3G + HSUPA и Wi-Fi</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Защищенное соединение — бесплатный облачный сервис Talk2M</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Простота установки и настройки</div></td></tr>
";
        } else {

            if ($r->model == 'COSY141') {
                $im = "/images/ewon/COSY141/COSY141_1.png";
                $ml = "/ewon/COSY141.php";
                $ports = ' Порт RS232/RS485 или MPI/PROFIBUS на выбор';
            } else {
                $im = "/images/ewon/COSY131/COSY131_1.png";
                $ml = "/ewon/COSY131.php";
                $ports = ' USB, а также Wi-Fi/3G на выбор';
            };
            $tit = 'Промышленный VPN-роутер';

            $pluses = "
<tr $trh><td>$bt</td><td><div class=ban_list> Защищеное подключение удаленых объектов автоматизации к Интернет</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> 4 x Ethernet для подключения оборудования</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list>$ports</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Бесплатный облачный сервис Talk2M от производителя</div></td></tr>
<tr $trh><td>$bt</td><td><div class=ban_list> Простота установки и настройки</div></td></tr>
";
        };
        if ($r->onstock_spb == "" && $r->onstock_msk == "" && $r->onstock_kiv == "" && $r->onstock_ptg == "")
            $onst = "";
        else
            $onst = ", есть на складе";




        $out = "<div class=banner>
<table><tr>
<td width=400 style='text-align: center;'><a href='$ml' ><img src=$im style='height:230px;'></a></td><td width=720 valign=top>
<div class=banner_cont>
<h1 class=h1_ban> $tit <strong> $r->model </strong> </h1>
<h2 class=h2_ban>
<br>
<table>
$pluses
<tr $trh><td>$bt</td><td><div class=ban_list><table><tr><td width=400> Цена: $r->retail_price EUR$onst </td><td> <span class=button_podr onclick='window.location=\"$ml\"'> Подробнее </span> </td></tr></table> </div></td></tr>

</table>


</h2>
</div>
</td></tr>
</table>
</div>";
    };
    return $out;
}

function show_product_mixed($model) {
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_object($res);

    if ($r->type == "hmi" || $r->type == "open_hmi") {
        return show_panel1($model);
    }
    if ($r->type == "panel_pc") {
        return show_ifc($model);
    }
}

function block_sql($str) {

//return preg_replace("/[^0-9]+/", "", $str);
//return eregi("[^A-Za-z0-9.]", $str);
    $a1 = array("'", '"', "[", "]", "(", ")", "\\", "/");
//$a2=array("&#39;","&quot;", "", "", "", "", "", "");
    $a2 = array("X", "X", "X", "X", "X", "X", "X", "X");
//$a2=array("", "", "", "");
    return str_replace($a1, $a2, $str);
}

function show_model_price($model) {
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_object($res);
    $action_price = action_price($r->model);

    if (!empty($action_price)) {
        $out = " <span class='prpr old'>$r->retail_price</span><span class='prpr action' style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$action_price</span><span class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </span>";
    } else {
        $out = "<span class='prpr' style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</span><span class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </span>";
    };

    return $out;
}

function get_link_to_model($model) {
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_object($res);
    if ($r->parent != "")
        $model = $r->parent;


    if (($r->brand == "APLEX") || (( $r->brand == "IFC") AND ( $r->type != 'monitor') AND ( $r->type != 'box-pc')))
        return "/panelnie-computery/" . strtolower($r->brand) . "/$model.php";
    elseif (( $r->brand == "IFC") AND ( $r->type == 'monitor')) {
        return "/monitors/$model.php";
    } elseif (( $r->brand == "IFC") AND ( $r->type == 'box-pc')) {
        return "/promyshlennye-kompyutery-box-pc/$model.php";
    } else
        return "/" . strtolower($r->brand) . "/$model.php";
}

function get_small_pic($model) {
    global $root_php;

    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_object($res);


    $fps_im = "/images/" . strtolower($r->brand) . "/$r->pic_small";




//$_SERVER['DOCUMENT_ROOT']
    if ($GLOBALS["net"] == 0) {
        if ((file_exists($GLOBALS["path_to_real_files"] . $fps_im)) AND ( !empty($r->pic_small))) {

            return $fps_im;
        }  // if exists return from database
        else {
            $pic = get_big_pic($r->model);

            if (!empty($pic) AND ( $pic != '/')) {

                return get_big_pic($r->model);
            } else {


                if (file_exists($GLOBALS["path_to_real_files"] . '/images/' . strtolower($r->brand) . '/' . $r->model . '/' . $r->model . '_1.png')) {
                    return '/images/' . strtolower($r->brand) . '/' . $r->model . '/' . $r->model . '_1.png';
                };
            };
        };
    } else {
        $re = cu($GLOBALS["path_to_real_files"] . $fps_im);
        if (($re[0] > 0) AND ( !empty($r->pic_small))) {
            return $fps_im;
        } else {
            $pic = get_big_pic($r->model);
            if (!empty($pic)) {
                return get_big_pic($r->model);
            } else {


                $file = $GLOBALS["path_to_real_files"] . '/images/' . strtolower($r->brand) . '/' . $r->model . '/' . $r->model . '_1.png';
                $re = cu($file);
                if ($re[0] > 0) {
                    return '/images/' . strtolower($r->brand) . '/' . $r->model . '/' . $r->model . '_1.png';
                };
            };
        };



        ;
    };
}

function get_big_pic($model) {

    global $root_php;

    if ($model == "")
        return "";
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_object($res);

    if ($r->parent != "") {
        $sql = "SELECT * FROM products_all WHERE `model` = '$r->parent' ";
        $res = mysql_query($sql) or die(mysql_error());
        $model = $r->parent;
        $r = mysql_fetch_object($res);
    };

//$_SERVER['DOCUMENT_ROOT']

    if ($r->pic_big != "") {

        $fps_im = "images/" . strtolower($r->brand) . "/$r->pic_big";
        $fps_im1 = 'images/ewon/' . $r->pic_big;
        $fps_im2 = 'images/box-pc/' . $r->pic_big;
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $fps_im))
                return '/' . $fps_im;  // if exists return from database
//if(file_exists($root_php.$fps_im)) return '/'.$fps_im;
            $fps_im = 'vpn-routers/img/' . $r->pic_big;
            if (file_exists($root_php . $fps_im1))
                return '/' . $fps_im1;
            if (file_exists($root_php . $fps_im2))
                return '/' . $fps_im2;
        } else {

            $re = cu($root_php . '/' . $fps_im);
            if ($re[0] > 0)
                return '/' . $fps_im;  // if exists return from database
            $re = cu($root_php . '/' . $fps_im1);
            if ($re[0] > 0)
                return '/' . $fps_im1;
            $re = cu($root_php . '/' . $fps_im2);
            if ($re[0] > 0)
                return '/' . $fps_im2;
        };
    }

    $imgroot = "images/" . strtolower($r->brand) . "/$r->model";

//echo $imgroot;
    if (preg_match("/eWON/i", $r->brand)) {
        if (preg_match("/141/i", $r->model)) {
            $m = 'COSY141';
        } elseif (preg_match("/131/i", $r->model)) {
            $m = 'COSY131';
        } elseif (preg_match("/eFive/i", $r->model)) {
            $m = 'eFive';
        } else {
            $m = 'FLEXY';
        };
        $imgroot = "images/ewon/$m";
    }
    if ($r->type == 'box-pc') {
        $imgroot = "images/box-pc/" . $r->model;
    };
    if ($GLOBALS["net"] == 0) {
        $add = '';
    } else {
        $add = '/';
    };
    $imfo = $root_php . $add . $imgroot . '/' . $r->model . '_1.png';

    if ($GLOBALS["net"] == 0) {
        if (file_exists($imfo)) {
//
            return '/' . $imgroot . '/' . $r->model . '_1.png';
        };
        $files = scandir($root_php . $imgroot);
    } else {
        $re = cu($imfo);
        if ($re[0] > 0) {
            return '/' . $imgroot . '/' . $r->model . '_1.png';
        };
        $files = ftp_rus_connect($root_php . $add . $imgroot);
    };


    if (!empty($files[2])) {
        return '/' . $imgroot . "/" . $files[2];
    }
    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . 'upload_files/' . $imgroot)) {
            $files = scandir($root_php . 'upload_files/' . $imgroot);
        };
    } else {
        $files = ftp_rus_connect($root_php . 'upload_files/' . $imgroot);
    };


    if (!empty($files[2])) {
        return '/' . $imgroot . "/" . $files[2];
    };


    $query_images = "SELECT * FROM `gallery` WHERE `model`='{$r->model}' ORDER BY `id` LIMIT 1;";

    $query_images_result = mysql_query($query_images) or die("ошибка запроса022" . $query_images);
    $iimg = mysql_num_rows($query_images_result);

    if ($iimg == 0) {
        $query_images = "SELECT * FROM `gallery` WHERE `model`='{$r->parent}' ORDER BY `id` LIMIT 1;";

        $query_images_result = mysql_query($query_images) or die("ошибка запроса022" . $query_images);
        $iimg = mysql_num_rows($query_images_result);
    };


    if ($iimg > 0) {


        $img_row = mysql_fetch_assoc($query_images_result);


//echo $_SERVER['DOCUMENT_ROOT'];
        $img_row[s_img_path] = $r->model . '_1.png';

        if ($r->type == 'monitor') {
            $path = 'images/ifc/' . $r->model . '/';

            if ($GLOBALS["net"] == 0) {
                if (file_exists($root_php . $path . $img_row[s_img_path])) {
                    $im1 = $path . $img_row[s_img_path];
                };
            } else {
                $re = cu($root_php . $path . $img_row[s_img_path]);
                if ($re[0] > 0) {
                    $im1 = $path . $img_row[s_img_path];
                };
            };
        } elseif ($r->type == 'cloud_hmi') {
            $path = 'weintek/img/';

            if ($GLOBALS["net"] == 0) {
                if (file_exists($root_php . $path . $img_row[s_img_path])) {
                    $im1 = $path . $img_row[s_img_path];
                };
            } else {
                $re = cu($root_php . $path . $img_row[s_img_path]);
                if ($re[0] > 0) {
                    $im1 = $path . $img_row[s_img_path];
                };
            };
        } elseif ($r->type == 'hmi') {
            $path = 'weintek/img/';

            if ($GLOBALS["net"] == 0) {
                if (file_exists($root_php . $path . $img_row[s_img_path])) {
                    $im1 = $path . $img_row[s_img_path];
                };
            } else {
                $re = cu($root_php . $path . $img_row[s_img_path]);
                if ($re[0] > 0) {
                    $im1 = $path . $img_row[s_img_path];
                };
            };
        } elseif ($r->type == 'panel_pc') {
            $path = 'images/ifc/' . $r->model . '/';

            if ($GLOBALS["net"] == 0) {
                if (file_exists($root_php . $path . $img_row[s_img_path])) {
                    $im1 = $path . $img_row[s_img_path];
                };
            } else {
                $re = cu($root_php . $path . $img_row[s_img_path]);
                if ($re[0] > 0) {
                    $im1 = $path . $img_row[s_img_path];
                };
            };
        } elseif ($r->type == 'box-pc') {
            $path = 'box-pc/img/';
            if ($GLOBALS["net"] == 0) {
                if (file_exists($root_php . $path . $img_row[s_img_path])) {
                    $im1 = $path . $img_row[s_img_path];
                };
            } else {
                $re = cu($root_php . $path . $img_row[s_img_path]);
                if ($re[0] > 0) {
                    $im1 = $path . $img_row[s_img_path];
                };
            };
        };




        return '/' . $im1;
    } else {
        return "";
    };
}

function miniatures($model, $mins_in_row, $mins_max, $table_width) {
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_object($res);
    if ($r !== false && $r->model != "") {  // if there is model in the database
        if ($r->parent != "")
            $sql = "SELECT * FROM products_all WHERE `model` = '$r->parent' ";
        $res = mysql_query($sql) or die(mysql_error());
        $r = mysql_fetch_object($res);

        if ((preg_match('/ARCHMI/i', $r->model)) AND ( !preg_match('/P$/i', $r->model))) {
//	$imgroot='/images/'.strtolower($r->brand).'/'.$r->model.'P';
            $r->model = $r->model . 'P';
        };
        $imgroot = "/images/" . strtolower($r->brand) . "/$r->model";


        $imfo = $GLOBALS["path_to_real_files"] . $imgroot . "/sm";

        $miniatures_in_raw = $mins_in_row;
        $modd = $r->model;

        if ($r->type == 'box-pc') {
            $imgroot = "/images/box-pc/$model";
            $imfo = $GLOBALS["path_to_real_files"] . $imgroot . "/sm";
            $modd = $model;
        }

        if ($r->brand == 'eWON') {

            $imgroot = "/images/ewon/$model";
            $imfo = $GLOBALS["path_to_real_files"] . $imgroot . "/sm";
            $modd = $model;
        }
    } else {  // if no model in the database

    }
//echo $ifmo;


    if ($GLOBALS["net"] == 0) {
        if (file_exists($imfo)) {
            $yes = 1;
        } else {
            $yes = 0;
        };
    } else {
        $re = ftp_rus_connect($imgroot . "/sm");
//var_dump ($re);

        if (!empty($re)) {
            $yes = 1;
        } else {
            $yes = 0;
        };
    };


    if ($yes == 1) {
        if ($GLOBALS["net"] == 0) {

            $files = scandir($imfo);
        } else {
            $imfo = $imgroot . "/sm";
            $files = ftp_rus_connect($imfo);
        };

        $miniatures = sizeof($files) - 2;


        $min_table = "<table class=\"minitable\" width=$table_width bfcolor=red><tr>";
        $mc = 0;

        if ($miniatures > $mins_max)
            $miniatures = $mins_max;

        $alt = get_kw("alt");
        $lgfo = $GLOBALS["path_to_real_files"] . $imgroot . "/lg";

        if ($GLOBALS["net"] == 0) {

            $lgfiles = scandir($lgfo);
        } else {
            $lgfo = $imgroot . "/lg";
            $lgfiles = ftp_rus_connect($lgfo);
        };

        for ($i = 0; $i < $miniatures; $i++) {
            $j = $i + 1;


            $fne = $modd . '_' . $j . '.png';
            if ((in_array($fne, $lgfiles))) {
                if ($i > 0) {
                    $lbox = "<a class=\"lightbox\" href=\"$imgroot/lg/$modd" . "_$j.png\" rel=\"lightbox[1]\"></a>";
                    $lclass = "class=\"toclick\"";
                    $llink = '"' . $imgroot . '/lg/' . $modd . '_' . $j . '.png"';
                } else {
                    $lbox = "<a class=\"lightbox\" href=\"$imgroot/lg/$modd" . "_$j.png\" rel=\"box[1]\"></a>";
                    $lclass = "class=\"toclick\"";
                    $llink = '"' . $imgroot . '/lg/' . $modd . '_' . $j . '.png"';
                };
            } else {
                $lbox = '';
                $lclass = '';
                $llink = '"0"';
            };

            $min_table .= "<td $lclass  onclick='dich(\"$imgroot/$modd" . "_$j.png\",$llink);'><img src=$imgroot/sm/$modd" . "_$j.png width=50 alt='$alt'>$lbox</td>
  ";
            $mc++;
            if ($mc == $miniatures_in_raw) {
                $mc = 0;
                $min_table .= "</tr><tr>";
            }
        }
        while ($mc < $miniatures_in_raw) {
            $mc++;
            $min_table .= "<td></td>";
        }

        $min_table .= "</tr></table>";
        //$im1="/images/panel/$r->model/$r->model"."_1.png";

        if ($miniatures == 1)
            $min_table = "";
    }

    else {
        $min_table = "";
//$im1="/images/panel/$r->pic_big";
    }

    return $min_table;
}

/*
  //--------------------------------------------- load miniatures ---------------------
  $imgroot="/images/panel/$r->model";
  $imfo=$document_root.$imgroot."/sm";

  $miniatures_in_raw=5;


  if(file_exists($imfo))
  {
  $files = scandir($imfo);

  $miniatures=sizeof($files)-2;
  //echo $miniatures;

  $min_table="<table width=350px bfcolor=red><tr>";
  $mc=0;
  for($i=0;$i<$miniatures; $i++)
  {
  $j=$i+1;
  $min_table.="<td onclick='dich(\"$imgroot/$r->model"."_$j.png\");'><img src=$imgroot/sm/$r->model"."_$j.png width=50></td>";
  $mc++;
  if($mc==$miniatures_in_raw) {$mc=0; $min_table.="</tr><tr>";}
  }
  while($mc<$miniatures_in_raw)
  {
  $mc++;
  $min_table.="<td></td>";

  }

  $min_table.="</tr></table>";
  $im1="/images/panel/$r->model/$r->model"."_1.png";

  if($miniatures==1) $min_table="";
  }

  else
  {
  $min_table="";
  $im1="/images/panel/$r->pic_big";
  }

  //-------------------------------end load miniature -------------------------------


 */

function get_file_date($file) {
    if ($GLOBALS["net"] != 0) {
        $file = preg_replace("/ /", "%20", $file);
    };
    $document_root = $GLOBALS["path_to_real_files"];
    $filename = $document_root . $file;

//return $filename;
    if ($GLOBALS["net"] == 0) {

        if (file_exists($filename)) {

            $out = date("d-m-y", filemtime($filename));
            $fs = filesize($filename);

            if ($fs > 1000000) {
                $fso = round($fs / 1000, 0);
                $fso = round($fso / 1000, 3);
                return $out . "<br>" . $fso . " MB";
            } else {
                if ($fs > 1000) {
                    $fso = $fs % 1000;
                    return $out . "<br>" . $fso . " KB";
                } else
                    return $out . "<br>" . $fs . " B";
            }
        } else
            return "no file";
    } else {
        $re = cu($filename);
        $t = date("d-m-Y", $re[1]);
        $fs = (sprintf("%u", $re[0]) + 0) / 1000;
        $fs = round($fs / 1000, 2);
        if ($fs > 1) {
            $fs .= '&nbsp;Мб';
        } else {
            $fs = $fs * 1000;
            $fs .= '&nbsp;Кб';
        };
        return $t . '<br />' . $fs;
    };
}

function show_com_connector($panel) {  //main func for show all panels connectors
    if (!file_exists("com_port/$panel.txt")) {
        echo "no file";
        return;
    }
    $f = file_get_contents("com_port/$panel.txt");
    $conns = explode("#", $f);  // get connectors;
//echo "connectors=$conns[0] <br>";

    for ($i = 0; $i < sizeof($conns); $i++) {
        $con_d = explode("---", $conns[$i]);
        $conn_d1 = explode("--", $con_d[0]);
        if ($conn_d1[1] == "M") {
            $imcon = "/images/com_m.png";
            $typcon = "DB-9 M ( Папа )";
        }
        if ($conn_d1[1] == "F") {
            $imcon = "/images/com_f.png";
            $typcon = "DB-9 F ( Мама )";
        }



        echo "<table width=950 class=pins_tab><tr><td width=300 valign=top align=left>
  <div class=pins_its>
  <span class=conn_name>Наименование разъема:</span>
  <br><div class=conn_name1 $conn_d1[0]</div><br>
  <span class=conn_name>Тип разъема: </span>
  <br><div class=conn_name1>$typcon</div> <br>
  <img src=$imcon width=200>
  </div>
  <td valign=top align=left>
  ";
        show_com_ports($con_d[1]);
        echo "</td></tr></table><br><br><br>";
    }



//$a=explode("\n", $f);
}

function show_com_ports($connector) {  // show one connector
    $a = explode("\n", $connector);
    $ports = sizeof($a);
//echo "ports=$ports<br>";
    echo "<table cellpadding=0 cellspacing=0 ><tr><td>
<table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc>
<tr><td><div class=pins_its_h>Pin #</div></td></tr>
<tr><td><div class=pins_its> 1</div></td></tr>
<tr><td><div class=pins_its>2</div></td></tr>
<tr><td><div class=pins_its>3</div></td></tr>
<tr><td><div class=pins_its>4</div></td></tr>
<tr><td><div class=pins_its>5</div></td></tr>
<tr><td><div class=pins_its>6</div></td></tr>
<tr><td><div class=pins_its>7</div></td></tr>
<tr><td><div class=pins_its>8</div></td></tr>
<tr><td><div class=pins_its>9</div></td></tr>
</table>
</td>";
    /*
      echo "<td>";
      show_1_port($a[0]);
      echo "</td>";
      echo "</tr></table>";
     */

    for ($y = 1; $y < $ports - 1; $y++) {  // from 1 because becaus 0 is before first \n
        echo "<td valign=top>";
        show_1_port($a[$y]);
        echo "</td>";
    }
    echo "</tr></table>";
}

function show_1_port($port) {   // show one port

    $b = explode("=", $port);
//echo "<br>";
    $c = explode("|", $b[1]);
    $pins = sizeof($c);
//echo $pins;
    echo "<table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc>
<tr><td><div class=pins_its_h>$b[0]</div></td></tr>";



    for ($i = 1; $i < 10; $i++) {
        $out = "";
        for ($j = 0; $j < $pins; $j++) {
            $p = explode(" ", $c[$j]);
            if ($p[0] == $i)
                $out = $p[1];
        }
        if ($out == "")
            $out = " &nbsp";
        echo "<tr><td ><div class=pins_its> $out</div></td></tr>";
    }

    echo "</table>";
}

function comp_pan($mod, $p) {
    $sql = "SELECT * FROM products_all WHERE `model` = '$mod' ";
    $res = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_object($res);

    $fo = strtolower($r->brand);
    if ($fo == "weintek")
        $fo = panel;
    if ($r->type == "box-pc")
        $fo = "box-pc";
    $imp = "/images/$fo/$r->model/$r->model" . "_1.png";
    $arr = array();
    $pn = array();

    $type = "";
    if ($r->type == "hmi")
        $type = "Панель оператора";
    if ($r->type == "panel_pc")
        $type = "Панельный компьютер";
    if ($r->type == "open_hmi")
        $type = "Open HMI";
    if ($r->type == "machine-tv-interface")
        $type = "Интерфейс Machine-TV";
    if ($r->type == "cloud_hmi")
        $type = "Интерфейс";
    if ($r->type == 'box-pc')
        $type = 'Встраиваемый компьютер';
    if ($r->type == 'monitor')
        $type = 'Монитор';
    if ($r->type == 'vpn-router')
        $type = 'VPN-роутер';
    $onst = show_stock($r, 3);

    array_push($arr, $r->model);
    array_push($pn, "Модель");
    array_push($arr, $r->retail_price);
    array_push($pn, "Цена, USD");
    array_push($arr, $onst);
    array_push($pn, "Наличие");
    array_push($arr, $r->series);
    array_push($pn, "Серия");
    array_push($arr, $r->brand);
    array_push($pn, "Бренд");
    array_push($arr, $type);
    array_push($pn, "Тип");

    array_push($arr, "empty");
    array_push($pn, "&nbsp Дисплей");

    array_push($arr, $r->diagonal . "\"");
    array_push($pn, "Диагональ");
    array_push($arr, $r->resolution);
    array_push($pn, "Разрешение");
    array_push($arr, $r->colors);
    array_push($pn, "Цветность");
    array_push($arr, $r->brightness);
    array_push($pn, "Яркость");
    array_push($arr, $r->contrast);
    array_push($pn, "Контраст");
    array_push($arr, $r->view_angle);
    array_push($pn, "Угол обзора, &deg");
    array_push($arr, $r->backlight);
    array_push($pn, "Подсветка");
    array_push($arr, $r->backlight_life);
    array_push($pn, "Время жизни подсветки");
    array_push($arr, $r->touch);
    array_push($pn, "Тип сенсора");

    array_push($arr, "empty");
    array_push($pn, "&nbsp Параметры");



    array_push($arr, $r->cpu_type);
    array_push($pn, "Процессор");
    array_push($arr, $r->cpu_speed);
    array_push($pn, "Частота, МГц");
    array_push($arr, $r->chipset);
    array_push($pn, "Чипсет");
    array_push($arr, $r->graphics);
    array_push($pn, "Графика");
    array_push($arr, $r->audio);
    array_push($pn, "Аудио");
    array_push($arr, $r->ram);
    array_push($pn, "ОЗУ, Мб");
    array_push($arr, $r->ram_type);
    array_push($pn, "Тип ОЗУ");
    array_push($arr, $r->ram_slots);
    array_push($pn, "Кол-во слотов ОЗУ");
    array_push($arr, $r->ram_max);
    array_push($pn, "Макс. объем ОЗУ, Мб");
    array_push($arr, $r->flash);
    array_push($pn, "Flash, Мб");
    array_push($arr, "$r->hdd_size_gb $r->hdd_type");
    array_push($pn, "Жесткий диск");
    array_push($arr, $r->rtc);
    array_push($pn, "Часы реального времени");
    array_push($arr, $r->power);
    array_push($pn, "Мощность, Вт");
    array_push($arr, $r->current);
    array_push($pn, "Потребляемый ток, А");
    array_push($arr, "$r->voltage_min-$r->voltage_max");
    array_push($pn, "Напряжение, В");

    array_push($arr, "empty");
    array_push($pn, "&nbsp Интерфейсы");

    array_push($arr, $r->serial_full);
    array_push($pn, "СОМ порты");
    array_push($arr, $r->lpt);
    array_push($pn, "Параллельный порт");
    array_push($arr, $r->ps2_klava);
    array_push($pn, "PS/2 клавиатура");
    array_push($arr, $r->ps2_mouse);
    array_push($pn, "PS/2 мышь");
    array_push($arr, $r->usb_host);
    array_push($pn, "USB host");
    array_push($arr, $r->usb_client);
    array_push($pn, "USB client");
    array_push($arr, $r->ethernet);
    array_push($pn, "Ethernet");
    array_push($arr, $r->can_bus);
    array_push($pn, "CAN");
    array_push($arr, $r->sdcard);
    array_push($pn, "SD карта");
    array_push($arr, $r->speakers);
    array_push($pn, "Встроенные динамики");

    array_push($arr, $r->linear_out);
    array_push($pn, "Линейный аудиовыход ");
    array_push($arr, $r->mic_in);
    array_push($pn, "Микрофонный вход ");
    array_push($arr, $r->video_input);
    array_push($pn, "Видео вход");
    array_push($arr, $r->pci_slot);
    array_push($pn, "PCI");
    array_push($arr, $r->vga_port);
    array_push($pn, "Порт VGA");
    array_push($arr, $r->dvi_port);
    array_push($pn, "Порт DVI");



    array_push($arr, "empty");
    array_push($pn, "&nbsp Конструкция");

    $mount = "";
    if ($r->wall_mount != "")
        $mount .= "в стену";
    if ($r->vesa75 != "")
        $mount .= ", VESA 75x75";
    if ($r->vesa100 != "")
        $mount .= ", VESA 100x100";
    if ($r->model == "mTV-100")
        $mount = "на DIN рейку";

    $arch = "память панели";
    if ($r->usb_host != "")
        $arch .= ", флешка";
    if ($r->sdcard != "")
        $arch .= ", SD карта";
    if ($r->os != "")
        $arch = "";

    $proj_load = "";
    if ($r->usb_client != "")
        $proj_load .= "с ПК по USB";
    if ($r->ethernet != "") {
        if ($proj_load != "")
            $proj_load .= ", ";
        $proj_load .= "с ПК по Ethernet";
    }

    if ($r->usb_host != "")
        $proj_load .= ", с флешки";
    if ($r->sdcard != "")
        $proj_load .= ", с SD карты";


    if ($r->os != "")
        $proj_load = "";

    $proj_windows = "";
    if ($r->brand == "Weintek")
        $proj_windows = "1999";
    if ($r->brand == "Samkoon")
        $proj_windows = "200";


    array_push($arr, $r->case_material);
    array_push($pn, "Материал корпуса");
    array_push($arr, $r->cpu_fan ? "вентилятор" : "безвентиляторное" );
    array_push($pn, "Тип охлаждения");
    array_push($arr, $mount);
    array_push($pn, "Варианты установки");
    array_push($arr, $r->power_switch);
    array_push($pn, "Выключатель питания");
    array_push($arr, $r->power_adapter);
    array_push($pn, "Внешний блок питания");
    array_push($arr, $r->set);
    array_push($pn, "Комплект поставки");

    array_push($arr, $r->dimentions);
    array_push($pn, "Размеры, мм");
    array_push($arr, $r->cutout);
    array_push($pn, "Вырез под посадку, мм");
    array_push($arr, $r->netto);
    array_push($pn, "Вес, кг");

    array_push($arr, "$r->temp_min-$r->temp_max");
    array_push($pn, "Рабочая темп-ра, &degC");

    array_push($arr, "empty");
    array_push($pn, "&nbsp ПО");

    if ((!preg_match('/ifc/i', $r->brand)) AND ( !preg_match('/Aplex/i', $r->brand))) {
        array_push($arr, $r->installed_os);
        array_push($pn, "Установленная OC");
    } else {
        array_push($arr, '-');
        array_push($pn, "Установленная OC");
    };

    array_push($arr, $r->os);
    array_push($pn, "Возможна установка OC");
    array_push($arr, $r->software);
    array_push($pn, "ПО для разработки проектов");
    array_push($arr, $proj_windows);
    array_push($pn, "Максимальное количество экранов в проекте");
    array_push($arr, $r->vnc);
    array_push($pn, "VNC сервер");
    array_push($arr, $r->ftp_access_hmi_mem);
    array_push($pn, "FTP доступ к памяти панели");
    array_push($arr, $r->ftp_access_sd_usb);
    array_push($pn, "FTP доступ к SD карте и флешке");
    array_push($arr, $arch);
    array_push($pn, "Возможность сохранения архивов данных");
    array_push($arr, $proj_load);
    array_push($pn, "Способы загрузки проекта в панель");
    array_push($arr, $r->project_size_mb);
    array_push($pn, "Максимальный размер проекта, Мб");
    array_push($arr, $r->history_data_size_mb);
    array_push($pn, "Объем памяти для сохранения архивов в панели Мб");

    $out = "";
    $out .= "<table>


<tr><td>$r->dimentions &nbsp</td></tr>
<tr><td>$r->netto &nbsp</td></tr>
<tr><td>$r->temp &nbsp</td></tr>
<tr><td>$r->temp_min &nbsp</td></tr>
<tr><td>$r->temp_max &nbsp</td></tr>
<tr><td>$r->brutto &nbsp</td></tr>
<tr><td>$r->video_input &nbsp</td></tr>";
    if (($r->brand == "Weintek") OR ( $r->brand == "Samkoon")) {
        $out .= "<tr><td>$r->os &nbsp</td></tr>";
    } else {
        $out .= "<tr><td>-</td></tr>";
    };


    $out .= "</table>
";
    if ($p == 1)
        return $arr;
    else
        return $pn;
}

function show_stock($r, $mode) {
    $install_hdd_days = 5;

    if ($mode == 1)
        $cl = "onstock"; // big letters
    if ($mode == 2)
        $cl = "onstock2"; // small letters
    if ($mode == 3)
        $cl = "onstock2"; // small letters and no "на складе"


    if ($r->onstock_spb == 0 && $r->onstock_msk == 0 && $r->onstock_kiv == 0 && $r->onstock_ptg == 0) {
        $med = get_models_expected_date($r->model);
        $ifc320 = false;
        if (strpos($r->model, "320HDD") !== false) {
            $sql = "SELECT * FROM `products_all` WHERE `brand`='IFC' AND `diagonal`='$r->diagonal' AND
   (`onstock_spb` > 0 OR `onstock_msk` > 0 )";
            $res = mysql_query($sql) or die(mysql_error());
            if (mysql_num_rows($res) > 0)
                $ifc320 = true;  // there are same diagonals of IFC on stock we can install 320 HDD
        }
        //

        if ($mode == 3) {
            if ($med == "") {
                if ($ifc320)
                    return "под заказ $install_hdd_days дней";
                else
                    return "под заказ ";
            }
            $med1 = remain_days($med);
            $med = stime("", $med);
            return "ожидается через $med1 дней";
        }

        $line = 'под заказ';
        if ($med == "") {
            if ($ifc320)
                return "<div class=$cl> <img src='/images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ $install_hdd_days </div>";
            else
                return "<div class=$cl> <img src='/images/red_sq.gif' >&nbsp;&nbsp;&nbsp;$line </div>";
        }
        $med1 = remain_days($med);
        $med = stime("", $med);
        return "<div class=$cl title='$med'> <img src='/images/red_sq.gif' >&nbsp;&nbsp;&nbsp;ожидается через $med1 дней</div>";
    }


    $co = 0;
    $out = "";
    $v = 0;
    if ($r->onstock_spb > 0) {
        $out .= "<span title='Санкт-Петербург' style='cursor:default;'>СПБ</span>";
        $v = 1;
        $co++;
    }

    if ($r->onstock_msk > 0) {
        if ($v == 1) {
            $out .= ", ";
        }
        $out .= "<span title='Москва' style='cursor:default;'>МСК</span>";
        $v = 1;
        $co++;
    }

    if ($r->onstock_kiv > 0) {
        if ($v == 1) {
            $out .= ", ";
        }
        $out .= "<span title='Киев' style='cursor:default;'>КИЕВ</span>";
        $co++;
    }
    if ($r->onstock_ptg > 0) {
        if ($v == 1) {
            $out .= ", ";
        }
        $out .= "<span title='Пятигорск' style='cursor:default;'>ПГСК</span>";
        $co++;
    }


    if ($co == 1)
        $s = "на складе:";
    else
        $s = "на складах:";
    $out1 = "<div class=$cl> <img src='/images/green_sq.gif' >&nbsp;&nbsp;&nbsp $s  $out</div>";

    if ($mode == 3)
        $out1 = $out;
    return $out1;
}

function add_to_basket() {
    if (defined('basket_shit'))
        return;
    define('basket_shit', 1);

    echo "
<div id=amount_q>
<table><tr><td >
 <span id=modn>11</span>&nbsp &nbsp </td><td width=50>
Кол-во: </td><td>
<table cellpadding=0 cellspacing=0 border=0>
<tr><td class= am_td><input type=text id=items_amount></td><td>

<table cellpadding=0 cellspacing=0>
<tr><td class=am_td width=20 align=center><img src=/images/but_plus.png width=12 onclick='am_inc();'></tr></tr>
<tr><td class=am_td width=20 align=center><img src=/images/but_minus.png width=12 onclick='am_dec();'></tr></tr>
</table>
</td></tr></table>
</td></tr></table>
<center>
<br>
<span class=zakazbut onclick='add_item();'>OK</span> &nbsp
<span class=zakazbut onclick='cancel_add_item();'>Отмена</span>

</center>
</div>
<br><br>
";
}

function popup_messages() {
    if (defined('popup_shit'))
        return;
    define('popup_shit', 1);
    echo "
<div id=mes_container>
<div id=mes_header onclick='hide_popup();'>
Сообщение
</div>
<div id=mes_body>

body
</div>
</div>
<div id=mes_backgr> </div>
";
//---------------------- popmes 1 --
    echo "
<div id=popmes1 style='display:none;'>

Для обсуждения скидки <br>
сообщите нам свой телефонный номер<br>
<input id='phone' type=text >
<br><br>
<table width=100%>
<td width=50% align=center>
<span class=orangebut onclick='get_discount_form()'>Отправить</span>
</td><td align=center>
<span class=orangebut onclick='hide_popup()'>Закрыть</span>
</td></table>

<div id=form_out> </div>

</div>
";
}

function basket() {

    if (defined('basket_shit1'))
        return;
    define('basket_shit1', 1);

    echo "
<div id=slided>
<br>
<div id=basket_container>
<div id=basket>
<center><span class=bask_head style='font-size: 15px;'>Корзина</span></center><br>
<div id=resba> </div>
<br><center>
<span class=bask_head style='font-size: 15px; cursor: pointer;' onclick='window.location=\"/oformit_zakaz.php\"' >Оформить</span>
&nbsp &nbsp
<span class=bask_head style='font-size: 15px; cursor: pointer;' onclick='clean_basket();' >Очистить</span> </center>
</div></div></div>

<div id=basket_small onclick='ts()'>
<table width=100%><tr><td width=40><img src='/images/cart2.png' width=30 ></td><td><div id=bask_sm_text> </div></td></tr></table>
</div>
";
}

function show_series_open_hmi_emt() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_eMT600.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Панели оператора Weintek серия Open HMI eMT600</$h>$a2

<br><center><div class=series_descr>Панели оператора Weintek серии eMT600 появились в 2012 году. Они являются продолжением серии MT600. На операторских панелях Weintek серии eMT600 установлена операционная система Windows CE 6.0</div></center><br>

<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT607A");
    echo "</td><td align=center valign=top>";
    echo show_panel1("eMT610P");   // end row
    echo "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT612A");
    echo "</td><td align=center valign=top>";
    echo show_panel1("eMT615A");   // end row
    echo "</td></tr>

</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_open_hmi() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT600.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Панели оператора Weintek серия Open HMI MT600</$h>$a2

<br><center><div class=series_descr>Сенсорные панели оператора Weintek серии MT600 - это, по сути, панельные компьютеры под управлением Windows CE 5.0. При создании проектов разработчику предоставляются все возможности операционной системы.
   </div></center><br>

   <center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT607i");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT610i");   // end row
    echo "</td></tr>
</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_xe() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT8000XE.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Панели оператора Weintek серия MT8000XE</$h>$a2

<br><center><div class=series_descr>Сенсорные панели оператора серии MT8000XE появились в 2013 году. Отличительными особенностями этой серии операторских панелей Weintek являются быстрый процессор Cortex A8, с тактовой частотой 1 ГГц, графический сопроцессор, ускоряющий до 15 раз загрузку страниц, насыщенных графикой, новый дизайн (более светлые цвета и компактный корпус), гальваническая изоляция всех портов, а также влагозащитное покрытие платы. С 2016 года во все панели серии XE добавлена поддержка протокола <a href='/mqtt/'>MQTT</a>.
  </div></center><br>

  <center><table width=90%>
<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8090XE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8092XE") .
    "</td></tr>


<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8150XE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8121XE") .
    "</td></tr>


</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_mTV() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/mTV-100.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>


$a1<$h class=series_name>Интерфейс Machine-TV Weintek серия mTV</$h>$a2

<br><center><div class=series_descr>Интерфейс Machine-TV серии mTV появился в 2013 году. Компактный mTV-интерфейс дает возможность использовать в качестве дисплея телевизоры различных размеров или мониторы с HDMI интерфейсом, расширяя возможности традиционной архитектуры HMI.
  </div></center><br>

<center><table width=90%>

<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("mTV-100");
    echo "</td><td align=center valign=top>&nbsp;</td></tr>

</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function h() {
    $var_array = explode("/", $_SERVER['REQUEST_URI']);

    $levels = count($var_array);
    $end_page = $levels - 1;

    if (($end_page == 2) AND ( strlen($var_array[$end_page]) > 1)) {
        $H = 'h1';
    } else {
        $H = 'h2';
    };
    return $H;
}

function show_series_cloud_hmi() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/CloudHMI.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Cерия Cloud HMI — облачный интерфейс Weintek</$h>$a2

<br><center><div class=series_descr>Серия Cloud HMI — новинка 2014 года и результат 18-летней работы компании Weintek в области автоматизации управления производственными процессами. Инновационные технологии и оригинальные идеи Weintek выводят функциональность, гибкость и мобильность управления производством на качественно новый уровень. <br><br>С 2016 года все интерфейсы серии cMT поддерживают протокол <a href='/mqtt/'>MQTT</a>.
   </div></center><br>

   <center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("cMT-SVR-100");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT-iV5");   // end row
    echo "</td></tr>


<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("cMT-iPC15");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT3151");   // end row
    echo "</td></tr>
</table>
</center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_ie() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT8000iE.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Панели оператора Weintek серия MT8000iE</$h>$a2

<br><center><div class=series_descr>Сенсорные панели оператора Weintek серии MT8000iE появились в 2013 году. Их отличительными особенностями являются быстрый процессор Cortex A8, графический сопроцессор, ускоряющий до десяти раз загрузку страниц, насыщенных графикой, новый дизайн (более светлые цвета и компактный корпус), гальваническая изоляция всех портов, влагозащитное покрытие платы. Операторские панели этой серии не имеют порта USB slave (за исключением MT6070iE), поэтому загрузка проекта с ПК возможна только через Ethernet. У нас вы можете купить панели оператора серии MT8000iE, которые мы поставляем напрямую от производителя.

  </div></center><br>

  <center><table width=90%>



<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8050iE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT6070iE") . // end row
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT6071iE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8070iE") .
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8071iE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8073iE") .
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8070iER") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8100iE") .
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8101iE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8102iE") .
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8103iE") .
    "</td><td align=center valign=top>&nbsp;</td></tr>

</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_emt() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_eMT3000.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>";

    echo "$a1<$h class=series_name>Панели оператора Weintek серия eMT3000</$h>$a2

<br><center><div class=series_descr>Панели оператора Weintek серии eMT3000 появились в 2012 году. Отличительными особенностями этой серии по сравнению с сериями MT6000i и eMT8000i является более быстрый процессор, увеличенный объем ОЗУ и флэш-памяти, алюминиевый корпус, интерфейс CAN. Операторская панель Weintek eMT3070A имеет расширенный диапазон рабочих температур (от -20&#8451;). Также панели оператора этой серии программируется более новым ПО EasyBuilder Pro.</div></center><br>

<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT3070A");
    echo "</td><td align=center valign=top>";
    echo show_panel1("eMT3070B");   // end row
    echo "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT3105P");
    echo "</td><td align=center valign=top>";
    echo show_panel1("eMT3120A");   // end row
    echo "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT3150A");
    echo "</td> <td> </td>
</tr></table></center>";


    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_8000() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT8000i.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>";

    echo "$a1<$h class=series_name>Панели оператора Weintek серия MT8000i</$h>$a2

<br><center><div class=series_descr>Панели оператора Weintek серии MT8000i появились в 2009 году и быстро приобрели широкую популярность благодаря отличному соотношению цена/качество, а также удобству загрузки проекта с ПК по USB кабелю. Отличительной особенностью операторских панелей Weintek серии MT8000i был впервые в мире примененный на панелях оператора широкоугольный дисплей. В настоящее время, переняв успешный опыт Weintek, большинство производителей, у которых можно купить панели оператора, также предлагают широкоугольные дисплеи.</div></center><br>

<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT8050i");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT8100i");   // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT8070iH");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT8104iH");  // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT8104XH");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT8150X");  // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT8121X");
    echo "</td> <td> </td>
</tr></table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_6000() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT6000i.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>";

    echo "$a1<$h class=series_name>Панели оператора Weintek cерия MT6000i </$h>$a2

<br><center><div class=series_descr>Панели оператора Weintek серии MT6000i появились в 2009 году и сразу же стали очень популярны во всем мире благодаря отличному соотношению цена/качество, а также удобству загрузки проекта с ПК по USB кабелю. Отличительной особенностью операторских панелей Weintek серии MT6000i был впервые в мире примененный на панелях оператора широкоугольный дисплей. В настоящее время, следуя успешному опыту Weintek, большинство производителей, у которых можно купить панели оператора, также предлагают широкоугольные дисплеи.</div></center><br>

<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT6050i");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT6100i");
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT6070iH");
    echo "</td> <td> </td>
</tr></table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_ifc_wide($num) {
    $out = "<table><tr><tr>";
    $out .= show_ifc($num);

    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysql_query($sql) or die(mysql_error());

    $r = mysql_fetch_object($res);

    $out .= "</td><td>";

    $out .= show_pc_variants($num);

    $out .= "</td></tr></table>";

    return $out;
}

//------------------------------------------------- function show ifc-----------------------------------------
function show_ifc($num) {
    $im = "/images";
    $altstr = "операторские панели, сенсорные панели, HMI, IFC, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО";

    global $root_php;
    database_connect();


    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysql_query($sql) or die(mysql_error());

    $r = mysql_fetch_object($res);


    $inter = $r->serials . "xCOM";
    if ($r->ethernet)
        $inter .= ", $r->ethernets" . "xEthernet";
    if ($r->sdcard)
        $inter .= ", SD карта";
    if ($r->usb_host)
        $inter .= ", $r->usb_hosts" . "xUSB ";
    if ($r->pci_slot == 'есть')
        $inter .= ", PCI";
    else if ($r->pci_slot) {
        $inter .= ", " . $r->pci_slot;
    };


    $fo = "ifc";

    if (preg_match('/Aplex/i', $r->brand))
        $fo = "aplex";
    if ($r->series == "RF")
        $fo = "ifc";
    if ($r->series == "i3")
        $fo = "ifc";
    if ($r->series == "ITM")
        $fo = "ifc";
    if ($r->type == "box-pc")
        $fo = "promyshlennye-kompyutery-box-pc";
//echo strpos($r->model, "ARCH");
//echo "$fo $r->model";

    $imm = "$im/$fo/$r->model/$r->model" . "_1.png";
    if ($GLOBALS["net"] == 0) {
        if (file_exists($root_php . $imm)) {
            $imm = $imm;
        } else {
            $imm = '';
        };
    } else {

        $re = cu($root_php . $imm);
        if ($re[0] > 0) {
            $imm = $imm;
        } else {
            $imm = '';
        };
    };


    if (empty($imm) OR ( ($r->brand = "Aplex") AND ( !empty($r->pic_big)))) {
        $imm = get_big_pic($r->model);
    };
    if (empty($imm)) {


        $query_images = "SELECT * FROM `gallery` WHERE `model`='{$r->model}' ORDER BY `id` LIMIT 1;";
//var_dump($r);
        $query_images_result = mysql_query($query_images) or die("ошибка запроса022" . $query_images);
        $iimg = mysql_num_rows($query_images_result);

        $all_images = '';

        if ($iimg > 0) {

//$all_image .= '<table width="350" bfcolor="red"><tbody><tr>';
            for ($ij = 1; $ij <= $iimg; $ij++) {
                $img_row = mysql_fetch_assoc($query_images_result);


//echo $_SERVER['DOCUMENT_ROOT'];
//echo $r->type;
                if (($r->type == 'monitor')) {
                    $path = 'monitors/img/';
                    if ($GLOBALS["net"] == 0) {
                        if (file_exists($root_php . $path . $img_row[s_img_path])) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    } else {
                        $re = cu($root_php . $path . $img_row[s_img_path]);
                        if ($re[0] > 0) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    };
                } elseif (($r->type == 'panel_pc')) {
                    $path = 'panelnie-computery/ifc/img/panels/';
                    if ($GLOBALS["net"] == 0) {
                        if (file_exists($root_php . $path . $img_row[s_img_path])) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    } else {
                        $re = cu($root_php . $path . $img_row[s_img_path]);
                        if ($re[0] > 0) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    };
                } elseif ($r->type == 'hmi') {
                    $path = 'weintek/img/';
                    if ($GLOBALS["net"] == 0) {
                        if (file_exists($root_php . $path . $img_row[s_img_path])) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    } else {
                        $re = cu($root_php . $path . $img_row[s_img_path]);
                        if ($re[0] > 0) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    };
                } elseif ($r->type == 'box-pc') {
                    $path = 'images/box-pc/' . $r->model . '/';
                    if ($GLOBALS["net"] == 0) {
                        if (file_exists($root_php . $path . $img_row[s_img_path])) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    } else {
                        $re = cu($root_php . $path . $img_row[s_img_path]);
                        if ($re[0] > 0) {
                            $im1 = $path . $img_row[s_img_path];
                        };
                    };
                };

                if ($ij == 1) {

                    $ipath = $path . $img_row[img_path];
                    $i_b_path = $img_row[img_path];
//echo $ipath.'path';
                };
                if ($img_row[alt] != '') {
                    $img_alt = $img_row[alt];
                } else {
                    $img_alt = $type . ' ' . $r->model . ' Изображение №' . $ij;
                };
                $all_images .= '<td onclick="dich(&quot;' . $path . $img_row[img_path] . '&quot;,&quot;/' . $path . $img_row[img_path] . '&quot;);">
<img src="' . $path . $img_row[img_path] . '" width="50" alt="' . $img_alt . '"></td>';
            };
//$all_image .'</tr></tbody></table>';
        } else {
            $ipath = '';
        };

        if (empty($min_table)) {
            $min_table = $all_images;
        };
        $imm = $ipath;
    };
    if ($r->type == 'box-pc') {
        $alt = get_kw("alt");
    } elseif (preg_match('/Aplex/i', $r->brand)) {
        $alt = get_kw("alt");
    } else {
        $alt = "$r->diagonal\" $r->model, " . get_kw("alt");
    };
//$imm="/images/panel/$r->model/$r->model"."_2.png";
//pan_name11
//<tr height=5><td colspan=3> </td></tr>
    $pathpc = $r->type;
    if (($r->type != 'box-pc') AND ( $r->type != 'monitor')) {
        $typepc = 'Панельный компьютер';
        if ($r->series == 'APC') {
            $typepc = 'Компьютер из нержавеющей стали';
        };
        $pathpc = 'panelnie-computery/' . $fo;
    } else {
        if ($r->type == 'box-pc') {
            $typepc = 'Встраиваемый компьютер';
            $pathpc = 'promyshlennye-kompyutery-box-pc';
        } elseif ($r->type == 'monitor') {
            $typepc = 'Промышленный монитор';
        };
//$pathpc = $fo;

        if (!empty($r->pic_big)) {
            if ($r->type == 'monitor') {
                $t = 'monitors';
            } else {
                $t = $r->type;
            };
            if ($GLOBALS["net"] == 0) {
                if (file_exists($root_php . $t . '/img/' . $r->pic_big)) {
                    $imm = '/' . $t . '/img/' . $r->pic_big;
                } else {
                    $imm = '';
                };
            } else {
                $re = cu($root_php . $t . '/img/' . $r->pic_big);
                if ($re[0] > 0) {
                    $imm = '/' . $t . '/img/' . $r->pic_big;
                } else {
                    $imm = '';
                };
            };
        };


        if ($pathpc == 'monitor') {
            $pathpc = 'monitors';
        };
    };
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/sc/new.php")) {
        include($_SERVER['DOCUMENT_ROOT'] . "/sc/new.php");
    } else {
        $class = '';
    };

    if ($r->type == 'box-pc') {
        $di = '';
    } else {
        $di = "$r->diagonal\"";
    };
    $out = "
 <div class=pan_sm_cont>
 <table width=100%>
 <tr><td class=pan_price colspan=2 >
 <a href=/$pathpc/$r->model.php style=\"text-decoration: none;\"><h2 class=\"pan_price $class\" style=\"cursor:pointer;\">$di &nbsp;$typepc $r->model</h2></a>
 <div class=hc11> &nbsp;</div> </td><td></td></tr>

 <tr>
 <td width=180 class=price11 align=left height=180 valign=middle> <a href=/$pathpc/$r->model.php>
 <img src='$imm' width=130 border=0 alt='$alt'></a>";

    $onst = show_stock($r, 2);

//<tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
    //<tr><td colspan=3>  &nbsp</td></tr>

    $bw = "90px";
    $tdw = "120px";
    // right column
    //if($r->series=="ARCHMI")
    //{
    $buts = "<tr height=50><td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
 </tr height=50><tr>";
    //}
    //else $buts="<tr>";

    $action_price = action_price($r->model);

    if (!empty($action_price)) {

        $price = "<span class='prpr old'>$r->retail_price</span><div class='prpr action' style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$action_price</div>";
        $valuta = "<div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div>";
    } else {
        $price = "<div class=prpr style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</div>";
        $valuta = "<div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div>";
    };
    if ($r->retail_price == '0') {
        $price = "<div style='margin-top:8px;display: initial;
padding: 0px;float: right;
border: none;font-size:12px;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >по&nbsp;запросу</div>";
        $valuta = "";
    };

    $out .= " </td><td  class=pan_price valign=top align=left>



 <table width=100%>
 <tr><td width=140>&nbsp </td><td width=40><div class=pan_price>Цена</div></td><td width=50> $price</td>
 <td>$valuta</td></tr>


 <tr><td colspan=3 height=20> &nbsp </td></tr>
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>

 <table>
     $buts
     <td width=$tdw align=rigth>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </td>
  </tr></table>

 </td>
 </tr></table>";



    $disp = "$r->diagonal, $r->resolution, $r->sensor";

    if ($r->type == 'monitor') {

        if ($r->diagonal >= 10) {
            $interfaces = 'VGA + DVI + AUDIO';
        } elseif ($r->diagonal >= 8) {
            $interfaces = 'VGA + AUDIO';
        } else {
            $interfaces = 'VGA';
        };



        $CPU = "<tr><td class=par_name11 colspan=2>Входы</td>
 <td class=par_name11 colspan=2><span class=par_val11>" . $interfaces . "</span></td>
 </tr>";
        $interf = " <tr bgcolor=#f1f1f1><td class=par_name11 colspan=2>Выход сенсора</td><td class=par_val11 colspan=2>USB</td></tr>";
    } else {
        $CPU = "<tr><td class=par_name11 colspan=2>CPU&nbsp;&nbsp;&nbsp;$r->cpu_type</td><td class=par_name11 colspan=2>
 RAM&nbsp;&nbsp;&nbsp;" . ($r->ram / 1000) . " Гб</span></td></tr>";
        $interf = " <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3> &nbsp; $inter</td></tr>";
    };

    if ($r->type == 'box-pc') {

        if ((!empty($r->wifi))) {

            if (!preg_match('/wi.*fi/i', $r->wifi)) {
                $w = 'Wi-Fi: ';
            };
            $diagonal = "
	<td class=par_name11 width=70>Разрешение</td><td class=par_val11 width=90>$r->resolution</td>
<td class=par_name11 colspan=2>$w$r->wifi</td>"
            ;
        } else {
            $diagonal = "<td class=par_name11 width=70 >Разрешение</td><td class=par_val11 width=90 >$r->resolution</td><td class=par_name11 width=90>&nbsp;</td><td class=par_val11>&nbsp;</td>";
        };
    } else {
        $diagonal = "<td class=par_name11 width=70 >Диагональ</td><td class=par_val11 width=90 >&nbsp;&nbsp;&nbsp;$r->diagonal\"</td><td class=par_name11 width=90>Разрешение</td><td class=par_val11>$r->resolution</td>";
    };

    $out .= "<div class=bor><table width=100% cellpadding=0 cellspacing=0 border=0>
<tr bgcolor=#f1f1f1>$diagonal</tr>

 $CPU

 $interf


 </table></div>
 </div>";

    return $out;
}

//------------------------------------------------- function show panel1------------------------------------------
function show_panel1($num) {
    $im = "/images";
    $altstr = "операторские панели, сенсорные панели, HMI, Weintek, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder";
    $lts_file = $_SERVER['DOCUMENT_ROOT'] . '/sc/alts.php';

    database_connect();
    mysql_query("SET NAMES 'cp1251'");

    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysql_query($sql) or die(mysql_error());

    $r = mysql_fetch_object($res);


    $inter = $r->serial;
    if ($r->ethernets > 1) {
        $eth = '2x';
    } else {
        $eth = '';
    };
    if ($r->ethernet)
        if (empty($inter)) {
            $inter .= $eth . "Ethernet";
        } else {
            $inter .= ", " . $eth . "Ethernet";
        };
    if ($r->sdcard)
        if (empty($inter)) {
            $inter .= "SD карта";
        } else {
            $inter .= ", SD карта";
        };
    if ($r->usb_host)
        if (empty($inter)) {
            $inter .= "USB host";
        } else {
            $inter .= ", USB host";
        };
    if ($r->can_bus)
        if (empty($inter)) {
            $inter .= "CAN";
        } else {
            $inter .= ", CAN";
        };
    if ($r->wifi)
        if (empty($inter)) {
            $inter .= "Wi-Fi";
        } else {
            $inter .= ", Wi-Fi";
        };
//$im/panel/$r->pic_small
    $fo = "weintek";
    if ($r->brand == "Weintek")
        $fo = "weintek";
    if ($r->brand == "Samkoon")
        $fo = "samkoon";

    if ($r->software == "") {
        $poos = "ОС";
        $poos1 = $r->os;
    } else {
        $poos = "ПО";
        $poos1 = $r->software;
    }

    if ($r->type == "hmi")
        $type = "Панель оператора";
    if ($r->type == "panel_pc")
        $type = "Панельный компьютер";
    if ($r->type == "open_hmi")
        $type = "Панель оператора";
    if ($r->type == "cloud_hmi")
        $type = "Интерфейс";
    if ($r->type == "machine-tv-interface")
        $type = "Интерфейс Machine-TV";


    $alt = "$r->diagonal\" $r->model, " . get_kw("alt");
    if ($r->brand == "Weintek") {
        if (file_exists($lts_file)) {

            include($lts_file);
        };
    };
//$imm="$im/panel/$r->pic_small";
    $imm = get_small_pic($r->model);

//$imm="/images/panel/$r->model/$r->model"."_2.png";
//pan_name11
//<tr height=5><td colspan=3> </td></tr>
    if (file_exists("../sc/new.php")) {
        include("../sc/new.php");
    } else {
        $class = '';
    };
    if (($r->diagonal == '') or ( $r->diagonal == 0)) {
        $di = '';
    } else {
        $di = $r->diagonal . '&Prime;';
    };
    $out = "
 <div class=pan_sm_cont>
 <table width=100%>
 <tr><td class=pan_price colspan=2 ><a href=/$fo/$r->model.php style='text-decoration: none;'><h3 class='pan_price $class' style='cursor:pointer;'>$di &nbsp;$type $r->model </h3></a>
 <div class=hc11> &nbsp;</div> </td><td></td></tr>

 <tr>
 <td width=180 class=price11 align=left height=180 valign=middle> <a href=/$fo/$r->model.php>
 <img src='$imm' width=130 border=0 alt='$alt'></a>";

    $onst = show_stock($r, 2);

//<tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
    //<tr><td colspan=3>  &nbsp</td></tr>

    $bw = "90px";
    $tdw = "120px";
    // right column

    if (($r->retail_price != '0') AND ( $r->retail_price != '')) {

        $action_price = action_price($r->model);

        if (!empty($action_price)) {

            $priceb = "<td width=50> <span class='prpr old'>$r->retail_price</span><div class='prpr action' style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$action_price</div></td>
 <td><div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div></td>";
        } else {
            $priceb = "<td width=50> <div class=prpr style='font-size:12px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</div></td>
 <td><div class=val_name style='font-size:12px;'  title='Нажмите для пересчета в РУБ'>USD </div></td>";
        };
    } else {
        $priceb = "
<td width=50 colspan='2' style='display: initial;
padding: 0px;
border: none;font-size:12px;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' ><div style='margin-top:8px;'>по&nbsp;запросу</div></td>
";
    };

    $out .= " </td><td  class=pan_price valign=top align=left>

 <table><width=100%>
 <tr><td width=140>&nbsp </td><td width=40><div class=pan_price>Цена</div></td>$priceb</tr>


 <tr><td colspan=3 height=20> &nbsp </td></tr>
 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>

 <table>
 <tr height=50><td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_compare(this)'><span>В сравнение</span></div> </td>
 </tr height=50><tr>
     <td width=$tdw align=rigth>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(2, \"$r->model\")'><span>Заказ в 1 клик</span></div> </td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'><span>Получить скидку</span></div> </td>
  </tr></table>

 </td>
 </tr></table>";

    $out .= "<div class=bor><table width=100% cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=90 >Диагональ</td><td class=par_val11 width=70 >$r->diagonal\"</td>
 <td class=par_name11 width=90>Разрешение</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >Цветность</td><td class=par_val11>$r->colors</td>
 <td class=par_name11>$poos</td><td class=par_val11>$poos1</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3>$inter</td></tr>


 </table></div>
 </div>";

    return $out;
}

//------------------------------end show panel----------------------------------------------------------------
//------------------------------------------------- function show panel ------------------------------------------
function show_panel1_old($num) {
    $im = "/images";
    $altstr = "операторские панели, сенсорные панели, HMI, Weintek, интерфейс,
пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО,
EasyBuilder";


    database_connect();


    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysql_query($sql) or die(mysql_error());

    $r = mysql_fetch_object($res);


    $inter = $r->serial;
    if ($r->ethernet)
        $inter .= ", Ethernet";
    if ($r->sdcard)
        $inter .= ", SD карта";
    if ($r->usb_host)
        $inter .= ", USB host";


    echo "
 <div class=pan_sm_cont>
 <table width=300>
 <tr><td class=pan_name11 colspan=2 >$r->diagonal\" &nbsp;Панель оператора $r->model <div class=hc11> &nbsp;</div> </td><td></td></tr>
 <tr height=5><td colspan=3> </td></tr>
 <tr>
 <td width=180 class=price11 align=left> <a href=/weintek/" . $r->model . ".php><img src=$im/panel/$r->pic_small width=130 border=0 alt='$r->model, $altstr'></a>";

    //

    if ($r->onstock == 0)
        $onst = "<div class=pan_name11> <img src=$im/red_sq.gif >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
    else
        $onst = "<div class=pan_name11><img src=$im/green_sq.gif >&nbsp;&nbsp;&nbsp;есть на складе</div>";


    echo" </td><td class=pan_price valign=top align=left>

 <table><width=100%>
 <tr><td width=40>Цена</td><td width=40> <div class=prpr style='font-size:10px;' title='Нажмите для пересчета в РУБ'>$r->retail_price</div></td>
 <td><div class=val_name style='font-size:10px;'  title='Нажмите для пересчета в РУБ'>USD </div></td></tr>
 <tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> Узнать &nbsp &nbsp скидку ! </span> </td></tr>
 <tr><td colspan=3>  &nbsp</td></tr>


 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>
 <div class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>В корзину</span></div>

 </td>
 </tr></table>";

    echo "<div class=bor><table width=300 cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=70 >Диагональ</td><td class=par_val11 width=70 >$r->diagonal\"</td>
 <td class=par_name11 width=70>Разрешение</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >Цветность</td><td class=par_val11>$r->colors</td>
 <td class=par_name11>ПО</td><td class=par_val11>$r->software</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> Интерфейсы</td><td class=par_val11 colspan=3>$inter</td></tr>


 </table></div>
 </div>";
}

function temp00($name) {  // UTF8
    ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="/css/ra.css<?php echo version('/css/ra.css'); ?>" />
            <link rel="stylesheet" type="text/css" href="/css/menu4.css<?php echo version('/css/menu4.css'); ?>" />
            <link rel="stylesheet" type="text/css" href="/css/tabs.css<?php echo version('/css/tabs.css'); ?>" />
            <link rel="stylesheet" type="text/css" href="/css/button.css<?php echo version('/css/button.css'); ?>" />
            <link rel="stylesheet" type="text/css" href="/css/tango/skin.css<?php echo version('/css/tango/skin.css'); ?>" />


            <meta http-equiv=Content-Type content=text/html; charset=utf-8>
                <title>dialog demo</title>
                <link rel="stylesheet" href="/css/jquery-ui-smoothness.css<?php echo version('/css/jquery-ui-smoothness.css'); ?>">
                    <link rel="stylesheet" href="/css/jquery-ui-base.css<?php echo version('/css/jquery-ui-base.css'); ?>" />
                    <script src="/js/jquery-1.10.2.js<?php echo version('/js/jquery-1.10.2.js'); ?>"></script>
                    <script src="/js/jquery-ui.js<?php echo version('/js/jquery-ui.js'); ?>"></script>
                    <script type="text/javascript" src="/js/jquery.cookie.js<?php echo version('/js/jquery.cookie.js'); ?>"></script>
                    <script type="text/javascript" src="/js/jquery.jcarousel.js<?php echo version('/js/jquery.jcarousel.js'); ?>"></script>
                    <script type="text/javascript" src="/js/ra_scripts.js<?php echo version('/js/ra_scripts.js'); ?>"></script>
                    <!--script type="text/javascript" src="/js/s.js"></script-->
                    <script type="text/javascript" src="/js/jquery.maskedinput.js<?php echo version('/js/jquery.maskedinput.js'); ?>"></script>





                    <script src="/js/search.js<?php echo version('/js/search.js'); ?>"></script>



                    </head>
                    <body>





                        <noscript>
                            This page needs JavaScript activated to work.<br>
                                Пожалуйста, включите Javascript чтобы просмотреть эту страницу

                                <style>div { display:none; }</style>
                        </noscript>


                        <div id=body_cont >


                            <table width=100% bgcolor=white><tr><td width=300px>
                                        <img src=../images/logo.jpg style="padding-left: 10px; cursor: pointer;" onclick='window.location = "/"'>
                                    </td><td> </td></tr></table>

                                                            <?
                                                            top_menu();
                                                            usd_rate();
                                                            search();
                                                            compare();
                                                        }

//------------------------------end show panel----------------------------------------------------------------

                                                        function head($template_file, $title, $description, $keywords) {
                                                            $head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/sc/" . $template_file);


                                                            preg_match_all('/(href|src)=\"(\/.*?\.(css|js))\"/i', $head, $matches, PREG_PATTERN_ORDER);
                                                            foreach ($matches[2] as $key => $value) {
                                                                $head = str_replace($value, $value . version($value), $head);
                                                            }

                                                            $head = str_replace('[>TITLE<]', $title, $head);
                                                            $head = str_replace('[>DESCRIPTION<]', $description, $head);
                                                            $head = str_replace('[>KEYWORDS<]', $keywords, $head);

                                                            return $head;
                                                        }

                                                        function temp0($name) {
                                                            ?>
                            <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
                            <html>
                                <head>
                                    <meta http-equiv="Content-Type" content="text/html;charset=windows-1251">
                                        <meta http-equiv="Content-Language" content="ru">
                                            <title><? echo get_kw("title"); ?></title>
                                            <meta name="description" content="<? echo get_kw("descr"); ?>">
                                                <meta name="keywords" content="<? echo get_kw("kw"); ?>">

                                                    <meta name="viewport" content="width=1110" />
                                                    <link rel="stylesheet" type="text/css" href="/css/ra.css<?php echo version('/css/ra.css'); ?>" />
                                                    <link rel="stylesheet" type="text/css" href="/css/menu4.css<?php echo version('/css/menu4.css'); ?>" />
                                                    <link rel="stylesheet" type="text/css" href="/css/tabs.css<?php echo version('/css/tabs.css'); ?>" />
                                                    <link rel="stylesheet" type="text/css" href="/css/button.css<?php echo version('/css/button.css'); ?>" />
                                                    <link rel="stylesheet" type="text/css" href="/css/tango/skin.css<?php echo version('/css/tango/skin.css'); ?>" />
                                                    <link href="/lightbox/css/lightbox.css<?php echo version('/lightbox/css/lightbox.css'); ?>" rel="stylesheet" />

                                                    <link rel="stylesheet" href="/css/jquery-ui-smoothness.css<?php echo version('/css/jquery-ui-smoothness.css'); ?>">
                                                        <link rel="stylesheet" href="/css/jquery-ui-base.css<?php echo version('/css/jquery-ui-base.css'); ?>" />
                                                            <?php if ($name == 'main') { ?> <link rel="stylesheet" href="/css/main.css<?php echo version('/css/main.css'); ?>" /><?php }; ?>
                                                        <script src="/js/jquery-1.10.2.js<?php echo version('/js/jquery-1.10.2.js'); ?>"></script>
                                                        <script src="/js/jquery-ui.js<?php echo version('/js/jquery-ui.js'); ?>"></script>

                                                        <script type="text/javascript" src="/js/jquery.cookie.js<?php echo version('/js/jquery.cookie.js'); ?>"></script>
                                                        <script type="text/javascript" src="/js/jquery.jcarousel.js<?php echo version('/js/jquery.jcarousel.js'); ?>"></script>
                                                        <script src="/lightbox/js/lightbox.js<?php echo version('/lightbox/js/lightbox.js'); ?>"></script>
                                                        <script type="text/javascript" src="/js/ra_scripts.js<?php echo version('/js/ra_scripts.js'); ?>"></script>
                                                        <script type="text/javascript" src="/js/s.js<?php echo version('/js/s.js'); ?>"></script>
                                                        <script type="text/javascript" src="/js/jquery.maskedinput.js<?php echo version('/js/jquery.maskedinput.js'); ?>"></script>
                                                        <script type="text/javascript" src="/js/sha512.js<?php echo version('/js/sha512.js'); ?>"></script>





                                                        <script src="/js/search.js<?php echo version('/js/search.js'); ?>"></script>



                                                        </head>


                                                        <body>
                                                            <?php if (!preg_match('/service/i', $_SERVER['REQUEST_URI'])) {
                                                                ?>
                                                                <!-- Yandex.Metrika counter -->
                                                                <script type="text/javascript">
                                                (function (d, w, c) {
                                                    (w[c] = w[c] || []).push(function () {
                                                        try {
                                                            w.yaCounter114217 = new Ya.Metrika({
                                                                id: 114217,
                                                                clickmap: true,
                                                                trackLinks: true,
                                                                accurateTrackBounce: true,
                                                                webvisor: true,
                                                                trackHash: true
                                                            });
                                                        } catch (e) {
                                                        }
                                                    });

                                                    var n = d.getElementsByTagName("script")[0],
                                                            s = d.createElement("script"),
                                                            f = function () {
                                                                n.parentNode.insertBefore(s, n);
                                                            };
                                                    s.type = "text/javascript";
                                                    s.async = true;
                                                    s.src = "https://mc.yandex.ru/metrika/watch.js";

                                                    if (w.opera == "[object Opera]") {
                                                        d.addEventListener("DOMContentLoaded", f, false);
                                                    } else {
                                                        f();
                                                    }
                                                })(document, window, "yandex_metrika_callbacks");
                                                                </script>
                                                                <noscript><div><img src="https://mc.yandex.ru/watch/114217" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                                                                <!-- /Yandex.Metrika counter -->
                                                                <?php };
                                                            ?>
                                                            <div id=cont_head><font color=555555>Санкт-Петербург</font> (812)244-98-18 &nbsp &nbsp <font color=555555>Москва</font> (499)638-37-91 &nbsp &nbsp
                                                                <font color=555555>Киев</font> +380-44-393-58-64 &nbsp &nbsp </div>  <div id=mailh1> </div>

                                                            <noscript>
                                                                This page needs JavaScript activated to work.<br>
                                                                    Пожалуйста, включите Javascript чтобы просмотреть эту страницу

                                                                    <style>div { display:none; }</style>
                                                            </noscript>

                                                            <!--[if IE 7]>

                                                            Вы используете устаревший браузер Internet explorer 7<br>
                                                            Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
                                                            <style> div { display:none; }</style>
                                                            <![endif]-->

                                                            <!--[if IE 6]>

                                                            Вы используете устаревший браузер Internet explorer 6<br>
                                                            Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
                                                            <style> div { display:none; }</style>
                                                            <![endif]-->


                                                            <div id=mes_backgr> </div>
                                                            <div id=body_cont >

                                                                <table width=100% bgcolor=white><tr height=93><td width=300px>
                                                                            <img src=/images/logo.jpg style="padding-left: 10px; cursor: pointer;" onclick='window.location="/"'>
                                                                    </td><td> </td></tr></table>





                                                            <?
                                                            top_menu();
                                                            usd_rate();
                                                            search();
                                                            compare();
                                                            backup_call();
                                                        }

//<span class=zakazbut onclick='go_to_comparison()'>Сравнить</span> <span class=zakazbut onclick='hide_compare()'>Закрыть</span>

                                                        function compare() {
                                                            echo "<div id=compare >
<br>
<span id=compare_h>Ваш список сравнения:</span>
<br><br>
<div id=compare_body> </div>


<div id=compare_message> </div>
<br><br>
<span class='zakazbut com-block' onclick='window.location=\"/comparison.php\"'>Сравнить</span> <span class=zakazbut onclick='hide_compare()'>Закрыть</span>


</div>";
                                                        }

//<span id=backup_call_h> </span>


                                                        function backup_call() {
                                                            echo "<div id=backup_call >
<div id=backup_call_h> </div>

<div id=backup_call_body> </div>
<center>
+<input type=text class=phoneNumber name=phone>

<div id=backup_call_message> </div>
<br><br><center>
<span class=zakazbut onclick='backup_call_go()'>Звонок</span>  &nbsp &nbsp<span class=zakazbut onclick='backup_call_hide()'>Закрыть</span></center>


</div>

";
                                                        }

                                                        function search() {
//<span class=searchbut onclick='gotosearch()'> &nbsp Искать</span>
                                                            echo "
<div id=search>
<input type=text id=tete value='поиск...' onclick='se_click()'>
<img src='/images/search_btn.png' id=se_im onclick='gotosearch()'>
<div id=sho> </div>
</div>
";
                                                        }

                                                        function top_menu() {
                                                            $top_menu = "<div class=menu_top_cont>
<div class=menu_top>
<div class='top-menu-block'><a href='/about.php'>О КОМПАНИИ&nbsp;</a>
<ul>
<a href='/news.php'><li>Новости</li></a>
<a href='/articles.php'><li>Статьи</li></a>
</ul>
</div>|
<a href='/contacts.php'> КОНТАКТЫ </a>|
<a href='/advanced_search.php' title='Подбор оборудования по параметрам'> ПОДБОР </a> |
<a href='/comparison.php'> СРАВНЕНИЕ </a>|
<a href='http://www.rusavtomatika.com/forum/'> ФОРУМ </a> |
<a href='/support.php'> ТЕХ.ПОДДЕРЖКА </a> |
<a href='/download.php'>СКАЧАТЬ</a>
</div>

<a href='/antikrizisnoe-predlozhenie.php' style='color: rgb(228, 14, 19);'><div id='rof' style='
display:none;
position: absolute;
width: 300px;
margin-left: 283px;
font-size: 15px;
margin-top: 17px;
overflow: hidden;
color: rgb(228, 14, 19);
  font-family: \"MS Sans Serif\";
  font-weight: bold;
'><div class='flying' style='position:relative;right:0px;float:left;white-space: nowrap;'>Акция !  Weintek по сниженным ценам</div></div></a>";

                                                            $top_menu .= "
<script>

function run(ud) {
$('.flying').eq(ud).css('right','-300px');
  $('.flying').eq(ud).animate({
    right: '300px'
  }, {
    duration: 15000,
    specialEasing: {
      right: 'linear'
    }
  });

setTimeout(function() {

run(ud);
}, 22500);
}






$(document).ready(function(){
$('#rof').show();
var ud = 0;
$('.flying').clone().css({'right':'-300px','margin-top':'-18px'}).appendTo('#rof');
setTimeout(function() {

  $('.flying').eq(ud).animate({
    right: '300px'
  }, {
    duration: 7500,
    specialEasing: {
      right: 'linear'
    }
  });

setTimeout(function() {

run('0');
}, 15020);
}, 600);

setTimeout(function() {
run('1');
}, 4350);

});

</script>";

                                                            $top_menu .= "</div>
";

                                                            echo $top_menu;
                                                        }

                                                        function usd_rate() {

                                                            $ro = $_SERVER['DOCUMENT_ROOT'] . '/';
                                                            $current_usd_rate = file_get_contents($GLOBALS["usd_rate_file"]);
                                                            $current_eur_rate = file_get_contents($ro . 'eurrate.txt');
                                                            $current_eur_rate = str_replace(',', '.', $current_eur_rate);
                                                            echo "<div id=usdrate title='Курс ЦБ РФ на сегодня' > 1 USD = <span id=curusd >$current_usd_rate</span><span id=cureur style=display:none >$current_eur_rate</span> РУБ</div><input id ='valuta' style='display:none;' value='USD'>";
                                                        }

                                                        function euro_usd_rate() {

                                                            $ro = $_SERVER['DOCUMENT_ROOT'] . '/';
                                                            $current_usd_rate = file_get_contents($GLOBALS["usd_rate_file"]);
                                                            $current_eur_rate = file_get_contents($ro . 'eurrate.txt');
                                                            $current_eur_rate = str_replace(',', '.', $current_eur_rate);
                                                            echo "<div id=usdrate title='Курс ЦБ РФ на сегодня' > 1 EUR = <span id=curusd style=display:none>$current_usd_rate</span><span id=cureur >$current_eur_rate</span> РУБ</div><input id ='valuta' style='display:none;' value='EUR'>";
                                                        }

//style="padding-left: 10px;"
//<li class='active'><a href='index.html'><span>HMI WEINTEK</span></a></li>
                                                        function top_buttons() {

//$m1=" <div class=mytabhover><table ><tr><td  class=my_menuitem_sm >Панели оператора</td></tr><tr><td class=my_menuitem>WEINTEK</td></tr></table></div> ";
                                                            $m1 = " <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/weintek\"'><font size=1px>Панели оператора</font><br>WEINTEK</span></center></div> ";
                                                            $m2 = " <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/samkoon\"'><font size=1px>Панели оператора</font><br>SAMKOON</span></center></div> ";
                                                            $m3 = " <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/panelnie-computery/ifc\"'><font size=1px>Panel&nbsp;PC,&nbsp;мониторы</font><br>IFC</span></center></div> ";
                                                            $m4 = " <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/panelnie-computery/aplex\"'><font size=1px>Панельные&nbsp;компьютеры</font><br>APLEX</span></center></div> ";

                                                            $m6 = " <div class=menu_item_cont><center><span class=my_menuitem onclick='window.location=\"\/ewon\"'><font size=1px>VPN-роутеры</font><br>eWON</span></center></div> ";

                                                            $m7 = " <div class=menu_item_cont style=''><center><span class=my_menuitem onclick='window.location=\"\/plc\/yottacontrol/\"'><font size=1px>PLC</font><br>YOTTACONTROL</span></center></div> ";

                                                            $m8 = " <div class=menu_item_cont style=''><center><span class=my_menuitem onclick='window.location=\"\/bloki-pitaniya\/faraday/\"'><font size=1px>Блоки&nbsp;питания</font><br>FARADAY</span></center></div> ";

//$m9=" <div class=menu_item_cont style=''><center><span class=my_menuitem onclick='window.location=\"\/HMI-android.php\"'><font size=1px>Панель&nbsp;оператора</font><br>ANDROID</span></center></div> ";
                                                            $m9 = " <div class=menu_item_cont style=''><center><span class=my_menuitem onclick='window.location=\"\/modules\/EBM-A.php\"'><font size=1px>Модуль&nbsp;ввода-вывода</font><br>EBM-A</span></center></div> ";
// s
//<a href='/weintek/'>  </a>

                                                            echo "

<div id='cssmenut'>

<ul style='min-width: 1050px;'>
   <li class='has-sub'>  $m1
     <ul style=' '>
		<li><a href='/mqtt/'><span>MQTT</span></a></li>
		<li><a href='/easyaccess20.php'><span>EasyAccess 2.0</span></a></li>
	    <li class='has-sub'><a href='/weintek/series_MT8000iE.php'><span>Серия MT8000iE</span></a>
            <ul>
			   <li><a href='/weintek/MT8050iE.php'><span class=my_span>4.3&#8243;</span><span> MT8050iE</span></a></li>
               <li><a href='/weintek/MT6070iE.php'><span class=my_span>7&#8243;</span><span> MT6070iE</span></a></li>
			   <li><a href='/weintek/MT6071iE.php'><span class=my_span>7&#8243;</span><span> MT6071iE</span></a></li>
               <li><a href='/weintek/MT8070iE.php'><span class=my_span>7&#8243;</span><span> MT8070iE</span></a></li>
			   <li><a href='/weintek/MT8071iE.php'><span class=my_span>7&#8243;</span><span> MT8071iE</span></a></li>
               <li><a href='/weintek/MT8073iE.php'><span class=my_span>7&#8243;</span><span class=\"new\"> MT8073iE</span></a></li>
			   <li><a href='/weintek/MT8070iER.php'><span class=my_span>7&#8243;</span><span> MT8070iER</span></a></li>
               <li><a href='/weintek/MT8100iE.php'><span class=my_span>10.1&#8243;</span><span> MT8100iE</span></a></li>
               <li><a href='/weintek/MT8101iE.php'><span class=my_span>10.1&#8243;</span><span class=\"new\"> MT8101iE</span></a></li>
			   <li><a href='/weintek/MT8102iE.php'><span class=my_span>10.1&#8243;</span><span class=\"new\"> MT8102iE</span></a></li>
			   <li><a href='/weintek/MT8103iE.php'><span class=my_span>10.1&#8243;</span><span class=\"new\"> MT8103iE</span></a></li>
            </ul>
         </li>

		  <li class='has-sub'><a href='/weintek/series_MT8000XE.php'><span>Серия MT8000XE</span></a>
            <ul>
			   <li><a href='/weintek/MT8090XE.php'><span class=my_span>9.7&#8243;</span><span class=\"new\"> MT8090XE</span></a></li>
			   <li><a href='/weintek/MT8092XE.php'><span class=my_span>9.7&#8243;</span><span class=\"new\"> MT8092XE</span></a></li>
			   <li><a href='/weintek/MT8121XE.php'><span class=my_span>12.1&#8243;</span><span> MT8121XE</span></a></li>
               <li class='last'><a href='/weintek/MT8150XE.php'><span class=my_span>15&#8243;</span><span> MT8150XE</span></a></li>
            </ul>
         </li>

         <li class='has-sub'><a href='/weintek/series_MT6000i.php'><span>Серия МТ6000i</span></a>
            <ul>
               <li><a href='/weintek/MT6050i.php'><span class=my_span>4.3&#8243;</span><span> MT6050i</span></a></li>
               <li><a href='/weintek/MT6070iH.php'><span class=my_span>7&#8243;</span><span> MT6070iH</span></a></li>
               <li class='last'><a href='/weintek/MT6100i.php'><span class=my_span>10&#8243;</span><span> MT6100i</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='/weintek/series_MT8000i.php'><span>Серия MT8000i</span></a>
            <ul>
               <li><a href='/weintek/MT8050i.php'><span class=my_span>4.3&#8243;</span><span> MT8050i</span></a></li>
               <li><a href='/weintek/MT8070iH.php'><span class=my_span>7&#8243;</span><span> MT8070iH</span></a></li>
               <li><a href='/weintek/MT8100i.php'><span class=my_span>10&#8243;</span><span> MT8100i</span></a></li>
               <li><a href='/weintek/MT8104iH.php'><span class=my_span>10.4&#8243;</span><span> MT8104iH</span></a></li>
               <li><a href='/weintek/MT8104XH.php'><span class=my_span>10.4&#8243;</span><span> MT8104XH</span></a></li>
               <li><a href='/weintek/MT8121X.php'><span class=my_span>12.1&#8243;</span><span> MT8121X</span></a></li>
               <li class='last'><a href='/weintek/MT8150X.php'><span class=my_span>15&#8243;</span><span> MT8150X</span></a></li>
            </ul>

         </li>
		 <li class='has-sub'><a href='/weintek/series_eMT3000.php'><span>Серия eMT3000</span></a>
            <ul>
				<li><a href='/weintek/eMT3070A.php'><span class=my_span>7&#8243;</span><span> eMT3070A</span></a></li>
               <li><a href='/weintek/eMT3070B.php'><span class=my_span>7&#8243;</span><span class=\"new\"> eMT3070B</span></a></li>
               <li><a href='/weintek/eMT3105P.php'><span class=my_span>10&#8243;</span><span> eMT3105P</span></a></li>
               <li><a href='/weintek/eMT3120A.php'><span class=my_span>12&#8243;</span><span> eMT3120A</span></a></li>
               <li class='last'><a href='/weintek/eMT3150A.php'><span class=my_span>15&#8243;</span><span> eMT3150A</span></a></li>
            </ul>
         </li>



		  <li class='has-sub'><a href='/weintek/series_MT600.php'><span>Серия MT600(Open HMI)</span></a>
            <ul>
               <li><a href='/weintek/MT607i.php'><span class=my_span>7&#8243;</span><span> MT607i</span></a></li>
               <li class='last'><a href='/weintek/MT610i.php'><span class=my_span>10&#8243;</span><span> MT610i</span></a></li>

            </ul>
         </li>

		 <li class='has-sub'><a href='/weintek/series_eMT600.php'><span>Серия eMT600(Open HMI)</span></a>
            <ul>
               <li><a href='/weintek/eMT607A.php'><span class=my_span>7&#8243;</span><span> eMT607A</span></a></li>
               <li><a href='/weintek/eMT610P.php'><span class=my_span>10&#8243;</span><span> eMT610P</span></a></li>
               <li><a href='/weintek/eMT612A.php'><span class=my_span>12&#8243;</span><span> eMT612A</span></a></li>
               <li class='last'><a href='/weintek/eMT615A.php'><span class=my_span>15&#8243;</span><span> eMT615A</span></a></li>
            </ul>
         </li>

		  <li class='has-sub'><a href='/weintek/mTV-100.php'><span>Серия mTV</span></a>
            <ul>

               <li class='last'><a href='/weintek/mTV-100.php'><span class=my_span> </span><span>mTV-100</span></a></li>
            </ul>
         </li>
		 <li class='has-sub'><a href='/weintek/CloudHMI.php'><span>Серия Cloud HMI</span></a>
            <ul>

               <li class='last'><a href='/weintek/cMT-SVR-100.php'><span class=my_span> </span><span> cMT-SVR-100</span></a></li>
			   <li class='last'><a href='/weintek/cMT-iV5.php'><span class=my_span>9.7&#8243;</span><span> cMT-iV5</span></a></li>
               <li class='last'><a href='/weintek/cMT-iPC15.php'><span class=my_span>15&#8243;</span><span class=\"new\"> cMT-iPC15</span></a></li>
			   <li class='last'><a href='/weintek/cMT3151.php'><span class=my_span>15&#8243;</span><span class=\"new\"> cMT3151</span></a></li>
            </ul>
         </li>
      </ul>

   </li>
   <li class='has-sub' >$m2
      <ul style='  width: 159px;'>
               <li><a href='/samkoon/SK-035AE.php'><span class=my_span>3.5&#8243;</span><span> SK-035AE</span></a></li>
               <li><a href='/samkoon/SK-043AE.php'><span class=my_span>4.3&#8243;</span><span> SK-043AE</span></a></li>
               <li><a href='/samkoon/SK-043AEB.php'><span class=my_span>4.3&#8243;</span><span> SK-043AEB</span></a></li>
               <li><a href='/samkoon/SK-043ASB.php'><span class=my_span>4.3&#8243;</span><span> SK-043ASB</span></a></li>
               <li><a href='/samkoon/SK-050AE.php'><span class=my_span>5&#8243;</span><span> SK-050AE</span></a></li>
               <li><a href='/samkoon/SK-050AS.php'><span class=my_span>5&#8243;</span><span> SK-050AS</span></a></li>
               <li><a href='/samkoon/SK-070BE.php'><span class=my_span>7&#8243;</span><span> SK-070BE</span></a></li>
               <li><a href='/samkoon/SK-070BS.php'><span class=my_span>7&#8243;</span><span> SK-070BS</span></a></li>
               <li><a href='/samkoon/SK-102AE.php'><span class=my_span>10&#8243;</span><span> SK-102AE</span></a></li>
               <li class='last'><a href='/samkoon/SK-102AS.php'><span class=my_span>10\" </span><span> SK-102AS</span></a></li>
      </ul>
   </li>
   <li class='has-sub'>$m3
           <ul>
		       <li class='has-sub'><a href='/panelnie-computery/ifc/RF.php'>Серия RF ( ATOM D525 )</a>
			   <ul>
               <li><a href='/panelnie-computery/ifc/IFC-608RF.php'><span class=my_span>8&#8243;</span><span> IFC-608RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-610RF.php'><span class=my_span>10&#8243;</span><span> IFC-610RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-612RF.php'><span class=my_span>12&#8243;</span><span> IFC-612RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-615RF.php'><span class=my_span>15&#8243;</span><span> IFC-615RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-617RF.php'><span class=my_span>17&#8243;</span><span> IFC-617RF</span></a></li>
               <li><a href='/panelnie-computery/ifc/IFC-619RF.php'><span class=my_span>19&#8243;</span><span> IFC-619RF</span></a></li>
               <li class='last'><a href='/panelnie-computery/ifc/IFC-622RF.php'><span class=my_span>22&#8243;</span><span> IFC-622RF</span></a></li>
			   </ul>
			   </li>

			   <li class='has-sub'><a href='/panelnie-computery/ifc/i3.php'>Серия i3 ( Intel CORE i3 )</a>
			   <ul>
			   <li><a href='/panelnie-computery/ifc/IFC-610i3.php'><span class=my_span>10.4&#8243;</span><span> IFC-610i3</span></a></li>
			   <li><a href='/panelnie-computery/ifc/IFC-612i3.php'><span class=my_span>12.1&#8243;</span><span> IFC-612i3</span></a></li>
			   <li><a href='/panelnie-computery/ifc/IFC-615i3.php'><span class=my_span>15&#8243;</span><span> IFC-615i3</span></a></li>
			   <li><a href='/panelnie-computery/ifc/IFC-617i3.php'><span class=my_span>17&#8243;</span><span> IFC-617i3</span></a></li>
			   <li><a href='/panelnie-computery/ifc/IFC-618i3.php'><span class=my_span>18.5&#8243;</span><span> IFC-618i3</span></a></li>
			   <li><a href='/panelnie-computery/ifc/IFC-619i3.php'><span class=my_span>19&#8243;</span><span> IFC-619i3</span></a></li>
			   <li><a href='/panelnie-computery/ifc/IFC-622i3.php'><span class=my_span>22&#8243;</span><span> IFC-622i3</span></a></li>
			   </ul>
			   </li>

			    <li class='has-sub'><a href='/promyshlennye-kompyutery-box-pc/'>Серия BOX-PC</a>
			   <ul>
			   <li><a href='/promyshlennye-kompyutery-box-pc/IFC-BOX5700.php'><span class=my_span></span><span class=\"new\"> IFC-BOX5700</span></a></li>
			   <li><a href='/promyshlennye-kompyutery-box-pc/IFC-BOX5500.php'><span class=my_span></span><span class=\"new\"> IFC-BOX5500</span></a></li>
			   <li><a href='/promyshlennye-kompyutery-box-pc/IFC-BOX5300.php'><span class=my_span></span><span class=\"new\"> IFC-BOX5300</span></a></li>
			   <li><a href='/promyshlennye-kompyutery-box-pc/IFC-BOX4000.php'><span class=my_span></span><span class=\"new\"> IFC-BOX4000</span></a></li>
			   <li><a href='/promyshlennye-kompyutery-box-pc/IFC-MBOX2800.php'><span class=my_span></span><span> IFC-MBOX2800</span></a></li>
			   <li><a href='/promyshlennye-kompyutery-box-pc/IFC-BOX2800.php'><span class=my_span></span><span> IFC-BOX2800</span></a></li>
			   <li><a href='/promyshlennye-kompyutery-box-pc/IFC-BOX2600.php'><span class=my_span></span><span> IFC-BOX2600</span></a></li>

			   </ul>
			   </li>
			   <li class='has-sub'><a href='/monitors/'>Мониторы</a>
			   <ul>
			   <li><a href='/monitors/IFC-M057.php'><span class=my_span>5.7&#8243;</span><span> IFC-M057</span></a></li>
			   <li><a href='/monitors/IFC-M080.php'><span class=my_span>8&#8243;</span><span> IFC-M080</span></a></li>
			   <li><a href='/monitors/IFC-M104.php'><span class=my_span>10.4&#8243;</span><span> IFC-M104</span></a></li>
			   <li><a href='/monitors/IFC-M121.php'><span class=my_span>12.1&#8243;</span><span> IFC-M121</span></a></li>
			   <li><a href='/monitors/IFC-M150.php'><span class=my_span>15&#8243;</span><span> IFC-M150</span></a></li>
			   <li><a href='/monitors/IFC-M170.php'><span class=my_span>17&#8243;</span><span> IFC-M170</span></a></li>
			   <li><a href='/monitors/IFC-M190.php'><span class=my_span>19&#8243;</span><span> IFC-M190</span></a></li>
			   <li><a href='/monitors/IFC-M220.php'><span class=my_span>22&#8243;</span><span> IFC-M220</span></a></li>

			   </ul>
			   </li>
            </ul>

   </li>

     <li class='has-sub'>$m4
           <ul style='    width: 245px;'>
				<li class='has-sub'><a href='/panelnie-computery/aplex/ARCHMI-707P.php'><span class=my_span>7&#8243;</span><span> ARCHMI-707(P)</span></a>
				<ul style='  width: 175px;'>
               <li><a href='/panelnie-computery/aplex/ARCHMI-707.php'><span class=my_span>7&#8243;</span><span> ARCHMI-707</span></a></li>
               <li><a href='/panelnie-computery/aplex/ARCHMI-707P.php'><span class=my_span>7&#8243;</span><span> ARCHMI-707P</span></a></li>
				</ul>
				</li>
				<li class='has-sub'><a href='/panelnie-computery/aplex/ARCHMI-710P.php'><span class=my_span>10.1&#8243;</span><span> ARCHMI-710(P)</span></a>
				<ul style='  width: 190px;'>
				<li><a href='/panelnie-computery/aplex/ARCHMI-710.php'><span class=my_span>10.1&#8243;</span><span> ARCHMI-710</span></a></li>
 				<li><a href='/panelnie-computery/aplex/ARCHMI-710P.php'><span class=my_span>10.1&#8243;</span><span> ARCHMI-710P</span></a></li>
				</ul>
				</li>
				<li class='has-sub'><a href='/panelnie-computery/aplex/ARCHMI-712P.php'><span class=my_span>12.1&#8243;</span><span> ARCHMI-712(P)</span></a>
				<ul style='  width: 190px;'>
				<li><a href='/panelnie-computery/aplex/ARCHMI-712.php'><span class=my_span>12.1&#8243;</span> ARCHMI-712</span></a></li>
 				<li><a href='/panelnie-computery/aplex/ARCHMI-712P.php'><span class=my_span>12.1&#8243;</span> ARCHMI-712P</span></a></li>
				</ul>
				</li>


				<li class='has-sub'><a href='/panelnie-computery/aplex/ARCHMI-715P.php'><span class=my_span>15&#8243;</span><span> ARCHMI-715(P)</span></a>
				<ul style='  width: 190px;'>
				<li><a href='/panelnie-computery/aplex/ARCHMI-715.php'><span class=my_span>15&#8243;</span> ARCHMI-715</span></a></li>
 				<li><a href='/panelnie-computery/aplex/ARCHMI-715P.php'><span class=my_span>15&#8243;</span> ARCHMI-715P</span></a></li>
				</ul>
				</li>
				<li class='has-sub'><a href='/panelnie-computery/aplex/ARCHMI-716P.php'><span class=my_span>15.6&#8243;</span><span class=\"new\"> ARCHMI-716(P)</span></a>
				<ul style='  width: 190px;'>
               <li><a href='/panelnie-computery/aplex/ARCHMI-716.php'><span class=my_span>15.6&#8243;</span><span class=\"new\"> ARCHMI-716</span></a></li>
               <li><a href='/panelnie-computery/aplex/ARCHMI-716P.php'><span class=my_span>15.6&#8243;</span><span class=\"new\"> ARCHMI-716P</span></a></li>
				</ul>
				</li>
				<li class='has-sub'><a href='/panelnie-computery/aplex/ARCHMI-717P.php'><span class=my_span>17&#8243;</span><span class=\"new\"> ARCHMI-717(P)</span></a>
				<ul style='  width: 190px;'>
				<li><a href='/panelnie-computery/aplex/ARCHMI-717.php'><span class=my_span>17&#8243;</span><span class=\"new\"> ARCHMI-717</span></a></li>
 				<li><a href='/panelnie-computery/aplex/ARCHMI-717P.php'><span class=my_span>17&#8243;</span><span class=\"new\"> ARCHMI-717P</span></a></li>
				</ul>
				</li>
				<li class='has-sub'><a href='/panelnie-computery/aplex/ARCHMI-718P.php'><span class=my_span>18.5&#8243;</span><span class=\"new\"> ARCHMI-718(P)</span></a>
				<ul style='  width: 190px;'>
				<li><a href='/panelnie-computery/aplex/ARCHMI-718.php'><span class=my_span>18.5&#8243;</span><span class=\"new\"> ARCHMI-718</span></a></li>
 				<li><a href='/panelnie-computery/aplex/ARCHMI-718P.php'><span class=my_span>18.5&#8243;</span><span class=\"new\"> ARCHMI-718P</span></a></li>
				</ul>
				</li>
				<li class='has-sub'><a href='/panelnie-computery/aplex/ARCHMI-721P.php'><span class=my_span>21.5&#8243;</span><span class=\"new\"> ARCHMI-721(P)</span></a>
				<ul style='  width: 190px;'>
				<li><a href='/panelnie-computery/aplex/ARCHMI-721.php'><span class=my_span>21.5&#8243;</span><span class=\"new\"> ARCHMI-721</span></a></li>
 				<li><a href='/panelnie-computery/aplex/ARCHMI-721P.php'><span class=my_span>21.5&#8243;</span><span class=\"new\"> ARCHMI-721P</span></a></li>
				</ul>
				</li>

				<li class='has-sub'><a href='/panelnie-computery/aplex/APC-3593P.php'><span class=my_span>15&#8243;</span><span class=\"new\">APC-3593P (full IP65)</span></a>
				</li>

				<li class='has-sub'><a href='/panelnie-computery/aplex/APC-3597B.php'><span class=my_span>15&#8243;</span><span class=\"new\">APC-3597B (full IP65)</span></a>
				</li>

			</ul>

    </li>


     <li class='has-sub'>$m6
           <ul style='width: 120px;
  margin-left: -51px;'>
			<li><a href='/ewon/COSY131.php'><span class=my_span></span><span> COSY131</span></a></li>
            <li><a href='/ewon/COSY141.php'><span class=my_span></span><span> COSY141</span></a></li>
			<li class='last'><a href='/ewon/FLEXY.php'><span class=my_span></span><span> FLEXY</span></a></li>
         	<li><a href='/ewon/eFive.php'><span class=my_span></span><span class=\"new\"> eFive</span></a></li>

            </ul>

    </li>
	     <li class='has-sub'>$m7
		 <ul style='width: 165px;'>
				<li><a href='/plc/yottacontrol/'><span class=my_span></span><span class=\"new\">Контроллеры</span></a></li>
               <li><a href='/plc/yottacontrol/#modules'><span class=my_span></span><span class=\"new\">Модули</span></a></li>

            </ul>
    </li>

	    </li>
	     <li class='has-sub'>$m8

    </li>
		    </li>
	     <li class='has-sub'>$m9

    </li>
</ul>
</div>";
                                                        }

                                                        function temp1() {
                                                            echo "
<table width=100% cellpadding=0 cellspacing=0><tr><td valign=top width=250px>"; // <!-- MAIN TABLE     td left menu -->
                                                        }

                                                        function temp1_no_menu() {



                                                            echo "
<table width=100% cellpadding=0 cellspacing=0><tr><td valign=top width=0px>"; // <!-- MAIN TABLE     td left menu -->
                                                        }

                                                        function left_menu() {
                                                            ?>

                                                            <br>
                                                                <div id='cssmenu'>
                                                                    <ul>
                                                                        <li class='active'><a href='index.html'><span>КАТАЛОГ</span></a></li>
                                                                        <li class='has-sub'><a href='#'><span>ПАНЕЛИ WEINTEK</span></a>
                                                                            <ul>
                                                                                <li class='has-sub'><a href='/weintek/series6000i.php'><span>Серия MT6000i</span></a>
                                                                                    <ul>
                                                                                        <li><a href='#'><span>MT6050i</span></a></li>
                                                                                        <li><a href='#'><span>MT6070iH</span></a></li>
                                                                                        <li class='last'><a href='#'><span>MT6100i</span></a></li>
                                                                                    </ul>
                                                                                </li>
                                                                                <li class='has-sub'><a href='/weintek/series8000i.php'><span>Серия MT8000i</span></a>
                                                                                    <ul>
                                                                                        <li><a href='#'><span>MT8050i</span></a></li>
                                                                                        <li><a href='#'><span>MT8070iH</span></a></li>
                                                                                        <li class='last'><a href='#'><span>MT8100i</span></a></li>

                                                                                    </ul>
                                                                                </li>
                                                                                <li class='has-sub'><a href='#'><span>Серия eMT3000</span></a>
                                                                                    <ul>
                                                                                        <li><a href='#'><span>eMT3070A</span></a></li>
                                                                                        <li><a href='#'><span>eMT3070B</span></a></li>
                                                                                        <li><a href='#'><span>eMT3105P</span></a></li>
                                                                                        <li><a href='#'><span>eMT3120A</span></a></li>
                                                                                        <li><a href='#'><span>eMT3150A</span></a></li>
                                                                                    </ul>
                                                                                </li>

                                                                                <li class='has-sub'><a href='#'><span>Серия iE</span></a>
                                                                                    <ul>
                                                                                        <li><a href='#'><span>MT8070iE</span></a></li>
                                                                                        <li><a href='#'><span>MT8100iE</span></a></li>
                                                                                        <li><a href='#'><span>MT8101iE</span></a></li>

                                                                                    </ul>
                                                                                </li>

                                                                                <li class='has-sub'><a href='#'><span>Серия OPEN HMI</span></a>
                                                                                    <ul>
                                                                                        <li><a href='#'><span>MT607i</span></a></li>
                                                                                        <li><a href='#'><span>MT610i</span></a></li>
                                                                                        <li><a href='#'><span>MT610XH</span></a></li>
                                                                                        <li><a href='#'><span>MT612XH</span></a></li>
                                                                                        <li><a href='#'><span>MT615XH</span></a></li>

                                                                                    </ul>
                                                                                </li>

                                                                            </ul>
                                                                        </li>
                                                                        <li class='has-sub'><a href='#'><span>КОМПЬЮТЕРЫ IFC</span></a></li>
                                                                        <ul>

                                                                        </ul>
                                                                        <li class='has-sub'><a href='#'><span>КОМПЬЮТЕРЫ APLEX</span></a></li>
                                                                        <ul>

                                                                        </ul>

                                                                        <li class='has-sub'><a href='#'><span>ПАНЕЛИ SAMKOON</span></a></li>
                                                                        <li class='has-sub'><a href='#'><span>КОНТРОЛЛЕРЫ</span></a></li>


                                                                    </ul>
                                                                </div>



    <?
}

function temp2() {
    ?>
                                                                </td>
                                                                <td valign=top> <!-- MAIN TABLE     td right content -->

    <?
}

function temp3() {
    ?>
                                                                </td></tr></table><!-- end main table -->

                                                                <div  id=footer style="    height: 170px;">
                                                                    <center>
                                                                        <div style="    background-color: #6A6D6F;
                                                                             width: 100%;
                                                                             display: inline-block;
                                                                             color: #FFFFFF;
                                                                             padding: 10px 0px;"><br />
                                                                            <form method="post" action="https://ymlp.com/subscribe.php?id=ghejbejgmgw">
                                                                                <table border="0" align="center" cellspacing="0" cellpadding="5" style="width: 53%;">
                                                                                    <tr><td><font size="2" face="verdana,geneva">Подписка на наши новости:</font></td><td valign="top"></td><td valign="top" style="    text-align: center;"><input type="text" name="YMP0" style="line-height: 20px;    width: 280px;    -moz-border-radius: 3px;    -webkit-border-radius: 3px;    border-radius: 3px;    padding-left: 10px;" placeholder="Ваш e-mail"/></td><td><input type="submit" value="Подписаться" style="padding: 0px 10px;    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9) );
                                                                                                background: -moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );
                                                                                                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9');
                                                                                                background-color: #f9f9f9;
                                                                                                -moz-border-radius: 3px;
                                                                                                -webkit-border-radius: 3px;
                                                                                                border-radius: 3px;line-height: 20px;
                                                                                                                                                                                                            border: 1px solid #dcdcdc;    float: right;" />&nbsp;</td></tr>
                                                                                </table>
                                                                            </form>
                                                                            <br />
                                                                        </div>
                                                                        <br>
                                                                            <br /><br>
                                                                                &copy www.rusavtomatika.com 2008-2015<br /><br />
                                                                                <span id="law">Все материалы, характеристики, цены представленные на сайте не являются публичной офертой</span>
                                                                                <br />
                                                                                <br />


                                                                                </center>
                                                                                </div>

                                                                                </div> <!-- end main div -->

                                                                                <!-- BEGIN JIVOSITE CODE {literal} -->
                                                                                <script type="text/javascript">
                                                                                    (function () {
                                                                                        var widget_id = '9991';
                                                                                        var s = document.createElement('script');
                                                                                        s.type = 'text/javascript';
                                                                                        s.async = true;
                                                                                        s.src = '//code.jivosite.ru/script/widget/' + widget_id;
                                                                                        var ss = document.getElementsByTagName('script')[0];
                                                                                        ss.parentNode.insertBefore(s, ss);
                                                                                    })();</script> <div id='jivo_copyright' style='display: none'>Модуль <a href='http://www.jivosite.ru' target='_blank'>онлайн консультант</a><br> работает на JivoSite</div>
                                                                                <!-- {/literal} END JIVOSITE CODE -->
    <?
    $SEARCHFILD = '';
    $PRICES = '';
    $SMALL = '';
    $EURPRODUCTS = '';
    $query = "SELECT `model`,`retail_price` FROM `products_all`;";
    $query_result = mysql_query($query) or die("ошибка запроса05");
    $j = mysql_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysql_fetch_assoc($query_result);

            $SEARCHFILD .= '"' . $row[model] . '",';
            $PRICES .= '"' . $row[retail_price] . '",';
        };
    };

    $query = "SELECT `model`,`retail_price` FROM `controllers`;";
    $query_result = mysql_query($query) or die("ошибка запроса05");
    $j = mysql_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysql_fetch_assoc($query_result);

            $SEARCHFILD .= '"' . $row[model] . '",';
            $PRICES .= '"' . $row[retail_price] . '",';
        };
    };

    $query = "SELECT `model`,`retail_price` FROM `products_all` WHERE `show_in_cat`='1';";
    $query_result = mysql_query($query) or die("ошибка запроса05");
    $j = mysql_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysql_fetch_assoc($query_result);

            $SMALL .= '"' . $row[model] . '",';
        };
    };

    $query = "SELECT `model`,`retail_price` FROM `controllers` WHERE `model` NOT LIKE '%x%';";
    $query_result = mysql_query($query) or die("ошибка запроса05");
    $j = mysql_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysql_fetch_assoc($query_result);

            $SMALL .= '"' . $row[model] . '",';
        };
    };


    $query = "SELECT `model` FROM `products_all` WHERE `brand` IN ('eWON', '2N');";
    $query_result = mysql_query($query) or die("ошибка запроса05");
    $j = mysql_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysql_fetch_assoc($query_result);

            $EURPRODUCTS .= '"' . $row[model] . '",';
        };
    };

    $query = "SELECT `model` FROM `products_all` WHERE `brand`='Faraday';";
    $query_result = mysql_query($query) or die("ошибка запроса05");
    $j = mysql_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysql_fetch_assoc($query_result);

            $RUPRODUCTS .= '"' . $row[model] . '",';
        };
    };

    $query = "SELECT `model` FROM `controllers` WHERE `brand`='IECON';";
    $query_result = mysql_query($query) or die("ошибка запроса05");
    $j = mysql_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysql_fetch_assoc($query_result);

            $RUPRODUCTS .= '"' . $row[model] . '",';
        };
    };

    $SEARCHFILD = substr($SEARCHFILD, 0, -1);
    $PRICES = substr($PRICES, 0, -1);
    $SMALL = substr($SMALL, 0, -1);
    $EURPRODUCTS = substr($EURPRODUCTS, 0, -1);
    $RUPRODUCTS = substr($RUPRODUCTS, 0, -1);
    ?>
                                                                                <script type="text/javascript">

                                                                                    var prices = [<? echo $PRICES; ?>];
                                                                                    var models = [
    <? echo $SEARCHFILD; ?>
                                                                                    ];
                                                                                    var smodels = [
    <? echo $SMALL; ?>
                                                                                    ];
                                                                                    var eurproducts = [
    <? echo $EURPRODUCTS ?>
                                                                                    ];

                                                                                    var ruproducts = [
    <? echo $RUPRODUCTS ?>
                                                                                    ];

                                                                                </script>
                                                                                </body>

                                                                                </html>


    <?
}

//--------------------------------------- mail functions -------------------------------------------

function mime_header_encode($str, $data_charset, $send_charset) {
    if ($data_charset != $send_charset) {
        $str = iconv($data_charset, $send_charset, $str);
    }
    return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}

function send_message(
$email, // email получателя
        $subj, // тема письма
        $text // текст письма
) {
    $name_from = "RA no-reply"; // имя отправителя
    $email_from = "no-reply@rusavtomatika.com"; // email отправителя
    $name_to = ""; // имя получателя
    $data_charset = "UTF-8"; // кодировка переданных данных
    $send_charset = "UTF-8"; // кодировка письма
    $html = TRUE; // письмо в виде html или обычного текста
    $reply_to = FALSE;

    if ($email == "admin")
        $email = "plesk@mail.ru";


    $to = mime_header_encode($name_to, $data_charset, $send_charset)
            . ' <' . $email . '>';
    $subject = mime_header_encode($subject, $data_charset, $send_charset);
    $from = mime_header_encode($name_from, $data_charset, $send_charset)
            . ' <' . $email_from . '>';
    if ($data_charset != $send_charset) {
        $body = iconv($data_charset, $send_charset, $body);
    }
    $headers = "From: $from\r\n";
    $type = ($html) ? 'html' : 'plain';
    $headers .= "Content-type: text/$type; charset=$send_charset\r\n";
    $headers .= "Mime-Version: 1.0\r\n";
    if ($reply_to) {
        $headers .= "Reply-To: $reply_to";
    }



    return mail($to, $subj, $text, $headers);
}

function XMail($from, $to, $subj, $text, $filename) {
    $subj = iconv("UTF-8", "CP1251", $subj);
    $text = iconv("UTF-8", "CP1251", $text);
    $f = fopen($filename, "rb");
    $un = strtoupper(uniqid(time()));
    $head = "From: $from\n";
    $head .= "To: $to\n";
    $head .= "Subject: $subj\n";
    $head .= "X-Mailer: PHPMail Tool\n";
    $head .= "Reply-To: $from\n";
    $head .= "Mime-Version: 1.0\n";
    $head .= "Content-Type:multipart/mixed;";
    $head .= "boundary=\"----------" . $un . "\"\n\n";
    $zag = "------------" . $un . "\nContent-Type:text/html;\n";
    $zag .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
    $zag .= "------------" . $un . "\n";
    $zag .= "Content-Type: application/octet-stream;";
    $zag .= "name=\"" . basename($filename) . "\"\n";
    $zag .= "Content-Transfer-Encoding:base64\n";
    $zag .= "Content-Disposition:attachment;";
    $zag .= "filename=\"" . basename($filename) . "\"\n\n";
    $zag .= chunk_split(base64_encode(fread($f, filesize($filename)))) . "\n";


    if (!mail("$to", "$subj", $zag, $head))
        return 0;
    else
        return 1;
}
?>