<ul class="disclosure table group">
<?php $cinema = ""; ?>
<?php foreach($afisha as $show):?>
	<?php if ($cinema != $show->getAfishaTheater()->getTitle()):?>
		<?php if ($cinema != ""):?></a></li><?php endif?>
		<?php $cinema = $show->getAfishaTheater()->getTitle()?>
		<li>
			<a title="<?php echo $cinema ?>" href="<?php echo url_for('@mobile_afisha_cinema?id='.$show->getAfishaTheater()->getId()) ?>">
				<span class="cinema_title">Кинотеатр: </span><?php echo $show->getAfishaTheater()->getTitle() ?>
	<?php endif ?>	
	<br />
	<span class="cinema_title">Зал: </span><span class="description"><?php echo $show->getAfishaZal()->getTitle()?></span> <br />
	<span class="cinema_title">Время: </span><span class="description_wrap"><?php echo $show->getTimes()?></span>
<?php endforeach ?>
<?php if ($cinema != ""):?></a></li><?php endif?>
</ul>