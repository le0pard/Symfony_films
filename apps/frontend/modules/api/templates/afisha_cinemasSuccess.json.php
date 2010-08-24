<?php 
  $afisha = array(); 
  $afisha['afisha'] = array();
  $afisha['cinemas'] = array();
  $cinemas = array();
?>
<?php foreach($afisha_cinemas as $key=>$row): ?>
<?php
   $afisha['afisha'][] = array(
    'id' => $row->getId(),
    'theater_id' => $row->getAfishaTheaterId(),
    'cinema_id' => $row->getAfishaFilmId(), 
    'zal_title' => $row->getAfishaZal()->getTitle(),
		'date_begin' => $row->getDateBegin(),
		'date_end' => $row->getDateEnd(),
		'times' => $row->getTimes(),
		'prices' => $row->getPrices()
   );
?>
<?php if ($row->getAfishaFilm() && !array_key_exists($row->getAfishaFilm()->getId(), $cinemas)):?>
<?php $cinemas[$row->getAfishaFilm()->getId()] = $row->getAfishaFilm(); ?>
<?php endif ?>
<?php endforeach ?>
<?php foreach($cinemas as $key=>$row): ?>
<?php
   $afisha['cinemas'][] = array(
    'id' => $row->getId(),
    'title' => $row->getTitle(),
    'orig_title' => $row->getOrigTitle(), 
    'year' => $row->getYear(),
    'poster' => $row->getPoster(),
    'link' => $row->getLink(),
    'description' => strip_tags($row->getDescription(ESC_RAW))
   );
?>
<?php endforeach ?>
<?php echo json_encode($afisha) ?>