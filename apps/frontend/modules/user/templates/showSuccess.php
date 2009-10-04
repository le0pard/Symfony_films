<?php echo $user_data->getLogin() ?>
<div>
	<?php if (isset($jevix)): ?>
		<?php $errors = null ?>
		<?php echo $jevix->parse($user_data->getAbout(ESC_RAW), $errors, ESC_RAW); ?>
	<?php else: ?>
		<?php echo $user_data->getAbout(); ?>
	<?php endif ?>
</div>
