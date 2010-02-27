<?php
class userComponents extends sfComponents
{
	public function executeCard() {
		if ($this->getUser()->isAnonymous()){
			$this->form = new LoginForm();
		} else {
			if ($this->getUser()->hasCredential(array('super_admin', 'admin', 'moder'), false)){
				$this->count_moder_unvisible = FilmPeer::doCountUnvisible();
			}
		}
	}
	
	public function executeTopUsers() {
		$this->users = UsersPeer::getTopUsersByFilms();
	}

}