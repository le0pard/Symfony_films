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
  	
  	if ($this->film->getIsVisible() && $this->film->getIsPublic()){
  		$this->next_film = $this->film->getNextFilm();
  		$this->prev_film = $this->film->getPrevFilm();
  	} else {
  		$this->redirect('@homepage_mobile');
  	}
  }
  
  public function executeAfisha(sfWebRequest $request)
  {
  	if ($request->hasParameter('city_id')){
  		$this->selected_city = AfishaCityPeer::retrieveByPK($request->getParameter('city_id'));
  		$this->forward404Unless($this->selected_city);
  		$this->city_id_params = $this->selected_city->getId();
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
  	
  	if ($request->hasParameter('city_id')){
  		$this->selected_city = AfishaCityPeer::retrieveByPK($request->getParameter('city_id'));
  		$this->forward404Unless($this->selected_city);
  		$this->city_id_params = $this->selected_city->getId();
  	} else {
  		$this->selected_city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
  	}
  	
  	$this->selected_country = $this->selected_city->getAfishaCountry();
  	
	$selected_day = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  	$this->selected_day = date('c', $selected_day);
  	$this->yesterday_day = date('c', $selected_day - 86400);
  	$this->tomorrow_day = date('c', $selected_day + 86400);
  	$this->two_days_day = date('c', $selected_day + 2*86400);
	
	$this->afisha_today = AfishaPeer::getByDateRangeAndFilm($this->selected_day, $this->selected_day, $this->film->getId(), $this->selected_city->getId());
	$this->afisha_yesterday = AfishaPeer::getByDateRangeAndFilm($this->yesterday_day, $this->yesterday_day, $this->film->getId(), $this->selected_city->getId());
	$this->afisha_tomorrow = AfishaPeer::getByDateRangeAndFilm($this->tomorrow_day, $this->tomorrow_day, $this->film->getId(), $this->selected_city->getId());
	$this->afisha_2days = AfishaPeer::getByDateRangeAndFilm($this->two_days_day, $this->two_days_day, $this->film->getId(), $this->selected_city->getId());
  }
  
  public function executeAfisha_cinema(sfWebRequest $request)
  {
  	$this->cinema = AfishaTheaterPeer::retrieveByPK($request->getParameter('id'));
  	$this->forward404Unless($this->cinema);
	$this->selected_city = $this->cinema->getAfishaCity();
  	$this->forward404Unless($this->selected_city);
  	$this->city_id_params = $this->selected_city->getId();
  	
  	$selected_day = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  	$this->selected_day = date('c', $selected_day);
  	$this->yesterday_day = date('c', $selected_day - 86400);
  	$this->tomorrow_day = date('c', $selected_day + 86400);
  	$this->two_days_day = date('c', $selected_day + 2*86400);
  	
  	$this->afisha_today = AfishaPeer::getByDateRangeAndCinema($this->selected_day, $this->selected_day, $this->cinema->getId());
	$this->afisha_yesterday = AfishaPeer::getByDateRangeAndCinema($this->yesterday_day, $this->yesterday_day, $this->cinema->getId());
	$this->afisha_tomorrow = AfishaPeer::getByDateRangeAndCinema($this->tomorrow_day, $this->tomorrow_day, $this->cinema->getId());
	$this->afisha_2days = AfishaPeer::getByDateRangeAndCinema($this->two_days_day, $this->two_days_day, $this->cinema->getId());
  }
  
  public function executeAfisha_cinemas(sfWebRequest $request)
  {
  	if ($request->isMethod('post') && $request->hasParameter('change_city_id')){
  		$selected_city = AfishaCityPeer::retrieveByPK($request->getParameter('change_city_id'));
  		$this->forward404Unless($selected_city);
  		$this->redirect('@mobile_afisha_cinemas?city_id='.$selected_city->getId());
  	}
  	
  	if ($request->hasParameter('city_id')){
  		$this->selected_city = AfishaCityPeer::retrieveByPK($request->getParameter('city_id'));
  		$this->forward404Unless($this->selected_city);
  		$this->city_id_params = $this->selected_city->getId();
  	} else {
  		$this->selected_city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
  	}
  	
  	$this->selected_country = $this->selected_city->getAfishaCountry();
  	$this->afisha_cinemas = AfishaTheaterPeer::getByCityId($this->selected_city->getId());
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
  
  public function executeGo_to_standart(sfWebRequest $request)
  {
  	$this->getResponse()->setCookie('no_mobile', true, time() + 7776000, '/', '.'.sfConfig::get('app_domain'));
  	$this->redirect('@homepage_standard');
  }
  
  public function executeGo_to_mobile(sfWebRequest $request)
  {
  	$this->getResponse()->setCookie('no_mobile', false, time() + 7776000, '/', '.'.sfConfig::get('app_domain'));
  	$this->redirect('@homepage_mobile');
  }
}
