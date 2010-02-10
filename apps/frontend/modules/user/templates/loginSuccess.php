<div id="entrance">
  <h1>Вход на сайт</h1>
  <form action="<?php echo url_for('@user_login') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<div>
	  <?php echo $form['login']->renderLabel(null, array("for" => "login"))?>
	</div>
	<div>
	  <?php echo $form['login']->renderError()?>
	  <?php echo $form['login']->render(array("id" => "login"))?>
	  <div class="tip"><?php echo $form['login']->renderHelp()?></div>
	</div>
	<div>
	  <?php echo $form['password']->renderLabel(null, array("for" => "password"))?>
	</div>
	<div>
	  <?php echo $form['password']->renderError()?>
	  <?php echo $form['password']->render(array("id" => "password"))?>
	  <div class="tip"><?php echo $form['password']->renderHelp()?></div>
	</div>
	<div>
	  <label><?php echo $form['not_remember']->render(array("id" => "not_remember"))?>&nbsp;<?php echo $form['not_remember']->renderLabel(null, array("for" => "not_remember"))?></label>
	</div>
	<div class="submit" >
		<?php if ($form->isCSRFProtected()) : ?> 
			<?php echo $form[$form->getCSRFFieldName()]->render(array("id" => "log_csrf_token")); ?>
		<?php endif ?>
		<input type="submit" class="big" value="Вход" />
	</div>
  </form>

</div>