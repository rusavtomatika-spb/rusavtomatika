<?php
if ($arguments["route_string"] != "") {
    include "inc.template_detail.php";
} else {
    include "inc.template_list.php";
}