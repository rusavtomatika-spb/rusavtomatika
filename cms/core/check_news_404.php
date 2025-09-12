<?php

$error404 = false;
if (isset($_GET['q'])) {
    $params = explode("/", strip_tags($_GET['q']));
    global $current_component;
    $count = count($params);
    if ($count > 0) {
        if ($count == 1) {
            $error404 = true;
        }
        if ($count == 2) {
            if ($params[1] != "")
                $error404 = true;
            $element_code = $params[0];
            $current_component = "element";
        }
        if ($count > 3) {
            $error404 = true;
        }
    }
} else
    $current_component = "root";
if ($error404) {
    header('HTTP/1.1 404 Not Found');
    global $TITLE;
    $TITLE = "Страница не найдена, ошибка 404";
    include 'prolog.php';
    echo "<h1>Извините, страница не найдена.</h1> Ошибка 404.";
    include 'epilog.php';
    exit;
}

if (!isset($current_component))
    $current_component = "";
if (!isset($section_code))
    $section_code = "";
if (!isset($element_code))
    $element_code = "";

