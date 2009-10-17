<?php

class LessRoutesTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));
	$this->addArguments(array(
      new sfCommandArgument('application', sfCommandArgument::REQUIRED, 'The application name'),
	  new sfCommandArgument('env', sfCommandArgument::REQUIRED, 'The environment name')
    ));

    $this->namespace        = 'less';
    $this->name             = 'routes';
    $this->briefDescription = 'Create less_routes.js and less_routes_dev.js with js routes';
    $this->detailedDescription = <<<EOF
The [less:routes|INFO] task does things.
Call it with:
Create less_routes.js with js routes
  [./symfony less:routes frontend|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
	// get routes
	$config = sfFactoryConfigHandler::getConfiguration($this->configuration->getConfigPaths('config/factories.yml'));
	$params = array_merge($config['routing']['param'], array('load_configuration' => false, 'logging' => false));
	$config = new sfRoutingConfigHandler();
	$routes = $config->evaluate($this->configuration->getConfigPaths('config/routing.yml'));
	$routing = new sfPatternRouting($this->dispatcher, null, $params);
	$routing->setRoutes($routes);
	$this->dispatcher->notify(new sfEvent($routing, 'routing.load_configuration'));
	$this->routes = $routing->getRoutes();
	$this->outputRoutes($arguments['application'], $arguments['env']);
  }
  
  protected function outputRoutes($application, $environment)
  {
    $this->logSection('app', sprintf('Create less routes for application "%s" and enviroment "%s"', $application, $environment));
	$function_str = '';
	
	switch($environment){
		case 'dev':
		case 'development':
			$path_prefix = "var less_routes_prefix_url = '/".$application."_dev.php';\n";
			$file_prefix = 'dev';
			break;
		case 'prod':
		case 'production':
			if ('frontend' == $application)
				$path_prefix = "var less_routes_prefix_url = '';\n";
			else
				$path_prefix = "var less_routes_prefix_url = '/".$application.".php';\n";	
			$file_prefix = '';
			break;
		case 'test':
			$path_prefix = "var less_routes_prefix_url = '';\n";
			$file_prefix = 'test';
			break;
		default:
			$path_prefix = "var less_routes_prefix_url = '';\n";	
			$file_prefix = '';		
	}
	
	foreach ($this->routes as $name => $route)
    {
      $requirements = $route->getRequirements();
	  $variables = $route->getVariables();
	  $options = $route->getOptions();
	  $tokens = $route->getTokens();
	  $defaults_params = $route->getDefaults();
      $method = isset($requirements['sf_method']) ? strtoupper(is_array($requirements['sf_method']) ? implode(', ', $requirements['sf_method']) : $requirements['sf_method']) : 'ANY';
	  
	  $temp_route = "'";
	  $temp_variables = array_keys($variables);
	  foreach($tokens as $key=>$token){
	  	switch ($token[0]){
	  		case 'separator':
				if (!$token[1]) $temp_route.= $token[2];
				break;
			case 'text':
				$temp_route.= $token[2];
				break;	
			case 'variable':
				$temp_route.= "' + ".$token[3]." + '";
				break;
		}
	  }
	  $temp_route.= "'";
	  
	  $this->logSection('routes', sprintf('Route for name "%s" >> "%s"', $name, $temp_route));
	  
	  $function_str.= $name.'_path = function(';
	  foreach($temp_variables as $k=>$variable){
	  	if ($k != 0) $function_str.= ', ';
	  	$function_str.= $variable;
	  }
	  $function_str.= "){ return less_routes_prefix_url + ".$temp_route."; }\n";
    }
	
	$handle = fopen(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR.$application."_less_routes_".$file_prefix.".js", "w+");
	if ($handle){
		if (fwrite($handle, $path_prefix.$function_str) === false) {
			throw new sfCommandException(sprintf('Cannot write %s_less_routes_%s.js text file.', $application, $file_prefix));
        }
    	fclose($handle); 
	}
  }
  
}
