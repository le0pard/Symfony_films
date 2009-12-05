<?xml version="1.0" encoding="utf-8"?>
<?php use_helper('Text') ?>
<rss version="2.0">
	<channel>
    <title>Кукурудза - Лучшие фильмы и сериалы</title>
    <link><?php echo url_for('@film_types_all', true) ?></link>
    <description>Test</description>
    <language>ru</language>
	<?php foreach($pager->getResults() as $key=>$row): ?>
    	<?php include_partial('film_types/row', array('film' => $row, 'sf_cache_key' => $row->getId())) ?>
	<?php endforeach ?>
	</channel>
</rss>