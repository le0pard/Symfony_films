<p id="next-prev-top" class="pagination">
<span>&laquo;</span> 
<span class="next">
	<?php if ($next_film):?>
		<a href="<?php echo url_for('@film_mobile?id='.$next_film->getId()) ?>" rel="next"><?php echo $next_film->getTitle() ?></a>
	<?php endif ?>
</span> 
<span>|</span> 
<span class="prev">
	<?php if ($prev_film):?>
		<a href="<?php echo url_for('@film_mobile?id='.$prev_film->getId()) ?>" rel="prev"><?php echo $prev_film->getTitle() ?></a>
	<?php endif ?>
</span> 
<span>&raquo;</span>
</p>
<div id="content" class="group">
<h1><?php echo $film->getTitle(); ?> / <?php echo $film->getOriginalTitle() ?> (<?php echo $film->getPubYear() ?>)</h1>
<img class="aligncenter" src="/uploads/posters/<?php echo $film->getThumbLogo() ?>" alt="<?php echo $film->getTitle(); ?>" title="<?php echo $film->getTitle(); ?>" />
<p><?php echo System::jevix_def($film->getAbout(ESC_RAW)); ?></p>
<div class="clear"></div>

<p class="byline small">Опубликовал 
<?php if ($film->getUsersRelatedByUserId()): ?>
<strong><?php echo $film->getUsersRelatedByUserId()->getLogin() ?></strong>
<?php else: ?>
Неизвестен	
<?php endif ?> 
<?php echo strftime('%d.%m.%Y', $film->getModifiedAt('U')) ?>.</p>
<p class="categories small"> Жанр: 
<?php foreach($film->getFilmFilmTypessJoinFilmTypes() as $key=>$row):?><?php if ($key > 0):?>, <?php endif?>
	<strong><?php echo $row->getFilmTypes()->getTitle() ?></strong>
<?php endforeach ?>
</p>
</div><!--#content-->