<div class="loader"></div><div id="control_panel">
    <div class="container">
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2">
                <div class="filter_block_column">                    
                    <div class="filter_period">
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_activeness[]" data-value="1">Активные</span>                        
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_activeness[]" data-value="0">Неактивные</span>                        
                    </div>
                </div> 
            </div>
            <div class="col-md-2">
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
            <div class="col-md-5">
                <div class="filter_block_column">
                    <div class="filter_period">
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_year[]" data-value="2019">2019</span>
                        <span> </span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="1">1</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="2">2</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="3">3</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="4">4</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="5">5</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="6">6</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="7">7</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="8">8</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="9">9</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="10">10</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="11">11</span>
                        <span class="gray_green_button filter_panel_button" data-parameter="filter_period_month[]" data-value="12">12</span>                        

                        <span class="refresh_button" data-action="do_filter"></span></div>
                </div> 
            </div>
            <div class="col-md-3">
                <div class="filter_block_column last">
                    <? /* ?><a class="orders_logo" href="/orders/">Orders</a><? */ ?>
                    <span title="Добавить новый продукт" class="add_product_button green_button" data-action="add_product">
                        Нов.продукт
                    </span>
                    <span title="Все заявки" class="all_orders_button green_button" data-action="all_orders">
                        Заявки
                    </span>
                </div>
            </div>

        </div>
    </div>       
</div>
</div>   

