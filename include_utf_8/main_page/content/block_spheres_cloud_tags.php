<?php
include 'block_spheres_cloud_tags_data.php';
global $arr_spheres_cloud_tags;
?>
<section class="cloud_tags" style="display: none">
<div class="cloud_tray top_2rem">
    <ul class="product_cloud_list cloud_list">
        <?
        foreach ($arr_spheres_cloud_tags as $tag):
            ?>
            <li class="product_cloud_item cloud_item">
                <span>
                    <?= $tag['name'] ?>
                    <!--meta itemprop="name" content="<?= $tag['name'] ?>"-->
                </span>
            </li>
        <? endforeach; ?>
    </ul>
</div>
</section>