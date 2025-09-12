<?
if (!defined('MAIN_FILE_EXECUTED'))
    die();
?>
<form id="form_add_pages_from_xml" method="post"  accept-charset="utf-8">
    <input type="hidden" name="form_name" value="form_add_pages_from_xml" />
    <input type="hidden" name="form_action" value="action_add_pages_from_xml" />
    <div class="form_title">Добавить страницы из sitemap.xml во временную таблицу</div>
    <table>
        <tr>
            <td style="width: 30%">Путь к xml-файлу</td>
            <td>
                <input class="input_text_style1" type="text" name="search_index_sitemap_filename" placeholder="Введите имя файла" value="/search/assets/sitemap3.xml">
            </td>
        </tr>
        <tr>
            <td>
                Фильтр (введите текст, который должен присутствовать в URL)</td>
            <td>
                <input class="input_text_style1" type="text" name="search_index_sitemap_filter_text" placeholder="Введите обязательный в ссылках текст" value=""><span id="clear_text_search_index_sitemap_filter_text">x</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <input autocomplete="off" id="search_index_clear_table" name="search_index_clear_table" type="checkbox"/>
                <label for="search_index_clear_table"> Очистить таблицу кандидатов перед добавлением</label> 
                        </td>
                        <td>
                            <input  autocomplete="off" id="search_index_clear_index_table" name="search_index_clear_index_table" type="checkbox"/>
                <label for="search_index_clear_index_table"> Очистить ВСЕ ИНДЕКСНЫЕ таблицы</label></td>
                        <td><input  class="input_submit_style1" type="submit" value="Добавить"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>   
</form>






