<?php include_component('user', 'card') ?>
<?php include_component('film', 'types', array('sf_cache_key' => 'types')) ?>
<?php include_component('comment', 'last_comments', array('sf_cache_key' => 'last_comments')) ?>
<div id="statistic">
	<div class="r_container">
	<a href="<?php echo url_for('@statistic') ?>">Статистика</a>
	</div>
</div>
