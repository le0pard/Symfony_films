<?php slot('title') ?>
  <?php echo sprintf('%s - Coocoorooza', $cinema->getTitle()) ?>
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
<div id="content" class="group">
<h1><?php echo $cinema->getTitle()?></h1>

<p>тел. <?php echo $cinema->getPhone()?></p>
<p><?php echo $cinema->getAddress()?></p>
<p><?php echo $selected_city->getTitle() ?></p>
<div class="clear"></div>
</div><!--#content-->
<div class="tabbed">
	<div id="today_tab" style="display: block;">
		<hr />
		<h2 id="today" class="table-title">Сегодня</h2>
		<?php include_partial('mobile/afisha_films_list', array('afisha' => $afisha_today, 'cinema' => $cinema)) ?>
	</div>
	<div id="yesterday_tab" style="display: none;">
		<hr>
		<h2 id="yesterday" class="table-title">Вчера</h2>
		<?php include_partial('mobile/afisha_films_list', array('afisha' => $afisha_yesterday, 'cinema' => $cinema)) ?>
	</div>
	<div id="tomorrow_tab" style="display: none;">
		<hr>
		<h2 id="tomorrow" class="table-title">Завтра</h2>
		<?php include_partial('mobile/afisha_films_list', array('afisha' => $afisha_tomorrow, 'cinema' => $cinema)) ?>
	</div>
	<div id="two_days_tab" style="display: none;">
		<hr>
		<h2 id="two_days" class="table-title">2 дня</h2>
		<?php include_partial('mobile/afisha_films_list', array('afisha' => $afisha_2days, 'cinema' => $cinema)) ?>
	</div>
</div>