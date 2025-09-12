<?
if (!defined('cms'))
    exit;

global $APPLICATION;
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
require_once "result_modifier.php";
?>
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
                            } ?> href="/video<?=EX?>/"><span>Все видео</span></a></li>
                        <li><a <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-technologies") {
                                echo ' class="active" ';
                            } ?> href="/video<?=EX?>/?section=Weintek-technologies"><span>Технологии Weintek</span></a></li>
                        <li><a <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-products") {
                                echo ' class="active" ';
                            } ?> href="/video<?=EX?>/?section=Weintek-products"><span>Продукция Weintek</span></a></li>
                        <li><a <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-EasyBuilder-Pro") {
                                echo ' class="active" ';
                            } ?> href="/video<?=EX?>/?section=Weintek-EasyBuilder-Pro"><span>EasyBuilder Pro</span></a></li>
                        <li><a <? if (isset($_GET["section"]) and $_GET["section"] == "eWON") {
                                echo ' class="active" ';
                            } ?> href="/video<?=EX?>/?section=eWON"><span>Продукция eWon</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12">
        </div>

    </div>
</div>

<article>
    <div class="columns is-multiline">
        <?
        $prev_section_name = "";
        foreach ($arResult["news_list"] as $key => $value) {
            /*if ($value["section_name"] != $prev_section_name) {
                $prev_section_name = $value["section_name"];
                echo '<div class="col-12"><h2 class="news_list__h2">' . $prev_section_name . '</h2></div>';
            }*/
            //var_dump($arguments["SEF"]);
            //$url = str_replace("#element_code#", $value["code"], $arguments["SEF"]["element"]);
            $url = "/video".EX."/" . $value["code"] . "/";
            ?>
            <div class="column is-3 <?= $value["section_sys_name"] ?>">
                <div class="news_list__item">
                    <a href="<?= $url ?>" class="news_list__item_link">
                        <div class="news_list__item_picture_preview_wrap">
                            <div class="news_list__item_picture_preview"
                                 style="background-image: url('<?= $value["picture_preview"]; ?>')"></div>
                        </div>
                        <div class="news_list__item_text_overflow">
                            <div class="news_list__item_name_wrap">
                                <div class="news_list__item_name" title="<?= $value["name"] ?>">
                                    <?
                                    if (strlen($value["name"]) > 80) {
                                        echo substr(strip_tags($value["name"]), 0, 77) . "...";
                                    } else {
                                        echo strip_tags($value["name"]);
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="news_list__item_text_wrap">
                                <div class="news_list__item_text">


                                    <?
                                    if (strlen($value["text_preview"]) > 150) {
                                        echo substr(strip_tags($value["text_preview"]), 0, 147) . "...";
                                    } else {
                                        echo strip_tags($value["text_preview"]);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <? if (isset($value["date"]) and $value["date"] != ""): ?>
                            <span class="news_list__item_date"><?
                                echo date("d.m.Y", strtotime($value["date"]));
                                ?></span><? endif; ?>

                    </a>
                </div>
            </div>
            <?
        }
        ?>
    </div>
</article>




