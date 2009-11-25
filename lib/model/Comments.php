<?php

class Comments extends BaseComments
{	

}

sfPropelBehavior::add('Comments', array(
	'viewCacheObserver' => array(
		'cache' => array(
			'comment/last_comments',
			'@sf_cache_partial?module=comment&action=_last_comments&sf_cache_key=last_comments'
		),
	)
));
