<div id="about_cat">
  <div id="hero">
  	<?php if ($cathegory->getLogo()):?>
		<img src="/uploads/cathegory/<?php echo $cathegory->getLogo() ?>" alt="<?php echo $cathegory->getTitle() ?>" title="<?php echo $cathegory->getTitle() ?>" />
	<?php else:?>
		<img src="/uploads/cathegory/default/default.jpg" alt="<?php echo $cathegory->getTitle() ?>" title="<?php echo $cathegory->getTitle() ?>" />
	<?php endif ?>
  </div>
  <div class="round" id="about_cat_text"><div class="r_container">
	  <?php echo $cathegory->getDescription(ESC_RAW) ?><br />
	  <a href="<?php echo url_for('film_types_rss', $cathegory) ?>">RSS</a> 
	  <a href="<?php echo url_for('film_types_atom', $cathegory) ?>">ATOM</a>
	</div></div>
</div>