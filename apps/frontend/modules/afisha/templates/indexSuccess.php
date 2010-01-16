<?php include_component('afisha', 'selectors', array('selected_city' => $city)) ?>

<div>
	<ul>
<?php foreach($date_range as $date):?>
		<li>
			<a href="<?php echo url_for('@afisha_get_shows_by_date?id='.$city->getId().'&year='.$date['y'].'&month='.$date['m'].'&day='.$date['d']) ?>">
				<strong><?php echo $date['d'];?></strong>
				<span><?php echo $date['m'];?>/<?php echo $date['y'];?></span>
				<?php if ($date_today['t'] == $date['t']):?>
					сегодня
				<?php endif ?>
			</a>
		</li>
<?php endforeach ?>
	</ul>
</div>

