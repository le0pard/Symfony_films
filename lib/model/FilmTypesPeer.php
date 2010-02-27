<?php

class FilmTypesPeer extends BaseFilmTypesPeer
{
	static public function getActiveCriteria(Criteria $criteria = null)
	{
	  if (is_null($criteria)) {
	    	$criteria = new Criteria();
	  }
	  $criteria->add(self::IS_VISIBLE, true);
	  $criteria->addAscendingOrderByColumn(self::TITLE);
	  return $criteria;
	}
	
	
	static public function doSelectActive(Criteria $criteria = null)
	{
	  return self::doSelectOne(self::getActiveCriteria($criteria));
	}

}
