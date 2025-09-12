<?php
if(!empty($route[1])){
    $arResult["product_id"] = $route[1];
    include __DIR__."/template.php";
}

