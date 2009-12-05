<?xml version="1.0" encoding="utf-8"?>
<?php use_helper('Text') ?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <?php include_title() ?>
  <subtitle><?php echo $film_type->getTitle(); ?></subtitle>
  <link href="<?php echo url_for('film_types', $film_type, true) ?>" rel="self"/>
  <link href="<?php echo url_for('film_types', $film_type, true) ?>"/>
  <updated><?php echo strftime('%Y-%m-%dT%H:%M:%SZ', time()) ?></updated>
  <author><name>leopard</name></author>
  <id><?php echo sha1(time()) ?></id>
  <?php foreach($pager->getResults() as $key=>$row): ?>
  	<?php include_partial('film_types/row', array('film' => $row->getFilm(), 'sf_cache_key' => $row->getFilm()->getId())) ?>
  <?php endforeach ?>
</feed>