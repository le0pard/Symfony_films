<div id="category_list">
	<div class="r_container">
	<ul>
		<li>
			<span>Артхаус</span>
		</li>
		<li>
			<a href="<?php echo url_for('@film_types_all') ?>">Показать все</a>
		</li>
		<?php foreach($film_types as $key=>$row): ?>
		<li>
			<a href="<?php echo url_for('film_types', $row) ?>">
				<?php echo $row->getTitle() ?>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
	</div>
</div>