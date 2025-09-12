<?

@header("Content-Type: text/html; charset=utf-8");
//@header("Content-Type: text/html; charset=windows-1251");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

$page = $whe = $to_h = $full = $types = $out = $ssylka = '';
$do_not_add_titles = $do_not_add_titles = false;


//    data: "types="+b+"&min_price="+min-price+"&max_price="+max-price+"&min_diagonal="+min-diagonal+"&max_diagonal="+max-diagonal+"&resolution="+re+"&usb="+usb+"&usb_number="+usb-number+"&com="+com+"&com_number="+com-number+"&ethernet="+ethernet+"&ethernet_number="+ethernet-number+"&sd="+sd+"&audio="+audio+"&mic="+mic+"&pc2="+pc2+"&vga="+vga+"&dvi="+dvi+"&ebp="+ebp+"&eb8="+eb8+"&w7="+w7+"&wxp="+wxp+"&wce="+wce+"&hdd="+hdd+"&hdd_size="+hdd-size+"&ssd="+ssd+"&ssd_size="+ssd-size+"&ddr3="+ddr3+"&ddr3_size="+ddr3-size+"&flash="+flash+"&flash_size="+flash-size+"&cores="+core+"&min_width="+min-width+"&max_width="+max-width+"&min_height="+min-height+"&max_height="+max-height+"&min_thickness="+min-thickness+"&max_thickness="+max-thickness+"&full="+full+"&ua="+au+"&cool="+cool+"&vase75="+vesa75+"&vesa100="+vesa100+"&din="+din+"&case1="+case1+"&case2="+case2+"&ip65="+ip65,
    $new_arr = $_POST;
    $file = $_SERVER['DOCUMENT_ROOT'] . "/sc/advanced_params.php";
    if (file_exists($file)) {
        include $file;
    };
    /*     * *********************** */
    $title_changed = false;

    /*     * ***************************************************************************** */

    if (isset($new_arr["cores"]) and $new_arr["cores"] != '') {
        $title_changed = true;
        $title_prepend_cores  = ", процессор";
    }
    if (isset($new_arr["temp_min"])) {
        $title_changed = true;
        $title_prepend_temp_min = ", отрицательные температуры";
    }
    if (
        (isset($new_arr["vesa75"]) and $new_arr["vesa75"] > 0)
        or (isset($new_arr["vesa100"]) and $new_arr["vesa100"]  > 0)
        or (isset($new_arr["din"]) and $new_arr["din"]  > 0)
        or (isset($new_arr["panel_mount"]) and $new_arr["panel_mount"]  > 0)
    ) {
        $title_changed = true;
        $title_prepend_mount = ", крепление";
    }
        if ($new_arr["brand"]) {
        $title_changed = true;
        $brands = str_replace("'", "", $new_arr["brand"]);
        $brands = str_replace(",", ", ", $brands);
        $title_prepend_brands = $brands;
    } else {
//$title_changed = true;
//$title_prepend_brands = "Weintek, IFC, Aplex, Samkoon";
    }

    if (count($ty) > 0) {
        foreach ($ty as $key => $value) {
            switch ($value) {
                case "hmi":
                    $filtered_types["hmi"] = "панель оператора";
                    $title_changed = true;
                    break;
                case "panel_pc":
                    $filtered_types["panel_pc"] = "панельный компьютер";
                    $title_changed = true;
                    break;
                case "box-pc":
                    $filtered_types["box-pc"] = "встраиваемый компьютер";
                    $title_changed = true;
                    break;
                case "monitor":
                    $filtered_types["monitor"] = "промышленный монитор";
                    $title_changed = true;
                    break;
                case "cloud_hmi":
                    $filtered_types["cloud_hmi"] = "облачный интефейс";
                    $title_changed = true;
                    break;
                case "Gateway":
                    $filtered_types["Gateway"] = "Шлюз данных";
                    $title_changed = true;
                    break;
                case "machine-tv-interface":
                    $filtered_types["machine-tv-interface"] = "интефейс MACHINE-TV";
                    $title_changed = true;
                    break;
                default:
                    break;
            }

//$title_prepend_types .= $value . ", ";
        }
    }
    foreach ($filtered_types as $value) {
        $title_prepend_types .= $value . ", ";
    }
    if ($title_prepend_brands && $title_prepend_types) {
        $title_prepend_types = ", " . $title_prepend_types;
    }
    $title_prepend_types = rtrim($title_prepend_types, ", ");
    //echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!" . iconv('windows-1251', 'UTF-8', '<pre>!!!' . print_r($ty) . '!!!</pre>');


    if (isset($new_arr["min_diagonal"])) {
        $title_min_diagonal = intval($new_arr["min_diagonal"]);
    }
    if (($title_prepend_brands || $title_prepend_types) && $title_min_diagonal) {
        $title_min_diagonal = ", от " . $title_min_diagonal . "&Prime;";
    } elseif ($title_min_diagonal) {
        $title_min_diagonal = "От " . $title_min_diagonal . "&Prime;";
    } else {
        $title_min_diagonal = "";
    }

    if (isset($new_arr["max_diagonal"])) {
        $title_max_diagonal = intval($new_arr["max_diagonal"]);
    }
    if (($title_prepend_brands || $title_prepend_types || $min_diagonal) && $title_max_diagonal > 0) {
        $title_max_diagonal = ", до " . $title_max_diagonal . "&Prime;";
    } elseif ($title_min_diagonal > 0) {
        $title_max_diagonal = "До " . $title_max_diagonal . "&Prime;";
    } else {
        $title_max_diagonal = "";
    }



    if ($title_changed) {
        $TITLE = $title_prepend_brands . $title_prepend_types . $title_min_diagonal . $title_max_diagonal. $title_prepend_temp_min.$title_prepend_mount. $title_prepend_cores;
        $TITLE = trim($TITLE,", ");
        $H1 .= $title_prepend_brands;
        $H1 .= " " . $title_prepend_types . $title_min_diagonal . $title_max_diagonal. $title_prepend_temp_min.$title_prepend_mount. $title_prepend_cores;
        $H1 = trim($H1,", ");
    }

    /*
      if ($title_changed) {
      $advanced_search__title_h1 = '<div class="advanced-search__title-h1">Подбор устройств по параметрам</div>';
      $advanced_search__title_h2 = '<div class="advanced-search__title-h2">Выбраны параметры:</div>';
      $h1_all_together = '<div class="advanced-search__h1-wrapper">' . $advanced_search__title_h2 . '<h1>' . $H1 . '</h1></div>';
      } else {
      $h1_changed = 'Weintek, IFC, Aplex, Samkoon — расширенный поиск, подбор по параметрам';
      } */



    /*     * ***************************************************************************** */



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
        database_connect();



        function huwmuch($whe) {
            global $mysqli_db;
            $query = "SELECT `index` FROM `products_all` WHERE ((`discontinued`<>'1') AND (`modification`<>'1') AND `show_in_cat`='1' AND `brand` IN ('Weintek','Samkoon','IFC','Aplex') AND (`type`<>'ex_module') {$whe} );";
            $query = str_replace("\'", "'", $query);
            $result = mysqli_query($mysqli_db,$query) or die("error0" . $query);
            $j = mysqli_num_rows($result);
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
            if ($page > $pages) {
                $page = $pages;
                $activ_page = $page;
            };
            $p = '';
            for ($i = 1; $i <= $pages; $i++) {

                if ($i == $activ_page) {
                    $p .= '<span class="page">' . $i . '</span>';
                } else {

                    $p .= '<span class="page href" onclick="page(\'' . $i . '\')" >' . $i . '</span>';
                };
            };

            $pageline = '<div id="pageline">Страницы: ' . $p . '</div>';
        } else {
            if ($page > 1) {
                $page = 1;
                $activ_page = 1;
            };
            $pageline = '<div id="pageline"></div>';
        };
        if ($page > 1) {
            $to_h[0] = 'page=' . $page;
        };
        if (is_array($to_h))  $href = implode('&', $to_h);
        if (!empty($href)) {

            $site = str_replace("www.", "", $_SERVER['SERVER_NAME']);
            $link = '//www.' . $site . '/advanced_search.php?' . $href;
            $ssylka = '<div id="bottom_href">Ссылка на эту страницу: <a href="' . $link . '">' . $link . '</a></div>';


//$ssylka = '<div id="bottom_href">Ссылка на эту страницу: <a href="//www.' . $_SERVER['SERVER_NAME'] . '/advanced_search.php?' . $href . '">//' . $_SERVER['SERVER_NAME'] . '/advanced_search.php?' . $href . '</a></div>';
        };

        if ((!empty($page)) AND ( is_numeric($page)) AND ( $page != '0') AND ( $full == 1)) {
            $LIMIT = 'LIMIT ' . ((10 * ($page - 1))) . ',10';
        } else {
            if ($full == 1) {
                $LIMIT = 'LIMIT 0,10';
            } else {
                $LIMIT = '';
            };
        };
        switch ($types) {
            case "0":
                $extraorder = " FIELD(`brand`, 'Weintek','APLEX','IFC','Samkoon')  ASC,";
                break;
            case "1":
                $extraorder = " FIELD(`brand`, 'APLEX','IFC','Weintek')  ASC,";
                break;
            case "2":
                $extraorder = " FIELD(`brand`, 'APLEX','IFC','Weintek')  ASC,";
                break;
            default:
                if ($types == "") {
                    $extraorder = " FIELD(`brand`,'Weintek','IFC','Samkoon', 'APLEX') ASC,";
                } else
                    $extraorder = " FIELD(`brand`,'Weintek','IFC', 'Samkoon', 'APLEX') ASC,";
                break;
        }
        $query = "SELECT {$what} FROM `products_all` WHERE ((`discontinued`<>'1') AND (`modification`<>'1') AND `show_in_cat`='1' AND `brand` IN ('Weintek','Samkoon','IFC','Aplex') AND (`type`<>'ex_module') {$whe} ) ORDER BY {$extraorder} `view_order` ASC, `diagonal` ASC, `retail_price` ASC {$LIMIT};";
        $query = str_replace("\'", "'", $query);
        global $mysqli_db;
        $query_resultA = mysqli_query($mysqli_db,$query) or die("error" . $query);
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
                return '<div id=compare >
