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
	
	public function save(PropelPDO $con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app){
			sfProjectConfiguration::getActive()->clearFrontendCache('static/show?id='.$this->getId().'&url='.$this->getUrl(), $current_app); 
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=static&action=_menu&sf_cache_key=menu', $current_app); 
		}
		return parent::save($con);
	}
	
	public function delete(PropelPDO $con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app){
			sfProjectConfiguration::getActive()->clearFrontendCache('static/show?id='.$this->getId().'&url='.$this->getUrl(), $current_app);
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=static&action=_menu&sf_cache_key=menu', $current_app); 
		}
		return parent::delete($con);
	}
	
}
