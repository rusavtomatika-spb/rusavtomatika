<?
if (!defined('cms'))
    exit;

global $APPLICATION;
include_once "result_modifier.php";

?>

<style>
 
.faq_filter{
  box-sizing: border-box;
    margin-bottom: 20px;
    padding: 10px 5px;
    background: #dff3df;
    text-align: center;
}

.faq_list{
  text-align: center;
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
  position:relative;
  background: #eeeeee;
  display: block;
  padding: 14px 46px;
  text-align:left;
}

img.faq_item_arrow {
  transform: translate(-50%, -50%) rotate(90deg);
    position: absolute;
    top: 24px;
    right: 0px;
    height: 25px;
    width: 25px;
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
    font-size: 21px;
    top: 0px;
    left: 0px;
    background: #eeeeee;
    line-height: 47px;
    width: 42px;
    text-align: center;
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


<div class="faq_list">
<?foreach($arResult["news_list"] as $item):?> 

<?$url = str_replace("#element_code#", $item["code"], $arguments["SEF"]["element"]);
?>
<a href="<?=$url?>">
  <div class="faq_list_item" data-tags="<?=str2url($item["tags"])?>">
  

    <span class="faq_item_znak">?</span>
    <?=$item["question"]?>

    <img class="faq_item_arrow" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAA2ElEQVRoge3XSwqDMBhF4bOJSrv/rRQKtaM6cDntQAUp3qIxMb9wDwii5vGRkeCcc84555zLUwPcgXa8P2UX4A18xqsHblV3lFADdAyA7uf+NCczP4keuC48C38ySwj1LizmH0J9Ew6zBqG+DYPZglBjqmNSEGpsNcwehJrjcEwOhJrrMExOhJqzOKYEQs1dDFMSodbIjjkCodbKhjkSodbcjamBUGsnY2oi1B42YyIg1F5WYyIhppIwLTH/5uZ/nc81Ax7Ai1iIqYZhb4/aG3HOOeecc65eX5pSdBnfAYalAAAAAElFTkSuQmCC">

  
    
  </div>
</a>
<?endforeach;?>
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

