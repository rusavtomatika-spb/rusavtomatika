<?
if (!MAIN_FILE_EXECUTED) die();

if(is_array($arrResult)):
?>


<div class="weintek_series_panel">
    <? if (isset($template_arguments)): ?>
        <? if (isset($template_arguments["title_link"]) and $template_arguments["title_link"]): ?>
            <h2 <? if (isset($template_arguments["anchor"]) and $template_arguments["anchor"]): ?>id="<?= $template_arguments["anchor"] ?>"<? endif; ?>><a href='<?= $template_arguments["title_link"] ?>'><?= $template_arguments["title"] ?></a></h2>
        <? elseif(isset($template_arguments["title"]) and $template_arguments["title"] != ""): ?>
            <h2 <? if (isset($template_arguments["anchor"]) and $template_arguments["anchor"]): ?>id="<?= $template_arguments["anchor"] ?>"<? endif; ?>><?= $template_arguments["title"] ?></h2>
        <? endif; ?>

        <? if (isset($template_arguments["text"]) and $template_arguments["text"] != ""): ?>
            <div class="series_descr">
                <?= $template_arguments["text"] ?>
            </div>
        <? endif; ?>
    <? endif; ?>

    <table class='weintek_list_items' style="
box-sizing: border-box;
display: inline-block;">
        <?
        $counterItem = 0;
        ?>

        <? foreach ($arrResult as $item):
            $counterItem++;
            if ($counterItem % 2 == 1) {
                $counterItem_parity = 1;
            } else {
                $counterItem_parity = 0;
            }
            if ($counterItem_parity == 1) {
                echo '<tr class="item-collector">';
            }
            ?>

            <?/*?><td><?echo show_panel2($currentRow["model"]);?></td><?*/
            ?>
            <td><? easylife\CComponents::templateItem_preview("default", $item); ?></td>

            <?/*
            if (($currentRow % 2 == 1) and ($num_rows == $counterItem)) {
                echo '</tr>';
                break;
            } else {
                if ($counterItem_parity == 0) {
                    echo '</tr>';

                }
            }*/
        endforeach; ?>

    </table>
</div>
<?endif;?>
