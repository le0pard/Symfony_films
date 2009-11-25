<?php 

sfPropelBehavior::registerHooks('viewCacheObserver', array(
  ':delete:post'                	=> array('sfViewCacheObserver', 'postDelete'),
  ':save:post' 					=> array('sfViewCacheObserver', 'postSave'),
  'Peer:doUpdate:post' 			=> array('sfViewCacheObserver', 'postSave'),
  'Peer:doInsert:post' 			=> array('sfViewCacheObserver', 'postSave')
));
