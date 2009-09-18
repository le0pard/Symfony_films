<div id="header">
	<a href="<?php echo url_for('@homepage') ?>">
		<img src="/images/logo.png" alt="logo" />
	</a>
	<form action="<?php echo url_for('@search') ?>" method="get">
		<input type="text" name="s" value="" />
	</form>
</div>