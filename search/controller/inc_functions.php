<?php

if (!defined('MAIN_FILE_EXECUTED'))
    die();
/* * *************************************************************************** */


require_once($_SERVER['DOCUMENT_ROOT'] . '/search/simplehtmldom/simple_html_dom.php');

$PhpMorphy_rootFolder = $_SERVER['DOCUMENT_ROOT'] . "/sc/phpmorphy";
require_once($PhpMorphy_rootFolder . '/src/common.php');
$dir = $PhpMorphy_rootFolder . '/dicts';
// �������, ��� ������ ����� ����� ������������ �������.
// ���� ����������� ��� ISO3166 ��� ������ � ISO639 ��� �����, 
// ����������� �������� ������������� (ru_RU, uk_UA, en_EN, de_DE � �.�.) 
$lang = 'ru_RU';
$langEN = 'en_EN';
// ������� �����
// ������ �������������� ����� ��. ����
$opts = array(
    'storage' => PHPMORPHY_STORAGE_FILE,
);
// ������� ��������� ������ phpMorphy
// �������� ��������: ��� ������� phpMorphy �������� throwable �.�. 
// ����� ���������� ���������� ���� phpMorphy_Exception (����������� ����)   
try {
    global $phpmorphy;
    global $phpmorphyEN;
    $phpmorphy = new phpMorphy($dir, $lang, $opts);
    $phpmorphyEN = new phpMorphy($dir, $langEN, $opts);
} catch (phpMorphy_Exception $e) {
    die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
}

function lemmatize($word)
{
    global $arExcludeWords;
    if (in_array($word, $arExcludeWords)) {
        $lemmas[0] = $word;
        $lemmas[1] = $word;
        return $lemmas;
    }
    $word = str_ireplace('�', '�', $word);
    global $phpmorphy;
    global $phpmorphyEN;
    // ��������� ������� ����� ����� //
    $lemmas = $phpmorphy->lemmatize($word);
    if (!isset($lemmas[0])) {
        $lemmas = $phpmorphyEN->lemmatize($word);
    }
    if (!isset($lemmas[0])) {
        $lemmas[0] = $word;
    }
    $lemmas[1] = $word;
    return $lemmas;
}

/* * *************************************************************************** */

function search_index__save_url_to_xmlfile($url, $filename)
{

    if ($url == "") {
        return false;
    }

    $url = str_replace(
        "rusavto.moisait.net/",
        "rusavtomatika.com/",
        $url);

    if ($sitemap = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . "/$filename")) {
        foreach ($sitemap->url as $item) {
            if ($item->loc == $url) {
                return false;
            }
        }
        $xmlSitemapDocument = $sitemap;
        $newChildUrl = $xmlSitemapDocument->addChild('url');
        $newChildUrl->addChild('loc', $url);
        $newChildUrl->addChild('lastmod', '2019-02-21');
        $newChildUrl->addChild('changefreq', 'monthly');
        $newChildUrl->addChild('priority', '0.9');
        $xmlSitemapDocument->saveXML($_SERVER['DOCUMENT_ROOT'] . "/$filename");
    }
}

