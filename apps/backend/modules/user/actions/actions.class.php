<?php

/**
 * user actions.
 *
 * @package    symfony_films
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  public function executeLogin(sfWebRequest $request)
  {
  	$this->form = new LoginForm();
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('login'));
		if ($this->form->isValid()){
			$values = $this->form->getValues();
			$data = UsersPeer::getActiveUser($values['login'], $values['password']);
			if ($data){
				$this->getUser()->signIn($data, $values['not_remember'] ? false : true);
				$this->getUser()->setFlash('confirm', sprintf('Добро пожаловать %s.', $data->getLogin()));
				$this->redirect('@homepage');
			} else {
				$this->getUser()->setFlash('error', 'Неверный логин или пароль', false);
			}
		}
	}
  }
  
  public function executeLogout(sfWebRequest $request)
  {
  	if ($this->getUser()->isAuthenticated()){
  		$this->getUser()->signOut();
		$this->getUser()->setFlash('confirm', "До скорой встречи!");
  	}
	
  	$this->redirect('@homepage');
  }
  
  public function executeSecure(){
    $this->getResponse()->setStatusCode(403);
  }
}
