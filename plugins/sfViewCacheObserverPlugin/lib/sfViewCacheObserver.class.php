<?php 

/*
 * Clear view cache by the changes in the models
 * @author leo
 */

class sfViewCacheObserver  {
	static protected $cacheManager = null;
	
	
	public function clearCache($url){
	if (sfContext::hasInstance()){
		if (is_null(sfViewCacheObserver::$cacheManager)){
		   	$currentConfiguration = sfContext::getInstance()->getConfiguration();
			$otherConfig = ProjectConfiguration::getApplicationConfiguration(sfConfig::get('app_viewCacheObserver_project_cache', 'frontend'), sfConfig::get('app_viewCacheObserver_environment_cache', 'prod'), false);
			$otherContext = sfContext::createInstance($otherConfig);
			sfViewCacheObserver::$cacheManager = sfContext::getInstance()->getViewCacheManager();
			$configuration = ProjectConfiguration::getApplicationConfiguration($currentConfiguration->getApplication(), $currentConfiguration->getEnvironment(), $currentConfiguration->isDebug()); 
 	    	$this->context = sfContext::createInstance($configuration); 
 	    	unset($currentConfiguration);
		}
		if (sfViewCacheObserver::$cacheManager){
			sfViewCacheObserver::$cacheManager->remove($url, '*');
		}
	  }
	}
	
	public function identifyAndClearByObject($object, $called_main_method = true){
    $class = get_class($object);
		$criteriaArray = sfConfig::get('propel_behavior_viewCacheObserver_'.$class.'_criteria', array());
		$criteria_pass = true;
		foreach($criteriaArray as $key=>$row){
			if (is_callable(array($object, $key))){
				if (call_user_func(array($object, $key)) != $row){
					$criteria_pass = false;
				}
			}
		}
		if ($criteria_pass){
			$cacheArray = sfConfig::get('propel_behavior_viewCacheObserver_'.$class.'_cache', array());
			$variablesArray = sfConfig::get('propel_behavior_viewCacheObserver_'.$class.'_variables', array());
			foreach($cacheArray as $row){
				foreach($variablesArray as $var=>$funct){
					if (is_callable(array($object, $funct))){
						$row = str_replace('#{'.$var.'}', call_user_func(array($object, $funct)), $row);
					}
				}
				sfViewCacheObserver::clearCache($row);
			}
			if ($called_main_method){
				$dependArray = sfConfig::get('propel_behavior_viewCacheObserver_'.$class.'_has_many_depend', array());
				foreach($dependArray as $key=>$row){
					if (is_callable(array($object, $key))){
						foreach(call_user_func(array($object, $key)) as $obj_depend){
							if (is_callable(array($obj_depend, $row))){
								sfViewCacheObserver::identifyAndClearByObject(call_user_func(array($obj_depend, $row)), false);
							}
						}
					}
				}
				$belongs_to_dependArray = sfConfig::get('propel_behavior_viewCacheObserver_'.$class.'_belongs_to_depend', array());
				foreach($belongs_to_dependArray as $row){
					if (is_callable(array($object, $row))){
						sfViewCacheObserver::identifyAndClearByObject(call_user_func(array($object, $row)), false);
					}
				}
			}
		}
	}
	
	/* object save */
	public function postSave($object, $con, $affectedRows){
		sfViewCacheObserver::identifyAndClearByObject($object);
	}
	
	/* object deleted */
	public function postDelete($object, $con){
		sfViewCacheObserver::identifyAndClearByObject($object);	
	}
}