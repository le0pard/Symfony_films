<?php if ($city && $afisha):?>
<div class="round" id="cinema_posters">
	<div class="r_container">
		<h2 class="top_plate">
			<a href="<?php echo url_for('@afisha') ?>">Афиши &laquo;<?php echo $city->getTitle()?>&raquo;</a>
		</h2>
		<a id="scrl_left_afisha" class="top_plate scrl_left">←</a>
		<a id="scrl_right_afisha" class="top_plate scrl_right">→</a>
		<div id="afisha_today_box" class="lists">
			<?php $i = 1;?>
			<?php $rkey = 0;?>
			<ul id="afisha_list_<?php echo $i;?>">
			<?php foreach($afisha as $key=>$show):?>
				<?php if ($key % 3 == 0 && $key != 0):?>
				<ul id="afisha_list_<?php echo $i;?>">
				<?php endif?>
				<li>
				<a href="<?php echo url_for('afisha_film', $show->getAfishaFilm()) ?>">
				<span><img style="max-width:100px;max-height:140px;" src="/uploads/afisha_films/<?php echo $show->getAfishaFilm()->getPoster() ?>" alt="<?php echo $show->getAfishaFilm()->getTitle()?>" /></span>
				</a>
				<div><h5><?php echo $show->getAfishaFilm()->getTitle()?></h5> <h6><?php echo $show->getAfishaFilm()->getYear()?></h6> 
				<a href="<?php echo url_for('afisha_film', $show->getAfishaFilm()) ?>">Посмотреть в&nbsp;кинотеатрах</a></div>
				</li>
				<?php if (($key+1) % 3 == 0 && $key != 0):?>
				</ul><?php $i++;?>
				<?php endif?>
				<?php $rkey = $key;?>
			<?php endforeach?>
			<?php if ($rkey && ($rkey+1) % 3 != 0):?>
				</ul>
			<?php endif?>
		</div>
	</div>
</div>
<?php endif ?>