<?php slot('title') ?>
  Статистика - Coocoorooza
<?php end_slot(); ?>
<h1>Статистика</h1>
<h2>Категории фильмов</h2>
<div>
<?php stOfc::createChart(620, 400, '@statistic_cathegory_films', false); ?>
</div>
<h2>Опубликовано за день</h2>
<div>
<?php stOfc::createChart(620, 400, '@statistic_films_by_day', false); ?>
</div>