function search_index__add_page($url, $url_original, $add_url_to_xml = false)
{

    $url = str_replace("rusavto.moisait.net/", "rusavtomatika.com/", $url);
    $url_original = str_replace("rusavto.moisait.net/", "rusavtomatika.com/", $url_original);

    if ($add_url_to_xml)
        search_index__save_url_to_xmlfile($url_original, '/search/assets/sitemap3.xml');

    $url_original_developers_site = str_replace(
        "rusavtomatika.com/",
        "rusavto.moisait.net/",
        $url_original);

    if ($page_content = getRemoteContentByURL($url_original_developers_site)) {
        /**/
        $page_content = str_replace('>', '> ', $page_content);
        $html = iconv("windows-1251", "UTF-8", $page_content);

        $html = str_get_html($html);

        if (is_a($html, 'simple_html_dom')) {
            try {
                $html_found = $html->find("meta[name='keywords']");
                $first_element = array_shift($html_found);
                $keywords = $first_element->content;
                if (mb_detect_encoding($keywords) == "UTF-8")
                    $text = iconv("UTF-8", "windows-1251", $keywords);
                else {
                    $text = $keywords;
                }
                // echo "Keywords:---" . $text . "--- <br>";
                $keywords = $text;
            } catch (Exception $e) {
                echo 'Exception: ', $e->getMessage(), "\n";
            }


            foreach ($html->find('nav') as &$element) {
                $element->innertext = "";
            }
            $exist_article = false;
            $h1 = "";// finding h1
            foreach ($html->find('h1') as $element) {
                try {
                    if (mb_detect_encoding($element->plaintext) == "UTF-8")
                        $text = iconv("UTF-8", "windows-1251", $element->plaintext);
                    else {
                        $text = $element->plaintext;
                    }
                    echo "H1:---" . $text . "--- <br>";
                    $exist_h1 = true;
                    $h1 = $text;
                } catch (Exception $e) {
                    echo 'Exception: ', $e->getMessage(), "\n";
                }
            }

            foreach ($html->find('title') as $element) {
                try {
                    if (mb_detect_encoding($element->plaintext) == "UTF-8")
                        $text = iconv("UTF-8", "windows-1251", $element->plaintext);
                    else {
                        $text = $element->plaintext;
                    }
                    echo "title:---" . $text . "--- <br>";
                    $title = $text;
                } catch (Exception $e) {
                    echo 'Exception: ', $e->getMessage(), "\n";
                }
            }

            foreach ($html->find('article') as $element) {
                try {
                    if (mb_detect_encoding($element->plaintext) == "UTF-8") {
                        $text = iconv("UTF-8", "windows-1251", $element->plaintext);
                        echo "article:---" . $text . "--- <br>";
                    } else {
                        $text = $element->plaintext;
                        echo "article:---" . $text . "--- <br>";
                    }
                    //echo $text;
                    $exist_article = true;
                } catch (Exception $e) {
                    echo 'Exception: ', $e->getMessage(), "\n";
                }
            }
            if (!$exist_article) {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/search/file.txt', $url_original . "\n", FILE_APPEND);

            }
            if (!$exist_article) {
                foreach ($html->find('table[class=MAIN_TABLE]') as $element) {
                    try {
                        if (mb_detect_encoding($element->plaintext) == "UTF-8")
                            $text = iconv("UTF-8", "windows-1251", $element->plaintext);
                        else {
                            $text = $element->plaintext;
                        }
                        //echo $text;
                        $MAIN_TABLE_article = true;
                    } catch (Exception $e) {
                        echo 'Exception: ', $e->getMessage(), "\n";
                    }
                }
            }
        }

        /* nosearch */
        $tag_nosearch = true;
        while ($tag_nosearch) {
            $posSearchBegining = strpos($page_content, "<!-- nosearch -->");
            if ($posSearchBegining !== FALSE) {
                $posSearchEnding = strrpos($page_content, "<!-- /nosearch -->");
                if ($posSearchEnding !== FALSE) {
                    if ($posSearchBegining < $posSearchEnding) {
                        $point1 = $posSearchBegining + 18;
                        $point2 = 18 + $posSearchEnding;
                        $length = strlen($page_content);
                        //$test = substr($page_content, $posSearchBegining, 18+ $posSearchEnding - $posSearchBegining);
                        $part1 = substr($page_content, 0, $point1);
                        $part2 = substr($page_content, $point2, $length - $point1);
                        $page_content = $part1 . $part2;
                    }
                } else {
                    $tag_nosearch = FALSE;
                }
            } else {
                $tag_nosearch = FALSE;
            }
        }

        preg_match('/<h1[^>]*?>(.*?)<\/h1>/si', $page_content, $matches);
        $h1 = $matches[1];
        $search_index_pages_id = search_index__add_url_to_database($url, $url_original, "search_index_pages", $h1);

        $page_content = str_replace('>', '> ', $page_content);
        $page_content = preg_replace('#<style.+?</style>#is', ' ', $page_content);
        $page_content = preg_replace('~style="[^"]*"~i', '', $page_content);


        search_index__add_words_to_database($search_index_pages_id, $page_content, $title, $keywords, $h1);

        return $search_index_pages_id;
    } else {
        echo "�� ������� �������� ������� �� ����� URL ($url_original_developers_site) !!!";
        return false;
    }
}

