<h1>Добавление фильма/сериала</h1>
<?php include_partial('film/add_panel', array('film' => $film)) ?>
<h2>Галерея к фильму &laquo;<?php echo $film->getTitle() ?>&raquo;</h2>
<form id="film_add_form_st2" action="<?php echo url_for('film_edit_step2', $film) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_gallery_add">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Обновить" />
      </td>
    </tr>
  </table>
</form>
<?php if (isset($form_add)): ?>
<h2>Добавить скриншот</h2>
<form id="film_add_form_st2_add" action="<?php echo url_for('film_add_step2', $film) ?>" method="POST" <?php $form_add->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_gallery_add">
    <?php echo $form_add ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Добавить" />
      </td>
    </tr>
  </table>
</form>
<?php else: ?>
<div>Максимально возможно загрузить <?php echo sfConfig::get('app_films_max_gallery', 10) ?> скриншотов.</div>
<?php endif ?>