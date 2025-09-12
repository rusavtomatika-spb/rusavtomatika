<section class="hor_gallery_block section_now_in_stock_slider" style="display: none">
    <h2 class="is-size-3 has-text-weight-medium bright_text mb-0">
        <a class="bright_text" href="/catalog/operator_panels/?&availablity=1">Сейчас в наличии</a>
    </h2>
    <?
    $arguments["component"] = "now_in_stock_slider";
    $arguments["template"] = "default";
    CoreApplication::include_component($arguments);
    ?>
</section>