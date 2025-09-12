<?php

function search() {
    if (1 or $_SERVER["HTTP_HOST"] == "www.rusavto.moisait.net" or $_SERVER["HTTP_HOST"] == "www.test.rusavtomatika.com") {
        if (isset($_GET["search"])) {
            $text = strip_tags(trim($_GET["search"]));
            if (mb_detect_encoding($text) == 'UTF-8') {
                $text = iconv("utf-8", "windows-1251", $text);
            }            
            $pos_quote = strrpos($text, '"');
            if ($pos_quote !== false) {
                $text = str_replace('"', "&quot;", $text);
            }
        } else {
            $text = "";
        }
        ?>
        <div class="search_panel_in_header">
            <input type="text" class="search_input"  placeholder="поиск по сайту..." <? if ($text): ?>value="<?= $text ?>"<? endif; ?>           >
            <div class="search_button"></div>
            <div class="search_hints"></div>
        </div>        
    <? }else {
        ?>
        <div id=search>
            <input type='text' id='tete' value='поиск по каталогу...' onclick='se_click()'>
            <div class='button_search' id=se_im onclick='gotosearch()'></div>
            <div id=sho> </div>
        </div>
        <?
    }
//<span class=searchbut onclick='gotosearch()'> &nbsp Искать</span>
}
