<?php
function print_pictures_in_detail_template($brand, $type, $model, $pics_number)
{


    $imgRemoteDir = "/images/" . mb_strtolower($brand) . "/" . mb_strtolower($type) . "/" . $model . "/";

    if ($pics_number > 0) {
        for ($x = 1; $x <= ($pics_number); $x++) {
            $new_path_picture[] = $model . "_" . $x . ".webp";
        }
    }

    ob_start();
    ?>
    <div class="detail_image__wrapper">
        <? $counter = 1; ?>
        <? foreach ($new_path_picture as $image_url): ?>
            <a class="detail_image__image-main_link" id="detail_image__image-main_link_<?= $counter++ ?>"
               style="display: none;" data-fancybox="product"
               href="<? echo $imgRemoteDir . "1330/" . $image_url ?>">
                <img class="img_product-inner" src="<? echo $imgRemoteDir . "580/" . $image_url ?>"
                     alt="<?= $model ?>">
            </a>
        <? endforeach; ?>
        <? if ($model == "FLEXY205" || $model == "COSY131"): ?>
            <div class="3d-panel detail_image__image-main_link" id="detail_image__image-main_link_0"
                 style="display: none;width: 590px;height: 447px;margin:0 auto;box-shadow: 0 0 9px 0px rgba(0,0,0,0.2);">
                <? include $_SERVER["DOCUMENT_ROOT"] . "/3D/component/index.php"; ?>
            </div>
        <? endif; ?>

            <div class="detail_image__images-mini__wrapper">
                <div class="detail_image__images-mini__inner">
                    <?
                    $counter = 1;
                    foreach ($new_path_picture as $image_url):?>
                        <div data-rel="detail_image__image-main_link_<?= $counter++ ?>"
                             class="detail_image__images-mini">


                            <img loading="lazy" src="<? echo $imgRemoteDir . "67/" . $image_url; ?>"
                                 alt="<?= $model ?>">
                        
                        </div>
                    <? endforeach; ?>
                    <? if ($model == "FLEXY205" || $model == "COSY131"): ?>
                        <div data-rel="detail_image__image-main_link_0" class="detail_image__images-mini launch_3d"
                             style="background-image:url('/3D/assets/ewon/FLEXY205/prev_icon.gif');"></div>
                    <? endif; ?>
                </div>
            </div>

    </div>
    <?
    $out = ob_get_clean();
    return $out;
}

function canonical()
{
    $vta = (explode('?', $_SERVER['REQUEST_URI']));
    $var_to_array = str_replace("/index.php", "/", $vta[0]);
    $var_to_array = str_replace("index.php", "", $var_to_array);
    return $var_to_array;
}

function version($file)
{

    $ver = '?1';
    $f = $_SERVER['DOCUMENT_ROOT'] . $file;
    if (file_exists($f)) {

        $ver = '?' . filemtime($f);
    }

    return $ver;
}

function ftp_rus_connect($dir)
{

    // var_dump_pre(debug_backtrace());
    global $ftp_server;
    global $ftp_user_name;
    global $ftp_user_pass;

// ��������� ����������
    $conn_id = ftp_connect($ftp_server);
// ���� � ������ ������������ � �������
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
    ftp_pasv($conn_id, true);

//ftp_chdir($conn_id, $dir);
    ftp_set_option($conn_id, FTP_TIMEOUT_SEC, 3600);
    $buff = ftp_nlist($conn_id, $dir);
    return $buff;
}

function cu($url)
{
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
    $info = curl_getinfo($curl);
    if (isset($info["download_content_length"])) $re[0] = $info["download_content_length"];
    else $re[0] = 0;

    if (isset($info['filetime'])) {
        $re[1] = $info['filetime'];

    } else $re[1] = 0;
    curl_close($curl);
    return $re;
}

function cu_content($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function global_get_products_files($model)
{
    global $mysqli_db;
    database_connect();
    $query = "SELECT * FROM `products_files` WHERE `product_name` like '%" . $model . "%' ORDER BY `position`";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        for ($row = 0; $row < $rows; $row++) {
            $current_row = mysqli_fetch_assoc($result);
            $out[] = $current_row;
        }
    } else {
        $out = '';
    };
    return $out;
}

function show_price_val($type_of_currency = "usd")
{
    $type_of_currency = mb_strtolower($type_of_currency);
    if ($type_of_currency === "rur") {
        return;
    }
    ?>
    <div class="block_shpr_wrapper">
        <div class="block_shpr__usd_rate"><?
            if ($type_of_currency == "usd") {
                usd_rate();
            } else if ($type_of_currency == "euro") {
                euro_usd_rate();
            }
            ?></div>
        <div id="shpr" onclick="recalc_valute()">���������� ���� � ���</div>
    </div>
    <?
}

function action_price($model)
{
    $date = date("Y-m-d H:i:s");
    $sql = "SELECT * FROM `action` WHERE  `model`='{$model}' AND `date_from`<='{$date}' AND `date_to`>='{$date}'  LIMIT 1";
    global $mysqli_db;
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    if (mysqli_num_rows($res) == 0)
        return "";
    $r = mysqli_fetch_object($res);
    $price = $r->price;
    return $price;
}


function remain_days($date)
{
    $now = time(); // or your date as well
    $your_date = strtotime($date);
    $datediff = $your_date - $now;
    return floor($datediff / (60 * 60 * 24));
}

function stime($format, $tm)
{

    if ($tm == "0000-00-00")
        return "";
    //import locale;
    // locale.setlocale(locale.LC_ALL, 'ru_RU.UTF-8');
    //setlocale(LC_ALL,'ru_RU.CP1251','ru_RU','rus');
    //setlocale(LC_ALL, 'ru_RU');
    //$result = setlocale(LC_ALL, 'ru_RU','rus_RUS','Russian');
// $mone=array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    $mone = array("���.", "���.", "���.", "���.", "���", "����", "����", "���.", "����.", "���.", "���.", "���.");
    $m = $mone[(int)strftime('%m', strtotime($tm)) - 1];


    $out = strftime('%d', strtotime($tm)) . " " . $m;
    if (strpos($format, "Y") !== false)
        $out = strftime('%d', strtotime($tm)) . " " . $m . " " . strftime('%Y', strtotime($tm));
    if (strpos($format, ":") !== false)
        $out .= " " . strftime('%T', strtotime($tm));

    return $out;
}


/**/
function set_db_var($name, $value)
{
    global $mysqli_db;
    $sql = "SELECT * FROM `variables` WHERE `name`='$name' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    if (mysqli_num_rows($res) == 0) {
        // create variable
        $sql = "INSERT INTO `variables` (name, value) VALUES ( '$name', '$value')";
        $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
        return true;
    } else {
        // update variable
        $sql = "UPDATE `variables` SET `value`='$value'  WHERE `name`='$name' ";
        $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error());
        return true;
    }
}

function get_db_var($varname)
{
    global $mysqli_db;
    $sql = "SELECT * FROM `variables` WHERE `name`='$varname' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    if (mysqli_num_rows($res) > 1)
        return "more then 1 var";
    if (!$r = mysqli_fetch_object($res))
        return "no var";
    return $r->value;
}

function get_models_expected_date($model)
{

    global $mysqli_db;
    $sql = "SELECT * FROM `products_all` WHERE `model`='$model' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    if (!$r = mysqli_fetch_object($res))
        return "";
    $brand = $r->brand;
//echo $brand;
//
    $sql = "SELECT * FROM `orders_on_way` WHERE `brand`='$brand' AND `blocked`='0' AND `arrived`='0' ";
    $res = mysqli_query($mysqli_db, $sql) or die("������ 206" . mysqli_error($mysqli_db));
    $out = "";
    while ($r = mysqli_fetch_object($res)) {
        $id = $r->id;
        // echo $id.", ";
        $sql = "SELECT * FROM `orders_on_way_detailed` WHERE `order_id`='$id' AND `model`='$model' ";
        $res1 = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
        if (mysqli_num_rows($res1) > 0)
            return $r->arrive_date;
    }

    return "";
}

