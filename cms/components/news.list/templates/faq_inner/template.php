<?
if (!defined('cms'))
    exit;

global $APPLICATION;
include_once "result_modifier.php";

?>

<style>
 
.faq_filter{
  box-sizing: border-box;
    padding: 10px 5px;
    background: #dff3df;
    position: relative;
    z-index: 999;
}

.faq_list{
  text-align: center;
  width: 352px;
  margin-top: 19px;
}
.faq_list a{
  text-decoration: none;
}
.filter_tag_item{
  color: #333;
    text-decoration: none;
    background: #f0f0f0;
    display: inline-block;
    padding: 5px 10px;
    margin: 5px 3px;
    cursor: pointer;
    background: #ffffff;
    
}

.filter_tag_item.active, .filter_tag_item:hover{
  background: #44bb6e;
  color: #fff;
}
.faq_list_item{
  text-align: center;
    margin-bottom: 18px;
    z-index: 2;
    position: relative;
    background: #eeeeee;
    display: block;
    padding: 14px 7px;
    padding: 14px 30px 14px 7px;
    text-align: left;
}

svg.faq_item_arrow {
  position: absolute;
    top: 18px;
    right: 8px;
    fill: #44bb6e;
    height: 14px;
}

.faq_list_item:hover svg.faq_item_arrow {
    fill: #0086BF;
}
.faq_list_item:hover  {
  background: #f9f9f9;
  transition: 0.2s;
}

.faq_item_question{
    background: #dff3df;
    vertical-align: top;
    min-height: 20px;
    text-align: left;
    padding: 15px;
}

span.faq_item_znak{
  display: inline-block;
    position: absolute;
    top: 0px;
    left: 0px;
    line-height: 47px;
    width: 38px;
    text-align: center;
}
.faq_scroll_window{
  height: 615px;
    overflow-y: scroll;
    overflow-x: hidden;
    width: 376px;

    
}

.faq_menu_buttom{
  opacity: 1;
  cursor:pointer;
  z-index: 1000;
}
.faq_menu_hide .faq_menu_buttom{
  opacity: 0.75;
}
.faq_menu_hide:hover .faq_menu_buttom{
  opacity:1;
}


.faq_filter{
  box-shadow: 0 0 10px rgba(0,0,0,0.5);
}
</style>



<div class="faq_filter">

  <ul class="faq_filter_inner">
  <li class="filter_tag_item"  data-code="all">
  Âñ¸
  </li>
    <?foreach($newAllTags as $tag):?>
    <li class="filter_tag_item"  data-code="<?=$tag["trans"]?>">
      <?=$tag["orig"]?>
    </li>
      
    <?endforeach;?>
  </ul>

</div>
<div class="faq_scroll_window">

<div class="faq_list">
<?foreach($arResult["news_list"] as $item):?> 

<?$url = str_replace("#element_code#", $item["code"], $arguments["SEF"]["element"]);
?>
<a href="<?=$url?>">
  <div class="faq_list_item" data-id="<?=$item["id"]?>" data-tags="<?=str2url($item["tags"])?>">
  

    <?=$item["question"]?>

    <svg class="faq_item_arrow" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 240.823 240.823" xml:space="preserve">
	<path id="Chevron_Right_1_" d="M183.189,111.816L74.892,3.555c-4.752-4.74-12.451-4.74-17.215,0c-4.752,4.74-4.752,12.439,0,17.179
		l99.707,99.671l-99.695,99.671c-4.752,4.74-4.752,12.439,0,17.191c4.752,4.74,12.463,4.74,17.215,0l108.297-108.261
		C187.881,124.315,187.881,116.495,183.189,111.816z"/>
</svg>


  
    
  </div>
</a>
<?endforeach;?>
</div>
</div>




<script>




function showQuestion(tag){
  coce = "faqtag=" + tag + ";path=/faq;";
  document.cookie = coce;
  if(tag == "all"){
    $(".faq_list_item").show();
  }else{
    $(".faq_list_item").hide();
  $(".faq_list_item").each(function() {
    curTags = $(this).attr("data-tags");
    if(curTags.indexOf(tag) != -1){
      $(this).show();
    }
   
  });
  }

}
var cookie = $.cookie("faqtag");
if(cookie!=null) { 
  $('.filter_tag_item[data-code='+ cookie + ']').addClass('active');
  showQuestion(cookie);
}



$('.filter_tag_item').click(function(event) {
    $('.filter_tag_item').removeClass('active');
    $(this).addClass('active');
   curTag = $(this).attr("data-code");
   showQuestion(curTag);
    });
</script>

