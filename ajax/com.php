<?

@header("Content-Type: text/html; charset=utf-8");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $out = $lines = '';
    if ($_POST['type'] != '') {


        $new_arr = $_POST;

        $type = strip_tags($new_arr['type']);
        $full = strip_tags($new_arr['full']);
        $diagonal = strip_tags($new_arr['diagonal']);



        if ($full == 1) {
            $what = '*';
        } else {
            $what = "`index`";
        };


        if ((!empty($page)) AND ( is_numeric($page)) AND ( $page != '0')) {
            $LIMIT = 'LIMIT ' . ((10 * ($page - 1))) . ',10';
        } else {
            if ($full == 1) {
                $LIMIT = 'LIMIT 0,10';
            } else {
                $LIMIT = '';
            };
        };

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php")) {

            define("bullshit", 1);
            include($_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php");



            global $mysqli_db;
            database_connect();
            mysqli_query($mysqli_db, "SET NAMES 'cp1251'");
            /*
              if ((!empty($page)) AND (is_numeric($page)) AND ($page != '0') AND ($full == 1))  {
              $LIMIT = 'LIMIT '.((10*($page-1))).',10';
              } else {
              if ($full == 1) {$LIMIT ='LIMIT 0,10';} else {
              $LIMIT ='';};
              };
             */
            $LIMIT = '';
            if (is_numeric($type)) {
                if ($type == '0') {
                    $ty[] = 'hmi';
                    $ty[] = 'cloud_hmi';
                    $ty[] = 'machine-tv-interface';
                    $ty[] = 'open_hmi';
                };
                if ($type == '1') {
                    $ty[] = 'panel_pc';
                };
                if ($type == '2') {
                    $ty[] = 'box-pc';
                };
                if ($type == '3') {
                    $ty[] = 'monitor';
                };
                if ($type == '4') {
                    $ty[] = 'vpn-router';
                };
                $where[] = "`type` IN ('" . implode("', '", $ty) . "')";
            };

            $type_to_change = array(
                'hmi' => 'панель оператора', 'cloud_hmi' => 'облачный интерфейс', 'machine-tv-interface' => 'интерфейс с HDMI', 'open_hmi' => 'панель оператора', 'panel_pc' => 'панельный компьютер', 'box-pc' => 'встраиваемый компьютер', 'monitor' => 'монитор', 'vpn-router' => 'vpn-роутер'
            );

            if ($diagonal != '') {
                if (preg_match('/-/', $diagonal)) {
                    $di = explode('-', $diagonal);
                    $min_di = $di[0] - 1;
                    $where[] = "`diagonal` > '" . $min_di . "'";
                    $max_di = $di[1] + 1;
                    $where[] = "`diagonal` < '" . $max_di . "'";
                } else {
                    $min_di = $diagonal - 1;
                    $where[] = "`diagonal` > '" . $min_di . "'";
                    $max_di = $diagonal + 1;
                    $where[] = "`diagonal` < '" . $max_di . "'";
                };
            };
            $whe = implode(' AND ', $where);
            if (!empty($whe)) {
                $whe = 'AND ' . $whe;
            };

            function huwmuch($whe) {
                global $mysqli_db;
                $query = "SELECT `index` FROM `products_all` WHERE (`show_in_cat`='1'  {$whe} );";
                $query = str_replace("\'", "'", $query);

                $result = mysqli_query($mysqli_db, $query) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
                $j  = mysqli_num_rows($result);


                return $j;
            }

            $j0 = huwmuch($whe);

            if ($j0 > 10) {

                if (empty($page)) {
                    $activ_page = 1;
                } else {
                    $activ_page = $page;
                };

                $pages = ceil($j0 / 10);
                $p = '';
                for ($i = 1; $i <= $pages; $i++) {

                    if ($i == $activ_page) {
                        $p .= '<span class="page">' . $i . '</span>';
                    } else {

                        $p .= '<span class="page href">' . $i . '</span>';
                    };
                };

                $pageline = '<div id="pageline">' . $p . '</div>';
            } else {
                $pageline = '<div id="pageline"></div>';
            };

            $query = "SELECT {$what} FROM `products_all` WHERE (`show_in_cat`='1' {$whe} ) ORDER BY `diagonal` DESC {$LIMIT};";
            $query = str_replace("\'", "'", $query);


            $query_resultA = mysqli_query($mysqli_db, $query) or die("file: ".__FILE__." line: ".__LINE__." error: ".mysqli_error($mysqli_db));
            $jA = mysqli_num_rows($query_resultA);

            if ($full == 1) {


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
                    return $re;
                }

                function compare0() {
                    return '<div class=compare >
<br>
<span class=compare_h>Сравнить:</span>
<br><br>
<div class=compare_body> </div>


<div class=compare_message> </div>
<br><br>
<a href="/comparison.php" class="zakazbut" >Сравнить</a> <span class=zakazbut onclick="hide_compare()">Закрыть</span>


</div>';
                }

                global $path_to_real_files;
                $APATH = 'http://www.rusavtomatika.com';
                $path_to_real_files = $APATH . "/upload_files";

                if (preg_match("/weblec/i", $_SERVER['DOCUMENT_ROOT'])) {
                    $APATH = '/home/weblec/public_html/rusavtomatika.com';
                    $WTPATH = '/home/weblec/public_html/rusavtomatika.com/upload_files';
                    $net = 0;
                } elseif (preg_match("/olgaglr/i", $_SERVER['DOCUMENT_ROOT'])) {
                    $APATH = '/home/o/olgaglr/rusavto.olgaglr.tmweb.ru/public_html';
                    $WTPATH = '/home/o/olgaglr/rusavto.olgaglr.tmweb.ru/public_html/upload_files';
                    $net = 1;
                }

                function params($rowA) {
                    $params = array();
                    if ((!empty($rowA["touch_type"])) AND ( $rowA["touch_type"] != '0')) {
                        if (preg_match('/resistive/i', $rowA["touch_type"])) {
                            $params[] = 'Резистивный сенсор';
                        };

                        if (preg_match('/capacitive/i', $rowA["touch_type"])) {
                            $params[] = 'Емкостной сенсор (мультитач)';
                        };
                    };



                    if ((!empty($rowA["resolution"])) AND ( $rowA["resolution"] != '0')) {

                        $params[] = $rowA["resolution"];
                    };
                    /*
                      if ((!empty($rowA[touch])) AND ($rowA[touch] != '0')) {$params[] = $rowA[touch];};
                     */
                    if ((!empty($rowA["backlight"])) AND ( $rowA["backlight"] != '0')) {
                        $params[] = $rowA["backlight"];
                    };
                    if ((!empty($rowA["colors"])) AND ( $rowA["colors"] != '0')) {
                        $params[] = $rowA["colors"] . ' цветов';
                    };

                    if ((!empty($rowA["cpu_type"])) AND ( $rowA["cpu_type"] != '0')) {
                        if ((!empty($rowA["cpu_speed"])) AND ( $rowA["cpu_speed"] != '0')) {
                            $params[] = 'процессор ' . $rowA["cpu_type"] . ' ' . $rowA["cpu_speed"] . ' ГГц';
                        } else {
                            $params[] = 'процессор ' . $rowA["cpu_type"];
                        };
                    };
                    if ((!empty($rowA["hdd_type"])) AND ( $rowA["hdd_type"] != '0')) {
                        $par = $rowA["hdd_type"];
                        if ((!empty($rowA["hdd_size_gb"])) AND ( $rowA["hdd_size_gb"] != '0')) {
                            $par .= ' ' . $rowA["hdd_size_gb"] . 'Гб';
                        };
                        $params[] = $par;
                    };
                    if ((!empty($rowA["chipset"])) AND ( $rowA["chipset"] != '0')) {
                        $params[] = $rowA["chipset"];
                    };
                    if ((!empty($rowA["ram_type"])) AND ( $rowA["ram_type"] != '0')) {
                        $par = $rowA["ram_type"];

                        if ((!empty($rowA["ram"])) AND ( $rowA["ram"] != '0')) {
                            $par .= ' ' . $rowA["ram"] . ' Мб';
                        };
                        if ((!empty($rowA["ram_max"])) AND ( $rowA["ram_max"] != '0')) {
                            $par .= ' (max — ' . $rowA["ram_max"] . ' Мб)';
                        };
                        $params[] = $par;
                    };
                    if ((!empty($rowA["flash"])) AND ( $rowA["flash"] != '0')) {
                        $params[] = $rowA["flash"] . ' Мб';
                    };
                    if ((!empty($rowA["serial_full"])) AND ( $rowA["serial_full"] != '0')) {
                        $params[] = $rowA["serial_full"];
                    };
                    if ((!empty($rowA["usb_host"])) AND ( $rowA["usb_host"] != '0')) {
                        $params[] = $rowA["usb_host"];
                    };
                    if ((!empty($rowA["ethernet"])) AND ( $rowA["ethernet"] != '0')) {
                        if ($rowA["ethernet"] != 'есть') {
                            $params[] = $rowA["ethernet"];
                        } else {
                            $params[] = 'ethernet';
                        };
                    };

                    if ((!empty($rowA["vga_port"])) AND ( $rowA["vga_port"] != '0')) {
                        $params[] = $rowA["vga_port"];
                    };
                    if ((!empty($rowA["dvi_port"])) AND ( $rowA["dvi_port"] != '0')) {
                        $params[] = $rowA["dvi_port"];
                    };

                    if ((!empty($rowA["sdcard"])) AND ( $rowA["sdcard"] != '0')) {
                        if ($rowA["sdcard"] == 'есть') {
                            $params[] = 'SD-слот';
                        } else {
                            $params[] = $rowA["sdcard"];
                        };
                    };

                    if ((!empty($rowA["sim"])) AND ( $rowA["sim"] != '0')) {
                        if ($rowA["sim"] == 'outside') {
                            $params[] = 'слот sim-карты с внешней стороны корпуса';
                        } elseif ($rowA["sim"] == 'inside') {
                            $params[] = 'слот sim-карты внутри корпуса';
                        } else {
                            $params[] = $rowA["sim"];
                        };
                    };

                    if ((!empty($rowA["pci"])) AND ( $rowA["pci"] != '0')) {
                        $params[] = $rowA["pci"];
                    };

                    if ((!empty($rowA["mpci"])) AND ( $rowA["mpci"] != '0')) {
                        $params[] = $rowA["mpci"];
                    };

                    if ((!empty($rowA["audio"])) AND ( $rowA["audio"] != '0')) {
                        $params[] = $rowA["audio"];
                    };
                    if ((!empty($rowA["os"])) AND ( $rowA["os"] != '0')) {


                        $params[] = 'возможна установка: ' . $rowA["os"];
                    };


                    if ((!empty($rowA["software"])) AND ( $rowA["software"] != '0')) {
                        if ($rowA["brand"] == 'Weintek') {
                            $params[] = 'бесплатное ПО от Weintek: ' . $rowA["software"];
                        } else {
                            $params[] = $rowA["software"];
                        };
                    };
                    if ((!empty($rowA["dimensions"])) AND ( $rowA["dimensions"] != '0')) {
                        $params[] = $rowA["dimensions"];
                    };
                    if ((!empty($rowA["vesa75"])) AND ( $rowA["vesa75"] != '0')) {
                        $params[] = 'vesa75';
                    };
                    if ((!empty($rowA["vesa100"])) AND ( $rowA["vesa100"] != '0')) {
                        $params[] = 'vesa100';
                    };

                    return implode(", ", $params);
                }

                if ($jA > 0) {
                    if ($jA < 6) {
                        $h = '170';
                    } else {
                        $h = '370';
                    };
                    $lines .= '<div id="pagescontain" style="width:1130px;height:' . $h . 'px;">';
                };
                for ($iA = 0; $iA < $jA; $iA++) {
                    $rowA = mysqli_fetch_assoc($query_resultA);
                    $model = $rowA["model"];
                    if (preg_match('/\//', $model)) {
                        $model = str_replace('/', '-', $model);
                    }
                    $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["brand"]) . '/' . $model . '/sm/' . $model . '_1.png');
                    $ipath = '';
                    if (isset($re[1]) && $re[1] > 0) {
                            $ipath = '/images/' . strtolower($rowA["brand"]) . '/' . $model . '/sm/' . $model . '_1.png';
                    } else {
                        $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["type"]) . '/' . $model . '/sm/' . $model . '_1.png');
                        if (isset($re[1]) && $re[1] > 0) {
                            $ipath = '/images/' . strtolower($rowA["type"]) . '/' . $model . '/sm/' . $model . '_1.png';
                        }else{
                            $ipath = "/images/" . mb_strtolower($rowA["brand"]) . "/" . mb_strtolower($rowA["type"]) . "/" . $rowA["model"] . "/sm/" . $rowA["model"] . "_1.png";
                        };
                    };

                    if (($ipath == '' ) AND ( (preg_match('/ARCHMI/i', $rowA["model"])) AND ( !preg_match('/P$/i', $rowA["model"])))) {
                        $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["brand"]) . '/' . $model . 'P/sm/' . $model . 'P_1.png');
                        $ipath = '';
                        if (isset($re[1]) && $re[1] > 0) {
                            $ipath = '/images/' . strtolower($rowA["brand"]) . '/' . $model . 'P/sm/' . $model . 'P_1.png';
                        } else {
                            $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["type"]) . '/' . $model . 'P/sm/' . $model . 'P_1.png');
                            if ($re[1] > 0) {

                                $ipath = '/images/' . strtolower($rowA["type"]) . '/' . $model . 'P/sm/' . $model . 'P_1.png';
                            };
                        };
                    };

                    if (( $rowA['parent'] != '')) {
                        $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["brand"]) . '/' . $rowA['parent'] . '/sm/' . $rowA['parent'] . '_1.png');
                        $ipath = '';
                        if (isset($re[0]) && $re[0] > 0) {

                            $ipath = '/images/' . strtolower($rowA["brand"]) . '/' . $rowA['parent'] . '/sm/' . $rowA['parent'] . '_1.png';
                        } else {

                            $re = cu($GLOBALS["path_to_real_files"] . '/images/' . strtolower($rowA["type"]) . '/' . $rowA['parent'] . '/sm/' . $rowA['parent'] . '_1.png');
                            if (isset($re[0]) && $re[0] > 0) {

                                $ipath = '/images/' . strtolower($rowA["type"]) . '/' . $rowA['parent'] . '/sm/' . $rowA['parent'] . '_1.png';
                            }else{
                                $ipath = "/images/" . mb_strtolower($rowA["brand"]) . "/" . mb_strtolower($rowA["type"]) . "/" . $rowA['parent'] . "/sm/" . $rowA['parent'] . "_1.png";
                            };
                        };
                    };

                    if ($rowA['brand'] == 'APLEX') {
                        $parent = 'panelnie-computery/aplex/';
                    } elseif ($rowA['brand'] == 'IFC') {
                        if ($rowA['type'] == 'panel_pc') {
                            $parent = 'panelnie-computery/ifc/';
                        } elseif ($rowA['type'] == 'monitor') {
                            $parent = 'monitors/';
                        } elseif ($rowA['type'] == 'box-pc') {
                            $parent = 'box-pc/';
                        };
                    } else {
                        $parent = strtolower($rowA['brand']);
                        if ($parent != '') {
                            $parent = $parent . '/';
                        };
                    };

                    $row1 = $rowA;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/inc/new.php")) {
                        include($_SERVER['DOCUMENT_ROOT'] . "/inc/new.php");
                    } else {
                        $class = 'no';
                    };
                    $sstock = array();
                    if (($rowA["onstock_spb"] > '0')) {
                        $sstock[] = "<span title='Санкт-Петербург' style='cursor:default;'>СПБ</span>";
                    };
                    if (($rowA["onstock_msk"] > '0')) {
                        $sstock[] = "<span title='Москва' style='cursor:default;'>МСК</span>";
                    };

                    /*
                      if (($rowA[onstock_kiv] > '0')) {$sstock[] = "<span title='Киев' style='cursor:default;'>КИЕВ</span>";};
                     */
                    if (!empty($sstock)) {
                        $stts = '<span style="color: rgb(0, 202, 0);">&#10004; на складе</span>';
                    } else {
                        if ($rowA["discontinued"] != '1') {
                            $stts = 'под заказ';
                        } else {
                            $stts = '';
                        }
                    };

                    $compare1 = '<div style="font-size: 12px;" idm="' . $rowA["model"] . '" onclick="show_compare1(this)"><p><input type="checkbox">В сравнение</p></div>';
                    $im = '<div class="item-image"><a href="/' . $parent . $model . '.php"><img src="' . $ipath . '"></a></div>';
