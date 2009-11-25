<?php

class FilmTypes extends BaseFilmTypes
{
	public function __toString(){
    	return $this->getTitle();
    }
	
	public function setTitle($title){
	  parent::setTitle($title);
	  $this->setUrl(System::slugify($title));
	}
	
	static public function getCacheArray(){
		return array(
			'@sf_cache_partial?module=film&action=_types&sf_cache_key=types',
			'film_types/show?id=#{id}&url=#{url}'
		);
	}
}

sfPropelBehavior::add('FilmTypes', array(
	'viewCacheObserver'
));