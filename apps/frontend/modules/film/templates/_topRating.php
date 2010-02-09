<div class="round" id="film_raiting">
	<div class="r_container">
		<h2 class="top_plate">
		<a href="#">Рейтинг фильмов</a>
		</h2>
		<ol>
			<?php foreach($top_films as $top_film):?>
			<li>
			  <a href="<?php echo url_for('film_show', $top_film->getFilm()) ?>">
			  <?php echo $top_film->getFilm()->getTitle(); ?></a> (<?php echo $top_film->getFilm()->getPubYear(); ?>) 
			  <strong><?php echo $top_film->getTotalRating(); ?></strong>
			</li>
			<?php endforeach?>
		</ol>
	</div>
</div>