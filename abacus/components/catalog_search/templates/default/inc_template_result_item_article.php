<?
global $article;
if (isset($article['name']) and $article['name'] != '') {
    $no_first_td = false;
    if (!(isset($article["img"]) and $article["img"] != '')){
        $no_first_td = true;
    }
    ?>
    <tr class="tr_article_id<?= $article["id"]; ?> <?="freqs_".$article['freqs']?>">
        <? if (!$no_first_td) { ?>
            <td class="td_preview_image">
                <a target="_blank" href="<?= $article["link"] ?>">
                    <div class="preview_image">
                        <img loading="lazy" src="<?= $article["img"] ?>"/>
                    </div>
                </a>
            </td>
            <?
        } ?>
        <td class="td_short_description" <? if ($no_first_td) { echo ' colspan="2" ';} ?>>
            <a target="_blank" href="<?= $article["link"]; ?>" data-word="<?=$article['word']?>" data-word="<?=$article['table']?>">
                <span class="name"><? echo highlight_search($article["name"], $article['word']); ?><?if(isset($article["date"]) and $article["date"] !=''){echo " <span class='date'>".date( 'd-m-Y', strtotime($article["date"]))."</span>";}?><? //if(isset($article["freqs"]) and $article["freqs"] !=''){echo " <span class='date'>".$article["freqs"]."&nbsp;</span>";}?></span>
                <span class="stext"><?= highlight_search($article["stext"], $article['word']) ?></span>
            </a>
        </td>
    </tr>
    <?php
}
?>