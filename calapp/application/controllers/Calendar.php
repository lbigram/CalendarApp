<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
	Calendar Application
	
	Calendar.php - Controller for Calendar menu item.
*/


/*******************/
require 'MainCalendarApp.php';
/*******************/

class Calendar extends MainCalendarApp {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',1);
 }
 
 /**
	Display first page
*/
  public function index() {
	$this->showCalendarList(array());
 }
 
 /**
  * show the calendar list
  * @param array $data
  */
 private function showCalendarList(array $data) {
  
  $this->load->model('CalendarM');
  $data['calendarList'] = $this->CalendarM->getCalendars();
  $this->displayPageWithData('calendar/list', $data);
 
 }
 
 public function newCalendar()
 {
	$this->load->model('CalendarM');
	$data['calendarDO'] = DOFactory::getInstance()->createDO(DOEnum::CalendarDO,array());
	
	$this->load->model('SiteM');
	$data['siteList'] = $this->SiteM->getSites();
  
	$this->showNewCalendarForm($data);
 
 }
 
 public function insertCalendar()
 {
	  $this->load->model('CalendarM');
	  $data = $this->CalendarM->insertCalendar();
	  if ($data['msgType'] == 'error') {
	   $this->showNewCalendarForm($data);
	  }
	  else {
	   $this->showCalendarList($data);
	  }
 
 }
 
  
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for creating a new user
  * @param array $data
  */
 private function showNewCalendarForm(array $data) {
  $data['mode'] = 'new';
  $data['action'] = 'calendar/insertCalendar';
  $data['btnLabel'] = 'Create Calendar';
  $data['backAction'] = 'calendar/index';
  //$this->showCalendarForm($data);
  $this->displayPageWithData('calendar/form', $data);
 }
 
 
 
  public function edit($calId) {
  $udo = $this->getCalendar($calId);
  if ($udo === FALSE) {
   $this->showCalendarList(array());
  }
  else {
   $data['calendarDO'] = $udo;
   
   $this->load->model('SiteM');
   $data['siteList'] = $this->SiteM->getSites();
   
   $this->showEditCalendarForm($data);
  }
 }
 
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for editing an user
  * @param array $data
  */
 private function showEditCalendarForm($data) {
  $data['mode'] = 'edit';
  $data['action'] = 'calendar/updateCalendar';
  $data['btnLabel'] = 'Save Changes';
  $data['backAction'] = 'calendar/index';
 // $this->showCalendarForm($data);
 $this->displayPageWithData('calendar/form', $data);
 }
 
 
 
 /* 
	Remove calendar
*/
public function remove($calendarId) {
  $udo = $this->getCalendar($calendarId);
  if ($udo === FALSE) {
   $this->showCalendarList(array());
  }
  else {
   $data['calendarDO'] = $udo;
  
	$this->load->model('SiteM');
   $data['siteList'] = $this->SiteM->getSites();
  
  $this->showRemoveCalendarForm($data);
  }
}

 public function removeCalendar() {
  $this->load->model('CalendarM');
 
  $this->showCalendarList($this->CalendarM->deleteCalendar());
 }
 
  /**
  * set the parameters for the create/edit form and show the form
  * @param array $data
  */
 private function showRemoveCalendarForm($data) {
  $data['mode'] = 'remove';
  $data['action'] = 'calendar/removeCalendar';
  $data['btnLabel'] = 'Remove';
  $data['backAction'] = 'calendar/index';
  //$this->showCalendarForm($data);
  $this->displayPageWithData('calendar/form', $data);
 }
 
 protected function getCalendar($calendarId) {
  //if (is_numeric($calendarId)) {
   $this->load->model('CalendarM');
   $udo = $this->CalendarM->getCalendarFromID(DOFactory::getInstance()->createDO(DOEnum::CalendarDO,array('IDCALENDAR'=>$calendarId)));
   
   //print_r(array('CALENDAR_ID'=>$calendarId));
  // if (strlen($udo->getUserName()) > 0) {
  

    return $udo;
  // }
 //}
 // return false;
 }
 
 
  public function updateCalendar() {
	  $this->load->model('CalendarM');
	  $data = $this->CalendarM->updateCalendar();
	  if ($data['msgType'] == 'error') {
	   $this->showEditCalendarForm($data);
	  }
	  else {
	   $this->showCalendarList($data);
	  }
 }
 
 public function getCalendarListing(){
 
	$this->load->model("CalendarM");
	$t = $this->CalendarM->getCalendarListing();
	
	
	
	echo json_encode($t);
 }
 
 
  public function getCalendarListing2(){
 
	$this->load->model("CalendarM");
	$t = $this->CalendarM->getCalendarListing2();
	
	
	
	echo json_encode($t);
 }
 
 
 
 
 

 
 
}

?>