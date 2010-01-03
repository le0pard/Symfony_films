<?php

require_once(dirname(__FILE__).'/../bootstrap/unit.php');

$plan = 60;
$t = new lime_test($plan, new lime_output_color());

try
{
  new sfRedisCache();
}
catch (sfInitializationException $e)
{
  $t->skip($e->getMessage(), $plan);
  return;
}

require_once(dirname(__FILE__).'/sfCacheDriverTests.class.php');

// setup
sfConfig::set('sf_logging_enabled', false);

// ->initialize()
$t->diag('->initialize()');
$cache = new sfRedisCache();
$cache->initialize();

sfCacheDriverTests::launch($t, $cache);
