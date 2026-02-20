<?php

include 'block_cloud_tags_data_popup.php';

global $arr_cloud_tags_popup;

?>

<section class="cloud_tags" style="display: none; margin: 0 20px; margin-left: 0; margin-right: 0;">
    <div class="cloud_tray top_2rem">
        <div itemscope itemtype="https://www.schema.org/SiteNavigationElement">

            <meta itemprop="name" content="Облако тегов">

            <ul class="product_cloud_list cloud_list" style="gap: 10px;">

                <?

                foreach ($arr_cloud_tags_popup as $tag):

                    ?>

                    <li

                            class="product_cloud_item cloud_item cloud_item_functional">

                        <a itemprop="url" href="<?= $tag['url'] ?>" style="text-shadow: none; width: 100%; height: 100%;">

                            <?= $tag['name'] ?>

                            <meta itemprop="name" content="<?= $tag['name'] ?>">

                        </a>

                    </li>

                <? endforeach; ?>

            </ul>

        </div>

    </div>

</section>