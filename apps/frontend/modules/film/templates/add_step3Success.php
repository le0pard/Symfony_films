<div id="entrance">
  <h1>Ссылки к фильму/сериалу &laquo;<?php echo $film->getTitle() ?>&raquo;</h1>
  <?php include_partial('film/add_panel', array('film' => $film)) ?>
  <input type="hidden" id="js_add_film_id" value="<?php echo $film->getId() ?>" />
  <div class="clearfix">
  	<?php if (isset($form_add)): ?>
  	<form id="film_add_form_st3_add" action="<?php echo url_for('film_add_step3', $film) ?>" method="post" <?php $form_add->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	  <div class="form_body">
		<fieldset>
		  <legend>Добавить ссылку</legend>
		  <?php echo $form_add['title']->renderLabel() ?>
		  <?php echo $form_add['title']->renderError() ?>
		  <?php echo $form_add['title']->render() ?>
		  <?php echo $form_add['url']->renderLabel() ?>
		  <?php echo $form_add['url']->renderError() ?>
		  <?php echo $form_add['url']->render() ?>
		  
		  <?php echo $form_add['id']->render() ?>
	  	  <?php if ($form_add->isCSRFProtected()) : ?> 
  			<?php echo $form_add[$form_add->getCSRFFieldName()]->render(); ?>
  		  <?php endif ?>
		  <input class="css_button" type="submit" value="Добавить" />
		</fieldset>
	  </div>
	</form>
	<div class="form_info">
	  <h3>Что с этим делать?</h3>
	  <p>
		Укажите адрес ссылки для скачивания (будь то адрес файла на файлообменнике, прямая ссылка на файл, ftp или магнитная ссылка) и замещающий текст.
	  </p>
	</div>
	<?php else: ?>
	<div>
		<h2>Максимально возможно указать <?php echo sfConfig::get('app_films_max_links', 100) ?> ссылок.</h2>
	</div>
	<?php endif ?>
  </div>
  
  <ul id="add_link_list"  class="add_list">
	<?php foreach($form->getEmbeddedForms() as $row): ?>
	<li id="link_<?php echo $row->getObject()->getId() ?>">
	<form action="<?php echo url_for('film_edit_step3', $film) ?>" method="POST" <?php $row->isMultipart() and print 'enctype="multipart/form-data"' ?>>
		<div class="rows">
			<div>
	  	   	  <?php echo $row['title']->renderLabel() ?>
	  	   	  	<a class="drag_right">
					<img title="Сортировать" src="/images/drag1.gif" alt="Сортировать" />
				</a>
			  <?php echo $row['title']->renderError() ?>
			  <?php echo $row['title']->render() ?>
			  <?php echo $row['url']->renderLabel() ?>
			  <?php echo $row['url']->renderError() ?>
			  <?php echo $row['url']->render() ?>
			  
			  <?php echo $row['id']->render() ?>
		  	  <?php if ($row->isCSRFProtected()) : ?> 
	  			<?php echo $row[$row->getCSRFFieldName()]->render(); ?>
	  		  <?php endif ?>
	        <input class="css_button" type="submit" value="Обновить" />
			<a onclick="javascript:return confirm('Действительно удалить ссылку?');" href="<?php echo url_for('film_delete_step3', $row->getObject()) ?>">Удалить</a>
		   </div>	
		</div>	
	</form>
	</li>
	<?php endforeach ?>
  </ul>
  
  <div class="add_film_listers">
  	<a class="css_button l" href="<?php echo url_for('film_edit_step2', $film) ?>"><span>Назад</span></a>
  	<a class="css_button" href="<?php echo url_for('film_add_step4', $film) ?>"><span>Дальше</span></a>
  </div>

</div>