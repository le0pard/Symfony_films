<div id="entrance">
  <h1>Редактирование профиля</h1>
  <form action="<?php echo url_for('@user_profile') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<div>
	  <?php echo $form['website_blog']->renderLabel()?>
	</div>
	<div>
	  <?php echo $form['website_blog']->renderError()?>
	  <?php echo $form['website_blog']->render()?>
	  <div class="tip"><?php echo $form['website_blog']->renderHelp()?></div>
	</div>
	
	<div>
	  <?php echo $form['gender']->renderLabel()?>
	</div>
	<div>
	  <?php echo $form['gender']->renderError()?>
	  <?php echo $form['gender']->render()?>
	  <div class="tip"><?php echo $form['gender']->renderHelp()?></div>
	</div>
	
	<div>
	  <?php echo $form['avatar']->renderLabel()?>
	</div>
	<div>
	  <?php echo $form['avatar']->renderError()?>
	  <?php echo $form['avatar']->render()?>
	  <div class="tip"><br /><?php echo $form['avatar']->renderHelp()?></div>
	</div>

	<div>
	  <?php echo $form['about']->renderLabel()?>
	</div>
	<div class="texter">
	  <?php echo $form['about']->renderError()?>
	  <?php echo $form['about']->render()?>
	  <div class="tip"><?php echo $form['about']->renderHelp()?></div>
	</div>

	<div class="submit texter">
		<?php if ($form->isCSRFProtected()) : ?> 
			<?php echo $form[$form->getCSRFFieldName()]->render(); ?>
		<?php endif ?>
		<input  class="big" type="submit" value="Обновить" />
	</div>

  </form>
  <br />
  	<h1>Изменить пароль</h1>
	<form id="change_pass_form" action="<?php echo url_for('@user_change_password') ?>" method="post" <?php $change_pass_form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	  	<div>
		  <?php echo $change_pass_form['old_password']->renderLabel()?>
		</div>
		<div>
		  <?php echo $change_pass_form['old_password']->renderError()?>
		  <?php echo $change_pass_form['old_password']->render()?>
		  <div class="tip"><?php echo $change_pass_form['old_password']->renderHelp()?></div>
		</div>
		
	  	<div>
		  <?php echo $change_pass_form['password']->renderLabel()?>
		</div>
		<div>
		  <?php echo $change_pass_form['password']->renderError()?>
		  <?php echo $change_pass_form['password']->render()?>
		  <div class="tip"><?php echo $change_pass_form['password']->renderHelp()?></div>
		</div>
		
		<div>
		  <?php echo $change_pass_form['password_confirmation']->renderLabel()?>
		</div>
		<div>
		  <?php echo $change_pass_form['password_confirmation']->renderError()?>
		  <?php echo $change_pass_form['password_confirmation']->render()?>
		  <div class="tip"><?php echo $change_pass_form['password_confirmation']->renderHelp()?></div>
		</div>
		
		<div>
		  <?php echo $change_pass_form['verlihub_change']->renderError()?>
		  <?php echo $change_pass_form['verlihub_change']->render()?>  <?php echo $change_pass_form['verlihub_change']->renderLabel()?>
		</div>

		<div>
		  <?php echo $change_pass_form['jabber_change']->renderError()?>
		  <?php echo $change_pass_form['jabber_change']->render()?> <?php echo $change_pass_form['jabber_change']->renderLabel()?>
		</div>
		
		<div class="submit texter">
			<?php if ($change_pass_form->isCSRFProtected()) : ?> 
				<?php echo $change_pass_form[$change_pass_form->getCSRFFieldName()]->render(); ?>
			<?php endif ?>
			<input  class="big" type="submit" value="Изменить пароль" />
		</div>
	</form>
</div>