function search_index__get_weight_from_weight_map($url)
{
    global $db;
    global $mysqli_db;
    database_connect();

    if (isset($mysqli_db)) $db = $mysqli_db;

    $query = "SELECT * FROM search_index_weight_map WHERE '$url' like `url` ORDER BY position DESC;";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db) . "__FILE__:" . __FILE__ . " __LINE__:" . __LINE__);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        return $row['weight'];
    } else {
        return 1;
    }
}

function search_index__add_url_to_database(
    $url, $url_original, $table_name = "search_index_pages", $h1 = "", $product_table = "", $preview_image = ""
)
{


    global $db;
    global $mysqli_db;
    database_connect();
    if (isset($mysqli_db) and $mysqli_db != NULL) $db = $mysqli_db;
    $url = strtolower($url);
    //$url =  htmlspecialchars(addslashes($url));
    $h1 = mysqli_real_escape_string($db, trim($h1));
    $url_original = mysqli_real_escape_string($db, $url_original);
    //echo "!!!!!!!!!!!!!!!!!!";var_dump($mysqli_db);
    $url = mysqli_real_escape_string($db, $url);

    $url = str_replace("http://www.rusavto.moisait.net/", "http://www.rusavtomatika.com/", $url_original);
    $url_original = str_replace("http://www.rusavto.moisait.net/", "http://www.rusavtomatika.com/", $url_original);

    $url = (str_replace("\\n", "", $url));
    $url_original = (str_replace("\\n", "", $url_original));
    $url = mysqli_real_escape_string($mysqli_db, trim(str_replace("\\", "", $url)));
    $url_original = mysqli_real_escape_string($mysqli_db, trim(str_replace("\\", "", $url_original)));


    $weight = search_index__get_weight_from_weight_map($url);
    if ($weight == 0) {
        echo "������� ������ � ������� �����.<br>";
        return false;
    }
    $query = "SELECT * FROM `$table_name` WHERE `url`= '$url';";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
        $product_info = test_url_for_product($url_original);
        if (!isset($product_info["index"]))
            $product_info["index"] = '';
        if (!isset($product_info["product_identifier"]))
            $product_info["product_identifier"] = '';
        $row = mysqli_fetch_array($result);
        $search_index_pages_id = $row["id"];
        if ($product_info["index"] > 0)
            $weight += $product_info["index"];
        //echo "<p class=\"message_error\">��� ���� ����� ������ id $search_index_pages_id</p>";                   
        $query = "UPDATE `$table_name` SET `weight`= '$weight', `h1`= '$h1', "
            . "`product_table`= '{$product_info["table"]}',"
            . "`product_identifier`= '{$product_info["product_identifier"]}', "
            . "`preview_image`= '{$product_info["preview_image"]}' "
            . "WHERE `id`= '$search_index_pages_id';";
        $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    } else {
        $product_info = test_url_for_product($url_original);
        if (!isset($product_info["index"]))
            $product_info["index"] = '';
        if (!isset($product_info["product_identifier"]))
            $product_info["product_identifier"] = '';
        if ($product_info["index"] > 0)
            $weight += $product_info["index"];
        $query = "INSERT INTO `$table_name` (`id`, `url`,`url_original`, `weight`,"
            . "`h1`, `product_table`,`product_identifier`, `preview_image`) "
            . "VALUES (NULL, '$url','$url_original','$weight', '$h1', "
            . "'{$product_info["table"]}','{$product_info["product_identifier"]}','{$product_info["preview_image"]}');";
        $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
        $search_index_pages_id = mysqli_insert_id($db);
    }
    return $search_index_pages_id;
}

