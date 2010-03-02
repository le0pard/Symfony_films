<div class="round" id="affiche_dates">
	<div class="r_container">
		<div class="aff_location">
			<?php if ($selected_country):?>
			<?php if (isset($film)):?>
				<input type="hidden" id="afisha_film_id" value="<?php echo $film->getId()?>" />
			<?php endif ?>
			<div class="city">
				<h3>Город</h3>
				<div class="select">
					<div id="afisha_city_box">
						<select id="afisha_city">
							<option value="">** Выберите город **</option>
							<?php foreach($selected_country->getCities() as $city):?>
								<option <?php $city->getId() == $selected_city->getId() and print 'selected="selected"' ?> value="<?php echo $city->getId();?>"><?php echo $city->getTitle();?></option>
							<?php endforeach?>
						</select>
					</div>
				</div>
			</div>
			<?php endif ?>
		</div>
	<h3>Дата</h3>
		<div class="round">
			<ul class="r_container">
			<?php if (isset($selected_by_city) || isset($selected_by_film) || isset($selected_by_cinema)): ?>
				<?php foreach($date_range as $date):?>
					<li>
						<?php if ($selected_day['t'] == $date['t']):?>
							<span>
						<?php else:?>
							<a <?php if ($date_today['t'] == $date['t']):?> class="today_day"<?php endif ?>
							 href="
							<?php if (isset($selected_by_city)):?>
								<?php echo url_for('@afisha_get_shows_by_date?id='.$selected_by_city->getId().'&year='.$date['y'].'&month='.$date['m'].'&day='.$date['d']) ?>
							<?php elseif (isset($selected_by_film)):?>
								<?php echo url_for('@afisha_film_city_by_date?id='.$selected_by_film->getId().'&year='.$date['y'].'&month='.$date['m'].'&day='.$date['d'].'&city_id='.$selected_city->getId()) ?>
							<?php elseif (isset($selected_by_cinema)):?>
								<?php echo url_for('@afisha_cinema_by_date?id='.$selected_by_cinema->getId().'&year='.$date['y'].'&month='.$date['m'].'&day='.$date['d']) ?>		
							<?php endif ?>">
						<?php endif ?>	
							<strong><?php echo $date['d'];?></strong><?php echo $days_of_week[$date['w']]; ?>
						<?php if ($selected_day['t'] == $date['t']):?>
							</span>
						<?php else:?>	
							</a>
						<?php endif ?>
						<?php echo $date['m'];?>/<?php echo $date['y'];?>
					</li>
				<?php endforeach ?>
			<?php endif ?>
			</ul>
		</div>
	</div>
</div>

<!--
<div>
	<select id="afisha_country">
		<?php foreach($countries as $country):?>
			<option <?php $country->getTitle() == $selected_country->getTitle() and print 'selected="selected"' ?> value="<?php echo $country->getId();?>"><?php echo $country->getTitle();?></option>
		<?php endforeach?>
	</select>
	<?php if ($selected_country):?>
	<?php if (isset($film)):?>
		<input type="hidden" id="afisha_film_id" value="<?php echo $film->getId()?>" />
	<?php endif ?>
	<div id="afisha_city_box">
		<select id="afisha_city">
			<option value="">-- Выберите город --</option>
			<?php foreach($selected_country->getCities() as $city):?>
				<option <?php $city->getTitle() == $selected_city->getTitle() and print 'selected="selected"' ?> value="<?php echo $city->getId();?>"><?php echo $city->getTitle();?></option>
			<?php endforeach?>
		</select>
	</div>
	<?php endif ?>
</div>
-->