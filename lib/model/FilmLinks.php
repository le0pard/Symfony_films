<?php

class FilmLinks extends BaseFilmLinks
{
	public function save(PropelPDO $con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app && $this->getFilm()){
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=film&action=_film_main&sf_cache_key='.$this->getFilm()->getId(), $current_app);
		}
		return parent::save($con);
	}
	
	public function delete(PropelPDO $con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app && $this->getFilm()){
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=film&action=_film_main&sf_cache_key='.$this->getFilm()->getId(), $current_app);
		}
		return parent::delete($con);
	}
}
