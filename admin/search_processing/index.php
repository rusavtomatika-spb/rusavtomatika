<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));


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


define('admin', true);
define('PRODUCTS_ALL', true);
include $_SERVER["DOCUMENT_ROOT"] . "/admin/config/admin_dbcon.php";
global $arExcludeWords;
$arExcludeWords = ["IPS", "CINCOZE", "IFC", "eWON", "Haiwell", "Yottacontrol"];

global $mysqli_db;
database_connect();
$result = '';
if (isset($_GET['do_processing']) and $_GET['do_processing'] > 0) {
    $result = do_processing($_GET['do_processing']);
}


?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Search processing</title>
    </head>
    <body>
    <style>
        body, html {
            font-family: Arial;
            font-size: 16px;
        }

        nav ul {
            display: flex;
            justify-content: center;
            gap: 3rem;
            list-style: none;
            margin: 2rem;
        }

        nav a {
            display: block;
            background: green;
            color: white;
            text-decoration: none;
            padding: 5px 10px;

        }

        .container {
            max-width: 1140px;
            margin: 1rem auto;
            text-align: center;
        }

    </style>
    <div class="container">
        <h1>Лемматизация статей</h1>
        <nav>
            <ul>
                <li><a href="/admin/search_processing/?do_processing=1">Обработать все</a></li>
                <li><a href="/admin/search_processing/?do_processing=2">Обработать статьи</a></li>
                <li><a href="/admin/search_processing/?do_processing=3">Обработать новости</a></li>
                <li><a href="/admin/search_processing/?do_processing=4">Обработать статику</a></li>
                <li><a href="/admin/search_processing/?do_processing=5">Обработать видео</a></li>
            </ul>
        </nav>
        <div>
            <?
            echo $result;
            ?>
        </div>
    </div>
    <script>
        window.history.pushState('', '', window.location.href.split('?')[0]);
    </script>
    </body>
    </html>


<?php

