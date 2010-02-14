<div id="entrance">
<h1>Просмотр перед публикацией &laquo;<?php echo $film->getTitle() ?>&raquo;</h1>
<?php include_partial('film/add_panel', array('film' => $film)) ?>
<form id="film_form_final" action="<?php echo url_for('film_add_final', $film) ?>" method="POST">
	<h2><input style="float:right; margin-top:0!important" name="pub" type="submit" value="Опубликовать" />
	Посмотрите, как будет выглядеть ваш релиз.</h2>
	<p>И если все хорошо, нажмите кнопку «опубликовать»</p>
	<hr /><br />
</form>
<?php if ($sf_user->hasCredential(array('super_admin', 'admin'), false)):?>
<form id="film_form_final" action="<?php echo url_for('film_twitter', $film) ?>" method="POST">
	<input type="submit" name="pub" value="Twitter!" />
</form>
<?php endif ?>
<?php include_partial('film/film_main', array('film' => $film, 'sf_cache_key' => $film->getId())) ?>
</div>