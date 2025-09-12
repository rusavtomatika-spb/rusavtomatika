<?
if (!defined('cms'))
    exit;

global $APPLICATION;
?>
<style>
    .news_list__item {
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
        padding: 0px 10px 16px 10px;
        /*transition: box-shadow 0.05s;*/
        margin-top: 15px;
        margin-bottom: 15px;
        position: relative;
        height: 354px;
    }

    .news_list__item:hover {
        padding: 1px 11px 17px 11px;
        margin: 14px -1px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);

    }

    .news_list__item_picture_preview_wrap {
        padding: 10px;
        box-sizing: border-box;
        width: 100%;
        height: 220px;
        background: #f3f3f3;
        margin: 0px -10px 0px;
        position: absolute;
        top: 52px;
    }

    .news_list__item:hover .news_list__item_picture_preview_wrap {
        margin: 0px -11px 0px;
    }

    .news_list__item_picture_preview {
        width: 100%;
        height: 200px;
        background: center top /100% auto;
        margin: 0 auto;
    }

    .news_list__item_link {
        text-decoration: none;
        color: #333;
    }

    .news_list__item_link:hover {
        text-decoration: none;
        color: #333;
    }

    .news_list__item_name_wrap {
        display: block;
        width: 100%;
        background: rgba(255, 255, 255, 0.5);
        padding: 0 10px;
        box-sizing: border-box;
        position: relative;
        z-index: 10;
    }

    .news_list__item_name {
        display: block;
        width: 100%;
        font-size: 14px;
        font-weight: bold;
        line-height: 1.1;
        vertical-align: top;
        height: auto;
        text-align: left;
        padding: 10px 0 10px;
    }

    .news_list__item_text_wrap {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 10px;
        position: absolute;
        bottom: 0px;
        background: #fff;
        z-index: 10;
        margin: 0 -10px;
        height: 97px;
    }

    .news_list__item:hover .news_list__item_text_wrap {

    }

    .news_list__item_text {
        display: display;
        width: 100%;
        height: auto;
        overflow: hidden;
        text-align: left;
        line-height: 1.1;
        padding-bottom: 5px;
    }

    .news_list__h2 {
        background: #f3f3f3;
        padding: 5px 10px;
    }

</style>

<div class="blockofcols_container news_list">
    <div class="blockofcols_row">
        <div class="col-12">
            <div class="col-12">
                <nav><a href="/">Главная</a>&nbsp;/&nbsp;Видеоканал</nav>
            </div>
            <div class="col-12">
                <h1>Видео Weintek EasyBuilder Pro | eWON | Видеоканал rusavtomatika.com</h1>
            </div>
        </div>
        <div class="col-12">
            <div class="col-12">
                <div class="sub-menu"
                     style="box-sizing:border-box;margin: 20px auto;padding: 10px 5px;background: #dff3df;">
                    <ul id="table_of_contents" style="text-align: center;">
                        <li><a <? if (!isset($_GET["section"])) {
                                echo ' class="active" ';
                            } ?> href="/video/"><span>Все видео</span></a></li>
                        <li><a <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-technologies") {
                                echo ' class="active" ';
                            } ?> href="/video/?section=Weintek-technologies"><span>Технологии Weintek</span></a></li>
                        <li><a <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-products") {
                                echo ' class="active" ';
                            } ?> href="/video/?section=Weintek-products"><span>Продукция Weintek</span></a></li>
                        <li><a <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-EasyBuilder-Pro") {
                                echo ' class="active" ';
                            } ?> href="/video/?section=Weintek-EasyBuilder-Pro"><span>EasyBuilder Pro</span></a></li>
                        <li><a <? if (isset($_GET["section"]) and $_GET["section"] == "eWON") {
                                echo ' class="active" ';
                            } ?> href="/video/?section=eWON"><span>Продукция eWon</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12">
            <article>
                <?
                $prev_section_name = "";
                foreach ($arResult["news_list"] as $key => $value) {
                    /*if ($value["section_name"] != $prev_section_name) {
                        $prev_section_name = $value["section_name"];
                        echo '<div class="col-12"><h2 class="news_list__h2">' . $prev_section_name . '</h2></div>';
                    }*/
                    //var_dump($arguments["SEF"]);
                    $url = str_replace("#element_code#", $value["code"], $arguments["SEF"]["element"]);
                    ?>
                    <div class="col-4 <?= $value["section_sys_name"] ?>">
                        <div class="news_list__item">
                            <a href="<?= $url ?>" class="news_list__item_link">
                                <div class="news_list__item_name_wrap">
                                    <div class="news_list__item_name" title="<?= $value["name"] ?>">
                                        <?
                                        if (strlen($value["name"]) > 100) {
                                            echo substr(strip_tags($value["name"]), 0, 97) . "...";
                                        } else {
                                            echo strip_tags($value["name"]);
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="news_list__item_picture_preview_wrap">
                                    <div class="news_list__item_picture_preview"
                                         style="background-image: url('<?= $value["picture_preview"]; ?>')"></div>
                                </div>
                                <div class="news_list__item_text_wrap">
                                    <div class="news_list__item_text">

                                        <? if (isset($value["date"]) and $value["date"] != ""): ?>
                                            <span><?
                                                echo date("d.m.Y", strtotime($value["date"]));
                                                ?></span> |
                                        <? endif; ?>

                                        <?
                                        if (strlen($value["text_preview"]) > 200) {
                                            echo substr(strip_tags($value["text_preview"]), 0, 197) . "...";
                                        } else {
                                            echo strip_tags($value["text_preview"]);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?
                }
                ?>
            </article>
        </div>

    </div>
</div>
