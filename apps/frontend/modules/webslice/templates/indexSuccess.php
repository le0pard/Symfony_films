<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<title>Афиша кинотеатров - Coocoorooza</title>
	<link href="/css/webslice.css" rel="stylesheet" media="screen" type="text/css" />
  </head>

<body>
<?php foreach($pager->getResults() as $key=>$film): ?>
<ul>
  <li>
	  <a href="#" rel="poster_<?php echo $film->getId() ?>">
	   <?php echo $film->getTitle()?>
	  </a>
  </li>
</ul>
<?php endforeach ?>
<?php foreach($pager->getResults() as $key=>$film): ?> 
<div>
	<div id="poster_<?php echo $film->getId() ?>" class="poster">
		<a href="<?php echo url_for('afisha_film', $film) ?>">
		  <span>
		    <?php if ($film->getPoster()): ?>
				  <img src="/uploads/afisha_films/<?php echo $film->getPoster() ?>" alt="<?php echo $film->getTitle()?>" title="<?php echo $film->getTitle()?>" />
				<?php endif?>
		  </span>
		</a>
	</div>
	<div>
	 <h1><?php echo $film->getTitle()?><?php if ($film->getOrigTitle()):?> / <?php echo $film->getOrigTitle()?><?php endif ?></h1>
	 <p><?php echo strip_tags($film->getDescription(ESC_RAW)) ?></p>
	 <div><a href="<?php echo url_for('afisha_film', $film) ?>" target="_blank">Кинотеатры</a></div>
	</div>
</div>
<?php endforeach ?>
</body>

</html>	