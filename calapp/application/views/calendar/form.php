<div class="col-sm-10 col-sm-offset-2">
<?php
 $this->load->helper('form');
 echo form_open($action,array('role'=>'form'));
 echo '<input type="hidden" name="calId" value="'.$calendarDO->getCalendarId().'" />';
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
 <label for="calendarName">Calendar Name:</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $calendarDO->getCalendarName(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="calendarName" name="calendarName" value="<?php echo $calendarDO->getCalendarName(); ?>" placeholder="Enter a Calendar Name" required="required"/>
 <?php } ?>
</div>


<div class="form-group">
  <label for="siteid">Site:</label>
  <select name="siteid" class="form-control" id="siteid">
   <?php
    $ddo = null;
    while ($siteList->hasMoreSite()) {
     $ddo = $siteList->next($ddo);
	 $v='';
	if ($ddo->getSiteId() == $calendarDO->getSiteId()) $v='selected="selected"';
     echo '<option value="'.$ddo->getSiteId(). '"' . $v .  '>' .   $ddo->getSiteTitle(). '</option>';
    }
   ?>
  </select>
 </div>
 
 <div class="form-group">
  <label for="type">Type:</label>
  <select name="type" class="form-control" id="type">
  
  
  <option value="1" <?php if ($calendarDO->getType() == 1)  echo 'selected="selected"'; ?>>Public</option>
  <option value="2" <?php if ($calendarDO->getType() == 2)  echo 'selected="selected"'; ?> >Private</option>
  </select>
 </div>





<button type="submit" class="btn btn-primary"><?php echo $btnLabel; ?></button>
</form>

<div class="app-form-nav-links">
 <?php echo anchor($backAction, 'Back'); ?>
</div>
</div>