function get_order_on_way_id($order, $brand)
{  // returns order object from datyabase that accords order need to be shown
    global $mysqli_db;
    $sql = "SELECT * FROM  `orders_on_way` WHERE `brand` = '$brand' AND `blocked` = 0 ORDER BY `id` ASC";
    $res = mysqli_query($mysqli_db, $sql) or die("������ 223" . mysqli_error($mysqli_db));
    if (mysqli_num_rows($res) < $order)
        return false;
    $out = "";
    $i = 0;
    while ($r = mysqli_fetch_object($res)) {
        if ($i == $order)
            break;
        $i++;
    }
    return $r;
}

function show_models_on_way($model, $order, $brand)
{
    global $mysqli_db;
    $sql = "SELECT * FROM  `orders_on_way` WHERE `brand` = '$brand' AND `blocked` = 0 ORDER BY `id` ASC";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    if (mysqli_num_rows($res) < $order)
        return false;
    $out = "";
    $i = 0;
    while ($r = mysqli_fetch_object($res)) {
        if ($i == $order)
            break;
        $i++;
    }
    $order_id = $r->id;

    $sql = "SELECT * FROM  `orders_on_way_detailed` WHERE `model`= '$model' AND`order_id`='$order_id' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $sum = 0;
    while ($r = mysqli_fetch_object($res)) {
        $sum += $r->amount;
    }
//if($sum==0) $sum="";
    return $sum;
}

function show_reserved_amount($model, $stock)
{
    global $mysqli_db;
    $sql = "SELECT * FROM  `reservations` WHERE `model`= '$model' AND `stock` = '$stock' AND `blocked` = 0 ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $sum = 0;
    while ($r = mysqli_fetch_object($res)) {
        $sum += $r->amount;
    }

// if($sum==0) $sum=" ";

    return $sum;
}

function xor_this($string)
{

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

function random_str($len)
{

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

function random_num($len)
{

    $arr = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

//$arr = array('1','2','3','4','5','6','7','8','9','0');

    $string = "";
    for ($i = 0; $i < $len; $i++) {
        $index = rand(0, count($arr) - 1);
        $string .= $arr[$index];
    }

    return $string;
}

function show_product_mixed($model)
{
    global $mysqli_db;
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);

    if ($r->type == "hmi" || $r->type == "open_hmi") {
        return show_panel1($model);
    }
    if ($r->type == "panel_pc") {
        return show_ifc($model);
    }
}

function block_sql($str)
{

//return preg_replace("/[^0-9]+/", "", $str);
//return eregi("[^A-Za-z0-9.]", $str);
    $a1 = array("'", '"', "[", "]", "(", ")", "\\", "/");
//$a2=array("&#39;","&quot;", "", "", "", "", "", "");
    $a2 = array("X", "X", "X", "X", "X", "X", "X", "X");
//$a2=array("", "", "", "");
    return str_replace($a1, $a2, $str);
}

function show_model_price($model)
{
    global $mysqli_db;
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);
    $action_price = action_price($r->model);

    if (!empty($action_price)) {
        $out = " <span class='prpr old'>$r->retail_price</span><span class='prpr action' style='font-size:12px;' title='������� ��� ��������� � ���'>$action_price</span><span class=val_name style='font-size:12px;'  title='������� ��� ��������� � ���'>USD </span>";
    } else {
        $out = "<span class='prpr' style='font-size:12px;' title='������� ��� ��������� � ���'>$r->retail_price</span><span class=val_name style='font-size:12px;'  title='������� ��� ��������� � ���'>USD </span>";
    };

    return $out;
}

function get_link_to_model($model)
{
    global $mysqli_db;

    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);
    if ($r->parent != "")
        $model = $r->parent;

    if (preg_match('/\//', $model)) {
        $model = str_replace('/', '-', $model);
    }

    if (($r->brand == "APLEX") || (($r->brand == "IFC") and ($r->type != 'monitor') and ($r->type != 'box-pc')))
        return "/panelnie-computery/" . strtolower($r->brand) . "/$model.php";
    elseif (($r->brand == "IFC") and ($r->type == 'monitor')) {
        return "/monitors/$model.php";
    } elseif (($r->brand == "IFC") and ($r->type == 'box-pc')) {
        return "/promyshlennye-kompyutery-box-pc/$model.php";
    } else
        return "/" . strtolower($r->brand) . "/$model.php";
}

function get_small_pic($model)
{
    global $root_php;
    global $mysqli_db;

    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);


    $fps_im = "/images/" . strtolower($r->brand) . "/$r->pic_small";


    if ($GLOBALS["net"] == 0 or 1) {
        if ((file_exists($GLOBALS["path_to_real_files"] . $fps_im)) and (!empty($r->pic_small))) {

            return $fps_im;
        }  // if exists return from database
        else {

            $pic = get_big_pic($r->model);

            if (!empty($pic) and ($pic != '/')) {

                return get_big_pic($r->model);
            } else {


                if (file_exists($GLOBALS["path_to_real_files"] . '/images/' . strtolower($r->brand) . '/' . $r->model . '/' . $r->model . '_1.png')) {
                    return '/images/' . strtolower($r->brand) . '/' . $r->model . '/' . $r->model . '_1.png';
                };
            };
        };
    } else {
        $re = cu($GLOBALS["path_to_real_files"] . $fps_im);
        if (($re[0] > 0) and (!empty($r->pic_small))) {
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
        };;
    };
}

