<?php

class FilmTypesPeer extends BaseFilmTypesPeer
{
	static public function doSelectActive(Criteria $criteria)
	{
	  $criteria->add(self::IS_VISIBLE, true);
	  return self::doSelectOne($criteria);
	}
	
	public static function doDeleteAll($con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app){
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=film&action=_types&sf_cache_key=types', $current_app); 
		}
		return parent::doDeleteAll($con);
	}

}
