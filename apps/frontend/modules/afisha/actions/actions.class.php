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
  	}
  	
  	$this->getAllDates($request);
	
	$this->afisha = AfishaPeer::getByDateRangeAndCity($this->selected_day['t'], $this->selected_day['t'], $this->city->getId());
	
  }
  
  public function executeGet_cities(sfWebRequest $request)
  {
	if ($this->getRequest()->isXmlHttpRequest()){
		$country = $this->getRoute()->getObject();
		$selecter = '<select id="afisha_city">';
		$selecter_options = '<option value="">-- Выберите город --</option>';
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

	$this->getAllDates($request);
  	
  	$this->afisha = AfishaPeer::getByDateRangeAndFilm($this->selected_day['t'], $this->selected_day['t'], $this->film->getId());
  }
  
  protected function getAllDates(sfWebRequest $request) {
  	$this->days_of_week = array("Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Сбт");
  	
    $today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  	$this->date_today = array('y' => date('Y',$today), 'm' => date('m',$today), 'd' => date('d',$today), 't' => date('c', $today), 'w' => date('w', $today));
  	
  	$first_day = $today - 7*86400;
  	$last_day = $today + 7*86400;
	$this->date_range = $this->createDateRangeArray($first_day, $last_day);
	
	if ($request->hasParameter('year') && $request->hasParameter('month') && $request->hasParameter('day')){
		$selected_day = mktime(0, 0, 0, $request->getParameter('month'), $request->getParameter('day'), $request->getParameter('year'));
		$this->selected_day = array('y' => date('Y',$selected_day), 'm' => date('m',$selected_day), 'd' => date('d',$selected_day), 't' => date('c', $selected_day), 'w' => date('w', $selected_day));
	} else {
		$selected_day = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  		$this->selected_day = array('y' => date('Y',$selected_day), 'm' => date('m',$selected_day), 'd' => date('d',$selected_day), 't' => date('c', $selected_day), 'w' => date('w', $selected_day));
	}
  }
  
  protected function createDateRangeArray($iDateFrom, $iDateTo) {
	  $aryRange=array();
	
	  if ($iDateTo>=$iDateFrom) {
	    array_push($aryRange,array('y' => date('Y',$iDateFrom), 'm' => date('m',$iDateFrom), 'd' => date('d',$iDateFrom), 't' => date('c', $iDateFrom), 'w' => date('w', $iDateFrom)));
	
	    while ($iDateFrom<$iDateTo) {
	      $iDateFrom+=86400; // add 24 hours
	      array_push($aryRange,array('y' => date('Y',$iDateFrom), 'm' => date('m',$iDateFrom), 'd' => date('d',$iDateFrom), 't' => date('c', $iDateFrom), 'w' => date('w', $iDateFrom)));
	    }
	  }
	  return $aryRange;
  }

}
