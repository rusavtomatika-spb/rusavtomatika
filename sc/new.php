<?php

$new = array(
    "cMT2078X",
    "cMT2108X",
    "cMT2158X"
);
if(!empty($num)){
    if (in_array($num, $new)) {
        $class = ' new';
    } else {
        $class = '';
    };
}else{
    $class = '';
}

?>
