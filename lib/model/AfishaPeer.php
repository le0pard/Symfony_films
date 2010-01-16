<?php

class AfishaPeer extends BaseAfishaPeer
{
	
	static public function getByExternalId($external_id) {
		$criteria = new Criteria();
		$criteria->add(self::EXTERNAL_ID, $external_id);
    	return self::doSelectOne($criteria);
    }
	
}
