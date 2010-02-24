<?php include_component('afisha', 'selectors', array('selected_day' => $selected_day, 'selected_city' => $city, 'selected_by_city' => $city)) ?>

<?php if ($afisha):?>
<?php include_partial('afisha/list', array('afisha' => $afisha)) ?>
<?php endif?>