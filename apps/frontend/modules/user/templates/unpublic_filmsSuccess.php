<div id="entrance">
  <h1>Ваши черновики</h1>
  <div id="draft_list">
	<ul>
	  <?php foreach($film_list as $row): ?>
	  <li>
	  	<a href="<?php echo url_for('film_edit_step1', $row) ?>"><?php echo $row->getTitle(); ?></a>
	  	<span><?php echo strftime('%d.%m.%Y %H:%M', $comment->getCreatedAt('U')) ?></span>
	  </li>
	  <?php endforeach ?>
	</ul>
  </div>
</div>