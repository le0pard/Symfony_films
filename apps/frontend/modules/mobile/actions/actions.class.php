<?php

/**
 * mobile actions.
 *
 * @package    symfony_films
 * @subpackage mobile
 * @author     leopard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mobileActions extends sfActions
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
		sfConfig::get('app_pages_mobile_films')
	);
	$this->pager->setPeerMethod('doSelectJoinRaiting');
	$this->pager->setCriteria(FilmPeer::addVisibleCriteria());
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->init();	
  }
  
  public function executeFilm(sfWebRequest $request)
  {
  	$this->film = FilmPeer::retrieveByPK($request->getParameter('id'));
  	$this->forward404Unless($this->film);
  	
  	$this->next_film = $this->film->getNextFilm();
  	$this->prev_film = $this->film->getPrevFilm();
  }
  
  public function executeAfisha(sfWebRequest $request)
  {
  	if ($request->hasParameter('city_id')){
  		
  	} else {
  		$this->selected_city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
  	}
	if ($this->selected_city){
		$this->pager = new sfPropelPager(
			'AfishaFilm',
			sfConfig::get('app_pages_mobile_afisha')
		);
		$this->pager->setPeerMethod('doSelect');
		$this->pager->setCriteria(AfishaPeer::getCriteriaForTodayMobile($this->selected_city));
		$this->pager->setPage($request->getParameter('page', 1));
		$this->pager->init();
		$this->selected_country = $this->selected_city->getAfishaCountry();
	}
  }
  
  public function executeAfisha_film(sfWebRequest $request)
  {
  	$this->film = AfishaFilmPeer::retrieveByPK($request->getParameter('id'));
  	$this->forward404Unless($this->film);
  }
  
  public function executeFilm_poster(sfWebRequest $request)
  {
    $this->film = FilmPeer::retrieveByPK($request->getParameter('id'));
  	$this->forward404Unless($this->film);
  	
  	if (($poster = $this->film->getThumbLogo()) == true){
  		
  		$img = new sfImage(sfConfig::get('sf_upload_dir').'/posters/'.$poster);
		$response = $this->getResponse();
		$response->setContentType($img->getMIMEType());    
		$img->thumbnail(120,120);
		$img->setQuality(85);
		$response->setContent($img); 
  	}
  	return sfView::NONE;
  }
}
