<?xml version="1.0" encoding="utf-8"?>
<?php use_helper('Text') ?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <?php include_title() ?>
  <subtitle>Latest Jobs</subtitle>
  <link href="<?php echo url_for('@homepage_atom', true) ?>" rel="self"/>
  <link href="<?php echo url_for('@homepage', true) ?>"/>
  <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', time()) ?></updated>
  <author><name>leopard</name></author>
  <id><?php echo sha1(time()) ?></id>
  <?php foreach($pager->getResults() as $key=>$row): ?>
  <entry>
    <title><?php echo $row->getTitle(); ?></title>
    <link href="<?php echo url_for('film_show', $row, true) ?>" />
    <id><?php echo sha1($row->getId()) ?></id>
    <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', $row->getUpdatedAt('U')) ?></updated>
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