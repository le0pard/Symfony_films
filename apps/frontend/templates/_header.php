<div id="header">
	<a href="<?php echo url_for('@homepage') ?>">
		<img src="/images/logo.png" alt="logo" />
	</a>
	<form action="<?php echo url_for('@search') ?>" method="GET">
		<input id="search_field" type="text" name="s" value="" />
		<img id="search_indicator" alt="indicator" src="/images/spinner.gif" style="display:none;" />
		<div id="search_field_auto_complete" class="auto_complete"></div>
	</form>
</div>