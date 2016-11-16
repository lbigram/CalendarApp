<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of UserDAO
 * abstrat parent of user DAO classes
 * @author user
 */
require_once 'DataAccessObject.php';

abstract class UserDAO extends DataAccessObject {
 private $currentRow;
 protected $rs;
 protected $columnNames;
 
 function __construct() {
  //parent::__construct();
  $this->columnNames = 'USERID,USERNAME,LDAPUSERCODE,USERACTIVE,ISADMIN';
  $this->currentRow = 0;
 }
 
 /**
  * execute the query to get the users and apply where clause
  * @param CI_DB $db
  * @param string $where
  * @return CI_DB_result
  */
 protected function setResultSet($db, $where = NULL) {
  $sql = 'select '.$this->columnNames.' from users';
  if (!is_null($where)) {
   $sql = $sql.' where '.$where;
  }
  $sql = $sql.' order by userName';
  $this->rs = $db->query($sql);
 }
 
 /**
  * populate a userdo from a row from the result set
  * @param UserDO $udo
  * @param array $row
  * @return \UserDO
  */
 protected function populateUserDO(UserDO $udo, array $row) {
  if (array_key_exists('USERID',$row)) {
   $udo->setUserId($row['USERID']);
  }
  if (array_key_exists('USERNAME',$row)) {
   $udo->setUserName($row['USERNAME']);
  }
  if (array_key_exists('LDAPUSERCODE',$row)) {
   $udo->setLdapUserCode($row['LDAPUSERCODE']);
  }
  if (array_key_exists('USERACTIVE',$row)) {
   $udo->setUserActive($row['USERACTIVE']);
  }
  if (array_key_exists('ISADMIN',$row)) {
   $udo->setIsAdmin($row['ISADMIN']);
  }
  return $udo;
 }
 
 /**
  * gets the next record from the result set and populates the passed UserDO 
  * (a UserDO is created if it is null). 
  * @param \DataObject $do
  * @return \UserDO if no more results are avaialble return empty DO.
  */
 public function next(\DataObject $do = null) {
  if (is_null($do)) {
   $do = DOFactory::getInstance()->createDO(DOEnum::UserDO);
  }
  if ($this->currentRow < $this->rs->num_rows()) {
   $result = $this->rs->result_array();
   $do = $this->populateUserDO($do, $result[$this->currentRow]);
  }
  $this->currentRow = $this->currentRow + 1;
  return $do;
 }
 
 public function hasMoreUsers() {
  if ($this->currentRow < $this->rs->num_rows()) {
   return true;
  }
  return false;
 }
}

/* End of file UserDAO.php */
/* Location: /UserDAO.php */