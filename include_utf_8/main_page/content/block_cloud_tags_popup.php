<?php

include 'block_cloud_tags_data_popup.php';

global $arr_cloud_tags_popup;

?>

<section class="cloud_tags" style="display: none">
    <div class="cloud_tray top_2rem">
        <div itemscope itemtype="https://www.schema.org/SiteNavigationElement">

            <meta itemprop="name" content="Облако тегов">

            <ul class="product_cloud_list cloud_list">

                <?

                foreach ($arr_cloud_tags_popup as $tag):

                    ?>

                    <li

                            class="product_cloud_item cloud_item">

                        <a itemprop="url" href="<?= $tag['url'] ?>">

                            <?= $tag['name'] ?>

                            <meta itemprop="name" content="<?= $tag['name'] ?>">

                        </a>

                    </li>

                <? endforeach; ?>

            </ul>

        </div>

    </div>

</section>