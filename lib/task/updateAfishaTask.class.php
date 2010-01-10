<?php

class updateAfishaTask extends sfBaseTask
{
  	
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'afisha';
    $this->name             = 'updateAfisha';
    $this->briefDescription = 'Update afisha data from rss';
    $this->detailedDescription = <<<EOF
The [updateAfisha|INFO] task does things.
Call it with:

  [php symfony afisha:updateAfisha|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
    $xml_parser = new XmlParser();
    print_r($xml_parser->get_afish_by_url('http://www.okino.ua/feed/cinema/141'));
    print_r($xml_parser->get_afish_by_url('http://www.okino.ua/feed/cinema/122'));
    print_r($xml_parser->get_afish_by_url('http://www.okino.ua/feed/cinema/124'));
  }
  
}
