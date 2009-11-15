<?php use_javascript('yui/yuiloader-dom-event/yuiloader-dom-event.js') ?>
<?php use_javascript('yui/element/element-min.js') ?>
<?php use_javascript('yui/uploader/uploader-min.js') ?>
<?php use_javascript('uploader.js', 'last') ?>

<h1>Добавление фильма/сериала</h1>
<?php include_partial('film/add_panel', array('film' => $film)) ?>
<h2>Галерея к фильму &laquo;<?php echo $film->getTitle() ?>&raquo;</h2>
<input type="hidden" id="js_add_film_id" value="<?php echo $film->getId() ?>" />
<?php if (isset($form_add)): ?>
<h2>Добавить скриншот</h2>

<div>
	<a id="upload_gallery_link" href="javascript:;">Мульти-загрузчик</a>
</div>
<div id="upload_gallery_form">
	<div id="dataTableContainer"></div>
	<div id="uiElements">
		<div id="uploaderContainer">
			<div id="uploaderOverlay" style="position:absolute; z-index:2"></div>
			<div id="selectFilesLink" style="z-index:1"><a id="selectLink" href="#">Выбрать скриншоты</a></div>
		</div>
		<div id="uploadFilesLink" style="display:none">
			<input type="button" id="uploadLink" class="upl_button" value="Upload" />
		</div>
	</div>
	<script type="text/javascript">
		var session_name = '<?php echo ini_get('session.name') ?>';
		var session_val = '<?php echo session_id()?>';
	</script>
</div>

<form id="film_add_form_st2_add" action="<?php echo url_for('film_add_step2', $film) ?>" method="POST" <?php $form_add->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <div class="gallery_add_cell">
  		<?php echo $form_add['thumb_img']->renderError() ?>
  		<?php echo $form_add['film_id']->render(); ?>
  		<?php echo $form_add['thumb_img']->render(); ?>
  		<?php if ($form_add->isCSRFProtected()) : ?> 
  			<?php echo $form_add[$form_add->getCSRFFieldName()]->render(); ?>
  		<?php endif ?>
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

<h2>Галерея</h2>
<ul id="add_gallery_list">
<?php foreach($form->getEmbeddedForms() as $row): ?>
<li id="gallery_<?php echo $row->getObject()->getId() ?>">
<div class="sort_cursor">Сортировать</div>
<form action="<?php echo url_for('film_edit_step2', $film) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <div class="gallery_main_cell">
  		<?php echo $row['thumb_img']->renderError() ?>
  		<?php echo $row['id']->render(); ?>
  		<?php echo $row['film_id']->render(); ?>
  		<?php echo $row['thumb_img']->render(); ?>
  		<?php if ($row->isCSRFProtected()) : ?> 
  			<?php echo $row[$row->getCSRFFieldName()]->render(); ?>
  		<?php endif ?>
  	<div class="buttons">
    	<input type="submit" value="Обновить" />
		<?php echo $row['thumb_img']->renderHelp() ?>
	</div>
	<div class="clear"></div>
  </div>
</form>
</li>
<?php endforeach ?>
</ul>