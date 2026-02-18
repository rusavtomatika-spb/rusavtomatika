<?php


function search_by_words($arr_search_words)
{
    $arrResult = array();
    $arrIDs = array();
    
    $vesa_filter = isset($_GET['vesa']) && $_GET['vesa'] == 'yes';
    
    if ($vesa_filter && (empty($arr_search_words) || (count($arr_search_words) == 1 && $arr_search_words[0] == 'VESA'))) {
        return get_products_by_vesa_filter($arrIDs);
    }
    
    $arrResult1 = search_in_products_all_by_model($arr_search_words, $arrIDs);
    $arrResult2 = search_in_products_all_by_text_features($arr_search_words, $arrIDs);
    $arrResult = array_merge($arrResult1, $arrResult2);
    
    if ($vesa_filter) {
        $vesa_products = get_products_by_vesa_filter($arrIDs);
        $arrResult = array_merge($arrResult, $vesa_products);
    }
    
    usort($arrResult, "cmp_by_freqs");
    
    return $arrResult;
}

function get_products_by_vesa_filter(&$arrIDs)
{
    global $arr_catalog_types;
    $arrResult = array();
    
    $rows = CoreApplication::get_rows_from_table('products_all', "", "parent='' and status!='0' and brand!='Cincoze' and vesa='yes'");
    
    foreach ($rows as $product) {
        if (!(isset($arrIDs[$product['index']]) && $arrIDs[$product['index']] == true)) {
            
            if(isset($product["model_fullname"]) && $product["model_fullname"]!=""){
                $product['model_fullname'] = $product["model_fullname"];
            } elseif (isset($arr_catalog_types[$product['type'] . $product['series']])) {
                $name = $arr_catalog_types[$product['type'] . $product['series']];
                $name = str_replace("#brand#", $product['brand'], $name);
                $name = str_replace("#model#", $product['model'], $name);
                if (isset($product['diagonal']) && $product['diagonal'] > 0 && $product['diagonal_hide'] != '1') {
                    $name = str_replace("#diagonal#", $product['diagonal'], $name);
                } else {
                    $name = str_replace("#diagonal#", '', $name);
                }
                $product['model_fullname'] = $name;
            }
            
            $product['freqs'] = 500;
            
            $arrResult[] = $product;
            $arrIDs[$product['index']] = true;
        }
    }
    
    return $arrResult;
}

