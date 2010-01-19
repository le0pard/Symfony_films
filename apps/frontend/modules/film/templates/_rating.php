<?php if ($sf_user->isAnonymous()): ?>
	Рейтинг: <div id="rating_film_done" class="rating_container" rel="<?php echo $film->getRating();?>"></div>
	<?php echo $film->getRating();?>
<?php else:?>
	<?php if (($rating = $film->getUserRaiting($sf_user->getAuthUser()->getId())) == true):?>
		Рейтинг: <div id="rating_film_done" class="rating_container" rel="<?php echo $film->getRating();?>"></div>
		<?php echo $film->getRating();?> / Ваша оценка: <?php echo $rating->getRating();?>
	<?php else:?>
		<div style="margin:10px;">
		Ваша оценка :
		<div id="rating_film" class="rating_container" rel="<?php echo $film->getId();?>"></div>
		</div>
	<?php endif ?>	
<?php endif ?>