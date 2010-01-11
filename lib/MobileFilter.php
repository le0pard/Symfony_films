<?php

class MobileFilter extends sfFilter {
  public function execute ($filterChain)
  {
    if ($this->isFirstCall()){
	    switch ($this->getContext()->getRequest()->getRequestFormat()){
	      case 'mobile':
	      	$actionInstance = $this->getContext()->getController()->getActionStack()->getLastEntry()->getActionInstance();
            $actionInstance->setLayout('layout'); 
	        $this->getContext()->getResponse()->setContentType('text/html');
	        break;
	    }
    }
    // Execute next filter
	$filterChain->execute();
  }
}
