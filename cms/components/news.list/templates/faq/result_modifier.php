<?if (!defined('cms'))
    exit;

    global $APPLICATION;
    $allTags = [];
    function rus2translit($string) {
        $converter = array(
            '�' => 'a',   '�' => 'b',   '�' => 'v',
            '�' => 'g',   '�' => 'd',   '�' => 'e',
            '�' => 'e',   '�' => 'zh',  '�' => 'z',
            '�' => 'i',   '�' => 'y',   '�' => 'k',
            '�' => 'l',   '�' => 'm',   '�' => 'n',
            '�' => 'o',   '�' => 'p',   '�' => 'r',
            '�' => 's',   '�' => 't',   '�' => 'u',
            '�' => 'f',   '�' => 'h',   '�' => 'c',
            '�' => 'ch',  '�' => 'sh',  '�' => 'sch',
            '�' => '\'',  '�' => 'y',   '�' => '\'',
            '�' => 'e',   '�' => 'yu',  '�' => 'ya',
            
            '�' => 'A',   '�' => 'B',   '�' => 'V',
            '�' => 'G',   '�' => 'D',   '�' => 'E',
            '�' => 'E',   '�' => 'Zh',  '�' => 'Z',
            '�' => 'I',   '�' => 'Y',   '�' => 'K',
            '�' => 'L',   '�' => 'M',   '�' => 'N',
            '�' => 'O',   '�' => 'P',   '�' => 'R',
            '�' => 'S',   '�' => 'T',   '�' => 'U',
            '�' => 'F',   '�' => 'H',   '�' => 'C',
            '�' => 'Ch',  '�' => 'Sh',  '�' => 'Sch',
            '�' => '\'',  '�' => 'Y',   '�' => '\'',
            '�' => 'E',   '�' => 'Yu',  '�' => 'Ya',
        );
        return strtr($string, $converter);
    }
    function str2url($str) {
        // ��������� � ��������
        $str = rus2translit($str);
        // � ������ �������
        $str = strtolower($str);
        // ������� ��� �������� ��� �� "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // ������� ��������� � �������� '-'
        $str = trim($str, "-");
        return $str;
    }
 
                foreach ($arResult["news_list"] as $item ) {   
                    

                    $moreWhenOne = strripos($item["tags"], ",");
                    
                    if($moreWhenOne === false){
               
                        if (!in_array($item["tags"], $allTags)) {  
                                              
                            array_push($allTags, $item["tags"]);                           
                            //str2url($item["tags"]);
                        }
                    }else{
                        $piecesTags = explode(",", $item["tags"]);
                        foreach ($piecesTags as $tag){
                           
                            if (!in_array($tag, $allTags)) {   
                                           
                                array_push($allTags, $tag);
                            }
                            
                        }
                    }
                   
                    
                }
                $counter = 0;
                foreach($allTags as $key){
                    $newAllTags[$counter]["orig"] = $key;
                    $newAllTags[$counter]["trans"] = str2url($key);
                    $counter++;
                }
                  
             