<div class="right_card">
	<div class="header">
		Категории фильмов
	</div>
	<ul>
	<li>
		<a href="<?php echo url_for('@film_types_all') ?>">
			Все
		</a>
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
