<div id="entrance">
  <h1>Редактировать &laquo;<?php echo $film->getTitle() ?>&raquo;</h1>
  <?php include_partial('film/add_panel', array('film' => $film)) ?>
  <form id="film_edit_form_st1" action="<?php echo url_for('film_edit_step1', $film) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
    <?php include_partial('film/film_form', array('form' => $form)) ?>

	<div class="add_film_listers">
		<?php if ($form->isCSRFProtected()) : ?> 
			<?php echo $form[$form->getCSRFFieldName()]->render(); ?>
		<?php endif ?>
		<input class="big l" type="submit" value="Обновить" />
		<a class="l" onclick="javascript: return confirm('Вы уверены, что хотите удалить &laquo;<?php echo $film->getTitle() ?>&raquo; ?');" href="<?php echo url_for('film_delete_step1', $film) ?>">Удалить</a>
		<a class="a_buttons" href="<?php echo url_for('film_add_step2', $film) ?>"><span>Дальше</span></a>
	</div>
  </form>
</div>