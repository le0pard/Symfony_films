<?php

class BannedFilter extends sfFilter {
  public function execute ($filterChain)
  {
    if ($this->isFirstCall()){
    	$request = $this->getContext()->getRequest();
    	if (BannedIpsPeer::isBannedByIp($request->getHttpHeader('addr','remote'))){
      		return $this->getContext()->getController()->forward('index', 'banned');
    	} else {
    		// Execute next filter
			$filterChain->execute();
    	}
    } else {
    	// Execute next filter
		$filterChain->execute();
    }
  }
}
