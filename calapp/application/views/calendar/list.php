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
 echo '<div>'.anchor('calendar/newCalendar','New Calendar',array('class'=>'btn btn-primary','role'=>'button')).'</div>';
?>
<table class="table">
 <thead>
  <tr>
   <th>Calendar ID</th>
   <th>Calendar Name</th>
   <th>Site</th>
   <th>&nbsp;</th>
   <th>&nbsp;</th>
   <th>&nbsp;</th>
   <th>&nbsp;</th>
  </tr>
 </thead>
 <tbody>
  <?php 
   $i = 1;
   $udo = null;
   while ($calendarList->hasMoreCalendars()) {
    $udo = $calendarList->next($udo);
    echo '<tr><td>'.$udo->getCalendarId().'</td>';
    echo '<td>'.$udo->getCalendarName().'</td>';
    echo '<td>'.$udo->getSiteId().'</td>';
    echo '<td>'.anchor('calendar/edit/'.$udo->getCalendarId(),'Edit').'</td>';
    echo '<td>'.anchor('calendar/remove/'.$udo->getCalendarId(),'Remove').'</td>';
    $i = $i + 1;
   }
  ?>
 </tbody>
</table>
</div>