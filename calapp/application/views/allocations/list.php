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
 echo '<div>'.anchor('allocations/newAllocation','New Allocation',array('class'=>'btn btn-primary','role'=>'button')).'</div>';
?>
<table class="table">
 <thead>
  <tr>
   <th>User</th>
   <th>Calendar</th>
   <th>Date</th>
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
   while ($allocationList->hasMoreAllocations()) {
    $udo = $allocationList->next($udo);
    echo '<tr><td>'.$udo->getUsername().'</td>';
    echo '<td>'.$udo->getCalendarname().'</td>';
    echo '<td>'.$udo->getADate().'</td>';
    echo '<td>'.anchor('allocations/edit/'.$udo->getUserId().'/'.$udo->getCalendarId(),'Edit').'</td>';
    echo '<td>'.anchor('allocations/remove/'.$udo->getUserId().'/'.$udo->getCalendarId(),'Remove').'</td>';
    $i = $i + 1;
   }
  ?>
 </tbody>
</table>
</div>