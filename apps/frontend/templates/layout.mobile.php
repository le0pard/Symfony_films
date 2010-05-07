<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN"
  "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?php if (!include_slot('title')): ?>Кукурудза - Лучшие фильмы и сериалы<?php endif; ?></title>
<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
<meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport" />
	<?php /* use_javascript('all.js')*/ ?>
	<?php use_stylesheet('mobile.css') ?>
	<?php include_http_metas() ?>
    	<?php include_metas() ?>
    	<link rel="shortcut icon" href="/favicon.ico" />
    	<?php include_stylesheets() ?>
	<?php include_javascripts() ?>
	<style type="text/css">
		@import url(/css/mobile_adv.css);
	</style>
	<script type="text/javascript">
	<!--
		CFMOBI_IS_PAGE = false;	
		CFMOBI_PAGES_TAB = 'Pages';	
		CFMOBI_POSTS_TAB = 'Recent Posts';	
		var CFMOBI_TOUCH = ["iPhone","iPod","Android","BlackBerry9530","LG-TU915 Obigo","LGE VX","webOS","Nokia5800"];
		for (var i = 0; i < CFMOBI_TOUCH.length; i++) {
			if (navigator.userAgent.indexOf(CFMOBI_TOUCH[i]) != -1) {
				document.write('<link rel="stylesheet" href="/css/mobile_touch.css" type="text/css" media="screen" charset="utf-8" />');
				break;
			}
		}
	 
	//-->
	</script>
</head>
<body id="is-list">
	<!--HEADER-->
   	<?php include_partial('global/header') ?>
	<!--HEADER-->
	<?php echo $sf_content ?>
	<hr />
	<div class="group">
		<form method="get" action="http://leopard.in.ua" id="search">
			<div>
				<input type="text" value="" id="s" name="s" />
				<input type="submit" value="Search" name="submit_button" />
			</div>
		</form>
	</div>
	<!--FOOTER-->
   	<?php include_partial('global/footer') ?>
	<!--FOOTER-->
</body>
</html>
