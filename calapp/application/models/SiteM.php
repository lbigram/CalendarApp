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
include 'SiteDAO.php';
include 'GetSiteDAO.php';
include 'GetSitesDAO.php';



class SiteM extends CalModel {
 function __construct() {
  parent::__construct();
 }
 
 public function getSite(SiteDO $sdo) {
  $gsDAO = new GetSiteDAO();
  $gsDAO->getSiteFromId($this->db, $sdo);
  return $gsDAO;
 }
 
 public function getSites() {
  $gsDAO = new GetSitesDAO();
  $gsDAO->getSites($this->db);
  return $gsDAO;
 }
 
 public function insertSite()
 {
	  $data = array();
	  $this->load->library('form_validation');
	  $this->setSiteValidationRules();
	  
	  if ($this->form_validation->run() === FALSE) {
	   $data['msg'] = 'Validation errors:';
	   $data['msgType'] = 'error';
	   $data['siteDO'] = DOFactory::getInstance()->createDO(DOEnum::SiteDO, array('SITETITLE'=>set_value('siteTitle'),'SITEURL'=>set_value('siteURL')));
	  }
	  else {
	   $udo = $data['siteDO'] = DOFactory::getInstance()->createDO(DOEnum::SiteDO, array('SITETITLE'=>set_value('siteTitle'),'SITEURL'=>set_value('siteURL')));
	   
	   //print_r (array('CALENDAR_NAME'=>set_value('calendarName'),'SITEID'=>set_value('siteid')));
	   
		//$siteDAO = new SiteDAO();
	   //if ($guDAO->isUniqueUser($this->db, $udo)) {
		$this->db->query('insert into site(sitetitle,siteurl) values('.$this->db->escape($udo->getSiteTitle()).',' . $this->db->escape($udo->getSiteURL()).')');
		$data['msg'] = 'Created Site successfully';
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
 
 private function setSiteValidationRules() {
	$this->form_validation->set_rules('siteTitle','Title','trim|required|xss_clean');
	$this->form_validation->set_rules('siteURL','Url','trim|required|xss_clean');
 }
 
 private function setSiteIdValidationRule() {
  $this->form_validation->set_rules('siteId','Site ID','trim|required|is_natural_no_zero|xss_clean');
 }
 
 public function getSiteFromId(SiteDO $udo)
 {
	//print_r($udo);
	$guDAO = new SiteDAO();
	$guDAO->getSiteFromId($this->db, $udo);
	$udo = $guDAO->next($udo);
	  print_r($udo);
	return $udo;
 
 }
 
 
  public function updateSite(){
 $data = array();
  $this->load->library('form_validation');
  $this->setSiteValidationRules();
  $this->setSiteIdValidationRule();
  
  
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
   $data['siteDO'] = DOFactory::getInstance()->createDO(DOEnum::SiteDO, array('IDSITE'=>set_value('siteId'),'SITETITLE'=>set_value('siteTitle'),'SITEURL'=>set_value('siteURL')));
  }
  else {
   $udo = DOFactory::getInstance()->createDO(DOEnum::SiteDO, array('IDSITE'=>set_value('siteId'),'SITETITLE'=>set_value('siteTitle'),'SITEURL'=>set_value('siteURL')));
  

  
  //print_r($udo);
   
  // $guDAO = new CalendarDAO($this->db, $udo);
  // if ($guDAO->isUniqueUserOther($this->db, $udo)) {
    $this->db->query('update site set sitetitle = '.$this->db->escape($udo->getSiteTitle()).', siteurl = '.$this->db->escape($udo->getSiteURL()).' where idsite = '. $udo->getSiteId()); 
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
 
  public function deleteSite(){
	$data = array();

  $this->load->library('form_validation');
  $this->setSiteIdValidationRule();
  
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
  } else{
   $this->db->query('delete from site where idsite = '. set_value('siteId'));
   $data['msg'] = 'Removed site successfully';
   $data['msgType'] = 'success';
   }
  
  return $data;
 
 }
 
}

/* End of file Site.php */
/* Location: /Site.php */