<?php

class sphinxStopTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));
	$this->addArguments(array(
      new sfCommandArgument('application', sfCommandArgument::REQUIRED, 'The application name')
    ));

    $this->namespace        = 'sphinx';
    $this->name             = 'stop';
    $this->briefDescription = 'Stop sphinx daemon';
    $this->detailedDescription = <<<EOF
The [sphinx:stop|INFO] task does things.
Call it with:

  [php symfony sphinx:stop|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	
    $searchd_bin = sfConfig::get('app_sphinx_search_searchd', '/usr/bin/searchd');
	$root_dir = sfConfig::get('sf_root_dir');
	$sphinx_config = sfConfig::get('app_sphinx_search_config', '/config/sphinx.conf');
	
	system($searchd_bin." --config ".$root_dir.$sphinx_config." --stop");
  }
}
