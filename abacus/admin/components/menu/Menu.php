<?php
namespace abacus\admin\components\menu;
class Menu{
    private $items;
    private $template;
    public function __construct($items, $template = "default")
    {
        if(is_array($items)){
            $this->items = $items;
        }
        $this->template = $template;
    }
    public function show(){
        $arResult["items"] = $this->items;
        require __DIR__."/templates/".$this->template."/template.php";
    }

}