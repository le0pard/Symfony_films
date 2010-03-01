<?php use_helper('Trailer') ?>

<div id="entrance">
  <h1>Трейлеры к фильму/сериалу &laquo;<?php echo $film->getTitle() ?>&raquo;</h1>
  <?php include_partial('film/add_panel', array('film' => $film)) ?>
  <input type="hidden" id="js_add_film_id" value="<?php echo $film->getId() ?>" />
  
  <h2>Трейлеры - не обязательны. Вы можете пропустить этот шаг.</h2>
  <p>Для того, чтобы добавить трейлеры, выберите сервис видео-хостинга и вставьте код ролика.</p>
  
  <div class="clearfix">
  	<?php if (isset($form)): ?>
  	<form id="film_add_form_st4_add" action="<?php echo url_for('film_add_step4', $film) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	  <div class="form_body">
		<fieldset>
		  <legend>Добавить трейлер</legend>
		  <?php echo $form['trailer_type']->renderLabel() ?>
		  <?php echo $form['trailer_type']->renderError() ?>
		  <?php echo $form['trailer_type']->render() ?>
		  <?php echo $form['trailer_code']->renderLabel() ?>
		  <?php echo $form['trailer_code']->renderError() ?>
		  <?php echo $form['trailer_code']->render() ?>
		  
		  <?php echo $form['id']->render() ?>
	  	  <?php if ($form->isCSRFProtected()) : ?> 
  			<?php echo $form[$form->getCSRFFieldName()]->render(); ?>
  		  <?php endif ?>
		  <input class="css_button" type="submit" value="Добавить" />
		</fieldset>
	  </div>
	</form>
	<div class="form_info">
	  <ul>
		<li><h3>YouTube</h3>
		  <p>
			Код, это поледние цифры после знака «v=»<br />
			Пример:<br />
			http://www.youtube.com/watch?v=<strong>xdhLQCYQ-nQ</strong><br />
			Нужно вставить то, что выделено.
		  </p></li>
		<li><h3>RuTube</h3>
		  <p>
			Код, это поледние цифры после знака «v=»<br />
			Пример:<br />
			http://rutube.ru/tracks/2975456.html?v=<strong>a429394897438f2249dfbff300e633fc</strong><br />
			Нужно вставить то, что выделено.
		  </p></li>
		<li><h3>Vimeo</h3>
		  <p>
			Код, это поледние цифры после знака «http://vimeo.com/»<br />
			Пример:<br />
			http://vimeo.com/<strong>9736307</strong><br />
			Нужно вставить то, что выделено.
		  </p></li>

	  </ul>
	</div>
	<?php else: ?>
	<div>
		<h2>Максимально возможно добавить <?php echo sfConfig::get('app_films_max_trailers', 3) ?> трейлера.</h2>
	</div>
	<?php endif ?>
  </div>
  
  <ul id="add_trailer_list" class="add_list">
	<?php foreach($forms->getEmbeddedForms() as $row): ?>
	<li id="trailer_<?php echo $row->getObject()->getId() ?>">
	<a class="drag_right">
		<img title="Сортировать" src="/images/drag1.gif" alt="Сортировать" />
	</a>
	<form action="<?php echo url_for('film_edit_step4', $film) ?>" method="POST" <?php $row->isMultipart() and print 'enctype="multipart/form-data"' ?>>
		<div class="rows">
			<div>
	  	   	  <?php echo $row['trailer_type']->renderLabel() ?>
			  <?php echo $row['trailer_type']->renderError() ?>
			  <?php echo $row['trailer_type']->render() ?>
			  <?php echo $row['trailer_code']->renderLabel() ?>
			  <?php echo $row['trailer_code']->renderError() ?>
			  <?php echo $row['trailer_code']->render() ?>
			  
			  <?php echo $row['id']->render() ?>
		  	  <?php if ($row->isCSRFProtected()) : ?> 
	  			<?php echo $row[$row->getCSRFFieldName()]->render(); ?>
	  		  <?php endif ?>
	        <input class="css_button" type="submit" value="Обновить" />
	        <?php echo preview_trailer_link($row->getObject()) ?> 
	        <a onclick="javascript:return confirm('Действительно удалить трейлер?');" href="<?php echo url_for('film_delete_step4', $row->getObject()) ?>">Удалить</a>
		   </div>	
		</div>	
	</form>
	</li>
	<?php endforeach ?>
  </ul>
  
  <div class="add_film_listers">
  	<a class="css_button l" href="<?php echo url_for('film_edit_step3', $film) ?>"><span>Назад</span></a>
  	<a class="css_button" href="<?php echo url_for('film_add_final', $film) ?>"><span>Дальше</span></a>
  </div>
</div>