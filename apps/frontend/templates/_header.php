<div id="top">
	<div id="feeds">
		<div id="rss">
			<a href="<?php echo url_for('@film_types_all_rss') ?>" class="rss">RSS</a> <a href="<?php echo url_for('@film_types_all_atom') ?>" class="atom">Atom</a>
		</div>
		
		<div id="twitter">
			<a href="http://twitter.com/coocoorooza" target="_blank">Twitter</a>
		</div>
	</div>

	<div id="logo">
		<a href="<?php echo url_for('@homepage') ?>">
			<img src="/images/logo.png" alt="Coocoorooza" title="Coocoorooza" />
		</a>
	</div>

	<ul id="menu_2">
		<li>
			<a href="#">Категории</a>
		</li>
		<li>
			<a href="#">Категории</a>
		</li>
		<li>
			<a href="#">Категории</a>
		</li>
	</ul>

	<div id="top_search">
		<form action="<?php echo url_for('@search') ?>" method="get">
			<div>
				<div id="search_field_auto_complete" class="autocomplete"></div>
				<input id="search_field" name="s" type="text" value="Поиск" />
				<div class="loader">
					<img id="search_indicator" src="/images/ajax-loader.gif"  alt="Загрузка" style="display:none;" />
				</div>
			</div>
		</form>
	</div>
	
	<?php include_component('static', 'menu', array('sf_cache_key' => 'menu')) ?>

</div>




