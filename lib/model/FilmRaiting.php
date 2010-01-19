<?php

class FilmRaiting extends BaseFilmRaiting
{
	
	public function getFilmId(){
		if (($film = $this->getFilm()) == true){
			return $film->getId();
		} else {
			return 0;
		}
	}
	
}

sfPropelBehavior::add('FilmRaiting', array(
	'viewCacheObserver' => array(
		'cache' => array(
			'@sf_cache_partial?module=film&action=_rating&sf_cache_key=#{film_id}'
		),
		'variables' => array(
			'film_id' => 'getFilmId'
		)
	)
));