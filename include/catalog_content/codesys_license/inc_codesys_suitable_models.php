<?
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/inc_codesys_suitable_models.css");
$rows1=CoreApplication::get_rows_from_table("products_all","model, type","(`series`='cMT-X') and ((`codesys` like 'build_in') or (`codesys` like 'optional'))","`diagonal` ASC");
//var_dump_pre($rows1);
$rows2=CoreApplication::get_rows_from_table("products_all","model, type","(`series`='cMT') and ((`codesys` like 'build_in') or (`codesys` like 'optional'))","`diagonal` ASC");
//var_dump_pre($rows2);
?>
<h2>Панели оператора с поддержкой Codesys</h2>
<h3>Серия cMT-X</h3>
<div class="codesys_suitable_models">
    <div class="columns is-multiline">
        <?
        foreach ($rows1 as $item)
        {?>
            <div class="column is-2-fullhd is-2-desktop is-2-tablet is-2-mobile has-text-centered">
                <a href="<?echo "/weintek/".$item["model"]."/"?>">
                    <img src="<?echo "/images/weintek/".$item["type"]."/".$item["model"]."/67/".$item["model"]."_1.webp";?>" alt="">
                    <?//echo $item["model"]."-".$item["type"];?>
                    <?//echo "/images/weintek/".$item["type"]."/".$item["model"]."/67/".$item["model"]."_1.webp";?>
                    <p><?echo $item["model"]?></p>
                </a>
            </div>
            <?
        }
        ?>
    </div>
</div>

<h3>Серия cMT</h3>
<div class="codesys_suitable_models">
    <div class="columns is-multiline">
        <?
        foreach ($rows2 as $item)
        {?>
            <div class="column is-2-fullhd is-2-desktop is-2-tablet is-2-mobile has-text-centered">
                <a href="<?echo "/weintek/".$item["model"]."/"?>">
                    <img src="<?echo "/images/weintek/".$item["type"]."/".$item["model"]."/67/".$item["model"]."_1.webp";?>" alt="">
                    <?//echo $item["model"]."-".$item["type"];?>
                    <?//echo "/images/weintek/".$item["type"]."/".$item["model"]."/67/".$item["model"]."_1.webp";?>
                    <p><?echo $item["model"]?></p>
                </a>
            </div>
            <?
        }
        ?>
    </div>
</div>
</div>

