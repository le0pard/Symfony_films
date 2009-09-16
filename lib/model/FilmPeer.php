<?php

class FilmPeer extends BaseFilmPeer
{
	static public function addVisibleCriteria(Criteria $criteria = null) {
	    if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	 
	    $criteria->add(self::IS_VISIBLE, true);
		$criteria->add(self::IS_PUBLIC, true);
	    $criteria->addDescendingOrderByColumn(self::UPDATE_DATA);
	    return $criteria;
    }
	
	static public function getVisible(Criteria $criteria = null) {
    	return self::doSelect(self::addVisibleCriteria($criteria));
    }
 
  	static public function countVisible(Criteria $criteria = null) {
    	return self::doCount(self::addVisibleCriteria($criteria));
  	}
	
	
	static public function doSelectUserUnpublic(Criteria $criteria)
	{
	  if (is_null($criteria)) {
	     $criteria = new Criteria();
	  }
	  $criteria->add(self::IS_VISIBLE, false);
	  $criteria->add(self::IS_PUBLIC, false);
	  $criteria->add(self::USER_ID, sfContext::getInstance()->getUser()->getAuthUser()->getId());
	  return self::doSelectOne($criteria);
	}
}
