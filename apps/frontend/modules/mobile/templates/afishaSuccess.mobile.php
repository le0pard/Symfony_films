<p id="top-menu" class="top_menu">
<span>&laquo;</span> 
<span class="next">
	<a title="Афиша" href="<?php echo url_for('@mobile_afisha') ?><?php if (isset($city_id_params)):?>?city_id=<?php echo $city_id_params ?><?php endif ?>">Афиша</a>
</span> 
<span>|</span> 
<span class="prev">
	<a title="Фильмы" href="<?php echo url_for('@homepage_mobile') ?>">Фильмы</a>	
</span> 
<span>&raquo;</span>
</p>
<hr />
<div class="group">
	<form method="get" action="" id="change_city">
		<div>
			<select id="ch_city" name="city_id">
				<?php foreach($selected_country->getCities() as $city):?>
					<option <?php $city->getId() == $selected_city->getId() and print 'selected="selected"' ?> value="<?php echo $city->getId();?>"><?php echo $city->getTitle();?></option>
				<?php endforeach?>
			</select>
			<input type="submit" value="Поменять" /> 
			<a title="Кинотеатры" href="<?php echo url_for('@mobile_afisha_cinemas?city_id='.$selected_city->getId()) ?>">Кинотеатры</a>
		</div>
	</form>
</div>
<div id="content">
	<ul class="disclosure table group">
		<?php foreach($pager->getResults() as $key=>$row): ?>
			<?php include_partial('mobile/afisha_link', array('film' => $row, 'city_id_params' => $city_id_params ? $city_id_params : null)) ?>
		<?php endforeach ?>	
		<?php if ($pager->haveToPaginate()): ?>
		<li class="pagination">
		<span>&laquo;</span>
		<span class="next">
			<?php if ($pager->getLastPage() != $pager->getPage()): ?>
				<a href="<?php echo url_for('@mobile_afisha_pages?page='.$pager->getNextPage()) ?>">Назад</a>
			<?php endif ?>
		</span>
		<span>|</span>
		<span class="prev">
			<?php if (1 != $pager->getPage()): ?>
				<a href="<?php echo url_for('@mobile_afisha_pages?page='.$pager->getPreviousPage()) ?>">Вперед</a>
			<?php endif ?>
		</span>
		<span>&raquo;</span>
		</li>
		<?php endif; ?>
	</ul>
</div><!--#content-->