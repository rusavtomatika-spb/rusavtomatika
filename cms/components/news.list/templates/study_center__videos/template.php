<?
if (!defined('cms'))
    exit;

global $APPLICATION;
//include_once "result_modifier.php";


?>


<div class="study_outer">
<div class="study_title"><h2>Учебные видео</h2></div>

    <div class="study_inner_block study_left">
        <div class="study_icon">
        <svg version="1.1" height="65px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 31.862 31.862" style="enable-background:new 0 0 31.862 31.862;" xml:space="preserve">
		<path d="M28.228,15.44c0,0-16.851,0-21.492,0l0.72-0.511c5.334-3.08,17.138-10.487,17.138-10.487
			c0.49-0.282,0.657-0.912,0.376-1.402l-1.026-2.528c-0.284-0.492-0.911-0.657-1.403-0.373l-19.42,11.8
			c-0.493,0.284-0.657,0.912-0.376,1.402l1.86,2.016l0.014,15.478c0,0.569,0.461,1.027,1.025,1.027h22.584
			c0.564,0,1.026-0.458,1.026-1.027V16.468C29.254,15.898,28.793,15.44,28.228,15.44z M20.782,16.174l-3.168,3.079h-4.106
			l3.081-3.079H20.782z M19.445,2.943l3.645-2.338l-0.532,3.432L18.83,6.429L19.445,2.943z M12.95,6.938l3.707-2.31l-0.662,3.479
			l-3.703,2.308L12.95,6.938z M5.563,14.626l0.62-3.487l3.68-2.349L9.24,12.27L5.563,14.626z M9.401,16.174h4.106l-3.077,3.079
			H6.324L9.401,16.174z M27.485,30.613H6.368v-9.759h21.117V30.613z M24.864,19.253h-4.171l3.082-3.079h4.073L24.864,19.253z"/>

</svg>
        </div>
    </div>
    <div class="study_inner_block study_right">
    <div class="blockofcols_container">

      <div class="blockofcols_row">
        <?foreach ($arResult["news_list"] as $item):?>

            <a class="study_article_item_url" href="/videos/<?=$item["code"]?>/">
            <div class="col-4">
                <div class="study_videos_item_inner">
                    <div class="study_videos_item" style="background-image: url('<?=$item["picture_preview"]?>');">
                    <?/*?><div class="study_article_date"><?=DateTime::createFromFormat('Y-m-d H:i:s', $item["date"])->format('Y-m-d');?></div><?*/?>

                    </div>
                    <div class="study_item"><?=$item["name"]?></div>
                    </div>
                </div>
            </a>

        <?endforeach;?>
            </div>
        </div>
        <div style="padding-left: 15px;"><a href="/video/">Все видео</a></div>
    </div>
</div>
