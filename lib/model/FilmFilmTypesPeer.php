<?php

class FilmFilmTypesPeer extends BaseFilmFilmTypesPeer
{
	static public function addCatalogCriteria(FilmTypes $f_obj = null, Criteria $criteria = null) {
		if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	    if (!is_null($f_obj)) {
	    	$criteria->add(self::FILM_GENRE_ID, $f_obj->getId());
	    }
	    //$criteria->addDescendingOrderByColumn(self::UPDATE_DATA);
	    return $criteria;
    }
}