//if ($iA > 9) {$disp = '';} else {$disp = '';};
                    if ($iA == 0) {
                        $lines .= '<div class="localpage">';
                    } elseif (fmod($iA, 10) == 0) {
                        $lines .= '</div><div class="localpage" style="display:none;">';
                    };


ob_start();?>

<div class="line">
    <div class="left-line">
        <a href="/<?=$parent . $model?>.php">
        <img style="width:50px;height:38px;" src="<?=$ipath?>">
    </a>
</div>

<div class="stocks"><?=$stts?></div>
<div class="show-info">?
    <div class="stext" style="">
        <p>
            <div class="info" style="text-align: justify;"><?=params($rowA)?></div>
        </p>
    </div>
</div>

<a class="tit" href="/<?=$parent . $model?>.php">
    <h2 class="<?=$class?>"><?=$rowA["model"]?> <?=$rowA["diagonal"]?> &#8243;</h2>
    <?=$type_to_change[$rowA["type"]]?>
</a>

<div class="bottom-line">
    <?if($rowA["retail_price"] > 0 && $rowA["retail_price_hide"] != 1 && $rowA["series"] != 'cMT-X' && $rowA["series"] != 'cMT'):?>
    <div class="line-price">
        <p>Цена:
            <span class="prpr" title="Нажмите для пересчета в рубли"><?=$rowA["retail_price"]?></span>
            <span class="val_name" title="Нажмите для пересчета в РУБ"> USD </span>
        </p>
    </div>
    <?endif;?>

    <?=$compare1?>
</div>


<br /></div>

<?$lines .= ob_get_clean();

                };

                if ($jA > 0) {
                    $lines .= '</div></div>';
                };
                if (($lines == '') AND ( $full == 1)) {
                    $pageline = '';
                    $lines .= '<div style="width:100%;color:red;height:30px;">По выбранным параметрам ничего не найдено.</div><div style="display:none">' . $whe . '</div>';
                } else {
                    $pageline .= "<div id='closebut'><img src='/images/up.png'></div><div id='res-t' style='float:right;'><!--a href='/advanced_search.php'>
<span id='full' style=''>расширенный поиск »</span></a-->
</div>";
                };


//$out = iconv('windows-1251','UTF-8',$query.$whe.$lines.$pageline);
                $out = iconv('windows-1251', 'UTF-8', $lines . $pageline);
            } else {

//$out .= ''.$j.''.$whe;
                $out .= $jA;
            };
        } else {
            $out .= iconv('windows-1251', 'UTF-8', 'Соединение с базой невозможно');
        };
    } else {
        $out .= iconv('windows-1251', 'UTF-8', 'Выберите вид продукции');
    };


    if (empty($out)) {
        $out = '0';
    };
    echo $out;
} else {
    echo 'error';
};
?>
