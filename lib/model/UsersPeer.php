<?php

class UsersPeer extends BaseUsersPeer
{
	static public function addActiveCriteria(Criteria $criteria = null){
	    if (is_null($criteria)){
	      $criteria = new Criteria();
	    }
	    $criteria->add(self::IS_ACTIVE, true);
	    return $criteria;
  	}
	
	static public function getActiveUser($login, $password){
		$criteria = self::addActiveCriteria();
		$criteria->add(self::LOGIN, $login);
		$criteria->add(self::PASSWORD, md5($password));
	    $user = self::doSelectOne($criteria);
	    if (!$user){
	    	$criteria = self::addActiveCriteria();
			$criteria->add(self::EMAIL, $login);
			$criteria->add(self::PASSWORD, md5($password));
		    $user = self::doSelectOne($criteria);
	    }
	    return $user;
    }
	
	static public function getActivedOne(Criteria $criteria = null){
	    return self::doSelectOne(self::addActiveCriteria($criteria));
    }
    
	static public function getTopUsersByFilms(Criteria $criteria = null){
		if (is_null($criteria)){
	      $criteria = new Criteria();
	    }
	    $criteria->add(self::IS_ACTIVE, true);
	    $criteria->setLimit(sfConfig::get('app_users_top_film', 10));
		$criteria->addDescendingOrderByColumn(self::COUNT_OF_FILMS);
	    return self::doSelect($criteria);
    }

}
