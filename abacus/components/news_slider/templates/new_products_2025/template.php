<?php
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");

// Получаем записи из таблицы products_all
$arResult["items"] = CoreApplication::get_rows_from_table(
    "`products_all`",
    "index,model,model_fullname,type,status,brand,series,text_preview,text_features,text_detail,date,title,description,keywords,pic_small",
    "`status` != '0'",
    "",
    15
);

// Выведем полученный массив
echo "<pre>";
var_dump($arResult["items"]);
echo "</pre>";

$count = count($arResult["items"]);
?>