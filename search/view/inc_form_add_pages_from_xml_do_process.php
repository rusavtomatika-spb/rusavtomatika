<?
if (!defined('MAIN_FILE_EXECUTED'))
    die();
$amount_of_rows = search_index__get_amount_of_rows_from_table('search_index_pages_candidates');
?>
<div id="panel_adding_pages_from_xml_processing">
    <div class="panel_title">Индексирование</div>
    <table  style="width: 100%">
        <tr>
            <td colspan="2"> <?
                echo "Количество записей во временной таблице: <span id='rest_rows'>" . $amount_of_rows . "</span>";
                ?> 
                <span id="work_timer" data-rel=""></span>
                <span id="work_timer_life"></span>
            </td> 
            <td style="text-align: right;"><button id="button_start"> Пуск</button> <button id="button_stop">Стоп</button></td>

        </tr>

        <tr>
            <td  colspan="3" ><div class="status_panel"><span class="status">Статус</span></div></td>            
        </tr>

    </table>
    <hr>
    <div id="panel_truncate_tables">
        <table>
            <tr>
                <td>Очистить индексные таблицы <button id="button_start_confirm">Очистить</button> <button id="button_start_truncating" style="display: none;">Подтвердить очистку</button></td>                        
                <td><span class="truncate_tables_status"></span></td> 
            </tr>
        </table>

    </div>

</div>
