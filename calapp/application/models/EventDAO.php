<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


/**
	Calendar Application
	
	CalendarDAO.php - 
*/

require_once 'DataAccessObject.php';

class EventDAO extends DataAccessObject {

	 private $currentRow;
	 protected $rs;
	 protected $columnNames;
 
	 function __construct() {
	  $this->columnNames = ' C.IDEVENTS,C.LOCATION,C.EVENTNAME,C.SDATE,C.ETIME, C.STIME,C.PRESENTER,C.DETAILS ';
	  $this->currentRow = 0;
	 }
	 
	 
	/**
	  * execute the query to get the users and apply where clause
	  * @param CI_DB $db
	  * @param string $where
	  * @return CI_DB_result
	  */
	 protected function setResultSet($db, $where = NULL) {
	  $sql = 'select '.$this->columnNames.', b.CALENDAR_NAME, c.IDCALENDAR from events c, calendar b';
	  $sql = $sql . ' where c.idcalendar = b.idcalendar ';
	  if (!is_null($where)) {
	   $sql = $sql.' AND '.$where;
	  }
	  $sql = $sql.' order by idevents';
	  
	//  print_r($sql);
	  $this->rs = $db->query($sql);
	 }
	 
	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateEventDO(EventDO $udo, array $row) {
		  
		  if (array_key_exists('IDEVENTS',$row)) {
		   $udo->setEventid($row['IDEVENTS']);
		  }
		  if (array_key_exists('LOCATION',$row)) {
		   $udo->setlocation($row['LOCATION']);
		  }
		  if (array_key_exists('EVENTNAME',$row)) {
		   $udo->setEventname($row['EVENTNAME']);
		  }
		  if (array_key_exists('SDATE',$row)) {
		   $udo->setSdate($row['SDATE']);
		  }
		   if (array_key_exists('ETIME',$row)) {
		   $udo->setEtime($row['ETIME']);
		  }
		  if (array_key_exists('STIME',$row)) {
		   $udo->setStime($row['STIME']);
		  }
		   if (array_key_exists('PRESENTER',$row)) {
		   $udo->setPresenter($row['PRESENTER']);
		  }
		   if (array_key_exists('DETAILS',$row)) {
		   $udo->setDetails($row['DETAILS']);
		  }
		  if (array_key_exists('IDCALENDAR',$row)) {
		   $udo->setCalendarid($row['IDCALENDAR']);
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
		   $do = DOFactory::getInstance()->createDO(DOEnum::EventDO);
		  }
		  if ($this->currentRow < $this->rs->num_rows()) {
		   $result = $this->rs->result_array();
		   $do = $this->populateEventDO($do, $result[$this->currentRow]);
		  }
		  $this->currentRow = $this->currentRow + 1;
		  return $do;
	 }
	 
	 
	public function getEvents($db,$where=null) {
		$this->setResultSet($db,$where);
	}
	
	public function hasMoreEvents() {
		if ($this->currentRow < $this->rs->num_rows()) {
			return true;
		}
		return false;
	}
	
	public function getEventFromId($db,$udo){
		$this->setResultSet($db, ' idevents = '. $udo->getEventid());
		
		
	}

}