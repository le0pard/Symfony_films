<h1>Все последние комментарии</h1>
<div id="comments">
  <ul>
    <?php foreach($comments->getResults() as $comment): ?>
    <li>
    	<h3>К фильму «<a href="<?php echo url_for('film_show', $comment->getFilm()) ?>"><?php echo $comment->getFilm()->getTitle()?></a>»</h3>
		<?php include_partial('comment/comment_one', array('comment' => $comment)) ?>
	</li>		
	<?php endforeach ?>
  </ul>
</div>

<?php if ($comments->haveToPaginate()): ?>
<div class="digg_pagination">
	<div class="page_info">
	  <strong><?php echo $comments->getNbResults() ?></strong> всего 
	  <?php if ($comments->haveToPaginate()): ?>
	    - страница <strong><?php echo $comments->getPage() ?>/<?php echo $comments->getLastPage() ?></strong>
	  <?php endif; ?>
	</div>
	<?php if (1 == $comments->getPage()): ?>
		<span class="disabled prev_page">&laquo; Сюда</span>
	<?php else: ?>
		<a class="prev_page" href="<?php echo url_for('@comments_last_list') ?>?page=<?php echo $comments->getPreviousPage() ?>">&laquo; Сюда</a>
	<?php endif ?>

    <?php foreach ($comments->getLinks(10) as $page): ?>
      <?php if ($page == $comments->getPage()): ?>
        <span class="current"><?php echo $page ?></span>
      <?php else: ?>
        <a href="<?php echo url_for('@comments_last_list') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
 	
	<?php if ($comments->getLastPage() == $comments->getPage()): ?>
		<span class="disabled next_page">Туда &raquo;</span>
	<?php else: ?>
    	<a class="next_page" href="<?php echo url_for('@comments_last_list') ?>?page=<?php echo $comments->getNextPage() ?>">Туда &raquo;</a>
	<?php endif ?>
    
</div> 
<?php endif; ?>
