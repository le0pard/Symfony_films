<div id="menu_1">
	<ul>
		<?php foreach($static_pages as $key=>$row): ?>
		<li>
			<?php if ('show' == $sf_params->get('action') && 'static' == $sf_params->get('module') && $row->getId() == $sf_params->get('id')):?>
				<span><?php echo $row->getTitle() ?></span>
			<?php else:?>
				<a href="<?php echo url_for('static_page', $row) ?>"><?php echo $row->getTitle() ?></a>
			<?php endif ?>
		</li>
		<?php endforeach ?>
	</ul>
</div>