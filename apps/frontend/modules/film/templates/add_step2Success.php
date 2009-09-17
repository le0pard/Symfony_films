<h1>Добавление фильма/сериала</h1>
<?php include_partial('film/add_panel', array('film' => $film)) ?>
<h2>Галерея к фильму &laquo;<?php echo $film->getTitle() ?>&raquo;</h2>
<?php foreach($form->getEmbeddedForms() as $row): ?>
<form action="<?php echo url_for('film_edit_step2', $film) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <div class="gallery_main_cell">
  		<?php echo $row['thumb_img']->renderError() ?>
  		<?php echo $row['id']->render(); ?>
  		<?php echo $row['film_id']->render(); ?>
  		<?php echo $row['thumb_img']->render(); ?>
  	<div class="buttons">
    	<input type="submit" value="Обновить" />
		<?php echo $row['thumb_img']->renderHelp() ?>
	</div>
	<div class="clear"></div>
  </div>
</form>

<?php endforeach ?>


<?php if (isset($form_add)): ?>
<h2>Добавить скриншот</h2>
<form id="film_add_form_st2_add" action="<?php echo url_for('film_add_step2', $film) ?>" method="POST" <?php $form_add->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <div class="gallery_add_cell">
  		<?php echo $form_add['thumb_img']->renderError() ?>
  		<?php echo $form_add['film_id']->render(); ?>
  		<?php echo $form_add['thumb_img']->render(); ?>
  	<div class="buttons">
    	<input type="submit" value="Добавить" />
	</div>
	<div class="clear"></div>
  </div>
</form>
<?php else: ?>
<div>
	Максимально возможно загрузить <?php echo sfConfig::get('app_films_max_gallery', 10) ?> скриншотов.
</div>
<?php endif ?>