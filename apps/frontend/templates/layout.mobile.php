<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<title>
    <?php if (!include_slot('title')): ?>
    	Кукурудза - Лучшие фильмы и сериалы
  	<?php endif; ?>
	</title>
	<?php /* use_javascript('all.js') ?>
	<?php use_stylesheet('all.css') */?>
	
	<?php include_http_metas() ?>
    <?php include_metas() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
	<?php include_javascripts() ?>
  </head>
  <body>
	<?php echo $sf_content ?>
  </body>
</html>