function get_big_pic($model)
{
    $im1 = "";
    global $root_php;
    global $mysqli_db;

    if ($model == "")
        return "";
    $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);

    if ($r->parent != "") {
        $sql = "SELECT * FROM products_all WHERE `model` = '$r->parent' ";
        $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
        $model = $r->parent;
        $r = mysqli_fetch_object($res);
    };


    if ($r->pic_big != "") {
        $fps_im = "images/" . strtolower($r->brand) . "/$r->pic_big";
        $fps_im1 = 'images/ewon/' . $r->pic_big;
        $fps_im2 = 'images/box-pc/' . $r->pic_big;
        if ($GLOBALS["net"] == 0 or 1) {
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
            if (isset($re[0]) and $re[0] > 0) {
                return '/' . $fps_im;  // if exists return from database
            }
            $re = cu($root_php . '/' . $fps_im1);
            if (isset($re[0]) and $re[0] > 0) {
                return '/' . $fps_im1;
            }
            $re = cu($root_php . '/' . $fps_im2);
            if (isset($re[0]) and $re[0] > 0) {
                return '/' . $fps_im2;
            }

        };
    }
    $model_to_image = $r->model;
    if (preg_match('/\//', $r->model)) {
        $model_to_image = str_replace('/', '-', $r->model);
    }
    $imgroot = "images/" . strtolower($r->brand) . "/$model_to_image";

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
    if (preg_match('/IFC/i', $r->brand)) {
        if ($r->type == 'box-pc') {
            $imgroot = "images/box-pc/" . $model_to_image;
        };
    };
    if ($GLOBALS["net"] == 0 or 1) {
        $add = '';
    } else {
        $add = '/';
    };
    $imfo = $root_php . $add . $imgroot . '/' . $model_to_image . '_1.png';

    if ($GLOBALS["net"] == 0 or 1) {
        if (file_exists($imfo)) {
//
            return '/' . $imgroot . '/' . $model_to_image . '_1.png';
        };
        //$files = scandir($root_php . $imgroot);
    } else {
        $re = cu($imfo);
        if (isset($re[0]) and $re[0] > 0) {
            return '/' . $imgroot . '/' . $model_to_image . '_1.png';
        };
        $files = ftp_rus_connect($root_php . $add . $imgroot);

    };


    if (!empty($files[2])) {
        return '/' . $imgroot . "/" . $files[2];
    }
    if ($GLOBALS["net"] == 0 or 1) {
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

    $query_images_result = mysqli_query($mysqli_db, $query_images) or die("������ �������022" . $query_images);
    $iimg = mysqli_num_rows($query_images_result);

    if ($iimg == 0) {
        $query_images = "SELECT * FROM `gallery` WHERE `model`='{$r->parent}' ORDER BY `id` LIMIT 1;";

        $query_images_result = mysqli_query($mysqli_db, $query_images) or die("������ �������022" . $query_images);
        $iimg = mysqli_num_rows($query_images_result);
    };


    if ($iimg > 0) {


        $img_row = mysqli_fetch_assoc($query_images_result);


//echo $_SERVER['DOCUMENT_ROOT'];
        $img_row["s_img_path"] = $model_to_image . '_1.png';

        if ($r->type == 'monitor') {
            $path = 'images/ifc/' . $model_to_image . '/';

            if ($GLOBALS["net"] == 0 or 1) {
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

            if ($GLOBALS["net"] == 0 or 1) {
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

            if ($GLOBALS["net"] == 0 or 1) {
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
            $path = 'images/ifc/' . $model_to_image . '/';

            if ($GLOBALS["net"] == 0 or 1) {
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
            if ($GLOBALS["net"] == 0 or 1) {
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

function miniatures($model, $mins_in_row, $mins_max, $table_width, $view3d = 0)
{
    global $mysqli_db;
    $mc = 0;
    $min_table_array = array();
    if ($view3d != 0)
        $min_table_array[] = '<td>
            <a class="button_view360" data-fancybox data-type="iframe" href="/ajax/view3d.php"></a>
            </td>';

    $min_table = "";
    if (preg_match('/,/', $model)) {
        $models = explode(',', $model);
    } else {
        $models[0] = $model;
    };
    while (list($key, $model) = each($models)) {
        $sql = "SELECT * FROM products_all WHERE `model` = '$model' ";
        $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
        $r = mysqli_fetch_object($res);
        if ($r !== false && $r->model != "") {  // if there is model in the database
            if ($r->parent != "")
                $sql = "SELECT * FROM `products_all` WHERE `model` = '$r->parent' ";
            $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
            $r = mysqli_fetch_object($res);

            if (((preg_match('/ARCHMI/i', $r->model)) and (!preg_match('/P$/i', $r->model))) or ((preg_match('/ARMPAC/i', $r->model)) and (!preg_match('/P$/i', $r->model)))) {
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


        if ($GLOBALS["net"] == 0 or 1) {
            if (file_exists($imfo)) {
                $yes = 1;
            } else {
                $yes = 0;
            };
        } else {
            $re = ftp_rus_connect($imgroot . "/sm");


            if (!empty($re)) {
                $yes = 1;
            } else {
                $yes = 0;
            };
        };


        if ($yes == 1) {
            if ($GLOBALS["net"] == 0 or 1) {

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

            if ($GLOBALS["net"] == 0 or 1) {

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

                $min_table_array[] = "<td $lclass  onclick='dich(\"$imgroot/$modd" . "_$j.png\",$llink);'><img src=$imgroot/sm/$modd" . "_$j.png width=50 alt='$alt'>$lbox</td>
                        ";
                $mc++;
            }
        }
    }

    if (!empty($min_table_array)) {
        $min_table = "<table class=\"minitable\" width=$table_width bfcolor=red><tr>";
        $rows_count = ceil(count($min_table_array) / $mins_in_row);
        //$cells_count = $mins_in_row * $rows_count;
        $counter = 0;
        for ($i = 0; $i < $rows_count; $i++) {
            $min_table .= '<tr>';
            for ($j = 0; $j < $mins_in_row; $j++) {
                if (isset($min_table_array[$counter])) {
                    $min_table .= $min_table_array[$counter];
                }
                $counter++;
            }
            $min_table .= '</tr>
                    ';
        }
        //$min_table .= "</tr>";
        $min_table .= "</table>";
    };

    return $min_table;
}

function min_ps($model, $mins_in_row, $mins_max, $table_width)
{
    global $mysqli_db;
    $mc = 0;
    $min_table_array = array();
    $min_table = "";
    if (preg_match('/,/', $model)) {
        $models = explode(',', $model);
    } else {
        $models[0] = $model;
    };
    while (list($key, $model) = each($models)) {
        $sql = "SELECT * FROM `products_all` WHERE `s_name` = '$model' ";
        $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
        $r = mysqli_fetch_object($res);
        if ($r !== false && $r->model != "") {  // if there is model in the database
            if ($r->parent != "")
                $sql = "SELECT * FROM `products_all` WHERE `s_name` = '$r->parent' ";
            $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
            $r = mysqli_fetch_object($res);

            $imgroot = "/images/" . strtolower($r->brand) . "/$r->s_name";

            $imfo = $GLOBALS["path_to_real_files"] . $imgroot . "/sm";

            $miniatures_in_raw = $mins_in_row;
            $modd = $r->s_name;
        };


        if ($GLOBALS["net"] == 0 or 1) {
            if (file_exists($imfo)) {
                $yes = 1;
            } else {
                $yes = 0;
            };
        } else {
            $re = ftp_rus_connect($imgroot . "/sm");


            if (!empty($re)) {
                $yes = 1;
            } else {
                $yes = 0;
            };
        };


        if ($yes == 1) {
            if ($GLOBALS["net"] == 0 or 1) {

                $files = scandir($imfo);
            } else {
                $imfo = $imgroot . "/sm";
                $files = ftp_rus_connect($imfo);
            };

            $miniatures = sizeof($files) - 2;


//if($miniatures>$mins_max) $miniatures=$mins_max;

            $alt = get_kw("alt");
            $lgfo = $GLOBALS["path_to_real_files"] . $imgroot . "/lg";

            if ($GLOBALS["net"] == 0 or 1) {

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

                $min_table_array[] = "<td $lclass  onclick='dich(\"$imgroot/$modd" . "_$j.png\",$llink);'><img src=$imgroot/sm/$modd" . "_$j.png width=50 alt='$alt'>$lbox</td>
  ";
                $mc++;
            }
        }
    }

    if (!empty($min_table_array)) {
        $min_table = "<table class=\"minitable\" width=$table_width bfcolor=red><tr>";
        $rows_count = ceil(count($min_table_array) / $mins_in_row);
        $cells_count = $mins_in_row * $rows_count;
        $counter = 0;
        for ($i = 0; $i < $rows_count; $i++) {
            $min_table .= '<tr>';
            for ($j = 0; $j < $mins_in_row; $j++) {
                $min_table .= $min_table_array[$counter];
                $counter++;
            }
            $min_table .= '</tr>';
        }
        $min_table .= "</tr></table>";
    };

    return $min_table;
}

function print_modifis_in_detail_template($model, $parant_model)
{

    global $mysqli_db;
//$sql="SELECT * FROM `products_all` WHERE  `modification`=1 AND `model` LIKE '$model%' ";
    $sql = "SELECT * FROM `products_all` WHERE  `modification`=1 AND `parent` like '%$model%' AND `show_in_cat`='1' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    function print_price($retail_price, $brand, $retail_price_hide)
    {
        if ((preg_match("/eWON/i", $brand)) or ($brand == '2N')) {
            $ue = 'EUR';
        } else {
            $ue = 'USD';
        };

        if (($retail_price != '0') and ($retail_price != '') and $retail_price_hide != 1) {
            $result = "<td><span class=prpr title='������� ��� ��������� � ���' style='font-size:11px;'>$retail_price</span><span class=val_name title='������� ��� ��������� � ���' style='font-size:11px;'> $ue </span></td>";
        } else {
            $result = "
<td>��&nbsp;�������</td>
";
        };
        return $result;
    }

    if (mysqli_num_rows($res) == 0)
        return "";
    $out = "<table class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc style='width:1100px'>
<tr class=hed><td >������</td><td width=270>������������</td><td width=160>�������</td><td width=80>���� � ���</td><td width=280>��������</td></tr>";

    ob_start();

    $out .= ob_get_clean();
    while ($r = mysqli_fetch_object($res)) {

        $priceb = print_price($r->retail_price, $r->brand, $r->retail_price_hide);

        $spec = ifc_modif_decode($r);
        $pos = strpos($r->parent, 'FLEXY205');
        if (!empty($r->spec_modif)) {
            $spec = $r->spec_modif;
        }
        if ($pos !== false) {
            $spec = $r->spec_modif;
        }

        ob_start(); ?>

        <tr>
            <td width=170 class=modif_name><?= $r->model ?></td>
            <td><?= $spec ?></td>
            <td><?= show_stock($r, 1) ?></td>
            <?= $priceb ?>
            <td style='padding: 9px 6px 0px 14px;'>
                <? if (($r->retail_price != '0') and ($r->retail_price != '')) { ?>
                    <span class='zakazbut2 addToCart' idm='<?= $r->model ?>'>� �������</span>
                    <?
                } else { ?>
                    <span class='zakazbut2 disabled' idm='<?= $r->model ?>'>� �������</span>
                    <?
                } ?>
                &nbsp <span class=zakazbut2 idm='<?= $r->model ?>' onclick='show_compare(this)'>� ���������</span>
                &nbsp <span class=zakazbut2 idm='<?= $r->model ?>' onclick='show_backup_call(1, "<?= $r->model ?>")'>�������� ������</span>
            </td>
        </tr>

        <? $out .= ob_get_clean();

    }
    $out .= "</table>";

    return $out;
}

function show_pc_variants($model)
{
    global $mysqli_db;
//$sql="SELECT * FROM `products_all` WHERE  `modification`=1 AND `model` LIKE '$model%' ";
    $sql = "SELECT * FROM `products_all` WHERE  `modification`=1 AND `parent` like '%$model%' AND `show_in_cat`='1' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    if (mysqli_num_rows($res) == 0)
        return "";
    $out = "<table class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc style='width:1100px'>
<tr class=hed><td >������</td><td width=270>������������</td><td width=160>�������</td><td width=80>���� � ���</td><td width=280>��������</td></tr>";

    while ($r = mysqli_fetch_object($res)) {
        if ((preg_match("/eWON/i", $r->brand)) or ($r->brand == '2N')) {
            $ue = 'EUR';
        } else {
            $ue = 'USD';
        };

        if (($r->retail_price != '0') and ($r->retail_price != '')) {
            $priceb = "<td><span class=prpr title='������� ��� ��������� � ���' style='font-size:11px;'>$r->retail_price</span><span class=val_name title='������� ��� ��������� � ���' style='font-size:11px;'> $ue </span></td>";
        } else {
            $priceb = "
<td>��&nbsp;�������</td>
";
        };
        $spec = ifc_modif_decode($r);
        $pos = strpos($r->parent, 'FLEXY205');
        if (!empty($r->spec_modif)) {
            $spec = $r->spec_modif;
        }
        if ($pos !== false) {
            $spec = $r->spec_modif;
        }
        $out .= "<tr><td width=170 class=modif_name>$r->model</td><td>$spec</td><td>" . show_stock($r, 3) . "</td>
" . $priceb . "

<td style='    padding: 9px 6px 0px 14px;'><span class='zakazbut2 addToCart' idm='$r->model'>� �������</span>
 &nbsp <span class=zakazbut2 idm='$r->model' onclick='show_compare(this)'>� ���������</span>
 &nbsp <span class=zakazbut2 idm='$r->model' onclick='show_backup_call(1, \"$r->model\")'>�������� ������</span>
 </td>
</tr>";
    }
    $out .= "</table>";
    return $out;
}


function get_file_date($file)
{
    if ($GLOBALS["net"] != 0) {
        $file = preg_replace("/ /", "%20", $file);
    };
    $document_root = $GLOBALS["path_to_real_files"];
    $filename = $document_root . $file;

//return $filename;
    if ($GLOBALS["net"] == 0 or 1) {

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
            $fs .= '&nbsp;��';
        } else {
            $fs = $fs * 1000;
            $fs .= '&nbsp;��';
        };
        return $t . '<br />' . $fs;
    };
}

function show_com_connector($panel)
{  //main func for show all panels connectors

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
            $typcon = "DB-9 M ( ���� )";
        }
        if ($conn_d1[1] == "F") {
            $imcon = "/images/com_f.png";
            $typcon = "DB-9 F ( ���� )";
        }
        if ($conn_d1[1] == "RJ25F") {
            $imcon = "/images/rj-25.png";
            $typcon = "RJ25-6 F ( ���� )";
        }


        echo "<table class=pins_tab><tr><td width=300 valign=top align=left>
  <div class=pins_its>
  <span class=conn_name>������������ �������:</span>
  <br><div class=conn_name1 $conn_d1[0]</div><br>
  <span class=conn_name>��� �������: </span>
  <br><div class=conn_name1>$typcon</div> <br>
  <img src=$imcon width=160>
  </div>
  <td valign=top align=left>
  ";
        if ($conn_d1[1] == "RJ25F") {
            show_com_ports6($con_d[1]);
        } else {
            show_com_ports($con_d[1]);
        }
        echo "</td></tr></table><br><br><br>";
    }


//$a=explode("\n", $f);
}

function show_com_ports($connector)
{  // show one connector
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

function show_com_ports6($connector)
{  // show one connector
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
        show_1_port6($a[$y]);
        echo "</td>";
    }
    echo "</tr></table>";
}

function show_1_port($port)
{   // show one port
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

function show_1_port6($port)
{   // show one port
    $b = explode("=", $port);
//echo "<br>";
    $c = explode("|", $b[1]);
    $pins = sizeof($c);
//echo $pins;
    echo "<table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc>
<tr><td><div class=pins_its_h>$b[0]</div></td></tr>";


    for ($i = 1; $i < 7; $i++) {
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

function comp_pan($mod, $p)
{
    global $mysqli_db;
    $sql = "SELECT * FROM products_all WHERE `model` = '$mod' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);
    //var_dump_pre(gettype($r));
    if ($r == null) {
        return;
    }
    $fo = strtolower($r->brand);
    if ($fo == "weintek")
        $fo = "panel";
    if ($r->type == "box-pc")
        $fo = "box-pc";
    $imp = "/images/$fo/$r->model/$r->model" . "_1.png";
    $arr = array();
    $pn = array();

    $type = "";
    if ($r->type == "hmi")
        $type = "������ ���������";
    if ($r->type == "panel_pc")
        $type = "��������� ���������";
    if ($r->type == "open_hmi")
        $type = "Open HMI";
    if ($r->type == "machine-tv-interface")
        $type = "��������� Machine-TV";
    if ($r->type == "cloud_hmi")
        $type = "���������";
    if ($r->type == 'box-pc')
        $type = '������������ ���������';
    if ($r->type == 'monitor')
        $type = '�������';
    if ($r->type == 'vpn-router')
        $type = 'VPN-������';
    $onst = show_stock($r, 3);

    array_push($arr, $r->model);
    array_push($pn, "������");

    if ($r->retail_price_hide == '1' and $r->series != 'cMT-X' and $r->series != 'cMT'){
        array_push($arr, "-");
    }elseif($r->retail_price > 0){
        array_push($arr, $r->retail_price);
    }else{
        array_push($arr, "-");
    }

    array_push($pn, "����, USD");
    array_push($arr, $onst);
    array_push($pn, "�������");
    array_push($arr, $r->series);
    array_push($pn, "�����");
    array_push($arr, $r->brand);
    array_push($pn, "�����");
    array_push($arr, $type);
    array_push($pn, "���");

    array_push($arr, "empty");
    array_push($pn, "&nbsp �������");

    array_push($arr, $r->diagonal . "\"");
    array_push($pn, "���������");
    array_push($arr, $r->resolution);
    array_push($pn, "����������");
    array_push($arr, $r->colors);
    array_push($pn, "���������");
    array_push($arr, $r->brightness);
    array_push($pn, "�������");
    array_push($arr, $r->contrast);
    array_push($pn, "��������");
    array_push($arr, $r->view_angle);
    array_push($pn, "���� ������, &deg");
    array_push($arr, $r->backlight);
    array_push($pn, "���������");
    array_push($arr, $r->backlight_life);
    array_push($pn, "����� ����� ���������");
    array_push($arr, $r->touch);
    array_push($pn, "��� �������");

    array_push($arr, "empty");
    array_push($pn, "&nbsp ���������");


    array_push($arr, $r->cpu_type);
    array_push($pn, "���������");
    array_push($arr, $r->cpu_speed);
    array_push($pn, "�������, ���");
    array_push($arr, $r->chipset);
    array_push($pn, "������");
    array_push($arr, $r->graphics);
    array_push($pn, "�������");
    array_push($arr, $r->audio);
    array_push($pn, "�����");
    array_push($arr, $r->ram);
    array_push($pn, "���, ��");
    array_push($arr, $r->ram_type);
    array_push($pn, "��� ���");
    array_push($arr, $r->ram_slots);
    array_push($pn, "���-�� ������ ���");
    array_push($arr, $r->ram_max);
    array_push($pn, "����. ����� ���, ��");
    array_push($arr, $r->flash);
    array_push($pn, "Flash, ��");
    array_push($arr, "$r->hdd_size_gb $r->hdd_type");
    array_push($pn, "������� ����");
    array_push($arr, $r->rtc);
    array_push($pn, "���� ��������� �������");
    array_push($arr, $r->power);
    array_push($pn, "��������, ��");
    array_push($arr, $r->current);
    array_push($pn, "������������ ���, �");
    array_push($arr, "$r->voltage_min-$r->voltage_max");
    array_push($pn, "����������, �");
    array_push($arr, "$r->battery");
    array_push($pn, "�����������");

    array_push($arr, "empty");
    array_push($pn, "&nbsp ����������");

    array_push($arr, $r->serial_full);
    array_push($pn, "��� �����");
    array_push($arr, $r->lpt);
    array_push($pn, "������������ ����");
    array_push($arr, $r->ps2_klava);
    array_push($pn, "PS/2 ����������");
    array_push($arr, $r->ps2_mouse);
    array_push($pn, "PS/2 ����");
    array_push($arr, $r->usb_host);
    array_push($pn, "USB host");
    array_push($arr, $r->usb_client);
    array_push($pn, "USB client");
    array_push($arr, $r->ethernet);
    array_push($pn, "Ethernet");
    array_push($arr, $r->can_bus);
    array_push($pn, "CAN");
    array_push($arr, $r->sdcard);
    array_push($pn, "SD �����");
    array_push($arr, $r->speakers);
    array_push($pn, "���������� ��������");

    array_push($arr, $r->linear_out);
    array_push($pn, "�������� ���������� ");
    array_push($arr, $r->mic_in);
    array_push($pn, "����������� ���� ");
    array_push($arr, $r->video_input);
    array_push($pn, "����� ����");
    array_push($arr, $r->pci_slot);
    array_push($pn, "PCI");
    array_push($arr, $r->vga_port);
    array_push($pn, "���� VGA");
    array_push($arr, $r->dvi_port);
    array_push($pn, "���� DVI");
    array_push($arr, $r->displayport);
    array_push($pn, "���� DisplayPort");
    array_push($arr, $r->hdmi);
    array_push($pn, "���� HDMI");
    array_push($arr, $r->dio);
    array_push($pn, "���������� ����� / ������");
    array_push($arr, $r->sim);
    array_push($pn, "���� ��� SIM-�����");

    array_push($arr, "empty");
    array_push($pn, "&nbsp �����������");

    $mount = "";
    if ($r->wall_mount != "")
        $mount .= "��������� � ���";
    if ($r->vesa75 != "")
        $mount .= ", VESA 75x75";
    if ($r->vesa100 != "")
        $mount .= ", VESA 100x100";
    if ($r->model == "mTV-100")
        $mount = "�� DIN �����";

    $arch = "������ ������";
    if ($r->usb_host != "")
        $arch .= ", ������";
    if ($r->sdcard != "")
        $arch .= ", SD �����";
    if ($r->os != "")
        $arch = "";

    $proj_load = "";
    if ($r->usb_client != "")
        $proj_load .= "� �� �� USB";
    if ($r->ethernet != "") {
        if ($proj_load != "")
            $proj_load .= ", ";
        $proj_load .= "� �� �� Ethernet";
    }

    if ($r->usb_host != "")
        $proj_load .= ", � ������";
    if ($r->sdcard != "")
        $proj_load .= ", � SD �����";


    if ($r->os != "")
        $proj_load = "";

    $proj_windows = "";
    if ($r->brand == "Weintek")
        $proj_windows = "1999";
    if ($r->brand == "Samkoon")
        $proj_windows = "200";


    array_push($arr, $r->case_material);
    array_push($pn, "�������� �������");
    array_push($arr, $r->cpu_fan ? "����������" : "����������������");
    array_push($pn, "��� ����������");
    array_push($arr, $mount);
    array_push($pn, "�������� ���������");
    array_push($arr, $r->power_switch);
    array_push($pn, "����������� �������");
    array_push($arr, $r->power_adapter);
    array_push($pn, "������� ���� �������");
    array_push($arr, $r->set);
    array_push($pn, "�������� ��������");

    array_push($arr, $r->dimentions);
    array_push($pn, "�������, ��");
    array_push($arr, $r->cutout);
    array_push($pn, "����� ��� �������, ��");
    array_push($arr, $r->netto);
    array_push($pn, "���, ��");

    array_push($arr, "$r->temp_min-$r->temp_max");
    array_push($pn, "������� ����-��, &degC");

    array_push($arr, "empty");
    array_push($pn, "&nbsp ��");

    if ((!preg_match('/ifc/i', $r->brand)) and (!preg_match('/Aplex/i', $r->brand))) {
        array_push($arr, $r->installed_os);
        array_push($pn, "������������� OC");
    } else {
        array_push($arr, '-');
        array_push($pn, "������������� OC");
    };

    array_push($arr, $r->os);
    array_push($pn, "�������� ��������� OC");
    array_push($arr, $r->software);
    array_push($pn, "�� ��� ���������� ��������");
    array_push($arr, $proj_windows);
    array_push($pn, "������������ ���������� ������� � �������");
    if (isset($r->vnc)) {
        array_push($arr, $r->vnc);
        array_push($pn, "VNC ������");
    }
    array_push($arr, $r->ftp_access_hmi_mem);
    array_push($pn, "FTP ������ � ������ ������");
    array_push($arr, $r->ftp_access_sd_usb);
    array_push($pn, "FTP ������ � SD ����� � ������");
    array_push($arr, $arch);
    array_push($pn, "����������� ���������� ������� ������");
    array_push($arr, $proj_load);
    array_push($pn, "������� �������� ������� � ������");
    array_push($arr, $r->project_size_mb);
    array_push($pn, "������������ ������ �������, ��");
    array_push($arr, $r->history_data_size_mb);
    array_push($pn, "����� ������ ��� ���������� ������� � ������ ��");

/*    var_dump_pre($arr);
    var_dump_pre($pn);*/

    $out = "";
    $out .= "<table>


<tr><td>$r->dimentions &nbsp</td></tr>
<tr><td>$r->netto &nbsp</td></tr>
<tr><td>$r->temp &nbsp</td></tr>
<tr><td>$r->temp_min &nbsp</td></tr>
<tr><td>$r->temp_max &nbsp</td></tr>
<tr><td>$r->brutto &nbsp</td></tr>
<tr><td>$r->video_input &nbsp</td></tr>";
    if (($r->brand == "Weintek") or ($r->brand == "Samkoon")) {
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

function show_stock($r, $mode)
{
    //var_dump_pre($r);
    global $mysqli_db;
    $install_hdd_days = 5;

    $arCity = ["spb" => "���",
        "msk" => "���",
    ];
    $resultArCity = [];

    switch ($mode) {
        case 1:
            if(isset($r->availability) and $r->availability>0){
                $maxonstock = 1;
            }else{
                $maxonstock = $r->onstock_spb + $r->onstock_msk;
            }

            if (isset($r->discontinued) && $r->discontinued == '1') {
                return "<span style='color:red'>����� � ������������</span> " . $r->analogs;
            } elseif ($maxonstock > 0) {
                if ($r->onstock_spb > 0) {
                    array_push($resultArCity, $arCity["spb"]);
                }
                if ($r->onstock_msk > 0) {
                    array_push($resultArCity, $arCity["msk"]);
                }
                if (!empty($resultArCity)) {
                    return "<img src='/images/green_sq.gif'>  ���� �� ������: " . implode(", ", $resultArCity);
                } else {
                    return "<img src='/images/green_sq.gif'>  ���� �� ������";
                }

            } elseif (empty($r->parent)) {

                $sql = "SELECT * FROM `products_all` WHERE `parent`='$r->model' AND
                (`onstock_spb` > 0 OR `onstock_msk` > 0 )";
                $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
                if (mysqli_num_rows($res) > 0) {
                    return " <img src='/images/green_sq.gif'>  ���� �� ������";
                }
                return "<img src='/images/red_sq.gif'>  ��� �����";
            }
            break;
        /* case 2:
             echo "i ����� 1";
             break;*/
    }


    if ($mode == 1)
        $cl = "onstock"; // big letters
    if ($mode == 2)
        $cl = "onstock2"; // small letters
    if ($mode == 3)
        $cl = "onstock2"; // small letters and no "�� ������"

    if ($r->onstock_spb == 0 && $r->onstock_msk == 0 && $r->onstock_kiv == 0 && $r->onstock_ptg == 0) {
        $med = get_models_expected_date($r->model);
        $ifc320 = false;
        if (strpos($r->model, "320HDD") !== false) {
            $sql = "SELECT * FROM `products_all` WHERE `brand`='IFC' AND `diagonal`='$r->diagonal' AND
   (`onstock_spb` > 0 OR `onstock_msk` > 0 )";
            $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
            if (mysqli_num_rows($res) > 0)
                $ifc320 = true;  // there are same diagonals of IFC on stock we can install 320 HDD
        }


        if ($mode == 3) {
            if ($med == "") {
                if ($ifc320)
                    return "��� ����� $install_hdd_days ����";
                elseif ($r->discontinued == '1') {
                    return "<span style='color:red'>����� � ������������</span> ";
                } else {
                    return "��� ����� ";
                }
            }
            $med1 = remain_days($med);
            $med = stime("", $med);
            return "��������� ����� $med1 ����";
        }

        $line = '��� �����';
        if ($med == "") {
            if ($ifc320)
                return "<div class=$cl> <img src='/images/red_sq.gif' >&nbsp;&nbsp;&nbsp;��� ����� $install_hdd_days </div>";
            else
                return "<div class=$cl> <img src='/images/red_sq.gif' >&nbsp;&nbsp;&nbsp;$line </div>";
        }
        $med1 = remain_days($med);
        $med = stime("", $med);
        return "<div class=$cl title='$med'> <img src='/images/red_sq.gif' >&nbsp;&nbsp;&nbsp;��������� ����� $med1 ����</div>";
    }


    $co = 0;
    $out = "";
    $v = 0;
    if ($r->onstock_spb > 0) {
        $out .= "<span title='�����-���������' style='cursor:default;'>���</span>";
        $v = 1;
        $co++;
    }

    if ($r->onstock_msk > 0) {
        if ($v == 1) {
            $out .= ", ";
        }
        $out .= "<span title='������' style='cursor:default;'>���</span>";
        $v = 1;
        $co++;
    }
    /*
      if($r->onstock_kiv>0)
      {
      if($v==1) { $out.=", ";}
      $out.="<span title='����' style='cursor:default;'>����</span>";
      $co++;
      }
     */
    if ($r->onstock_ptg > 0) {
        if ($v == 1) {
            $out .= ", ";
        }
        $out .= "<span title='���������' style='cursor:default;'>����</span>";
        $co++;
    }


    if ($co == 1)
        $s = "�� ������:";
    else
        $s = "�� �������:";
    $out1 = "<div class=$cl> <img src='/images/green_sq.gif' >&nbsp;&nbsp;&nbsp $s  $out</div>";

    if ($mode == 3)
        $out1 = $out;
    return $out1;
}

function h()
{
    $var_array = explode("/", $_SERVER['REQUEST_URI']);

    $levels = count($var_array);
    $end_page = $levels - 1;

    if (($end_page == 2) and (strlen($var_array[$end_page]) > 1)) {
        $H = 'h1';
    } else {
        $H = 'h2';
    };
    return $H;
}

function get_coms($model)
{
    global $mysqli_db;
    database_connect();
    $query = "SELECT * FROM `com` WHERE `model` = '" . $model . "' ";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        for ($row = 0; $row < $rows; $row++) {
            $current_row = mysqli_fetch_assoc($result);
            $out[] = $current_row;
        }
    } else {
        $out = '';
    };
    return $out;
}

function show_panel1($num)
{
    $im = "/images";
    $altstr = "������������ ������, ��������� ������, HMI, Weintek, ���������,
���������������� ���������, ����������� ���������, �������, ��������� �������, ���������� ��,
EasyBuilder";
    $lts_file = $_SERVER['DOCUMENT_ROOT'] . '/sc/alts.php';

    global $mysqli_db;

    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_fetch_object($res);

    if ($r->diagonal_hide == 1) {
        $r->diagonal = 0;
    }
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
    if ($r->sdcard and $r->sdcard != "���")
        if (empty($inter)) {
            $inter .= "SD �����";
        } else {
            $inter .= ", SD �����";
        };
    if ($r->usb_host and $r->usb_host != "���")
        if (empty($inter)) {
            $inter .= "USB host";
        } else {
            $inter .= ", USB host";
        };
    if ($r->can_bus and $r->can_bus != "���")
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
        $poos = "��";
        $poos1 = $r->os;
    } else {
        $poos = "��";
        $poos1 = $r->software;
    }

    switch ($r->type) {
        case 'hmi':
            $type = "������ ���������";
            break;
        case 'panel_pc':
        case 'open_hmi':
            $type = "��������� ���������";
            break;
        case 'cloud_hmi':
            $type = "���������";
            break;
        case 'machine-tv-interface':
            $type = "��������� Machine-TV";
            break;
        case 'monitor':
            $type = "������������ �������";
            break;
        case 'Gateway':
            $type = "���� ������";
            break;
        case 'monitor_cloud_hmi':
            $type = "����� ��������� ����������";
            break;
        case 'controllers':
            $type = "����������";
            break;
        default:
            $type = "";
            break;
    }
    $easy_access_buildin = '';
    if ($r->easy_access == 'build_in') {
        $easy_access_buildin = '<tr bgcolor=#f1f1f1><td class=par_name11> �������� EasyAccess 2.0</td><td class=par_val11 colspan=3>����</td></tr>';
    }


    $alt = "$r->diagonal\" $r->model, " . get_kw("alt");
    if ($r->brand == "Weintek") {
        if (file_exists($lts_file)) {

            include($lts_file);
        };
    };
//$imm="$im/panel/$r->pic_small";

    //$imm = get_small_pic($r->model);

    if (empty($imm) or $imm === "/") {
        $imm = '/images/' . mb_strtolower($r->brand) . '/' . mb_strtolower($r->type) . '/' . $r->model . '/md/' . $r->model . '_1.png';
        $imm = get_path_190_picture($r->brand, $r->type, $r->model);
    }
    //echo $imm;

//$imm="/images/panel/$r->model/$r->model"."_2.png";
//pan_name11
//<tr height=5><td colspan=3> </td></tr>
    if (file_exists("../sc/new.php")) {
        include("../sc/new.php");
    } else {
        $class = '';
    };
    if (($r->diagonal == '') or ($r->diagonal == 0)) {
        $di = '';
    } else {
        $di = $r->diagonal . '&Prime;';
    };
    $out = "
 <div class='pan_sm_cont'>
 <table width=100%>
 <tr><td class=pan_price colspan=2 ><a href=/$fo/$r->model.php style='text-decoration: none;'>
 <h3 class='pan_price $class' style='cursor:pointer;'>$di &nbsp;$type $r->model </h3></a>
 <div class=hc11> &nbsp;</div> </td><td></td></tr>

 <tr>
 <td width='50%' class=price11 align=left height=180 valign=middle> <a class='pan_sm_cont_a_img'  href=/$fo/$r->model.php>
 <img src='$imm'  border=0 alt='$alt'></a>";

    $onst = show_stock($r, 2);

//<tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> ������ &nbsp &nbsp ������ ! </span> </td></tr>
    //<tr><td colspan=3>  &nbsp</td></tr>

    $bw = "90px";
    $tdw = "120px";
    // right column

    if (($r->retail_price != '0') and ($r->retail_price != '') and ($r->retail_price_hide == '0')) {

        $action_price = action_price($r->model);

        if (!empty($action_price)) {

            $priceb = "<td width=30> <span class='prpr old'>$r->retail_price</span><div class='prpr action' style='font-size:12px;' title='������� ��� ��������� � ���'>$action_price</div></td>
 <td><div class=val_name style='font-size:12px;'  title='������� ��� ��������� � ���'>USD </div></td>";
        } else {

            if ($r->currency === "RUR") {
                $priceb = "<td width=30> <div style='font-size:12px;' >$r->retail_price</div></td>
 <td><div style='font-size:12px;' >��� </div></td>";
            } else {
                $priceb = "<td width=30> <div class=prpr style='font-size:12px;' title='������� ��� ��������� � ���'>$r->retail_price</div></td>
                <td><div class=val_name style='font-size:12px;'  title='������� ��� ��������� � ���'>USD </div></td>";
            }

        };
    } else {
        $priceb = "
<td width=50 colspan='2' style='display: initial;
padding: 0px;
border: none;font-size:12px;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' ><div style='margin-top:1px;text-decoration:underline;color:#009b1e;'>��&nbsp;�������</div></td>
";
    };


    $out .= " </td><td  class=pan_price valign=top align=left>";
    if ($r->discontinued == '1') {
        $out .= '<table width=100%>
 <tr><td width=140>&nbsp </td><td width=40><div class=pan_price></div></td></tr>
 <tr><td colspan=3 height=20> &nbsp </td></tr>
 <tr><td colspan=3><div class="onstock2"> <img src="/images/red_sq.gif">&nbsp;&nbsp;&nbsp;����� � ������������ </div></td></tr>
 </table>';
    } else {
        $out .= "<table width=100%>
 <tr><td colspan=3 height=20> &nbsp </td></tr>
 <tr>

 <td width=30><div class=pan_price>����</div>
 </td>
 $priceb
 <td colspan=3> $onst </td>
 </tr>
 <tr></tr>
 </table>";
    }
    if ($r->discontinued == '1') {
        $out .= "<br><table>
 <tr height=50><td width=$tdw align=right></td>
     <td width=$tdw align=right>  <div class='zakazbut2' style='width:$bw;' idm='$r->model' onclick='show_compare(this)'><span>� ���������</span></div> </td>
 </tr><tr>
     <td width=$tdw align=rigth>   </td>
     <td width=$tdw align=right>   </td>
  </tr></table>
 </td>
    </tr></table>";
    } else {

        ob_start(); ?>
        <br>
        <table>
            <tr height=50>
                <? if (($r->retail_price != '0') and ($r->retail_price != '')) { ?>
                    <td width='<?= $tdw ?>' align=right>
                        <div class='addToCart btnStyleTypeWeintek' style='width:<?= $bw ?>' idm='<?= $r->model ?>'>
                            <span>� �������</span></div>
                    </td>
                    <?
                } else { ?>
                    <td width='<?= $tdw ?>' align=right>
                        <div class='disabled btnStyleTypeWeintek' style='width:<?= $bw ?>' idm='<?= $r->model ?>'><span>� �������</span>
                        </div>
                    </td>
                    <?
                } ?>
                <td width='<?= $tdw ?>' align=right>
                    <div class='zakazbut2' style='width:<?= $bw ?>' idm='<?= $r->model ?>' onclick='show_compare(this)'>
                        <span>� ���������</span></div>
                </td>
            </tr>
            <tr>
                <td width='<?= $tdw ?>' align=rigth>
                    <div class='zakazbut2' style='width:<?= $bw ?>' idm='<?= $r->model ?>'
                         onclick='show_backup_call(2, "<?= $r->model ?>")'><span>����� � 1 ����</span></div>
                </td>
                <td width='<?= $tdw ?>' align=right>
                    <div class='zakazbut2' style='width:<?= $bw ?>;' idm='<?= $r->model ?>'
                         onclick='show_backup_call(1, "<?= $r->model ?>")'><span>�������� ������</span></div>
                </td>
            </tr>
        </table>
        </td>
        </tr></table>
        <? $out .= ob_get_clean();

    }

    if ($r->colors == "")
        $r->colors = "-";
    if (!empty($r->text_preview)) {
        ob_start();
        ?>

        <div class=bor><?= $r->text_preview; ?></div>

        <?
        $ob_result = ob_get_contents();
        ob_end_clean();
        $out .= $ob_result;
    } else {
        $out .= "<div class=bor><table width=100% cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=90 >���������</td><td class=par_val11 width=70 >";

        if ($r->diagonal > 0) {
            $diagonal = $r->diagonal . "\"";
        } else {
            $diagonal = " - ";
        }
        $out .= $diagonal . "</td>
 <td class=par_name11 width=90>����������</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >���������</td><td class=par_val11>$r->colors</td>
 <td class=par_name11>$poos</td><td class=par_val11>$poos1</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> ����������</td><td class=par_val11 colspan=3>$inter</td></tr>

 $easy_access_buildin


 </table></div>
 </div>";
    }
    return $out;
}

function show_module($num)
{
    global $mysqli_db;
    $im = "/images";
    $altstr = "������ �����-������, EBM-A, IECON ��� PLC, ��������������� ���������� ������������ ����������, SCADA - ����������� ��������� ���� � �����������������";
    database_connect();
    $sql = "SELECT * FROM controllers WHERE `model` = '$num' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
    $r = mysqli_fetch_object($res);
    $fo = "modules";
    $alt = "$r->model, " . get_kw("alt");
    $out = "
 <div class=pan_sm_cont>
 <table width=100%>
 <tr><td class=pan_price colspan=2 ><h2 class=pan_price><a href='/$fo/$r->model.php'>������ �����-������ IECON $r->model </a></h2>
 <div class=hc11> &nbsp;</div> </td><td></td></tr>
 <tr>
 <td width=160 class=price11 align=left height=180 valign=middle> <a href='/$fo/$r->model.php'>
 <img src='$r->picture_preview' width=160 border=0 alt='$alt'></a>";

    if ($r->onstock_spb) {
        $onst = "<div class='onstock2'><img src='/images/green_sq.gif' >&nbsp;&nbsp;&nbsp ���� �� ������</div>";
    } else {
        $onst = "<div class='onstock2'><img src='/images/red_sq.gif' >&nbsp; ��� �����, ���� �������� 2-3 ���</div>";
    }


//<tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> ������ &nbsp &nbsp ������ ! </span> </td></tr>
    //<tr><td colspan=3>  &nbsp</td></tr>

    $bw = "90px";
    $tdw = "120px";
    // right column
    $out .= " </td><td  class=pan_price valign=top align=left>
 <table width=100%>
 <tr><td width=140>&nbsp </td>
 <td width=40><div class=pan_price>����</div></td>";
    if ($r->retail_price) {
        $out .= "
 <td width=50><div class='' style='font-size:12px;' ><b>$r->retail_price</b></div></td>
<td><div class=val_name style='font-size:12px;' >���</div></td>";
    } else {
        $out .= '
 <td colspan="2" style="display: initial;
padding: 0px;
border: none;font-size:12px;
background: none;" class="zakazbut" idm="IECON ' . $r->model . '" onclick="show_backup_call(6, &quot;IECON ' . $r->model . '&quot;)" width="50"><div style="margin-top:8px;"><b>��&nbsp;�������</b></div></td>
 ';
    }

    ob_start(); ?>
    </tr>
    <tr>
        <td colspan=3 height=20> &nbsp</td>
    </tr>
    <tr>
        <td colspan=3><?= $onst ?></td>
    </tr>
    </table>
    <br>

    <table>


        <tr height=50>
            <? if (!empty($r->retail_price)): ?>
                <td width="<?= $tdw ?>" align=right>
                    <div class='zakazbut2 addToCart' style="width:<?= $bw ?>" idm="<?= $r->model ?>">
                        <span>� �������</span></div>
                </td>
            <? else: ?>
                <td width="<?= $tdw ?>" align=right>
                    <div class='zakazbut2 disabled' style="width:<?= $bw ?>" idm="<?= $r->model ?>">
                        <span>� �������</span></div>
                </td>
            <? endif; ?>
            <td width="<?= $tdw ?>" align=right>
                <div class='zakazbut2' style="width:<?= $bw ?>" idm="<?= $r->model ?>" onclick='show_compare(this)'>
                    <span>� ���������</span></div>
            </td>
        </tr>


        <tr>
            <td width=<?= $tdw ?> align=rigth>
                <div class='zakazbut2' style="width:<?= $bw ?>" idm="<?= $r->model ?>"
                     onclick="show_backup_call(2, '<?= $r->model ?>')"><span>����� � 1 ����</span></div>
            </td>
            <td width=<?= $tdw ?> align=right>
                <div class='zakazbut2' style="width:<?= $bw ?>" idm="<?= $r->model ?>"
                     onclick="show_backup_call(1, '<?= $r->model ?>')"><span>�������� ������</span></div>
            </td>
        </tr>
    </table>

    </td>
    </tr></table>
    <? $out .= ob_get_clean();


    $out .= "<div class='text_preview'>$r->text_preview</div>
 </div>";

    return $out;
}

function show_panel1_old($num)
{
    $im = "/images";
    $altstr = "������������ ������, ��������� ������, HMI, Weintek, ���������,
���������������� ���������, ����������� ���������, �������, ��������� �������, ���������� ��,
EasyBuilder";

    global $mysqli_db;
    database_connect();


    $sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
    $res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

    $r = mysqli_fetch_object($res);


    $inter = $r->serial;
    if ($r->ethernet)
        $inter .= ", Ethernet";
    if ($r->sdcard)
        $inter .= ", SD �����";
    if ($r->usb_host)
        $inter .= ", USB host";


    echo "
 <div class=pan_sm_cont>
 <table width=300>
 <tr><td class=pan_name11 colspan=2 >$r->diagonal\" &nbsp;������ ��������� $r->model <div class=hc11> &nbsp;</div> </td><td></td></tr>
 <tr height=5><td colspan=3> </td></tr>
 <tr>
 <td width=160 class=price11 align=left> <a href=/weintek/" . $r->model . ".php><img src=$im/panel/$r->pic_small width=160 border=0 alt='$r->model, $altstr'></a>";

    //

    if ($r->onstock == 0)
        $onst = "<div class=pan_name11> <img src=$im/red_sq.gif >&nbsp;&nbsp;&nbsp;��� ����� 4 ���.</div>";
    else
        $onst = "<div class=pan_name11><img src=$im/green_sq.gif >&nbsp;&nbsp;&nbsp;���� �� ������</div>";


    echo " </td><td class=pan_price valign=top align=left>

 <table width=100%>
 <tr><td width=40>����</td><td width=40> <div class=prpr style='font-size:10px;' title='������� ��� ��������� � ���'>$r->retail_price</div></td>
 <td><div class=val_name style='font-size:10px;'  title='������� ��� ��������� � ���'>USD </div></td></tr>
 <tr height=30><td colspan=3 align=center ><span class=pan_name11 onclick='show_popup(\"popmes1\");' style='cursor:pointer; '> ������ &nbsp &nbsp ������ ! </span> </td></tr>
 <tr><td colspan=3>  &nbsp</td></tr>


 <tr><td colspan=3> $onst </td></tr>
 </table>
 <br>
 <div class='zakazbut' idm='$r->model' onclick='v_korzinu(this)'><span>� �������</span></div>

 </td>
 </tr></table>";

    echo "<div class=bor><table width=300 cellpadding=0 cellspacing=0 border=0>

 <tr bgcolor=#f1f1f1><td class=par_name11 width=70 >���������</td><td class=par_val11 width=70 >$r->diagonal\"</td>
 <td class=par_name11 width=70>����������</td><td class=par_val11>$r->resolution</td></tr>


 <tr><td class=par_name11 >���������</td><td class=par_val11>$r->colors</td>
 <td class=par_name11>��</td><td class=par_val11>$r->software</td></tr>

 <tr bgcolor=#f1f1f1><td class=par_name11> ����������</td><td class=par_val11 colspan=3>$inter</td></tr>


 </table></div>
 </div>";
}

function compare()
{
    echo "<div id=compare >
<br>
<span id=compare_h>��� ������ ���������:</span>
<br><br>
<div id='compare_body'> </div>


<div id='compare_message'> </div>

<div><span class='zakazbut com-block' onclick='window.location=\"/comparison.php\"'>��������</span> <span class=zakazbut onclick='hide_compare()'>�������</span></div>


</div>";
}


if (!function_exists('var_dump_pre')) {
    function var_dump_pre(...$values)
    {
        foreach ($values as $value) {
            echo "<pre style='font-size: 12px;color: red;max-width: 1000px;overflow: scroll;padding: 10px;text-align: left;'>";
            var_dump($value);
            echo "</pre>";
        }
    }
}
