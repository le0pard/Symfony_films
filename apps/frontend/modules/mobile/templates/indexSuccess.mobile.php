<p id="top-menu" class="top_menu">
<span>&laquo;</span> 
<span class="next">
	<a title="Фильмы" href="<?php echo url_for('@homepage_mobile') ?>">Фильмы</a>
</span> 
<span>|</span> 
<span class="prev">
	<a title="Афиша" href="<?php echo url_for('@mobile_afisha') ?>">Афиша</a>
</span> 
<span>&raquo;</span>
</p>
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
				<a href="<?php echo url_for('@films_mobile?page='.$pager->getNextPage()) ?><?php if (isset($city_id_params)):?>?city_id=<?php echo $city_id_params ?><?php endif ?>">Назад</a>
			<?php endif ?>
		</span>
		<span>|</span>
		<span class="prev">
			<?php if (1 != $pager->getPage()): ?>
				<a href="<?php echo url_for('@films_mobile?page='.$pager->getPreviousPage()) ?><?php if (isset($city_id_params)):?>?city_id=<?php echo $city_id_params ?><?php endif ?>">Вперед</a>
			<?php endif ?>
		</span>
		<span>&raquo;</span>
		</li>
		<?php endif; ?>
	</ul>
</div><!--#content-->