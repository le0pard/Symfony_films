<?php use_helper('sfCryptoCaptcha') ?>
<div id="entrance">
  <h1>Восстановление пароля</h1>
  <form action="<?php echo url_for('@user_forgot_pass') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<div><?php echo $form['email']->renderLabel(); ?></div>
	<div>
	    <?php echo $form['email']->renderError(); ?>
        <?php echo $form['email']->render(); ?>
	  <div class="tip"><?php echo $form['email']->renderHelp(); ?></div>
	</div>

	<div><?php echo $form['captcha']->renderLabel(); ?></div>
	<div>
	  <?php echo $form['captcha']->renderError(); ?>
	  <?php echo captcha_image(); echo captcha_reload_button(); ?>
	  <?php echo $form['captcha']->render(); ?>
	  <div class="tip"><?php echo $form['captcha']->renderHelp(); ?></div>

	</div>

	<div class="submit">
		<?php if ($form->isCSRFProtected()) : ?> 
	  	  <?php echo $form[$form->getCSRFFieldName()]->render(); ?>
	    <?php endif ?>
		<input  class="big" type="submit" value="Напомнить пароль" />
	</div>

  </form>
</div>