function search_by_words_texts($arr_search_words)
{
    $arrResult = array();
    $arrIDs = array();
    global $mysqli_db;
    $arrResult = array();
    if (isset($arr_search_words) and is_array($arr_search_words) and count($arr_search_words) > 0) {

        $counter = 0;

        foreach ($arr_search_words as $word) {
            $counter++;
            $word = mysqli_real_escape_string($mysqli_db, $word);

            if ($counter < 3) { // только первые две прямых фразы

                $rows_direct_match = CoreApplication::get_rows_from_table('search_texts_lemmatized', "", "(original_text like '%$word%')");

                if (count($rows_direct_match) > 0) {

                    foreach ($rows_direct_match as $article_ref) {
                        $arrIDs_current_id = $article_ref["table"] . $article_ref['article_id'];
                        if (!(isset($arrIDs[$arrIDs_current_id]) and $arrIDs[$arrIDs_current_id] == true)) {
                            //var_dump_pre($article_ref["table"]);
                            //getting article
                            if ($article_ref['table'] == 'search_static_pages_lemmatized') $selected_fields = "id,name,stext,link,img";
                            elseif ($article_ref['table'] == 'videos') $selected_fields = "id,name,date,text_preview,code,picture_preview";
                            else $selected_fields = "id,name,date,stext,sys_name,img";
                            $arr_article = CoreApplication::get_rows_from_table($article_ref['table'], $selected_fields, "`show`='1' and id='{$article_ref['article_id']}'");
                            if (is_array($arr_article) and count($arr_article) > 0) {
                                $article = $arr_article[0];
                                if ($article_ref['table'] == 'articles' || $article_ref['table'] == 'news') {
                                    $article['link'] = "/" . $article_ref['table'] . '/' . $article['sys_name'] . '/';
                                }
                                $article['word'] = $word;
                                $article['table'] = $article_ref['table'];
                                $article['freqs'] = 1000;
                                if ($arrIDs_current_id == 'news21') {
                                    $article['freqs'] = 5000;
                                }

                                $pos1 = strpos($article_ref["lemmas_statistics"], $word);
                                if ($pos1 !== false) {
                                    $pos2 = strpos($article_ref["lemmas_statistics"], "###", $pos1);
                                    $tmp = substr($article_ref["lemmas_statistics"], $pos1, $pos2 - $pos1);
                                    $stat_num = explode(" ", $tmp);
                                    if (isset($stat_num[1])) $article['freqs'] += $stat_num[1];
                                }


                                //getting article
                                if ($article_ref['table'] == 'videos') {
                                    $article['stext'] = $article['text_preview'];
                                    $article['img'] = $article['picture_preview'];
                                    $article['link'] = "/video/" . $article['code'] . "/";
                                }
                                $arrResult[] = $article;
                                //echo "-1- ".$product["model"]." ";
                                $arrIDs[$arrIDs_current_id] = true;
                            }
                        }
                    }
                }
            }
            $rows = CoreApplication::get_rows_from_table('search_texts_lemmatized', "", "(lemmas like '% $word %' or lemmas like '% $word.%' or lemmas like '$word%')");
            if (count($rows) > 0) {
                foreach ($rows as $article_ref) {
                    $arrIDs_current_id = $article_ref["table"] . $article_ref['article_id'];
                    if (!(isset($arrIDs[$arrIDs_current_id]) and $arrIDs[$arrIDs_current_id] == true)) {
                        $freqs = '';
                        if (isset($word) and $word != '') {
                            $pos1 = strpos($article_ref["lemmas_statistics"], $word);
                            if ($pos1 !== false) {
                                $pos2 = strpos($article_ref["lemmas_statistics"], "###", $pos1);
                                $tmp = substr($article_ref["lemmas_statistics"], $pos1, $pos2 - $pos1);
                                $stat_num = explode(" ", $tmp);
                                //$freqs = $stat_num[1];
                                    if (isset($stat_num[1])) $freqs = $stat_num[1];
                            }
                        }
                        //getting article
                        if ($article_ref['table'] == 'search_static_pages_lemmatized') $selected_fields = "id,name,stext,link,img";
                        elseif ($article_ref['table'] == 'videos') $selected_fields = "id,name,text_preview,code,picture_preview";
                        else $selected_fields = "id,name,date,stext,sys_name,img";

                        $arr_article = CoreApplication::get_rows_from_table($article_ref['table'], $selected_fields, "`show`='1' and id='{$article_ref['article_id']}'");
                        if (is_array($arr_article) and count($arr_article) > 0) {
                            $article = $arr_article[0];
                            if ($article_ref['table'] == 'articles' || $article_ref['table'] == 'news') {
                                $article['link'] = "/" . $article_ref['table'] . '/' . $article['sys_name'] . '/';
                            }
                            $article['word'] = $word;
                            $article['table'] = $article_ref['table'];
                            $article['freqs'] = $freqs;
                            //getting article
                            if ($article_ref['table'] == 'videos') {
                                $article['stext'] = $article['text_preview'];
                                $article['img'] = $article['picture_preview'];
                                $article['link'] = "/video/" . $article['code'] . "/";
                            }
                            $arrResult[] = $article;
                            //echo "-1- ".$product["model"]." ";
                            $arrIDs[$arrIDs_current_id] = true;
                        }
                    }
                }
            }
        }
    }


    usort($arrResult, "cmp_by_freqs");


    return $arrResult;
}

// SORTING
function cmp_by_freqs($a, $b)
{
    if ($a['freqs'] == $b['freqs']) {
        return 0;
    }
    return ($a['freqs'] > $b['freqs']) ? -1 : 1;
}


