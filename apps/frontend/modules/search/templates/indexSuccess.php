<?php use_helper('sfLucene') ?>
<?php if ('sphinx' == sfConfig::get('app_search_method') && isset($pager) && isset($sphinx)): ?>
	
	<?php if ($sphinx->getLastWarning()): ?>
	Warning: <?php echo $sphinx->getLastWarning() ?>
	<?php endif ?>
	<ul>
	<?php foreach($pager->getResults() as $key=>$row): ?>
		<li>
			<a href="<?php echo url_for('film_show', $row) ?>">
				<?php echo highlight_keywords($row->getTitle(), $query) ?>
			</a>
			<p>
				<?php echo highlight_result_text(System::jevix_def($row->getAbout(ESC_RAW)), $query); ?>
			</p>
		</li>
	<?php endforeach ?>
	</ul>
	<div class="clear"></div> 

<?php else: ?>

	<?php if ($search_res): ?>
		<ul>
		<?php foreach($search_res as $row): ?>
			<li>
				<a href="<?php echo url_for('film_show', $row) ?>">
					<?php echo highlight_keywords($row->getTitle(), $query) ?>
				</a>
				<p>
					<?php echo highlight_result_text(System::jevix_def($row->getAbout(ESC_RAW)), $query); ?>
				</p>
			</li>
		<?php endforeach ?>
		</ul>
	<?php endif ?>

<?php endif ?>
