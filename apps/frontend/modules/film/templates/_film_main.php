<?php if ($film): ?>
<h1><?php echo $film->getTitle() ?>
<?php if ($film->getOriginalTitle()): ?> (<?php echo $film->getOriginalTitle() ?>)<?php endif ?>, 
<?php echo $film->getPubYear() ?></h1>
<h4>
  <span id="pub_date">Дата публикации: <?php echo strftime('%d.%m.%Y', $film->getModifiedAt('U')) ?></span>
  Опубликовал:
  <?php if ($film->getUsersRelatedByUserId()): ?>
	  <a href="<?php echo url_for('user_show', $film->getUsersRelatedByUserId()) ?>">
		  <?php echo $film->getUsersRelatedByUserId()->getLogin() ?>
	  </a>
  <?php else: ?>
	Неизвестен	
  <?php endif ?> 
	<br />
  Редактор: 
  <?php if ($film->getUsersRelatedByModifiedUserId()): ?>
	  <a href="<?php echo url_for('user_show', $film->getUsersRelatedByModifiedUserId()) ?>">
		  <?php echo $film->getUsersRelatedByModifiedUserId()->getLogin() ?>
	  </a>
  <?php else: ?>
	Неизвестен	
  <?php endif ?>
</h4>

<div id="posters">
  <img id="big_poster" src="/uploads/posters/<?php echo $film->getNormalLogo() ?>" alt="<?php echo $film->getTitle() ?>" title="<?php echo $film->getTitle() ?>" />
</div>

<div id="frames">
  <ul>
  	<?php foreach($film->getGallery() as $row): ?>
  	<li>
		<a class="img_link" href="/uploads/gallery/<?php echo $row->getFilmId() ?>/<?php echo $row->getNormalImg() ?>" rel="lightbox[gallery]">	
			<img title="<?php echo $film->getTitle() ?>" alt="<?php echo $film->getTitle() ?>" src="/uploads/gallery/<?php echo $row->getFilmId() ?>/<?php echo $row->getThumbImg() ?>" />
		</a>
	</li>	
	<?php endforeach ?>
   </ul>
</div>

<div id="film_desc">
  <ul>
	<li><strong>Название в прокате: </strong><span><?php echo $film->getTitle() ?></span></li>
	<li><strong>Оригинальное название: </strong><span><?php echo $film->getOriginalTitle() ?></span></li>
	<li><strong>Жанр: </strong>
		<span>
			<?php foreach($film->getFilmFilmTypessJoinFilmTypes() as $key=>$row):?>
				<?php if ($key > 0):?>, <?php endif?>
				<a href="<?php echo url_for('film_types', $row->getFilmTypes()) ?>">
					<?php echo $row->getFilmTypes()->getTitle() ?>
				</a>
			<?php endforeach ?>
		</span>
	</li>

	<li><strong>Год: </strong><span><?php echo $film->getPubYear() ?></span></li>
	<li><strong>Страна: </strong><span><?php echo $film->getCountry() ?></span></li>
	<li><strong>Режиссер: </strong><span><?php echo $film->getDirector() ?></span></li>
	<li><strong>В главных ролях: </strong><span><?php echo $film->getCast() ?></span></li>
	<li><strong>Качество: </strong><span><?php echo $film->getDuration() ?></span></li>

	<li><strong>Информация о файлах: </strong>
		<span>
			<?php echo nl2br($film->getFileInfo()) ?>
		</span>
	</li>
  </ul>
  <div id="film_desc_text">
	<?php echo System::jevix_def($film->getAbout(ESC_RAW)); ?>
  </div>
</div>
<?php if ($film->countFilmTrailers() > 0):?>
<div id="film_trailers">
	<a onclick="javascript:$('trailers_box').toggle(); if ($('trailers_box').visible()) { Effect.ScrollTo('trailers_box'); } return false;" href="#">Показать / Скрыть</a>
	<div id="trailers_box" style="display:none">
		<?php foreach ($film->getTrailers() as $trailer):?>
			<div>
			<?php include_partial('film/trailer', array('trailer' => $trailer, 'film' => $film)) ?>
			</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif ?>

<div id="film_links">
  <h2 class="label">Ссылки</h2>
  <ul>
    <?php foreach($film->getLinks() as $row): ?>
    <li>
		<a href="<?php echo url_for('go_by_link_id', $row) ?>">
			<?php echo $row->getTitle() ?>
		</a>
	</li>	
	<?php endforeach ?>
  </ul>
</div>

<?php endif ?>
