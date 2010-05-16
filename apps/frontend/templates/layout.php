<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<title>
    <?php if (!include_slot('title')): ?>
    	Кукурудза - Лучшие фильмы и сериалы
  	<?php endif; ?>
	</title>
	<?php use_javascript('all.js?v=1.0.1') ?>
	<?php use_stylesheet('all.css?v=1.0.1') ?>
	
	<?php include_http_metas() ?>
    <?php include_metas() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<link rel="alternate" type="application/atom+xml" title="Atom"  href="<?php echo url_for('@film_types_all_atom', true) ?>" />
	<link title="RSS" type="application/rss+xml" rel="alternate" href="<?php echo url_for('@film_types_all_rss', true) ?>"/>
	
	<link rel="default-slice" type="application/x-hatom" href="#CooCooSlice" />
	
    <?php include_stylesheets() ?>
    <!--[if lte IE 6]>
        <?php echo stylesheet_tag("ie6")?>
    <![endif]-->
    
    <!--[if IE 7]>
       <?php echo stylesheet_tag("ie7")?>
    <![endif]-->
    
	<?php include_javascripts() ?>
  </head>
  <body>
    <div id="supervisor">
    	<div id="supervisor2">
		    <!--HEADER-->
		   	<?php include_partial('global/header') ?>
			<!--HEADER-->
			<?php if (has_slot('top_content')): ?>
				<div id="top_add">
		  			<?php include_slot('top_content') ?>
				</div>
			<?php endif ?>
			<!--FLASH-->
			<?php if ($sf_user->hasFlash('confirm')): ?>
				<div id="flash_success" class="success">
					<div><?php echo $sf_user->getFlash('confirm') ?></div>
				</div>
			<?php endif; ?>
			<?php if ($sf_user->hasFlash('error')): ?>
				<div id="flash_error" class="error">
					<div><?php echo $sf_user->getFlash('error') ?></div>
				</div>
			<?php endif; ?>
			<!--FLASH-->
		<div id="content_body">
			<div id="sidebar">	
				<?php include_partial('global/right_panel') ?>
			</div>
			<div id="content">
				<?php echo $sf_content ?>
			</div>	
		</div>
		<!--FOOTER-->
	   	<?php include_partial('global/footer') ?>
		<!--FOOTER-->
	</div>
  </div>
  <?php include_partial('global/reject') ?>
  <!--Webslice-->
  <?php include_component('webslice', 'layout') ?>
  <!--Webslice-->
  <?php include_partial('global/google_analytics') ?>
  </body>
</html>
