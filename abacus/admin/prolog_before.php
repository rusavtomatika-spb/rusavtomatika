<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
spl_autoload_register(
    function (string $className) {
    $path = $_SERVER["DOCUMENT_ROOT"] ."/". str_replace('\\', '/', $className) . '.php';
    if(file_exists($path)){
        require_once $path;
    }else{
        echo "Error!!! no file: ".$path;
    }
});

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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
use abacus\admin\classes\Application;
use abacus\admin\classes\Auth;
use abacus\admin\Config;

if(!(Auth::check_user())) {
    header("HTTP/1.0 404 Not Found");
    Auth::show_panel();
    exit();
}
