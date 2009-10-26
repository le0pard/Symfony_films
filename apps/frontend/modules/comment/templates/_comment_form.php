<hr />
<?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php if (isset($form)): ?>
<form id="comment_add" action="
<?php if (isset($method) && 'edit' == $method && isset($comment)): ?>
<?php echo url_for('comment_edit', $comment) ?>
<?php else: ?>
<?php echo url_for('@comment_add') ?>
<?php endif ?>
" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<table class="table_form table_form_big">		
		<?php echo $form; ?>
	<?php if (isset($method) && 'edit' == $method): ?>	
	<tr>
      <td colspan="2">
        <input type="submit" value="Редактировать" />
      </td>
    </tr>
	<?php else: ?>
	<tr>
      <td colspan="2">
        <input type="submit" value="Добавить" />
      </td>
    </tr>
	<?php endif ?>
  </table>
</form>
<?php else: ?>
<div>
	Только зарегестрированые пользователи могут коментировать
</div>
<?php endif ?>
