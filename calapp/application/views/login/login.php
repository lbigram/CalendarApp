<?php
 $this->load->helper('form');
 echo form_open('main/verifyLogon',array('role'=>'form'));
 if (isset($msg) && strlen($msg) > 0) {
  echo '<div class="alert alert-danger">'.$msg.validation_errors().'</div>';
 } 
?>
 <div class="form-group">
  <label for="username">User name</label>
  <input type="text" class="form-control" id="username" name="username" placeholder="Enter user name" required="required"/>
 </div>
 <div class="form-group">
  <label for="userPassword">Password</label>
  <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Enter password" required="required"/>
 </div>
<button type="submit" class="btn btn-primary">Sign In</button>
</form>