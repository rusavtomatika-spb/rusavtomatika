<?php

function catchingHTTP_REFERER() {
    if (1 or $_SERVER['HTTP_REFERER']) {
        ?>
        <div class="HTTP_REFERER" style="display: none;">
        <? var_dump($_SERVER['HTTP_REFERER']); ?>
        </div> 

    <?
    }
}
