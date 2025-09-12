<?
if (!defined('MAIN_FILE_EXECUTED')) die();
?>
<form id="form_add_page" method="post" accept-charset="utf-8" >
    <input type="hidden" name="form_name" value="form_add_page" />
    <input type="hidden" name="form_action" value="action_add_page" />
  <div class="form_title">Добавить страницу в индекс поиска</div>
  <p>
      <input class="input_text_style1" type="text" name="search_index_url" placeholder="Введите url">
      <input autocomplete="off" id="search_index_add_url_to_xml" name="search_index_add_url_to_xml" type="checkbox">
      <label for="search_index_add_url_to_xml"> И добавить url  в xml-файл</label> 
                        
      <input  class="input_submit_style1" type="submit" value="Добавить">  
  </p>
  <div id="form_add_page_result"></div>
  <div id="form_add_page_result_buffer"></div>
  
 </form>






