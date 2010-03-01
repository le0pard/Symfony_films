<?php use_javascript('yui/yuiloader-dom-event/yuiloader-dom-event.js') ?>
<?php use_javascript('yui/element/element-min.js') ?>
<?php use_javascript('yui/uploader/uploader-min.js') ?>
<?php use_javascript('uploader.js', 'last') ?>
<input type="hidden" id="js_add_film_id" value="<?php echo $film->getId() ?>" />
<div id="entrance">
  <h1>Скриншоты к &laquo;<?php echo $film->getTitle() ?>&raquo;</h1>
  <?php include_partial('film/add_panel', array('film' => $film)) ?>
  
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
  <?php if (isset($form_add)): ?>
  <form id="film_add_form_st2_add" action="<?php echo url_for('film_add_step2', $film) ?>" method="post" <?php $form_add->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<div class="rows"><?php echo $form_add['thumb_img']->renderLabel() ?><br />
	    <?php echo $form_add['thumb_img']->renderError() ?>
  		<?php echo $form_add['film_id']->render(); ?>
  		<?php echo $form_add['thumb_img']->render(); ?>
  		<?php if ($form_add->isCSRFProtected()) : ?> 
  			<?php echo $form_add[$form_add->getCSRFFieldName()]->render(); ?>
  		<?php endif ?>
  		&nbsp;<input class="css_button" type="submit" value="Загрузить" />
	  <div class="tip"><?php echo $form_add['thumb_img']->renderHelp(); ?></div>
	</div>
  </form>
  <?php else: ?>
  <div>
  	<h2>Максимально возможно загрузить <?php echo sfConfig::get('app_films_max_gallery', 10) ?> скриншотов.</h2>
  </div>
  <?php endif ?>
  
  <ul id="add_gallery_list" class="add_list">
    <?php foreach($form->getEmbeddedForms() as $key=>$row): ?>
	<li id="gallery_<?php echo $row->getObject()->getId() ?>">
		<a class="drag_right">
			<img title="Сортировать" src="/images/drag1.gif" alt="Сортировать" />
		</a>
		<form action="<?php echo url_for('film_edit_step2', $film) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
			<div class="rows">
		  		<?php echo $row['thumb_img']->renderError() ?>
		  		<?php echo $row['id']->render(); ?>
		  		<?php echo $row['film_id']->render(); ?>
			  <?php echo $row['thumb_img']->render() ?>
			</div>
		</form>
	</li>
	<?php endforeach ?>
  </ul>

  <div class="add_film_listers">
  	<a class="css_button l" href="<?php echo url_for('film_edit_step1', $film) ?>"><span>Назад</span></a>
  	<a class="css_button" href="<?php echo url_for('film_add_step3', $film) ?>"><span>Дальше</span></a>
  </div>

</div>