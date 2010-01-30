<?php slot('top_content') ?>
<?php include_component('news', 'latest', array('sf_cache_key' => 'latest')) ?>
<?php include_component('afisha', 'today', array('sf_cache_key' => 'afisha')) ?>
<?php end_slot() ?>

<?php include_component('film', 'topNew', array('sf_cache_key' => 'top_new')) ?>
<?php include_component('user', 'topUsers', array('sf_cache_key' => 'top_user')) ?>
<?php include_component('film', 'topRating', array('sf_cache_key' => 'top_films')) ?>