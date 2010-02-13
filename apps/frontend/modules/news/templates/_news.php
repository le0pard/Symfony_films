<?php if (isset($news)): ?>
<div>
	<a href="<?php echo url_for('news_one', $news) ?>"><?php echo $news->getTitle(); ?></a>
	<span><?php echo strftime('%d.%m.%Y', $news->getUpdatedAt('U')); ?></span>
</div>	
<?php endif ?>