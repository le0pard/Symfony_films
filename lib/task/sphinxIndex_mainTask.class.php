<?php

class sphinxIndex_mainTask extends sfBaseTask
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
    $this->name             = 'index_main';
    $this->briefDescription = 'Main index for sphinx';
    $this->detailedDescription = <<<EOF
The [sphinx:index_main|INFO] task does things.
Call it with:

  [php symfony sphinx:index_main|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $indexer_bin = sfConfig::get('app_sphinx_search_indexer', '/usr/bin/indexer');
	$root_dir = sfConfig::get('sf_root_dir');
	$sphinx_config = sfConfig::get('app_sphinx_search_config', '/config/sphinx.conf');
	
	system($indexer_bin." --config ".$root_dir.$sphinx_config." --rotate --all");
  }
}
