<?php echo $user_data->getLogin() ?>
<div>
	<?php echo System::jevix_light($user_data->getAbout(ESC_RAW)); ?>
</div>
<?php if (sfConfig::get('app_integration_is_jabber')): ?>
<div>
<img src="http://<?php echo sfConfig::get('app_integration_jabber_server'); ?>/plugins/presence/status?jid=<?php echo $user_data->getLogin() ?>@<?php echo sfConfig::get('app_integration_jabber_domain'); ?>&images=http://<?php echo sfConfig::get('app_domain'); ?>/images/jabber/--IMAGE--.gif" title="jabber status" />
<?php echo $user_data->getLogin() ?>@<?php echo sfConfig::get('app_integration_jabber_domain'); ?>
</div>
<?php endif ?>
