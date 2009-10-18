<?php use_helper('sfCryptoCaptcha'); ?>
<h1>sfCryptoCaptcha Demo Form</h1>
<p><?php echo $form->getErrorSchema(); ?></p>
<form action="<?php echo url_for('sfCryptoCaptcha/captchaDemo') ?>" method="POST">
  <table>
    <tr>
      <th><?php echo $form['captcha']->renderLabel(); ?></th>
      <td>
        <?php echo $form['captcha']->render(); ?>
      </td>
      <td><?php echo captcha_image(); echo captcha_reload_button(); ?></td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <td colspan="2">
        <?php
          if($good == true)
          {
            echo '<span style="color:green; font-weight:bold;">Good captcha!</span>';
          }
        ?>
      </td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <td colspan="2">
        <?php echo $form['_csrf_token']->render(); ?>
        <input type="submit" value="Send" />
      </td>
    </tr>
  </table>
</form>
