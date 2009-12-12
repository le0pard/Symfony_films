<?php use_helper('sfCryptoCaptcha') ?>
<h1>Регистрация</h1>
<form id="registration_form" action="<?php echo url_for('@user_registration') ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <?php if ($form->isCSRFProtected()) : ?> 
  	<?php echo $form[$form->getCSRFFieldName()]->render(); ?>
  <?php endif ?>
  <table class="table_form">
  	<tr>
      <th><?php echo $form['login']->renderLabel(); ?></th>
      <td>
        <?php echo $form['login']->renderError(); ?>
        <?php echo $form['login']->render(); ?>
		<?php echo $form['login']->renderHelp(); ?>
      </td>
    </tr>
	<tr>
      <th><?php echo $form['password']->renderLabel(); ?></th>
      <td>
        <?php echo $form['password']->renderError(); ?>
        <?php echo $form['password']->render(); ?>
		<?php echo $form['password']->renderHelp(); ?>
      </td>
    </tr>
	<tr>
      <th><?php echo $form['password_confirmation']->renderLabel(); ?></th>
      <td>
        <?php echo $form['password_confirmation']->renderError(); ?>
        <?php echo $form['password_confirmation']->render(); ?>
		<?php echo $form['password_confirmation']->renderHelp(); ?>
      </td>
    </tr>
	<tr>
      <th><?php echo $form['email']->renderLabel(); ?></th>
      <td>
      	<?php echo $form['email']->renderError(); ?>
        <?php echo $form['email']->render(); ?>
		<?php echo $form['email']->renderHelp(); ?>
	  </td>
    </tr>
	<tr>
      <th><?php echo $form['captcha']->renderLabel(); ?></th>
      <td>
        <?php echo $form['captcha']->renderError(); ?>
		<?php echo captcha_image(); echo captcha_reload_button(); ?><br />
        <?php echo $form['captcha']->render(); ?>
		<?php echo $form['captcha']->renderHelp(); ?>
      </td>
    </tr>
	<tr>
      <th><?php echo $form['rights']->renderLabel(); ?></th>
      <td>
        <?php echo $form['rights']->renderError(); ?>
        <?php echo $form['rights']->render(); ?>
		<?php echo $form['rights']->renderHelp(); ?>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" value="Регистрировать" />
      </td>
    </tr>
  </table>
</form>