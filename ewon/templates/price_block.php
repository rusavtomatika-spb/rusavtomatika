<style>
    h1 {  font-family: Verdana, 'Lucida Grande';  font-size: 15px;  font-weight: normal;}
</style>
<div class="block_content">
<article style="text-align: center"><?=$nav?><br>
    <table width=100%  height=400px style="margin: 10px auto;">
        <tr>
            <td colspan=2 height=50px>
                <table>
                    <tr>
                        <td width=840 align=left bfcolor=#cccccc>
                            <div class=big_pan_name>
                                <h1><b><?=$name?></b>, <?=$type?></h1>
                            </div>
                        </td>
                        <td width=120>
                            <div class=pan_price_big title='Розничная цена'> Цена с НДС </div>
                        </td>
                        <? if (($r->retail_price != '0') AND ($r->retail_price != '')): ?>
                            <td width=60 class=prpr title='Нажмите для пересчета в РУБ' ><?=$r->retail_price?></td>
                            <td class=val_name title='Нажмите для пересчета в РУБ'> EUR </td>

                        <? else: ?>
                            <td width="60" colspan="2" style="padding: 0px 20px;border: none;background: none;"
                                class="zakazbut" idm="<?= $r->model ?>"
                                onclick="show_backup_call(6,'<?= $r->model ?>')">
                                <div> по&nbsp;запросу</div>
                            </td>

                        <? endif; ?>



                    </tr>
                </table>
                <div class=hc1>&nbsp;</div><br>
            </td>
        </tr>
        <tr style="margin-bottom: 70px;">
            <td valign="top" align="center" valign="center" width="50%" bfcolor="#eeeeee" >
                <div class="images_block">
                    <?=print_pictures_in_detail_template($r->brand,$r->type,$r->model,$r->pics_number)?>
                </div>


            </td>
            <td  valign=top>

