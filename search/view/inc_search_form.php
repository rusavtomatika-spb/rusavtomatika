<?
if (isset($_GET["search"])){
    //var_dump(iconv("utf-8", "windows-1251", $_GET["search"]));
    $search_text = strip_tags(trim($_GET["search"]));
    $search_text = mb_strtoupper($search_text);
    $search_text = preg_replace('|[\s]+|s', ' ', $search_text);//eliminate repititive space
    
    if (mb_detect_encoding($search_text) == 'UTF-8') {
        $search_text = iconv("utf-8", "windows-1251", $search_text);
    }
    save_statistics($search_text);
    
    $search_text_length = strlen($search_text);
    if ($search_text_length < 4) {
        $pos_quote = strrpos($search_text, '"');
        if ($search_text_length == $pos_quote + 1) {
            $inches = preg_replace("/[^,.0-9]/", '', $search_text);            
            $header_url = '/advanced_search.php?min_diagonal='.$inches.'&max_diagonal='.$inches;            
            if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
                if ($header_url != "") {
                    $out = array(
                        "status" => "redirect",
                        "header_url" => $header_url,
                    );
                    ob_get_clean();
                    echo json_encode($out);
                    exit();
                }
            }             
        } else {
            $header_url = "";
        }
    }
    
    $search_text2 = switcher($search_text,2);

    $arSearch_text0[] = $search_text;
    $arSearch_text2[] = $search_text2;
    
    //$arSearch_text = array_merge((array)$arSearch_text0,(array)$arSearch_text, (array)$arSearch_text2);    
    $arSearch_text = array_merge((array)$arSearch_text0, (array)$arSearch_text2);
    $search_text_exploded = explode(" ", $search_text);
    $arSearch_text = array_merge((array)$arSearch_text, (array)$search_text_exploded);
    $search_text2_exploded = explode(" ", $search_text2);
    $arSearch_text = array_merge((array)$arSearch_text, (array)$search_text2_exploded);
     if (count($search_text_exploded) == 2){
         $arSearch_text = array_merge((array)(str_replace(" ", "-", $arSearch_text)),(array)$arSearch_text);
         $arSearch_text = array_merge((array)(str_replace(" ", "", $arSearch_text)),(array)$arSearch_text);
     }
    $text_without_hyphen = str_replace("-", "", $search_text);
    $text_without_hyphen2 = str_replace("-", " ", $search_text);
    if ($text_without_hyphen != $search_text) $arSearch_text[] =  $text_without_hyphen;     
    if ($text_without_hyphen2 != $search_text) {
        $words = explode(" ", $text_without_hyphen2);
        foreach ($words as $word) {
            $arSearch_text[] = $word;
        }
    }
    //var_dump($arSearch_text);
    
}else{$search_text = "";}

$pos_quote = strrpos($search_text, '"');
if ($pos_quote !== false) {
    $search_text = str_replace('"', "&quot;", $search_text);
}
?>
<form id="form_search" name="form_search" method="get" accept-charset="utf-8" >    
    <table>
        <tr>
            <td style="width: 100%;vertical-align: top;position: relative;">
                <input class="search_input" class="input_text_style1" type="text" name="search" placeholder="Введите запрос" autocomplete="off" value="<?=$search_text?>">
                <div class="search_pre_text">Для поиска по модели достаточно вводить цифры</div>
            </td>
            <td style="vertical-align: top">
                <input  style="margin-top: 2px;" class="input_submit_style1" type="submit" value="Искать">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="hints"></div>
            </td>
        </tr>
    </table>      
 </form>
<div id="ajax_search_results">
<?
if (isset($arSearch_text)) {
    echo "<!--ajax-->";
    ob_start();
    //$count = do_fulltext_search($arSearch_text);
    $count = do_search($arSearch_text);

    $buffer = ob_get_contents();
    ob_end_clean();
    if (isset($count)) {
        if ($count > 0) {
            echo "Найдено: " . $count . " страниц<br>";
        }else{           
            echo "Ничего не найдено<br>";  
        }
    }  
    echo $buffer;  
    echo "<!--ajax-->";
}


?>
</div>
