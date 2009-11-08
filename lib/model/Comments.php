<?php

class Comments extends BaseComments
{
	public function save(PropelPDO $con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app){
			sfProjectConfiguration::getActive()->clearFrontendCache('comment/last_comments', $current_app);
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=comment&action=_last_comments&sf_cache_key=last_comments', $current_app); 
		}
		return parent::save($con);
	}
	
	public function delete(PropelPDO $con = null) {
		//clear cache
		$current_app = sfConfig::get('sf_app');
		if ($current_app){
			sfProjectConfiguration::getActive()->clearFrontendCache('comment/last_comments', $current_app);
			sfProjectConfiguration::getActive()->clearFrontendCache('@sf_cache_partial?module=comment&action=_last_comments&sf_cache_key=last_comments', $current_app); 
		}
		return parent::delete($con);
	}
}
