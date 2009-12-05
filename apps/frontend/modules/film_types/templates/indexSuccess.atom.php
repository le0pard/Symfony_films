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
  	<?php include_partial('film_types/row', array('film' => $row, 'sf_cache_key' => $row->getId())) ?>
  <?php endforeach ?>
</feed>