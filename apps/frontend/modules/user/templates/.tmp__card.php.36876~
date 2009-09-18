<div class="right_card">
	<div class="header">
		Кабинет пользователя
	</div>
	<?php if ($sf_user->isAnonymous()) { ?>
		<a href="<?php echo url_for('@user_login') ?>">Вход</a><br />
		<a href="<?php echo url_for('@user_registration') ?>">Регистрация</a>
	<?php } else { ?>
		<div class="user_left" style="float:left;">
			<div>Привет, <strong><?php echo $sf_user->getAuthUser()->getLogin() ?></strong></div>
			<ul>
				<li><a href="<?php echo url_for('@film_add_step1') ?>">Добавить фильм/сериал</a></li>
				<li><a href="<?php echo url_for('@user_profile') ?>">Профиль</a></li>
				<li><a href="<?php echo url_for('@user_logout') ?>">Выход</a></li>
			</ul>
		</div>
		<?php if ($sf_user->getAuthUser()->getAvatar()): ?>
		<div class="user_right">
			<img title="<?php echo $sf_user->getAuthUser()->getLogin() ?>" alt="<?php echo $sf_user->getAuthUser()->getLogin() ?>" src="/uploads/avatars/<?php echo $sf_user->getAuthUser()->getAvatar() ?>" />
		</div>
		<?php endif ?>
	<?php } ?>
</div>
<div class="clear"></div>