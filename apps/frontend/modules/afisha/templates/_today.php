<?php if (isset($afisha_films)):?>
<div class="round" id="cinema_posters">
	<div class="r_container">
		<h2 class="top_plate">
			<a href="<?php echo url_for('@afisha') ?>">Афиша</a>
		</h2>
		<a id="scrl_left_afisha" class="top_plate scrl_left">←</a>
		<a id="scrl_right_afisha" class="top_plate scrl_right">→</a>
		<div id="afisha_today_box" class="lists">
			<?php $i = 1;?>
			<?php $rkey = 0;?>
			<ul id="afisha_list_<?php echo $i;?>">
			<?php foreach($afisha_films as $key=>$show):?>
				<?php if ($key % 3 == 0 && $key != 0):?>
				<ul id="afisha_list_<?php echo $i;?>">
				<?php endif?>
				<li>
				<a href="<?php echo url_for('afisha_film', $show) ?>">
				<span><img style="max-width:100px;max-height:140px;" src="/uploads/afisha_films/<?php echo $show->getPoster() ?>" alt="<?php echo $show->getTitle()?>" /></span>
				</a>
				<div><h5><?php echo $show->getTitle()?></h5> <h6><?php echo $show->getYear()?></h6> 
				<a href="<?php echo url_for('afisha_film', $show) ?>">Посмотреть в&nbsp;кинотеатрах</a></div>
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