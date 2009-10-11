<?php include_component('user', 'card') ?>
<?php include_component('film', 'types', array('sf_cache_key' => 'types')) ?>

<div class="right_card">
	<div class="header">
		Ссылки
	</div>
	<a href="<?php echo url_for('@homepage_rss', true) ?>">RSS</a><br />
	<a href="<?php echo url_for('@homepage_atom', true) ?>">ATOM</a><br />
</div>
<div class="clear"></div>
