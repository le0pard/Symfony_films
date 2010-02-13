<div id="film_vote">
<?php if ($sf_user->isAnonymous()): ?>
	Рейтинг: <div id="rating_film_done" class="rating_container" rel="<?php echo $film->getRating();?>"></div>
	<span><?php echo $film->getRating();?></span>
<?php else:?>
	<?php if (($rating = $film->getUserRaiting($sf_user->getAuthUser()->getId())) == true):?>
		Рейтинг: <div id="rating_film_done" class="rating_container" rel="<?php echo $film->getRating();?>"></div>
		<span><?php echo $film->getRating();?> / Ваша оценка: <?php echo $rating->getRating();?></span>
	<?php else:?>
		Ваша оценка :
		<div id="rating_film" class="rating_container" rel="<?php echo $film->getId();?>"></div>
	<?php endif ?>	
<?php endif ?>
</div>