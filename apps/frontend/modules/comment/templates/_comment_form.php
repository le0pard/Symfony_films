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
		<?php if ($form->isCSRFProtected()) : ?> 
	  	  <?php echo $form[$form->getCSRFFieldName()]->render(); ?>
	    <?php endif ?>
		<?php echo $form['description']->renderError(); ?>
        <?php echo $form['description']->render(); ?>
	</div>
	<div class="permited">Разрешены теги: <ul><li>&#60;a&#62;</li><li>&#60;img&#62;</li><li>&#60;i&#62;</li><li>&#60;b&#62;</li><li>&#60;u&#62;</li><li>&#60;em&#62;</li><li>&#60;strong&#62;</li><li>&#60;nobr&#62;</li><li>&#60;li&#62;</li><li>&#60;ol&#62;</li><li>&#60;ul&#62;</li><li>&#60;br&#62;</li><li>&#60;pre&#62;</li><li>&#60;code&#62;</li></ul></div>

	<div class="comments_submit">
		<?php if (isset($method) && 'edit' == $method): ?>
			<input class="css_button" type="submit" value="Редактировать" />
		<?php else: ?>	
			<input class="css_button" type="submit" value="Добавить" />
		<?php endif ?>
	</div>
  </form>
</div>
<?php else: ?>
<div id="film_forms">
	<h3 style="margin-bottom:50px;">Только зарегестрированые пользователи могут коментировать</h3>
</div>
<?php endif ?>
