<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of GetUserDAO
 * DAO to get a single user from the database
 * @author user
 */
class GetUserDAO extends UserDAO {
 function __construct() {
  parent::__construct();
 }
 
 /**
  * gets a user record using the userid
  * @param type $db
  * @param UserDO $udo
  */
 public function getUserFromId($db, UserDO $udo) {
  $this->setResultSet($db, 'userId = '.$udo->getUserId());
 }
 
 /**
  * gets the user record using the ldap user code
  * @param type $db
  * @param UserDO $udo
  */
 public function getUserFromLDAP($db, UserDO $udo) {
  $this->setResultSet($db, 'ldapUserCode = '.$db->escape($udo->getLdapUserCode()));
 }
 
 /**
  * checks that the ldap user name has not been used by another user
  * @param type $db
  * @param UserDO $udo
  * @return boolean
  */
 public function isUniqueUser($db, UserDO $udo) {
  $this->getUserFromLDAP($db, $udo);
  if ($this->rs->num_rows() == 0) {
   return true;
  }
  return false;
 }
 
 /**
  * checks that the ldap user code is unique over other user accounts but the one passed
  * @param UserDO $udo
  * @param type $db
  * @return boolean
  */
 public function isUniqueUserOther($db, UserDO $udo) {
  $this->setResultSet($db, 'ldapUserCode = '.$db->escape($udo->getLdapUserCode()).' and userId <> '.$udo->getUserId());
  if ($this->rs->num_rows() == 0) {
   return true;
  }
  return false;
 }
}

/* End of file GetUserDAO.php */
/* Location: /GetUserDAO.php */