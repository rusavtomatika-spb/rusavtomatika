<?
global $item;
?>
<li class="glide__slide" data-type="<?= $item["type"]; ?>" data-series="<?= $item["series"]; ?>">
    <a class="card" href="<?= $item["link_detail_page"] ?>">
        <div class="card-image">
            <figure class="model_image" itemscope="" itemtype="https://schema.org/ImageObject">
                <img itemprop="contentUrl" src="<?= $item["img"]; ?>"
                     alt="<?= $item["model"] ?>">
                <meta itemprop="caption" content="<?= $item["model"] ?>">
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

									</span>
            </p>
            <div class="category_name">
                <?= $item["category_name"]; ?>
            </div>
            <div class="brand">
                <?= $item["brand"]; ?>
            </div>
            <div class="model">
                <?= str_replace(" ","&nbsp;",$model_name); ?>
            </div>
            <div class="green_text">в наличии</div>
            <div class="price"><?
                if(isset($item["retail_price"]) and $item["retail_price"] > 0 and $item["retail_price_hide"] != '1'){
                     echo $item["retail_price"]." ";
                    if($item["currency"] == 'USD'){
                        echo '<span class="usd">$</span>';
                    }elseif($item["currency"] == 'RUR'){
                        echo '<span class="rur">руб.</span>';
                    }

                }else{
                    echo '<span class="no_price">цена по запросу</span>';
                }

                ?></div>

            <span class="button_link">подробнее</span>
        </div>

    </a>
</li>