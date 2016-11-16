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
 echo '<div>'.anchor('admin/newUser','New User',array('class'=>'btn btn-primary','role'=>'button')).'</div>';
?>
<table class="table">
 <thead>
  <tr>
   <th>#</th>
   <th>Name</th>
   <th>LDAP User Name</th>
   <th>Is Admin</th>
   <th>Status</th>
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
   while ($userList->hasMoreUsers()) {
    $udo = $userList->next($udo);
    echo '<tr><td>'.$i.'</td><td>'.$udo->getUserName().'</td>';
    echo '<td>'.$udo->getLdapUserCode().'</td>';
    echo '<td>'.($udo->getIsAdmin()==1?'Yes':'No').'</td>';
    echo '<td>'.($udo->getUserActive()==1?'Active':'Inactive').'</td>';
    echo '<td>'.anchor('admin/edit/'.$udo->getUserId(),'Edit').'</td>';
    echo '<td>'.anchor('admin/remove/'.$udo->getUserId(),'Remove').'</td>';
    //echo '<td>'.anchor('admin/userDivisionList/'.$udo->getUserId(),'Division Access').'</td></tr>';
    $i = $i + 1;
   }
  ?>
 </tbody>
</table>
</div>