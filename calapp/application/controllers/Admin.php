<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of Admin
 * admin controller, manages users and access to divisions
 * @author user
 */
require 'MainCalendarApp.php';
class Admin extends MainCalendarApp {
 function __construct() {
  parent::__construct();
  $this->session->set_userdata('menuoption',1);
 }
 
 /**
  * show the user list
  * @param array $data
  */
 private function showUserList(array $data) {
  $this->load->model('User');
  $data['userList'] = $this->User->getUsers();
  $this->displayPageWithData('users/list', $data);
 }
 
 /**
  * show the form to create/edit user
  * @param array $data
  */
 private function showUserForm(array $data) {
  $this->displayPageWithData('users/form', $data);
 }
 
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for creating a new user
  * @param array $data
  */
 private function showNewUserForm(array $data) {
  $data['mode'] = 'new';
  $data['action'] = 'admin/insertUser';
  $data['btnLabel'] = 'Create User';
  $data['backAction'] = 'admin/userList';
  $this->showUserForm($data);
 }
 
 /**
  * set the parameters to be used to initalise the user create/edit form 
  * for editing an user
  * @param array $data
  */
 private function showEditUserForm($data) {
  $data['mode'] = 'edit';
  $data['action'] = 'admin/updateUser';
  $data['btnLabel'] = 'Save Changes';
  $data['backAction'] = 'admin/userList';
  $this->showUserForm($data);
 }
 
 /**
  * set the parameters for the create/edit form and show the form
  * @param array $data
  */
 private function showRemoveUserForm($data) {
  $data['mode'] = 'remove';
  $data['action'] = 'admin/removeUser';
  $data['btnLabel'] = 'Remove';
  $data['backAction'] = 'admin/userList';
  $this->showUserForm($data);
 }
  
 private function showDivisionList($data = null){
  $udo = $this->getUser($this->session->userdata('secUserId'));
  if ($udo === FALSE) {
   $this->showUserList(array());
  }
  else {
   $data['userDO'] = $udo;
   $this->load->model('Division');
   $data['userDivisionList'] = $this->Division->getUserDivisionHash($udo);
   $data['divisionList'] = $this->Division->getDivisions();
   $this->displayPageWithData('users/divisionlist', $data);
  }
 }
 
 public function userList() {
  $this->showUserList(array());
 }
 
 public function index() {
  $this->showUserList(array());
 }
 
 public function newUser() {
  $this->load->model('User');
  $data['userDO'] = DOFactory::getInstance()->createDO(DOEnum::UserDO,array('USERACTIVE'=>1));
  $this->showNewUserForm($data);
 }
 
 public function edit($userId) {
  $udo = $this->getUser($userId);
  if ($udo === FALSE) {
   $this->showUserList(array());
  }
  else {
   $data['userDO'] = $udo;
   $this->showEditUserForm($data);
  }
 }
 
 public function remove($userId) {
  $udo = $this->getUser($userId);
  if ($udo === FALSE) {
   $this->showUserList(array());
  }
  else {
   $data['userDO'] = $udo;
   $this->showRemoveUserForm($data);
  }
 }
 
 public function userDivisionList($userId) {
  $this->session->set_userdata('secUserId',$userId);
  $this->showDivisionList();
 }
 
 /*------------ post functions ----------------*/
 public function insertUser() {
  $this->load->model('User');
  $data = $this->User->insertUser();
  if ($data['msgType'] == 'error') {
   $this->showNewUserForm($data);
  }
  else {
   $this->showUserList($data);
  }
 }
 
 public function updateUser() {
  $this->load->model('User');
  $data = $this->User->updateUser();
  if ($data['msgType'] == 'error') {
   $this->showEditUserForm($data);
  }
  else {
   $this->showUserList($data);
  }
 }
 
 public function removeUser() {
  $this->load->model('User');
  $this->showUserList($this->User->deleteUser());
 }
 
 public function updateDivisionAccess() {
  $udo = $this->getUser($this->session->userdata('secUserId'));
  if ($udo === FALSE) {
   $this->showUserList(array());
  }
  else {
   $this->showUserList($this->User->updateDivisionsAccess($udo));
  }
 }
}

/* End of file Admin.php */
/* Location: /Admin.php */