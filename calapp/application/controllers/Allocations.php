<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
	Calendar Application
	
	Calendar.php - Controller for Calendar menu item.
*/


/*******************/
require 'MainCalendarApp.php';
/*******************/

class Allocations extends MainCalendarApp {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',1);
 }
 
 /**
	Display first page
*/
  public function index() {
	$this->showAllocationList(array());
 }
 
 /**
  * show the calendar list
  * @param array $data
  */
 private function showAllocationList(array $data) {
  
  $this->load->model('AllocationM');
  $data['allocationList'] = $this->AllocationM->getAllocations();
  $this->displayPageWithData('allocations/list', $data);
 
 }
 
 public function newAllocation()
 {
	$this->load->model('AllocationM');
	$data['allocationDO'] = DOFactory::getInstance()->createDO(DOEnum::AllocationDO,array(array('USERID'=>'0','CALENDARID'=>'0')));
	

	$this->load->model('User');
	$data['userList'] = $this->User->getUsers();
	
	$this->load->model('CalendarM');
	$data['calendarList'] = $this->CalendarM->getCalendars();
  
	$this->showNewAllocationForm($data);
 
 }
 

 
 
 public function insertAllocation()
 {
	  $this->load->model('AllocationM');
	  $data = $this->AllocationM->insertAllocation();
	  
	  if ($data['msgType'] == 'error') {
	   $this->showNewAllocationForm($data);
	  }
	  else {
	   $this->showAllocationList($data);
	  }
 
 }
 
  
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for creating a new user
  * @param array $data
  */
 private function showNewAllocationForm(array $data) {
  $data['mode'] = 'new';
  $data['action'] = 'allocations/insertAllocation';
  $data['btnLabel'] = 'Create Allocation';
  $data['backAction'] = 'allocations/index';
  //$this->showCalendarForm($data);
  $this->displayPageWithData('allocations/form', $data);
 }
 
 
 
  public function edit($userid,$calendarid) {
  $udo = $this->getAllocation($userid,$calendarid);
  if ($udo === FALSE) {
   $this->showAllocationList(array());
  }
  else {
   $data['allocationDO'] = $udo;

    $this->load->model('User');
   $data['userList'] = $this->User->getUsers();
   $this->load->model('CalendarM');
   $data['calendarList'] = $this->CalendarM->getCalendars();
   $this->showEditAllocationForm($data);
  }
 }
 
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for editing an user
  * @param array $data
  */
 private function showEditAllocationForm($data) {
  $data['mode'] = 'edit';
  $data['action'] = 'allocations/updateAllocation';
  $data['btnLabel'] = 'Save Changes';
  $data['backAction'] = 'allocations/index';
 // $this->showCalendarForm($data);
 $this->displayPageWithData('allocations/form', $data);
 }
 
 
 
 /* 
	Remove calendar
*/
public function remove($userid,$calendarid) {
 
  $udo = $this->getAllocation($userid,$calendarid);
  if ($udo === FALSE) {
   $this->showAllocationList(array());
  }
  else {
   $data['allocationDO'] = $udo;
   $this->load->model('User');
   $data['userList'] = $this->User->getUsers();
   $this->load->model('CalendarM');
   $data['calendarList'] = $this->CalendarM->getCalendars();
   $this->showRemoveAllocationForm($data);
  }
}

 public function removeAllocation() {
  
  $this->load->model('AllocationM');
 
  $this->showAllocationList($this->AllocationM->deleteAllocation());
 }
 
  /**
  * set the parameters for the create/edit form and show the form
  * @param array $data
  */
 private function showRemoveAllocationForm($data) {
  $data['mode'] = 'remove';
  $data['action'] = 'allocations/removeAllocation';
  $data['btnLabel'] = 'Remove';
  $data['backAction'] = 'allocations/index';
  //$this->showCalendarForm($data);
  $this->displayPageWithData('allocations/form', $data);
 }
 
 protected function getAllocation($userid,$calendarid) {
  //if (is_numeric($calendarId)) {
   $this->load->model('AllocationM');
   $udo = $this->AllocationM->getAllocationFromID(DOFactory::getInstance()->createDO(DOEnum::AllocationDO,array('USERID'=>$userid,'CALENDARID'=>$calendarid)));
   
   //print_r(array('SITEID'=>$siteId));
  // if (strlen($udo->getUserName()) > 0) {
  

    return $udo;
  // }
 //}
 // return false;
 }
 
 
  public function updateAllocation() {
  $this->load->model('AllocationM');
  $data = $this->AllocationM->updateAllocation();
  if ($data['msgType'] == 'error') {
   $this->showEditAllocationForm($data);
  }
  else {
   $this->showAllocationList($data);
  }
 }
 
 
}

?>