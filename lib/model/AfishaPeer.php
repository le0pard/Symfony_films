<?php

class AfishaPeer extends BaseAfishaPeer
{
	
	static public function getByExternalId($external_id) {
		$criteria = new Criteria();
		$criteria->add(self::EXTERNAL_ID, $external_id);
    	return self::doSelectOne($criteria);
    }
    
	static public function getForTop($city_id, $limit = null) {
		$criteria = new Criteria();
		$criteria->add(AfishaTheaterPeer::AFISHA_CITY_ID, $city_id);
		if ($limit){
			$criteria->setLimit($limit);
		}
		$criteria->add(AfishaFilmPeer::POSTER, NULL, Criteria::NOT_EQUAL);
		$criteria->addDescendingOrderByColumn(AfishaFilmPeer::EXTERNAL_ID);
		$criteria->addAscendingOrderByColumn(AfishaFilmPeer::TITLE);
		$criteria->addGroupByColumn(AfishaFilmPeer::ID);
    	return self::doSelectJoinAll($criteria);
    }
    
	static public function getByDateRangeAndCity($date_begin, $date_end, $city_id, $limit = null) {
		$criteria = new Criteria();
		$cton1 = $criteria->getNewCriterion(self::DATE_BEGIN, $date_begin, Criteria::LESS_EQUAL);
		$cton2 = $criteria->getNewCriterion(self::DATE_END, $date_end, Criteria::GREATER_EQUAL);
		$cton1->addAnd($cton2);
		$criteria->add($cton1);
		$criteria->add(AfishaTheaterPeer::AFISHA_CITY_ID, $city_id);
		if ($limit){
			$criteria->setLimit($limit);
		}
		$criteria->addAscendingOrderByColumn(AfishaTheaterPeer::TITLE);
		$criteria->addAscendingOrderByColumn(AfishaFilmPeer::TITLE);
    	return self::doSelectJoinAll($criteria);
    }
    
	static public function getByDateRangeAndCinema($date_begin, $date_end, $cinema_id) {
		$criteria = new Criteria();
		$cton1 = $criteria->getNewCriterion(self::DATE_BEGIN, $date_begin, Criteria::LESS_EQUAL);
		$cton2 = $criteria->getNewCriterion(self::DATE_END, $date_end, Criteria::GREATER_EQUAL);
		$cton1->addAnd($cton2);
		$criteria->add($cton1);
		$criteria->add(AfishaTheaterPeer::ID, $cinema_id);
		$criteria->addAscendingOrderByColumn(AfishaTheaterPeer::TITLE);
		$criteria->addAscendingOrderByColumn(AfishaFilmPeer::TITLE);
    	return self::doSelectJoinAll($criteria);
    }
    
	static public function getByDateRangeAndFilm($date_begin, $date_end, $film_id, $city_id) {
		$criteria = new Criteria();
		$cton1 = $criteria->getNewCriterion(self::DATE_BEGIN, $date_begin, Criteria::LESS_EQUAL);
		$cton2 = $criteria->getNewCriterion(self::DATE_END, $date_end, Criteria::GREATER_EQUAL);
		$cton1->addAnd($cton2);
		$criteria->add($cton1);
		$criteria->add(AfishaFilmPeer::ID, $film_id);
		$criteria->add(AfishaTheaterPeer::AFISHA_CITY_ID, $city_id);
		$criteria->addAscendingOrderByColumn(AfishaTheaterPeer::TITLE);
		$criteria->addAscendingOrderByColumn(AfishaFilmPeer::TITLE);
    	return self::doSelectJoinAll($criteria);
    }
	
}
