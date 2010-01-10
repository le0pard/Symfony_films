<?php
class XmlParser {
	private $stack=array();
	private $afish_stack=array();
	private $xml_parser;
	
	public function get_afish_by_url($url){
		$this->stack = array();
		$this->afish_stack = array();
		$data = $this->parse_by_url($url);
		if ($data){
			if (isset($this->stack[0]['children'][0]['children'])){
		    	foreach($this->stack[0]['children'][0]['children'] as $key1=>$row1){
		    		if ('title' == $row1['name']){
		    			$this->afish_stack['title'] = $row1['data'];
		    			
		    		} elseif ('item' == $row1['name'] && isset($row1['children'])){
		    			$temp_data = array();
		    			foreach($row1['children'] as $key2=>$row2){
		    				if (in_array($row2['name'], array('title', 'description', 'link'))){
		    					$temp_data[$row2['name']] = $row2['data'];
		    				}
		    				if ('showtime' == $row2['name'] && isset($row2['children'])){
		    					$temp_data['seans'] = array();
		    					$i = 0;
		    					foreach($row2['children'] as $key3=>$row3){
		    						if ($row3['children']){
		    							foreach($row3['children'] as $key4=>$row4){
		    								if ('name' == $row4['name']){
		    									$temp_data['seans'][$i]['name'] = $row4['data'];
		    								}
		    								if ('time' == $row4['name']){
		    									$temp_data['seans'][$i]['time'][] = $row4['data'];
		    								}
		    							}
		    							$i++;
		    						}
		    					}
		    				}
		    			}
		    			$this->afish_stack['data'][] = $temp_data;
		    		}
		    	}
		    	return $this->afish_stack;
		    }
		} else {
			return array();
		}
	}
	
	public function parse_by_url($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		//curl_setopt($ch, CURLOPT_PROXYPORT, 8080);
		//curl_setopt($ch, CURLOPT_PROXY, '192.168.0.1');
		$data = curl_exec($ch);
		curl_close($ch);
		
		if ($data){
			return $this->new_xml_parser($data);
		} else {
			return array();
		}
	}
	
	// start_element_handler ( resource parser, string name, array attribs )
	private function startElement($parser, $name, $attribs){
	   $tag=array("name"=>$name,"attrs"=>$attribs);
	   array_push($this->stack,$tag);
	}

	// end_element_handler ( resource parser, string name )
	private function endElement($parser, $name){
	   $this->stack[count($this->stack)-2]['children'][] = $this->stack[count($this->stack)-1];
	   array_pop($this->stack);
	}

	// handler ( resource parser, string data )
	private function characterData($parser, $data){
	   if (empty($this->stack[count($this->stack)-1]['data'])){
	   		$this->stack[count($this->stack)-1]['data']="";
	   }
	   if(trim($data)){  
	   		$this->stack[count($this->stack)-1]['data'].=$data;
	   }
	}

	private function defaultHandler($parser, $data){
	   
	}
	
	private function new_xml_parser($data)
	{
	   $this->xml_parser = xml_parser_create();
	   xml_set_object($this->xml_parser, $this);
	   xml_parser_set_option($this->xml_parser, XML_OPTION_CASE_FOLDING, 0);
	   xml_set_element_handler($this->xml_parser, "startElement", "endElement");
	   xml_set_character_data_handler($this->xml_parser, "characterData"); 
	   xml_set_default_handler($this->xml_parser, "defaultHandler");
	   xml_set_external_entity_ref_handler($this->xml_parser, "externalEntityRefHandler");
	   if (!xml_parse($this->xml_parser, $data)) {
			   die(sprintf("XML error: %s at line %d\n",
						   xml_error_string(xml_get_error_code($this->xml_parser)),
						   xml_get_current_line_number($this->xml_parser)));
  	    }
		xml_parser_free($this->xml_parser);
		return $this->stack;
	}
	
	
}