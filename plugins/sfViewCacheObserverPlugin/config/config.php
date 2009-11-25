<?php 

sfPropelBehavior::registerHooks('viewCacheObserver', array(
  ':delete:pre'                	=> array('sfViewCacheObserver', 'preDelete'),
  ':save:pre' 					=> array('sfViewCacheObserver', 'preSave'),
  'Peer:doUpdate:pre' 			=> array('sfViewCacheObserver', 'preSave'),
  'Peer:doInsert:pre' 			=> array('sfViewCacheObserver', 'preSave')
));
