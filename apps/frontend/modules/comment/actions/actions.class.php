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
  	$this->form = new CommentsForm();
  	if ($request->isMethod('post')){
  		$params = $request->getParameter('comments');
		if ('Film' == $params['comment_type_name'] && $params['comment_type_id']){
			$film = FilmPeer::retrieveByPK($params['comment_type_id']);
			if ($film){
				$this->form->bind($params);
				if ($this->form->isValid()){			
					$comment = $this->form->getObject();
					$comment->setUsers($this->getUser()->getAuthUser());
					$this->form->save();
					$this->redirect($this->generateUrl('film_show', $film));
				} else {
					$this->redirect($this->generateUrl('film_show', $film));
				}
			}
		}
	}
  }
}
