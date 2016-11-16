<div class="col-sm-10 col-sm-offset-2">
<?php
 $this->load->helper('form');
 echo form_open($action,array('role'=>'form'));
 
 if($allocationDO->getUserId() == null) echo '<input type="hidden" name="userId" value="1" />';
 else echo '<input type="hidden" name="userId" value="'. $allocationDO->getUserId().'" />';
 
 if($allocationDO->getCalendarId() == null) echo '<input type="hidden" name="calendarId" value="1" />';
 else echo '<input type="hidden" name="calendarId" value="'.$allocationDO->getCalendarId().'" />';
 
 
 if (isset($msg) && strlen($msg) > 0) {
  if (strcmp($msgType,'error') == 0) {
   echo '<div class="alert alert-danger">';
  }
  elseif (strcmp($msgType,'success') == 0) {
   echo '<div class="alert alert-success">';
  }
  else {
   echo '<div class="alert">';
  }
  echo $msg.validation_errors().'</div>';
 } 
?>


<div class="form-group">
  <label for="userid">Users:</label>
  <select name="userid" class="form-control" id="userid">
   <?php
    $ddo = null;
    while ($userList->hasMoreUsers()) {
     $ddo = $userList->next($ddo);
	 $v='';
	if ($ddo->getUserName() == $allocationDO->getUsername()) $v='selected="selected"';
     echo '<option value="'.$ddo->getUserId(). '"' . $v .  '>' .   $ddo->getUserName(). '</option>';
    }
   ?>
  </select>
 </div>
 
 
 <div class="form-group">
  <label for="calendarid">Calendars:</label>
  <select name="calendarid" class="form-control" id="calendarid">
   <?php
    $ddo = null;
    while ($calendarList->hasMoreCalendars()) {
     $ddo = $calendarList->next($ddo);
	 $v='';
	if ($ddo->getCalendarName() == $allocationDO->getCalendarname()) $v='selected="selected"';
     echo '<option value="'.$ddo->getCalendarId(). '"' . $v .  '>' .   $ddo->getCalendarName(). '</option>';
    }
   ?>
  </select>
 </div>
 

 
 
 


<button type="submit" class="btn btn-primary"><?php echo $btnLabel; ?></button>
</form>

<div class="app-form-nav-links">
 <?php echo anchor($backAction, 'Back'); ?>
</div>
</div>