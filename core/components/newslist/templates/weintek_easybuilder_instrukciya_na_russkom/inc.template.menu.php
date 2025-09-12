<?php

$core_url = "/weintek-easybuilder-instrukciya-na-russkom/";

foreach ($arrResult["menu_items"] as $menu_item){
    ?>
    <div class="menu_root_item"><a href="<?=$core_url.$menu_item["url"]?>/"><?=$menu_item["name"]?></a></div>
    <?php
}
