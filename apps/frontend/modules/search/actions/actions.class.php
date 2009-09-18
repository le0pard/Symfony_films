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
	if (!$query = $request->getParameter('s')) {
		return $this->forward('index', 'index');
	}
	$this->search_res = FilmPeer::getForLuceneQuery($query);
  }
  
  public function executeAuto_complete(sfWebRequest $request)
  {
	if (!$query = $request->getParameter('s')) {
		return $this->renderText("");
	}
	$this->search_res = FilmPeer::searchAutoComplete($query);
	$s_text = "<ul>";
	foreach($this->search_res as $row){
		$s_text.= "<li>".$row->getTitle()."</li>";
	}
	$s_text.= "</ul>";
	return $this->renderText($s_text);
  }
}
