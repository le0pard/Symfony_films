<li>
<a href="<?php echo url_for('@mobile_afisha_film?id='.$film->getId()) ?><?php if (isset($city_id_params)):?>?city_id=<?php echo $city_id_params ?><?php endif ?>"><?php echo $film->getTitle() ?> <span class="date">год: <?php echo $film->getYear() ?></span></a> 
</li>