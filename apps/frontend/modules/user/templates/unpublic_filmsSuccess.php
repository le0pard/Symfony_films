<ul>
<?php foreach($film_list as $row): ?>
	<li>
		<a href="<?php echo url_for('film_edit_step1', $row) ?>"><?php echo $row->getTitle(); ?></a>
	</li>
<?php endforeach ?>
</ul>