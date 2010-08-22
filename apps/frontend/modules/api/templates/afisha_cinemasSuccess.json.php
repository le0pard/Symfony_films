<?php $i = 0; ?>
<?php $cinemas = array(); ?>
{ 'afisha': [
<?php foreach($afisha_cinemas as $key=>$row): ?>
<?php echo $i == 0 ? '' : ",\n" ?>
<?php $i++ ?>
{
'id': <?php echo $row->getId()?>,
'theater_id': <?php echo $row->getAfishaTheaterId() ?>,
'cinema_id': <?php echo $row->getAfishaFilmId() ?>,
'zal_title': '<?php echo $row->getAfishaZal()->getTitle() ?>',
'date_begin': '<?php echo $row->getDateBegin() ?>',
'date_end': '<?php echo $row->getDateEnd() ?>',
'times': '<?php echo $row->getTimes() ?>',
'prices': '<?php echo $row->getPrices() ?>'
}
<?php if ($row->getAfishaFilm() && !array_key_exists($row->getAfishaFilm()->getId(), $cinemas)):?>
<?php $cinemas[$row->getAfishaFilm()->getId()] = $row->getAfishaFilm(); ?>
<?php endif ?>
<?php endforeach ?>
],
<?php $i = 0; ?>
'cinemas': [
<?php foreach($cinemas as $key=>$row): ?>
<?php echo $i == 0 ? '' : ",\n" ?>
<?php $i++ ?>
{
'id': <?php echo $row->getId()?>,
'title': '<?php echo $row->getTitle() ?>',
'orig_title': '<?php echo $row->getOrigTitle()?>',
'year': '<?php echo $row->getYear() ?>',
'poster': '<?php echo $row->getPoster() ?>',
'link': '<?php echo $row->getLink() ?>',
'description': '<?php echo strip_tags($row->getDescription(ESC_RAW)) ?>'
}
<?php endforeach ?>
]
}