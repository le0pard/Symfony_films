<div class="content_title">
	12
</div>

<?php if ($pager->haveToPaginate()): ?>
<div class="digg_pagination">
	<div class="page_info">
	  <strong><?php echo $pager->getNbResults() ?></strong> всего 
	  <?php if ($pager->haveToPaginate()): ?>
	    - страница <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
	  <?php endif; ?>
	</div>
	<?php if (1 == $pager->getPage()): ?>
		<span class="disabled prev_page">&laquo; Сюда</span>
	<?php else: ?>
		<a class="prev_page" href="<?php echo url_for('@homepage') ?>?page=<?php echo $pager->getPreviousPage() ?>">&laquo; Сюда</a>
	<?php endif ?>

    <?php foreach ($pager->getLinks(15) as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <span class="current"><?php echo $page ?></span>
      <?php else: ?>
        <a href="<?php echo url_for('@homepage') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
 	
	<?php if ($pager->getLastPage() == $pager->getPage()): ?>
		<span class="disabled next_page">Туда &raquo;</span>
	<?php else: ?>
    	<a class="next_page" href="<?php echo url_for('@homepage') ?>?page=<?php echo $pager->getNextPage() ?>">Туда &raquo;</a>
	<?php endif ?>
    
</div> 
<div class="clear"></div> 
<?php endif; ?>

<?php foreach($pager->getResults() as $key=>$row): ?>
	<?php include_partial('film/film', array('film' => $row)) ?>
<?php endforeach ?>

<div class="clear"></div>

<?php if ($pager->haveToPaginate()): ?>
<div class="digg_pagination">
	<div class="page_info">
	  <strong><?php echo $pager->getNbResults() ?></strong> всего 
	  <?php if ($pager->haveToPaginate()): ?>
	    - страница <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
	  <?php endif; ?>
	</div>
	<?php if (1 == $pager->getPage()): ?>
		<span class="disabled prev_page">&laquo; Сюда</span>
	<?php else: ?>
		<a class="prev_page" href="<?php echo url_for('@homepage') ?>?page=<?php echo $pager->getPreviousPage() ?>">&laquo; Сюда</a>
	<?php endif ?>

    <?php foreach ($pager->getLinks(15) as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <span class="current"><?php echo $page ?></span>
      <?php else: ?>
        <a href="<?php echo url_for('@homepage') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
 	
	<?php if ($pager->getLastPage() == $pager->getPage()): ?>
		<span class="disabled next_page">Туда &raquo;</span>
	<?php else: ?>
    	<a class="next_page" href="<?php echo url_for('@homepage') ?>?page=<?php echo $pager->getNextPage() ?>">Туда &raquo;</a>
	<?php endif ?>
    
</div> 
<div class="clear"></div> 
<?php endif; ?>