<?php 
  $theaters = array();
  $theaters['theaters'] = array();
?>
<?php foreach($afisha_cinemas as $key=>$row): ?>
<?php
   $theaters['theaters'][] = array(
    'id' => $row->getId(),
    'city_id' => $row->getAfishaCityId(),
    'title' => $row->getTitle(),
    'phone' => $row->getPhone(), 
    'address' => $row->getAddress(),
    'link' => $row->getLink(),
    'latitude' => $row->getLatitude(),
    'longitude' => $row->getLongitude(),
    'call_phone' => $row->getNormalTelephone()
   );
?>
<?php endforeach ?>
<?php echo json_encode($theaters) ?>