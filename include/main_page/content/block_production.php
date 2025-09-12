<section class="company_pluses">
    <h2 class="is-size-3 has-text-weight-medium bright_text bottom_1rem">Продукция</h2>
    <div class="columns is-multiline">
        <div class="column
					is-12-mobile
					is-12-tablet
					is-12-desktop
					is-12-widescreen bottom_2rem
					">
            <?
            include 'block_production_data.php';
            foreach ($arr_block_production_data as $block_production_data_item_key=>$block_production_data_item):
                if ($block_production_data_item['active']) {
                    global $block_production_data_item;
                    include 'block_production_template.php';
                }
            endforeach; ?>
        </div>
    </div>
</section>
