<?php foreach($films as $key=>$row): ?>
	<?php include_partial('film/film', array('film' => $row)) ?>
<?php endforeach ?>