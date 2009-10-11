<?php foreach($comments as $comment): ?>
	<?php include_partial('comment/comment_one', array('comment' => $comment)) ?>	
<?php endforeach ?>
