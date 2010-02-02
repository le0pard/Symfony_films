<?php

require 'lib/model/om/BaseBannedIpsPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'banned_ips' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Fri Jan 15 19:29:11 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class BannedIpsPeer extends BaseBannedIpsPeer {

	static public function isBannedByIp($ip){
		$criteria = new Criteria();
		$criteria->add(self::IP, $ip);
		if (self::doCount($criteria) > 0){
			return true;
		} else {
			return false;
		}
	}
	
	static public function getByIp($ip){
		$criteria = new Criteria();
		$criteria->add(self::IP, $ip);
		return self::doSelectOne($criteria);
	}
	
} // BannedIpsPeer
