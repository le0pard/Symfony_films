<?php slot('title') ?>
  <?php echo sprintf('%s - %s', $film_type->getTitle(), 'Coocoorooza') ?>
<?php end_slot(); ?>

<?php include_partial('film_types/cathegory', array('cathegory' => $film_type)) ?>

<div id="cat_films">
	<h1 class="label"><?php echo $film_type->getTitle()?></h1>
	<?php foreach($pager->getResults() as $key=>$row): ?>
		<?php include_partial('film/film', array('film' => $row->getFilm())) ?>
	<?php endforeach ?>
		
<?php if ($pager->haveToPaginate()): ?>
<div class="digg_pagination">
	<?php if (1 == $pager->getPage()): ?>
		<span class="disabled prev_page">&laquo; Сюда</span>
	<?php else: ?>
		<a class="prev_page" href="<?php echo url_for('film_types', $film_type) ?>?page=<?php echo $pager->getPreviousPage() ?>">&laquo; Сюда</a>
	<?php endif ?>

    <?php foreach ($pager->getLinks(15) as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <span class="current"><?php echo $page ?></span>
      <?php else: ?>
        <a href="<?php echo url_for('film_types', $film_type) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
 	
	<?php if ($pager->getLastPage() == $pager->getPage()): ?>
		<span class="disabled next_page">Туда &raquo;</span>
	<?php else: ?>
    	<a class="next_page" href="<?php echo url_for('film_types', $film_type) ?>?page=<?php echo $pager->getNextPage() ?>">Туда &raquo;</a>
	<?php endif ?>
    
</div> 
<?php endif; ?>
</div>