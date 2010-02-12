<?php if (isset($form)): ?>

<div id="film_forms">
  <form id="add_comment" action="
<?php if (isset($method) && 'edit' == $method && isset($comment)): ?>
<?php echo url_for('comment_edit', $comment) ?>
<?php elseif (isset($film)): ?>
<?php echo url_for('comment_add', $film) ?>
<?php endif ?>
" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<h2 class="label">Добавить комментарий</h2>
	<div>
		<?php echo $form['description']->renderError(); ?>
        <?php echo $form['description']->render(); ?>
	</div>
	<div class="permited">Разрешены теги: <ul><li>&#60;a&#62;</li><li>&#60;img&#62;</li><li>&#60;i&#62;</li><li>&#60;b&#62;</li><li>&#60;u&#62;</li><li>&#60;em&#62;</li><li>&#60;strong&#62;</li><li>&#60;nobr&#62;</li><li>&#60;li&#62;</li><li>&#60;ol&#62;</li><li>&#60;ul&#62;</li><li>&#60;br&#62;</li><li>&#60;pre&#62;</li><li>&#60;code&#62;</li></ul></div>

	<div class="submit">
		<input class="big" type="submit" value="
		<?php if (isset($method) && 'edit' == $method): ?>
			Редактировать
		<?php else: ?>	
			Добавить
		<?php endif ?>" />
	</div>
  </form>
</div>
<?php else: ?>
<div id="film_forms">
	<h2>Только зарегестрированые пользователи могут коментировать</h2>
</div>
<?php endif ?>
