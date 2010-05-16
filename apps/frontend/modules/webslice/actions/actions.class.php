<?php

/**
 * webslice actions.
 *
 * @package    symfony_films
 * @subpackage webslice
 * @author     leopard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class websliceActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
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
        40
      );
      $this->pager->setPeerMethod('doSelect');
      $this->pager->setCriteria(AfishaPeer::getCriteriaForTodayMobile($this->selected_city));
      $this->pager->setPage($request->getParameter('page', 1));
      $this->pager->init();
      $this->selected_country = $this->selected_city->getAfishaCountry();
    }
    $this->setLayout(false);
  }
}
