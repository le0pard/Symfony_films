<div id="entrance">
  <h1>Добавить фильм / сериал</h1>
  <form id="film_add_form_st1" action="<?php echo url_for('@film_add_step1') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<?php include_partial('film/film_form', array('form' => $form)) ?>

	<div class="add_film_listers">
		<?php if ($form->isCSRFProtected()) : ?> 
			<?php echo $form[$form->getCSRFFieldName()]->render(); ?>
		<?php endif ?>
		<input class="css_button" type="submit" value="Добавить" />
	</div>

  </form>
</div>