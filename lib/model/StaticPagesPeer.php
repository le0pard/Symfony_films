<?php

class StaticPagesPeer extends BaseStaticPagesPeer
{
	static public function addVisibleCriteria(Criteria $criteria = null) {
	    if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	 
	    $criteria->add(self::IS_VISIBLE, true);
	    $criteria->addAscendingOrderByColumn(self::SORT);
	    return $criteria;
    }
	
	static public function doSelectOneVisible(Criteria $criteria = null){
		return self::doSelectOne(self::addVisibleCriteria($criteria));
	}
	
	static public function doSelectVisible(Criteria $criteria = null){
		return self::doSelect(self::addVisibleCriteria($criteria));
	}
}
