<?
include $_SERVER["DOCUMENT_ROOT"].'/include/main_page/content/block_cloud_tags_data.php';
global $arr_cloud_tags;
?>
<div class="catalog_pop_menu_brand_title">�����</div>
<ul class="product_cloud_list cloud_list">
    <?
    foreach ($arr_cloud_tags as $tag):

        // width_full
        ?>
        <li
            class="series-list-item-subitem   filter_<?= $tag['category'] ?>">
            <a itemprop="url" href="<?= $tag['url'] ?>">
                <?= $tag['name'] ?>
            </a>
        </li>
    <? endforeach; ?>
</ul>
