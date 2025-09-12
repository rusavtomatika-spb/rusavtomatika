<?php
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";


global $arguments;
$arguments["component"] = "sitemap_html";
?>
    <article>
        <?php
        CoreApplication::include_component($arguments);
        ?>
    </article>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
