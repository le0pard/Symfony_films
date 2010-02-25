<?php if (isset($news)): ?>

<?php slot('title') ?>
  <?php echo sprintf('%s - Coocoorooza', $news->getTitle()) ?>
<?php end_slot(); ?>

<div id="entrance">
  <h1><?php echo $news->getTitle(); ?></h1>
  <div class="news_text_date"><?php echo strftime('%d.%m.%Y', $news->getUpdatedAt('U')); ?></div>
  <?php echo $news->getDescription(ESC_RAW) ?>
</div>
<?php endif ?>