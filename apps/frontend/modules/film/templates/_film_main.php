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
				<td>
					<?php echo System::jevix_def($film->getAbout(ESC_RAW)); ?>
				</td>
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
						<?php echo nl2br($film->getFileInfo()) ?>
					<?php else: ?>
						<span class="not_set">не указано</span>
					<?php endif ?>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="galleryBox" class="gallery">
		<div id="mainGalleryBox">
			<img id="mainGalleryImg" alt="Просмотр" src="" />
		</div>
		<?php foreach($film->getGallery() as $row): ?>
			<a class="img_link" href="javascript:;" rel="/uploads/gallery/<?php echo $row->getFilmId() ?>/<?php echo $row->getNormalImg() ?>">	
				<img alt="<?php echo $film->getTitle() ?>" src="/uploads/gallery/<?php echo $row->getFilmId() ?>/<?php echo $row->getThumbImg() ?>" />
			</a>
		<?php endforeach ?>
	</div>
	
	<div class="links">
		<?php foreach($film->getLinks() as $row): ?>
			<a href="<?php echo $row->getUrl() ?>" target="_blank">
				<?php echo $row->getTitle() ?>
			</a>
		<?php endforeach ?>
	</div>
	
	<div class="film_info">
		<div class="catalog">
			<ul>
				<?php foreach($film->getFilmFilmTypessJoinFilmTypes() as $row):?>
					<li>
						<a href="<?php echo url_for('film_types', $row->getFilmTypes()) ?>">
							<?php echo $row->getFilmTypes()->getTitle() ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
		<div class="date">
			<?php echo gmstrftime('%d.%m.%Y', $film->getUpdatedAt('U')) ?>
		</div>
		<div class="autor">
			<?php if ($film->getUsers()): ?>
				<a href="<?php echo url_for('user_show', $film->getUsers()) ?>">
					<?php echo $film->getUsers()->getLogin() ?>
				</a>
			<?php else: ?>
				Неизвестен	
			<?php endif ?>
		</div>
	</div>
</div>	
<?php endif ?>
