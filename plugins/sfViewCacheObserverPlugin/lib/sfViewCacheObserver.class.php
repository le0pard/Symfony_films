<?php 

/*
 * Clear view cache by the changes in the models
 * @author leo
 */

class sfViewCacheObserver  {
	
	public function clearCache($url, $app){
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
	
	public function identifyAndClearByObject($object){
		$current_app = sfConfig::get('sf_app');
		if (!$current_app){
			return false;
		}
		$class = get_class($object);
		$variablesArray = sfConfig::get('propel_behavior_viewCacheObserver_'.$class.'_variables', array());
    	if (is_callable(array($class, 'getCacheArray'))){
			foreach(call_user_func(array($class, 'getCacheArray')) as $row){
				foreach($variablesArray as $var=>$funct){
					if (is_callable(array($object, $funct))){
						$row = str_replace('#{'.$var.'}', call_user_func(array($object, $funct)), $row);
					}
				}
				sfViewCacheObserver::clearCache($row, $current_app);
			}
    	}
		$dependArray = sfConfig::get('propel_behavior_viewCacheObserver_'.$class.'_depend', array());
		foreach($dependArray as $key=>$row){
			if (is_callable(array($object, $key))){
				foreach(call_user_func(array($object, $key)) as $obj_depend){
					if (is_callable(array($obj_depend, $row))){
						sfViewCacheObserver::identifyAndClearByObject(call_user_func(array($obj_depend, $row)));
					}
				}
			}
		}
		$up_dependArray = sfConfig::get('propel_behavior_viewCacheObserver_'.$class.'_up_depend', array());
		foreach($up_dependArray as $row){
			if (is_callable(array($object, $row))){
				sfViewCacheObserver::identifyAndClearByObject(call_user_func(array($object, $row)));
			}
		}
	}
	
	/* object deleted */
	public function preSave($object, $con){
		sfViewCacheObserver::identifyAndClearByObject($object);
	}
	
	/* object deleted */
	public function preDelete($object, $con){
		sfViewCacheObserver::identifyAndClearByObject($object);	
	}
}