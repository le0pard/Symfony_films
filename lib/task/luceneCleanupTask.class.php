<?php
class luceneCleanupTask extends sfBaseTask
{
  protected function configure()
  {
     $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));
     $this->namespace = 'lucene';
     $this->name = 'cleanup';
     $this->briefDescription = 'Cleanup lucene Film database';
     $this->detailedDescription = <<<EOF
The [lucene:cleanup|INFO] task cleans up the Film database:
  [./symfony lucene:cleanup --env=prod|INFO]
EOF;
  }
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    // cleanup Lucene index
	$index = FilmPeer::getLuceneIndex();
	$criteria = new Criteria();
	$criteria->add(FilmPeer::IS_VISIBLE, false);
	//$criteria->addOr($criteria->add(FilmPeer::IS_VISIBLE, false));
	$jobs = FilmPeer::doSelect($criteria);
	foreach ($jobs as $job)
	{
	  if ($hit = $index->find('pk:'.$job->getId()))
	  {
	    $hit->delete();
	  }
	}
	$index->optimize();
	$this->logSection('lucene', 'Cleaned up and optimized the film index');
  }
}
