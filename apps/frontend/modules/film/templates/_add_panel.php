<div class="steps">
<ol>
  <?php if ('edit_step1' == $sf_params->get('action') && 'film' == $sf_params->get('module')):?>
  <li class="first active">Информация</li>
  <?php else:?>
  <li class="first"><a href="<?php echo url_for('film_edit_step1', $film) ?>">Информация</a></li>
  <?php endif ?>
  
  <?php if ('add_step2' == $sf_params->get('action') && 'film' == $sf_params->get('module')):?>
  <li class="active">Скриншоты</li>
  <?php else:?>
  <li><a href="<?php echo url_for('film_add_step2', $film) ?>">Скриншоты</a></li>
  <?php endif ?>
  
  <?php if ('add_step3' == $sf_params->get('action') && 'film' == $sf_params->get('module')):?>
  <li class="active">Ссылки</li>
  <?php else:?>
  <li><a href="<?php echo url_for('film_add_step3', $film) ?>">Ссылки</a></li>
  <?php endif ?>
  
  <?php if ('add_step4' == $sf_params->get('action') && 'film' == $sf_params->get('module')):?>
  <li class="active">Трейлеры</li>
  <?php else:?>
  <li><a href="<?php echo url_for('film_add_step4', $film) ?>">Трейлеры</a></li>
  <?php endif ?>
  
	<?php if (
				$film->getGalleryCount() >= sfConfig::get('app_films_min_gallery', 3) && 
				$film->getLinksCount() >= sfConfig::get('app_films_min_links', 1)
			): ?>
	
	  <?php if ('add_final' == $sf_params->get('action') && 'film' == $sf_params->get('module')):?>
	  <li class="active last">Все готово</li>
	  <?php else:?>
	  <li class="last"><a href="<?php echo url_for('film_add_final', $film) ?>">Все готово</a></li>
	  <?php endif ?>
	<?php else: ?>
		<li><span>Не все готово</span></li>
	<?php endif ?>
</ol>
</div>