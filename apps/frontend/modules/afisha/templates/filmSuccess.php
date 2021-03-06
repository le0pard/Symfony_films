<?php slot('title') ?>
  <?php echo sprintf('%s (%s) - Coocoorooza', $film->getTitle(), $film->getOrigTitle()) ?>
<?php end_slot(); ?>
<h1><?php echo $film->getTitle()?>
  <?php if ($film->getOrigTitle()):?>
   / <?php echo $film->getOrigTitle()?>
  <?php endif ?></h1>
<div id="cinema_info">
  <div>
  <a class="back" href="<?php echo url_for('@afisha') ?>">Назад на афишу</a>
</div>
<?php if ($film->getPoster()): ?>
<div class="cinema_name">
  <span class="poster"><img src="/uploads/afisha_films/<?php echo $film->getPoster() ?>" alt="<?php echo $film->getTitle()?>" title="<?php echo $film->getTitle()?>" /></span>
</div>
<?php endif?>
<div id="film_desc">
  <ul>
  <li><strong>Название в прокате: </strong><span><?php echo $film->getTitle()?></span></li>
  <li><strong>Оригинальное название: </strong><span><?php echo $film->getOrigTitle()?></span></li>
  <li><strong>Год: </strong><span><?php echo $film->getYear() ?></span></li>
  <li><strong>Ссылка: </strong><span><?php echo $film->getLink() ?></span></li>
  <li><strong>Рейтинг: </strong>
  <span>
  <a target="_blank" href="http://kino-teatr.ua/ru/main/film_rating/film_id/<?php echo $film->getExternalId() ?>.phtml" title="<?php echo $film->getTitle()?>">
  <img alt="<?php echo $film->getTitle()?>" src="http://kino-teatr.ua/rating_<?php echo $film->getExternalId() ?>.gif">
  </a>
  </span>
  </li>

  </ul>
</div>
<?php if ($film->getCasts() != ""): ?>
<div id="film_casts">
  <strong>В ролях: </strong><div style="margin:10px 0;"><?php echo $film->getCasts() ?></div>
</div>
<?php endif ?>
<div class="cinema_desc">
  <strong>Сюжет: </strong><div style="margin-top:10px;"><?php echo strip_tags($film->getDescription(ESC_RAW)) ?></div>
</div>
</div>

<?php include_component('afisha', 'selectors', array('selected_day' => $selected_day, 'selected_city' => $city, 'selected_by_film' => $film)) ?>

<?php include_partial('afisha/list', array('afisha' => $afisha)) ?>

<div id="afisha_source">Информация предоставлена сайтом <a href="http://kino-teatr.ua/ru/main/film/film_id/<?php echo $film->getExternalId()?>.phtml" target="_blank">www.kino-teatr.ua</a></div>