<?php include_component('afisha', 'selectors') ?>
<h2>
<?php echo $film->getTitle()?>
<?php if ($film->getOrigTitle()):?>
 / <?php echo $film->getOrigTitle()?>
<?php endif ?>
</h2>
Год: <?php echo $film->getYear() ?><br />
<?php if ($film->getPoster()): ?>
Постер: <img src="/uploads/afisha_films/<?php echo $film->getPoster() ?>" /><br />
<?php endif ?>
Ссылка: <?php echo $film->getLink() ?><br />
Описание: <?php echo $film->getDescription(ESC_RAW) ?><br />
Рейтинг: 
<a target="_blank" href="http://kino-teatr.ua/ru/main/film_rating/film_id/<?php echo $film->getExternalId() ?>.phtml" title="<?php echo $film->getTitle()?>">
	<img alt="Рейтинг фильма Аватар" src="http://kino-teatr.ua/rating_<?php echo $film->getExternalId() ?>.gif">
</a><br />


<?php if (isset($film)): ?>
<div>
	<ul>
<?php foreach($date_range as $date):?>
		<li>
			<a href="<?php echo url_for('@afisha_film_by_date?id='.$film->getId().'&year='.$date['y'].'&month='.$date['m'].'&day='.$date['d']) ?>">
				<strong><?php echo $date['d'];?></strong>
				<span><?php echo $date['m'];?>/<?php echo $date['y'];?></span>
				<spam><?php echo $days_of_week[$date['w']]; ?></spam>
				<?php if ($date_today['t'] == $date['t']):?>
					сегодня
				<?php endif ?>
				<?php if ($selected_day['t'] == $date['t']):?>
					selected
				<?php endif ?>
			</a>
		</li>
<?php endforeach ?>
	</ul>
</div>
<?php endif ?>

<?php include_partial('afisha/list', array('afisha' => $afisha)) ?>