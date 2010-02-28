<?php slot('title') ?>
  <?php echo sprintf('%s / %s (%s) - Coocoorooza', $film->getTitle(), $film->getOriginalTitle(), $film->getPubYear()) ?>
<?php end_slot(); ?>

<?php if($sf_user->hasCredential(array('admin', 'super_admin'), false)): ?>
	<a href="<?php echo url_for('film_edit_step1', $film) ?>">Редактировать</a>
<?php endif ?>
<?php include_partial('film/film_main', array('film' => $film, 'sf_cache_key' => $film->getId())) ?>

<?php include_partial('film/rating', array('film' => $film, 'sf_cache_key' => $film->getId())) ?>

<?php include_component('comment', 'comment_form', array('film' => $film)) ?>

<a name="comments"></a>
<?php include_partial('comment/comment_list', array('comments' => $pager, 'film' => $film)) ?>
