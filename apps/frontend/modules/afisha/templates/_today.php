<?php if ($city && $afisha):?>
<div id="cinema_posters">
	<div class="r_container">
		<h2>
			<a href="<?php echo url_for('@afisha') ?>">Афиши &laquo;<?php echo $city->getTitle()?>&raquo;</a>
		</h2>
		<a id="scrl_left_afisha" class="scrl_left">←</a>
		<a id="scrl_right_afisha" class="scrl_right">→</a>
		<ul id="afisha_today_box">
			<?php foreach($afisha as $key=>$show):?>
				<li id="afisha_list_<?php echo $key+1;?>">
				<span><img style="max-width:100px;max-height:140px;" src="/uploads/afisha_films/<?php echo $show->getAfishaFilm()->getPoster() ?>" alt="<?php echo $show->getAfishaFilm()->getTitle()?>" /></span>
				<div><h5><?php echo $show->getAfishaFilm()->getTitle()?></h5> <h6><?php echo $show->getAfishaFilm()->getYear()?></h6> 
				<a href="<?php echo url_for('afisha_film', $show->getAfishaFilm()) ?>">Посмотреть в&nbsp;кинотеатрах</a></div>
				</li>
			<?php endforeach?>
		</ul>
	</div>
</div>
<?php endif ?>