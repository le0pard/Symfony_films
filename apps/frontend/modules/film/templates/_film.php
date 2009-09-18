<div class="film_cell">
	<?php echo $film->getTitle(); ?>
	<div class="poster">
		<img src="/uploads/posters/<?php echo $film->getThumbLogo() ?>" alt="<?php echo $film->getTitle() ?>" title="<?php echo $film->getTitle() ?>" />
	</div>
</div>