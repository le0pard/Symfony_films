<div id="content" class="group">
<h1><?php echo $film->getTitle()?>
	<?php if ($film->getOrigTitle()):?>
	 / <?php echo $film->getOrigTitle()?>
	<?php endif ?></h1>

<?php if ($film->getPoster()): ?>
<img class="aligncenter" src="/uploads/afisha_films/<?php echo $film->getPoster() ?>" alt="<?php echo $film->getTitle()?>" title="<?php echo $film->getTitle()?>" />
<?php endif?>
<p><?php echo $film->getDescription(ESC_RAW) ?></p>
<div class="clear"></div>
</div><!--#content-->