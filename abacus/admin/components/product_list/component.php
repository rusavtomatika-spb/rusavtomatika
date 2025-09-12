<?php
use abacus\admin\Config;
use abacus\admin\classes\Application;

$route = Application::get_route();

if(isset($route[1]) and $route[1] > 0){
    require __DIR__."/../product_detail/component.php";
}else{
    require __DIR__."/template.php";
}
