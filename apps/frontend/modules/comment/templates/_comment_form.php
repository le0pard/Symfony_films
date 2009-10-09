<hr />
<?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php if (isset($form)): ?>
<form id="comment_add" action="<?php echo url_for('@comment_add') ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<table class="table_form table_form_big">		
		<?php echo $form; ?>
	<tr>
      <td colspan="2">
        <input type="submit" value="Добавить" />
      </td>
    </tr>
  </table>
</form>
<?php else: ?>
<div>
	Только зарегестрированые пользователи могут коментировать
</div>
<?php endif ?>
