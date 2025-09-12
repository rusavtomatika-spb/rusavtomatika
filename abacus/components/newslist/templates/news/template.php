<?php
$current_folder_url = str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__);
CoreApplication::add_style($current_folder_url . "/style.css");
CoreApplication::add_script($current_folder_url . "/newslist_news_scripts.js");

global $TITLE, $DESCRIPTION, $KEYWORDS, $CANONICAL;
if ( isset( $_GET[ 'page' ] ))  {
	$page_n = " - Страница ".$_GET[ 'page' ];
	$page_num = "?page=".$_GET[ 'page' ];
} else {
	$page_n = "";
	$page_num = "";
}

$TITLE = "Новости о продукции Weintek, IFC, Aplex, eWON, Samkoon".$page_n;
$DESCRIPTION = "Новости от компании Русавтоматика: Автоматизация производства, панели оператора, промышленные компьютеры, Индустрия 4.0.".$page_n;
$KEYWORDS = "Новости,Weintek,IFC,Aplex,eWON,Samkoon";
$CANONICAL = "https://www.rusavtomatika.com/news/".$page_num;

global $extra_openGraph;
$extra_openGraph = array(
    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/news.png",
    "openGraph_title" => "Новости компании Русавтоматика",
    "openGraph_siteName" => "Русавтоматика"
);


CoreApplication::add_breadcrumbs_chain("Новости", "/news/");

if (isset($_COOKIE["edit_mode"]) && $_COOKIE["edit_mode"] == '1') $edit_mode = true; else $edit_mode = false;
?>
<style>
    [v-cloak] {
        display: none;
    }
