<div id="news" class="round">
	<div class="r_container">
		<h2 class="top_plate">
			<a href="<?php echo url_for('@news_all') ?>">Новости</a>
		</h2>
		<?php foreach($news as $key=>$row): ?>
			<div>
				<h3>
				<a href="<?php echo url_for('news_one', $row) ?>"><?php echo $row->getTitle();?></a>
				</h3><?php echo strftime('%d.%m.%Y', $row->getUpdatedAt('U')); ?>
			</div>
		<?php endforeach ?>	
	</div>
</div>