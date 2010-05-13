<?php slot('title') ?>Поиск - Coocoorooza<?php end_slot(); ?>
<div id="content">
	<ul class="disclosure table group">
<?php if ('sphinx' == sfConfig::get('app_search_method') && isset($pager) && isset($sphinx)): ?>
	<?php foreach($pager->getResults() as $key=>$row): ?>
		<?php include_partial('search/search_row', array('row' => $row, 'query' => $query)) ?>
	<?php endforeach ?>
<?php else: ?>
	<?php foreach($search_res as $row): ?>
		<?php include_partial('search/search_row', array('row' => $row, 'query' => $query)) ?>
	<?php endforeach ?>
<?php endif ?>
	</ul>
</div>