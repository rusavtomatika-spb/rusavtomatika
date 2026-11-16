<?php

require_once "catalog_cart_functions.php";
$arguments["component"] = "catalog_cart";
$arguments["template"] = "default";
CoreApplication::include_template($arguments);