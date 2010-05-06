<hr>
<h2 class="table-title" id="pages">Страницы</h2>
<ul class="disclosure table group">
<li class="page_item page-item-1"><a title="Фильмы" href="<?php echo url_for('@homepage_mobile') ?>">Фильмы</a></li>
<li class="page_item page-item-2"><a title="Афиша" href="<?php echo url_for('@mobile_afisha') ?>">Афиша</a></li>
</ul>
<hr>
<p class="navigation" id="navigation-bottom">
<a href="<?php echo url_for('@homepage_mobile') ?>" class="to-home">Главная</a> | 
<a href="<?php echo url_for('@homepage_mobile') ?>">Фильмы</a> | 
<a href="<?php echo url_for('@mobile_afisha') ?>">Афиша</a>
</p>
<hr>

<div id="footer">
<p>
<a href="<?php echo url_for('@homepage_standard') ?>">Выйти из мобильного режима</a> 
<span class="small">(стандартная версия для браузера)</span>.
</p>
<hr>
<p class="small">
Powered by <a onclick="return false;" href="#"><strong>Symfony</strong></a>.
</p>
<p id="developer-link">
	<a href="http://leopard.in.ua" rel="developer" title="Development">Developed by Leopard</a>
</p>
<div class="clear"></div>
</div>