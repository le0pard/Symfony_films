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
    
  public function executeShow(sfWebRequest $request)
  {
    $this->user_data = $this->getRoute()->getObject();
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
			$user->setIsActive(false);
			$persistan_token = System::generateRandomKey();
			$user->setPersistenceToken($persistan_token);
			
			
			if ($user->save()){
				//send email
				$message = $this->getMailer()->compose(
				      array(sfConfig::get('app_support_email') => sfConfig::get('app_support_title')),
				      $user->getEmail(),
				      'Пользователь успешно зарегестрирован',
<<<EOF
Пользователь успешно зарегестрирован.
				 
Для активации своего акаунта перейдите по ссылке {$this->generateUrl('user_activate', $user, true)}.
				 
Coocoorooza Bot.
EOF
);
				 
				    $this->getMailer()->send($message);
				
				
				//verlihub begin
				if (sfConfig::get('app_integration_is_verlihub')){
					$verli_config = sfConfig::get('app_integration_verlihub_config');
					$verl_hub = new VerlihubMysql(
						$verli_config['host'],
						$verli_config['user'],
						$verli_config['password'],
						$verli_config['database']
					);
					$verl_hub->register_user($user->getLogin(), $values['password']);
				}
				//verlihub end
				//jabber begin
				if (sfConfig::get('app_integration_is_jabber')){
					JabberOpenfire::add_user($user->getLogin(), $values['password'], $user->getEmail());
				}
				//jabber end
				$this->redirect('@user_registration_done');
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
  
  public function executeRegistration_done(sfWebRequest $request){
  	
  }
  
  public function executeActivate(sfWebRequest $request){
  	if ($request->getParameter('persistence_token')){
  		$user = $this->getRoute()->getObject();
  		if ($user && $user->getPersistenceToken()){
  			$user->setPersistenceToken("");
  			$user->setIsActive(true);
  			if ($user->save()){
  				$this->getUser()->setFlash('confirm', 'Активация прошла успешно. Теперь можете входить на сайт.');
  			}
  		}
  	}
  	$this->redirect('@user_login');
  }
  
  public function executeProfile(sfWebRequest $request){
  	$this->user_data = $this->getUser()->getAuthUser();
  	$this->form = new ProfileForm($this->user_data);
  	$this->change_pass_form = new ChangePasswordForm();
  	
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('profile'), $request->getFiles('profile'));
		if ($this->form->isValid()){
			$values = $this->form->getValues();
			$this->form->save();
			$this->getUser()->setFlash('confirm', 'Профиль обновлен.');
			$this->redirect('@user_profile');			
		}
	}
  }
  
  public function executeChange_password(sfWebRequest $request){
  	$this->user_data = $this->getUser()->getAuthUser();
  	$this->form = new ProfileForm($this->user_data);
  	$this->change_pass_form = new ChangePasswordForm();
  	
  	if ($request->isMethod('post')){
  		$this->change_pass_form->bind($request->getParameter('change_password'), $request->getFiles('change_password'));
		if ($this->change_pass_form->isValid()){
			$values = $this->change_pass_form->getValues();
			
			if (md5($values['old_password']) == $this->user_data->getPassword()){
				$this->user_data->setPassword($values['password']);
				$this->user_data->save();
				//verlihub begin
				if (sfConfig::get('app_integration_is_verlihub') && $values['verlihub_change'] == 1){
					$verli_config = sfConfig::get('app_integration_verlihub_config');
					$verl_hub = new VerlihubMysql(
						$verli_config['host'],
						$verli_config['user'],
						$verli_config['password'],
						$verli_config['database']
					);
					$verl_hub->change_password_for_user($this->user_data->getLogin(), $values['password']);
				}
				//verlihub end
				//jabber begin
				if (sfConfig::get('app_integration_is_jabber') && $values['jabber_change'] == 1){
					JabberOpenfire::edit_user($this->user_data->getLogin(), $values['password'], $this->user_data->getEmail());
				}
				//jabber end

				$this->getUser()->setFlash('confirm', 'Пароль изменен.');
			} else {
				$this->getUser()->setFlash('error', 'Старый пароль неверный.');
			}
			
			$this->redirect('@user_profile');
		}
  	}
  	$this->setTemplate('profile');
  }
  
  public function executeForgot_pass(sfWebRequest $request){
  	
  	$this->form = new ForgotPassForm();
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('forgot_pass'));
		if ($this->form->isValid()){
			$values = $this->form->getValues();
			$data = UsersPeer::getUserByEmail($values['email']);
			if ($data){
				$persistan_token = System::generateRandomKey();
				$data->setPersistenceToken($persistan_token);
				if ($data->save()){
				//send email
				$message = $this->getMailer()->compose(
				      array(sfConfig::get('app_support_email') => sfConfig::get('app_support_title')),
				      $data->getEmail(),
				      'Запрос на изменение пароля',
<<<EOF
Сброс пароля по ссылке {$this->generateUrl('user_forgot_pass_token', $data, true)}.
				 
Coocoorooza Bot.
EOF
);
				 
				    $this->getMailer()->send($message);
				}	    	
			}
			$this->getUser()->setFlash('confirm', 'На ваш email выслано письмо для смены пароля.');
			$this->redirect('@user_forgot_pass');
		}
	}
  }
  
  public function executeForgot_pass_token(sfWebRequest $request){
  	$this->user = $this->getRoute()->getObject();
  	if ($this->user && $this->user->getPersistenceToken()){
  		$this->form = new ForgotPassTokenForm();
  		if ($request->isMethod('post')){
  			$this->form->bind($request->getParameter('forgot_pass'));
  			if ($this->form->isValid()){
				$values = $this->form->getValues();
				$this->user->setPersistenceToken("");
				$this->user->setPassword($values['password']);
				$this->user->save();
				//verlihub begin
				if (sfConfig::get('app_integration_is_verlihub')){
					$verli_config = sfConfig::get('app_integration_verlihub_config');
					$verl_hub = new VerlihubMysql(
						$verli_config['host'],
						$verli_config['user'],
						$verli_config['password'],
						$verli_config['database']
					);
					$verl_hub->change_password_for_user($this->user->getLogin(), $values['password']);
				}
				//verlihub end
				//jabber begin
				if (sfConfig::get('app_integration_is_jabber')){
					JabberOpenfire::edit_user($this->user->getLogin(), $values['password'], $this->user->getEmail());
				}
				//jabber end
				$this->getUser()->setFlash('confirm', 'Новый пароль задан.');
				$this->redirect('@user_login');
  			}
  		}
  	} else {
  		$this->redirect('@homepage');
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
