<?php

class StaticPages extends BaseStaticPages
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
			'@sf_cache_partial?module=static&action=_menu&sf_cache_key=menu',
			'static/show?id=#{id}&url=#{url}'
		);
	}
	
}

sfPropelBehavior::add('StaticPages', array(
	'viewCacheObserver' => array(
		'variables' => array(
			'id' => 'getId',
			'url' => 'getUrl'
		)
	)
));
