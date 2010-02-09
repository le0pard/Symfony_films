<div class="film_item">
	<a href="<?php echo url_for('film_show', $film) ?>">
		<span>
			<img src="/uploads/posters/<?php echo $film->getThumbLogo() ?>" alt="<?php echo $film->getTitle(); ?>" title="<?php echo $film->getTitle(); ?>" />
		</span>
	</a>
	<div>
		<a href="<?php echo url_for('film_show', $film) ?>"><?php echo $film->getTitle(); ?></a>
	</div>
	<div>
	<?php echo $film->getDirector() ?>, <?php echo $film->getPubYear() ?> <img src="/images/emotion.png" class="vote_smile" alt="<?php echo $film->getRating();?>" title="Говно" />
	</div>
</div>