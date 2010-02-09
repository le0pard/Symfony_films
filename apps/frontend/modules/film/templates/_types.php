<div class="round" id="category_list">
	<div class="r_container">
		<h2 class="top_plate"><a href="<?php echo url_for('@film_types_all') ?>">Жанры фильмов</a></h2>
		<ul>
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