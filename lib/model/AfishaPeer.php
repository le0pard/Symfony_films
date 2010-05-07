<?php

class AfishaPeer extends BaseAfishaPeer
{
	
	static public function getByExternalId($external_id) {
		$criteria = new Criteria();
		$criteria->add(self::EXTERNAL_ID, $external_id);
    	return self::doSelectOne($criteria);
    }
    
    static private function getForTodayFilmIds($city){
    	$afisha_ids = array();
    	
    	if ($city){
	    	$selected_day = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	    	
	    	$criteria = new Criteria();
	    	$criteria->addSelectColumn(self::AFISHA_FILM_ID);
	  		$criteria->setDistinct();
	  		
	  		$cton1 = $criteria->getNewCriterion(self::DATE_BEGIN, date('c', $selected_day), Criteria::LESS_EQUAL);
			$cton2 = $criteria->getNewCriterion(self::DATE_END, date('c', $selected_day), Criteria::GREATER_EQUAL);
			$cton1->addAnd($cton2);
			$criteria->add($cton1);
			
			$criteria->addJoin(AfishaPeer::AFISHA_THEATER_ID, AfishaTheaterPeer::ID, Criteria::LEFT_JOIN);
			$criteria->add(AfishaTheaterPeer::AFISHA_CITY_ID, $city->getId());
			
	    	$stmt = self::doSelectStmt($criteria);
	    	
			while ($res = $stmt->fetch(PDO::FETCH_NUM)) {
				$afisha_ids[] = $res[0];
			}
    	}
    	
		return $afisha_ids;
    }
    
    static public function getForTopMain($city){
		return AfishaFilmPeer::getForTop(self::getForTodayFilmIds($city));
    }
    
	static public function getForTodayFilms($city){
		return AfishaFilmPeer::getFilmsByIds(self::getForTodayFilmIds($city));
    }
    
    static public function getCriteriaForTodayMobile($city, $order = 0){
		return AfishaFilmPeer::getCriteriaFilmsByIdsForMobile(self::getForTodayFilmIds($city), $order);
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
