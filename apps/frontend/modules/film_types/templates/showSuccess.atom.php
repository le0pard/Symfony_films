<?xml version="1.0" encoding="utf-8"?>
<?php use_helper('Text') ?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <?php include_title() ?>
  <subtitle><?php echo $film_type->getTitle(); ?></subtitle>
  <link href="<?php echo url_for('film_types', $film_type, true) ?>" rel="self"/>
  <link href="<?php echo url_for('film_types', $film_type, true) ?>"/>
  <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', time()) ?></updated>
  <author><name>leopard</name></author>
  <id><?php echo sha1(time()) ?></id>
  <?php foreach($pager->getResults() as $key=>$row): ?>
  <?php $film = $row->getFilm() ?>
  <entry>
    <title><?php echo $film->getTitle(); ?></title>
    <link href="<?php echo url_for('film_show', $film, true) ?>" />
    <id><?php echo sha1($film->getId()) ?></id>
    <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', $film->getUpdatedAt('U')) ?></updated>
    <summary><![CDATA[<?php echo $film->getAbout() ?>]]></summary>
    <author>
    	<name>
    		<?php if ($film->getUsers()): ?>
				<a href="<?php echo url_for('user_show', $film->getUsers()) ?>">
					<?php echo $film->getUsers()->getLogin() ?>
				</a>
			<?php else: ?>
				Неизвестен	
			<?php endif ?>
		</name>
	</author>
  </entry>
  <?php endforeach ?>
</feed>