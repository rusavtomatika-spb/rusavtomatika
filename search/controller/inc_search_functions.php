<?php

///SELECT *, MATCH (text) AGAINST ('"USB камера"' IN BOOLEAN MODE) as REL FROM `search_index_pages` WHERE MATCH (text) AGAINST ('"USB камера"' IN BOOLEAN MODE) ORDER BY REL

function check_on_stop_words_for_products($word)
{
    global $mysqli_db;
    $query = "SELECT * FROM `search_index_stop_words_for_products` "
        . "where `word` = '$word' and `active` = 'Y';";
    if ($result = mysqli_query($mysqli_db, $query)) {
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}

function do_fulltext_search($arWords)
{
    $arWords = array_unique($arWords);
    $texts = array();

    foreach ($arWords as $text) {
        $collect_string = array();
        $arTinyWords = explode(" ", $text);
        foreach ($arTinyWords as $tinyWord) {
            $tinyWord = lemmatize($tinyWord);
            //$collect_string[] = "+".$tinyWord[0]."*";  
            $collect_string[] = "\"" . $tinyWord[0] . "\"";
        }
        $string = implode(" ", $collect_string);
        $texts[] = $string;
    }
    return get_fulltext_urls($texts);
}

function do_search($arWords)
{
    $arWords = array_unique($arWords);

    $arrURLs = array();
    $arrURLsByTAG = array();

////////////////////////////////////////////////////////////////////////////////
    $arrURLsByFulltextSearch = do_fulltext_search($arWords);

////////////////////////////////////////////////////////////////////////////////  
    foreach ($arWords as $text) {
        $arTextForSearchByTAG[0] = $text;
        $arTextForSearchByTAG[1] = "";
        $arrURLsByTAG = array_merge((array)$arrURLsByTAG, (array)get_urls_by_tag($arTextForSearchByTAG));

        $text = preg_replace("/[^a-zA-ZА-Яа-я0-9\-\s]/", "", $text);
        $text = mb_strtoupper($text, 'windows-1251');
        $text = lemmatize($text);
        if (strlen($text[0]) > 1) {
            $wordIDs = get_word_id($text[0]);
        }
        if (isset($wordIDs) and is_array($wordIDs)) {
            $get_urls = (array)get_urls($wordIDs);

            $arrURLs = array_merge((array)$arrURLs, $get_urls);


//            foreach ($wordIDs as $word_id) {
//                if ($word_id > 0) {
//                    $get_urls = (array) get_urls($word_id);
//                    if (isset($frequency[$word_id]))
//                        $frequency[$word_id] ++;
//                    else {
//                        $frequency[$word_id] = 1;
//                    }
//                    $arrURLs = array_merge((array) $arrURLs, $get_urls);
//                }
//            }
        }

    }

    if (count($arrURLsByFulltextSearch) > 0) {
        $arrProductURLs = array();
        if (!check_on_stop_words_for_products($arWords[0])) {
            foreach ($arrURLs as $url) {
                if (isset($url["product_identifier"]) and $url["product_identifier"]) {
                    $arrProductURLs[] = $url;
                }
            }
        }
        $arrURLs = array_merge((array)$arrURLsByTAG, (array)$arrProductURLs, (array)$arrURLsByFulltextSearch);
    } else {

        $arrURLs = array_merge((array)$arrURLsByTAG, (array)$arrURLs);
    }

    foreach ($arrURLs as &$url) {
        $url['text'] = '';
        $url[8] = '';
    }

    $arrURLs = array_map('unserialize', array_unique(array_map('serialize', $arrURLs)));
// making unique without ["word_in_titles"]
    $arrURLs_tmp = array();
    foreach ($arrURLs as $url) {
        if (isset($arrURLs_tmp[$url["id"]])) {
            if (isset($url["word_in_titles"])) {
                if (!isset($arrURLs_tmp[$url["id"]]["word_in_titles"])) $arrURLs_tmp[$url["id"]]["word_in_titles"] = 0;
                $arrURLs_tmp[$url["id"]]["word_in_titles"] += $url["word_in_titles"];
            }
        } else {
            $arrURLs_tmp[$url["id"]] = $url;
            $arrURLs_tmp2[] = $url;
        }
    }
    if (isset($arrURLs_tmp2) and is_array($arrURLs_tmp2) and count($arrURLs_tmp2) > 0) {
        $arrURLs = $arrURLs_tmp2;
    }

    echo "<table class='table_search_results'><colgroup><col width='1%'><col width='60%'></colgroup>";
    $counter = 0;
    foreach ($arrURLs as $url) {
        $url_for_link = str_replace("www.rusavtomatika.com", $_SERVER["HTTP_HOST"], $url["url_original"]);
        if (isset($url["product_identifier"])) {
            $product_info = get_product_info($url["product_table"], $url["product_identifier"]);
        }

        $counter++;
        if ($url["preview_image"]) {
            $picture = '<span class="picture" style="background-image:url(\'' . $url["preview_image"] . '\')"></span>';
        } else {
            $picture = '';
        }

        if (isset($product_info) and is_array($product_info)) {
            ?>
            <tr>
                <td><?= $counter ?></td>
                <td>
                    <a target='_blank' href='<?= $url_for_link ?>'>
                        <?= $picture ?>
                        <div class='h1'><?= $url["h1"] ?></div>
                        <div class='link'><?= $url["url_original"] ?>
                        </div>
                    </a>
                </td>
                <td style="vertical-align: middle;text-align: right;">

                    <? if ($product_info["price"] > 0 and $product_info["price_hide"] != "1") {
                        if ($product_info["currency"] == "USD") {
                            ?>
                            <span class='price'>
                                            ЦЕНА: <span class='prpr'><?= $product_info["price"] ?></span>
                                            <span class='val_name'>USD</span>                            
                                        </span>
                            <?
                        } elseif ($product_info["currency"] == "RUR") {
                            ?>
                            <span class='price' style="padding-right: 19px;">
                                            ЦЕНА: <b style="font-size:15px;"><?= $product_info["price"] ?></b>
                                            <span style="font-size:15px;">РУБ</span>                            
                                        </span>
                            <?
                        }
                    } else {
                        ?><span class='no_price'
                                onclick="show_backup_call(6, '&quot;<?= $url['product_identifier'] ?>&quot;')">
                        <?
                        echo "Цена по запросу";
                        ?></span><? }
                    ?>

                    <? if ($product_info["onstock"] > 0): ?>
                        <span class='onstock' idm="<?= $url["product_identifier"] ?>"
                              onclick="show_backup_call(2, &quot;<?= $url['product_identifier'] ?> &quot; )">Товар в наличии</span>
                    <?
                    else:
                        ?><span  class='onstock' idm="<?= $url["product_identifier"] ?>"
                                 onclick="show_backup_call(2, &quot;<?= $url['product_identifier'] ?> &quot; )">
                            Под заказ</span><? endif; ?>

                </td>
            </tr>
            <?
        } else {
            echo '<tr><td>' . $counter . "</td>"
                . "<td colspan='2'>"
                . "<a target='_blank' href='" . $url_for_link . "'>"
                . $picture
                . "<div class='h1'>" . $url["h1"] . "</div>"
                . "<div class='link'>" . $url["url_original"]
                . '</div>'
                . '</a>'
                . '</td></tr>';
        }
    }
    echo "</table>";
    return $counter;
}

function get_urls_by_tag($tagText)
{
    $out = array();
    global $mysqli_db;
    $condition = "tags rlike ',(" . $tagText[0] . "),' ";
    if ($tagText[1] != "") {
        $condition .= " or tags rlike ',(" . $tagText[1] . "),'";
    }
//    $condition = "tags rlike '[[:<:]] ".$tagText[0]."[[:>:]]' ";
//    if ($tagText[1] != ""){
//        $condition .= " or tags rlike '[[:<:]]".$tagText[1]."[[:>:]]'";
//    }

    $query = "SELECT * FROM `search_index_tags` where $condition ORDER BY `weight` DESC;";

    try {
        if ($result = mysqli_query($mysqli_db, $query)) {
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {
                return array();
            }
            while ($row = mysqli_fetch_array($result)) {

                $url = get_url_info($row["url"]);

                if (is_array($url)) {
                    $out[] = $url;
                } else {

                }
            }
        }
    } catch (Exception $exc) {
        return array();
    }

    return $out;
}

function get_fulltext_urls($arPhrases)
{
    $out = array();
    $condition = "";
    global $mysqli_db;
    if (count($arPhrases) > 0) {
        foreach ($arPhrases as $phrase) {
            if (strlen($phrase) < 5)
                continue;
            $is_stop_word = false;
            $is_stop_word = check_on_stop_words_for_products(trim($phrase, "\""));
            $chars = ['\\', '/', "'"];
            $phrase = str_replace($chars, '', $phrase);

            $query = "SELECT *, MATCH (text) AGAINST ('" . $phrase . "' IN BOOLEAN MODE) as "
                . "REL FROM `search_index_pages` WHERE MATCH (text) AGAINST ('" . $phrase . "' 
               IN BOOLEAN MODE) ORDER BY REL, weight DESC;";
            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));

            if (mysqli_num_rows($result) == 0) {
                continue;
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $url = get_url_info($row["id"]);
                if (!(isset($url["product_table"]) and $url["product_table"] != '' and $is_stop_word)) {
                    $url[8] = '';
                    $url["text"] = '';
                    $out[] = $url;
                }
            }

            return $out;
        }
    } else {
        return array();
    }

    return $out;
}

