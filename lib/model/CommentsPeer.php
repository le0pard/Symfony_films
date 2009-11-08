<?php

class CommentsPeer extends BaseCommentsPeer
{
	static public function getByFilmId($film_id = null) {
    	$criteria = new Criteria();
		if ($film_id){
	    	$criteria->add(self::FILM_ID, $film_id);
		}
	    $criteria->addAscendingOrderByColumn(self::CREATED_AT);
	    return $criteria;
    }
    
	public static function doDeleteAll($con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app){
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=comment&action=_last_comments&sf_cache_key=last_comments', $current_app);
			sfProjectConfiguration::getActive()->clearFrontendCache('comment/last_comments', $current_app); 
		}
		return parent::doDeleteAll($con);
	}
}
