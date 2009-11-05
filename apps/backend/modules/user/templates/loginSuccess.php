<h1>Вход на сайт</h1>
<form action="<?php echo url_for('@user_login') ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Вход" />
      </td>
    </tr>
  </table>
</form>