function get_urls($arWordIDs)
{
    global $mysqli_db;
    $condition = "";
    $out_products = array();
    $out_others = array();
    $out = array();
    if (count($arWordIDs) > 0) {
        foreach ($arWordIDs as $word) {
            $wordID = $word[0];
            $is_stop_word = false;
            $is_stop_word = check_on_stop_words_for_products($word[1]);
            $query = "SELECT * FROM `search_index_index` where  word_id = '$wordID' ORDER BY  `word_in_titles` DESC, `weight` DESC,`word_counter` DESC;";
            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $url = get_url_info($row["page_id"]);
                    $url['word_in_titles'] = $row["word_in_titles"];
//                    echo "<div>";
//                    var_dump($row);
//                    echo "</div>";

                    if ((isset($url["product_table"]) and $url["product_table"] != '')) {
                        if (!$is_stop_word) {
                            $out_products[] = $url;
                        }
                    } else {
                        $out_others[] = $url;
                    }
                }
            }
        }
    } else {
        return array();
    }

    foreach ($out_products as $key => $val) {
        $out_products_tmp[$val['word_in_titles']][] = $key;
    }
    if (isset($out_products_tmp) and is_array($out_products_tmp)) {
        krsort($out_products_tmp);
        $out_products_tmp2 = array();
        foreach ($out_products_tmp as $key => $val) {
            foreach ($val as $val2) {
                //echo "$key $val2<br>";
                $out_products_tmp2[] = $out_products[$val2];
            }
        }
        if (is_array($out_products_tmp2)) {
            $out_products = $out_products_tmp2;
        }
    }
    $out = array_merge((array)$out_products, (array)$out_others);
    //$out = array_map("unserialize", array_unique(array_map("serialize", $out)));

