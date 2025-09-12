<section class="hor_gallery_block section_video" style="display: none">
    <h2 class="is-size-3 has-text-weight-medium bright_text">
        <a class="bright_text" href="/video<?=EX?>/">Видеоканал rusavtomatika.com (70+ обучающих видео)</a>
    </h2>
    <?
    $arguments["component"] = "news_slider";
    $arguments["template"] = "video";
    CoreApplication::include_component($arguments);
    ?>

</section>