function get_product_info($table, $model)
{
    //echo $table;
    global $db;
    global $mysqli_db;
    database_connect();
    switch ($table) {
        case "products_all":
            $product_identifier = "model";
            $field_price = "retail_price";
            $field_price_hide = "retail_price_hide";
            $field_currency = "currency";
            $field_amount_spb = "onstock_spb";
            $field_amount_msk = "onstock_msk";
            break;
        case "controllers":
            $product_identifier = "model";
            $field_price = "retail_price";
            $field_amount_spb = "onstock_spb";
            $field_amount_msk = "onstock_msk";
            $field_currency = "currency";
            $field_price_hide = "retail_price_hide";
            break;
        default:
            return '';
            break;
    }
    $query = "SELECT `$product_identifier`,`$field_price`,`$field_price_hide`,`$field_amount_spb`,`$field_amount_msk`,`$field_currency` FROM `$table` where $product_identifier='$model' or `s_name` = '$model';";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $out["price"] = $row[$field_price];
        $out["price_hide"] = $row[$field_price_hide];
        $out["onstock"] = $row[$field_amount_spb] + $row[$field_amount_msk];
        $out["currency"] = $row[$field_currency];
        return $out;
    } else {
        return '';
    }
}

function get_preview_image_for_product($model)
{
    global $db;
    global $mysqli_db;
    database_connect();

    //SELECT * FROM `gallery` where
    $query = "SELECT `id`,`s_img_path` FROM `gallery` where model='$model' order by `position`,`id`;";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_row($result);
        return $row[1];
    } else {
        return '';
    }
}

function test_url_for_product($url)
{
    $path_parts = pathinfo($url);
    // echo "dirname: " . $path_parts['dirname'], "\n";
    // echo "basename: " . $path_parts['basename'], "\n";
    $potential_model = str_replace(".php", "", $path_parts['basename']);

    if ($arOut = test_url_for_product_detect_table_products_all($potential_model, 'products_all', 'model')) {

    } else if ($arOut = test_url_for_product_detect_table_products_all($potential_model, 'controllers', 'model')) {
        // } else if ($arOut = test_url_for_product_detect_table_products_all($potential_model, 'ib_catalog_elements', 'name', 'id')) {        
    } else if ($arOut = test_url_for_product_detect_haiwell($potential_model)) {

    } else {
        $arOut["table"] = "";
        $arOut["preview_image"] = "";
    }

    return $arOut;
}

//SELECT `id`,`name`,`s_name`,`brand`,`type` FROM `ib_catalog_elements` where `name` = 'panel-operatora-mt8121xe3-ot-weintek' or `s_name` = 'panel-operatora-mt8121xe3-ot-weintek'

function test_url_for_product_detect_haiwell($potential_model)
{
    global $db;
    global $mysqli_db;
    database_connect();

    if (!$potential_model)
        return FALSE;
    $query = "SELECT `id`,`name`,`code`,`picture_preview` FROM `ib_catalog_elements` where `name` = '$potential_model';";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $model_secured = str_replace("/", "_", $row["name"]);
        $model_secured = str_replace(" ", "_", $model_secured);
        $model_secured = str_replace("�", "_", $model_secured);

        $arOut["index"] = $row["id"];
        $arOut["table"] = 'ib_catalog_elements';
        if ($row["picture_preview"]) {
            $arOut["preview_image"] = $row["picture_preview"];
        } else {
            $arOut["preview_image"] = "/upload_files/images/haiwell/models/small/"
                . $model_secured . ".jpg";
        }


        $arOut["product_identifier"] = $potential_model;
    } else {
        $arOut = false;
    }

    return $arOut;
}

function test_url_for_product_detect_table_products_all($model, $table = 'products_all', $model_field = 'model', $index_field = 'index')
{
    global $db;
    global $mysqli_db;
    database_connect();

    $query = "SELECT `$index_field`,`$model_field`,`s_name`,`brand`,`type` FROM `$table` where `$model_field` = '$model' or `s_name` = '$model' ;";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $model_secured = str_replace("/", "_", $row["model"]);
        $model_secured = str_replace(" ", "_", $model_secured);
        $model_secured = str_replace("�", "_", $model_secured);

        $arOut["index"] = $row["index"];
        $arOut["table"] = $table;
        $arOut["preview_image"] = "/images/"
            . strtolower($row["brand"]) . "/" . strtolower($row["type"]) . "/" . $model_secured . "/sm/" . $model_secured . "_1.png";
        $arOut["product_identifier"] = $model;
    } else {
        $arOut = false;
    }
    return $arOut;
}