function do_processing($mode)
{

    ob_start();


    $PhpMorphy_rootFolder = $_SERVER['DOCUMENT_ROOT'] . "/sc/phpmorphy";
    require_once($PhpMorphy_rootFolder . '/src/common.php');
    $dir = $PhpMorphy_rootFolder . '/dicts';
// Укажите, для какого языка будем использовать словарь.
// Язык указывается как ISO3166 код страны и ISO639 код языка,
// разделенные символом подчеркивания (ru_RU, uk_UA, en_EN, de_DE и т.п.)
    $lang = 'ru_RU';
    $langEN = 'en_EN';
// Укажите опции
// Список поддерживаемых опций см. ниже
    $opts = array(
        'storage' => PHPMORPHY_STORAGE_FILE,
    );
// создаем экземпляр класса phpMorphy
// обратите внимание: все функции phpMorphy являются throwable т.е.
// могут возбуждать исключения типа phpMorphy_Exception (конструктор тоже)
    try {
        global $phpmorphy;
        global $phpmorphyEN;
        $phpmorphy = new phpMorphy($dir, $lang, $opts);
        $phpmorphyEN = new phpMorphy($dir, $langEN, $opts);
    } catch (phpMorphy_Exception $e) {
        die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
    }


    $articles = get_elements('articles');
    $news = get_elements('news');
    $static_pages = get_elements('search_static_pages_lemmatized');
    $videos = get_elements('videos');

    if ($mode == 1 or $mode == 2) {
        echo "<h3>Оработка статей</h3><br>";
        foreach ($articles as $article) {
            $arrResWords = array();
            $arrResWords_statistics = array();
            $text = text_adding($article);
            $words = get_words($text);
            foreach ($words as $word) {
                $arr_lemma = lemmatize($word);
                $lemma1 = $arr_lemma[0];
                $lemma2 = $arr_lemma[1];
                if (strlen($lemma1) > 2) {
                    if (!in_array($lemma1, $arrResWords)) {
                        $arrResWords[] = $lemma1;
                        $arrResWords_statistics[$lemma1] = 1;
                    } else {
                        $arrResWords_statistics[$lemma1]++;
                    }
                }
                if (strlen($lemma2) > 2) {
                    if (!in_array($lemma2, $arrResWords)) {
                        $arrResWords[] = $lemma2;
                        $arrResWords_statistics[$lemma2] = 1;
                    } else {
                        $arrResWords_statistics[$lemma2]++;
                    }
                }
            }
            $res_words = implode(" ", $arrResWords);
            $result_str_words_stat = '';
            foreach ($arrResWords_statistics as $key => $val) {
                $result_str_words_stat .= $key . " " . $val . "###";
            }
            update_articles_lemmatized('articles', $article['id'], $res_words, $result_str_words_stat, $text);
        }
    }
    if ($mode == 1 or $mode == 3) {
        echo "<h3>Оработка новостей</h3><br>";

        foreach ($news as $article) {

            $arrResWords = array();
            $arrResWords_statistics = array();
            $text = text_adding($article);
            $words = get_words($text);
            foreach ($words as $word) {
                $arr_lemma = lemmatize($word);
                $lemma1 = $arr_lemma[0];
                $lemma2 = $arr_lemma[1];
                if (strlen($lemma1) > 2) {
                    if (!in_array($lemma1, $arrResWords)) {
                        $arrResWords[] = $lemma1;
                        $arrResWords_statistics[$lemma1] = 1;
                    } else {
                        $arrResWords_statistics[$lemma1]++;
                    }
                }
                if (strlen($lemma2) > 2) {
                    if (!in_array($lemma2, $arrResWords)) {
                        $arrResWords[] = $lemma2;
                        $arrResWords_statistics[$lemma2] = 1;
                    } else {
                        $arrResWords_statistics[$lemma2]++;
                    }
                }
            }
            $res_words = implode(" ", $arrResWords);
            $result_str_words_stat = '';
            foreach ($arrResWords_statistics as $key => $val) {
                $result_str_words_stat .= $key . " " . $val . "###";
            }
            update_articles_lemmatized('news', $article['id'], $res_words, $result_str_words_stat, $text);
        }

    }

    if ($mode == 1 or $mode == 4) {
        echo "<h3>Обработка статических страниц</h3><br>";
        foreach ($static_pages as $article) {
            $arrResWords = array();
            $arrResWords_statistics = array();
            $text = text_adding($article);
            $words = get_words($text);
            foreach ($words as $word) {
                $arr_lemma = lemmatize($word);
                $lemma1 = $arr_lemma[0];
                $lemma2 = $arr_lemma[1];

                if (strlen($lemma1) > 2) {
                    if (!in_array($lemma1, $arrResWords)) {
                        $arrResWords[] = $lemma1;
                        $arrResWords_statistics[$lemma1] = 1;
                    } else {
                        $arrResWords_statistics[$lemma1]++;
                    }
                }
                if (strlen($lemma2) > 2) {
                    if (!in_array($lemma2, $arrResWords)) {
                        $arrResWords[] = $lemma2;
                        $arrResWords_statistics[$lemma2] = 1;
                    } else {
                        $arrResWords_statistics[$lemma2]++;
                    }
                }
            }
            $result_str_words = implode(" ", $arrResWords);
            $result_str_words_stat = '';
            foreach ($arrResWords_statistics as $key => $val) {
                $result_str_words_stat .= $key . " " . $val . "###";
            }
            update_articles_lemmatized('search_static_pages_lemmatized', $article['id'], $result_str_words, $result_str_words_stat, $text);
        }
    }

    if ($mode == 1 or $mode == 5) {
        echo "<h3>Оработка видео-раздела</h3><br>";

        foreach ($videos as $article) {

            $arrResWords = array();
            $arrResWords_statistics = array();
            $text = text_adding($article);
            $words = get_words($text);
            foreach ($words as $word) {
                $arr_lemma = lemmatize($word);
                $lemma1 = $arr_lemma[0];
                $lemma2 = $arr_lemma[1];
                if (strlen($lemma1) > 2) {
                    if (!in_array($lemma1, $arrResWords)) {
                        $arrResWords[] = $lemma1;
                        $arrResWords_statistics[$lemma1] = 1;
                    } else {
                        $arrResWords_statistics[$lemma1]++;
                    }
                }
                if (strlen($lemma2) > 2) {
                    if (!in_array($lemma2, $arrResWords)) {
                        $arrResWords[] = $lemma2;
                        $arrResWords_statistics[$lemma2] = 1;
                    } else {
                        $arrResWords_statistics[$lemma2]++;
                    }
                }
            }
            $res_words = implode(" ", $arrResWords);
            $result_str_words_stat = '';
            foreach ($arrResWords_statistics as $key => $val) {
                $result_str_words_stat .= $key . " " . $val . "###";
            }
            update_articles_lemmatized('videos', $article['id'], $res_words, $result_str_words_stat, $text);
        }

    }
    return ob_get_clean();
}

