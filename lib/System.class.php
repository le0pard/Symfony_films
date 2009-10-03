<?php
class System {
	
  static public function rus2translit($string) {
	    $converter = array(
	        'а' => 'a',   'б' => 'b',   'в' => 'v',
	        'г' => 'g',   'д' => 'd',   'е' => 'e',
	        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
	        'и' => 'i',   'й' => 'y',   'к' => 'k',
	        'л' => 'l',   'м' => 'm',   'н' => 'n',
	        'о' => 'o',   'п' => 'p',   'р' => 'r',
	        'с' => 's',   'т' => 't',   'у' => 'u',
	        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
	        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
	        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
	        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
	        
	        'А' => 'A',   'Б' => 'B',   'В' => 'V',
	        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
	        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
	        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
	        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
	        'О' => 'O',   'П' => 'P',   'Р' => 'R',
	        'С' => 'S',   'Т' => 'T',   'У' => 'U',
	        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
	        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
	        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
	        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
			
			'Ї' => 'i',	  'ї' => 'i'
	    );
	    return strtr($string, $converter);
  }	
  
  
  static public function slugify($text)
  {
    $text = System::rus2translit($text);
    //в нижний регистр
    $text = strtolower($text);
    //заменям все ненужное нам на "-"
    $text = preg_replace('~[^-a-z0-9_]+~u', '-', $text);
    //удаляем начальные и конечные '-'
    $text = trim($text, "-");
    if (empty($text)){
      return 'n-a';
    }
    return $text;
  }
  
  static public function generateRandomKey($len = 20) {
    $string = '';
    $pool   = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    for ($i = 1; $i <= $len; $i++)
    {
      $string .= substr($pool, rand(0, 61), 1);
    }

    return md5($string);
  }
  
  static public function strip_tags_attributes($string,$allowtags=NULL,$allowattributes=NULL){
    $string = strip_tags($string, $allowtags);
    if (!is_null($allowattributes)) {
        if(!is_array($allowattributes))
            $allowattributes = explode(",",$allowattributes);
        if(is_array($allowattributes))
            $allowattributes = implode(")(?<!",$allowattributes);
        if (strlen($allowattributes) > 0)
            $allowattributes = "(?<!".$allowattributes.")";
        $string = preg_replace_callback("/<[^>]*>/i",create_function(
            '$matches',
            'return preg_replace("/ [^ =]*'.$allowattributes.'=(\"[^\"]*\"|\'[^\']*\')/i", "", $matches[0]);'   
        ),$string);
    }

    return $string;
  } 
  
  static public function configure_jevix_light() {
  	$jevix = new Jevix();
  	// 1. Устанавливаем разрешённые теги. (Все не разрешенные теги считаются запрещенными.)
	$jevix->cfgAllowTags(array('a', 'i', 'b', 'u', 'em', 'strong', 'nobr', 'li', 'ol', 'ul', 'br', 'pre', 'code'));
	// 2. Устанавливаем коротие теги. (не имеющие закрывающего тега)
	$jevix->cfgSetTagShort(array('br'));
	// 3. Устанавливаем преформатированные теги. (в них все будет заменятся на HTML сущности)
	$jevix->cfgSetTagPreformatted(array('pre'));
	// 4. Устанавливаем теги, которые необходимо вырезать из текста вместе с контентом.
	$jevix->cfgSetTagCutWithContent(array('script', 'object', 'iframe', 'style'));
	// 5. Устанавливаем разрешённые параметры тегов. Также можно устанавливать допустимые значения этих параметров.
	$jevix->cfgAllowTagParams('a', array('title', 'href'));
	// 6. Устанавливаем параметры тегов являющиеся обязяательными. Без них вырезает тег оставляя содержимое.
	$jevix->cfgSetTagParamsRequired('a', 'href');
	// 7. Устанавливаем теги которые может содержать тег контейнер
	//    cfgSetTagChilds($tag, $childs, $isContainerOnly, $isChildOnly)
	//       $isContainerOnly : тег является только контейнером для других тегов и не может содержать текст (по умолчанию false)
	//       $isChildOnly : вложенные теги не могут присутствовать нигде кроме указанного тега (по умолчанию false)
	$jevix->cfgSetTagChilds('ul', 'li', true, true);
	// 8. Устанавливаем атрибуты тегов, которые будут добавлятся автоматически
	$jevix->cfgSetTagParamsAutoAdd('a', array('rel' => 'nofollow'));
	// 9. Устанавливаем автозамену
	$jevix->cfgSetAutoReplace(array('+/-', '(c)', '(r)'), array('±', '©', '®'));
	// 10. Включаем или выключаем режим XHTML. (по умолчанию включен)
	$jevix->cfgSetXHTMLMode(true);
	// 11. Включаем или выключаем режим замены переноса строк на тег <br/>. (по умолчанию включен)
	$jevix->cfgSetAutoBrMode(true);
	// 12. Включаем или выключаем режим автоматического определения ссылок. (по умолчанию включен)
	$jevix->cfgSetAutoLinkMode(true);
	// 13. Отключаем типографирование в определенном теге
	$jevix->cfgSetTagNoTypography('code');
	
	return $jevix;
  }
  
}