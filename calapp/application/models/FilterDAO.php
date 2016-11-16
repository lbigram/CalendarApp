<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


/**
	Calendar Application
	
	CalendarDAO.php - 
*/

require_once 'DataAccessObject.php';

class FilterDAO extends DataAccessObject {

	 private $currentRow;
	 protected $rs;
	 protected $columnNames;
 
	 function __construct() {
	  
	  $this->columnNames = ' IDFILTERS, FILTER_NAME,CALID ';
	  $this->currentRow = 0;
	 }
	 
	 
	/**
	  * execute the query to get the users and apply where clause
	  * @param CI_DB $db
	  * @param string $where
	  * @return CI_DB_result
	  */
	 protected function setResultSet($db, $where = NULL) {
	  $sql = 'select '.$this->columnNames.' from filters ';
	 // $sql = $sql . ' where c.userid = a.userid AND c.calendarid=b.idcalendar ';
	  if (!is_null($where)) {
	   $sql = $sql. $where;
	  }
	  $sql = $sql.' order by idfilters';
	  $this->rs = $db->query($sql);
	 }
	 
	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateFilterDO(FilterDO $udo, array $row) {
		  
		  if (array_key_exists('IDFILTERS',$row)) {
		   $udo->setFilterid($row['IDFILTERS']);
		  }
		  if (array_key_exists('CALENDARID',$row)) {
		   $udo->setCalendarid($row['CALENDARID']);
		  }
		  if (array_key_exists('FILTER_NAME',$row)) {
		   $udo->setFiltername($row['FILTER_NAME']);
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
		   $do = DOFactory::getInstance()->createDO(DOEnum::FilterDO);
		  }
		  if ($this->currentRow < $this->rs->num_rows()) {
		   $result = $this->rs->result_array();
		   $do = $this->populateFilterDO($do, $result[$this->currentRow]);
		  }
		  $this->currentRow = $this->currentRow + 1;
		  return $do;
	 }
	 
	 
	public function getFilters($db,$where=null) {
		$this->setResultSet($db,$where);
	}
	
	public function hasMoreFilters() {
		if ($this->currentRow < $this->rs->num_rows()) {
			return true;
		}
		return false;
	}
	
	public function getFilterFromId($db,$id){
		$this->setResultSet($db, 'calid = ' . $id);
	}

}