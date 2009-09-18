<?php
class JobeetCleanupTask extends sfBaseTask
{
  protected function configure()
  {
     $this->addOptions(array(
       new sfCommandOption('env', null,
sfCommandOption::PARAMETER_REQUIRED, 'The environement', 'prod'),
     ));
     $this->namespace = 'film';
     $this->name = 'cleanup';
     $this->briefDescription = 'Cleanup Film database';
     $this->detailedDescription = <<<EOF
The [jobeet:cleanup|INFO] task cleans up the Film database:
  [./symfony jobeet:cleanup --env=prod|INFO]
EOF;
  }
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
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
