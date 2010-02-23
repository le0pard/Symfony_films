<?php use_helper('Rating') ?>
<?php if ($sf_user->isAnonymous()): ?>
<div id="film_vote">
	Рейтинг: <?php echo rating_smile_for_film($film->getRating());?>
</div>	
<?php else:?>
	<?php if (($rating = $film->getUserRaiting($sf_user->getAuthUser()->getId())) == true):?>
		<?php if (isset($ajax)): ?>
			Рейтинг: <?php echo rating_smile_for_film($film->getRating());?>
		<?php else: ?>
		<div id="film_vote">
			Рейтинг: <?php echo rating_smile_for_film($film->getRating());?>
		</div>
		<?php endif ?>
	<?php else:?>
	<div id="film_vote">
		Ваша оценка : <div id="rating_film" class="rating_container" rel="<?php echo $film->getId();?>"></div>
	</div>	
	<?php endif ?>	
<?php endif ?>