<?php

class FilmLinksPeer extends BaseFilmLinksPeer
{
	
	public static function doDeleteAll($con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app){
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=film&action=_film_main&sf_cache_key=*', $current_app);
		}
		return parent::doDeleteAll($con);
	}
	
	public static function getCountByFilm($film_id){
    	$criteria = new Criteria();
	    $criteria->add(self::FILM_ID, $film_id);
	    return self::doCount($criteria);
	}
	
}
