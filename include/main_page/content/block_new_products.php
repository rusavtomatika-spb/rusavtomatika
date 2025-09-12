<section class="hor_gallery_block section_new_products" style="display: none">
    <h2 class="is-size-3 has-text-weight-medium bright_text">
        <a class="bright_text" href="/new-products<?=EX?>/">Новинки продукции</a>
    </h2>
    <?
    $arguments["component"] = "news_slider";
    $arguments["template"] = "new_products";
    CoreApplication::include_component($arguments);
    ?>
</section>