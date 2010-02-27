<?php

class FilmPeer extends BaseFilmPeer
{
	
	public static function doSelectJoinRaiting(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		FilmPeer::addSelectColumns($criteria);
		$startcol2 = (FilmPeer::NUM_COLUMNS - FilmPeer::NUM_LAZY_LOAD_COLUMNS);

		FilmTotalRatingPeer::addSelectColumns($criteria);

		$criteria->addJoin(FilmPeer::ID, FilmTotalRatingPeer::FILM_ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FilmPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FilmPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = FilmPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				FilmPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Users rows

			$key2 = FilmTotalRatingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = FilmTotalRatingPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = FilmTotalRatingPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FilmTotalRatingPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (Film) to the collection in $obj2 (Users)
				$obj1->setFilmRaitingNum($obj2->getTotalRating());
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}
	
	static public function addVisibleCriteria(Criteria $criteria = null) {
	    if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	 
	    $criteria->add(self::IS_VISIBLE, true);
		$criteria->add(self::IS_PUBLIC, true);
	    $criteria->addDescendingOrderByColumn(self::MODIFIED_AT);
	    return $criteria;
    }
	
	static public function doSelectOneVisible(Criteria $criteria = null){
		return self::doSelectOne(self::addVisibleCriteria($criteria));
	}
	
	static public function getVisible(Criteria $criteria = null) {
    	return self::doSelect(self::addVisibleCriteria($criteria));
    }
 
  	static public function countVisible(Criteria $criteria = null) {
    	return self::doCount(self::addVisibleCriteria($criteria));
  	}
	
	static public function countByDateRange($date_begin, $date_end) {
		$criteria = new Criteria();
		$cton1 = $criteria->getNewCriterion(self::MODIFIED_AT, $date_begin, Criteria::GREATER_EQUAL);
		$cton2 = $criteria->getNewCriterion(self::MODIFIED_AT, $date_end, Criteria::LESS_EQUAL);
		$cton1->addAnd($cton2);
		$criteria->add($cton1);
    	return self::doCount(self::addVisibleCriteria($criteria));
  	}
	
	static public function doSelectEditFilmCriteria(Criteria $criteria = null) {
	  if (is_null($criteria)) {
	     $criteria = new Criteria();
	  }
	  if (!sfContext::getInstance()->getUser()->hasCredential(array('admin', 'super_admin', 'moder'), false)){
	  	$criteria->add(self::IS_VISIBLE, false);
	  	$criteria->add(self::IS_PUBLIC, false);
	  	$criteria->add(self::USER_ID, sfContext::getInstance()->getUser()->getAuthUser()->getId());
	  }
	  return $criteria;
    }
	
	static public function doSelectEditFilm(Criteria $criteria = null)
	{
	  return self::doSelectOne(self::doSelectEditFilmCriteria($criteria));
	}
	
	static public function doSelectUnpublicCriteria(Criteria $criteria = null) {
	  if (is_null($criteria)) {
	     $criteria = new Criteria();
	  }
	  $criteria->add(self::IS_VISIBLE, false);
	  $criteria->add(self::IS_PUBLIC, false);
	  $criteria->add(self::USER_ID, sfContext::getInstance()->getUser()->getAuthUser()->getId());
	  return $criteria;
    }
	
	static public function doSelectUserUnpublic(Criteria $criteria = null)
	{
	  return self::doSelectOne(self::doSelectUnpublicCriteria($criteria));
	}
	
	static public function doSelectUnvisibleCriteria(Criteria $criteria = null) {
	  if (is_null($criteria)) {
	     $criteria = new Criteria();
	  }
	  $criteria->add(self::IS_VISIBLE, false);
	  $criteria->add(self::IS_PUBLIC, true);
	  return $criteria; 
	}
	
	static public function doCountUnvisible(Criteria $criteria = null)
	{
	  return self::doCount(self::doSelectUnvisibleCriteria($criteria));
	}
	
	static public function doSelectUnvisible(Criteria $criteria = null)
	{
	  return self::doSelect(self::doSelectUnvisibleCriteria($criteria));
	}
	
	//search
	static public function getLuceneIndex()
	{
	  ProjectConfiguration::registerZend();
	  Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());
	  Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('UTF-8');
	  if (file_exists($index = self::getLuceneIndexFile()))
	  {
	    return Zend_Search_Lucene::open($index);
	  }
	  else
	  {
	    return Zend_Search_Lucene::create($index);
	  }
	}
	
	static public function getLuceneIndexFile()
	{
	  return sfConfig::get('sf_data_dir').'/films.'.sfConfig::get('sf_environment').'.index';
	}
	
	public static function doDeleteAll($con = null) {
		if (file_exists($index = self::getLuceneIndexFile())) {
			sfToolkit::clearDirectory($index);
			rmdir($index);
		}
		
		return parent::doDeleteAll($con);
	}
	
	static public function getForLuceneQuery($query) {
		$index = self::getLuceneIndex();
		$hits = $index->find($query);
		$pks = array();
		foreach ($hits as $hit) {
			$pks[] = $hit->pk;
		}
		$criteria = new Criteria();
		$criteria->add(self::ID, $pks, Criteria::IN);
		$criteria->setLimit(sfConfig::get('app_search_limit', 50));
		$criteria->add(self::IS_VISIBLE, true);
		$criteria->add(self::IS_PUBLIC, true);
		return self::doSelect($criteria);
	}

	static public function searchAutoComplete($title){
		$criteria = new Criteria();
		$criteria->add(self::TITLE, "%".$title."%", Criteria::LIKE);
		$criteria->setLimit(8);
		return self::doSelect(self::addVisibleCriteria($criteria));
	}
	
	static public function getTopNewFilms(Criteria $criteria = null){
		if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	    $criteria->add(self::IS_VISIBLE, true);
		$criteria->setLimit(sfConfig::get('app_films_top_new', 10));
		$criteria->addDescendingOrderByColumn(self::MODIFIED_AT);
		return self::doSelectJoinRaiting($criteria);
	}

}
