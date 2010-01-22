<div>
<h2>
Афиша &laquo;<?php echo $city->getTitle()?>&raquo;
</h2>
<?php foreach($afisha as $show):?>
	<a href="<?php echo url_for('afisha_film', $show->getAfishaFilm()) ?>">
	<?php echo $show->getAfishaFilm()->getTitle()?></a>
<?php endforeach?>
<a href="<?php echo url_for('@afisha') ?>">Вся афиша</a>
</div>	