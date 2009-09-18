<h1>Добавление фильма/сериала</h1>
<?php include_partial('film/add_panel', array('film' => $film)) ?>
<h2>Ссылки к фильму/сериалу &laquo;<?php echo $film->getTitle() ?>&raquo;</h2>
<?php foreach($form->getEmbeddedForms() as $row): ?>
<form action="<?php echo url_for('film_edit_step3', $film) ?>" method="POST" <?php $row->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="links_add_cell">
  		<?php echo $row ?>
  	<tr>
      <td colspan="2">
        <input type="submit" value="Обновить" />
		<a onclick="javascript:return confirm('Действительно удалить ссылку?');" href="<?php echo url_for('film_delete_step3', $row->getObject()) ?>">Удалить</a>
      </td>
    </tr>
  </table>
</form>

<?php endforeach ?>


<?php if (isset($form_add)): ?>
<h2>Добавить ссылку</h2>
<form id="film_add_form_st3_add" action="<?php echo url_for('film_add_step3', $film) ?>" method="POST" <?php $form_add->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="links_add_cell">
  		<?php echo $form_add ?>
  	<tr>
      <td colspan="2">
        <input type="submit" value="Добавить" />
      </td>
    </tr>
  </table>
</form>
<?php else: ?>
<div>
	Максимально возможно указать <?php echo sfConfig::get('app_films_max_links', 100) ?> ссылок.
</div>
<?php endif ?>