function search_in_products_all_by_model($arr_search_words, &$arrIDs)
{
    global $mysqli_db;
    global $arr_catalog_types;

    $arrResult = array();
    if (isset($arr_search_words) and is_array($arr_search_words) and count($arr_search_words) > 0) {
        foreach ($arr_search_words as $word) {
            if (strlen($word) < 2) continue;

            //echo "<br>model word: ".$word.": ";
            $word = mysqli_real_escape_string($mysqli_db, $word);
            $rows = CoreApplication::get_rows_from_table('products_all', "", " parent='' and status!='0' and brand!='Cincoze' and (model like '%$word%' or `model_fullname` like '%$word%')");
            if (count($rows) > 0) {
                foreach ($rows as $product) {
                    if (!(isset($arrIDs[$product['index']]) and $arrIDs[$product['index']] == true)) {

                        if(isset($product["model_fullname"]) and $product["model_fullname"]!=""){
                            $product['model_fullname'] = $product["model_fullname"];
                        }elseif (isset($arr_catalog_types[$product['type'] . $product['series']])) {
                            $name = $arr_catalog_types[$product['type'] . $product['series']];

                            $name = str_replace("#brand#", $product['brand'], $name);
                            $name = str_replace("#model#", $product['model'], $name);
                            if (isset($product['diagonal']) and $product['diagonal'] > 0 and $product['diagonal_hide'] != '1') {
                                $name = str_replace("#diagonal#", $product['diagonal'], $name);
                            } else {
                                $name = str_replace("#diagonal#", '', $name);
                            }
                            $product['model_fullname'] = $name;
                        }

                        $product['freqs'] = 0;

                        if (strtoupper($product['model']) == $word) {
                            $product['freqs'] += 1000;
                        } else
                            $product['freqs'] += 1;

                        if (strpos($product['model'], $word) !== false) {
                            $product['freqs'] += 50;
                        }
                        $arrResult[] = $product;
                        $arrIDs[$product['index']] = true;
                    }
                }
            }
        }

    }

    usort($arrResult, "cmp_by_freqs");

    return $arrResult;
}

function search_in_products_all_by_text_features($arr_search_words, &$arrIDs)
{

    global $mysqli_db;
    $arrResult = array();


    if (isset($arr_search_words) and is_array($arr_search_words) and count($arr_search_words) > 0) {
        $stop_words_for_products = CoreApplication::get_rows_from_table('search_index_stop_words_for_products', 'word', "active = 'Y'");
        $arr_stop_words_for_products = array();
        foreach ($stop_words_for_products as $word) {
            $arr_stop_words_for_products[] = strtoupper(trim($word["word"]));
        }
        //var_dump_pre($arr_stop_words_for_products);
        foreach ($arr_search_words as $word) {
            if (in_array($word, $arr_stop_words_for_products)) {
                //var_dump_pre($word);
                continue;
            }
            $word = mysqli_real_escape_string($mysqli_db, $word);
            $rows = CoreApplication::get_rows_from_table('products_all', "", "parent='' and status!='0' and brand!='Cincoze' and (`text_features` like '%$word%') order by `discontinued` asc");
            foreach ($rows as $product) {
                if (!(isset($arrIDs[$product['index']]) and $arrIDs[$product['index']] == true)) {
                    if (isset($arr_catalog_types[$product['type']])) {
                        $name = $arr_catalog_types[$product['type']];
                        $name = str_replace("#brand#", $product['brand'], $name);
                        $name = str_replace("#model#", $product['model'], $name);
                        if (isset($product['diagonal']) and $product['diagonal'] > 0 and $product['diagonal_hide'] != '1') {
                            $name = str_replace("#diagonal#", $product['diagonal'], $name);
                        } else {
                            $name = str_replace("#diagonal#", '', $name);
                        }
                        $product['model_fullname'] = $name;

                    }
                    $str_text_features = strtoupper(strip_tags($product['text_features']));
                    $str_text_features = str_replace('\n', " ", $str_text_features);
                    $str_text_features = preg_replace('/[\s]{2,}/', ' ', $str_text_features);
                    $arr_text_features = explode(" ", $str_text_features);

                    if (!isset($product['freqs'])) {
                        $product['freqs'] = 0;
                    }

                    $search_word = strtoupper($word);
                    $num_words = count(explode(" ", $word));

                    if (in_array($search_word, $arr_text_features)) {
                        $product['freqs'] += 10 * $num_words;

                    }

                    if (isset($search_word) and $search_word != '') {
                        $pos1 = strpos($str_text_features, $search_word);
                        if ($pos1 !== false) {
                            $product['freqs'] += 20 * $num_words;
                        }
                    }

                    $arrResult[] = $product;
                    //echo "-2- ".$product["model"]." ";
                    $arrIDs[$product['index']] = true;
                }
            }
        }
    }
//    usort($arrResult, "cmp_by_freqs");
    return $arrResult;
}


