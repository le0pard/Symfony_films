<?php use_helper('sfLucene') ?>

<?php slot('title') ?>
  Поиск - Coocoorooza
<?php end_slot(); ?>

<div class="round" id="search_field">
	<div class="r_container">
	  <form action="<?php echo url_for('@search') ?>" method="get">
		<div><label for="search">Поиск</label></div>
		<div style="white-space:nowrap">
		<input id="search" type="text"  name="s" value="<?php echo $query?>" />&nbsp;
		<input class="css_button" type="submit" value="Найти" /></div>
	  </form>
	  <div class="tip"><a id="search_tip" href="javascript:return false;">Справка</a></div>
	  <div id="search_tip_descr" style="display:none;">
	  	<strong>Методы поиска:</strong><br />
	  	"один два" - поиск точно по "один два"<br />
	  	один & один - поиск c фразой "один" И с фразой "два"<br />
	  	один | два - поиск с фразой "один" ИЛИ с фразой "два"
	  </div>
	</div>
</div>

<?php if ('sphinx' == sfConfig::get('app_search_method') && isset($pager) && isset($sphinx)): ?>
	
	<?php if (count($pager->getResults()) > 0):?>
		<?php if ($sphinx->getLastWarning()): ?>
		Warning: <?php echo $sphinx->getLastWarning() ?>
		<?php endif ?>
		<ul id="search_result">
		<?php foreach($pager->getResults() as $key=>$row): ?>
			<?php include_partial('search/search_row', array('row' => $row, 'query' => $query)) ?>
		<?php endforeach ?>
		</ul>
	<?php else:?>
		<div class="search_not_found">По вашему запросу ничего не найдено. Попробуйте изменить его.</div>
	<?php endif?>

<?php else: ?>
	<?php if (isset($search_res) && count($search_res) > 0): ?>
		<ul id="search_result">
		<?php foreach($search_res as $row): ?>
			<?php include_partial('search/search_row', array('row' => $row, 'query' => $query)) ?>
		<?php endforeach ?>
		</ul>
	<?php else:?>
		<div class="search_not_found">По вашему запросу ничего не найдено. Попробуйте изменить его.</div>
	<?php endif ?>
<?php endif ?>
