<?php

class MobileFilter extends sfFilter {
  public function execute ($filterChain)
  {
    if ($this->isFirstCall()){
	    switch ($this->getContext()->getRequest()->getRequestFormat()){
	      case 'mobile':
	      	$actionInstance = $this->getContext()->getController()->getActionStack()->getLastEntry()->getActionInstance();
            $actionInstance->setLayout('layout'); 
            $response = $this->getContext()->getResponse();
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
}
