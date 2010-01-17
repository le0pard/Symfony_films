<?php include_component('afisha', 'selectors', array('selected_city' => $city)) ?>
<?php if (isset($city)): ?>
<div>
	<ul>
<?php foreach($date_range as $date):?>
		<li>
			<a href="<?php echo url_for('@afisha_get_shows_by_date?id='.$city->getId().'&year='.$date['y'].'&month='.$date['m'].'&day='.$date['d']) ?>">
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

<?php if ($afisha):?>

<?php $cinema = ""; ?>
<?php foreach($afisha as $show):?>
<ul>
<?php if ($cinema != $show->getAfishaTheater()->getTitle()):?>
	<?php $cinema = $show->getAfishaTheater()->getTitle()?>
	<li><?php echo $cinema;?></li>
<?php endif ?>
</ul>
<?php endforeach?>

<?php include_partial('afisha/list', array('afisha' => $afisha)) ?>
	
<?php endif?>