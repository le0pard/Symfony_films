<div id="entrance">
  <h1>Воин кукурузы "<?php echo $user_data->getLogin() ?>"</h1>
  <div id="userinfo_ava"><h3>Аватарка</h3>
	<img src="/uploads/avatars/<?php echo $user_data->getViewAvatar()?>" alt="<?php echo $user_data->getLogin()?>" /><br />
	<h3>Пол:</h3>
	<span><?php echo $user_data->getGenderName()?></span>
  </div>

  <div id="userinfo_site"><h3>Сайт/блог</h3>
	<a href="<?php echo $user_data->getWebsiteBlog() ?>" rel="nofollow"><?php echo $user_data->getWebsiteBlog() ?></a>
	<h3>Опубликовано фильмов: </h3>
	<span><?php echo $user_data->getCountOfFilms()?></span>
	<h3>Коментариев: </h3>
	<span><?php echo $user_data->countCommentss()?></span>
	<?php if (sfConfig::get('app_integration_is_jabber')): ?>
	<h3>Jabber статус: </h3>
	<img src="http://<?php echo sfConfig::get('app_integration_jabber_server'); ?>/plugins/presence/status?jid=<?php echo $user_data->getLogin() ?>@<?php echo sfConfig::get('app_integration_jabber_domain'); ?>&images=http://<?php echo sfConfig::get('app_domain'); ?>/images/jabber/--IMAGE--.gif" title="jabber status" />
	<?php echo $user_data->getLogin() ?>@<?php echo sfConfig::get('app_integration_jabber_domain'); ?><br />
	<?php endif ?>
  </div>

  <div id="userinfo_about"><h3>Немного о себе</h3>
	<?php echo System::jevix_light($user_data->getAbout(ESC_RAW)); ?>
  </div>

</div>

