<?php echo $user_data->getLogin() ?>
<div>
	<?php if ($jevix && $about_data): ?>
		<?php echo $sf_data->getRaw('about_data') ?>
	<?php else: ?>
		<?php echo $user_data->getAbout(); ?>
	<?php endif ?>
</div>
