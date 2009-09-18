<?php

class FilmPeer extends BaseFilmPeer
{
	static public function addVisibleCriteria(Criteria $criteria = null) {
	    if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	 
	    $criteria->add(self::IS_VISIBLE, true);
		$criteria->add(self::IS_PUBLIC, true);
	    $criteria->addDescendingOrderByColumn(self::UPDATE_DATA);
	    return $criteria;
    }
	
	static public function doSelectOneVisible(Criteria $criteria = null){
		return self::doSelectOne(self::addVisibleCriteria($criteria));
	}
	
	static public function getVisible(Criteria $criteria = null) {
    	return self::doSelect(self::addVisibleCriteria($criteria));
    }
 
  	static public function countVisible(Criteria $criteria = null) {
    	return self::doCount(self::addVisibleCriteria($criteria));
  	}
	
	static public function doSelectUnpublicCriteria(Criteria $criteria = null) {
	  if (is_null($criteria)) {
	     $criteria = new Criteria();
	  }
	  $criteria->add(self::IS_VISIBLE, false);
	  $criteria->add(self::IS_PUBLIC, false);
	  $criteria->add(self::USER_ID, sfContext::getInstance()->getUser()->getAuthUser()->getId());
	  return $criteria;
    }
	
	static public function doSelectUserUnpublic(Criteria $criteria)
	{
	  return self::doSelectOne(self::doSelectUnpublicCriteria());
	}
	
	//search
	static public function getLuceneIndex()
	{
	  ProjectConfiguration::registerZend();
	  if (file_exists($index = self::getLuceneIndexFile()))
	  {
	    return Zend_Search_Lucene::open($index);
	  }
	  else
	  {
	    return Zend_Search_Lucene::create($index);
	  }
	  $analyzer = new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num();
	  Zend_Search_Lucene_Analysis_Analyzer::setDefault($analyzer);
	  Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('UTF-8');
	}
	
	static public function getLuceneIndexFile()
	{
	  return sfConfig::get('sf_data_dir').'/films.'.sfConfig::get('sf_environment').'.index';
	}
	
	public static function doDeleteAll($con = null) {
		if (file_exists($index = self::getLuceneIndexFile())) {
			sfToolkit::clearDirectory($index);
			rmdir($index);
		}
		return parent::doDeleteAll($con);
	}
	
	static public function getForLuceneQuery($query) {
		$index = self::getLuceneIndex();
		//$query_str = mb_strtolower($query, 'UTF-8');
		//$query_str = Zend_Search_Lucene_Search_QueryParser::parse($query, 'utf-8');
		$hits = $index->find($query);
		$pks = array();
		foreach ($hits as $hit) {
			$pks[] = $hit->pk;
		}
		$criteria = new Criteria();
		$criteria->add(self::ID, $pks, Criteria::IN);
		$criteria->setLimit(50);
		return self::doSelect(self::addVisibleCriteria($criteria));
	}



}
