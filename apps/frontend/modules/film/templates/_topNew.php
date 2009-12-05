<h2>Новинки</h2>
<div>
<?php foreach($films as $key=>$row): ?>
	<?php include_partial('film/film', array('film' => $row)) ?>
<?php endforeach ?>
</div>
<div class="clear"></div>