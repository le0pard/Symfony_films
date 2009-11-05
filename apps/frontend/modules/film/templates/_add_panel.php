<div id="film_add_panel">
	<ul>
		<li><a href="<?php echo url_for('film_edit_step1', $film) ?>">Редактировать данные про фильм/сериал</a></li>
		<li><a href="<?php echo url_for('film_add_step2', $film) ?>">Галерея к фильму/сериалу</a></li>
		<li><a href="<?php echo url_for('film_add_step3', $film) ?>">Ссылки к фильму/сериалу</a></li>
		<?php if (
					$film->getGalleryCount() >= sfConfig::get('app_films_min_gallery', 3) && 
					$film->getLinksCount() >= sfConfig::get('app_films_min_links', 1)
				): ?>
		<li><a href="<?php echo url_for('film_add_final', $film) ?>">Все готово</a></li>
		<?php else: ?>
		<li><span>Все готово</span></li>
		<?php endif ?>
	</ul>
</div>