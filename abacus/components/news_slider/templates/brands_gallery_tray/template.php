<?php
$arResult["items"] = [
    0 => [
        'url' => '/weintek' . EX . '/',
        'name' => '',
        'img' => '/include/main_page/images/brands/weintek.webp'
    ],
    1 => [
        'url' => '/samkoon' . EX . '/',
        'name' => 'Samkoon',
        'img' => '/include/main_page/images/brands/samkoon.webp'
    ],
    2 => [
        'url' => '/ifc' . EX . '/',
        'name' => 'IFC',
        'img' => '/include/main_page/images/brands/ifc.webp'
    ],
    3 => [
        'url' => '/aplex' . EX . '/',
        'name' => 'Aplex',
        'img' => '/include/main_page/images/brands/aplex.webp'
    ],
];


$count = count($arResult["items"]);
if ($count > 0):
    ?>
    <div class="glide_brands_gallery_tray_wrapper">
        <div class="glide_brands_gallery_tray_wrapper2">
            <div class="glide" id="glide_brands_gallery_tray">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <?
                        for ($x = 0; $x < $count; $x++) {
                            if (isset($arResult["items"][$x])) {
                                $item = $arResult["items"][$x];
                                ?>
                                <li class="glide__slide">
                                    <a href="<?= $item["url"]; ?>" class="brand_slide">
                                        <img src="<?= $item["img"]; ?>" alt="<?= $item["name"] ?>">
                                    </a>
                                </li>
                                <?
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
endif;
?>
