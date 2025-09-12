<section class="catalog_sections_block">
    <h2 class="is-size-3 has-text-weight-medium bright_text has-text-centered">
        <a class="bright_text" href="/catalog/">Наша продукция</a>
    </h2>
    <p><br></p>
<?php
$arguments = array(
    "component" => "catalog",
    "template" => "default",
    "template_section_detail" => "default",
);
CoreApplication::include_component($arguments);
?>
</section>

