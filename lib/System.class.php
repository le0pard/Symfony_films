<?php
class System {
	
  static protected $jevix = null;
	
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
  	if (!System::$jevix) System::$jevix = new Jevix();
  	// 1. Устанавливаем разрешённые теги. (Все не разрешенные теги считаются запрещенными.)
	System::$jevix->cfgAllowTags(array('a', 'i', 'b', 'u', 'em', 'strong', 'nobr', 'li', 'ol', 'ul', 'br', 'pre', 'code'));
	// 2. Устанавливаем коротие теги. (не имеющие закрывающего тега)
	System::$jevix->cfgSetTagShort(array('br'));
	// 3. Устанавливаем преформатированные теги. (в них все будет заменятся на HTML сущности)
	System::$jevix->cfgSetTagPreformatted(array('pre'));
	// 4. Устанавливаем теги, которые необходимо вырезать из текста вместе с контентом.
	System::$jevix->cfgSetTagCutWithContent(array('script', 'object', 'iframe', 'style'));
	// 5. Устанавливаем разрешённые параметры тегов. Также можно устанавливать допустимые значения этих параметров.
	System::$jevix->cfgAllowTagParams('a', array('title', 'href'));
	// 6. Устанавливаем параметры тегов являющиеся обязяательными. Без них вырезает тег оставляя содержимое.
	System::$jevix->cfgSetTagParamsRequired('a', 'href');
	// 7. Устанавливаем теги которые может содержать тег контейнер
	//    cfgSetTagChilds($tag, $childs, $isContainerOnly, $isChildOnly)
	//       $isContainerOnly : тег является только контейнером для других тегов и не может содержать текст (по умолчанию false)
	//       $isChildOnly : вложенные теги не могут присутствовать нигде кроме указанного тега (по умолчанию false)
	System::$jevix->cfgSetTagChilds('ul', 'li', true, true);
	// 8. Устанавливаем атрибуты тегов, которые будут добавлятся автоматически
	System::$jevix->cfgSetTagParamsAutoAdd('a', array('rel' => 'nofollow'));
	// 9. Устанавливаем автозамену
	System::$jevix->cfgSetAutoReplace(array('+/-', '(c)', '(r)'), array('±', '©', '®'));
	// 10. Включаем или выключаем режим XHTML. (по умолчанию включен)
	System::$jevix->cfgSetXHTMLMode(true);
	// 11. Включаем или выключаем режим замены переноса строк на тег <br/>. (по умолчанию включен)
	System::$jevix->cfgSetAutoBrMode(true);
	// 12. Включаем или выключаем режим автоматического определения ссылок. (по умолчанию включен)
	System::$jevix->cfgSetAutoLinkMode(true);
	// 13. Отключаем типографирование в определенном теге
	System::$jevix->cfgSetTagNoTypography('code');
  }
  
  static public function jevix_light($str = null) {
  	if ($str){
  		System::configure_jevix_light();
		$errors = null;
  		return System::$jevix->parse($str, $errors);
  	} else {
  		return false;
  	}
  }
  
  static public function configure_jevix_def() {
  	if (!System::$jevix) System::$jevix = new Jevix();
  	// 1. Устанавливаем разрешённые теги. (Все не разрешенные теги считаются запрещенными.)
	System::$jevix->cfgAllowTags(array('a', 'img', 'i', 'b', 'u', 'em', 'strong', 'nobr', 'li', 'ol', 'ul', 'sup', 'abbr', 'pre', 'acronym', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'br', 'code'));
	// 2. Устанавливаем коротие теги. (не имеющие закрывающего тега)
	System::$jevix->cfgSetTagShort(array('br','img'));
	// 3. Устанавливаем преформатированные теги. (в них все будет заменятся на HTML сущности)
	System::$jevix->cfgSetTagPreformatted(array('pre'));
	// 4. Устанавливаем теги, которые необходимо вырезать из текста вместе с контентом.
	System::$jevix->cfgSetTagCutWithContent(array('script', 'object', 'iframe', 'style'));
	// 5. Устанавливаем разрешённые параметры тегов. Также можно устанавливать допустимые значения этих параметров.
	System::$jevix->cfgAllowTagParams('a', array('title', 'href'));
	System::$jevix->cfgAllowTagParams('img', array('src', 'alt' => '#text', 'title', 'align' => array('right', 'left', 'center'), 'width' => '#int', 'height' => '#int', 'hspace' => '#int', 'vspace' => '#int'));
	// 6. Устанавливаем параметры тегов являющиеся обязяательными. Без них вырезает тег оставляя содержимое.
	System::$jevix->cfgSetTagParamsRequired('a', 'href');
	System::$jevix->cfgSetTagParamsRequired('img', 'src');
	// 7. Устанавливаем теги которые может содержать тег контейнер
	//    cfgSetTagChilds($tag, $childs, $isContainerOnly, $isChildOnly)
	//       $isContainerOnly : тег является только контейнером для других тегов и не может содержать текст (по умолчанию false)
	//       $isChildOnly : вложенные теги не могут присутствовать нигде кроме указанного тега (по умолчанию false)
	System::$jevix->cfgSetTagChilds('ul', 'li', false, true);
	System::$jevix->cfgSetTagChilds('ol', 'li', false, true);
	// 8. Устанавливаем атрибуты тегов, которые будут добавлятся автоматически
	System::$jevix->cfgSetTagParamsAutoAdd('a', array('rel' => 'nofollow'));
	// 9. Устанавливаем автозамену
	System::$jevix->cfgSetAutoReplace(array('+/-', '(c)', '(r)'), array('±', '©', '®'));
	// 10. Включаем или выключаем режим XHTML. (по умолчанию включен)
	System::$jevix->cfgSetXHTMLMode(true);
	// 11. Включаем или выключаем режим замены переноса строк на тег <br/>. (по умолчанию включен)
	System::$jevix->cfgSetAutoBrMode(true);
	// 12. Включаем или выключаем режим автоматического определения ссылок. (по умолчанию включен)
	System::$jevix->cfgSetAutoLinkMode(true);
	// 13. Отключаем типографирование в определенном теге
	System::$jevix->cfgSetTagNoTypography('code');
  }
  
  static public function jevix_def($str = null) {
  	if ($str){
  		System::configure_jevix_def();
		$errors = null;
  		return System::$jevix->parse($str, $errors);
  	} else {
  		return false;
  	}
  }
}