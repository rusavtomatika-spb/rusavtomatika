<link rel="stylesheet" type="text/css" href="/sc/popup_catalog_menu/popup_catalog_menu.css?r=<?= rand() ?>"/>
<div id="vue_app_menu"  >
    <div class="button_open_menu" :class="[{'active':menu_is_visible},{'button_open_menu_is_visible':!menu_is_visible}, {'button_open_menu_is_not_visible': menu_is_visible, }]"  @click='open_menu()'>
        Каталог оборудования <span class="arrow-down"></span>
    </div>
    <div class="vue_app_menu_background_panel"
         :class="{'menu_is_visible':menu_is_visible, 'menu_is_not_visible': !menu_is_visible, }" v-on:click.stopPropagation='close_menu'>
        <table class="dropdown_main_menu" style="opacity: 0;" v-bind:style="{ opacity: dropdown_main_menu_opacity }">
            <tr>
                <td class="col_1" :class="{active: current_filter_type == 'category'}">
                    <div>
                        <div :key="index"
                             :class="['menu_category_item', item.menu_category_item_code, {'active': item.active}]"
                             @click="menu_category_select(index)" v-for="(item, index) in menu_category">{{item.name}}
                        </div>
                    </div>
                </td>
                <td class="col_2" :class="{active: current_filter_type == 'brand'}">
                    <div :key="index"
                         :class="['menu_brand_item', {'active': item.active}]"
                         @click="menu_brand_select(index)" v-for="(item, index) in menu_brands">{{item.name}}
                    </div>
                </td>
                <td class="col_3">
                    <div class="menu_result_panel_category" :class="{active: current_filter_type == 'category'}">
                        <a v-if="(current_menu_result_panel_category__link != '')" :href="current_menu_result_panel_category__link">
                            <div class="menu_result_panel_category__title">
                                {{current_menu_result_panel_category__title}}<span class="go_to_category_button">Перейти в категорию</span>
                            </div>
                        </a>
                        <div v-if="(current_menu_result_panel_category__link == '')" >
                            <div class="menu_result_panel_category__title">{{current_menu_result_panel_category__title}} &nbsp;</div>
                        </div>
                        <div class="rolldown_to_brand_buttons">
                        <span @click='scroll_to_brand("brand_"+button.name)'
                              class="rolldown_to_brand_button button_white_md"
                              v-for="(button, index) in rolldown_to_brand_buttons">{{button.name}}</span>
                        </div>
                        <div class="menu_white_panel" :class="{'loading': loading_status }">
                            <div class="str_menu_get_category_filtered_items"
                                 v-html="html_menu_get_filtered_items_category">
                            </div>
                        </div>
                    </div>
                    <div class="menu_result_panel_category" :class="{active: current_filter_type == 'brand'}">
                        <a :href="current_menu_result_panel_brand__link">
                        <div class="menu_result_panel_brand__title">{{current_menu_result_panel_brand__title}}<span
                                    class="go_to_brand_button">Перейти в бренд</span></div>
                        </a>

                        <div class="rolldown_to_category_buttons">
                        <span @click='scroll_to_category("category_"+category.code)'
                              class="rolldown_to_category_button button_white_md"
                              v-for="(category, index) in rolldown_to_category_buttons">{{category.name}}</span>
                        </div>
                        <div class="menu_white_panel" :class="{'loading': loading_status }" >
                            <div class="str_menu_get_category_filtered_items"
                                 v-html="html_menu_get_filtered_items_by_brand">
                            </div>
                        </div>
                    </div>

                    <div class="loading_info_panel" :class="{'loading': loading_status }"></div>
                    <div class="button_close_menu" v-on:click.stopPropagation='close_menu'></div>
                </td>
            </tr>
        </table>
    </div>

</div>


