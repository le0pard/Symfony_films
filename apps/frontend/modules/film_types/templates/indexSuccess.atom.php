<?xml version="1.0" encoding="utf-8"?>
<?php use_helper('Text') ?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Кукурудза - Лучшие фильмы и сериалы</title>
  <subtitle>Films</subtitle>
  <link href="<?php echo url_for('@film_types_all_atom', true) ?>" rel="self"/>
  <link href="<?php echo url_for('@film_types_all', true) ?>"/>
  <updated><?php echo strftime('%Y-%m-%dT%H:%M:%SZ', time()) ?></updated>
  <author><name>leopard</name></author>
  <id><?php echo sha1(time()) ?></id>
  <?php foreach($pager->getResults() as $key=>$row): ?>
  <entry>
    <title><?php echo $row->getTitle(); ?></title>
    <link href="<?php echo url_for('film_show', $row, true) ?>" />
    <id><?php echo sha1($row->getId()) ?></id>
    <updated><?php echo strftime('%Y-%m-%dT%H:%M:%SZ', $row->getUpdatedAt('U')) ?></updated>
    <summary><![CDATA[<?php echo $row->getAbout() ?>]]></summary>
    <author>
    	<name>
    		<?php if ($row->getUsers()): ?>
				<a href="<?php echo url_for('user_show', $row->getUsers()) ?>">
					<?php echo $row->getUsers()->getLogin() ?>
				</a>
			<?php else: ?>
				Неизвестен	
			<?php endif ?>
		</name>
	</author>
  </entry>
  <?php endforeach ?>
</feed>