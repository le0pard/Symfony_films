<li>
	<img src="/uploads/posters/<?php echo $row->getThumbLogo() ?>" alt="<?php echo $row->getTitle(); ?>" title="<?php echo $row->getTitle(); ?>" />
	<div class="short_desc">
		<h3><a href="<?php echo url_for('film_show', $row) ?>"><?php echo $row->getTitle() ?></a></h3>
		<div class="short_info">
			<strong>Оригинальное название: </strong><?php echo $row->getOriginalTitle() ?><br />
			<strong>Год: </strong><?php echo $row->getPubYear() ?><br />
		</div>
		<?php echo highlight_result_text(System::jevix_def($row->getAbout(ESC_RAW)), $query); ?>
	</div>	
</li>