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
            //var_dump($template);
            $number_of_sections = count($arResult["sections"]);
            foreach ($arResult["sections"] as $row) {
                if ($number_of_sections>1){
                ?>
                <h2>����� <?= $row["series"] ?></h2>
                <?}
                $APPLICATION->IncludeComponent("catalog.section", $template, $arguments); ?>
                <?
            }
            ?>


        </div>
    </div>
</div>
<?
global $TITLE;
$TITLE = "���������� Weintek | �������� �� ������";


global $DESCRIPTION;
$DESCRIPTION = "���������� � ������� �� ������ ��������� Weintek Samkoon IFC Aplex eWON Haiwell Yottacontrol.";
global $KEYWORDS;
$KEYWORDS = "����������";
global $CANONICAL;
$CANONICAL = "/accessories/";
?>
