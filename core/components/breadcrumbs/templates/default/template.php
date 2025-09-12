<?CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");?>
<nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
    <ul>
        <?php
        if (isset(CoreApplication::$arrBreadcrumbs)) {
            ?><li><a href="/">Главная</a></li><?
            foreach (CoreApplication::$arrBreadcrumbs as $item) {
                if ($item["anchor"] != "") {
                    if (isset($item["link"]) and $item["link"] != "") {
                        ?><li><a href="<?= $item["link"] ?>"><?= $item["anchor"] ?></a></li><?
                    } else {
                        ?><li><span><?= $item["anchor"] ?></span></li><?
                    }
                }
            }
        }
        ?>
    </ul>
</nav>
