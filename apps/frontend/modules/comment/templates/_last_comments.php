<div class="right_card">
	<div class="header">
		Ссылки
	</div>
	<ul>
		<?php foreach($comments as $row): ?>
			<?php if ($row->isFor('Film')): ?>
			<?php $film = $row->getObjectByType(); ?>
				<li>
					<a href="<?php echo url_for('film_show', $film) ?>">
						<?php echo $film->getTitle(); ?>
					</a>
				</li>
			<?php endif ?>
		<?php endforeach ?>
	</ul>
</div>
<div class="clear"></div>