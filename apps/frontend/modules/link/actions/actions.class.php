<?php

/**
 * link actions.
 *
 * @package    symfony_films
 * @subpackage link
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class linkActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->link = $this->getRoute()->getObject();
  	if ($this->link){
  		$this->redirect($this->link->getUrl());
  	}
  }
}
