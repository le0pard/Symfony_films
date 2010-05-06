<li>
<a href="<?php echo url_for('@film_mobile?id='.$film->getId()) ?>"><?php echo $film->getTitle();?> <span class="date"><?php echo strftime('%d.%m.%Y', $film->getModifiedAt('U')) ?></span></a>
</li>