function search_index__add_words_to_database($search_index_pages_id, $page_content, $title, $keywords, $h1)
{
    global $time_start;
    global $time_finish;
    global $db;
    global $mysqli_db;
    database_connect();

    if ($page_content) {
        $pos = strpos($page_content, "<h1");

        if ($pos !== false) {
            $page_content = substr($page_content, $pos);
        } else {
            $pos = strpos($page_content, " class='MAIN_TABLE'");
            if ($pos !== false) {
                $page_content = substr($page_content, $pos - 7);
            }
        }


        $pos = strpos($page_content, 'id="footer"');

        if ($pos !== false) {
            $page_content = substr($page_content, 0, $pos - 6);
        }
    }

    $page_content .= " " . $title . " " . $keywords;

    $arrWords = get_words($page_content);
    $allWordsTitle = implode(",", get_words($title));
    $allWordsKeywords = implode(",", get_words($keywords));
    $allWordsH1 = implode(",", get_words($h1));


    $arrWords_lemmatized = (lemmatize_array($arrWords));

    search_index__putContentInBD($arrWords_lemmatized, $search_index_pages_id);
    $arrWords_lemmatized_unique = array_unique($arrWords_lemmatized);

    ($word_weights = array_count_values($arrWords_lemmatized));    // ����    


    foreach ($arrWords_lemmatized_unique as $word) {
        if ($word != '') {
            $query = "INSERT INTO `search_index_words` (`id`, `word`) VALUES (NULL, '$word');";
            mysqli_query($mysqli_db, $query);
        }
    }

    $arrPageWeights = array();

    $query = "SELECT * FROM `search_index_pages` where id='{$search_index_pages_id}'";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    $page_row = mysqli_fetch_assoc($result);
    $weight = $page_row["weight"];
    $is_product = $page_row["product_identifier"];
    if ($is_product)
        $weight = $weight * 10000;

    $counter_affected_rows = 0;
    foreach ($arrWords_lemmatized_unique as $word) {

        // �������� ������� ����� � ���� � ��������� ��� id
        $query = "SELECT * FROM `search_index_words` where `word` = '$word';";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
        if (mysqli_num_rows($result) == 0) {
            continue;// ��� �����, ���������� ��������
        }
        $word_in_titles = 0;
        if (strpos($allWordsTitle, $word) !== false) {
            $word_in_titles++;
        }
        if (strpos($allWordsKeywords, $word) !== false) {
            $word_in_titles++;
        }
        if (strpos($allWordsH1, $word) !== false) {
            $word_in_titles++;
        }
        $row = mysqli_fetch_array($result);
        $search_index_word_id = $row["id"];
        // �������� ������� ���������� word_id � page_id
        // ���� ��� ����, �� ����� ������ update ������ insert
        $query2 = "SELECT * FROM `search_index_index` where `word_id` = '$search_index_word_id' and `page_id` = '$search_index_pages_id' LIMIT 1;";
        $time_start2 = microtime(true); //START
        $result2 = mysqli_query($mysqli_db, $query2) or die("Invalid query: " . $query2 . " error: " . mysqli_error($mysqli_db));
        $time_finish2 = microtime(true); //FINISH
        if (mysqli_num_rows($result2) == 0) {
            $query3 = "INSERT INTO `search_index_index` (`id`, `page_id`,`word_id`,`word_counter`,`weight`,`word_in_titles`)" .
                " VALUES (NULL, '$search_index_pages_id','$search_index_word_id', '{$word_weights["$word"]}','$weight',$word_in_titles);";
            mysqli_query($mysqli_db, $query3) or die("Invalid query: " . $query3 . " error: " . mysqli_error($mysqli_db));
        } else {
            $row2 = mysqli_fetch_array($result2);
            $search_index_index_id = $row2["id"];
            $query = "UPDATE `search_index_index` SET `word_counter` = '{$word_weights["$word"]}', `weight` = '$weight', `word_in_titles` = '$word_in_titles' "
                . "WHERE `search_index_index`.`id` = $search_index_index_id;";

            mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
        }

        //$time_counter += $time_finish2 - $time_start2;
        $counter_affected_rows += mysqli_affected_rows($mysqli_db);
    }
}

