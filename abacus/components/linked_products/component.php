<?php
$arguments["template"] = (isset($arguments["template"])?$arguments["template"]:"default");
$arguments["component"] = "linked_products";
CoreApplication::include_template($arguments);
