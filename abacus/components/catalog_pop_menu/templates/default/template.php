<?php
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style_catalog_pop_menu.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
CoreApplication::add_style("/include_utf_8/main_page/main_page_styles.css");
CoreApplication::add_style("/include_utf_8/main_page/css/cloud.css");

$arrSections = CoreApplication::get_rows_from_table("catalog_sections", '', "active='1'", "position ASC");
$arrBrands = CoreApplication::get_rows_from_table("catalog_brands", '', "active='1'", "position ASC");
$arrSeries = CoreApplication::get_rows_from_table("catalog_series", '', "active='1'", "position ASC");

for ($x = 0; $x < count($arrBrands); $x++) {
    $arrBrands[$x]['sections'] = array();
    foreach ($arrSections as $section) {
        $pos = strpos($section['filter_brands'], $arrBrands[$x]['name']);
        if ($pos !== false) {
            $arrBrands[$x]['sections'][] = array(
                "id" => $section['id'],
                "code" => $section['code'],
                'name' => $section['name'],
                'category_link' => $section['category_link'],
                'is_direct_link' => $section['is_direct_link'],
                'sub_sections_d' => $section['subsection_diagonals'],
                'sub_sections_p' => $section['subsection_processors']
            );
        }
    }
}

foreach ($arrSections as $section) {
    if (($section['subsection_diagonals'] != '') || ($section['subsection_processors'] != '')) {
        $arrSub['sections'][] = array(
            "id" => $section['id'],
            "code" => $section['code'],
            'product_types' => $section['product_types'],
            'name' => $section['name'],
            'category_link' => $section['category_link'],
            'is_direct_link' => $section['is_direct_link'],
            'sub_sections_d' => $section['subsection_diagonals'],
            'sub_sections_p' => $section['subsection_processors']
        );
    }
}

foreach ($arrSeries as $serie) {
    $arrSer[] = array(
        "id" => $serie['id'],
        "name_russian" => $serie['name_russian'],
        'name' => $serie['name'],
        'series_link' => $serie['series_link'],
        'brand' => $serie['brand'],
        'type' => $serie['type'],
        'position' => $serie['position'],
        'menu_category_item_code' => $serie['menu_category_item_code']
    );
}
?>

<script>
$(document).ready(function() {
    new jBox('Modal', {
        attach: '#operator_panels',
        maxWidth: '400px',
        overlay: true,
        closeButton: 'title',
        title: '<b>Безэкранные панели оператора</b>',
        content: 'Не имеют экрана и позволяют работать с ними через специальное приложение cMT Viewer с персонального компьютера, планшета или мобильного устройства. <br>При этом можно подключаться одновременно к нескольким панелям оператора и делать это в многопользовательском режиме.'
    });

    new jBox('Modal', {
        attach: '#gateways',
        maxWidth: '400px',
        overlay: true,
        closeButton: 'title',
        title: '<b>Шлюзы данных</b>',
        content: 'Помогают большому количеству пользователей подключать различные устройства к IIot (интернету вещей).'
    });

    new jBox('Modal', {
        attach: '#industrial_computers',
        maxWidth: '400px',
        overlay: true,
        closeButton: 'title',
        title: '<b>Промышленный компьютер</b>',
        content: 'Компьютер адаптированый к использованию в промышленности. Имеет защиту от неблагоприятных условий эксплуатации.'
    });

    new jBox('Modal', {
        attach: '#industrial_computers_full_ip65',
        maxWidth: '400px',
        overlay: true,
        closeButton: 'title',
        title: '<b>Промышленный компьютер FULL IP65</b>',
        content: 'Компьютер адаптированый к использованию в промышленности. Имеет защиту от неблагоприятных условий эксплуатации. Промышленные компьютеры full IP65 имеют усиленную пылевлагозащиту всего корпуса, а не только фронтальной панели.'
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-wrapper button');
    const categoryBlock = document.getElementById('category');
    const brandsBlock = document.getElementById('brands');
    const functionalBlock = document.getElementById('functional');
    
    function switchTab(activeIndex) {
        categoryBlock.style.display = 'none';
        brandsBlock.style.display = 'none';
        functionalBlock.style.display = 'none';
        
        tabButtons.forEach(button => {
            button.classList.remove('is-active');
            button.classList.add('is-not-active');
        });
        
        tabButtons[activeIndex].classList.add('is-active');
        tabButtons[activeIndex].classList.remove('is-not-active');
        
        switch(activeIndex) {
            case 0:
                categoryBlock.style.display = 'flex';
                break;
            case 1:
                functionalBlock.style.display = 'flex';
                break;
            case 2:
                brandsBlock.style.display = 'flex';
                break;
        }
    }
    
    tabButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            switchTab(index);
        });
    });
    
    switchTab(0);
});
</script>

