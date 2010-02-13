<h1>Статистика</h1>
<h2>Категории фильмов</h2>
<div>
<?php stOfc::createChart(500, 250, '@statistic_cathegory_films', false); ?>
</div>
<h2>Опубликовано за день</h2>
<div>
<?php stOfc::createChart(800, 250, '@statistic_films_by_day', false); ?>
</div>