<?php
use \abacus\admin\classes\Application;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER["DOCUMENT_ROOT"]."/abacus/admin/prolog.php";

Application::show();

require $_SERVER["DOCUMENT_ROOT"]."/abacus/admin/epilog.php";
