<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


/**
	Calendar Application
	
	CalendarDAO.php - 
*/

require_once 'DataAccessObject.php';

class CalendarDAO extends DataAccessObject {

	 private $currentRow;
	 protected $rs;
	 protected $columnNames;
 
	 function __construct() {
	  
	  $this->columnNames = 'IDCALENDAR,CALENDAR_NAME,SITEID,TYPE';
	  $this->currentRow = 0;
	 }
	 
	 
	/**
	  * execute the query to get the users and apply where clause
	  * @param CI_DB $db
	  * @param string $where
	  * @return CI_DB_result
	  */
	 protected function setResultSet($db, $where = NULL) {
	  $sql = 'select '.$this->columnNames.' from calendar';
	  if (!is_null($where)) {
	   $sql = $sql.' where '.$where;
	  }
	  $sql = $sql.' order by idcalendar';
	  $this->rs = $db->query($sql);
	 }
	 
	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateCalendarDO(CalendarDO $udo, array $row) {
		  if (array_key_exists('IDCALENDAR',$row)) {
		   $udo->setCalendarId($row['IDCALENDAR']);
		  }
		  if (array_key_exists('CALENDAR_NAME',$row)) {
		   $udo->setCalendarName($row['CALENDAR_NAME']);
		  }
		  if (array_key_exists('SITEID',$row)) {
		   $udo->setSiteId($row['SITEID']);
		  }
		  
		  if (array_key_exists('TYPE',$row)) {
		   $udo->setType($row['TYPE']);
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
		   $do = DOFactory::getInstance()->createDO(DOEnum::CalendarDO);
		  }
		  if ($this->currentRow < $this->rs->num_rows()) {
		   $result = $this->rs->result_array();
		   $do = $this->populateCalendarDO($do, $result[$this->currentRow]);
		  }
		  $this->currentRow = $this->currentRow + 1;
		  return $do;
	 }
	 
	 
	public function getCalendars($db) {
		$this->setResultSet($db);
	}
	
	public function hasMoreCalendars() {
		if ($this->currentRow < $this->rs->num_rows()) {
			return true;
		}
		return false;
	}
	
	public function getCalendarFromId($db,$udo){
		$this->setResultSet($db, 'idcalendar = '.$db->escape($udo->getCalendarId()));
	}

}