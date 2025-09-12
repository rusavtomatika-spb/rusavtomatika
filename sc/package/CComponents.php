<?
namespace easylife;
use tools\CProducts;
if (!MAIN_FILE_EXECUTED) die();

class CComponents{

    public function show($arguments, $sql_parametrs){

        $default_settings = [
            "component_template" => "default",
        ];
        /* 
        Вытаскиваем параметры шаблона в отдельный массив (если есть).
        */
        foreach ($arguments as $key => $value) {

            if($key == "template_arguments"){
                
                foreach ($arguments["template_arguments"] as $row => $value) {
                    $template_arguments["$row"] = $value;                              
                }
                //unset($arguments["template_arguments"]);
            }
        }
        $diff_arguments = \array_diff_key($default_settings, $arguments); 
        $result_arguments = \array_merge($arguments, $diff_arguments); // расширенный список аргументов


        $component_path = $_SERVER['DOCUMENT_ROOT'] . "/sc/components/" . "/" . $result_arguments["component_name"] . "/". 'component.php';     
        $component_template_path = $_SERVER['DOCUMENT_ROOT'] . "/sc/components/" . $result_arguments["component_name"] . "/templates/" . $result_arguments["component_template"] . "/" . 'template.php';
/*         $component_template_style_path = dirname(__FILE__) . "/" . $result_arguments["component_name"] . "/templates/" . $result_arguments["component_template"] . "/" . 'style.css'; */
        /* 
        Подключаем компонент и его шаблон
        */

            if(file_exists($component_path)){
                if(file_exists($component_template_path)){
                   /*  if(file_exists($component_template_style_path)){
                        echo "<style>";
                        include $component_template_style_path;
                        echo "</style>";
                    } */
                    include $component_path;
                }else{
                    echo "Шаблон не найден<br>";
                }
            }else{
                echo "Компонент не найден". $component_path;
            }
          
    }

    public static function templateItem_preview($template, $item){
        $component_path = $_SERVER['DOCUMENT_ROOT'] . "/sc/components/templateItem_preview/component.php";
        $component_template_path = $_SERVER['DOCUMENT_ROOT'] . "/sc/components/templateItem_preview/templates/" . $template . "/" . 'template.php';

        if(file_exists($component_path)){
            if(file_exists($component_template_path)){
                include $component_path;
            }else{
                echo "Шаблон не найден";
            }
        }else{
            echo "Компонент не найден";
        }

       
        
    }

}
