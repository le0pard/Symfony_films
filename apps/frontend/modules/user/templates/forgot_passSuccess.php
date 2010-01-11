<h1>Напомнить пароль</h1>
<form action="<?php echo url_for('@user_forgot_pass') ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Напомнить пароль" />
      </td>
    </tr>
  </table>
</form>