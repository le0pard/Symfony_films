<?php

class Film extends BaseFilm
{
	private $filmRaitingNum = 0;
	
	public function __toString(){
    	return sprintf('%s (%s)', $this->getTitle(), $this->getOriginalTitle());
    }
    
    public function setFilmRaitingNum($num){
    	$this->filmRaitingNum = $num;
    }
    
	public function getFilmRaitingNum(){
    	return $this->filmRaitingNum;
    }
	
	public function setTitle($title){
	  parent::setTitle($title);
	  $this->setUrl(System::slugify($title));
	}
	
	public function setThumbLogo($logo){
	  parent::setThumbLogo($logo);
	  $this->setNormalLogo(str_replace('thumb_', '', $logo));
	}
	
	public function getGallery(){
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(FilmGalleryPeer::SORT);
		return $this->getFilmGallerys($criteria);
	}
	
	public function getGalleryCount(){
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(FilmGalleryPeer::SORT);
		return $this->countFilmGallerys($criteria);
	}
	
	public function getLinks(){
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(FilmLinksPeer::SORT);
		return $this->getFilmLinkss($criteria);
	}
	
	public function getLinksCount(){
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(FilmLinksPeer::SORT);
		return $this->countFilmLinkss($criteria);
	}
	
	public function getTrailers(){
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(FilmTrailerPeer::SORT);
		return $this->getFilmTrailers($criteria);
	}
	
	public function getRating(){
	  return FilmRaitingPeer::getRatingByFilm($this->getId());
	}
	
	public function getUserRaiting($user_id){
	  return FilmRaitingPeer::userAlreadyVoted($this->getId(), $user_id);
	}
	
	#search add
	public function save(PropelPDO $con = null) {
		if (is_null($con)) {
			$con = Propel::getConnection(FilmPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$con->beginTransaction();
		try {
			$ret = parent::save($con);
			$this->updateLuceneIndex();
			$con->commit();
			$this->countFilmsForUser();
			return $ret;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}
	
	public function delete(PropelPDO $con = null) {
		$index = FilmPeer::getLuceneIndex();
		foreach ($index->find('pk:'.$this->getId()) as $hit) {
			$index->delete($hit->id);
		}
		
		$rez = parent::delete($con);
		$this->countFilmsForUser();
		return $rez;
	}


	public function updateLuceneIndex() {
		$index = FilmPeer::getLuceneIndex();
		// remove existing entries
		foreach ($index->find('pk:'.$this->getId()) as $hit) {
			$index->delete($hit->id);
		}
		// don't index expired and non-activated films
		if (!$this->getIsPublic() || !$this->getIsVisible()){
			return;
		}
		$doc = new Zend_Search_Lucene_Document();
		// store primary key to identify it in the search results
		$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));
		// index fields
		$doc->addField(Zend_Search_Lucene_Field::Text('title',
		$this->getTitle(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::Text('original_title',
		$this->getOriginalTitle(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('pub_year',
		$this->getPubYear(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('director',
		$this->getDirector(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('cast_people',
		$this->getCastPeople(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('country',
		$this->getCountry(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('about',
		$this->getAbout(), 'UTF-8'));
		// add job to the index
		$index->addDocument($doc);
		$index->commit();
	}
	
	public function countFilmsForUser(){
		if (($user = $this->getUsersRelatedByUserId()) == true){
			$user->setCountOfFilms($user->countFilmsRelatedByUserId(FilmPeer::addVisibleCriteria()));
			$user->save();
		}
	}
	
	public function getNextFilm(Criteria $criteria = null){
		if (is_null($criteria)) {
	    	$criteria = new Criteria();
	    }
	    $criteria->add(FilmPeer::IS_VISIBLE, true);
		$criteria->add(FilmPeer::IS_PUBLIC, true);
		$criteria->addAscendingOrderByColumn(FilmPeer::MODIFIED_AT);
		$criteria->add(FilmPeer::MODIFIED_AT, $this->getModifiedAt(), Criteria::GREATER_EQUAL);
		$criteria->add(FilmPeer::ID, $this->getId(), Criteria::NOT_EQUAL);
		return FilmPeer::doSelectOne($criteria);
	}
	
	public function getPrevFilm(Criteria $criteria = null){
		$criteria = FilmPeer::addVisibleCriteria($criteria);
		$criteria->add(FilmPeer::MODIFIED_AT, $this->getModifiedAt(), Criteria::LESS_EQUAL);
		$criteria->add(FilmPeer::ID, $this->getId(), Criteria::NOT_EQUAL);
		return FilmPeer::doSelectOne($criteria);
	}
	
}

sfPropelBehavior::add('Film', array(
	'viewCacheObserver' => array(
		'cache' => array(
			'film_types/index?page=*',
			'film_types/index',
			'film_types/year?year=*',
			'film_types/year?year=*&page=*',
			'@sf_cache_partial?module=film&action=_film_main&sf_cache_key=#{id}',
			'@sf_cache_partial?module=film&action=_topNew&sf_cache_key=top_new',
			//mobile
			'mobile/index?sf_format=mobile',
			'mobile/index?page=*&sf_format=mobile',
			'mobile/film?id=#{id}&sf_format=mobile'
		),
		'has_many_depend' => array(
			'getFilmFilmTypessJoinFilmTypes' => 'getFilmTypes'
		),
		'variables' => array(
			'id' => 'getId',
			'year' => 'getPubYear'
		),
		'criteria' => array(
			//'getIsVisible' => true,
			//'getIsPublic' => true
		)
	)
));
