<?php
$arguments["component"] = "catalog_layout";
$arguments["template"]  = isset($arguments["template"]) && $arguments["template"] != '' ? $arguments["template"] : "default";
CoreApplication::include_template($arguments);