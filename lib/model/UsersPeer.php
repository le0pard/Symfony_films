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
	    return self::doSelectOne($criteria);
    }
	
	static public function getActivedOne(Criteria $criteria = null){
	    return self::doSelectOne(self::addActiveCriteria($criteria));
    }
}
