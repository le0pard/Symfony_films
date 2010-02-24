<h1><?php echo $film->getTitle()?></h1>
<div id="cinema_info">
  <div>
	<a class="back" href="<?php echo url_for('@afisha') ?>">Назад на афишу</a>
	<h1>
	<?php echo $film->getTitle()?>
	<?php if ($film->getOrigTitle()):?>
	 / <?php echo $film->getOrigTitle()?>
	<?php endif ?>
	</h1>
</div>
<div class="cinema_name">
	<span class="poster"><img src="/uploads/afisha_films/<?php echo $film->getPoster() ?>" alt="<?php echo $film->getTitle()?>" title="<?php echo $film->getTitle()?>" /></span>
</div>
<div id="film_desc">
  <ul>
	<li><strong>Название в прокате: </strong><span><?php echo $film->getTitle()?></span></li>
	<li><strong>Оригинальное название: </strong><span><?php echo $film->getOrigTitle()?></span></li>

	<li><strong>Год: </strong><span><?php echo $film->getYear() ?></span></li>
	<li><strong>Ссылка: </strong><span><?php echo $film->getLink() ?></span></li>
	<li><strong>Рейтинг: </strong>
	<span>
	<a target="_blank" href="http://kino-teatr.ua/ru/main/film_rating/film_id/<?php echo $film->getExternalId() ?>.phtml" title="<?php echo $film->getTitle()?>">
	<img alt="Рейтинг фильма Аватар" src="http://kino-teatr.ua/rating_<?php echo $film->getExternalId() ?>.gif">
	</a>
	</span>
	</li>
	
  </ul>
</div>
<div class="cinema_desc">
	<?php echo $film->getDescription(ESC_RAW) ?>
</div>
</div>

<?php include_component('afisha', 'selectors', array('selected_day' => $selected_day, 'selected_city' => $city, 'selected_by_film' => $film)) ?>

<?php include_partial('afisha/list', array('afisha' => $afisha)) ?>