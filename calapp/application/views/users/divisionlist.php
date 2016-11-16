<div class="col-sm-10 col-sm-offset-2">
<?php 
 echo '<div><p>User: '.$userDO->getUserName().'</p></div>'; 
 $this->load->helper('form');
 echo form_open('admin/updateDivisionAccess',array('role'=>'form'));
 $ddo = null;
 while ($divisionList->hasMoreDivisions()) {
  $ddo = $divisionList->next($ddo);
  echo '<div class="form-group"><div class="checkbox"><label>';
  echo '<input name="divisionId[]" type="checkbox" value="'.$ddo->getDivCode().'" '.(array_key_exists($ddo->getDivCode(),$userDivisionList)?'checked="checked"':'').'/>'.$ddo->getDivName();
  echo '</label></div></div>';
 }
 echo '<button type="submit" class="btn btn-primary">Set Access</button>';
 echo '</form>';
?>
<div class="app-form-nav-links">
 <?php echo anchor('admin/userList', 'Back'); ?>
</div>
</div>