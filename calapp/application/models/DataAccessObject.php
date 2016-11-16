<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of DataAccessObject
 * abstract class for the data access objects
 * @author user
 */
abstract class DataAccessObject {
 /**
  * signature for the next function, used to iterate over 
  * the result set and return a DO
  */
 abstract public function next(DataObject $do = null);
 
 /**
  * determines if the result set has more records
  * @param CI_DB_result $rs
  * @return boolean
  */
 public function hasMore(CI_DB_result $rs) {
  if ($rs->current_row <= $rs->num_rows) {
   return true;
  }
  return FALSE;
 }
}

/* End of file DataAccessObject.php */
/* Location: /DataAccessObject.php */