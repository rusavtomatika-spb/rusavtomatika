<?php
if (defined("ENCODING") and ENCODING == "UTF-8") {
    header('Content-Type: text/html; charset=utf-8');
} else {
    header('Content-Type: text/html; charset=windows-1251');
}
//////////////////////////////////////////////////////////
// 0 старый дизайн
// 1 новый дизайн
// D:\1PROJECTS\rusavto.moisait.net\rusavto\include\redirect.php
if (1) {
    if (!defined('EX')) {
        define('EX', ""); // для продакшена
    }
} else {
    if (!defined('EX')) {
        define('EX', "_");  // для периода разработки
    }
}