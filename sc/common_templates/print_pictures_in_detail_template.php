<?php

if (!defined('cms'))
    exit;

    $imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";

    if ($r->pics_number > 0) {
        for ($x = 1; $x <= ($r->pics_number); $x++) {
            $new_path_picture[] = $r->model . "_" . $x . ".png";
        }
    }
  ?>

        <div class="detail_image__wrapper">
            <?
            $counter = 0;
            foreach ($new_path_picture as $image_url):?>
                <a class="detail_image__image-main_link" id="detail_image__image-main_link_<?= $counter++ ?>"
                   style="display: none;" data-fancybox="gallery"
                   href="<? echo $imgRemoteDir . "lg/" . $image_url ?>">

                         <img class="img_product-inner" src="<? echo $imgRemoteDir . "md/" . $image_url ?>" alt="<?=$r->model?>">
                </a>
            <? endforeach; ?>

            <div class="detail_image__images-mini__wrapper">
                <div class="detail_image__images-mini__inner">

                    <?
                    $counter = 0;
                    foreach ($new_path_picture as $image_url):?>
                        <div data-rel="detail_image__image-main_link_<?= $counter++ ?>"
                             class="detail_image__images-mini"
                             style="background-image:url(<? echo $imgRemoteDir . "sm/" . $image_url ;?>);"></div>
                    <? endforeach; ?>

                </div>
            </div>


        </div>