function search_index__putContentInBD($arrWords_lemmatized, $search_index_pages_id)
{
    global $db;
    global $mysqli_db;
    database_connect();

    $arrWords_lemmatized = implode(" ", $arrWords_lemmatized);

    $query = "UPDATE `search_index_pages` SET `text` = '{$arrWords_lemmatized}' "
        . "WHERE `id` = $search_index_pages_id;";
    mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
}

function lemmatize_array($arrWords)
{
    $counter = 0;
    $arrWords_lemmed = array();
    foreach ($arrWords as $word) {
        $word = trim($word, "- \t\n\r\0\x0B");
        if ($word and $word != " " and strlen($word) > 1) {
            $rez = lemmatize($word);
            if (isset($rez[0]))
                $lemma = $rez[0];
            else {
                $lemma = $word;
            }
            $arrWords_lemmed[] = $lemma;
        }
    }

    return $arrWords_lemmed;
}

////////////////////////////////////////////////////////////////////////////////
function get_words($content, $filter = true)
{

    $regexp_word = '/([a-z�-�0-9\-]+)/';
    $regexp_entity = '/&([a-zA-Z0-9\-]+);/';

    // ���������� HTML-����� � HTML-��������� //
    if ($filter) {
        $content = strip_tags($content);
        $content = preg_replace($regexp_entity, ' ', $content);
    }
    // ������� � ������� ������� //
    $content = mb_strtoupper($content, 'windows-1251');
    // ������ � �� � //
    //echo $content = str_ireplace('�', '�', $content);
    // ��������� ���� �� ��������� //
    $content = preg_replace("/[^a-zA-Z�-��-�0-9\-\s]/", " ", $content);
    $content = str_replace("NBSP", ' ', $content);
    $content = preg_replace('/[\s]{2,}/', ' ', $content);

    $arrWords = explode(" ", $content);
    //$arrWords = array_unique($arrWords);
    return $arrWords;
}

////////////////////////////////////////////////////////////////////////////////

function getRemoteContentByURL($PATH)
{
    if (!$PATH)
        return;

    $delimeter = strpos('?', $PATH) === FALSE ? '?' : '&';
    $PATH = $PATH . $delimeter . 'indexindex=1';


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $PATH);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($content and $httpCode != 404) {
        return $content;
    }
    return FALSE;
}

function search_index__clear_table($table_name)
{
    global $db;
    global $mysqli_db;
    database_connect();

    if ($table_name != '') {
        $query = "TRUNCATE TABLE `$table_name`";
        mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
    }
}

function search_index__get_amount_of_rows_from_table($table_name)
{
    global $db;
    global $mysqli_db;
    database_connect();
    if ($table_name != '') {

        $query = "SELECT COUNT(1) FROM `$table_name`";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
        return mysqli_fetch_array($result)[0];
    }
}

function search_index__get_first_row_from_table($table_name)
{
    global $db;
    global $mysqli_db;
    database_connect();
    if ($table_name != '') {

        $query = "SELECT * FROM `$table_name`";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
        return mysqli_fetch_array($result);
    }
}

