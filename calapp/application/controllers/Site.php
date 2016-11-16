<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
	Calendar Application
	
	Calendar.php - Controller for Calendar menu item.
*/


/*******************/
require 'MainCalendarApp.php';
/*******************/

class Site extends MainCalendarApp {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',1);
 }
 
 /**
	Display first page
*/
  public function index() {
	$this->showSiteList(array());
 }
 
 /**
  * show the calendar list
  * @param array $data
  */
 private function showSiteList(array $data) {
  
  $this->load->model('SiteM');
  $data['siteList'] = $this->SiteM->getSites();
  $this->displayPageWithData('site/list', $data);
 
 }
 
 public function newSite()
 {
	$this->load->model('SiteM');
	$data['siteDO'] = DOFactory::getInstance()->createDO(DOEnum::SiteDO,array());
	
	//$this->load->model('Site');
	//$data['siteList'] = $this->Site->getSites();
  
	$this->showNewSiteForm($data);
 
 }
 
 public function insertSite()
 {
	  $this->load->model('SiteM');
	  $data = $this->SiteM->insertSite();
	  if ($data['msgType'] == 'error') {
	   $this->showNewSiteForm($data);
	  }
	  else {
	   $this->showSiteList($data);
	  }
 
 }
 
  
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for creating a new user
  * @param array $data
  */
 private function showNewSiteForm(array $data) {
  $data['mode'] = 'new';
  $data['action'] = 'site/insertSite';
  $data['btnLabel'] = 'Create Site';
  $data['backAction'] = 'site/index';
  //$this->showCalendarForm($data);
  $this->displayPageWithData('site/form', $data);
 }
 
 
 
  public function edit($siteId) {
  $udo = $this->getSite($siteId);
  if ($udo === FALSE) {
   $this->showSiteList(array());
  }
  else {
   $data['siteDO'] = $udo;
  // $this->load->model('SiteM');
   //$data['siteList'] = $this->Site->getSites();
   $this->showEditSiteForm($data);
  }
 }
 
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for editing an user
  * @param array $data
  */
 private function showEditSiteForm($data) {
  $data['mode'] = 'edit';
  $data['action'] = 'site/updateSite';
  $data['btnLabel'] = 'Save Changes';
  $data['backAction'] = 'site/index';
 // $this->showCalendarForm($data);
 $this->displayPageWithData('site/form', $data);
 }
 
 
 
 /* 
	Remove calendar
*/
public function remove($siteId) {
  $udo = $this->getSite($siteId);
  if ($udo === FALSE) {
   $this->showSiteList(array());
  }
  else {
   $data['siteDO'] = $udo;
   //$this->load->model('Site');
   //$data['siteList'] = $this->Site->getSites();
   $this->showRemoveSiteForm($data);
  }
}

 public function removeSite() {
  $this->load->model('SiteM');
 
  $this->showSiteList($this->SiteM->deleteSite());
 }
 
  /**
  * set the parameters for the create/edit form and show the form
  * @param array $data
  */
 private function showRemoveSiteForm($data) {
  $data['mode'] = 'remove';
  $data['action'] = 'site/removeSite';
  $data['btnLabel'] = 'Remove';
  $data['backAction'] = 'site/index';
  //$this->showCalendarForm($data);
  $this->displayPageWithData('site/form', $data);
 }
 
 protected function getSite($siteId) {
  //if (is_numeric($calendarId)) {
   $this->load->model('SiteM');
   $udo = $this->SiteM->getSiteFromID(DOFactory::getInstance()->createDO(DOEnum::SiteDO,array('IDSITE'=>$siteId)));
   
   //print_r(array('SITEID'=>$siteId));
  // if (strlen($udo->getUserName()) > 0) {
  

    return $udo;
  // }
 //}
 // return false;
 }
 
 
  public function updateSite() {
  $this->load->model('SiteM');
  $data = $this->SiteM->updateSite();
  if ($data['msgType'] == 'error') {
   $this->showEditSiteForm($data);
  }
  else {
   $this->showSiteList($data);
  }
 }
 
 
}

?>