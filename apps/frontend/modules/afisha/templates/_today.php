<div class="right_card">
	<div class="header">
		Афиша &laquo;<?php echo $city->getTitle()?>&raquo;
	</div>
	<ul>
	<?php foreach($afisha as $show):?>
		<li>
			<a href="<?php echo url_for('afisha_cinema', $show->getAfishaTheater()) ?>">
			<?php echo $show->getAfishaTheater()->getTitle();?></a>
			<a href="<?php echo url_for('afisha_film', $show->getAfishaFilm()) ?>">
			<?php echo $show->getAfishaFilm()->getTitle()?></a>
		</li>
	<?php endforeach?>
	<div>
		<a href="<?php echo url_for('@afisha') ?>">Вся афиша</a>
	</div>
	</ul>
</div>	