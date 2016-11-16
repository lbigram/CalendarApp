<div class="col-sm-10 col-sm-offset-2">
<?php
 $this->load->helper('form');
 echo form_open($action,array('role'=>'form'));
 echo '<input type="hidden" name="userId" value="'.$userDO->getUserId().'" />';
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
 <label for="userName">Name</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $userDO->getUserName(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $userDO->getUserName(); ?>" placeholder="Enter the users name" required="required"/>
 <?php } ?>
</div>
<div class="form-group">
 <label for="ldapUserCode">LDAP User Name</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $userDO->getLdapUserCode(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="ldapUserCode" name="ldapUserCode" value="<?php echo $userDO->getLdapUserCode(); ?>" placeholder="Enter the users ldap user name" required="required"/>
 <?php } ?>
</div>
<div class="form-group">
 <label for="isAdmin">Is Admin</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo ($userDO->getIsAdmin()==1?'Yes':'No'); ?></p>
 <?php } else { ?>
 <select name="isAdmin" id="isAdmin" class="form-control">
  <option value="1" <?php if ($userDO->getIsAdmin() == 1) {echo 'selected="selected"';} ?>>Yes</option>
  <option value="0" <?php if ($userDO->getIsAdmin() == 0) {echo 'selected="selected"';} ?>>No</option>
 </select>
 <?php } ?>
</div>
<div class="form-group">
 <label for="userActive">Status</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo ($userDO->getUserActive()==1?'Active':'In Active'); ?></p>
 <?php } else { ?>
 <select name="userActive" id="userActive" class="form-control">
  <option value="1" <?php if ($userDO->getUserActive() == 1) {echo 'selected="selected"';} ?>>Active</option>
  <option value="0" <?php if ($userDO->getUserActive() == 0) {echo 'selected="selected"';} ?>>Inactive</option>
 </select>
 <?php } ?>
</div>
<button type="submit" class="btn btn-primary"><?php echo $btnLabel; ?></button>
</form>

<div class="app-form-nav-links">
 <?php echo anchor($backAction, 'Back'); ?>
</div>
</div>