function search_string_to_array($search_text)
{
    $arSearch_text = array();
    //var_dump(iconv("utf-8", "windows-1251", $_GET["search"]));


    $search_text = strtoupper($search_text);
    $search_text = preg_replace('|[\s]+|s', ' ', $search_text);//eliminate repititive space

    $search_text2 = switcher($search_text, 2);

    $arSearch_text0[] = $search_text;
    $arSearch_text2[] = $search_text2;

    //$arSearch_text = array_merge((array)$arSearch_text0,(array)$arSearch_text, (array)$arSearch_text2);
    $arSearch_text = array_merge((array)$arSearch_text0, (array)$arSearch_text2);
    $search_text_exploded = explode(" ", $search_text);
    $arSearch_text = array_merge((array)$arSearch_text, (array)$search_text_exploded);
    $search_text2_exploded = explode(" ", $search_text2);
    $arSearch_text = array_merge((array)$arSearch_text, (array)$search_text2_exploded);
    if (count($search_text_exploded) == 2) {
        $arSearch_text = array_merge((array)(str_replace(" ", "-", $arSearch_text)), (array)$arSearch_text);
        $arSearch_text = array_merge((array)(str_replace(" ", "", $arSearch_text)), (array)$arSearch_text);
    }
    $text_without_hyphen = str_replace("-", "", $search_text);
    //$text_without_hyphen2 = str_replace("-", " ", $search_text);
    $text_without_hyphen2 = $search_text;
    if ($text_without_hyphen != $search_text) $arSearch_text[] = $text_without_hyphen;
    if ($text_without_hyphen2 != $search_text) {
        $words = explode(" ", $text_without_hyphen2);
        foreach ($words as $word) {
            $arSearch_text[] = $word;
        }
    }
    return $arSearch_text;

}


////////////////////////////////////////////////////////////////////////////////
// Меняет раскладку текста с русской на латинскую
function switchTextToEnglish($text)
{
    $str_search = array(
        "й", "ц", "у", "к", "е", "н", "г", "ш", "щ", "з", "х", "ъ",
        "ф", "ы", "в", "а", "п", "р", "о", "л", "д", "ж", "э",
        "я", "ч", "с", "м", "и", "т", "ь", "б", "ю",
        "Й", "Ц", "У", "К", "Е", "Н", "Г", "Ш", "Щ", "З", "Х", "Ъ",
        "Ф", "Ы", "В", "А", "П", "Р", "О", "Л", "Д", "Ж", "Э",
        "Я", "Ч", "С", "М", "И", "Т", "Ь", "Б", "Ю"
    );

    $str_replace = array(
        "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "[", "]",
        "a", "s", "d", "f", "g", "h", "j", "k", "l", ";", "'",
        "z", "x", "c", "v", "b", "n", "m", ",", ".",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "[", "]",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", ";", "'",
        "Z", "X", "C", "V", "B", "N", "M", ",", "."
    );
    return str_replace($str_search, $str_replace, $text);
}

//* Меняет раскладку текста с латинской на русскую

