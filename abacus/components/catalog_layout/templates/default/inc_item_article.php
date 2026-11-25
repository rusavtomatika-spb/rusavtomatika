<?php
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
$cl_name  = $article['name'];
$cl_date  = '';
if (!empty($article['date'])) {
    $cl_ts = strtotime($article['date']);
    if ($cl_ts) { $cl_date = date('d-m-Y', $cl_ts); }
}
$cl_has_media = ($cl_img !== '');
?>
<div class="cl-card cl-card--article<?= $cl_has_media ? '' : ' cl-card--no-media' ?> tr_article_id<?= $cl_id ?> freqs_<?= $cl_freqs ?>">

    <?php if ($cl_has_media): ?>
        <div class="cl-card__media">
            <a class="cl-card__media-link" href="<?= $cl_link ?>" target="_blank" rel="noopener">
                <img class="cl-card__image" alt="" loading="lazy" src="<?= $cl_img ?>">
            </a>
        </div>
    <?php endif; ?>

    <div class="cl-card__body">
        <a class="cl-card__title-link" href="<?= $cl_link ?>" target="_blank" rel="noopener"
           data-word="<?= $cl_word ?>" data-table="<?= $cl_table ?>">
            <span class="cl-card__title">
                <?= $cl_name ?>
                <?php if ($cl_date !== ''): ?><span class="cl-card__date"><?= $cl_date ?></span><?php endif; ?>
            </span>
            <span class="cl-card__excerpt"><?= $cl_stext ?></span>
        </a>
    </div>
</div>