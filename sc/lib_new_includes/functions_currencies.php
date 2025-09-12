<?php
function usd_rate() {
    $ro = $_SERVER['DOCUMENT_ROOT'] . '/';
    $current_usd_rate = file_get_contents($GLOBALS["usd_rate_file"]);
    $current_eur_rate = file_get_contents($ro . 'eurrate.txt');
    $current_eur_rate = str_replace(',', '.', $current_eur_rate);
    echo "<div id='usdrate' title=' ÛÒ ÷¡ –‘ Ì‡ ÒÂ„Ó‰Ìˇ' > 1 USD = <span id=curusd >$current_usd_rate</span><span id=cureur style=display:none >$current_eur_rate</span> –”¡</div><input id ='valuta' style='display:none;' value='USD' />";
}

function euro_usd_rate() {

    $ro = $_SERVER['DOCUMENT_ROOT'] . '/';
    $current_usd_rate = file_get_contents($GLOBALS["usd_rate_file"]);
    $current_eur_rate = file_get_contents($ro . 'eurrate.txt');
    $current_eur_rate = str_replace(',', '.', $current_eur_rate);
    echo "<div id='usdrate' title=' ÛÒ ÷¡ –‘ Ì‡ ÒÂ„Ó‰Ìˇ' > 1 EUR = <span id=curusd style=display:none>$current_usd_rate</span><span id=cureur >$current_eur_rate</span> –”¡</div><input id ='valuta' style='display:none;' value='EUR' />";
}

