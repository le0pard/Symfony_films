<li>
<a href="<?php echo url_for('@film_mobile?id='.$row->getId()) ?>"><?php echo $row->getTitle();?> <span class="date"><?php echo strftime('%d.%m.%Y', $row->getModifiedAt('U')) ?></span></a>
</li>