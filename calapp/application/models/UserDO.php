<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of UserDO
 * user data object
 * @author user
 */
class UserDO extends DataObject {
 private $userId;
 private $userName;
 private $ldapUserCode;
 private $userActive;
 private $isAdmin;
 
 function __construct($userId, $userName, $ldapUserCode, $userActive, $isAdmin) {
  $this->userId = $userId;
  $this->userName = $userName;
  $this->ldapUserCode = $ldapUserCode;
  $this->userActive = $userActive;
  $this->isAdmin = $isAdmin;
 }
 
 public function getUserId() {
  return $this->userId;
 }

 public function getUserName() {
  return $this->userName;
 }

 public function getLdapUserCode() {
  return $this->ldapUserCode;
 }

 public function getUserActive() {
  return $this->userActive;
 }

 public function getIsAdmin() {
  return $this->isAdmin;
 }

 public function setUserId($userId) {
  $this->userId = $userId;
 }

 public function setUserName($userName) {
  $this->userName = $userName;
 }

 public function setLdapUserCode($ldapUserCode) {
  $this->ldapUserCode = $ldapUserCode;
 }

 public function setUserActive($userActive) {
  $this->userActive = $userActive;
 }

 public function setIsAdmin($isAdmin) {
  $this->isAdmin = $isAdmin;
 }
}

/* End of file UserDO.php */
/* Location: /UserDO.php */