<br>
<span id=compare_h>Сравнить:</span>
<br><br>
<div id=compare_body> </div>


<div id=compare_message> </div>
<br><br>
<a href="/comparison.php" class="zakazbut" >Сравнить</a> <span class=zakazbut onclick="hide_compare()">Закрыть</span>


</div>';
            }

            global $APATH;
            global $root_php;

            if (preg_match("/weblec/i", $_SERVER['DOCUMENT_ROOT'])) {
                $APATH = '/home/weblec/public_html/rusavtomatika.com';

                global $net;
                $net = 0;
                $root_php = $APATH . '/upload_files/';
            } else {
                global $net;

                $APATH = '';
                $root_php = '//www.rusavtomatika.com/upload_files';


                $net = 1;
            };

            global $path_to_real_files;
            if (preg_match("/weblec/i", $_SERVER['DOCUMENT_ROOT'])) {
                $path_to_real_files = $APATH . "/upload_files";
            } else {
                $path_to_real_files = '//www.rusavtomatika.com/upload_files';
            };

            $file = $_SERVER['DOCUMENT_ROOT'] . "/sc/advanced_full.php";
            if (file_exists($file)) {
                include $file;
            };



            if (($lines == '') AND ( $full == 1)) {
                $pageline = '';
                $lines .= '<div style="width:100%;color:red;height:30px;">По выбранным параметрам ничего не найдено.</div>';
            };


//$out = iconv('windows-1251','UTF-8',$query.$whe.$lines.$pageline);
            $out = iconv('windows-1251', 'UTF-8', '<div id="lines">' . $lines . '</div>' . $pageline . $ssylka);
            /*  ?><pre><? var_dump($new_arr) ?></pre><? */
        } else {

//$out .= ''.$j.''.$whe;
            $do_not_add_titles = true;
            $out .= $jA;
        };
        /////////////////////////////
    } else {
        $out .= iconv('windows-1251', 'UTF-8', 'Соединение с базой невозможно');
    };

    if (empty($out)) {
        $out = '0';
    };
    if ((!$do_not_add_titles) && $title_changed) {
        $out .= iconv('windows-1251', 'UTF-8', '<div style="display:none" id="new_h1" >' . $H1 . '</div>');
        $out .= iconv('windows-1251', 'UTF-8', '<div style="display:none" id="new_title" >' . $H1 . '</div>');
    }
    if ((!$do_not_add_titles) && !$title_changed) {
        $out .= iconv('windows-1251', 'UTF-8', '<div style="display:none" id="new_h1_reset" >new_h1_reset</div>');
    }

    echo $out;
} else {
    echo 'error';
};
?>