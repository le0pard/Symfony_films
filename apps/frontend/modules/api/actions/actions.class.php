<?php

/**
 * api actions.
 *
 * @package    symfony_films
 * @subpackage api
 * @author     leopard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAfisha_theaters(sfWebRequest $request)
  {
    if ($request->hasParameter('token') && $request->hasParameter('city_id') && $request->getParameter('token') == sfConfig::get('app_api_secret_token', 'secret_token')){
	    $this->selected_city = AfishaCityPeer::retrieveByPK($request->getParameter('city_id'));
	    $this->forward404Unless($this->selected_city);
	        
	    $this->afisha_cinemas = AfishaTheaterPeer::getByCityId($this->selected_city->getId());
    } else {
    	return $this->forward404(sprintf('Not valid "%s" token.', $request->getParameter('token'))); 
    }
  }
  
  
  public function executeAfisha_cinemas(sfWebRequest $request)
  {
    if ($request->hasParameter('token') && $request->hasParameter('city_id') && $request->getParameter('token') == sfConfig::get('app_api_secret_token', 'secret_token')){
      $this->selected_city = AfishaCityPeer::retrieveByPK($request->getParameter('city_id'));
      $this->forward404Unless($this->selected_city);

      $selected_day = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
      //$two_days_day = date('c', $selected_day + 2*86400);
      $this->afisha_cinemas = AfishaPeer::getByDateRangeAndCity($selected_day, $selected_day, $this->selected_city->getId());
    } else {
      return $this->forward404(sprintf('Not valid "%s" token.', $request->getParameter('token'))); 
    }
  }
}
