<?php
namespace abacus\admin\classes;

use abacus\admin\classes\Config;


class Application
{
    public static function show()
    {
        $arr_route = self::get_route();

        if (is_array($arr_route) and isset($arr_route[0])) {
            if (isset(Config::$route_rules[$arr_route[0]])) {
                $component = Config::$route_rules[$arr_route[0]];
                require __DIR__ . "/../components/" . $component . "/component.php";
            } else {
                echo "404";
            }
        }
    }

    public static function get_route()
    {
        if (isset($_GET['q']) and $_GET['q'] != '') {
            $q = trim($_GET['q'], "/ ");
            $arr_route = explode("/", $q);
        } else {
            $arr_route = [];
        }
        return $arr_route;
    }


}