</style>
<div id="vue_app_news" style="display: none">
    <? if ($_SERVER["HTTP_HOST"] == "www.rusavto.moisait.net"): ?>
        <div id="admin_panel" v-cloak>
            <?php
            if ($edit_mode) {
                ?>
                <div class="switch_edit_mode__wrapper">
                    <div>
                        <span>Режим редактирования включен</span>
                        <button class="switch_edit_mode__button active" @click="switch_edit_mode__button_clicked">
                            Выключить
                        </button>
                    </div>
                </div>
                <div v-if="edit_panel_show" class="edit_panel">
                    <button class="close_button" @click="edit_close_element_button__clicked">X</button>
                    <input type="hidden" :value="current_edit_item.id">
                    <div class="edit_panel_item buttons">
                        <span>Редактирование</span>
                        <button @click="edit_restore_element_button__clicked(current_edit_item)">Восстановить</button>
                        <button @click="edit_save_element_button__clicked">Сохранить</button>
                        <button @click="edit_save_and_close_element_button__clicked(current_edit_item.id)">
                            Сохранить и закрыть
                        </button>
                        <button @click="edit_close_element_button__clicked">Закрыть без сохранения</button>
                    </div>
                    <div class="edit_panel_item show_wrap">
                        <label for="checkbox_show">Показывать на сайте</label>
                        <input type="checkbox" id="checkbox_show" v-model="current_edit_item.show">
                    </div>
                    <div class="edit_panel_item date_wrap"><span>Дата</span>
                        <input type="text" v-model="current_edit_item.date">
                    </div>
                    <div class="edit_panel_item name_wrap"><span>Наименование (H1)</span>
                        <input type="text" v-model="current_edit_item.name">
                    </div>
                    <div class="edit_panel_item sys_name_wrap"><span>Код (для url)</span>
                        <input type="text" v-model="current_edit_item.sys_name">
                        <div>
                            <button @click="generate_code">+</button>
                        </div>
                    </div>

                    <div class="edit_panel_item title_cat_wrap"><span>Title</span>
                        <input type="text" v-model="current_edit_item.title_cat">
                    </div>
                    <div class="edit_panel_item description_wrap"><span>Description</span>
                        <input type="text"
                               v-model="current_edit_item.description">
                    </div>
                    <div class="edit_panel_item keywords_wrap"><span>Keywords</span>
                        <input type="text"
                               v-model="current_edit_item.keywords">
                    </div>

                    <div class="edit_panel_item img_wrap">
                        <span>Изображение анонса</span>
                        <span><img style="max-height: 50px;margin-right: 10px;" :src="current_edit_item.img"></span>
                        <input type="text" v-model="current_edit_item.img">
                        <div style="padding: 10px">
                            <label for="image_file">Загрузка</label>
                            <span>[*.jpg, *.png, *.webp]</span>
                            <div style="height: 5px"></div>
                            <input type="file" accept="image/jpeg,image/png,image/webp" id="image_file" ref="file"
                                   v-on:change="handleFileUpload()"/>

                        </div>
                        <button v-on:click="submitFile(current_edit_item.id,'preview')">Загрузить</button>
                    </div>
                    <div class="edit_panel_item alt_wrap"><span>Альт изображения</span>
                        <input type="text" v-model="current_edit_item.alt">
                    </div>


                    <div class="edit_panel_item stext_wrap"><span>Анонс</span>
                        <textarea v-model="current_edit_item.stext" name="" id="" cols="30" rows="10"></textarea></div>
                    <div class="edit_panel_item btext_wrap"><span>Подробно</span>
                        <textarea
                                v-model="current_edit_item.btext" name="" id="mytextarea" cols="30"
                                rows="10"></textarea>
                        <!--textarea v-model="current_edit_item.btext" name="" id="mytextarea2" cols="30" rows="10"></textarea-->
                    </div>
                    <div class="edit_panel_item">
                        <span>Доп. Изображения</span>
                        <div style="width: 100%;box-shadow: 0 0 5px rgba(0,0,0,0.5) inset;">
                            <span class="edit_panel_item__more_images"
                                  v-for="(image_item, image_index) in current_edit_item.images">
                            <img style="height:40px" :src="image_item">
                                <span>{{image_item}}</span>
                            </span>

                        </div>
                        <div style="padding: 10px;">
                            <div>
                                <span>[*.jpg, *.png, *.gif, *.webp,*.pdf]</span>
                                <input type="file" accept="image/jpeg,image/png,image/gif,image/webp,application/pdf"
                                       id="image_file2" ref="file2"
                                       v-on:change="handleFileUpload()"/>
                            </div>
                        </div>
                        <div style="padding: 10px;">
                            <button v-on:click="submitFile(current_edit_item.id,'details')">Загрузить</button>
                        </div>
                    </div>


                    <div class="edit_panel_item buttons">
                        <span>Редактирование статьи</span>
                        <button @click="edit_restore_element_button__clicked(current_edit_item.id)">Восстановить
                        </button>
                        <button @click="edit_save_element_button__clicked(current_edit_item.id)">Сохранить</button>
                        <button @click="edit_save_and_close_element_button__clicked(current_edit_item.id)">
                            Сохранить и закрыть
                        </button>
                        <button @click="edit_close_element_button__clicked">Закрыть без сохранения</button>
                    </div>
                    <div v-if="showing_popup_message" class="popup_message">{{text_popup_message}}</div>


                </div>
                <div v-if="showing_delete_confirm_message" class="popup_confirm_message">
                    <div v-html="text_delete_confirm"></div>
                    <button class="button_yes" @click="delete_element">Удалить</button>
                    <button class="button_no" @click="showing_delete_confirm_message = false">Отменить</button>
                </div>


                <?php
            } else {
                ?>
                <div class="switch_edit_mode__wrapper">
                    <div>
                        <span>Режим редактирования выключен</span>
                        <button class="switch_edit_mode__button" @click="switch_edit_mode__button_clicked">
                            Включить
                        </button>
                    </div>
                    <div></div>
                </div>
            <?php } ?>
        </div>
    <? endif; ?>

    <div class="component_newslist">
        <?
        CoreApplication::include_component(array("component" => "breadcrumbs"));

        ?>
        <article>
            <h1>Новости Weintek, IFC, Aplex, eWON, Samkoon</h1>
            <p>Новости автоматизации управления — использование и настройка. Панели оператора Weintek, панельные
                компьютеры Aplex, панельные и встраиваемые компьютеры IFC, промышленные мониторы IFC, панели
                оператора Samkoon, vpn-роутеры eWON.</p>
            <div class="component_wrapper" v-cloak>
                <div id="rendering_content_source">
                    <div class="row">
                        <div :key="product_index"
                             :class="['col-md-12 discount_item', {'active': product_item.active}]"
                             v-for="(product_item, product_index) in arr_filtered_items">
                            <div class="item" :class=" 'show_' + product_item.show ">
                                <div class="preview_image_wrapper">
                                    <a :href="product_item.link">
                                        <div class="preview_image"
                                             :style="{ backgroundImage: 'url(' + product_item.img + ')' }"></div>
                                    </a>
                                </div>
                                <div class="text_wrapper">
                                    <div class="title">
                                        <a :href="product_item.link"><span class="date">{{product_item.date}}</span>
                                            {{product_item.name}}</a>
                                    </div>
                                    <div></div>
                                    <div class="text"><a :href="product_item.link"><span
                                                    v-html="product_item.stext"></span> <span
                                                    class="component_newslist__link_word">Читать</span></a></div>
                                </div>
                                <?
                                if ($edit_mode) {
                                    ?>
                                    <div class="edit_element_buttons_wrapper">
                                        <div>
                                            <!--ad-- в режиме редактирования отображаем Id новости-->
			                                      <div style='float:right; font-size:12px; color:gray; margin-right:15px;'>Id: <span v-html='product_item.id'></span></div>

                                            <div>
                                                <button @click="copy_element_button__clicked(product_item)">
                                                    Копировать
                                                </button>
                                            </div>
                                            <div>
                                                <button @click="edit_element_button__clicked(product_item)">
                                                    Редактировать
                                                </button>
                                            </div>
                                            <div>
                                                <button v-if="product_item.show == '1'"
                                                        @click="deactivate_element_button_clicked(product_item)">
                                                    Деактивировать
                                                </button>
                                                <button v-if="product_item.show == '0'"
                                                        @click="activate_element_button_clicked(product_item)">
                                                    Активировать
                                                </button>
                                            </div>
                                            <div>
                                                <button @click="deleting_element_index=product_index; show_popup_delete_confirm_message(product_item)">
                                                    Удалить
                                                </button>
                                            </div>
                                        </div>
                                    </div><?
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-md-12" v-if="arr_pager_items.length > 0">
                            <div class="pager_wrapper">
                                <div class="pager_title"><span>Страницы:</span></div>
                                <div :key="pager_index" :class="['pager_item', {'active': pager_item.active}]"
                                     v-for="(pager_item, pager_index) in arr_pager_items">
                                    <a v-if="!pager_item.active"
                                       :href="(pager_item.link.length > 0)?pager_item.link:'/news/'">{{pager_item.name}}</a>
                                    <span v-if="pager_item.active">{{pager_item.name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="rendering_content_dest">
                <?
                echo CoreApplication::get_cache_content($_SERVER['REQUEST_URI']);
                ?>

            </div>
        </article>

    </div>

</div>
</div>
<style>
    /*    .tox.tox-tinymce {
            width: 100%;
        }

        .tox-notifications-container {
            display: none !important;
        }*/
</style>


<script src="/js/tinymce/tinymce.min.js"></script>
<script>

</script>
