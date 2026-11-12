<?php
$catalog_filter_settings = array();
$catalog_filter_settings["diagonals"] = array("0","3.5","4.3","5","5.6","5.7","7","8","8.4","9","9.7","10","10.1","10.4","12","12.1","15","15.6","17","17.3","18.5","19","21.5","22","23.8","32");


CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/fixed-filter-column.js");

//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

if ($arguments["section"]["filters"] != "") {
    $list_of_filter_items = explode(",", $arguments["section"]["filters"]);
    if (is_array($list_of_filter_items) and count($list_of_filter_items) > 0) {
        $condition = "";
        foreach ($list_of_filter_items as $item) {
            if ($item != "") {
                $condition .= " `filter_code`= '$item' ";
                if (end($list_of_filter_items))
                    if ($item == end($list_of_filter_items)) {
                        $condition .= ") ";
                    } else {
                        $condition .= " or ";
                    }
            }
        }
        if ($condition != "") $condition = " (" . $condition;
        $arr_filter_items = CoreApplication::get_rows_from_table("`catalog_filters`", "*", $condition, "position");
        ?>

        <div id="float_filter_block"><span class="is-hidden-desktop button_close_mobile_filter">Применить</span>
            <div class="component_catalog_section__filter">
                <div class="title is-hidden-desktop">Фильтры</div>


                <!--div class="filter_block__title"><span class="filter_block__title_icon active"></span>Фильтр</div-->
                <div class="filter_panel">
                    <?
                    foreach ($arr_filter_items as $item) {
                        ?>
                        <div class="filter_code_<?= $item['filter_code'] ?>"><?
                        include "inc.template_filter_{$item['filter_code']}.php";
                        ?></div><?
                    }
                    ?>
                </div>

            </div>
        </div>
        <?php
    }
}

if (isset($arguments['section']['code']) && $arguments['section']['code'] == 'modules_io') {
    $licos_modules = CoreApplication::get_rows_from_table(
        "products_all", 
        "model, preview_text, `index`", 
        "`brand`='LicOS' AND `type` IN ('module','coupler') 
         AND `status` != '0' AND `discontinued` !='1'", 
        "`type` ASC, `sort` ASC, `index` ASC"
    );
    if (is_array($licos_modules) && count($licos_modules) > 0):
?>
<div id="float_filter_block_licos" style="margin-top: 20px;">
    <div class="component_catalog_section__filter">
        <div class="filter_panel">
            <div class="filter_field_block borderless" style="padding: 0;">
                <div class="filter_field_block__title" style="font-weight: bold; font-size: 16px; margin-bottom: 0;">
                    LicOS
                </div>
                <div class="filter_field_block__content">
                    <?php foreach ($licos_modules as $licos_item): 
                        $licos_model = htmlspecialchars($licos_item['model']);
                        $licos_preview = !empty($licos_item['preview_text']) 
                            ? htmlspecialchars(mb_substr($licos_item['preview_text'], 0, 100)) 
                            : '';
                    ?>
                    <a href="/licos/<?= urlencode($licos_item['model']) ?>/" class="card-text"
                        onmouseover="this.style.background='#f5f9ff';"
                        onmouseout="this.style.background='#fff';">
                        <div style="font-size: 13px; font-weight: 600; color: var(--color-green); margin-bottom: 3px;">
                            <?= $licos_model ?>
                        </div>
                        <?php if ($licos_preview !== ''): ?>
                            <div style="font-size: 12px; color: #555; line-height: 1.4;">
                                <?= $licos_preview ?>
                            </div>
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    endif;
}
?>