<?php

class CCacheHandling{
    private static function current_file_name(){
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $vowels = array( "//");
        $url = str_replace($vowels, "_", $url);
        $vowels = array( "/");
        $url = str_replace($vowels, "__", $url);

        $vowels = array(":", ".", "?", "=");
        $url = str_replace($vowels, "_", $url);
        $url .= ".html";
        $url = $_SERVER["DOCUMENT_ROOT"]."/cache/".$url;
        return $url;
    }
    public static function process_cache(){
        $file_name = self::current_file_name();
        if ( file_exists ( $file_name ) ){
            $file_content =  file_get_contents($file_name);
            echo $file_content;
            global $microtime1;
            echo "<div style='font-size: 8px;color: #777;'>".(microtime(true) - $microtime1)."</div>";
            exit();
        }
    }
    public static function save_cache($content){
        return;
        $file_name = self::current_file_name();
        if ( !file_exists ( $_SERVER["DOCUMENT_ROOT"]."/cache/" ) ){
            mkdir($_SERVER["DOCUMENT_ROOT"]."/cache/");
        }
        file_put_contents($file_name, $content);
    }
}