////////////////////////////////////////////////////////////////////////////////
function search_index__delete_page_from_candidats($url)
{
    global $db;
    global $mysqli_db;
    database_connect();

    if ($url != '') {
        // $url = htmlspecialchars(addslashes($url));
        $url = strtolower($url);
        $url = mysqli_real_escape_string($mysqli_db, $url);
        $url = str_replace("&amp;", "&", $url);
        $query = "DELETE FROM `search_index_pages_candidates` WHERE "
            // . "url = '$url'  or "
            // . "url = '".stripslashes($url)."' or "
            . "`url` like '" . $url . "'";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
        $affected_rows = mysqli_affected_rows($mysqli_db);
        if ($affected_rows < 1) {
            echo "<br>�� ������� ������� " . $query . "<br>";
        }
    } else {
        echo "�� ���� ������� �� ������ ������";
    }
}

////////////////////////////////////////////////////////////////////////////////
function search_index__add_page_to_failed($url, $url_original)
{
    global $db;
    global $mysqli_db;
    database_connect();
    $url = htmlspecialchars(addslashes($url));
    if ($url != '') {

        $query = "INSERT INTO `search_index_pages_failed` (`id`, `url`) VALUES (NULL, '$url');";
        $result = mysqli_query($mysqli_db, $query);
    } else {
        echo "�� ���� add_page_to_failed �� ������ ������";
    }
}

////////////////////////////////////////////////////////////////////////////////
function search_index__truncate_tables()
{
    global $db;
    global $mysqli_db;
    database_connect();

    $arrTables = array('search_index_index', 'search_index_pages', 'search_index_pages_candidates', 'search_index_pages_failed', 'search_index_words');

    foreach ($arrTables as $table) {
        $query = "TRUNCATE `$table`;";
        $success = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
        if (!$success)
            return FALSE;
    }

    return TRUE;
}

////////////////////////////////////////////////////////////////////////////////
function search_index__add_pages_from_xml($search_index_sitemap_filename = "/search/assets/sitemap3.xml", $filter_text = "", $clear_table = false, $clear_index_table = false)
{
    global $db;
    global $mysqli_db;
    database_connect();
    if ($clear_table) {
        search_index__clear_table("search_index_pages_candidates");
    }
    if ($clear_index_table) {
        search_index__clear_table("search_index_pages_candidates");
        search_index__clear_table("search_index_index");
        search_index__clear_table("search_index_pages");
        search_index__clear_table("search_index_pages_failed");
        search_index__clear_table("search_index_words");
    }
    $arrAllURLs = array();
    $arrExclude = array("?tab=", ".jpg", ".png", ".css", ".zip", ".rar", ".pdf", ".jpeg", ".wmf", ".dwg", ".gif", ".sldprt", ".cmp", ".mtp", ".ccmp", ".doc", ".flb", ".ecmp", ".cmtp", ".exe", ".plb", ".emtp");
    if ($sitemap = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . "/$search_index_sitemap_filename")) {
        echo '<div class="block_spoiler"><div class="block_spoiler_show_hide top">��������/����������</div>'
            . '<h3>��������� ���������� ������� �� sitemap.xml �� ��������� �������</h3>';
        $counter = 0;
        foreach ($sitemap->url as $item) {

            $url_original = mysqli_real_escape_string($mysqli_db, $item->loc);
            $url = strtolower($item->loc);
            $url = mysqli_real_escape_string($mysqli_db, $url);

            $url = (str_replace("\\n", "", $url));
            $url_original = (str_replace("\\n", "", $url_original));
            $url = (trim(str_replace("\\", "", $url)));
            $url_original = (trim(str_replace("\\", "", $url_original)));




            file_put_contents($_SERVER["DOCUMENT_ROOT"]."/urls.txt", $url."\n", FILE_APPEND);



            //$url = "!!!".$url;
            //$url_original = "!!!".$url_original;



            $finded = FALSE;
            // ��������� �� ��������� ������
            if ($filter_text) {
                $pos = strpos($url, strtolower($filter_text));
                if ($pos === false) {
                    continue;
                }
            }
            // ��������� �� ����������� ������
            foreach ($arrExclude as $exclude) {
                $pos = strpos($url, $exclude);
                if ($pos === false) {
                    continue;
                } else {
                    $finded = TRUE;
                    break;
                }
            }

            if (!$finded) {
                $counter++;
                $added_id = search_index__add_url_to_database($url, $url_original, $table_name = "search_index_pages_candidates");
                echo $counter . ": id $added_id " . $url . "<br>";
            }
        }
        echo '<div class="block_spoiler_show_hide bottom">��������/����������</div></div>';

        $query = "SELECT * FROM search_index_weight_map order by position";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
        while ($map_row = mysqli_fetch_array($result)) {
            $query2 = "UPDATE search_index_pages SET weight='{$map_row['weight']}' where url like '{$map_row['url']}';";
            mysqli_query($mysqli_db, $query2) or die("Invalid query: " . $query2 . " error: " . mysqli_error($mysqli_db));
        }
    } else {
        echo "<p class=\"message_error\">�� ������� ��������� ���� $search_index_sitemap_filename</p>";
    }
}

