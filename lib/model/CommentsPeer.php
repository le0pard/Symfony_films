<?php

class CommentsPeer extends BaseCommentsPeer
{
	static public function getByFilmId($film_id = null) {
    	$criteria = new Criteria();
		if ($film_id){
	    	$criteria->add(self::FILM_ID, $film_id);
		}
	    $criteria->addDescendingOrderByColumn(self::CREATED_AT);
	    return $criteria;
    }
}
