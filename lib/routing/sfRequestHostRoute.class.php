<?php 

class sfRequestHostRoute extends sfRequestRoute
{
	public function matchesUrl($url, $context = array()){
	    if (isset($this->requirements['sf_host']) && $this->requirements['sf_host'] != $context['host']){
	      return false;
	    }
	 
	    return parent::matchesUrl($url, $context);
    }
    
	public function generate($params, $context = array(), $absolute = false){
	    $url = parent::generate($params, $context, $absolute);
	 
	    if (isset($this->requirements['sf_host']) && $this->requirements['sf_host'] != $context['host']){
	      // apply the required host
	      $protocol = $context['is_secure'] ? 'https' : 'http';
	      $url = $protocol.'://'.$this->requirements['sf_host'].$url;
	    }
	 
	    return $url;
    }
    
}