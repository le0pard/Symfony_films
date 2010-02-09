<div id="new">
	<h1 class="label">Новинки кино и сериалов</h1>
	<?php foreach($films as $key=>$row): ?>
		<?php include_partial('film/film', array('film' => $row)) ?>
	<?php endforeach ?>
</div>