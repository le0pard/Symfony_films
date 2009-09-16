<h1>Регистрация</h1>
<form id="registration_form" action="<?php echo url_for('@user_registration') ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Регистрировать" />
      </td>
    </tr>
  </table>
</form>