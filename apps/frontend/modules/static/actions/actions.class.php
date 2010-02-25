<?php

/**
 * static actions.
 *
 * @package    symfony_films
 * @subpackage static
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class staticActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->static_page = $this->getRoute()->getObject();
    
    $response = $this->getResponse();
    $response->addMeta('keywords', sfConfig::get('app_http_keywords').', '.$this->static_page->getTitle());
    $response->addMeta('description', sfConfig::get('app_http_description').' '.$this->static_page->getTitle());
  }
}
