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
	
	public function save(PropelPDO $con = null) {
		$frontend_cache_dir = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.sfConfig::get('sf_environment').DIRECTORY_SEPARATOR.'template';
		$cache = new sfFileCache(array('cache_dir' => $frontend_cache_dir));
		$cache->remove('films_leo_local/all/sf_cache_partial/film/_types/sf_cache_key/types');
		return parent::save($con);
	}
	
	public function delete(PropelPDO $con = null) {
		$frontend_cache_dir = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.sfConfig::get('sf_environment').DIRECTORY_SEPARATOR.'template';
		$cache = new sfFileCache(array('cache_dir' => $frontend_cache_dir));
		$cache->remove('films_leo_local/all/sf_cache_partial/film/_types/sf_cache_key/types');
		return parent::delete($con);
	}
}
