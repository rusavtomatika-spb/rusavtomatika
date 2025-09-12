<?
if (!defined('cms'))
    exit;

global $APPLICATION;
?>

<div class="blockofcols_container">
    <div class="blockofcols_row">
        <div class="col-9">
            <?
            if ($arguments["titles"]["catalog_sections_list_H1"]) {
                ?>
                <h1><?= $arguments["titles"]["catalog_sections_list_H1"] ?></h1>
            <? } ?>
        </div>
        <div class="col-12">
        </div>
        <div class="col-12">


            <?
            //var_dump($arguments);
            foreach ($arResult["sections"] as $row) {
                ?>

                <h2>Серия <?= $row["series"] ?></h2>
                <? $APPLICATION->IncludeComponent("catalog.section", $template, $arguments); ?>

                <?
            }
            ?>


        </div>
    </div>
</div>
<?
global $TITLE;
$TITLE = "Промышленные мониторы Aplex купить в Санкт-Петербурге и Москве | доставка по России";


global $DESCRIPTION;
$DESCRIPTION = "Купить промышленный монитор Aplex с диагоналями от 5.6&Prime; до 21.5&Prime;. В наличии на крупнейшем в России складе продукции Aplex.";
global $KEYWORDS;
$KEYWORDS = "Aplex, промышленный монитор";
global $CANONICAL;
$CANONICAL = "/monitors/aplex/";
?>
