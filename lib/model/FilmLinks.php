<?php

class FilmLinks extends BaseFilmLinks
{
	public function save(PropelPDO $con = null) {
		if ($this->isNew()){
			$this->setSort(FilmLinksPeer::getCountByFilm($this->getFilm()->getId()));
		}
		return parent::save($con);
	}
}

sfPropelBehavior::add('FilmLinks', array(
	'viewCacheObserver' => array(
		'belongs_to_depend' => array(
			'getFilm'
		)
	)
));
