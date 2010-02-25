<?php

/**
 * news actions.
 *
 * @package    symfony_films
 * @subpackage news
 * @author     leopard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->pager = new sfPropelPager(
		'News',
		sfConfig::get('app_pages_news', 50)
	);
	$this->pager->setCriteria(NewsPeer::addVisibleCriteria());
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->init();
	
	$response = $this->getResponse();
    $response->addMeta('keywords', sfConfig::get('app_http_keywords').', новости');
    $response->addMeta('description', sfConfig::get('app_http_description').' Новости');
  }
  
  public function executeShow(sfWebRequest $request)
  {
  	$this->news = $this->getRoute()->getObject();
  	
  	$response = $this->getResponse();
    $response->addMeta('keywords', sfConfig::get('app_http_keywords').', новости, '.$this->news->getTitle());
    $response->addMeta('description', sfConfig::get('app_http_description').' '.$this->news->getTitle());
  }
}
