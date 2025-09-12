<?php

global $usd_currency;
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt")) {
    $usd_currency = floatval(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt"));
} else $usd_currency = 0;


if (!function_exists('var_dump_pre')) {
    function var_dump_pre(...$values)
    {
        foreach ($values as $value) {
            echo "<pre style='font-size: 12px;color: red;max-width: 1000px;overflow: scroll;padding: 10px;text-align: left;'>";
            var_dump($value);
            echo "</pre>";
        }
    }
}

if (!function_exists('echo_current_file_line_error')) {
    function echo_current_file_line_error($__FILE__,$__LINE__, $ERROR = ''){
        if ($ERROR != ''){
            $ERROR = 'ERROR: &laquo;'.$ERROR.'&raquo;<br>';
        }
        echo '<div style="border: 1px solid #ff0000;padding: 5px 1px 5px 5px;color: red;word-wrap:break-word;font-size: 11px;">'.$ERROR.'FILE: '.$__FILE__.'.<br>LINE: '.$__LINE__."</div>";
    }

}

//





