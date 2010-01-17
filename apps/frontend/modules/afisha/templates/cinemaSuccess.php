<?php include_component('afisha', 'selectors') ?>
<h2><?php echo $cinema->getTitle()?></h2>
Адрес: <?php echo $cinema->getAddress()?><br />
Телефон: <?php echo $cinema->getPhone()?><br />
Про него: <?php echo $cinema->getDescription(ESC_RAW) ?><br />

<?php if (isset($cinema)): ?>
<div>
	<ul>
<?php foreach($date_range as $date):?>
		<li>
			<a href="<?php echo url_for('@afisha_cinema_by_date?id='.$cinema->getId().'&year='.$date['y'].'&month='.$date['m'].'&day='.$date['d']) ?>">
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