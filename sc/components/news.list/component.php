<? 
if (!MAIN_FILE_EXECUTED) die();

$arrResult = tools\CProducts::getItems($sql_parametrs);

include "templates/"  . $result_arguments["component_template"] . "/template.php";
