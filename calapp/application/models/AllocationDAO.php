<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


/**
	Calendar Application
	
	CalendarDAO.php - 
*/

require_once 'DataAccessObject.php';

class AllocationDAO extends DataAccessObject {

	 private $currentRow;
	 protected $rs;
	 protected $columnNames;
 
	 function __construct() {
	  
	  $this->columnNames = 'c.USERID,c.CALENDARID,c.ADATE';
	  $this->currentRow = 0;
	 }
	 
	 
	/**
	  * execute the query to get the users and apply where clause
	  * @param CI_DB $db
	  * @param string $where
	  * @return CI_DB_result
	  */
	 protected function setResultSet($db, $where = NULL) {
	  $sql = 'select '.$this->columnNames.',a.USERNAME,b.CALENDAR_NAME from usercalendarallocations c,users a ,calendar b';
	  $sql = $sql . ' where c.userid = a.userid AND c.calendarid=b.idcalendar ';
	  if (!is_null($where)) {
	   $sql = $sql.' AND '.$where;
	  }
	  $sql = $sql.' order by userid';
	  
	 // print_r($sql);
	  $this->rs = $db->query($sql);
	 }
	 
	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateAllocationDO(AllocationDO $udo, array $row) {
		  
		  if (array_key_exists('USERID',$row)) {
		   $udo->setUserId($row['USERID']);
		  }
		  if (array_key_exists('CALENDARID',$row)) {
		   $udo->setCalendarId($row['CALENDARID']);
		  }
		  if (array_key_exists('ADATE',$row)) {
		   $udo->setADate($row['ADATE']);
		  }
		  if (array_key_exists('USERNAME',$row)) {
		   $udo->setUsername($row['USERNAME']);
		  }
		  if (array_key_exists('CALENDAR_NAME',$row)) {
		   $udo->setCalendarname($row['CALENDAR_NAME']);
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
		   $do = DOFactory::getInstance()->createDO(DOEnum::AllocationDO);
		  }
		  if ($this->currentRow < $this->rs->num_rows()) {
		   $result = $this->rs->result_array();
		   $do = $this->populateAllocationDO($do, $result[$this->currentRow]);
		  }
		  $this->currentRow = $this->currentRow + 1;
		  return $do;
	 }
	 
	 
	public function getAllocations($db,$where=null) {
		$this->setResultSet($db,$where);
	}
	
	public function hasMoreAllocations() {
		if ($this->currentRow < $this->rs->num_rows()) {
			return true;
		}
		return false;
	}
	
	public function getAllocationFromId($db,$udo){
		$this->setResultSet($db, 'calendarid = '.$db->escape($udo->getCalendarId() . ' AND userid = '.$db->escape($udo->getUserId())));
	}

}