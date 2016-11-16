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
include 'EventDAO.php';



class EventM extends CalModel {
 function __construct() {
  parent::__construct();
 }
 
 public function getSite(SiteDO $sdo) {
  $gsDAO = new GetSiteDAO();
  $gsDAO->getSiteFromId($this->db, $sdo);
  return $gsDAO;
 }
 
 public function getEvents($where=null) {
	 
	$calDao = new EventDAO();
	$calDao->getEvents($this->db,$where);
	return $calDao;

 }
 
 public function insertEvent()
 {
	  $data = array();
	  $this->load->library('form_validation');
	  
	  $this->setEventValidationRules();
	  $this->setEventIdValidationRule();
	  
	  if ($this->form_validation->run() === FALSE) {
	   $data['msg'] = 'Validation errors:';
	   $data['msgType'] = 'error';
	   $data['EventDO'] = DOFactory::getInstance()->createDO(DOEnum::EventDO, array('IDEVENTS'=>set_value('eventid'),'EVENTNAME'=>set_value('eventname'),'DETAILS'=>set_value('details'),'PRESENTER'=>set_value('presenter'),'LOCATION'=>set_value('location'),'SDATE'=>set_value('sdate'),'ETIME'=>set_value('etime'), 'STIME'=>set_value('stime'),'CALENDARNAME'=>set_value('calendarname'),'CALENDARID'=>set_value('calendarid')));
	  }
	  else {
	   $udo = DOFactory::getInstance()->createDO(DOEnum::EventDO, array('IDEVENTS'=>set_value('eventid'),'EVENTNAME'=>set_value('eventname'),'DETAILS'=>set_value('details'),'PRESENTER'=>set_value('presenter'),'LOCATION'=>set_value('location'),'SDATE'=>set_value('sdate'),'ETIME'=>set_value('etime'), 'STIME'=>set_value('stime'),'CALENDARNAME'=>set_value('calendarname'),'CALENDARID'=>set_value('calendarid')));
	   
		$this->db->query('insert into events(eventname,location,sdate,stime,etime,idcalendar,presenter,details) values('.$this->db->escape($udo->getEventname()). ',' . $this->db->escape($udo->getLocation()) . ',' . $this->db->escape($udo->getSdate()) . ',' . $this->db->escape($udo->getStime()) . ',' . $this->db->escape($udo->getEtime()) . ',' . $udo->getCalendarid() .  ',' . $this->db->escape($udo->getPresenter()) . ',' . $this->db->escape($udo->getDetails()) . ');');
		

		
		$data['msg'] = 'Created Event successfully';
		$data['msgType'] = 'success';

		
		$res = $this->db->query('SELECT LAST_INSERT_ID() as id;');
		
		 $result= $res->result_array();
		 $row = $result[0];
		 
		$data['id'] = $row['id'];
		

  }
  return $data;
 }
 
 private function setEventValidationRules() {
	
	$this->form_validation->set_rules('location','Location','trim|required|xss_clean');
	$this->form_validation->set_rules('eventname','Event Name','trim|required|xss_clean');
	$this->form_validation->set_rules('presenter','Presenter','trim|required|xss_clean');
	$this->form_validation->set_rules('details','Details','trim|required|xss_clean');
	$this->form_validation->set_rules('sdate','Start Date','trim|required|xss_clean');
	$this->form_validation->set_rules('stime','Start Time','trim|required|xss_clean');
	$this->form_validation->set_rules('etime','End Time','trim|required|xss_clean');
	$this->form_validation->set_rules('calendarid','Calendar ID','trim|required|xss_clean');

 }
 
 private function setEventIdValidationRule() {
  $this->form_validation->set_rules('eventid','Event ID','trim|required|is_natural_no_zero|xss_clean');
 }
 
 public function getEventFromId(EventDO $udo)
 {

	$guDAO = new EventDAO();
	$guDAO->getEventFromId($this->db, $udo);
	$udo = $guDAO->next($udo);
	return $udo;
 
 }
 
 
  public function updateEvent(){
  $data = array();
  $this->load->library('form_validation');
  $this->setEventValidationRules();
  $this->setEventIdValidationRule();
  
  
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
   
   $data['eventDO'] = DOFactory::getInstance()->createDO(DOEnum::EventDO, array('IDEVENTS'=>set_value('eventid'),'EVENTNAME'=>set_value('eventname'),'DETAILS'=>set_value('details'),'PRESENTER'=>set_value('presenter'),'LOCATION'=>set_value('location'),'SDATE'=>set_value('sdate'),'ETIME'=>set_value('etime'), 'STIME'=>set_value('stime'),'CALENDARNAME'=>set_value('calendarname'),'CALENDARID'=>set_value('calendarid')));
  }
  else {
   $udo = DOFactory::getInstance()->createDO(DOEnum::EventDO, array('IDEVENTS'=>set_value('eventid'),'EVENTNAME'=>set_value('eventname'),'DETAILS'=>set_value('details'),'PRESENTER'=>set_value('presenter'),'LOCATION'=>set_value('location'),'SDATE'=>set_value('sdate'),'ETIME'=>set_value('etime'), 'STIME'=>set_value('stime'),'CALENDARNAME'=>set_value('calendarname'),'CALENDARID'=>set_value('calendarid')));

    $this->db->query('update events set eventname = '. $this->db->escape($udo->getEventname()).', location = ' . $this->db->escape($udo->getLocation()). ',sdate='. $this->db->escape($udo->getSdate()). ',etime='. $this->db->escape($udo->getEtime()) .  ',stime='. $this->db->escape($udo->getStime()) . ',presenter='. $this->db->escape($udo->getPresenter()) . ',details='. $this->db->escape($udo->getDetails()) . ',idcalendar=' . $udo->getCalendarid() . ' where idevents = '. $udo->getEventid()); 
	
	
	
    $data['msg'] = 'Saved changes successfully';
    $data['msgType'] = 'success';

  }
  return $data;
 }
 
  public function deleteEvent(){
	$data = array();

  $this->load->library('form_validation');
  $this->setEventIdValidationRule();
  
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
  } else{
  
	$this->db->query('delete from eventfiltervalues where eventid='. set_value('eventid'));
   $this->db->query('delete from events where idevents = '. set_value('eventid'));
   
   $data['msg'] = 'Removed Event successfully';
   $data['msgType'] = 'success';
   }
  
  return $data;
 
 }
 
 public function getEventsFromFilter($filtervaluesid){
 
	$db = $this->db;
	$sql = 'select * from eventfiltervalues a, events b where a.filtervalueid=' . $filtervaluesid . ' and a.eventid = b.eventid';
	
	$rs = $db->query($sql);
	
	$arr = array();
	for ($i=0;$i < $rs->num_rows();$i++){
	
		 $result= $rs->result_array();
		 $row = $result[$i];
		$temp = array('EVENTNAME'=>$row['EVENTNAME'], 'LOCATION'=>$row['LOCATION'],'SDATE'=>$row['SDATE'],'STIME'=>$row['STIME'],'ETIME'=>$row['ETIME'],'PRESENTER'=>$row['PRESENTER'],'DETAILS'=>$row['DETAILS']);
	
		array_push($arr, $temp);
	
	}
	
	return $arr;
	
	
 }
 
 
 
}

/* End of file Site.php */
/* Location: /Site.php */