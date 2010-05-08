<ul class="disclosure table group">
<?php foreach($afisha as $show):?>
	<li>
		<a title="<?php echo $show->getAfishaTheater()->getTitle() ?>" href="<?php echo url_for('@mobile_afisha_film?id='.$show->getAfishaFilm()->getId()) ?>?city_id=<?php echo $cinema->getAfishaCity()->getId() ?>">
		<span class="cinema_title">Фильм: </span><?php echo $show->getAfishaFilm()->getTitle()?><br />
		<span class="cinema_title">Зал: </span><span class="description"><?php echo $show->getAfishaZal()->getTitle()?></span> <br />
		<span class="cinema_title">Время: </span><span class="description_wrap"><?php echo $show->getTimes()?></span>
		</a>
	</li>	
<?php endforeach ?>
</ul>