<?xml version="1.0" encoding="utf-8"?>
<?php use_helper('Text') ?>
<rss version="2.0">
	<channel>
    <?php include_title() ?>
    <link><?php echo url_for('film_types', $film_type, true) ?></link>
    <description><?php echo $film_type->getTitle(); ?></description>
    <language>ru</language>
	<?php foreach($pager->getResults() as $key=>$row): ?>
		<?php include_partial('film_types/row', array('film' => $row->getFilm(), 'sf_cache_key' => $row->getFilm()->getId())) ?>
	<?php endforeach ?>
	</channel>
</rss>