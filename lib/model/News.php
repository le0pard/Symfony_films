<?php

class News extends BaseNews
{
	public function __toString(){
    	return $this->getTitle();
    }
	
	public function setTitle($title){
	  parent::setTitle($title);
	  $this->setUrl(System::slugify($title));
	}
}

sfPropelBehavior::add('News', array(
	'viewCacheObserver' => array(
		'cache' => array(
			'news/index?page=*',
			'news/index',
			'@sf_cache_partial?module=news&action=_latest&sf_cache_key=latest',
			'news/show?id=#{id}&url=#{url}'
		),
		'variables' => array(
			'id' => 'getId',
			'url' => 'getUrl'
		),
		'criteria' => array(
			//'getIsVisible' => true,
			//'getIsPublic' => true
		)
	)
));