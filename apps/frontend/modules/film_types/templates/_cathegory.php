<div id="info_cathegory">
	<div class="content">
		<?php if ($cathegory->getLogo()): ?>
			<img title="<?php echo $cathegory->getTitle() ?>" alt="<?php echo $cathegory->getTitle() ?>" src="/uploads/cathegory/<?php echo $cathegory->getLogo() ?>" />
		<?php else: ?>
			<img title="<?php echo $cathegory->getTitle() ?>" alt="<?php echo $cathegory->getTitle() ?>" src="/uploads/cathegory/default.png" />
		<?php endif ?>
		<p>
			<h2><?php echo $cathegory->getTitle() ?></h2>
			<?php echo $cathegory->getDescription(ESC_RAW) ?>
		</p>
	</div>
	<div>
		<a href="<?php echo url_for('film_types_rss', $cathegory) ?>">RSS</a> 
		<a href="<?php echo url_for('film_types_atom', $cathegory) ?>">ATOM</a>
	</div>	
	<div class="clear"></div>
</div>