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
	
	public static function doDeleteAll($con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app){
			sfProjectConfiguration::getActive()->clearFrontendCache('static/show?id=*&url=*', $current_app);
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=static&action=_menu&sf_cache_key=menu', $current_app); 
		}
		return parent::doDeleteAll($con);
	}
}
