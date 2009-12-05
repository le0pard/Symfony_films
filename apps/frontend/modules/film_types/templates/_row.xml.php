<item>
    <title><?php echo $film->getTitle(); ?></title>
    <description><![CDATA[<?php echo $film->getAbout() ?>]]></description>
    <link><?php echo url_for('film_show', $film, true) ?></link>
	<guid><?php echo url_for('film_show', $film, true) ?></guid>
	<pubDate><?php echo strftime('%Y-%m-%dT%H:%M:%SZ', $film->getUpdatedAt('U')) ?></pubDate>
</item>