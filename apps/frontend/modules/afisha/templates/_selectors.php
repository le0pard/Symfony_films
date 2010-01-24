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