<div class="round" id="register">
	<div class="r_container">
		<?php if ($sf_user->isAnonymous()): ?>
		<form action="<?php echo url_for('@user_login') ?>" method="post">
			<?php if ($form->isCSRFProtected()) : ?> 
	  			<?php echo $form[$form->getCSRFFieldName()]->render(); ?>
	  		<?php endif ?>
			<div>
				<h5><?php echo $form['login']->renderLabel()?></h5>
				<?php echo $form['login']->render()?>
				<h5><?php echo $form['password']->renderLabel()?></h5>
				<?php echo $form['password']->render()?>
				<input type="submit" value="Вход" />
				<a href="<?php echo url_for('@user_registration') ?>">Регистрация</a>
			</div>
		</form>
		<?php else:?>
		  <?php $unp_films_count = $sf_user->getAuthUser()->getUnpublicFilmsCount(); ?>
		  <div class="r_container userinfo">
		  		<p>Привет, <a href="<?php echo url_for('user_show', $sf_user->getAuthUser()) ?>"><?php echo $sf_user->getAuthUser()->getLogin() ?></a>!</p>
		          <p><a href="<?php echo url_for('@film_add_step1') ?>" class="big">Добавить фильм</a></p>
		          <div><a href="<?php echo url_for('@user_films_list') ?>">Неопубликованное
		          <?php if ($unp_films_count > 0): ?><strong> (<?php echo $unp_films_count; ?>)</strong><?php endif ?></a></div>
		          <div><a href="<?php echo url_for('@user_profile') ?>">Профайл</a></div>
		          <div><a href="<?php echo url_for('@user_logout') ?>">Выход</a></div>
		  </div>
		<?php endif ?>
	</div>
</div>