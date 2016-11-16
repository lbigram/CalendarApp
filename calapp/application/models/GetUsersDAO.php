<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of GetUsersDAO
 * DAO to get all users
 * @author user
 */
class GetUsersDAO extends UserDAO {
 function __construct() {
  parent::__construct();
 }
 
 public function getUsers($db) {
  $this->setResultSet($db);
 }
}

/* End of file GetUsersDAO.php */
/* Location: /GetUsersDAO.php */