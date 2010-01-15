<h2>Новости</h2>
<div>
	<ul>
<?php foreach($news as $key=>$row): ?>
	<li>
		<a href="<?php echo url_for('news_one', $row) ?>"><?php echo $row->getTitle();?></a>
	</li>
<?php endforeach ?>
	</ul>
<a href="<?php echo url_for('@news_all') ?>">Все новости</a>
</div>