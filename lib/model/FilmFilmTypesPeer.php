<?php

class FilmFilmTypesPeer extends BaseFilmFilmTypesPeer
{
	
	public static function doSelectJoinFilmAndRaiting(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		FilmFilmTypesPeer::addSelectColumns($criteria);
		$startcol = (FilmFilmTypesPeer::NUM_COLUMNS - FilmFilmTypesPeer::NUM_LAZY_LOAD_COLUMNS);
		
		FilmPeer::addSelectColumns($criteria);
		$startcol2 = $startcol + (FilmPeer::NUM_COLUMNS - FilmPeer::NUM_LAZY_LOAD_COLUMNS);
		
		FilmTotalRatingPeer::addSelectColumns($criteria);
		
		$criteria->addJoin(FilmFilmTypesPeer::FILM_ID, FilmPeer::ID, $join_behavior);
		$criteria->addJoin(FilmPeer::ID, FilmTotalRatingPeer::FILM_ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FilmFilmTypesPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FilmFilmTypesPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = FilmFilmTypesPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				FilmFilmTypesPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = FilmPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = FilmPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = FilmPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					FilmPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (FilmFilmTypes) to $obj2 (Film)
				$obj2->addFilmFilmTypes($obj1);

			} // if joined row was not null
			
			$key3 = FilmTotalRatingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key3 !== null) {
				
				$obj3 = FilmTotalRatingPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = FilmTotalRatingPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol2);
					FilmTotalRatingPeer::addInstanceToPool($obj3, $key3);
				} // if obj2 loaded

				$obj2->setFilmRaitingNum($obj3->getTotalRating());
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}
	
	
	static public function addCatalogCriteria(FilmTypes $f_obj = null, Criteria $criteria = null) {
		if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	    if (!is_null($f_obj)) {
	    	$criteria->add(self::FILM_GENRE_ID, $f_obj->getId());
	    }
	    //$criteria->addDescendingOrderByColumn(self::MODIFIED_AT);
	    return $criteria;
    }
}
