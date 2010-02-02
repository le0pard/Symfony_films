<?php use_helper('sfCryptoCaptcha') ?>
<h1>Напомнить пароль</h1>
<form action="<?php echo url_for('@user_forgot_pass') ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <?php if ($form->isCSRFProtected()) : ?> 
  	<?php echo $form[$form->getCSRFFieldName()]->render(); ?>
  <?php endif ?>
  <table class="table_form">
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
      <td colspan="2">
        <input type="submit" value="Напомнить пароль" />
      </td>
    </tr>
  </table>
</form>