function text_adding($article)
{
    $field_name_title = 'title_cat';
    $field_name_stext = 'stext';
    $field_name_btext = 'btext';
    if($article['table'] == 'videos'){
        $field_name_title = 'title';
        $field_name_stext = 'text_preview';
        $field_name_btext = 'text_detail';
    }
    $text = "";
    $text .= " " . strip_tags($article[$field_name_title]);
    $text .= " " . strip_tags($article[$field_name_title]);
    $text .= " " . strip_tags($article[$field_name_title]);
    $text .= " " . strip_tags($article[$field_name_title]);
    $text .= " " . strip_tags($article[$field_name_title]);
    $text .= " " . strip_tags($article['name']);
    $text .= " " . strip_tags($article['name']);
    $text .= " " . strip_tags($article['name']);
    $text .= " " . strip_tags($article['name']);
    $text .= " " . strip_tags($article['keywords']);
    $text .= " " . strip_tags($article['keywords']);
    $text .= " " . strip_tags($article['keywords']);
    $text .= " " . strip_tags($article[$field_name_stext]);
    $text .= " " . strip_tags($article[$field_name_stext]);
    $article[$field_name_btext] = str_replace("\n", " ", $article[$field_name_btext]);
    $article[$field_name_btext] = str_replace("<p>", " <p>", $article[$field_name_btext]);
    $article[$field_name_btext] = str_replace("<div>", " <div>", $article[$field_name_btext]);
    $text .= " " . strip_tags($article[$field_name_btext]);
    return $text;
}


function update_articles_lemmatized($table, $id, $res_words, $result_str_words_stat, $text)
{
    global $mysqli_db;
    $query = "SELECT `id` FROM `search_texts_lemmatized` where article_id='$id' and `table` = '$table'";
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . mysqli_error($mysqli_db) . "<br>" . $query);
    $num_rows = mysqli_num_rows($result);

    $text = mysqli_real_escape_string($mysqli_db, $text);


    if ($num_rows > 0) {
        $query = "UPDATE `search_texts_lemmatized` SET `lemmas` = '$res_words', `lemmas_statistics` = '$result_str_words_stat', `original_text` = '$text' WHERE `article_id` = '$id' and `table` = '$table';";
    } else {
        $query = "INSERT INTO `search_texts_lemmatized` (`id`, `table`, `article_id`, `lemmas`, `lemmas_statistics`, `original_text`) VALUES (NULL,'$table', '$id', '$res_words', '$result_str_words_stat', '$text');";
    }
    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . mysqli_error($mysqli_db) . "<br>" . $query);
    echo $id . ', ';
    return $result;
}

function lemmatize($word)
{
    global $arExcludeWords;
    if (in_array($word, $arExcludeWords)) {
        $lemmas[0] = $word;
        $lemmas[1] = $word;
        return $lemmas;
    }
    $word = str_ireplace('Ё', 'Е', $word);
    global $phpmorphy;
    global $phpmorphyEN;
    // Получение базовой формы слова //
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

function get_elements($table)
{
    /*    global $mysqli_db;
        $arr_all_tags = array();
        $query = "SELECT `tags` FROM `search_index_tags`";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . mysqli_error($mysqli_db) . "<br>" . $query);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $tags = $current_row['tags'];
                $tags = trim($tags,", ");
                $arr_tags = explode(",",$tags);
                foreach ($arr_tags as $tag){
                    if(!in_array($tag,$arr_all_tags)){
                        $arr_all_tags[] = $tag;
                    }
                }
            }
        }

        asort($arr_all_tags);
        echo implode("<br>",$arr_all_tags);
        echo "<br>";*/

    global $mysqli_db;
    $query = "SELECT * FROM `$table` ORDER BY `id` DESC LIMIT 1000 ";

    $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . mysqli_error($mysqli_db) . "<br>" . $query);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        for ($row = 0; $row < $rows; $row++) {
            $current_row = mysqli_fetch_assoc($result);
            $out[] = $current_row;
        }
    }
    return $out;
}


function get_words($content, $filter = true)
{

    $regexp_word = '/([a-zа-я0-9\-]+)/';
    $regexp_entity = '/&([a-zA-Z0-9\-]+);/';

    // Фильтрация HTML-тегов и HTML-сущностей //
    if ($filter) {
        $content = strip_tags($content);
        $content = preg_replace($regexp_entity, ' ', $content);
    }
    // Перевод в верхний регистр //
    $content = mb_strtoupper($content, 'windows-1251');
    // Замена ё на е //
    //echo $content = str_ireplace('Ё', 'Е', $content);
    // Выделение слов из контекста //
    $content = preg_replace("/[^a-zA-ZА-Яа-я0-9\-\s]/", " ", $content);
    $content = str_replace("NBSP", ' ', $content);
    $content = preg_replace('/[\s]{2,}/', ' ', $content);

    $arrWords = explode(" ", $content);
    //$arrWords = array_unique($arrWords);
    return $arrWords;
}
