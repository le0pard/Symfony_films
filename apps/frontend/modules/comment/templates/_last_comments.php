<div class="right_card">
	<div class="header">
		Последнии коментарии
	</div>
	<ul>
		<?php foreach($comments as $row): ?>
			<?php if ($row->getFilm() && $row->getUsers()): ?>
			<?php $film = $row->getFilm(); ?>
			<?php $user = $row->getUsers(); ?>
				<li>
					<a href="<?php echo url_for('film_show', $film) ?>">
						<?php echo $film->getTitle(); ?>
					</a>
					<a href="<?php echo url_for('user_show', $user) ?>">
						<?php echo $user->getLogin() ?>
					</a>
				</li>
			<?php endif ?>
		<?php endforeach ?>
	</ul>
</div>
<div class="clear"></div>