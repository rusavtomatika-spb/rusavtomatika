<div class="loader"></div><div id="control_panel">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="filter_block_column first">
                    <? /* ?><a class="orders_logo" href="/orders/">Orders</a><? */ ?>
                    <span title="Все заявки" class="all_orders_button green_button" data-action="all_orders">
                        Заявки
                    </span>
                    <span title="Добавить новый продукт" class="add_product_button green_button" data-action="add_product">
                        Добавить новый продукт
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="filter_block_column">                    
                    <div class="filter_period">
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_activeness[]" data-value="1">Активные</span>                        
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_activeness[]" data-value="0">Неактивные</span>                        
                    </div>
                </div> 
            </div>
            <div class="col-md-4">
                <div class="filter_block_column">                    
                    <div class="filter_period">
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_brand[]" data-value="aplex">Aplex</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_brand[]" data-value="weintek">Weintek</span>
                    </div>
                </div> 
            </div> 
            <div class="col-md-3">
                <div class="filter_block_column last">                    
                    <div id="login_panel"></div>
                </div>                    
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="filter_block_column first">
                    <div class="block_filter_by_product" > 
                        <input  class="block_filter_by_product_value" type="hidden" value=""  placeholder="поиск по товару"/>
                        <input autocomplete="off" class="input_filter_by_product" type="text" placeholder="поиск по товару" /> <span class="input_filter_by_product_go">></span>
                    <span title="Сбросить фильтр по товару" class="clear_inputs">X</span>
                    <div id="result_input_filter_by_product"></div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-3">
            </div>

        </div>
    </div>       
</div>
</div>   