<div id="vue_catalog_pop_menu" v-cloak="" style="display: none">
  <div class="catalog_pop_menu">
    <div class="catalog_pop_menu_wrap_inn">
      <div class="hidden-menu ">
        <div class=" container_ ">
          <div class="box cataloge">
            <div class="tab-wrapper">
              <button class="is-active">По категориям</button>
              <button class="is-not-active">По функционалу</button>
              <button class="is-not-active">По производителям</button>
            </div>
            <ul class="cataloge-list" id="category">
                <?php
                foreach ($arrSections as $section) {
                    if (empty($section['name']) || empty($section['category_link'])) {
                        continue;
                    }
                    
                    if (isset($section['category_link']) && $section['category_link'] != '') {
                        $link = $section['category_link'];
                    } else {
                        $link = "";
                    }

                    if (isset($section['subsection_brands']) && $section['subsection_brands'] != '') {
                        $sub0 = $section['subsection_brands'];
                    } else {
                        $sub0 = "";
                    }

                    if (isset($section['subsection_diagonals']) && $section['subsection_diagonals'] != '') {
                        $sub1 = $section['subsection_diagonals'];
                    } else {
                        $sub1 = "";
                    }

                    if (isset($section['subsection_processors']) && $section['subsection_processors'] != '') {
                        $sub2 = $section['subsection_processors'];
                    } else {
                        $sub2 = "";
                    }

                    if ($section["code"] != 'industrial-computers' && !empty($section['name'])) {
                ?>
                <li class="cataloge_list_item_icon">
                    <div class="cataloge_list_item__picture">
                        <?php
                        $preview_picture = '';
                        if (isset($section['preview_picture_small']) && $section['preview_picture_small'] != '') {
                            $preview_picture = $section['preview_picture_small'];
                        } elseif (isset($section['preview_picture']) && $section['preview_picture'] != '') {
                            $preview_picture = $section['preview_picture'];
                        }
                        
                        if (!empty($preview_picture)) {
                            echo '<img class="is-hidden-mobile" src="' . $preview_picture . '" alt="' . htmlspecialchars($section['name']) . '">';
                        }
                        ?>
                    </div>
                    <ul>
                        <li>
                            <?php
                            if ($section['is_direct_link'] == "1") {
                            ?>
                            <span class="cataloge_list-title button_show_items">
                                <a href="<?= $section["category_link"] ?>" class="cataloge_list-title button_show_items">
                                    <?= htmlspecialchars($section['name']) ?>
                                </a>
                            </span>
                            <?php
                            } else {
                            ?>
                            <a href="<?= $section["category_link"] ?>" class="cataloge_list-title button_show_items">
                                <span @click="handle_button_show_items"
                                    data-section-id="<?= $section['id'] ?>"
                                    data-section-code="<?= $section['code'] ?>"
                                    data-action="show_section_by_categories"
                                    data-brand="all"
                                    class="cataloge_list-title button_show_items">
                                    <?= htmlspecialchars($section['name']) ?>
                                </span>
                            </a>
                            <?php
                            }

                            if (preg_match('/(gateways|screenless|industrial_computers)/', $section['category_link'])) {
                                echo '<span style="cursor: pointer; z-index: 9999;" id="' . $section['code'] . '"> <i class="fa-regular fa-circle-question" style="color:#d6d6d6;"></i></span>';
                            }
                            ?>

                            <?php
                            if (isset($sub0) && $sub0 != '') {
                                $arr_section_sub = explode(",", $sub0);
                                if (count($arr_section_sub) > 1) {
                            ?>
                            <ul class="subsection">
                                <?php
                                foreach ($arr_section_sub as $section_sub) {
                                    if (empty($section_sub)) continue;
                                ?>
                                <ul class="subsection">
                                    <li class="cataloge_list_item_subitem">
                                        <a title="Производитель <?= htmlspecialchars($section_sub) ?>" href="<?= $section["category_link"] . '?&brand=' . urlencode($section_sub) ?>">
                                            <span @click="handle_button_show_items"
                                                class="section_list_tag_button"
                                                data-action="show_section_by_categories_one_brand_only"
                                                data-link="<?= $section["category_link"] . '&brand=' . urlencode($section_sub) ?>"
                                                data-section-code="<?= $section['code'] ?>"
                                                data-section-id="<?= $section['id'] ?>"
                                                data-section-sub="<?= htmlspecialchars($section_sub) ?>"
                                                data-brand="<?= htmlspecialchars($section_sub) ?>">
                                                <?= htmlspecialchars($section_sub) ?>
                                            </span>
                                        </a>
                                    </li>
                                    <?php
                                    foreach ($arrSer as $i => $serie) {
                                        if (empty($serie['brand']) || empty($serie['type'])) continue;
                                        
                                        $pattern = '/' . preg_quote($serie['type'], '/') . '/i';
                                        $pattern_code = '/' . preg_quote($serie['menu_category_item_code'], '/') . '/i';
                                        
                                        if ($serie['brand'] == $section_sub && 
                                            preg_match($pattern, $section['product_types']) && 
                                            preg_match($pattern_code, $section['code'])) {
                                    ?>
                                    <li class="cataloge_list_item_subitem">
                                        <a title="<?= htmlspecialchars($serie["name_russian"]) ?>" href="/catalog/<?= urlencode($serie['menu_category_item_code']) ?>/?&series=<?= urlencode($serie['name']) ?>">
                                            <span @click="handle_button_show_items"
                                                class="section_list_tag_button ser"
                                                data-action="show_section_by_categories_one_brand_only">
                                                <?= htmlspecialchars($serie["name"]) ?>
                                            </span>
                                        </a>
                                    </li>
                                    <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </ul>
                                <?php
                                }
                                ?>
                            </ul>
                            <?php
                                };
                            }
                            ?>

                            <?php
                            if (isset($sub1) && $sub1 != '') {
                                $arr_section_sub = explode(",", $sub1);
                                $cur = 1;
                                if (count($arr_section_sub) > 1) {
                            ?>
                            <ul class="subsection">
                                <?php
                                foreach ($arr_section_sub as $section_sub) {
                                    if (empty($section_sub)) continue;
                                    
                                    $arr_diag_sub = explode("#", $section_sub);
                                    $diag_label = $arr_diag_sub[0];
                                    $diag_range = explode("-", $arr_diag_sub[1]);
                                    
                                    if ($diag_range[0] == '0') {
                                        $diag_min = '';
                                    } else {
                                        $diag_min = '&range_diagonal_min=' . $diag_range[0];
                                    }
                                    
                                    if ($diag_range[1] == '0') {
                                        $diag_max = '';
                                    } else {
                                        $diag_max = '&range_diagonal_max=' . $diag_range[1];
                                    }
                                ?>
                                <li class="cataloge_list_item_subitem">
                                    <a title="Диагональ" href="<?php
                                        echo $section["category_link"] . $diag_min;
                                        if ($cur < count($arr_section_sub)) {
                                            echo $diag_max;
                                        }
                                        echo '&sort=diagonal_small';
                                    ?>">
                                        <span @click="handle_button_show_items"
                                            class="section_list_tag_button"
                                            data-action="show_section_by_categories_one_brand_only"
                                            data-section-code="<?= $section['code'] ?>"
                                            data-section-id="<?= $section['id'] ?>">
                                            <?= htmlspecialchars($diag_label) ?>"
                                        </span>
                                    </a>
                                </li>
                                <?php
                                    $cur++;
                                }
                                ?>
                            </ul>
                            <?php
                                };
                            }
                            ?>

                            <?php
                            if (isset($sub2) && $sub2 != '') {
                                $arr_section_sub = explode(",", $sub2);
                                if (count($arr_section_sub) > 1) {
                            ?>
                            <ul class="subsection">
                                <?php
                                foreach ($arr_section_sub as $section_sub) {
                                    if (empty($section_sub)) continue;
                                ?>
                                <li class="cataloge_list_item_subitem">
                                    <a title="Процессор" href="<?= $section["category_link"] . '&processors=' . urlencode($section_sub) ?>">
                                        <span @click="handle_button_show_items"
                                            class="section_list_tag_button"
                                            data-action="show_section_by_categories_one_brand_only"
                                            data-link="<?= $section["category_link"] . '&processors=' . urlencode($section_sub) ?>"
                                            data-section-code="<?= $section['code'] ?>"
                                            data-section-id="<?= $section['id'] ?>"
                                            data-section-sub="<?= htmlspecialchars($section_sub) ?>"
                                            data-brand="<?= htmlspecialchars($section_sub) ?>">
                                            <?= htmlspecialchars($section_sub) ?>
                                        </span>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <?php
                                };
                            }
                            ?>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                }
                ?>
            </ul>
            <div id="functional" style="display: none; flex-direction: column;">
	          <h2 style="margin: 0 0 1rem;">Панели оператора</h2>
              <?php
              include $_SERVER["DOCUMENT_ROOT"] . "/include_utf_8/main_page/content/block_cloud_tags_popup.php";
              ?>
            </div>
            <div id="brands" style="display: none;" class="brands-wrapper">
                <?php
                foreach ($arrBrands as $brand) {
                    $imageSrc = isset($brand['preview_picture']) && !empty($brand['preview_picture']) 
                        ? $brand['preview_picture'] 
                        : '/images/no-image.png';
                    
                    $brandLink = !empty($brand['brand_page_link']) 
                        ? $brand['brand_page_link'] 
                        : '/catalog/?&brand=' . urlencode($brand['name']);
                    
                    echo '<a href="' . $brandLink . '" class="brand-item">
                            <img src="' . $imageSrc . '" alt="' . htmlspecialchars($brand['name']) . '" loading="lazy">
                          </a>';
                }
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>