<?php

class FilmGallery extends BaseFilmGallery
{
	public function setThumbImg($img){
	  parent::setThumbImg($img);
	  $this->setNormalImg(str_replace('thumb_', '', $img));
	}
	
 	public function save(PropelPDO $con = null) {
		if ($this->isNew()){
			$this->setSort(FilmGalleryPeer::getCountByFilm($this->getFilm()->getId()));
		}
		return parent::save($con);
	}
}

sfPropelBehavior::add('FilmGallery', array(
	'viewCacheObserver' => array(
		'up_depend' => array(
			'getFilm'
		)
	)
));
