<?php
$arrAllURLs = array();
$arrExclude = array(
    ".jpg",
    ".png",
    ".css",
    ".zip",
    ".rar",
    ".pdf",
    ".jpeg",
    ".wmf",
    ".dwg",   
    ".gif",
    ".sldprt",
    ".cmp",
    ".mtp",
    ".ccmp",
    ".doc",
    ".flb",
    ".ecmp",
    ".cmtp",    
    ".exe"    
);
$sitemap = simplexml_load_file("sitemap2.xml");
$counter = 0;
echo "<pre>";
foreach ($sitemap->url as $item) {
    $finded = FALSE;
    $str = strtolower($item->loc);
    foreach ($arrExclude as $exclude) {
        $pos = strpos($str, $exclude);
        if ($pos === false) {
            continue;
        } else {
            $finded = TRUE;
            break;
        }        
    }
    if(!$finded) {
        $counter++;
        echo $counter.": ".$item->loc."\n";        
        $arrAllURLs[] = $item->loc;
    }
}
echo "</pre>";

