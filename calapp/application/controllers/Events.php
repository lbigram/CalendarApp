<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
	Calendar Application
	
	Calendar.php - Controller for Calendar menu item.
*/


/*******************/
require 'MainCalendarApp.php';
/*******************/

class Events extends MainCalendarApp {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',1);
 }
 
 /**
	Display first page
*/
  public function index() {
	$this->showEventList(array());
 }
 
 /**
  * show the calendar list
  * @param array $data
  */
 private function showEventList(array $data) {
  
 
  
  $this->load->model('AllocationM');
  $found = $this->AllocationM->getAllocations2($this->session->userdata('userId'));
  
	$i = 1;
	$where = ' c.idcalendar IN (';
	$udo = null;
   while ($found->hasMoreAllocations()) {
    $udo = $found->next($udo);
    $where = $where . $udo->getCalendarId();
	$where = $where . ' ,';
   }
   $where = $where . '0) group by idevents ';
   
    $this->load->model('EventM');
  $data['eventList'] = $this->EventM->getEvents($where);
  
  
  $this->displayPageWithData('events/list', $data);
 
 }
 
 public function newEvent()
 {
	$this->load->model('EventM');
	$data['eventDO'] = DOFactory::getInstance()->createDO(DOEnum::EventDO,array(array()));
	
	$this->load->model('AllocationM');
	$data['calendarList'] = $this->AllocationM->getAllocations2($this->session->userdata('userId'));

	$this->showNewEventForm($data);
 
 }
 

 
 
 public function insertEvent()
 {
	  $this->load->model('EventM');
	  $data = $this->EventM->insertEvent();
	  
	  
	  $this->load->model("FilterM");
	  $data2 = $this->FilterM->insertFilters($data['id']);
	  
	  if ($data['msgType'] == 'error') {
	   $this->showNewEventForm($data);
	  }
	  else {
	   $this->showEventList($data);
	  }
 
 }
 
  
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for creating a new user
  * @param array $data
  */
 private function showNewEventForm(array $data) {
  $data['mode'] = 'new';
  $data['action'] = 'events/insertEvent';
  $data['btnLabel'] = 'Create Event';
  $data['backAction'] = 'events/index';
  //$this->showCalendarForm($data);
  $this->displayPageWithData('events/form', $data);
 }
 
 
 
  public function edit($eventid) {
  $udo = $this->getEvent($eventid);
  if ($udo === FALSE) {
   $this->showEventList(array());
  }
  else {
   $data['eventDO'] = $udo;

   
   $this->load->model('AllocationM');
	$data['calendarList'] = $this->AllocationM->getAllocations2($this->session->userdata('userId'));
	
	
   $this->showEditEventForm($data);
  }
 }
 
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for editing an user
  * @param array $data
  */
 private function showEditEventForm($data) {
  $data['mode'] = 'edit';
  $data['action'] = 'events/updateEvent';
  $data['btnLabel'] = 'Save Changes';
  $data['backAction'] = 'events/index';
 $this->displayPageWithData('events/form', $data);
 }
 
 
 
 /* 
	Remove calendar
*/
public function remove($eventid) {
 
  $udo = $this->getEvent($eventid);
  if ($udo === FALSE) {
   $this->showEventList(array());
  }
  else {
   $data['eventDO'] = $udo;
   
   $this->load->model('AllocationM');
	$data['calendarList'] = $this->AllocationM->getAllocations2($this->session->userdata('userId'));
	
   $this->showRemoveEventForm($data);
  }
}

 public function removeEvent() {
  
  $this->load->model('EventM');
 
  $this->showEventList($this->EventM->deleteEvent());
 }
 
  /**
  * set the parameters for the create/edit form and show the form
  * @param array $data
  */
 private function showRemoveEventForm($data) {
  $data['mode'] = 'remove';
  $data['action'] = 'events/removeEvent';
  $data['btnLabel'] = 'Remove';
  $data['backAction'] = 'events/index';
  $this->displayPageWithData('events/form', $data);
 }
 
 protected function getEvent($eventid) {

   $this->load->model('EventM');
   $udo = $this->EventM->getEventFromID(DOFactory::getInstance()->createDO(DOEnum::EventDO,array('IDEVENTS'=>$eventid)));
    return $udo;

 }
 
 
  public function updateEvent() {
  $this->load->model('EventM');
  $data = $this->EventM->updateEvent();
  
  
   $this->load->model("FilterM");
   $data2 = $this->FilterM->updatefilters();
  
  
  if ($data['msgType'] == 'error') {
   $this->showEditEventForm($data);
  }
  else {
   $this->showEventList($data);
  }
 }
 
 public function getEventsFromFilter($filtervaluesid){
 
	$this->load->model('EventM');
	$data = $this->EventM->getEventsFromFilter($filtervaluesid);
	
	echo json_encode($data);
 
 }
 
 
 
 
}

?>