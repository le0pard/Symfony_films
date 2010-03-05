<?php slot('title') ?>
  Афиша кинотеатров - Coocoorooza
<?php end_slot(); ?>

<?php include_component('afisha', 'selectors', array('selected_day' => $selected_day, 'selected_city' => $city, 'selected_by_city' => $city)) ?>

<?php if ($afisha):?>
<?php include_partial('afisha/list', array('afisha' => $afisha)) ?>
<?php endif?>

<div id="afisha_source">Информация предоставлена сайтом <a href="http://kino-teatr.ua/" target="_blank" rel="nofollow">www.kino-teatr.ua</a></div>