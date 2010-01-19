<div>
<table>
	<tr>
		<th>Фильм</th>
		<th>Рейтинг</th>
	</tr>
<?php foreach($top_films as $top_film):?>
	<tr>
		<td>
			<a href="<?php echo url_for('film_show', $top_film->getFilm()) ?>">
			<?php echo $top_film->getFilm()->getTitle(); ?> (<?php echo $top_film->getFilm()->getPubYear(); ?>)</a>
		</td>
		<td><?php echo $top_film->getTotalRating(); ?></td>
	</tr>
<?php endforeach?>
</table>
</div>