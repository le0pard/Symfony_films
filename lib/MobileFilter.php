<?php

class MobileFilter extends sfFilter {
  public function execute ($filterChain)
  {
    if ($this->isFirstCall()){
    	$response = $this->getContext()->getResponse();
      	$request = $this->getContext()->getRequest();
      	
      	if (!$request->getCookie('no_mobile')){
      		$response->setCookie('no_mobile', 'no', time() + 7776000, '/', '.'.sfConfig::get('app_domain'));
      	}
      	
      	if ($request->getCookie('no_mobile') == 'no' && 
      		$request->getRequestFormat() != 'mobile' && 
      		$this->isMobileUserAgents($request)){
      			
      		return $this->getContext()->getController()->redirect('@homepage_mobile');
      	} elseif($request->getRequestFormat() != 'mobile') {
      		$response->setCookie('no_mobile', 'yes', time() + 7776000, '/', '.'.sfConfig::get('app_domain'));
      	}
      	
	    switch ($request->getRequestFormat()){
	      case 'mobile':
	      	if ($request->getCookie('no_mobile') == 'yes'){
	      		return $this->getContext()->getController()->redirect('@homepage_standard');
	      	} else {	
		      	$actionInstance = $this->getContext()->getController()->getActionStack()->getLastEntry()->getActionInstance();
	            $actionInstance->setLayout('layout'); 
		        $response->setContentType('text/html');
		        $time = 3600;
		        $response->addCacheControlHttpHeader('max_age='.$time);
		        $response->addCacheControlHttpHeader('private=True');
		        $response->setHttpHeader('Expires', $response->getDate(time() + $time * 1000));
	      	}
	        break;
	    }
    }
    // Execute next filter
	$filterChain->execute();
  }
  
  protected function isMobileUserAgents($request)
  {
	$userAgent = $request->getHttpHeader('User-Agent');
	$mobileUserAgents = $this->getParameter('mobile_agents', array());
	foreach ($mobileUserAgents as $checkAgent) {
		if (false !== strpos($userAgent, $checkAgent)) {
			return true;
		}
	}
	return false;
  }
}
