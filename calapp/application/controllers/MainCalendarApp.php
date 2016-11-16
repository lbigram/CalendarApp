<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
	Calendar Application
	
	MainCalendarApp.php - The first/main controller. All other controllers extend this one.
*/

class MainCalendarApp extends CI_Controller {
 function __construct() {
  parent::__construct();
 }
 
 /**
  * displays the header, footer and the page to be diplayed
  * if the session is not set, the only pages the user can access are
  *  - login/login
  * all other pages are ovrewritten by the main view
  * 
  * @param string $page
  * @param array $data
  */
 protected function displayPageWithData($page, $data) {
  
  if (!isset($data['page_title'])) {
   $data['page_title'] = 'Calendar Application';
  }
  
  $this->load->view('header',$data);
  
  $logon_userRec = $this->session->userdata('logon_userRec');
  if (is_bool($logon_userRec) && !$logon_userRec) {
   if (strcmp($page, 'login/login') == 0) {
    $this->load->view($page);
   }
   else {
    $this->load->view('main');
   }
  }
  else {
   $this->load->view($page, $data);
  }
  $this->load->view('footer', $data);
 }
 
 /**
  * displays a view. initialises the data array with an empty message string and calls displayPageWithData function
  * @param string $page
  */
 protected function displayPage($page) {
  $data['msg'] = '';
  $this->displayPageWithData($page, $data);
 }
 
  /**
  * gets the user record from the user id. if the user id is invalid, return false,
  * else return a UserDO with user record
  * @param type $userId
  * @return UserDO or FALSE if the user id is not valid
  */
 protected function getUser($userId) {
  if (is_numeric($userId)) {
   $this->load->model('User');
   $udo = $this->User->getUserFromId(DOFactory::getInstance()->createDO(DOEnum::UserDO,array('USERID'=>$userId)));
   if (strlen($udo->getUserName()) > 0) {
    return $udo;
   }
  }
  return false;
 }
}

/* End of file ACQList.php */
/* Location: /ACQList.php */