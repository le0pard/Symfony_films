<?php if (isset($news)): ?>
<div>
	<div><?php echo $news->getTitle(); ?></div>
	<span><?php echo strftime('%d.%m.%Y %H:%M', $news->getUpdatedAt('U')); ?></span>
	<div>
		<?php echo $news->getDescription(ESC_RAW) ?>
	</div>
</div>	
<?php endif ?>