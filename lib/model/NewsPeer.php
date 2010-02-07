<?php

class NewsPeer extends BaseNewsPeer
{
	
	static public function addVisibleCriteria(Criteria $criteria = null) {
	    if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	 
	    $criteria->add(self::IS_VISIBLE, true);
	    $criteria->addDescendingOrderByColumn(self::UPDATED_AT);
	    return $criteria;
    }
    
	static public function getVisible(Criteria $criteria = null){
    	return self::doSelectOne(self::addVisibleCriteria($criteria));
    }
    
    static public function getLatest($count = 4){
    	$criteria = self::addVisibleCriteria();
    	$criteria->setLimit($count);
    	return self::doSelect($criteria);
    }
	
}
