<?php

class backendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
  }
  
  public function clearFrontendCache($url, $app){
	  if (sfContext::hasInstance()){
	   	$currentConfig = sfContext::getInstance()->getConfiguration();
		$currentContext = sfContext::getInstance();
		
		$otherConfig = ProjectConfiguration::getApplicationConfiguration('frontend', 'cache', true);
		$otherContext = sfContext::createInstance($otherConfig);
		
		sfContext::switchTo('frontend');
		$cacheManager = sfContext::getInstance()->getViewCacheManager();
		if ($cacheManager){
			$cacheManager->remove($url);
		}
		sfContext::switchTo($app);
	  }	
  }
}
