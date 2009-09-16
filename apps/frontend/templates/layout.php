<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <!--HEADER-->
   	<?php include_partial('global/header') ?>
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
