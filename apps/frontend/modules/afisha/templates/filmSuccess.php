<?php include_component('afisha', 'selectors') ?>
<h2>
<?php echo $film->getTitle()?>
<?php if ($film->getOrigTitle()):?>
 / <?php echo $film->getOrigTitle()?>
<?php endif ?>
</h2>
Год: <?php echo $film->getYear() ?><br />
Постер: <img style="max-width:200px;max-height:200px;" src="<?php echo $film->getPoster() ?>" /><br />
Ссылка: <?php echo $film->getLink() ?><br />
Описание: <?php echo $film->getDescription(ESC_RAW) ?><br />


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