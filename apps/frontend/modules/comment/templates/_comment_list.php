<div id="comments">
  <h2 class="label">Комментарии</h2>
  <ul>
  	<?php foreach($comments->getResults() as $comment): ?>
  		<li>
		<?php include_partial('comment/comment_one', array('comment' => $comment)) ?>
		</li>	
	<?php endforeach ?>
  </ul>
</div>

<?php if ($comments->haveToPaginate()): ?>
<div class="digg_pagination">
	<?php if (1 == $comments->getPage()): ?>
		<span class="disabled prev_page">&laquo; Сюда</span>
	<?php else: ?>
		<a class="prev_page" href="<?php echo url_for('film_show', $film) ?>?page=<?php echo $comments->getPreviousPage() ?>">&laquo; Сюда</a>
	<?php endif ?>

    <?php foreach ($comments->getLinks(10) as $page): ?>
      <?php if ($page == $comments->getPage()): ?>
        <span class="current"><?php echo $page ?></span>
      <?php else: ?>
        <a href="<?php echo url_for('film_show', $film) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
 	
	<?php if ($comments->getLastPage() == $comments->getPage()): ?>
		<span class="disabled next_page">Туда &raquo;</span>
	<?php else: ?>
    	<a class="next_page" href="<?php echo url_for('film_show', $film) ?>?page=<?php echo $comments->getNextPage() ?>">Туда &raquo;</a>
	<?php endif ?>
    
</div> 
<?php endif; ?>
