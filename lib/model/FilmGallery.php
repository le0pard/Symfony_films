<?php

class FilmGallery extends BaseFilmGallery
{
	public function setThumbImg($img){
	  parent::setThumbImg($img);
	  $this->setNormalImg(str_replace('thumb_', '', $img));
	}
}
