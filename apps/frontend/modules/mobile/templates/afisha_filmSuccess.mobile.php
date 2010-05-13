<?php slot('title') ?>
  <?php echo sprintf('%s (%s) - Coocoorooza', $film->getTitle(), $film->getOrigTitle()) ?>
<?php end_slot(); ?>
<p id="top-menu" class="top_menu">
<span>&laquo;</span> 
<span class="next">
	<a title="Афиша" href="<?php echo url_for('@mobile_afisha') ?><?php if (isset($city_id_params)):?>?city_id=<?php echo $city_id_params ?><?php endif ?>">Афиша</a>
</span> 
<span>|</span> 
<span class="prev">
	<a title="Фильмы" href="<?php echo url_for('@homepage_mobile') ?>">Фильмы</a>	
</span> 
<span>&raquo;</span>
</p>
<hr />
<div class="group">
	<form method="get" action="" id="change_city">
		<div>
			<select id="ch_city" name="city_id">
				<?php foreach($selected_country->getCities() as $city):?>
					<option <?php $city->getId() == $selected_city->getId() and print 'selected="selected"' ?> value="<?php echo $city->getId();?>"><?php echo $city->getTitle();?></option>
				<?php endforeach?>
			</select>
			<input type="submit" value="Поменять" />  
			<a title="Кинотеатры" href="<?php echo url_for('@mobile_afisha_cinemas?city_id='.$selected_city->getId()) ?>">Кинотеатры</a>
		</div>
	</form>
</div>
<div id="content" class="group">
<h1><?php echo $film->getTitle()?>
	<?php if ($film->getOrigTitle()):?>
	 / <?php echo $film->getOrigTitle()?>
	<?php endif ?></h1>

<?php if ($film->getPoster()): ?>
<img class="aligncenter" src="/uploads/afisha_films/<?php echo $film->getPoster() ?>" alt="<?php echo $film->getTitle()?>" title="<?php echo $film->getTitle()?>" />
<?php endif?>
<p><?php echo $film->getDescription(ESC_RAW) ?></p>
<div class="clear"></div>
</div><!--#content-->

<div class="tabbed">
	<div id="today_tab" style="display: block;">
		<hr />
		<h2 id="today" class="table-title">Сегодня</h2>
		<?php include_partial('mobile/afisha_cinema_list', array('afisha' => $afisha_today)) ?>
	</div>
	<div id="yesterday_tab" style="display: none;">
		<hr>
		<h2 id="yesterday" class="table-title">Вчера</h2>
		<?php include_partial('mobile/afisha_cinema_list', array('afisha' => $afisha_yesterday)) ?>
	</div>
	<div id="tomorrow_tab" style="display: none;">
		<hr>
		<h2 id="tomorrow" class="table-title">Завтра</h2>
		<?php include_partial('mobile/afisha_cinema_list', array('afisha' => $afisha_tomorrow)) ?>
	</div>
	<div id="two_days_tab" style="display: none;">
		<hr>
		<h2 id="two_days" class="table-title">2 дня</h2>
		<?php include_partial('mobile/afisha_cinema_list', array('afisha' => $afisha_2days)) ?>
	</div>
</div>