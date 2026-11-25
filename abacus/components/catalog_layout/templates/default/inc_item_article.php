<?php
/**
 * ОДНА карточка статьи (строка таблицы).
 */
global $article;

if (!isset($article) || !is_array($article)) { return; }
if (!isset($article['name']) || $article['name'] == '') { return; }

$cl_id    = isset($article['id']) ? $article['id'] : '';
$cl_freqs = isset($article['freqs']) ? $article['freqs'] : 0;
$cl_link  = isset($article['link']) ? $article['link'] : '#';
$cl_img   = isset($article['img']) ? $article['img'] : '';
$cl_stext = isset($article['stext']) ? $article['stext'] : '';
$cl_word  = isset($article['word']) ? $article['word'] : '';
$cl_table = isset($article['table']) ? $article['table'] : '';
$cl_date  = '';
if (!empty($article['date'])) {
    $ts = strtotime($article['date']);
    if ($ts) { $cl_date = date('d-m-Y', $ts); }
}
$cl_no_img = ($cl_img == '');
?>
<tr class="tr_article_id<?= $cl_id ?> freqs_<?= $cl_freqs ?>">
    <?php if (!$cl_no_img): ?>
        <td class="td_preview_image_article" style="vertical-align: top;">
            <a target="_blank" href="<?= $cl_link ?>">
                <div class="preview_image_article">
                    <img loading="lazy" src="<?= $cl_img ?>">
                </div>
            </a>
        </td>
    <?php endif; ?>
    <td class="td_short_description"<?php if ($cl_no_img) { echo ' colspan="2"'; } ?>>
        <a target="_blank" href="<?= $cl_link ?>" data-word="<?= $cl_word ?>" data-table="<?= $cl_table ?>">
            <span class="name"><?= $article['name'] ?><?php if ($cl_date != ''): ?> <span class="date"><?= $cl_date ?></span><?php endif; ?></span>
            <span class="stext"><?= $cl_stext ?></span>
        </a>
    </td>
</tr>