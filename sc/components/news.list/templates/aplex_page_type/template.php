<?
if (!MAIN_FILE_EXECUTED) die();
if (isset($arrResult) && is_array($arrResult)) {
    ?>
    <div class="weintek_series_panel" id="<?= $template_arguments["series"] ?>">
        <? if (isset ($template_arguments["title_link"]) && $template_arguments["title_link"]): ?>
            <h2><a href='<?= $template_arguments["title_link"] ?>'><?= $template_arguments["title"] ?></a></h2>
        <? else: ?>
            <h2 class="series_name"><?= $template_arguments["title"] ?></h2>
        <? endif; ?>

        <? if (isset($template_arguments["text"]) && $template_arguments["text"]): ?>
            <div class="series_descr">
                <?= $template_arguments["text"] ?>
            </div>
        <? endif; ?>

        <table class='weintek_list_items' style="
box-sizing: border-box;
display: inline-block;">
            <?
            $counterItem = 0;
            ?>
            <tr class="item-collector">
                <?
                $currentRow = 0;
                foreach ($arrResult as $item):

                    ?>
                    <td><? easylife\CComponents::templateItem_preview("aplex_card", $item); ?></td><?
                    if ($currentRow % 2 == 1) {
                        echo '</tr><tr class="item-collector">';
                    }
                    $currentRow++;
                endforeach;
                ?>
            </tr>
        </table>
    </div>
    <?php
}
?>