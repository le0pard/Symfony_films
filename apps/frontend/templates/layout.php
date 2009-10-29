<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<title>
    <?php if (!include_slot('title')): ?>
    	Кукурудза - Лучшие фильмы и сериалы
  	<?php endif; ?>
	</title>
	<?php include_http_metas() ?>
    <?php include_metas() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<link rel="alternate" type="application/atom+xml" title="Atom"  href="<?php echo url_for('@homepage_atom', true) ?>" />
	<link title="RSS" type="application/rss+xml" rel="alternate" href="<?php echo url_for('@homepage_rss', true) ?>"/>
    <?php include_stylesheets() ?>
	<?php include_javascripts() ?>
  </head>
  <body>
    <!--HEADER-->
   	<?php include_partial('global/header') ?>
	<div class="clear"></div>
	<?php include_component('static', 'menu', array('sf_cache_key' => 'menu')) ?>
	<div class="clear"></div>
	<!--HEADER-->
	<!--FLASH-->
	<?php if ($sf_user->hasFlash('confirm')): ?>
		<div id="information_messages">
			<ul class="confirm">
				<li><?php echo $sf_user->getFlash('confirm') ?></li>
			</ul>
		</div>
	<?php endif; ?>
	<?php if ($sf_user->hasFlash('error')): ?>
		<div id="information_messages">
			<ul class="error">
				<li><?php echo $sf_user->getFlash('error') ?></li>
			</ul>
		</div>
	<?php endif; ?>
	<!--FLASH-->
	<div id="content">
		<div class="left_content">
			<?php echo $sf_content ?>
		</div>
		<div class="clear"></div>
		<div class="right_content">
			<?php include_partial('global/right_panel') ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<!--FOOTER-->
   	<?php include_partial('global/footer') ?>
	<!--FOOTER-->
  </body>
</html>
