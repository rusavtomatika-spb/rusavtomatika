<?
if (!defined('cms'))
    exit;

include "result_modifier.php";

global $APPLICATION;
if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {
    ?>
    <h1>monitors_aplex <?= $arguments["catalog_section_H1"] ?></h1>
    <?
}
?><div class="blockofcols_row"><?
$counter = 1;
foreach ($arResult as $element) {
    ?>
        <div class="col-6">
            <div class="blockofcols_row">
                <div class="col-12">
                    <a href="<?= $element["page_url"] ?>" style="text-decoration: none;">
                        <h3 class='catalog_box-pc-aplex__h3'>
                            Встраиваемый компьютер <?= $element["model"] ?>
                        </h3>
                    </a>
                </div>
                <div class="col-6">
                    <?
                    if ($element["images"][0]["img_path"]) {
                        ?>
                        <a href="<?= $element["page_url"] ?>" style="text-decoration: none;">
                            <div class="catalog_box-pc-aplex__image_wrapper">
                                <div class="catalog_box-pc-aplex__image" style="background-image: url('<?= $arguments["path_to_images"] ?>/<?= $element["series"] ?>/<?= $element["model"] ?>/<?= $element["images"][0]["img_path"] ?>')">
                                </div>
                            </div>
                        </a><?
                    }
                    ?>
                </div>
                <div class='col-6'>

                    <table class="catalog_box-pc-aplex__table_price">
                        <tbody>
                            <tr>
                                <td>

                                    <? if ($element["onstock"] > 0): ?>
                                        <div class="catalog_box-pc-aplex__availability">
                                            <img src="/images/green_sq.gif">&nbsp;&nbsp;В наличии
                                        </div>
                                    <? else: ?>
                                        <div  class="catalog_box-pc-aplex_table__availability"><img src="/images/red_sq.gif">&nbsp;&nbsp;Под заказ </div>
                                    <? endif; ?>

                                </td>

                                <? if ($element["retail_price"] > 0): ?>
                                    <td>
                                        <span class="catalog_box-pc-aplex__pan_price">Цена:</span>
                                        <span class="prpr" style="font-size:12px;" title="Нажмите для пересчета в РУБ"><?= $element["retail_price"] ?></span>
                                        <? if ($element["retail_price"] > 0): ?>
                                            <span class="val_name" style="font-size:12px;" title="Нажмите для пересчета в РУБ">USD</span>
                                        <? endif; ?>
                                    </td>
                                <? else: ?>
                                    <td>
                                        <span class="catalog_box-pc-aplex__pan_price">Цена:</span>

                                        <span   idm="<?= $element["model"] ?>"
                                                onclick="show_backup_call(6, '<?= $element["model"] ?>')" style="margin-top:1px;text-decoration:underline;color:#009b1e;">по&nbsp;запросу</span>


                                    </td>
                                <? endif; ?>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table class="catalog_box-pc-aplex_table__buttons">
                        <tbody>
                            <tr>
                                <td>
                                    <? if ($element["retail_price"] > 0): ?>
                                        <div class="zakazbut2 addToCart" idm="<?= $element["model"] ?>"><span>В корзину</span></div>
                                    <? else: ?>
                                        <div class="zakazbut2 disabled"><span>В корзину</span></div>
                                    <? endif ?>
                                </td>
                                <td>
                                    <div class="zakazbut2" idm="<?= $element["model"] ?>" onclick="show_compare(this)"><span>В сравнение</span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="zakazbut2" idm="<?= $element["model"] ?>" onclick="show_backup_call(2, '<?= $element["model"] ?>')"><span>Заказ в 1 клик</span></div>
                                </td>
                                <td>
                                    <div class="zakazbut2" idm="<?= $element["model"] ?>" onclick="show_backup_call(1, '<?= $element["model"] ?>')"><span>Получить скидку</span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <?= $element["text_preview"] ?>

                </div>


            </div>
        </div>





        <?
        $counter++;
        if ($counter % 2) {
            echo '<div class="col-12"><br></div>';
        }
        ?>



        <?
    }
    ?></div></div><?
/*
  echo '<div class="col-12"><pre>';
  var_dump($arResult);
  echo "</pre></div>";
 */
?>
<style>
    .catalog_box-pc-aplex__image_wrapper{
        background: #fff;
        padding: 10px;
        box-shadow: 0 0 3px rgba(0,0,0,0.3);
        margin-bottom: 25px;
        margin-left: 3px;
        transition: 0.1s;
    }
    a:hover .catalog_box-pc-aplex__image_wrapper{
        transform: scale(1.05);
    }

    .catalog_box-pc-aplex__image{
        background: center / contain no-repeat;
        width: 100%;
        height: 90px;
    }
    .catalog_box-pc-aplex__h3{
        padding-bottom: 10px;
        margin:0 0 15px;
        border-bottom: 1px solid #e1e1e1;
        color:#333;
    }
    a:hover .catalog_box-pc-aplex__h3{
        color:#009b1e;
    }

    .catalog_box-pc-aplex__table_features{width: 100%;}

    .catalog_box-pc-aplex__table_features td{
        font-size: 13px;
        background: #f1f1f1;border: 2px solid #fff;padding: 2px 10px;
        width: 25%;
    }
    .catalog_box-pc-aplex__table_features td:nth-child(1){
        width: 30%;
    }
    .catalog_box-pc-aplex__table_features td:nth-child(2){
        width: 70%;
    }
    .catalog_box-pc-aplex__table_features td.value{color:#047b2e}
    .catalog_box-pc-aplex_table__buttons{
        width: 100%;
    }
    .catalog_box-pc-aplex_table__buttons td{
        text-align: center;
    }
    .catalog_box-pc-aplex_table__buttons .zakazbut2{
        display: inline-block;
        width: 90px;
    }
    .catalog_box-pc-aplex__availability{
        text-align: center;
    }
    .catalog_box-pc-aplex__pan_price{
        padding: 0 0 0 5px;
    }
    .catalog_box-pc-aplex_table__availability{text-align: center;}
    .catalog_box-pc-aplex__table_price{width: 100%;font-size: 12px;}
    .catalog_box-pc-aplex__table_price td{width: 50%;}

    .catalog_box-pc-aplex_table__buttons .zakazbut2 {
        font-size: 11px;
    }
    .catalog_box-pc-aplex_table__buttons .zakazbut2.disabled {
        background: #E5D8D8;
        border: 1px solid #E5D8D8;
        cursor: inherit;
        box-shadow: none;


    }
    .catalog_box-pc-aplex_table__buttons .zakazbut2.disabled:active {
        top: 0px;
    }

</style>