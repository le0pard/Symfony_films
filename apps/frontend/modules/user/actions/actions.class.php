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
  
  public function executeRegistration(sfWebRequest $request){
  	$this->form = new RegistrationForm();
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('registration'));
		if ($this->form->isValid()){
			$values = $this->form->getValues();
			$user = new Users();
			$user->setLogin($values['login']);
			$user->setEmail($values['email']);
			$user->setPassword($values['password']);
			if ($user->save()){
				$this->getUser()->setFlash('confirm', 'Регистрация прошла успешно. Теперь можете входить на сайт.');
				$this->redirect('@user_login');
			} else {
				$this->getUser()->setFlash('error', 'Произошла непредвиденная ошибка.', false);
			}
			
		}
	}
  }
  
  public function executeAjax_registration(sfWebRequest $request){
  	if ($request->isXmlHttpRequest()){
		$output = Array();
		if ($request->getParameter('login')){
			$cr = new Criteria();
			$cr->add(UsersPeer::LOGIN, $request->getParameter('login'));
        	$user_count = UsersPeer::doCount($cr);
			if ($user_count > 0){
				$output['error'] = 'Логин занят';
			} else {
				$output['notice'] = 'Логин свободен';
			}
		}
		if ($request->getParameter('email')){
			$cr = new Criteria();
			$cr->add(UsersPeer::EMAIL, $request->getParameter('email'));
        	$user_count = UsersPeer::doCount($cr);
			if ($user_count > 0){
				$output['error'] = 'E-mail занят';
			} else {
				$output['notice'] = 'E-mail свободен';
			}
		}
		$this->getResponse()->setHttpHeader('Content-Type','application/json;charset=utf-8');
        return $this->renderText(json_encode($output));
	}
  }
  
  public function executeProfile(sfWebRequest $request){
  	$this->user_data = $this->getUser()->getAuthUser();
  	$this->form = new ProfileForm($this->user_data);
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('profile'), $request->getFiles('profile'));
		if ($this->form->isValid()){
			$this->form->save();
			$this->getUser()->setFlash('confirm', 'Профиль обновлен.');
			$this->redirect('@user_profile');			
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
  
  public function executeUnpublic_films(sfWebRequest $request)
  {
	$this->user_data = $this->getUser()->getAuthUser();
	$this->film_list = $this->user_data->getUnpublicFilms();
  }
  
  public function executeSecure(){
    $this->getResponse()->setStatusCode(403);
  }
}