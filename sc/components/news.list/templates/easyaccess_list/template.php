<?
if (!MAIN_FILE_EXECUTED) die();
global $arrProductTypes;
?>



           <?
           $counterItem = 0;
           ?>

<div class="blockofcols_row" style="margin-left: 0px;margin-right: 0px;<?/*if(!empty($template_arguments["background"])):?> background-color:<?=$template_arguments["background"]?><?endif;*/?>">
<?/*?>
<div class="col-12 images_easyacces_item" style="padding-left: 50px;padding-right: 50px;">
    <div>Серия: <strong><?=$template_arguments["series"]?></strong> </div>

    <hr>
</div><?*/?>

<?foreach ($arrResult as $item):
    $count = $counterItem%2;
    ?>

        <?
        //$imgRemoteDir="/images/" . mb_strtolower($item["brand"]) . "/" .  mb_strtolower($item["type"]) ."/" . $item["model"] . "/";

        //$new_path_picture = get_new_path_picture($imgRemoteDir);
            $getUrlProduct = getUrlProduct($item["brand"],$item["type"])  . $item["model"] . '.php';
        ?>



    <div class="col-2 images_easyacces_item">
        <a href="<?=$getUrlProduct?>">
        <div class="images_easyacces_item-inner">
            <div class="images_easyacces_list" style="background-image:url(<?echo get_path_md_picture($item["brand"],$item["type"],$item["model"])?>);"></div>
            <div><small><?=$arrProductTypes[$item["type"]]?></small></div>
            <div><?=$item["model"]?></div>
        </div>
        </a>
    </div>

<?
    $counterItem++;
endforeach;?>
</div>

