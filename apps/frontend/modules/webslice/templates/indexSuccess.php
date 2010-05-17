<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<title>Афиша кинотеатров - Coocoorooza</title>
	<link href="/css/webslice.css" rel="stylesheet" media="screen" type="text/css" />
	<script type="text/javascript" src="/js/jquery/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery/easy_slider.jquery.js"></script>
	<script type="text/javascript" src="/js/frontend_less_routes_.js"></script>
  </head>

<body>
<div id="top_menu">
</div>

<div id="slider">
  <ul>
    <?php foreach($pager->getResults() as $key=>$film): ?>
    <li>
      <div class="cinema_title"><?php echo $film->getTitle()?> 
        <span><a href="<?php echo url_for('afisha_film', $film) ?>" target="_blank">Кинотеатры</a></span>
      </div>
      <div class="cinema_info">
        <a href="<?php echo url_for('afisha_film', $film) ?>" target="_blank">
          <span class="poster">
            <?php if ($film->getPoster()): ?>
              <img src="/uploads/afisha_films/<?php echo $film->getPoster() ?>" alt="<?php echo $film->getTitle()?>" title="<?php echo $film->getTitle()?>" />
            <?php endif?>
          </span>
        </a>
      </div>
      <div class="cinema_data">
        <p><?php echo strip_tags($film->getDescription(ESC_RAW)) ?></p>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
</div>

	<div id="navigation">
		<div id="prevBtn"></div> 
		<div id="nextBtn"></div>
		<div id="selector_city">
		  <select id="ch_city" name="city_id">
        <?php foreach($selected_country->getCities() as $city):?>
          <option <?php $city->getId() == $selected_city->getId() and print 'selected="selected"' ?> value="<?php echo $city->getId();?>"><?php echo $city->getTitle();?></option>
        <?php endforeach?>
      </select>
		</div>
	</div>
</div>
</div>

	<script type="text/javascript">
		$(document).ready(function(){
		  $("#slider").easySlider({
			   prevId: 'prevBtn',
				 nextId: 'nextBtn'
			});
			$("#ch_city").bind('change', function(){
				location.href = service_webslice_city_path($(this).val());
			});
		});
	</script>
</body>

</html>	