<h1>Добавление фильма/сериала</h1>
<?php include_partial('film/add_panel', array('film' => $film)) ?>
<h2>Просмотр перед публикацией &laquo;<?php echo $film->getTitle() ?>&raquo;</h2>
<form id="film_form_final" action="<?php echo url_for('film_add_final', $film) ?>" method="POST">
	<p>Внимание!</p>
	<input type="submit" name="pub" value="Публиковать" />
</form>
<?php if ($sf_user->hasCredential(array('super_admin', 'admin'), false)):?>
<form id="film_form_final" action="<?php echo url_for('film_twitter', $film) ?>" method="POST">
	<input type="submit" name="pub" value="Twitter!" />
</form>
<?php endif ?>
<?php include_partial('film/film_main', array('film' => $film, 'sf_cache_key' => $film->getId())) ?>