//    echo "<pre>";
//    var_dump($out);
//    echo "</pre>";
    return $out;
}

function get_url($page_id)
{
    global $mysqli_db;
    $query = "SELECT * FROM `search_index_pages` where `id` = '$page_id';";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    if (mysqli_num_rows($result) == 0) {
        return FALSE;
    }
    return mysqli_fetch_array($result)["url"];
}

function get_url_info($page_id)
{
    global $mysqli_db;
    if (is_numeric($page_id)) {
        $query = "SELECT * FROM `search_index_pages` where `id` = '$page_id';";
    } else {
        $query = "SELECT * FROM `search_index_pages` where `url` = '$page_id' or `url_original` = '$page_id';";
    }

    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    if (mysqli_num_rows($result) == 0) {
        return FALSE;
    }
    $out = mysqli_fetch_array($result);

    return $out;
}

function get_word_id($word)
{
    global $mysqli_db;
    $out = array();
    $query = "SELECT * FROM `search_index_words` "
        . "where `word` = '$word'; ";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    while ($row = mysqli_fetch_array($result)) {
        if ($row["id"] > 0)
            $out[] = [$row["id"], $word];
    }
    $query = "SELECT * FROM `search_index_words` "
        . "where `word` like '$word%' and `word` != '$word' and `word` NOT LIKE '%$word';";

    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    while ($row = mysqli_fetch_array($result)) {
        if ($row["id"] > 0)
            $out[] = [$row["id"], $word];
    }
    $query = "SELECT * FROM `search_index_words` "
        . "where `word` like '%$word' and `word` not like '$word%' and `word` != '$word';";

    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    while ($row = mysqli_fetch_array($result)) {
        if ($row["id"] > 0)
            $out[] = [$row["id"], $word];
    }
    $query = "SELECT * FROM `search_index_words` "
        . "where `word` like '%$word%' and `word` not like '%$word' and `word` not like '$word%' and `word` != '$word';";

    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    while ($row = mysqli_fetch_array($result)) {
        if ($row["id"] > 0)
            $out[] = [$row["id"], $word];
    }
    return $out;
}

function save_statistics($text)
{
    global $mysqli_db;
    $out = array();
    $geo_city = '';

    try {
        if ($_SERVER['REMOTE_ADDR']) {
            $url = "http://www.geoplugin.net/json.gp?ip=" . $_SERVER['REMOTE_ADDR'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            curl_close($ch);

            $ip_data = json_decode($data);
            if ($ip_data && isset($ip_data->geoplugin_countryName) && $ip_data->geoplugin_countryName != null) {
                $geo_country = $ip_data->geoplugin_countryName;
                $geo_city = str_replace("'" , '' , $ip_data->geoplugin_city);


                $geo_latitude = $ip_data->geoplugin_latitude;
                $geo_longitude = $ip_data->geoplugin_longitude;
            }
        }
        $chars = ['\\', '/', "'"];
        $text = str_replace($chars, '', $text);
        $query = "INSERT INTO `search_statistics` (`id`, `text`, `date`, `time`, `REMOTE_ADDR`, `city`) "
            . "VALUES (NULL, '$text', CURRENT_TIMESTAMP, '" . date("H:i:s") . "', '{$_SERVER['REMOTE_ADDR']}','$geo_city');";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    } catch (Exception $e) {    }
}
