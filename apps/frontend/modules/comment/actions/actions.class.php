<?php

/**
 * comment actions.
 *
 * @package    symfony_films
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class commentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAdd(sfWebRequest $request)
  {
  	$this->film = $this->getRoute()->getObject();
  	$this->form = new CommentsForm();
  	if ($request->isMethod('post')){
  		$params = $request->getParameter('comments');
		$this->form->bind($params);
		if ($this->form->isValid()){			
			$comment = $this->form->getObject();
			$comment->setUsers($this->getUser()->getAuthUser());
			$comment->setFilm($this->film);
			$this->form->save();
			$this->redirect($this->generateUrl('film_show', $this->film));
		} else {
			$this->redirect($this->generateUrl('film_show', $this->film));
		}
	}
  }
  
  public function executeEdit(sfWebRequest $request)
  {
  	$this->comment = $this->getRoute()->getObject();
  	$this->form = new CommentsForm($this->comment);
  	if ($request->isMethod('post')){
  		$params = $request->getParameter('comments');
		$this->form->bind($params);
		if ($this->form->isValid()){			
			$this->form->save();
			$this->redirect($this->generateUrl('film_show', $this->form->getObject()->getFilm()));
		} else {
			$this->redirect($this->generateUrl('film_show', $this->form->getObject()->getFilm()));
		}
	}
  }
  
  public function executeDelete(sfWebRequest $request)
  {
  	$this->comment = $this->getRoute()->getObject();
  	$film = $this->comment->getFilm();
	if ($film){
		$this->comment->delete();
		$this->redirect($this->generateUrl('film_show', $film));
	}
  }
}
