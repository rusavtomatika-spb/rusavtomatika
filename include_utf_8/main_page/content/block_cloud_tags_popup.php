<?php
include 'block_cloud_tags_data_popup.php';
?>

<section class="cloud_tags" style="margin: 0 20px; margin-left: 0; margin-right: 0;">
    <div class="cloud_tray top_2rem">
        <div class="cloud_category_switcher" style="display: flex; gap: 10px; margin-bottom: 20px;">
            <?php foreach ($arr_cloud_tags_popup as $index => $category): ?>
                <button 
                    class="<?= $index === 0 ? 'active__type-btn' : 'type-btn' ?>" 
                    data-category="<?= $index ?>"
                >
                    <?= $category['category'] ?>
                </button>
            <?php endforeach; ?>
        </div>
        
        <div itemscope itemtype="https://www.schema.org/SiteNavigationElement">
            <meta itemprop="name" content="Облако тегов">
            <?php foreach ($arr_cloud_tags_popup as $index => $category): ?>
                <ul class="product_cloud_list cloud_list filter-list cloud_category_<?= $index ?>" 
                    style="gap: 10px; display: <?= $index === 0 ? 'grid' : 'none' ?>;">
                    <?php foreach ($category['filters'] as $tag): ?>
                        <li class="product_cloud_item cloud_item cloud_item_functional">
                            <a itemprop="url" href="<?= $tag['url'] ?>" style="display: flex; align-items: center; justify-content: center; text-shadow: none; width: 100%; height: 100%;">
                                <?= $tag['name'] ?>
                                <meta itemprop="name" content="<?= $tag['name'] ?>">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.type-btn, .active__type-btn');
    const categoryLists = document.querySelectorAll('.filter-list');
    
    console.log('Buttons found:', categoryButtons.length);
    console.log('Lists found:', categoryLists.length);
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryIndex = this.getAttribute('data-category');
            console.log('Clicked category:', categoryIndex);
            
            categoryButtons.forEach(btn => {
                btn.classList.remove('active__type-btn');
                btn.classList.add('type-btn');
            });
            this.classList.remove('type-btn');
            this.classList.add('active__type-btn');
            
            categoryLists.forEach(list => {
                console.log('List classes:', list.className);
                if (list.classList.contains('cloud_category_' + categoryIndex)) {
                    list.style.display = 'grid';
                    console.log('Showing list:', categoryIndex);
                } else {
                    list.style.display = 'none';
                    console.log('Hiding list');
                }
            });
        });
    });
});
</script>