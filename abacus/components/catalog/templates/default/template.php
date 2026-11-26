<?php
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
$rows = CoreApplication::get_rows_from_table("`catalog_sections`", "", "active='1'", "position ASC");
global $H1,$TITLE,$DESCRIPTION;
$TITLE= "Каталог оборудования";
$DESCRIPTION="Каталог оборудования - панели оператора, промышленные компьютеры: панельные и встраиваемые, промышленные мониторы, контроллеры (PLC), модули ввода-вывода, блоки питания";
$H1="Поставка оборудования для автоматизации";

if(isset($H1) and $H1 != "") {
    ?><h1 class="title"><?=$H1?></h1><?php
}

?>
    <div class="component_catalog">
<?php
if (count($rows) > 0) {
    ?>
        <div class="component_wrapper">
            <div class="catalog-items-wrapper">
                <?php
                foreach ($rows as $row) {
                if (empty($row['name'])) {
                    continue;
                }
                    if(isset($row['category_link']) and $row['category_link'] != ''){
                        $link = $row['category_link'];
                    }elseif(isset($row['category_link_brand']) and $row['category_link_brand'] != ''){
                        $link = $row['category_link_brand'];
                    }else{
                        $link = "/catalog/{$row['code']}/";
                    }
                    ?>
                    <a href="<?= $link ?>" class="section_link">
                        <div class="catalog__section-image">
                            <img src="<?= $row["preview_picture"] ?>">
                        </div>
                        <div class="component_catalog__title"><?= $row["name"] ?></div>
                    </a>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}