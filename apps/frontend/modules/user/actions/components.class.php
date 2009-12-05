<?php
class userComponents extends sfComponents
{
	public function executeCard() {

	}
	
	public function executeTopUsers() {
		$this->users = UsersPeer::getTopUsersByFilms();
	}

}