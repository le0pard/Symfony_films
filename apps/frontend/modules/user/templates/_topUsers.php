<div class="round" id="user_raiting">
	<div class="r_container">
	<h2 class="top_plate">
		<a href="#">Активные пользователи</a>
	</h2>
	  <ol>
	    <?php foreach($users as $key=>$row): ?>
		<li>
		  <a href="<?php echo url_for('user_show', $row) ?>"><?php echo $row->getLogin(); ?></a> <strong><?php echo $row->getCountOfFilms(); ?> фильмов</strong>
		</li>
		<?php endforeach ?>
	  </ol>
	</div>
</div>