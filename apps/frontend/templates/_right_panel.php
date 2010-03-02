<?php include_component('user', 'card') ?>
<?php if ('afisha' == $sf_params->get('module')):?>
	<?php include_component('afisha', 'today_films', array('sf_cache_key' => 'today_films')) ?>
<?php else:?>
	<?php include_component('film', 'types', array('sf_cache_key' => 'types')) ?>
<?php endif ?>
<?php include_component('comment', 'last_comments', array('sf_cache_key' => 'last_comments')) ?>
<div class="round" id="statistic" style="margin-top: 3em;">
	<div class="r_container">
		<h2 class="top_plate">Полезные ссылки</h2>
		<ul style="list-style-image:none;list-style-type:none;margin:0;padding:1em;">
			<li><a href="<?php echo url_for('@statistic') ?>">Статистика</a></li>
		</ul>
	</div>
</div>
