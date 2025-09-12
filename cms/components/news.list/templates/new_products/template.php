<?
if (!defined('cms'))
    exit;

global $APPLICATION;
?>
<link rel="stylesheet" type="text/css" href="/cms/components/news.list/templates/new_products/style.css" />
<div class="blockofcols_container news_list">
    <div class="blockofcols_row">

        <div class="col-12"><nav style="margin:15px 15px;"><a href="/">Главная</a>&nbsp;/&nbsp;Новые продукты</nav></div>
        <article>
            <div class="col-12">
            
            <div class="col-12">
                <h1>Новые продукты</h1>
            </div>
        </div>
        
        <div class="col-12">
            <?
            $prev_section_name = "";
            foreach ($arResult["news_list"] as $key => $value) {
                /*
                if ($value["section_name"] != $prev_section_name) {
                    $prev_section_name = $value["section_name"];
                    echo '<div class="col-12"><h2 class="news_list__h2">' . $prev_section_name . '</h2></div>';
                }*/

                $url = str_replace("#element_code#", $value["code"], $arguments["SEF"]["element"]);
                ?>
                <div class="col-12">
                    <div class="news_list__item">
                        <a href="<?if($value["url_page_detail"]):?><?=$value["url_page_detail"]?><?else:?><?= $url ?><?endif?>" class="news_list__item_link">
                            <div class="blockofcols_row">
                                <div class="col-2">
                                    <div class="news_list__item_picture_preview_wrap"><div class="news_list__item_picture_preview" style="background-image: url('<?= $value["picture_preview"]; ?>')"></div></div>
                                </div>
                                <div class="col-10">
                                    <div class="news_list__item_name_wrap">
                                        <div class="news_list__item_name" title="<?= $value["name"] ?>">
                                            <?
                                            if (strlen($value["name"]) > 160) {
                                                echo substr(strip_tags($value["name"]), 0, 157) . " ...";
                                            } else {
                                                echo strip_tags($value["name"]);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="news_list__item_text_wrap">
                                        <div class="news_list__item_text">

                                            <? if (isset($value["date"]) and $value["date"] != "0000-00-00"): ?>
                                                <span class="news_list__item_text__date"><?
                                                    echo date("d.m.Y", strtotime($value["date"]));
                                                    ?></span>
                                            <? endif; ?>

                                            <?
                                            if (strlen($value["text_preview"]) > 300) {
                                                echo substr(strip_tags($value["text_preview"]), 0, 297) . "...";
                                            } else {
                                                echo strip_tags($value["text_preview"]);
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?
            }
            ?>
        </div>
        </article>
    </div>
</div>
