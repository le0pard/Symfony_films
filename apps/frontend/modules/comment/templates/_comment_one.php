<div style="margin:5px;">
<?php echo System::jevix_def($comment->getDescription(ESC_RAW)); ?>
</div>
<?php if($sf_user->hasCredential(array('admin', 'super_admin'), false)): ?>
	IP: <?php echo $comment->getIp()?><br />
	<a href="<?php echo url_for('comment_edit', $comment) ?>">Редактировать</a>
	<a onclick="javascript:return confirm('Действительно удалить коментарий?');" href="<?php echo url_for('comment_delete', $comment) ?>">Удалить</a>
<?php endif ?>