<?php


class sfSwfSession extends sfCacheSessionStorage
{
	public function initialize($options = array())
  {
  	$context = sfContext::getInstance();
  	if ($context->getRequest()->getParameter('module') == 'film' && $context->getRequest()->getParameter('action') == 'add_swf_step2'){
	    if ($cookie = $context->getRequest()->getParameter('filmUserSession')) {
	      $expiration_age = sfConfig::get('app_user_remember_key_expiration_age', 15 * 24 * 3600);
	      $context->getResponse()->setCookie('filmUserSession', $cookie, time() + $expiration_age);
	    }
  	}
 
    parent::initialize($options);
  }
	
}