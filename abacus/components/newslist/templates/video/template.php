<?
if (!defined('cms'))
    exit;

global $APPLICATION,$CANONICAL;
$CANONICAL = "https://www.rusavtomatika.com/video/";
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
<div class="tabs is-medium is-centered mb-3 is-toggle is-fullwidth">
  <ul>
    <li <? if (!isset($_GET["section"])) {
                                echo ' class="is-active" ';
                            } ?>><a href="/video<?=EX?>/">Все видео</a></li>
    <li <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-technologies") {
                                echo ' class="is-active" ';
                            } ?>><a href="/video<?=EX?>/?section=Weintek-technologies">Технологии Weintek</a></li>
    <li <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-products") {
                                echo ' class="is-active" ';
                            } ?>><a href="/video<?=EX?>/?section=Weintek-products">Продукция Weintek</a></li>
    <li <? if (isset($_GET["section"]) and $_GET["section"] == "Weintek-EasyBuilder-Pro") {
                                echo ' class="is-active" ';
                            } ?>><a href="/video<?=EX?>/?section=Weintek-EasyBuilder-Pro">EasyBuilder Pro</a></li>
    <li <? if (isset($_GET["section"]) and $_GET["section"] == "eWON") {
                                echo ' class="is-active" ';
                            } ?>><a href="/video<?=EX?>/?section=eWON">Продукция eWon</a></li>
  </ul>
</div>

    </div>
</div>
<section id="videos">
  <div class="fixed-grid has-4-cols has-1-cols-mobile has-3-cols-tablet has-3-cols-desktop has-4-cols-widescreen has-4-cols-fullhd">
    <div class="grid">
        <?
        $prev_section_name = "";
        foreach ($arResult["news_list"] as $key => $value) {
            $url = "/video".EX."/" . $value["code"] . "/";
            ?>
      <div class="cell">
        <div class="card" style="height: 100%;">
          <div class="card-image"><a href="<?= $url ?>" target="_art">
            <figure class="image is-3by2"><img
        src="<?= $value["picture_preview"]; ?>"
        alt="<?= $value["name"] ?>"/> </figure></a>
          </div>
          <div class="card-content">
            <div class="media-content">
              <p class="title is-4 is-size-6 mb-2"><a href="<?= $url?>" target="_art">
                                    <?
                                    if (strlen($value["name"]) > 80) {
                                        echo mb_substr(strip_tags($value["name"]), 0, 77) . "...";
                                    } else {
                                        echo strip_tags($value["name"]);
                                    }
                                    ?>
                </a></p>
              <p class="is-6 is-size-7">
                <?= date("m.d.Y", strtotime($value['date']))?>
              </p>
            </div>
            <div class="content is-size-7">
                                    <?
                                    if (strlen($value["text_preview"]) > 150) {
                                        echo mb_substr(strip_tags($value["text_preview"]), 0, 147) . "...";
                                    } else {
                                        echo strip_tags($value["text_preview"]);
                                    }
                                    ?>
            </div>
          </div>
        </div>
      </div>
      <?}?>
    </div>
  </div>
</section>
