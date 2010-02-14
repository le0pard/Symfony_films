<?php

require 'lib/model/om/BaseAfishaFilmPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'afisha_film' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Fri Jan 15 23:07:01 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class AfishaFilmPeer extends BaseAfishaFilmPeer {

	static public function getByExternalId($external_id) {
		$criteria = new Criteria();
		$criteria->add(self::EXTERNAL_ID, $external_id);
    	return self::doSelectOne($criteria);
    }
    
	static public function getForTop($limit = null) {
		$criteria = new Criteria();
		if ($limit){
			$criteria->setLimit($limit);
		}
		$criteria->add(AfishaFilmPeer::POSTER, NULL, Criteria::NOT_EQUAL);
		$criteria->addDescendingOrderByColumn(AfishaFilmPeer::EXTERNAL_ID);
		$criteria->addAscendingOrderByColumn(AfishaFilmPeer::TITLE);
    	return self::doSelect($criteria);
    }
	
} // AfishaFilmPeer
