<?php

/**
 * search actions.
 *
 * @package    symfony_films
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class searchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
	if (!$query = $request->getParameter('s')) {
		return $this->forward('index', 'index');
	}
	$this->search_res = FilmPeer::getForLuceneQuery($query);
  }
}
