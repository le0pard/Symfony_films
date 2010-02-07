<div id="menu_1">
	<ul>
		<li>
			<span>Пункт1</span>
		</li>
		<?php foreach($static_pages as $key=>$row): ?>
		<li>
			<a href="<?php echo url_for('static_page', $row) ?>"><?php echo $row->getTitle() ?></a>
		</li>
		<?php endforeach ?>
	</ul>
</div>