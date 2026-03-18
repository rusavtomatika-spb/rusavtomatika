<li class="glide__slide">
    <a class="card" href="<?= $item["url_page_detail2"] ?>">
        <div class="card-image">
            <figure class="model_image" itemscope="" itemtype="https://schema.org/ImageObject">
                <img itemprop="contentUrl" src="<?= $item["img"]; ?>"
                     alt="<?= $item["name"] ?>">
                <meta itemprop="caption" content="<?= $item["name"] ?>">
                <span itemprop="creator" itemscope=""
                      itemtype="https://schema.org/Organization">
											<meta itemprop="name" content="ООО Русавтоматика">
											<meta itemprop="description" content="<?=$text?>">
											<link itemprop="url" href="https://www.rusavtomatika.com">
											<span itemprop="address" itemscope=""
                                                  itemtype="https://schema.org/PostalAddress">
												<meta itemprop="addressLocality" content="Санкт-Петербург">
												<meta itemprop="postalCode" content="199178">
												<meta itemprop="streetAddress" content="Малый пр. В.О. 57 корп. 3">
											</span>
											<meta itemprop="telephone" content="+7 812 648-03-47">
											<meta itemprop="email" content="sales@rusavtomatika.com">
										</span>
            </figure>
        </div>
        <div class="cutted_text">
            <p class="bottom_16">
									<span class="is-size-6 has-text-weight-bold bright_text">
									<?= $item["date"]; ?>
									</span>
            </p>
            <p class="has-text-weight-bold black_text">
                <?= $item["name"]; ?>
            </p>
            <p>
                <?=$text?>
            </p>
            <div class="gradient_hide_text bottom_hide"></div>
            <span class="hor_gallery_item_hover_link
									bottom_hide
									is-size-6 has-text-weight-bold bright_text">Все характеристики</span>
        </div>

    </a>
</li>