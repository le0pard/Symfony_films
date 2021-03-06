<?php

class sfSecurityFilmsUser extends sfBasicSecurityUser
{
	protected $user = null;
	
	public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array()){
	    parent::initialize($dispatcher, $storage, $options);
	    if (!$this->isAuthenticated()){
	      // remove user if timeout
	      $this->getAttributeHolder()->removeNamespace('sfFilmAutorizedUser');
	      $this->user = null;
	    }
    }
	
	public function isAnonymous() {
    	return !$this->isAuthenticated();
    }
	
	public function signIn($user, $remember = true, $con = null){
    // signin
    $this->setAttribute('user_id', $user->getId(), 'sfFilmAutorizedUser');
    $this->setAuthenticated(true);
    $this->clearCredentials();
	
	//set credintials
	$this->addCredentials($user->getAllPermissionNames());
    // save last login
    $user->setLastLogin(time());
    $user->save($con);
    // remember?
    if ($remember) {
      // remove old keys
      $c = new Criteria();
      $expiration_age = sfConfig::get('app_user_remember_key_expiration_age', 15 * 24 * 3600);
      $c->add(UsersRememberKeyPeer::CREATED_AT, time() - $expiration_age, Criteria::LESS_THAN);
      UsersRememberKeyPeer::doDelete($c);

      // remove other keys from this user
      $c = new Criteria();
      $c->add(UsersRememberKeyPeer::USER_ID, $user->getId());
      UsersRememberKeyPeer::doDelete($c);

      // generate new keys
      $key = System::generateRandomKey();

      // save key
      $rk = new UsersRememberKey();
      $rk->setRememberKey($key);
      $rk->setUserId($user->getId());
      $rk->setIpAddress($_SERVER['REMOTE_ADDR']);
      $rk->save($con);

      // make key as a cookie
      $remember_cookie = sfConfig::get('app_remember_cookie_name', 'sfRemember');
      sfContext::getInstance()->getResponse()->setCookie($remember_cookie, $key, time() + $expiration_age);
    }
  }

  public function signOut()
  {
    $this->getAttributeHolder()->removeNamespace('sfFilmAutorizedUser');
    $this->user = null;
    $this->clearCredentials();
    $this->setAuthenticated(false);
    $expiration_age = sfConfig::get('app_user_remember_key_expiration_age', 15 * 24 * 3600);
    $remember_cookie = sfConfig::get('app_remember_cookie_name', 'sfRemember');
    sfContext::getInstance()->getResponse()->setCookie($remember_cookie, '', time() - $expiration_age);
  }
  
  public function getAuthUser() {
    if (!$this->user && $id = $this->getAttribute('user_id', null, 'sfFilmAutorizedUser')){
      $this->user = UsersPeer::retrieveByPk($id);
      if (!$this->user) {
        // the user does not exist anymore in the database
        $this->signOut();
        throw new sfException('The user does not exist anymore in the database.');
      }
    }
    return $this->user;
  }
}
