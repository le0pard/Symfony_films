<?php $i = 0; ?>
{ 'theaters': [
<?php foreach($afisha_cinemas as $key=>$row): ?>
<?php echo $i == 0 ? '' : ",\n" ?>
<?php $i++ ?>
{
'id': <?php echo $row->getId()?>,
'title': '<?php echo $row->getTitle() ?>',
'phone': '<?php echo $row->getPhone()?>',
'address': '<?php echo $row->getAddress() ?>',
'link': '<?php echo $row->getLink() ?>'
}
<?php endforeach ?>
]
}