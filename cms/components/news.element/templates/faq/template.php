<?
if (!defined('cms'))
    exit;
$properties = $arResult["element"]["properties"];
?><nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/faq/">Учебный центр</a>&nbsp;/&nbsp;<?= $arResult["element"]["question"] ?></nav>

<style>
.faq_menu{
    position: absolute;
    width: 337px;
    transition: 0.3s;
    top: 15px;
    left: 0px;
    height: 700px;
    padding-right: 40px;
    overflow: hidden;
    background: #dedede;
    z-index: 2;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
}


.faq_menu.faq_menu_hide{
    transition: 0.3s;
    box-shadow: none;
}
.faq_content{
    margin-left: 379px;
}
.faq_menu_hide{
    width: 57px;
    transition:0.3s;
}

.faq_menu_hide:hover {
    width: 60px;
    transition:0.05s;
}

.faq_menu_buttom{
    z-index: 123;
    position: absolute;
    top: 0px;
    right: 0px;
    background: #44bb6e;
    width: 32px;
    height: 34px;
  transition:0.3s;
}
.faq_menu_buttom_symb {
    transform: rotate(-90deg) translate(50%,7px);
    transition: 0.3s;  
    position: absolute;
    top: 50%;
}
.faq_menu_buttom_symb svg{
    height: 16px;
    fill: white;
}
.faq_menu_buttom_symb_swipe{
    transform: rotate(90deg) translate(-50%, -7px);
    transition: 0.3s;
}

.faq_filter,.faq_list{
    width: 377px;
}

.news_element_default{
    min-height: 715px;
}
.faq_filter_inner{
    width: 319px;
}
.faq_menu_hide .faq_menu_buttom{
    height: 100%;
}

.faq_menu_hide_defence{
    position: absolute;
    height: 100%;
    width: 100%;
    z-index: 1025;
    cursor: pointer;
    display:none;
}
.faq_menu_hide_defence_setup{
    display:block;
}
.faq_list_item-current{
    background: #44bb6e!important;
    color: white;
    cursor: default;
}
.faq_list_item-current .faq_item_arrow{
    display: none;
    }
</style>

<div class="news_element_default">
    <div class="blockofcols_container news_element">
        <div class="blockofcols_row">
        <div class="col-12">
        <div class="faq_menu">
        <div class="faq_menu_hide_defence"></div>
            <?

$SEF = Array("element" => "/faq/#element_code#/");
$SEO = Array("element_title" => "Вопрос: #element_name#");
$arguments = Array(
    "db_table" => "faq",
    "order_by" => "id",
    "template_element" => "faq",
    "template_list" => "faq_inner",
    "filter" => $filter,
    "SEF" => $SEF,
    "SEO" => $SEO, "path_to_images" => "/images/video/",
    "titles" => $titles,
    "current_component" => $current_component, "element_code" => $element_code);

$APPLICATION->IncludeComponent("news", "faq", $arguments);
/* * * END *** Подключение компонента новостей */?>

<div class="faq_menu_buttom">
    <div class="faq_menu_buttom_symb">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 511.98 511.98" xml:space="preserve">
            <polygon points="18.468,467.029 255.99,55.638 493.497,467.029 "/>
            <path d="M255.99,34.295L0,477.685h511.98L255.99,34.295z M255.99,76.966l219.039,379.392H36.935
	L255.99,76.966z"/>
        </svg>
    </div>
</div>

           </div>
        <article>
        <div class="faq_content">
                <? if (isset($arResult["element"]["question"]) and $arResult["element"]["question"] != ""): ?>
                    <h1><?= $arResult["element"]["question"] ?></h1>
                <? else: ?>
                    <h1><?= $arResult["element"]["question"] ?></h1>
                <? endif; ?>
                    
                <?/* if (isset($arResult["element"]["date"]) and $arResult["element"]["date"] != ""): ?>
                    <p><?
                        echo date("d.m.Y", strtotime($arResult["element"]["date"]));
                        ?></p>
                <? endif; */?>
                <div class="news_element_default_code_video">
                    <?= $arResult["element"]["answer"] ?>
                </div>
                </div>
                </article>
<span class="asdasd"></span>

<script>

$('.faq_list_item[data-id="<?= $arResult["element"]["id"] ?>"').addClass("faq_list_item-current").parent().click(function(){
    return false;
});
$(document).ready(function() {
    var s = $('.faq_list_item-current').position().top - $(".faq_filter").innerHeight();
$(".faq_scroll_window").scrollTop(s);
});
<?/*?>
$(document).mouseup(function (e){ 
		var div = $(".faq_menu");
		if (!div.is(e.target)
		    && div.has(e.target).length === 0 && !$(".faq_menu").hasClass('faq_menu_hide')) { 
                $(".faq_menu_hide_defence").toggleClass("faq_menu_hide_defence_setup");
                $(".faq_menu").toggleClass("faq_menu_hide");
                $(".faq_menu_buttom_symb").toggleClass("faq_menu_buttom_symb_swipe");
		}
	});
    <?*/?>

$(".faq_menu_buttom").click(function(){
    $(".faq_menu_hide_defence").toggleClass("faq_menu_hide_defence_setup");
    $(".faq_menu").toggleClass("faq_menu_hide");
    $(".faq_menu_buttom_symb").toggleClass("faq_menu_buttom_symb_swipe");
    $(".faq_content").css("margin-left", "91px");

});

$(".faq_menu_hide_defence").click(function(){
    $(".faq_menu_hide_defence").toggleClass("faq_menu_hide_defence_setup");
    $(".faq_menu").toggleClass("faq_menu_hide");
    $(".faq_menu_buttom_symb").toggleClass("faq_menu_buttom_symb_swipe");
    $(".faq_content").css("margin-left", "379px");

});


</script>

<style>
    .news_element_default ul{
        margin: 0 10px;
    }
    .news_element_default ul li{
        margin: 5px 10px;
    }
    .news_element_default iframe{
        margin: 0px;display: block;
    }
    .news_element_default_code_video{
        margin-bottom: 20px;
    }
 

</style>
    

            </div>
          
     
        </div>
    </div>
</div>