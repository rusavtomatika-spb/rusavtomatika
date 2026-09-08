<?php

if (defined("ENCODING") and ENCODING == "UTF-8") {
    header('Content-Type: text/html; charset=utf-8');
} else {
    header('Content-Type: text/html; charset=utf-8');
}

if (1) {
    if (!defined('EX')) {
        define('EX', ""); // для продакшена
    }
} else {
    if (!defined('EX')) {
        define('EX', "_");  // для периода разработки
    }
}