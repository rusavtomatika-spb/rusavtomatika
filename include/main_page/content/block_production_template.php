<?php
global $block_production_data_item;
global $block_production_data_item_key;
?>
<div class="columns is-multiline">
    <div class="column is-12-mobile is-12-tablet is-6-desktop">
        <div class="cycle-slideshow products"
             data-cycle-fx="tileBlind"
             data-cycle-tile-vertical=false
             data-cycle-timeout=3000
             data-cycle-slides="> a"
             data-cycle-pager="#pager_block_production_<?= $block_production_data_item_key ?>"
             data-cycle-swipe="true"
             data-cycle-swipe-fx="tileBlind"
        >

            <?
            foreach ($block_production_data_item['slides'] as $item):
                ?>
                <a href="<?= $item['link'] ?>" itemscope itemtype="https://schema.org/ImageObject">
                    <img src="<?= $item['image_url'] ?>" alt="<?= $item['title'] ?>" itemprop="contentUrl">
                    <meta itemprop="caption" content="<?= $item['title'] ?>">
                    <span itemprop="creator" itemscope itemtype="https://schema.org/Organization">
											<meta itemprop="name" content="ООО Русавтоматика">
											<meta itemprop="description"
                                                  content="Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, eWON, Yottacontrol.">
											<meta itemprop="url" content="https://www.rusavtomatika.com/">
											<span itemprop="address" itemscope
                                                  itemtype="https://schema.org/PostalAddress">
												<meta itemprop="addressLocality" content="Санкт-Петербург">
												<meta itemprop="postalCode" content="199178">
												<meta itemprop="streetAddress" content="Малый пр. В.О. 57 корп. 3">
											</span>
											<meta itemprop="telephone" content="+7 812 648-03-47">
											<meta itemprop="email" content="sales@rusavtomatika.com">
										</span>
                </a>
            <?
            endforeach;
            ?>
            <div class="center cycle-pager cycle_pager_bottom_box"
                 id="pager_block_production_<?= $block_production_data_item_key ?>"></div>
        </div>
    </div>

        <div class=" column is-12-mobile is-12-tablet is-6-desktop item_offset_top">
            <a class="is-size-4 has-text-weight-medium bright_text" href="<?= $block_production_data_item['section_link']?>">
                <?= $block_production_data_item['title'] ?>
            </a>
            <p>
                <?= $block_production_data_item['text'] ?>
            </p>
        </div>

</div>
