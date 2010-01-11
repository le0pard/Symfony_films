<h1>Сменить пароль</h1>
<form action="<?php echo url_for('user_forgot_pass_token', $user) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Сменить пароль" />
      </td>
    </tr>
  </table>
</form>