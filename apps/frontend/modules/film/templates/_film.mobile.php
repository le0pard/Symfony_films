<div class="film_cell">
	<div>
		<img src="<?php echo url_for('@film_poster_mobile?id='.$film->getId()) ?>" alt="<?php echo $film->getTitle() ?>" title="<?php echo $film->getTitle() ?>" />
		<a href="<?php echo url_for('film_show', $film) ?>">
			<?php echo $film->getTitle(); ?> / <?php echo $film->getOriginalTitle() ?> (<?php echo $film->getPubYear() ?>)
		</a>
	</div>
</div>