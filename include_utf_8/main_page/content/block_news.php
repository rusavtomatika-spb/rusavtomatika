<section class="hor_gallery_block section_news" style="display: none">
    <h2 class="is-size-3 has-text-weight-medium bright_text">
        <a class="bright_text" href="/news/">Новости компании</a> и <a class="bright_text" href="/articles/">полезные статьи</a>
    </h2>
    <?
    $arguments["component"] = "news_slider";
    $arguments["template"] = "news";
    CoreApplication::include_component($arguments);
    ?>
</section>