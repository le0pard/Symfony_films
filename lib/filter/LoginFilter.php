<?php

class LoginFilter extends sfFilter {
  public function execute ($filterChain)
  {
    if ($this->isFirstCall()){
      if (!$this->getContext()->getUser()->isAuthenticated()){
	      if ($cookie = $this->getContext()->getRequest()->getCookie(sfConfig::get('app_remember_cookie_name', 'sfRemember'))){
	        $c = new Criteria();
	        $c->add(UsersRememberKeyPeer::REMEMBER_KEY, $cookie);
	        $rk = UsersRememberKeyPeer::doSelectOne($c);
	        if ($rk && $rk->getUsers()){
	          $this->getContext()->getUser()->signIn($rk->getUsers());
	        }
	      }
	  }
    }
    // Execute next filter
	$filterChain->execute();
  }
}
