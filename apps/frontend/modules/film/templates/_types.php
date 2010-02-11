<div class="round" id="category_list">
	<div class="r_container">
		<h2 class="top_plate"><a href="<?php echo url_for('@film_types_all') ?>">Жанры фильмов</a></h2>
		<ul>
			<li>
				<?php if ('index' == $sf_params->get('action') && 'film_types' == $sf_params->get('module')):?>
					<span>Все жанры</span>
				<?php else:?>
					<a href="<?php echo url_for('@film_types_all') ?>">Все жанры</a>
				<?php endif?>
			</li>
			<?php foreach($film_types as $key=>$row): ?>
			<li>
				<?php if ('show' == $sf_params->get('action') && 'film_types' == $sf_params->get('module') && $row->getId() == $sf_params->get('id')):?>
					<span><?php echo $row->getTitle() ?></span>
				<?php else:?>
					<a href="<?php echo url_for('film_types', $row) ?>">
						<?php echo $row->getTitle() ?>
					</a>
				<?php endif?>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</div>