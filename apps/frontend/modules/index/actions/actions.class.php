<?php

/**
 * index actions.
 *
 * @package    symfony_films
 * @subpackage index
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class indexActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  
  public function executeSitemap(sfWebRequest $request)
  {
  	$c = new Criteria();
	$c->setLimit(sfConfig::get('app_sitemap_limit', 1000));
    $this->films = FilmPeer::getVisible($c);
	$c = new Criteria();
	$c->setLimit(sfConfig::get('app_sitemap_limit', 1000));
	$this->static_pages = StaticPagesPeer::doSelectVisible($c);
  }
  
  public function executeError404(sfWebRequest $request)
  {
	
  }
  
  public function executeBanned(sfWebRequest $request)
  {
  	$this->banned = BannedIpsPeer::getByIp($request->getHttpHeader('addr','remote'));
  	$this->forward404Unless($this->banned);
  	
	$this->setLayout(false);
  }
}
