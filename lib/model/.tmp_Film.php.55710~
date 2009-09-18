<?php

class Film extends BaseFilm
{
	public function __toString(){
    	return sprintf('%s (%s)', $this->getTitle(), $this->getOriginalTitle());
    }
	
	public function setTitle($title){
	  parent::setTitle($title);
	  $this->setUrl(System::slugify($title));
	}
	
	public function setNormalLogo($logo){
	  parent::setNormalLogo($logo);
	  $this->setThumbLogo('thumb_'.$logo);
	}
	
	public function getGallery(){
		$criteria = new Criteria();
		$criteria->add(FilmGalleryPeer::FILM_ID, $this->getId());
		$criteria->addAscendingOrderByColumn(FilmGalleryPeer::ID);
		return FilmGalleryPeer::doSelect($criteria);
	}
	
	public function getGalleryCount(){
		$criteria = new Criteria();
		$criteria->add(FilmGalleryPeer::FILM_ID, $this->getId());
		$criteria->addAscendingOrderByColumn(FilmGalleryPeer::ID);
		return FilmGalleryPeer::doCount($criteria);
	}
	
	public function getLinks(){
		$criteria = new Criteria();
		$criteria->add(FilmLinksPeer::FILM_ID, $this->getId());
		$criteria->addAscendingOrderByColumn(FilmLinksPeer::ID);
		return FilmLinksPeer::doSelect($criteria);
	}
	
	public function getLinksCount(){
		$criteria = new Criteria();
		$criteria->add(FilmLinksPeer::FILM_ID, $this->getId());
		$criteria->addAscendingOrderByColumn(FilmLinksPeer::ID);
		return FilmLinksPeer::doCount($criteria);
	}
}
