<?php

/**
 * film_types actions.
 *
 * @package    symfony_films
 * @subpackage film_types
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class film_typesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfPropelPager(
		'Film',
		sfConfig::get('app_pages_main_page')
	);
	$this->pager->setPeerMethod('doSelectJoinRaiting');
	$this->pager->setCriteria(FilmPeer::addVisibleCriteria());
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->init();
	
	
	$response = $this->getResponse();
    $response->addMeta('keywords', sfConfig::get('app_http_keywords').', все жанры');
    $response->addMeta('description', sfConfig::get('app_http_description').' Все жанры кино');
  }
  
  public function executeShow(sfWebRequest $request)
  {
	$this->film_type = $this->getRoute()->getObject();
	
	$this->pager = new sfPropelPager(
		'FilmFilmTypes',
		sfConfig::get('app_pages_catalog_page', 60)
	);
	//$this->pager->setPeerMethod('doSelectJoinFilm');
	$this->pager->setPeerMethod('doSelectJoinFilmAndRaiting');
	$this->pager->setPeerCountMethod('doCountJoinFilm');
	$criteria = FilmFilmTypesPeer::addCatalogCriteria($this->film_type);
	$criteria = FilmPeer::addVisibleCriteria($criteria);
	$this->pager->setCriteria($criteria);
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->init();
	
	$response = $this->getResponse();
    $response->addMeta('keywords', sfConfig::get('app_http_keywords').', '.$this->film_type->getTitle().' жанр кино');
    $response->addMeta('description', sfConfig::get('app_http_description').' '.$this->film_type->getTitle().' жанр кино');
  }
  
  public function executeYear(sfWebRequest $request)
  {
  	$this->year = $request->getParameter('year', date("Y"));
	$this->pager = new sfPropelPager(
		'Film',
		sfConfig::get('app_pages_catalog_page', 60)
	);
	$this->pager->setCriteria(FilmPeer::getCriteriaByYear($this->year));
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->init();
	
	$response = $this->getResponse();
    $response->addMeta('keywords', sfConfig::get('app_http_keywords').', фильмы за '.$this->year);
    $response->addMeta('description', sfConfig::get('app_http_description').' фильмы за '.$this->year);
  }
}
