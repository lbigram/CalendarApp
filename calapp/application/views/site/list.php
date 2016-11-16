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
 echo '<div>'.anchor('site/newSite','New Site',array('class'=>'btn btn-primary','role'=>'button')).'</div>';
?>
<table class="table">
 <thead>
  <tr>
   <th>Site ID</th>
   <th>Site Name</th>
   <th>URL</th>
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
   while ($siteList->hasMoreSite()) {
    $udo = $siteList->next($udo);
    echo '<tr><td>'.$udo->getSiteId().'</td>';
    echo '<td>'.$udo->getSiteTitle().'</td>';
    echo '<td>'.$udo->getSiteURL().'</td>';
    echo '<td>'.anchor('site/edit/'.$udo->getSiteId(),'Edit').'</td>';
    echo '<td>'.anchor('site/remove/'.$udo->getSiteId(),'Remove').'</td>';
    $i = $i + 1;
   }
  ?>
 </tbody>
</table>
</div>