////////////////////////////////////////////////////////////////////////////////
// ������ ��������� ������ � ������� �� ���������
function switchTextToEnglish($text)
{
    $str_search = array(
        "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�"
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

//* ������ ��������� ������ � ��������� �� �������

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
        "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�",
        "�", "�", "�", "�", "�", "�", "�", "�", "�"
    );

    return str_replace($str_search, $str_replace, $text);
}

function switcher($text, $arrow = 0)
{

    if (!$text)
        return '';
    $str[0] = array('�' => 'q', '�' => 'w', '�' => 'e', '�' => 'r', '�' => 't',
        '�' => 'y', '�' => 'u', '�' => 'i', '�' => 'o', '�' => 'p', '�' => '[',
        '�' => ']', '�' => 'a', '�' => 's', '�' => 'd', '�' => 'f', '�' => 'g',
        '�' => 'h', '�' => 'j', '�' => 'k', '�' => 'l', '�' => ';', '�' => '\'',
        '�' => 'z', '�' => 'x', '�' => 'c', '�' => 'v', '�' => 'b', '�' => 'n',
        '�' => 'm', '�' => ',', '�' => '.', '�' => 'Q', '�' => 'W', '�' => 'E',
        '�' => 'R', '�' => 'T', '�' => 'Y', '�' => 'U', '�' => 'I', '�' => 'O',
        '�' => 'P', '�' => '[', '�' => ']', '�' => 'A', '�' => 'S', '�' => 'D',
        '�' => 'F', '�' => 'G', '�' => 'H', '�' => 'J', '�' => 'K', '�' => 'L',
        '�' => ';', '�' => '\'', '?' => 'Z', '�' => 'X', '�' => 'C', '�' => 'V',
        '�' => 'B', '�' => 'N', '�' => 'M', '�' => ',', '�' => '.',
    );
    $str[1] = array('q' => '�', 'w' => '�', 'e' => '�', 'r' => '�', 't' => '�',
        'y' => '�', 'u' => '�', 'i' => '�', 'o' => '�', 'p' => '�', '[' => '�',
        ']' => '�', 'a' => '�', 's' => '�', 'd' => '�', 'f' => '�', 'g' => '�',
        'h' => '�', 'j' => '�', 'k' => '�', 'l' => '�', ';' => '�', '\'' => '�',
        'z' => '�', 'x' => '�', 'c' => '�', 'v' => '�', 'b' => '�', 'n' => '�',
        'm' => '�', ',' => '�', '.' => '�', 'Q' => '�', 'W' => '�', 'E' => '�',
        'R' => '�', 'T' => '�', 'Y' => '�', 'U' => '�', 'I' => '�', 'O' => '�',
        'P' => '�', '[' => '�', ']' => '�', 'A' => '�', 'S' => '�', 'D' => '�',
        'F' => '�', 'G' => '�', 'H' => '�', 'J' => '�', 'K' => '�', 'L' => '�',
        ';' => '�', '\'' => '�', 'Z' => '?', 'X' => '�', 'C' => '�', 'V' => '�',
        'B' => '�', 'N' => '�', 'M' => '�', ',' => '�', '.' => '�',
    );
    $result = isset($str[$arrow]) ? $str[$arrow] : array_merge($str[0], $str[1]);

    $result = strtr($text, $result);
    return $result;
}

?>
