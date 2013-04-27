<?php slot('title') ?>
  <?php echo sprintf('%s. тел. %s, %s - Coocoorooza', $cinema->getTitle(), $cinema->getPhone(), $cinema->getAddress()) ?>
<?php end_slot(); ?>

<h1><?php echo $cinema->getTitle()?></h1>
<div id="cinema_info">
<div>
  <a class="back" href="<?php echo url_for('@afisha') ?>">Назад на афишу</a>
</div>
<!--
<div class="cinema_name">
  <h1><?php echo $cinema->getTitle()?></h1>
</div>
 -->
<div class="cinema_address">
  <h4>тел. <?php echo $cinema->getPhone()?><br />
  <?php echo $cinema->getAddress()?></h4>
</div>
<div class="cinema_desc">
  <?php echo $cinema->getDescription(ESC_RAW) ?>
</div>
</div>

<?php include_component('afisha', 'selectors', array('selected_day' => $selected_day, 'selected_by_cinema' => $cinema)) ?>

<?php include_partial('afisha/list', array('afisha' => $afisha)) ?>

<div id="afisha_source">Информация предоставлена сайтом <a href="http://kino-teatr.ua/ru/main/cinema_shows/cinema_id/<?php echo $cinema->getExternalId()?>.phtml" target="_blank">www.kino-teatr.ua</a></div>