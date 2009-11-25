<?php

class FilmLinksPeer extends BaseFilmLinksPeer
{
	
	public static function getCountByFilm($film_id){
    	$criteria = new Criteria();
	    $criteria->add(self::FILM_ID, $film_id);
	    return self::doCount($criteria);
	}
	
}
