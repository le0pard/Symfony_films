<?php

class MobileFilter extends sfFilter {
  public function execute ($filterChain)
  {
    if ($this->isFirstCall()){
    	$response = $this->getContext()->getResponse();
      	$request = $this->getContext()->getRequest();
      	
	    switch ($request->getRequestFormat()){
	      case 'mobile':
	      	$actionInstance = $this->getContext()->getController()->getActionStack()->getLastEntry()->getActionInstance();
            $actionInstance->setLayout('layout'); 
	        $response->setContentType('text/html');
	        $time = 3600;
	        $response->addCacheControlHttpHeader('max_age='.$time);
	        $response->addCacheControlHttpHeader('private=True');
	        $response->setHttpHeader('Expires', $response->getDate(time() + $time * 1000));
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
