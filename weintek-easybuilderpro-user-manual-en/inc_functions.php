<?php

function getRemoteContentByURL($PATH) {
    if (!$PATH)
        return;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $PATH);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
    curl_close($ch);
    if ($content) {
        return $content;
    }
    return;
}
