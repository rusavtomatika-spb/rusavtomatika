<section class="hor_gallery_block section_news" style="display: none">
    <h2 class="is-size-3 has-text-weight-medium bright_text">
        <a class="bright_text" href="/news<?=EX?>/">������� ��������</a> � <a class="bright_text" href="/articles<?=EX?>/">�������� ������</a>
    </h2>
    <?
    $arguments["component"] = "news_slider";
    $arguments["template"] = "news";
    CoreApplication::include_component($arguments);
    ?>
</section>