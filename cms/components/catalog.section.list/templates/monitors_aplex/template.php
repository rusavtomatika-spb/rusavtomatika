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

                <h2>����� <?= $row["series"] ?></h2>
                <? $APPLICATION->IncludeComponent("catalog.section", $template, $arguments); ?>

                <?
            }
            ?>


        </div>
    </div>
</div>
<?
global $TITLE;
$TITLE = "������������ �������� Aplex ������ � �����-���������� � ������ | �������� �� ������";


global $DESCRIPTION;
$DESCRIPTION = "������ ������������ ������� Aplex � ����������� �� 5.6&Prime; �� 21.5&Prime;. � ������� �� ���������� � ������ ������ ��������� Aplex.";
global $KEYWORDS;
$KEYWORDS = "Aplex, ������������ �������";
global $CANONICAL;
$CANONICAL = "/monitors/aplex/";
?>
