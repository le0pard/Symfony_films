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
	if (!$this->query = $request->getParameter('s')) {
		$this->redirect($this->generateUrl('@homepage'));
	}
	
	if ('sphinx' == sfConfig::get('app_search_method')){
		$this->page = $this->getRequestParameter('page', 1);
		$options = array(
			'limit'   => sfConfig::get('app_search_limit', 50),
			'offset'  => ($this->page - 1) * sfConfig::get('app_search_limit', 50),
			'weights' => array(100, 1),
			'sort'    => sfSphinxClient::SPH_SORT_EXTENDED,
			'sortby'  => '@weight DESC',
		);
		try {
			$this->sphinx = new sfSphinxClient($options);
			 $res = $this->sphinx->Query($this->query, 'main');
		    $this->pager = new sfSphinxPager('Film', $options['limit'], $this->sphinx);
		    $this->pager->setPage($this->page);
		    $this->pager->setPeerMethod('retrieveByPKs');
		    $this->pager->init();
		    $this->logMessage('Sphinx search "' . $this->query . '" [' . $res['time'] .
		                      's] found ' . $this->pager->getNbResults() . ' matches');
		} catch (Exception $e) {
			$this->search_res = FilmPeer::getForLuceneQuery($this->query);
		}
	   
	} else {
		$this->search_res = FilmPeer::getForLuceneQuery($this->query);
	}
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
