<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/services/TypeDictionary.php';

$catalog_filter_settings = array();
$catalog_filter_settings["diagonals"] = array("0","3.5","4.3","5","5.6","5.7","7","8","8.4","9","9.7","10","10.1","10.4","12","12.1","15","15.6","17","17.3","18.5","19","21.5","22","23.8","32");

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/fixed-filter-column.js");

if ($arguments["section"]["filters"] != "") {
    $list_of_filter_items = explode(",", $arguments["section"]["filters"]);
    if (is_array($list_of_filter_items) && count($list_of_filter_items) > 0) {
        $condition = "";
        foreach ($list_of_filter_items as $item) {
            if ($item != "") {
                $condition .= " `filter_code`= '$item' ";
                if (end($list_of_filter_items)) {
                    if ($item == end($list_of_filter_items)) {
                        $condition .= ") ";
                    } else {
                        $condition .= " or ";
                    }
                }
            }
        }
        if ($condition != "") {
            $condition = " (" . $condition;
        }
        $arr_filter_items = CoreApplication::get_rows_from_table("`catalog_filters`", "*", $condition, "position");

        $filters_html = '';
        if (is_array($arr_filter_items)) {
            foreach ($arr_filter_items as $item) {
                if ($item['filter_code'] === 'type' && isset($arguments['section']['code']) && $arguments['section']['code'] === 'modules_io') {
                    continue;
                }
                ob_start();
                include "inc.template_filter_{$item['filter_code']}.php";
                $single_filter_html = trim(ob_get_clean());

                if ($single_filter_html !== '') {
                    $filters_html .= '<div class="filter_code_' . htmlspecialchars($item['filter_code']) . '">' . $single_filter_html . '</div>';
                }
            }
        }

        if ($filters_html !== ''):
        ?>
        <div id="float_filter_block"><span class="is-hidden-desktop button_close_mobile_filter">Применить</span>
            <div class="component_catalog_section__filter">
                <div class="title is-hidden-desktop">Фильтры</div>
                <div class="filter_panel">
                    <?= $filters_html ?>
                </div>
            </div>
        </div>
        <?php
        endif;
    }
}

if (isset($arguments['section']['code']) && $arguments['section']['code'] == 'modules_io'):

    $io_sidebar_items = CoreApplication::get_rows_from_table(
        "products_all",
        "brand, model, type, DIO_full, `index`",
        "`section` = 'modules_io' AND `type` IN ('module','coupler') AND `status` != '0' AND `discontinued` != '1' AND `show_in_cat` = '1'",
        "`recommended` DESC, `index` ASC"
    );

    $grouped_io = array();
    if (is_array($io_sidebar_items)) {
        foreach ($io_sidebar_items as $item) {
            $b = trim($item['brand']);
            $t = trim($item['type']);
            if ($b === '' || $t === '') {
                continue;
            }
            if (!isset($grouped_io[$b])) {
                $grouped_io[$b] = array();
            }
            if (!isset($grouped_io[$b][$t])) {
                $grouped_io[$b][$t] = array();
            }
            $grouped_io[$b][$t][] = $item;
        }
    }

    if (!empty($grouped_io)):
        $type_order = array('coupler', 'module');
        $type_plural_labels = array(
            'coupler' => 'Каплеры',
            'module'  => 'Модули в/в'
        );
?>
<div id="float_filter_block_modules_io" v-if="filterSelectedBrands.length > 0" v-cloak>
    <?php foreach ($grouped_io as $brand_name => $types_map):
        $brand_js = htmlspecialchars(json_encode($brand_name), ENT_QUOTES, 'UTF-8');
        $brand_slug = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $brand_name));
    ?>
        <div
            class="component_catalog_section__filter"
            style="margin-bottom: 16px;"
            v-if="filterSelectedBrands.includes(<?= $brand_js ?>)"
        >
            <div class="filter_panel">
                <div class="filter_field_block borderless" style="padding: 0;">
                    <div class="filter_field_block__title">
                        <?= htmlspecialchars($brand_name) ?>
                    </div>

                    <?php foreach ($type_order as $t_code):
                        if (empty($types_map[$t_code])) {
                            continue;
                        }
                        $t_js = htmlspecialchars(json_encode($t_code), ENT_QUOTES, 'UTF-8');
                        $t_title = isset($type_plural_labels[$t_code])
                            ? $type_plural_labels[$t_code]
                            : TypeDictionary::get($t_code, 'modules_io');
                    ?>
                        <div
                            class="filter_io_type_group"
                            v-if="filterSelectedTypes === '' || filterSelectedTypes === <?= $t_js ?>"
                        >
                            <p class="filter__type-title"><?= htmlspecialchars($t_title) ?></p>
                            <div class="filter_field_block__content">
                                <?php foreach ($types_map[$t_code] as $prod):
                                    $raw_model = $prod['model'];
                                    $dash_pos = strpos($raw_model, '-');
                                    $short_model = ($dash_pos !== false) ? substr($raw_model, $dash_pos + 1) : $raw_model;
                                    $display_model = htmlspecialchars($short_model);

                                    $display_desc = !empty($prod['DIO_full'])
                                        ? htmlspecialchars(trim($prod['DIO_full']))
                                        : '';
                                ?>
                                    <a href="/<?= htmlspecialchars($brand_slug) ?>/<?= urlencode($raw_model) ?>/" class="card-item">
                                        <p class="card-title">
                                            <?= $display_model ?><?php if ($display_desc !== ''): ?>: <span class="card-desc"><?= $display_desc ?></span><?php endif; ?>
                                        </p>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
    endif;
endif;
?>