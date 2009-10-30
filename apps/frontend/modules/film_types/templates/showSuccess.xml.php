<?xml version="1.0" encoding="utf-8"?>
<?php use_helper('Text') ?>
<rss version="2.0">
	<channel>
    <?php include_title() ?>
    <link><?php echo url_for('film_types', $film_type, true) ?></link>
    <description><?php echo $film_type->getTitle(); ?></description>
    <language>ru</language>
	<?php foreach($pager->getResults() as $key=>$row): ?>
	<?php $film = $row->getFilm() ?>
    <item>
        <title><?php echo $film->getTitle(); ?></title>
        <description><![CDATA[<?php echo $film->getAbout() ?>]]></description>
        <link><?php echo url_for('film_show', $film, true) ?></link>
		<guid><?php echo url_for('film_show', $film, true) ?></guid>
		<pubDate><?php echo strftime('%Y-%m-%dT%H:%M:%SZ', $film->getUpdatedAt('U')) ?></pubDate>
	</item>
	<?php endforeach ?>
	</channel>
</rss>