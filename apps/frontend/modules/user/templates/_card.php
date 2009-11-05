<div class="right_card">
	<div class="header">
		Кабинет пользователя
	</div>
	<?php if ($sf_user->isAnonymous()) { ?>
		<a href="<?php echo url_for('@user_login') ?>">Вход</a><br />
		<a href="<?php echo url_for('@user_registration') ?>">Регистрация</a>
	<?php } else { ?>
		<div class="user_left" style="float:left;">
			<div>Привет, 
				<strong>
					<a href="<?php echo url_for('user_show', $sf_user->getAuthUser()) ?>">
						<?php echo $sf_user->getAuthUser()->getLogin() ?>
					</a>
				</strong>
			</div>
			<ul>
				<li><a href="<?php echo url_for('@film_add_step1') ?>">Добавить фильм/сериал</a></li>
				<?php $unp_films_count = $sf_user->getAuthUser()->getUnpublicFilmsCount(); ?>
				<li><a href="<?php echo url_for('@user_films_list') ?>">Неопубликованые<?php if ($unp_films_count > 0): ?><strong> (<?php echo $unp_films_count; ?>)<?php endif ?></strong></a></li>
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