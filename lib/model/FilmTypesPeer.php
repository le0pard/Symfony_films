<?php

class FilmTypesPeer extends BaseFilmTypesPeer
{
	static public function doSelectActive(Criteria $criteria)
	{
	  $criteria->add(self::IS_VISIBLE, true);
	  return self::doSelectOne($criteria);
	}
	
	public static function doDeleteAll($con = null) {
		/*
		$cacheManager = sfContext::getInstance()->getViewCacheManager();
		if ($cacheManager){
			$cacheManager->remove('@sf_cache_partial?module=film&action=_types&sf_cache_key=types');
		}
		*/
		$frontend_cache_dir = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.sfConfig::get('sf_environment').DIRECTORY_SEPARATOR.'template';
		$cache = new sfFileCache(array('cache_dir' => $frontend_cache_dir));
		$cache->remove('films_leo_local/all/sf_cache_partial/film/_types/sf_cache_key/types');
		return parent::doDeleteAll($con);
	}

}
