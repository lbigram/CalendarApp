<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
	Calendar Application
	
	Main.php - The beginning controller of the calendar application.
			   Shows the welcome screen on starting
*/


/*******************/
require 'MainCalendarApp.php';
/*******************/

class Main extends MainCalendarApp {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',0);
 }
 
 /**
	Display first page
*/
  public function index() {
	$this->displayPage('main');
 }
 
  /*---------- POST -------------*/
 /**
  * verify login function
  * username and password fields are required
  * check the password against LDAP
  * once password is valid, get user record from database and create session for user
  * if any check fails show invalid username and password
  */
 public function verifyLogon() {
  $this->load->library('form_validation');
  $this->form_validation->set_rules('username','User name','trim|required|xss_clean');
  $this->form_validation->set_rules('userPassword','Password','required|xss_clean');
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Logon error:';
   $this->showLoginForm($data);
  }
  else {
   if ($this->validateUser(set_value('username'), set_value('userPassword'))) {
    $this->load->model('User');
    $udo = $this->User->getUserFromLDAP(DOFactory::getInstance()->createDO(DOEnum::UserDO, array('LDAPUSERCODE'=>set_value('username'))));
    if ($udo->getUserActive() == 1) {
     $this->logonUser($udo);
     $this->index();
    }
    else {
     $data['msg'] = 'Invalid username or password';
     $this->showLoginForm($data);
    }
   }
   else {
    $data['msg'] = 'Invalid username or password';
    $this->showLoginForm($data);
   }
  }
 }
 
 /**
  * validate the user against AD. Return true if user is valid false otherwise
  * @param string $pUserName
  * @param string $pPassword
  * @return boolean
  */
 private function validateUser($pUserName, $pPassword) {
	// Active Directory server defined in constants - LDAP_SERVER
	// Domain, for purposes of constructing $user, defined in constants - LDAP_USER_DOMAIN
	try {
		// connect to active directory
		$ldap = ldap_connect(LDAP_SERVER);
		// verify user and password
		return ldap_bind($ldap, LDAP_USER_DOMAIN. '\\'.$pUserName, $pPassword);
	}
	catch (Exception $e) {
		return false;
	}
 }
 
 /**
  * create a session for the user
  * @param UserDO $uDO
  */
 private function logonUser(UserDO $uDO) {
  $this->session->set_userdata('logon_userRec',true);
  $this->session->set_userdata('userId',$uDO->getUserId());
  $this->session->set_userdata('loginName',$uDO->getUserName());
  $this->session->set_userdata('isAdmin',$uDO->getIsAdmin());
 }
 
 /**
	Display the logon form
*/
 private function showLoginForm($data) {
  $this->displayPageWithData('login/login', $data);
 }
 
 public function logon() {
  $data['msg'] = '';
  $this->showLoginForm($data);
 }
 
 public function logout() {
  $this->session->sess_destroy();
  $this->index();
 }
 
}

/* End of file Main.php */
/* Location: /Main.php */

?>