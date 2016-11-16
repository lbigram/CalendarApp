<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of Site
 * Site model
 * @author kpersadsingh
 */
require_once 'CalModel.php';
include 'AllocationDAO.php';



class AllocationM extends CalModel {
 function __construct() {
  parent::__construct();
 }
 
 public function getSite(SiteDO $sdo) {
  $gsDAO = new GetSiteDAO();
  $gsDAO->getSiteFromId($this->db, $sdo);
  return $gsDAO;
 }
 
 public function getAllocations() {
 
	$calDao = new AllocationDAO();
	$calDao->getAllocations($this->db);
	return $calDao;

 }
 
 public function getAllocations2($userid){
	
	$calDao = new AllocationDAO();
	$calDao->getAllocations($this->db,' a.userid=' . $userid);
	return $calDao;
 
 }
 
 public function insertAllocation()
 {
	  $data = array();
	  $this->load->library('form_validation');
	  
	  $this->setAllocationValidationRules();
	  $this->setAllocationIdValidationRule();
	  
	  if ($this->form_validation->run() === FALSE) {
	   $data['msg'] = 'Validation errors:';
	   $data['msgType'] = 'error';
	   $data['allocationDO'] = DOFactory::getInstance()->createDO(DOEnum::AllocationDO, array('USERID'=>set_value('userid'),'CALENDARID'=>set_value('calendarid')));
	  }
	  else {
	   $udo = DOFactory::getInstance()->createDO(DOEnum::AllocationDO, array('USERID'=>set_value('userid'),'CALENDARID'=>set_value('calendarid')));
	   
	   //print_r (array('CALENDAR_NAME'=>set_value('calendarName'),'SITEID'=>set_value('siteid')));
	   
		//$siteDAO = new SiteDAO();
	   //if ($guDAO->isUniqueUser($this->db, $udo)) {
		$this->db->query('insert into usercalendarallocations(userid,calendarid,adate) values('.$this->db->escape($udo->getUserId()).',' . $this->db->escape($udo->getCalendarId()).',Now())');
		$data['msg'] = 'Created Allocation successfully';
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
 
 private function setAllocationValidationRules() {
	$this->form_validation->set_rules('userid','User','trim|required|xss_clean');
	$this->form_validation->set_rules('calendarid','Calendar','trim|required|xss_clean');
 }
 
 private function setAllocationIdValidationRule() {
  $this->form_validation->set_rules('userId','User ID','trim|required|is_natural_no_zero|xss_clean');
  $this->form_validation->set_rules('calendarId','Calendar ID','trim|required|is_natural_no_zero|xss_clean');
 }
 
 public function getAllocationFromId(AllocationDO $udo)
 {
	//print_r($udo);
	$guDAO = new AllocationDAO();
	$guDAO->getAllocationFromId($this->db, $udo);
	$udo = $guDAO->next($udo);
	  //print_r($udo);
	return $udo;
 
 }
 
 
  public function updateAllocation(){
 $data = array();
  $this->load->library('form_validation');
  $this->setAllocationValidationRules();
  $this->setAllocationIdValidationRule();
  
  
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
   $data['allocationDO'] = DOFactory::getInstance()->createDO(DOEnum::AllocationDO, array('USERID'=>set_value('userid'),'CALENDARID'=>set_value('calendarid')));
  }
  else {
   $udo = DOFactory::getInstance()->createDO(DOEnum::AllocationDO, array('USERID'=>set_value('userid'),'CALENDARID'=>set_value('calendarid')));
   
   $udo2 = DOFactory::getInstance()->createDO(DOEnum::AllocationDO, array('USERID'=>set_value('userId'),'CALENDARID'=>set_value('calendarId')));
  
	//  print_r(array('USERID'=>set_value('userid'),'CALENDARID'=>set_value('calendarid')));

  
  //print_r($udo);
   
  // $guDAO = new CalendarDAO($this->db, $udo);
  // if ($guDAO->isUniqueUserOther($this->db, $udo)) {
    $this->db->query('update usercalendarallocations set userid = '.$udo->getUserId().', calendarid = '.$udo->getCalendarId().' where userid = '. $udo2->getUserId() . ' AND calendarid = '. $udo2->getCalendarId()); 
	
	
	//print_r('update usercalendarallocations set userid = '.$udo->getUserId().', calendarid = '.$udo->getCalendarId().' where userid = '. $udo2->getUserId() . ' AND calendarid = '. $udo2->getCalendarId());
	
	
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
 
  public function deleteAllocation(){
	$data = array();

  $this->load->library('form_validation');
  $this->setAllocationValidationRules();
  $this->setAllocationIdValidationRule();
  
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
  } else{
   $this->db->query('delete from usercalendarallocations where userid = '. set_value('userId') . ' AND calendarid='. set_value('calendarId'));
   $data['msg'] = 'Removed allocation successfully';
   $data['msgType'] = 'success';
   }
  
  return $data;
 
 }
 
}

/* End of file Site.php */
/* Location: /Site.php */