<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
	Calendar Application
	
	User.php - The User Model extends the Calendar model.
*/

require_once 'CalModel.php';
include 'UserDAO.php';
include 'GetUsersDAO.php';
include 'GetUserDAO.php';

class User extends CalModel {
 function __construct() {
  parent::__construct();
 }
 
 /**
  * gets a user record using the ldap user name
  * @param UserDO $udo
  * @return UserDO
  */
 public function getUserFromLDAP(UserDO $udo) {
  $guDAO = new GetUserDAO();
  $guDAO->getUserFromLDAP($this->db, $udo);
  $udo = $guDAO->next($udo);
  return $udo;
 }
 
 /**
  * gets a user record from the user id
  * @param UserDO $udo
  * @return UserDAO
  */
 public function getUserFromId(UserDO $udo) {
  $guDAO = new GetUserDAO();
  $guDAO->getUserFromId($this->db, $udo);
  $udo = $guDAO->next($udo);
  return $udo;
 }
 
 /**
  * gets the list of users on the database and return the data access object
  * @return \GetUsersDAO
  */
 public function getUsers() {
  $guDAO = new GetUsersDAO();
  $guDAO->getUsers($this->db);
  return $guDAO;
 }
 
 private function setUserValidationRules() {
  $this->form_validation->set_rules('userName','Name','trim|required|xss_clean');
  $this->form_validation->set_rules('ldapUserCode','LDAP User Name','trim|required|xss_clean');
  $this->form_validation->set_rules('isAdmin','Is Admin','trim|required|is_natural|less_than[2]|xss_clean');
  $this->form_validation->set_rules('userActive','Status','trim|required|is_natural|less_than[2]|xss_clean');
 }
 
 private function setUserIdValidationRule() {
  $this->form_validation->set_rules('userId','User ID','trim|required|is_natural_no_zero|xss_clean');
 }
 
 /**
  * validates the form data and creates a user record if valid. return an 
  * array containing the messages about the status of the record
  * @return array
  */
 public function insertUser() {
  $data = array();
  $this->load->library('form_validation');
  $this->setUserValidationRules();
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
   $data['userDO'] = DOFactory::getInstance()->createDO(DOEnum::UserDO, array('USERNAME'=>set_value('userName'),'LDAPUSERCODE'=>set_value('ldapUserCode'),'ISADMIN'=>set_value('isAdmin'),'USERACTIVE'=>set_value('userActive')));
  }
  else {
   $udo = DOFactory::getInstance()->createDO(DOEnum::UserDO, array('USERNAME'=>set_value('userName'),'LDAPUSERCODE'=>set_value('ldapUserCode'),'ISADMIN'=>set_value('isAdmin'),'USERACTIVE'=>set_value('userActive')));
   $guDAO = new GetUserDAO();
   if ($guDAO->isUniqueUser($this->db, $udo)) {
    $this->db->query('insert into users(userName, ldapUserCode, isAdmin, userActive) values('.$this->db->escape($udo->getUserName()).','.$this->db->escape($udo->getLdapUserCode()).','.$udo->getIsAdmin().','.$udo->getUserActive().')');
    $data['msg'] = 'Created user successfully';
    $data['msgType'] = 'success';
   }
   else {
    $data['msg'] = 'The LDAP User Name entered has been used by another user. Please enter another.';
    $data['msgType'] = 'error';
    $data['userDO'] = $udo;
   }
  }
  return $data;
 }
 
 /**
  * validates the form data and updates the user record if valid. return an
  * array containing the status of the record
  * @return array
  */
 public function updateUser() {
  $data = array();
  $this->load->library('form_validation');
  $this->setUserValidationRules();
  $this->setUserIdValidationRule();
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
   $data['userDO'] = DOFactory::getInstance()->createDO(DOEnum::UserDO, array('USERID'=>set_value('userId'),'USERNAME'=>set_value('userName'),'LDAPUSERCODE'=>set_value('ldapUserCode'),'ISADMIN'=>set_value('isAdmin'),'USERACTIVE'=>set_value('userActive')));
  }
  else {
   $udo = DOFactory::getInstance()->createDO(DOEnum::UserDO, array('USERID'=>set_value('userId'),'USERNAME'=>set_value('userName'),'LDAPUSERCODE'=>set_value('ldapUserCode'),'ISADMIN'=>set_value('isAdmin'),'USERACTIVE'=>set_value('userActive')));
   $guDAO = new GetUserDAO($this->db, $udo);
   if ($guDAO->isUniqueUserOther($this->db, $udo)) {
    $this->db->query('update users set userName = '.$this->db->escape($udo->getUserName()).', ldapUserCode = '.$this->db->escape($udo->getLdapUserCode()).', isAdmin = '.$udo->getIsAdmin().', userActive = '.$udo->getUserActive().' where userId = '.$udo->getUserId());
    $data['msg'] = 'Saved changes successfully';
    $data['msgType'] = 'success';
   }
   else {
    $data['msg'] = 'The LDAP User Name has been used by another user. Please enter another.';
    $data['msgType'] = 'error';
    $data['userDO'] = $udo;
   }
  }
  return $data;
 }
 
 /**
  * validates the user id and removes the user record if valid. return an 
  * array containing the status of the record
  * @return array
  */
 public function deleteUser() {
  $data = array();
  $this->load->library('form_validation');
  $this->setUserIdValidationRule();
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
  }
  else {
   $this->db->query('delete from users where userId = '.set_value('userId'));
   $data['msg'] = 'Removed user successfully';
   $data['msgType'] = 'success';
  }
  return $data;
 }

 
}

/* End of file User.php */
/* Location: /User.php */