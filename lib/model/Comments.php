<?php

class Comments extends BaseComments
{	
	static public function getCacheArray(){
		return array(
			'comment/last_comments',
			'@sf_cache_partial?module=comment&action=_last_comments&sf_cache_key=last_comments'
		);
	}
}

sfPropelBehavior::add('FilmTypes', array(
	'viewCacheObserver'
));
