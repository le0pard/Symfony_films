<ul>
<?php foreach($static_pages as $key=>$row): ?>
	<li>
		<a href="<?php echo url_for('static_page', $row) ?>"><?php echo $row->getTitle() ?></a>
	</li>
<?php endforeach ?>
</ul>