function switchTextToRussian($text)
{
    $str_search = array(
        "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "[", "]",
        "a", "s", "d", "f", "g", "h", "j", "k", "l", ";", "'",
        "z", "x", "c", "v", "b", "n", "m", ",", ".",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "[", "]",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", ";", "'",
        "Z", "X", "C", "V", "B", "N", "M", ",", "."
    );

    $str_replace = array(
        "й", "ц", "у", "к", "е", "н", "г", "ш", "щ", "з", "х", "ъ",
        "ф", "ы", "в", "а", "п", "р", "о", "л", "д", "ж", "э",
        "я", "ч", "с", "м", "и", "т", "ь", "б", "ю",
        "Й", "Ц", "У", "К", "Е", "Н", "Г", "Ш", "Щ", "З", "Х", "Ъ",
        "Ф", "Ы", "В", "А", "П", "Р", "О", "Л", "Д", "Ж", "Э",
        "Я", "Ч", "С", "М", "И", "Т", "Ь", "Б", "Ю"
    );

    return str_replace($str_search, $str_replace, $text);
}

function switcher($text, $arrow = 0)
{

    if (!$text)
        return '';
    $str[0] = array('й' => 'q', 'ц' => 'w', 'у' => 'e', 'к' => 'r', 'е' => 't',
        'н' => 'y', 'г' => 'u', 'ш' => 'i', 'щ' => 'o', 'з' => 'p', 'х' => '[',
        'ъ' => ']', 'ф' => 'a', 'ы' => 's', 'в' => 'd', 'а' => 'f', 'п' => 'g',
        'р' => 'h', 'о' => 'j', 'л' => 'k', 'д' => 'l', 'ж' => ';', 'э' => '\'',
        'я' => 'z', 'ч' => 'x', 'с' => 'c', 'м' => 'v', 'и' => 'b', 'т' => 'n',
        'ь' => 'm', 'б' => ',', 'ю' => '.', 'Й' => 'Q', 'Ц' => 'W', 'У' => 'E',
        'К' => 'R', 'Е' => 'T', 'Н' => 'Y', 'Г' => 'U', 'Ш' => 'I', 'Щ' => 'O',
        'З' => 'P', 'Х' => '[', 'Ъ' => ']', 'Ф' => 'A', 'Ы' => 'S', 'В' => 'D',
        'А' => 'F', 'П' => 'G', 'Р' => 'H', 'О' => 'J', 'Л' => 'K', 'Д' => 'L',
        'Ж' => ';', 'Э' => '\'', '?' => 'Z', 'Ч' => 'X', 'С' => 'C', 'М' => 'V',
        'И' => 'B', 'Т' => 'N', 'Ь' => 'M', 'Б' => ',', 'Ю' => '.',
    );
    $str[1] = array('q' => 'й', 'w' => 'ц', 'e' => 'у', 'r' => 'к', 't' => 'е',
        'y' => 'н', 'u' => 'г', 'i' => 'ш', 'o' => 'щ', 'p' => 'з', '[' => 'х',
        ']' => 'ъ', 'a' => 'ф', 's' => 'ы', 'd' => 'в', 'f' => 'а', 'g' => 'п',
        'h' => 'р', 'j' => 'о', 'k' => 'л', 'l' => 'д', ';' => 'ж', '\'' => 'э',
        'z' => 'я', 'x' => 'ч', 'c' => 'с', 'v' => 'м', 'b' => 'и', 'n' => 'т',
        'm' => 'ь', ',' => 'б', '.' => 'ю', 'Q' => 'Й', 'W' => 'Ц', 'E' => 'У',
        'R' => 'К', 'T' => 'Е', 'Y' => 'Н', 'U' => 'Г', 'I' => 'Ш', 'O' => 'Щ',
        'P' => 'З', '[' => 'Х', ']' => 'Ъ', 'A' => 'Ф', 'S' => 'Ы', 'D' => 'В',
        'F' => 'А', 'G' => 'П', 'H' => 'Р', 'J' => 'О', 'K' => 'Л', 'L' => 'Д',
        ';' => 'Ж', '\'' => 'Э', 'Z' => '?', 'X' => 'ч', 'C' => 'С', 'V' => 'М',
        'B' => 'И', 'N' => 'Т', 'M' => 'Ь', ',' => 'Б', '.' => 'Ю',
    );
    $result = isset($str[$arrow]) ? $str[$arrow] : array_merge($str[0], $str[1]);

    $result = strtr($text, $result);
    return $result;
}

