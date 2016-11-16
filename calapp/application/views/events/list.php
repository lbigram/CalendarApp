<div class="col-sm-10 col-sm-offset-2">
<?php 
 if (isset($msg) && strlen($msg) > 0) { //display the message
  if ($msgType == 'error') {
   echo '<div class="alert alert-danger">';
  }
  elseif ($msgType == 'success') {
   echo '<div class="alert alert-success">';
  }
  else {
   echo '<div class="alert">';
  }
  echo $msg.'</div>';
 }
 echo '<div>'.anchor('events/newEvent','New Event',array('class'=>'btn btn-primary','role'=>'button')).'</div>';
?>
<table class="table">
 <thead>
  <tr>
   <th>Name</th>
   <th>Location</th>
   <th>Presenter</th>
   <th>Date</th>
   <th>Start Time</th>
   <th>Details</th>
   <th>Calendar</th>
   <th>&nbsp;</th>
   <th>&nbsp;</th>
  </tr>
 </thead>
 <tbody>
  <?php 
   $i = 1;
   $udo = null;
   while ($eventList->hasMoreEvents()) {
    $udo = $eventList->next($udo);
    echo '<tr><td>'.$udo->getEventname().'</td>';
    echo '<td>'.$udo->getLocation().'</td>';
	echo '<td>'.$udo->getPresenter().'</td>';
	echo '<td>'.$udo->getSdate().'</td>';
	echo '<td>'.$udo->getStime().'</td>';
    echo '<td>'.$udo->getDetails().'</td>';
	echo '<td>'.$udo->getCalendarname().'</td>'; 
    echo '<td>'.anchor('events/edit/'.$udo->getEventid(),'Edit').'</td>';
    echo '<td>'.anchor('events/remove/'.$udo->getEventid(),'Remove').'</td>';
    $i = $i + 1;
   }
  ?>
 </tbody>
</table>
</div>