<?php include_partial('film/film_main', array('film' => $film)) ?>
<?php include_partial('comment/comment_list', array('comments' => $pager, 'film' => $film)) ?>
<?php include_component('comment', 'comment_form', array('data' => array('comment_type_id' => $film->getId(), 'comment_type_name' => 'Film'))) ?>