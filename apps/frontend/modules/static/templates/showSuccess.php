<?php slot('title') ?>
  <?php echo sprintf('%s - Coocoorooza', $static_page->getTitle()) ?>
<?php end_slot(); ?>

<div id="entrance">
  <h1><?php echo $static_page->getTitle() ?></h1>
  <?php echo $static_page->getDescription(ESC_RAW) ?>
</div>