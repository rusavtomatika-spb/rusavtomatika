Приветики!
<section class="big_slider_block">
    <?
    $arguments["component"] = "big_slider";
    CoreApplication::include_component($arguments);
    $arguments["component"] = "news_slider";
    $arguments["template"] = "brands_gallery_tray";
    CoreApplication::include_component($arguments);
    ?>
</section>