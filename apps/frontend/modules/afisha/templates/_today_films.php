<?php if (isset($afisha_films)):?>
<div class="round" id="afisha_films_list">
	<div class="r_container">
		<h2 class="top_plate"><a href="<?php echo url_for('@afisha') ?>">Фильмы на сегодня</a></h2>
		<div class="selector">
			<select id="afisha_today_films_list">
				<option value="">** Выберите город **</option>
				<?php foreach($selected_country->getCities() as $city):?>
					<option <?php $city->getId() == $selected_city->getId() and print 'selected="selected"' ?> value="<?php echo $city->getId();?>"><?php echo $city->getTitle();?></option>
				<?php endforeach?>
			</select><br />
			<img id="afisha_today_films_loader" style="display:none" alt="loaded" title="Ждите..." src="/images/ajax-loader2.gif" />
		</div>
		<ul id="afisha_today_films_list_box">
			<?php include_partial('afisha/today_films_li', array('selected_country' => $selected_country, 'selected_city' => $selected_city, 'afisha_films' => $afisha_films)) ?>
		</ul>
	</div>
</div>
<?php endif ?>