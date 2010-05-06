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
<img class="aligncenter" src="<?php echo url_for('@film_poster_mobile?id='.$film->getId()) ?>" alt="<?php echo $film->getTitle() ?>" title="<?php echo $film->getTitle() ?>" />
<p><?php echo System::jevix_def($film->getAbout(ESC_RAW)); ?></p>
<div class="clear"></div>
<!--
<p class="byline small">Posted by <a href="#" title="">leopard</a> on 25 Январь 2010.</p>
<p class="tags small">Tags: <a href="#" rel="tag">разработка</a></p>
<p class="categories small">Categories: <a href="#" title="#" rel="category tag">Новости</a>,  <a href="#" title="#" rel="category tag">разработка</a></p>
-->
</div><!--#content-->