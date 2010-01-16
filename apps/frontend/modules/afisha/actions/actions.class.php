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
  	$this->days_of_week = array("Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Сбт");
  	 
  	if ($request->hasParameter('id') && $request->hasParameter('year') && $request->hasParameter('month') && $request->hasParameter('day')){
  		$this->city = AfishaCityPeer::retrieveByPK($request->getParameter('id'));
  		$this->forward404Unless($this->city);
  	} elseif ($request->hasParameter('id')){	
  		$this->city = $this->getRoute()->getObject();
  	} else {
  		$this->city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
  	}
  	
  	$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  	$this->date_today = array('y' => date('Y',$today), 'm' => date('m',$today), 'd' => date('d',$today), 't' => date('c', $today));
  	$week_day = date("w");
  	$first_day = $today - 7*86400;
  	$last_day = $today + 7*86400;
	$this->date_range = $this->createDateRangeArray($first_day, $last_day);
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
  
  protected function createDateRangeArray($iDateFrom, $iDateTo) {
	  $aryRange=array();
	
	  if ($iDateTo>=$iDateFrom) {
	    array_push($aryRange,array('y' => date('Y',$iDateFrom), 'm' => date('m',$iDateFrom), 'd' => date('d',$iDateFrom), 't' => date('c', $iDateFrom)));
	
	    while ($iDateFrom<$iDateTo) {
	      $iDateFrom+=86400; // add 24 hours
	      array_push($aryRange,array('y' => date('Y',$iDateFrom), 'm' => date('m',$iDateFrom), 'd' => date('d',$iDateFrom), 't' => date('c', $iDateFrom)));
	    }
	  }
	  return $aryRange;
  }

}
