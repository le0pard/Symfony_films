<h1>Редактирование профиля</h1>
<form id="profile_form" action="<?php echo url_for('@user_profile') ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form">
  	<?php echo $form; ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Обновить" />
      </td>
    </tr>
  </table>
</form>

<h1>Изменить пароль</h1>
<form id="change_pass_form" action="<?php echo url_for('@user_change_password') ?>" method="POST" <?php $change_pass_form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form">
  	<?php echo $change_pass_form; ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Изменить пароль" />
      </td>
    </tr>
  </table>
</form>