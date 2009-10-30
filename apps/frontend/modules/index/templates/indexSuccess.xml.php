<?xml version="1.0" encoding="utf-8"?>
<?php use_helper('Text') ?>
<rss version="2.0">
	<channel>
    <?php include_title() ?>
    <link><?php echo url_for('@homepage', true) ?></link>
    <description>Test</description>
    <language>ru</language>
	<?php foreach($pager->getResults() as $key=>$row): ?>
    <item>
        <title><?php echo $row->getTitle(); ?></title>
        <description><![CDATA[<?php echo $row->getAbout() ?>]]></description>
        <link><?php echo url_for('film_show', $row, true) ?></link>
		<guid><?php echo url_for('film_show', $row, true) ?></guid>
		<pubDate><?php echo strftime('%Y-%m-%dT%H:%M:%SZ', $row->getUpdatedAt('U')) ?></pubDate>
	</item>
	<?php endforeach ?>
	</channel>
</rss>