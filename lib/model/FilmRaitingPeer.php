<?php

class FilmRaitingPeer extends BaseFilmRaitingPeer
{
	static public function getRatingByFilm($film_id){
		$c = new Criteria();
		$c->clearSelectColumns();
		$c->add(self::FILM_ID, $film_id);
		$c->addSelectColumn('SUM(' . self::RATING . ') AS total');
		$c->addSelectColumn('COUNT(*) AS count');
		$c->addGroupByColumn(self::FILM_ID);
		$sum = self::doSelectStmt($c);
		$total = 0; $count = 0;
		while ($row = $sum->fetch(PDO::FETCH_NUM)) {
			$total = $row[0];
			$count = $row[1];
		}
		if ($count > 0){
			return round($total/$count, 1);
		} else {
			return 0;
		}
	}
	
	static public function userAlreadyVoted($film_id, $user_id){
		$criteria = new Criteria();
		$criteria->add(self::FILM_ID, $film_id);
		$criteria->add(self::USER_ID, $user_id);
		return self::doSelectOne($criteria);
	}
	
}
