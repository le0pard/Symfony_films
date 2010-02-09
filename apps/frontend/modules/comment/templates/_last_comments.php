<div class="round" id="last_comments">
	<div class="r_container">
		<h2 class="top_plate"><a href="<?php echo url_for('@comments_last_list') ?>">Последние комментарии</a></h2>
		<ul>
			<?php foreach($comments as $row): ?>
			<?php if ($row->getFilm() && $row->getUsers()): ?>
				<?php $film = $row->getFilm(); ?>
				<?php $user = $row->getUsers(); ?>
				<li>
				<a class="author" href="<?php echo url_for('user_show', $user) ?>"><?php echo $user->getLogin() ?></a> → 
				<a class="film" href="<?php echo url_for('film_show', $film) ?>"><?php echo $film->getTitle(); ?></a>
				</li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
	</div>
</div>