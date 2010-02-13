<div class="author">
<img src="/uploads/avatars/<?php echo $comment->getUsers()->getViewAvatar()?>" alt="<?php echo $comment->getUsers()->getLogin()?>" />
<a href="<?php echo url_for('user_show', $comment->getUsers()) ?>"><?php echo $comment->getUsers()->getLogin()?></a>
</div>
<div class="round comment">
	<div class="r_container">
	  <div class="date">Опубликован: <?php echo strftime('%d.%m.%Y %H:%M', $comment->getCreatedAt('U')) ?></div>
	  <div class="text"><?php echo System::jevix_def($comment->getDescription(ESC_RAW)); ?></div>
	  <?php if($sf_user->hasCredential(array('admin', 'super_admin'), false)): ?>
	  <div>
			IP: <?php echo $comment->getIp()?><br />
			<a href="<?php echo url_for('comment_edit', $comment) ?>">Редактировать</a>
			<a onclick="javascript:return confirm('Действительно удалить коментарий?');" href="<?php echo url_for('comment_delete', $comment) ?>">Удалить</a>
	  </div>
	  <?php endif ?>
	</div>
</div>
