<?php

class Afisha extends BaseAfisha
{
}

sfPropelBehavior::add('Afisha', array(
	'viewCacheObserver' => array(
		'cache' => array(
			'@sf_cache_partial?module=afisha&action=_today&sf_cache_key=afisha',
			'afisha/index',
			'afisha/index?id=*',
			'afisha/index?day=*&id=*&month=*&year=*'
		),
		'belongs_to_depend' => array(
			'getAfishaTheater',
			'getAfishaFilm'
		),
		'variables' => array(
			'id' => 'getId'
		),
		'criteria' => array(
			//'getIsVisible' => true,
			//'getIsPublic' => true
		)
	)
));