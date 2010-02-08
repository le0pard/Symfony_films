<?php
class userComponents extends sfComponents
{
	public function executeCard() {
		if ($this->getUser()->isAnonymous()){
			$this->form = new LoginForm();
		}
	}
	
	public function executeTopUsers() {
		$this->users = UsersPeer::getTopUsersByFilms();
	}

}