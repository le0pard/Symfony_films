<div id="top">
	<div id="feeds">
		<div id="rss">
			<a href="<?php echo url_for('@film_types_all_rss') ?>" class="rss">RSS</a> <a href="<?php echo url_for('@film_types_all_atom') ?>" class="atom">Atom</a>
		</div>
		
		<div id="twitter">
			<a href="http://twitter.com/coocoorooza" onclick="window.open(this.href);return false;">Twitter</a>
		</div>
	</div>

	<div id="logo">
		<a href="<?php echo url_for('@homepage') ?>">
			<img src="/images/logo.png" alt="Coocoorooza" title="Coocoorooza" />
		</a>
	</div>

	<ul id="menu_2">
		<li>
			<a href="<?php echo url_for('@static_page_rules') ?>">Правила</a>
		</li>
		<li>
			<a href="<?php echo url_for('@static_page_verlihub') ?>">DC++: мануал</a>
		</li>
		<li>
			<a href="<?php echo url_for('@static_page_jabber') ?>">Jabber: мануал</a>
		</li>
	</ul>

	<div id="top_search">
		<form action="<?php echo url_for('@search') ?>" method="get">
			<div>
				<div id="search_field_auto_complete" class="autocomplete"></div>
				<input id="search_field_input" name="s" type="text" value="Поиск" />
				<div class="loader">
					<img id="search_indicator" src="/images/ajax-loader.gif"  alt="Загрузка" style="display:none;" />
				</div>
			</div>
		</form>
	</div>
	
	<?php include_component('static', 'menu', array('sf_cache_key' => 'menu')) ?>

</div>




