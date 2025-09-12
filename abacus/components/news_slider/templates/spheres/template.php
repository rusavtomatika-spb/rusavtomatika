<?php
$arResult["items"] = [
    0 => [
        'name' => 'Пищевая промышленность',
        'img' => '/include/main_page/images/spheres/s1.webp'
    ],
    1 => [
        'name' => 'Медицинская сфера',
        'img' => '/include/main_page/images/spheres/s2.webp'
    ],
    2 => [
        'name' => 'Сельское хозяйство',
        'img' => '/include/main_page/images/spheres/s3.webp'
    ],
    3 => [
        'name' => 'Химическая промышленность',
        'img' => '/include/main_page/images/spheres/s4.webp'
    ],
    4 => [
        'name' => 'Горнодобывающая промышленность',
        'img' => '/include/main_page/images/spheres/s5.webp'
    ],
    5 => [
        'name' => 'Транспортная сфера',
        'img' => '/include/main_page/images/spheres/s6.webp'
    ],
    6 => [
        'name' => 'Отопление, водоснабжение, вентиляция',
        'img' => '/include/main_page/images/spheres/s7.webp'
    ],
    7 => [
        'name' => 'Приборостроение и&nbsp;электротехника',
        'img' => '/include/main_page/images/spheres/s8.webp'
    ],
    8 => [
        'name' => 'Деревообрабатывающая промышленность',
        'img' => '/include/main_page/images/spheres/s9.webp'
    ],
];
$count = count($arResult["items"]);
if ($count > 0):
    ?>
    <div class="glide" id="glide_sphere">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <?
                for ($x = 0; $x < $count; $x++) {
                    if (isset($arResult["items"][$x])) {
                        $item = $arResult["items"][$x];
                        ?>
                        <li class="glide__slide">
                            <div class="card">
                                <img src="<?= $item["img"]; ?>"
                                     alt="<?= $item["name"] ?>">
                                <div class="glide__slide___hover_caption">
                                    <?= $item["name"] ?>
                                </div>
                            </div>
                        </li>
                        <?
                    }
                }
                ?>
            </ul>
        </div>
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"></button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"></button>
        </div>
    </div>
<?php
endif;
?>