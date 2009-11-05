<?php

class CommentsPeer extends BaseCommentsPeer
{
	static public function getByFilmId($film_id = null) {
    	$criteria = new Criteria();
		if ($film_id){
	    	$criteria->add(self::COMMENT_TYPE_ID, $film_id);
		}
		$criteria->add(self::COMMENT_TYPE_NAME, 'Film');
	    $criteria->addAscendingOrderByColumn(self::CREATED_AT);
	    return $criteria;
    }
}
