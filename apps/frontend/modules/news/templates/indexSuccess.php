<div id="entrance">
  <h1>Архив новостей</h1>
  <div id="draft_list">
	<ul>
	<?php foreach($pager->getResults() as $key=>$row): ?>
  		<li>
		<?php include_partial('news/news', array('news' => $row)) ?>
		</li>
	<?php endforeach ?>
	</ul>
  </div>
</div>

<?php if ($pager->haveToPaginate()): ?>
<div class="digg_pagination">
	<?php if (1 == $pager->getPage()): ?>
		<span class="disabled prev_page">&laquo; Сюда</span>
	<?php else: ?>
		<a class="prev_page" href="<?php echo url_for('@news_page_all?page='.$pager->getPreviousPage()) ?>">&laquo; Сюда</a>
	<?php endif ?>

    <?php foreach ($pager->getLinks(15) as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <span class="current"><?php echo $page ?></span>
      <?php else: ?>
        <a href="<?php echo url_for('@news_page_all?page='.$page) ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
 	
	<?php if ($pager->getLastPage() == $pager->getPage()): ?>
		<span class="disabled next_page">Туда &raquo;</span>
	<?php else: ?>
    	<a class="next_page" href="<?php echo url_for('@news_page_all?page='.$pager->getNextPage()) ?>">Туда &raquo;</a>
	<?php endif ?>
    
</div> 
<?php endif; ?>