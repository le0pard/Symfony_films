<?php use_helper('Rating') ?>
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
		<?php echo rating_smile_for_film($film->getFilmRaitingNum());?>
		<div class="info">
			<?php echo $film->getDirector() ?>, <?php echo $film->getPubYear() ?>
		</div>
	</div>
</div>