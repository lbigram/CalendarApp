<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
	Calendar Application
	
	CalendarM.php - Calendar Model. All methods relating to the Calendar menu item.
*/


require_once 'CalModel.php';
include 'CalendarDAO.php';


class CalendarM extends CalModel {

 function __construct() {
  parent::__construct();
 }
 
 /*
	Get a list of calendars
*/
 public function getCalendars(){
	$calDao = new CalendarDAO();
	$calDao->getCalendars($this->db);
	return $calDao;
 }
 
 public function getCalendarFromID(CalendarDO $udo){
 
   //print_r($udo);
	$guDAO = new CalendarDAO();
	$guDAO->getCalendarFromId($this->db, $udo);
	$udo = $guDAO->next($udo);
	  //print_r($udo);
	return $udo;
 }
 
 public function insertCalendar(){
	$data = array();
	  $this->load->library('form_validation');
	  $this->setCalendarValidationRules();
	  if ($this->form_validation->run() === FALSE) {
	   $data['msg'] = 'Validation errors:';
	   $data['msgType'] = 'error';
	   $data['calDO'] = DOFactory::getInstance()->createDO(DOEnum::CalendarDO, array('CALENDAR_NAME'=>set_value('calendarName'),'SITEID'=>set_value('siteid')));
	  }
	  else {
	   $udo = DOFactory::getInstance()->createDO(DOEnum::CalendarDO, array('CALENDAR_NAME'=>set_value('calendarName'),'SITEID'=>set_value('siteid'))); 
	   
	   //print_r (array('CALENDAR_NAME'=>set_value('calendarName'),'SITEID'=>set_value('siteid')));
	   
	   $calDAO = new CalendarDAO();
	   //if ($guDAO->isUniqueUser($this->db, $udo)) {
		$this->db->query('insert into calendar(calendar_name, siteid) values('.$this->db->escape($udo->getCalendarName()).',' . $this->db->escape($udo->getSiteId()).')');
		$data['msg'] = 'Created calendar successfully';
		$data['msgType'] = 'success';
	  // }
	   /*else {
		$data['msg'] = 'The LDAP User Name entered has been used by another user. Please enter another.';
		$data['msgType'] = 'error';
		$data['userDO'] = $udo;
	   }*/
  }
  return $data;
 }
 
  private function setCalendarValidationRules() {
	$this->form_validation->set_rules('calendarName','Name','trim|required|xss_clean');
	$this->form_validation->set_rules('type','Type','trim|required|xss_clean');
	$this->form_validation->set_rules('siteid','SITEID','trim|required|is_natural_no_zero|xss_clean');
 }
 
 private function setCalIdValidationRule() {
  $this->form_validation->set_rules('calId','Calendar ID','trim|required|is_natural_no_zero|xss_clean');
 }
 
 
 public function deleteCalendar(){
	$data = array();

  $this->load->library('form_validation');
  $this->setCalIdValidationRule();
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
  } else{
   $this->db->query('delete from calendar where idcalendar = '. set_value('calId'));
   $data['msg'] = 'Removed calendar successfully';
   $data['msgType'] = 'success';
   }
  
  return $data;
 
 }
 
 public function updateCalendar(){
 $data = array();
  $this->load->library('form_validation');
  $this->setCalendarValidationRules();
  $this->setCalIdValidationRule();
  
  
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
   $data['calendarDO'] = DOFactory::getInstance()->createDO(DOEnum::CalendarDO, array('IDCALENDAR'=>set_value('calId'),'CALENDAR_NAME'=>set_value('calendarName'),'SITEID'=>set_value('siteid'),'TYPE'=>set_value('type')));
  }
  else {
   $udo = DOFactory::getInstance()->createDO(DOEnum::CalendarDO, array('IDCALENDAR'=>set_value('calId'),'CALENDAR_NAME'=>set_value('calendarName'),'SITEID'=>set_value('siteid'),'TYPE'=>set_value('type')));
  

  
  //print_r($udo);
   
  // $guDAO = new CalendarDAO($this->db, $udo);
  // if ($guDAO->isUniqueUserOther($this->db, $udo)) {
    $this->db->query('update calendar set calendar_name = '.$this->db->escape($udo->getCalendarName()).', siteid = '.$udo->getSiteId(). ',type=' . $udo->getType() . ' where idcalendar = '. $udo->getCalendarId()); 
    $data['msg'] = 'Saved changes successfully';
    $data['msgType'] = 'success';
   ///}
   /*else {
    $data['msg'] = 'The LDAP User Name has been used by another user. Please enter another.';
    $data['msgType'] = 'error';
    $data['userDO'] = $udo;
   }*/
  }
  return $data;
 }
 
 public function getCalendarListing(){

	$db = $this->db;
	$sql = 'select IDCALENDAR,CALENDAR_NAME from calendar';
	
	$rs = $db->query($sql);
	
	$arr = array();
	for ($i=0;$i < $rs->num_rows();$i++){
	
		 $result= $rs->result_array();
		 $row = $result[$i];
		$temp = array('IDCALENDAR'=>$row['IDCALENDAR'], 'CALENDAR_NAME'=>$row['CALENDAR_NAME']);
	
		array_push($arr, $temp);
	
	}
	
	return $arr;
}
 
 
  public function getCalendarListing2(){

	$db = $this->db;
	$sql = 'select IDCALENDAR,CALENDAR_NAME from calendar where type=1';
	
	$rs = $db->query($sql);
	
	$arr = array();
	for ($i=0;$i < $rs->num_rows();$i++){
	
		 $result= $rs->result_array();
		 $row = $result[$i];
		$temp = array('IDCALENDAR'=>$row['IDCALENDAR'], 'CALENDAR_NAME'=>$row['CALENDAR_NAME']);
	
		array_push($arr, $temp);
	
	}
	
	return $arr;
}

 
}

