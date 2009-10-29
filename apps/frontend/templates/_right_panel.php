<?php include_component('user', 'card') ?>
<?php include_component('film', 'types', array('sf_cache_key' => 'types')) ?>
<?php include_component('comment', 'last_comments') ?>

<div class="right_card">
	<div class="header">
		Ссылки
	</div>
	<a href="<?php echo url_for('@homepage_rss') ?>">RSS</a><br />
	<a href="<?php echo url_for('@homepage_atom') ?>">ATOM</a><br />
	<a href="<?php echo url_for('@statistic') ?>">Статистика</a><br />
</div>
<div class="clear"></div>
