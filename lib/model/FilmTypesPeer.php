<?php

class FilmTypesPeer extends BaseFilmTypesPeer
{
	static public function doSelectActive(Criteria $criteria)
	{
	  $criteria->add(self::IS_VISIBLE, true);
	  return self::doSelectOne($criteria);
	}

}
