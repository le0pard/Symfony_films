<div id="content">
	<ul class="disclosure table group">
		<?php foreach($pager->getResults() as $key=>$row): ?>
			<?php include_partial('mobile/film_link', array('film' => $row)) ?>
		<?php endforeach ?>	
		<?php if ($pager->haveToPaginate()): ?>
		<li class="pagination">
		<span>&laquo;</span>
		<span class="next">
			<?php if ($pager->getLastPage() != $pager->getPage()): ?>
				<a href="<?php echo url_for('@films_mobile?page='.$pager->getNextPage()) ?>">Назад</a>
			<?php endif ?>
		</span>
		<span>|</span>
		<span class="prev">
			<?php if (1 != $pager->getPage()): ?>
				<a href="<?php echo url_for('@films_mobile?page='.$pager->getPreviousPage()) ?>">Вперед</a>
			<?php endif ?>
		</span>
		<span>&raquo;</span>
		</li>
		<?php endif; ?>
	</ul>
</div><!--#content-->