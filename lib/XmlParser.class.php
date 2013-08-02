<?php
class XmlParser {
	private $stack=array();
	private $afish_stack=array();
	private $xml_parser;

	public function get_kino_teatr($url){
		$this->stack = array();
		$this->afish_stack = array();
		$data = $this->parse_by_url($url);
		if ($data){
			if (isset($this->stack[0]['children'])){
				foreach($this->stack[0]['children'] as $key=>$row){
					//genres
					if ('genres' == $row['name']){
						foreach($row['children'] as $row2){
							$this->afish_stack['genre'][] = array('id' => $row2['attrs']['id'], 'text' => $row2['data']);
						}
					}
					//countries
					if ('countries' == $row['name']){
						foreach($row['children'] as $row2){
							$this->afish_stack['countries'][] = array('id' => $row2['attrs']['id'], 'text' => $row2['data']);
						}
					}
					//cities
					if ('cities' == $row['name']){
						foreach($row['children'] as $row2){
							$this->afish_stack['cities'][] = array('id' => $row2['attrs']['id'], 'country_id' => $row2['attrs']['country_id'], 'text' => $row2['data']);
						}
					}
					//studios
					if ('studios' == $row['name']){
						foreach($row['children'] as $row2){
							$this->afish_stack['studios'][] = array('id' => $row2['attrs']['id'], 'text' => $row2['data']);
						}
					}
					//shows
					if ('shows' == $row['name']){
						foreach($row['children'] as $row2){
							$temp_array = array('id' => $row2['attrs']['id'], 'film_id' => $row2['attrs']['film_id'], 'cinema_id' => $row2['attrs']['cinema_id'], 'hall_id' => $row2['attrs']['hall_id']);
							foreach($row2['children'] as $row3){
								if (in_array($row3['name'], array('begin', 'end'))){
									$temp_array[$row3['name']] = $row3['data'];
								} elseif ('times' == $row3['name']){
									if (isset($row3['children'])){
										foreach($row3['children'] as $row4){
											$price = "";
											if (isset($row4['children'])){
												foreach($row4['children'] as $row5){
													if ('prices' == $row5['name']){
														$price = $row5['data'];
													}
												}
											}
											$temp_array['times'][] = array('time' => $row4['attrs']['time'], 'price' => $price);
										}
									}
								}
							}
							$this->afish_stack['shows'][] = $temp_array;
						}
					}
					//films
					if ('films' == $row['name']){
						foreach($row['children'] as $row2){
							$temp_array = array('id' => $row2['attrs']['id']);
							foreach($row2['children'] as $row3){
								if ('title' == $row3['name']){
									$temp_array['title'] = $row3['data'];
									$temp_array['orig_title'] = $row3['attrs']['orig'];
								} elseif (in_array($row3['name'], array('duration', 'year', 'intro', 'premiere', 'age_limit')) && isset($row3['data'])){
									$temp_array[$row3['name']] = $row3['data'];
								} elseif ('posters' == $row3['name']){
                  if (isset($row3['children'])){
                    $less = 1000;
                    $main_poster = NULL;
                    foreach($row3['children'] as $row4){
                      if ($row4['attrs']['order'] && intval($row4['attrs']['order']) < $less){
                        $main_poster = $row4['attrs']['src'];
                      }
                    }
  									if (!is_null($main_poster)){
  										$temp_array['poster'] = $main_poster;
  									}
                  }
								} elseif ('persons' == $row3['name']){

								  if (isset($row3['children'])){
								  	$persons = array();
                    foreach($row3['children'] as $person){
                      $persons[] = $person['attrs']['id'];
                    }
                    $temp_array['persons_ids'] = array_unique($persons);
                  }

								}
							}
							$this->afish_stack['films'][] = $temp_array;
						}
					}
					//cinemas
					if ('cinemas' == $row['name']){
						foreach($row['children'] as $row2){
							$temp_array = array('id' => $row2['attrs']['id'], 'city_id' => $row2['attrs']['city_id']);
							foreach($row2['children'] as $row3){
								if (in_array($row3['name'], array('title', 'address', 'phone', 'site', 'text')) && isset($row3['data'])){
									$temp_array[$row3['name']] = $row3['data'];
								} elseif('halls' == $row3['name']){
									foreach($row3['children'] as $row4){
										$temp_array2 = array('id' => $row4['attrs']['id']);
										foreach($row4['children'] as $row5){
											if (in_array($row5['name'], array('title', 'scheme')) && isset($row5['data'])){
												$temp_array2[$row5['name']] = $row5['data'];
											}
										}
										$temp_array['halls'][] = $temp_array2;
									}
								}
							}
							$this->afish_stack['cinemas'][] = $temp_array;
						}
					}

					//persons

					if ('persons' == $row['name']){
						foreach($row['children'] as $row2){
							$temp_array = array('id' => $row2['attrs']['id']);
							if ($row2['children']){
								foreach($row2['children'] as $row3){
									if (in_array($row3['name'], array('firstname', 'lastname'))){
										$temp_array[$row3['name']] = $row3['data'];
									}
								}
							}
							$this->afish_stack['persons'][$row2['attrs']['id']] = $temp_array;
						}
					}

				}
			}
		}
		return $this->afish_stack;
	}

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