<?php

class Film extends BaseFilm
{
	public function __toString(){
    	return sprintf('%s (%s)', $this->getTitle(), $this->getOriginalTitle());
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
		
		return parent::delete($con);
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
		// store job primary key to identify it in the search results
		$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));
		// index job fields
		$doc->addField(Zend_Search_Lucene_Field::Text('title',
		$this->getTitle(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::Text('original_title',
		$this->getOriginalTitle(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('pub_year',
		$this->getPubYear(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('director',
		$this->getDirector(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('cast',
		$this->getCast(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('country',
		$this->getCountry(), 'UTF-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('about',
		$this->getAbout(), 'UTF-8'));
		// add job to the index
		$index->addDocument($doc);
		$index->commit();
	}

}

sfPropelBehavior::add('Film', array(
	'viewCacheObserver' => array(
		'cache' => array(
			'film_types/index',
			'@sf_cache_partial?module=film&action=_film_main&sf_cache_key=#{id}'
		),
		'has_many_depend' => array(
			'getFilmFilmTypessJoinFilmTypes' => 'getFilmTypes'
		),
		'variables' => array(
			'id' => 'getId'
		),
		'criteria' => array(
			//'getIsVisible' => true,
			//'getIsPublic' => true
		)
	)
));
