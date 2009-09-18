<?php if ($film): ?>
<div id="main_film">
	<h1>
		<?php echo $film->getTitle() ?><?php if ($film->getOriginalTitle()): ?>/<?php echo $film->getOriginalTitle() ?><?php endif ?>
		(<?php echo $film->getPubYear() ?>)
	</h1>
	<div class="poster">
		<img src="/uploads/posters/<?php echo $film->getNormalLogo() ?>" alt="<?php echo $film->getTitle() ?>" title="<?php echo $film->getTitle() ?>" />
	</div>
	<div class="data">
		<table>
			<tr>
				<th>Название</th>
				<td><?php echo $film->getTitle() ?></td>
			</tr>
			<tr>
				<th>Оригинальное название</th>
				<td>
					<?php if ($film->getOriginalTitle()): ?>
						<?php echo $film->getOriginalTitle() ?>
					<?php else: ?>
						<span class="not_set">не указано</span>
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<th>Год выпуска</th>
				<td><?php echo $film->getPubYear() ?></td>
			</tr>
			<tr>
				<th>Режисер</th>
				<td>
					<?php if ($film->getDirector()): ?>
						<?php echo $film->getDirector() ?>
					<?php else: ?>
						<span class="not_set">не указано</span>
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<th>В ролях</th>
				<td>
					<?php if ($film->getCast()): ?>
						<?php echo $film->getCast() ?>
					<?php else: ?>
						<span class="not_set">не указано</span>
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<th>Страна</th>
				<td>
					<?php if ($film->getCountry()): ?>
						<?php echo $film->getCountry() ?>
					<?php else: ?>
						<span class="not_set">не указано</span>
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<th>Про что</th>
				<td><?php echo $film->getAbout() ?></td>
			</tr>
			<tr class="file">
				<th>Качество</th>
				<td>
					<?php if ($film->getDuration()): ?>
						<?php echo $film->getDuration() ?>
					<?php else: ?>
						<span class="not_set">не указано</span>
					<?php endif ?>
				</td>
			</tr>
			<tr class="file">
				<th>Информация про файл</th>
				<td>
					<?php if ($film->getFileInfo()): ?>
						<?php echo $film->getFileInfo() ?>
					<?php else: ?>
						<span class="not_set">не указано</span>
					<?php endif ?>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="gallery">
		<?php foreach($film->getGallery() as $row): ?>
			<img alt="<?php echo $film->getTitle() ?>" src="/uploads/gallery/<?php echo $row->getFilmId() ?>/<?php echo $row->getThumbImg() ?>" />
		<?php endforeach ?>
	</div>
	
	<div class="links">
		<?php foreach($film->getLinks() as $row): ?>
			<?php echo $row->getTitle() ?>
		<?php endforeach ?>
	</div>
	
	<div class="film_info">
		<div class="date">
			<?php echo gmstrftime('%d.%m.%Y', $film->getUpdatedAt('U')) ?>
		</div>
		<div class="autor">
			<?php if ($film->getUsers()): ?>
				<?php echo $film->getUsers()->getLogin() ?>
			<?php else: ?>
				Неизвестен	
			<?php endif ?>
		</div>
	</div>
</div>	
<?php endif ?>
