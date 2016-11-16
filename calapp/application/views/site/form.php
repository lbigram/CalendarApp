<div class="col-sm-10 col-sm-offset-2">
<?php
 $this->load->helper('form');
 echo form_open($action,array('role'=>'form'));
 echo '<input type="hidden" name="siteId" value="'.$siteDO->getSiteId().'" />';
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
 <label for="siteTitle">Site Title:</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $siteDO->getSiteTitle(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="siteTitle" name="siteTitle" value="<?php echo $siteDO->getSiteTitle(); ?>" placeholder="Enter a Site Title" required="required"/>
 <?php } ?>
</div>


<div class="form-group">
 <label for="siteURL">Site URL:</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $siteDO->getSiteURL(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="siteURL" name="siteURL" value="<?php echo $siteDO->getSiteURL(); ?>" placeholder="Enter a Site URL" required="required"/>
 <?php } ?>
</div>





<button type="submit" class="btn btn-primary"><?php echo $btnLabel; ?></button>
</form>

<div class="app-form-nav-links">
 <?php echo anchor($backAction, 'Back'); ?>
</div>
</div>