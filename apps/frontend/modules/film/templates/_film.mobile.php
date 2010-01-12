<div class="film_cell">
	<div>
		<img src="/uploads/posters/<?php echo $film->getThumbLogo() ?>" alt="<?php echo $film->getTitle() ?>" title="<?php echo $film->getTitle() ?>" />
		<a href="<?php echo url_for('film_show', $film) ?>">
			<?php echo $film->getTitle(); ?> / <?php echo $film->getOriginalTitle() ?> (<?php echo $film->getPubYear() ?>)
		</a>
	</div>
</div>