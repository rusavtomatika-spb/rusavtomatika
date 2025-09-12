<?php
require_once "news_slider_functions.php";
$arguments["template"] = (isset($arguments["template"]) ? $arguments["template"] : "default");






CoreApplication::include_template($arguments);
