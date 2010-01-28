<?php use_helper('Trailer') ?>

<h1>Добавление фильма/сериала</h1>
<?php include_partial('film/add_panel', array('film' => $film)) ?>
<h2>Трейлеры к фильму/сериалу &laquo;<?php echo $film->getTitle() ?>&raquo;</h2>
<input type="hidden" id="js_add_film_id" value="<?php echo $film->getId() ?>" />
<?php if (isset($form)): ?>
<h2>Добавить трейлер</h2>
<form id="film_add_form_st4_add" action="<?php echo url_for('film_add_step4', $film) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form table_form_big">
  		<?php echo $form ?>
  	<tr>
      <td colspan="2">
        <input type="submit" value="Добавить" />
      </td>
    </tr>
  </table>
</form>
<?php else: ?>
<div>
	Максимально возможно добавить <?php echo sfConfig::get('app_films_max_trailers', 3) ?> трейлера.
</div>
<?php endif ?>

<h2>Список трейлеров</h2>
<ul id="add_trailer_list">
<?php foreach($forms->getEmbeddedForms() as $row): ?>
<li id="trailer_<?php echo $row->getObject()->getId() ?>">
<div class="sort_cursor">Сортировать</div>
<form action="<?php echo url_for('film_edit_step4', $film) ?>" method="POST" <?php $row->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form table_form_big">
  		<?php echo $row ?>
  	<tr>
      <td colspan="2">
        <input type="submit" value="Обновить" />
        <?php echo preview_trailer_link($row->getObject()) ?><br />
		<a onclick="javascript:return confirm('Действительно удалить трейлер?');" href="<?php echo url_for('film_delete_step4', $row->getObject()) ?>">Удалить</a>
      </td>
    </tr>
  </table>
</form>
</li>
<?php endforeach ?>
</ul>