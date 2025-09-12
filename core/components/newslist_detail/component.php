<?php
require_once "newslist_detail_functions.php";

if(isset($arguments["template"]) and $arguments["template"]!= ""){
    include __DIR__."/templates/".$arguments["template"]."/template.php";
}


