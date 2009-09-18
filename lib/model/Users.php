<?php

class Users extends BaseUsers
{
	public function __toString() {
    	return $this->getLogin();
    }
	
	public function setPassword($password){
		if (!$password && 0 == strlen($password)){
			return false;
		}
		parent::setPassword(md5($password));
    }
	
	public function getUnpublicFilms(){
		return FilmPeer::doSelect(FilmPeer::doSelectUnpublicCriteria());
	}
	
	public function getUnpublicFilmsCount(){
		return FilmPeer::doCount(FilmPeer::doSelectUnpublicCriteria());
	}

}
