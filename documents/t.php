<?php
$file = '/drawing/mTV.SLDPRT';

if (preg_match('/^[\/\w\-. ]+$/', $file)) 
    echo 'VALID FILENAME'; 
else 
    echo 'INVALID FILENAME';
?>
