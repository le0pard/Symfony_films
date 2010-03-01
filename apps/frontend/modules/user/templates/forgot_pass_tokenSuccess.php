<div id="entrance">
  <h1>Смена пароля</h1>
  <form action="<?php echo url_for('user_forgot_pass_token', $user) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>

	<div><?php echo $form['password']->renderLabel(); ?></div>
	<div>
	    <?php echo $form['password']->renderError(); ?>
        <?php echo $form['password']->render(); ?>
	  <div class="tip"><?php echo $form['password']->renderHelp(); ?></div>
	</div>

	<div><?php echo $form['password_confirmation']->renderLabel(); ?></div>
	<div>
	    <?php echo $form['password_confirmation']->renderError(); ?>
        <?php echo $form['password_confirmation']->render(); ?>
	  <div class="tip"><?php echo $form['password_confirmation']->renderHelp(); ?></div>
	</div>

	<div class="submit">
		<?php if ($form->isCSRFProtected()) : ?> 
	  	  <?php echo $form[$form->getCSRFFieldName()]->render(); ?>
	    <?php endif ?>
		<input  class="css_button" type="submit" value="Сменить пароль" />
	</div>

  </form>
</div>