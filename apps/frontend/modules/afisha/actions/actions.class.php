<?php

/**
 * afisha actions.
 *
 * @package    symfony_films
 * @subpackage afisha
 * @author     leopard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class afishaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	 
  	if ($request->hasParameter('id') && $request->hasParameter('year') && $request->hasParameter('month') && $request->hasParameter('day')){
  		$this->city = AfishaCityPeer::retrieveByPK($request->getParameter('id'));
  		$this->forward404Unless($this->city);
  	} elseif ($request->hasParameter('id')){	
  		$this->city = $this->getRoute()->getObject();
  	} else {
  		$this->city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
  		$this->forward404Unless($this->city);
  	}
  	
  	$this->getAllDates($request);
	
	$this->afisha = AfishaPeer::getByDateRangeAndCity($this->selected_day['t'], $this->selected_day['t'], $this->city->getId());
	
  }
  
  public function executeGet_cities(sfWebRequest $request)
  {
	if ($this->getRequest()->isXmlHttpRequest()){
		$country = $this->getRoute()->getObject();
		$selecter = '<select id="afisha_city">';
		$selecter_options = '<option value="">** Выберите город **</option>';
		foreach($country->getCities() as $city){
			$selecter_options .= '<option value="'.$city->getId().'">'.$city->getTitle().'</option>';
		}
		$selecter .= $selecter_options.'</select>';
		return $this->renderText($selecter);
	} else {
		return $this->renderText("");
	}
  }
  
  public function executeCinema(sfWebRequest $request){
  	
  	if ($request->hasParameter('id') && $request->hasParameter('year') && $request->hasParameter('month') && $request->hasParameter('day')){
  		$this->cinema = AfishaTheaterPeer::retrieveByPK($request->getParameter('id'));
  		$this->forward404Unless($this->cinema);
  	} elseif ($request->hasParameter('id')){	
  		$this->cinema = $this->getRoute()->getObject();
  	}
  	
  	$this->getAllDates($request);
  	
  	$this->afisha = AfishaPeer::getByDateRangeAndCinema($this->selected_day['t'], $this->selected_day['t'], $this->cinema->getId());
  }
  
  public function executeFilm(sfWebRequest $request){
  	
  	if ($request->hasParameter('id') && $request->hasParameter('year') && $request->hasParameter('month') && $request->hasParameter('day')){
  		$this->film = AfishaFilmPeer::retrieveByPK($request->getParameter('id'));
  		$this->forward404Unless($this->film);
  	} elseif ($request->hasParameter('id')){	
  		$this->film = $this->getRoute()->getObject();
  	}
  	
  	if ($request->hasParameter('city_id')){
  		$this->city = AfishaCityPeer::retrieveByPK($request->getParameter('city_id'));
  		$this->forward404Unless($this->city);
  	} else {
  		$this->city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
  	}

	$this->getAllDates($request);
  	
  	$this->afisha = AfishaPeer::getByDateRangeAndFilm($this->selected_day['t'], $this->selected_day['t'], $this->film->getId(), $this->city->getId());
  }
  
  public function executeFilms_today_ajax(sfWebRequest $request){
  	if (!$city_id = $request->getParameter('city_id')) {
		return $this->renderText("");
	}
	$selected_city = AfishaCityPeer::retrieveByPK($request->getParameter('city_id'));
  	$this->forward404Unless($selected_city);
	$afisha_films = AfishaPeer::getForTodayFilms($selected_city);
	$selected_country = $selected_city->getAfishaCountry();
	return $this->renderPartial('afisha/today_films_li', array('selected_country' => $selected_country, 'selected_city' => $selected_city, 'afisha_films' => $afisha_films));
  }
  
  protected function getAllDates(sfWebRequest $request) {
	if ($request->hasParameter('year') && $request->hasParameter('month') && $request->hasParameter('day')){
		$selected_day = mktime(0, 0, 0, $request->getParameter('month'), $request->getParameter('day'), $request->getParameter('year'));
		$this->selected_day = array('y' => date('Y',$selected_day), 'm' => date('m',$selected_day), 'd' => date('d',$selected_day), 't' => date('c', $selected_day), 'w' => date('w', $selected_day));
	} else {
		$selected_day = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  		$this->selected_day = array('y' => date('Y',$selected_day), 'm' => date('m',$selected_day), 'd' => date('d',$selected_day), 't' => date('c', $selected_day), 'w' => date('w', $selected_day));
	}
  }

}
