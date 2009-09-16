<h1>Добавление фильма/сериала</h1>
<?php include_partial('film/add_panel', array('film' => $film)) ?>
<h2>Редактирование данных про фильм &laquo;<?php echo $film->getTitle() ?>&raquo;</h2>
<form id="film_edit_form_st1" action="<?php echo url_for('film_edit_step1', $film) ?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
  <table class="table_form table_form_big">
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Обновить" />
      </td>
    </tr>
  </table>
</form>