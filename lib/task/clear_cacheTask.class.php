<?php

class clear_cacheTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'system';
    $this->name             = 'clear_cache';
    $this->briefDescription = 'Clear cache for afisha';
    $this->detailedDescription = <<<EOF
The [clear_cache|INFO] task does things.
Call it with:

  [php symfony system:clear_cache|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {

    // add your code here
    $urls = array(
    	'@sf_cache_partial?module=afisha&action=_today&sf_cache_key=afisha',
		'afisha/index',
		'afisha/index?id=*',
		'afisha/index?day=*&id=*&month=*&year=*',
    	'afisha/film?id=*',
		'afisha/film?day=*&id=*&month=*&year=*',
    	'afisha/film?day=*&id=#{id}&month=*&year=*&city_id=*',
    	'afisha/cinema?id=*',
		'afisha/cinema?day=*&id=*&month=*&year=*',
    	'@sf_cache_partial?module=afisha&action=_today_films&sf_cache_key=today_films'
    );
	
    $context = sfContext::createInstance($this->configuration);
	$cacheManager = $context->getViewCacheManager();
	
	if ($cacheManager){
		foreach($urls as $url){
			$this->logSection('cache', sprintf('Clearing cache "%s"', $url));
			$cacheManager->remove($url, '*');
		}
	}
	
  }
}
