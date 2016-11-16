<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of SiteDAO
 * abstract site DAO class
 * @author user
 */
require_once 'DataAccessObject.php';

class SiteDAO extends DataAccessObject {
 private $currentRow;
 protected $rs;
 protected $columnNames;
 
 function __construct() {
  $this->columnNames = 'IDSITE,SITETITLE,SITEURL';
  $this->currentRow = 0;
 }
 
 /**
  * execute the query to get the sites and apply where clause
  * @param CI_DB $db
  * @param string $where
  * @return CI_DB_result
  */
 protected function setResultSet($db, $where = NULL) {
  $sql = 'select '.$this->columnNames.' from site';
  if (!is_null($where)) {
   $sql = $sql.' where '.$where;
  }
  $sql = $sql.' order by idsite';
  $this->rs = $db->query($sql);
 }
 
 /**
  * populate a sitedo from a row from the result set
  * @param SiteDO $sdo
  * @param array $row
  * @return \SiteDO
  */
 protected function populateSiteDO(SiteDO $sdo, array $row) {
  if (array_key_exists('IDSITE',$row)) {
   $sdo->setSiteId($row['IDSITE']);
  }
  if (array_key_exists('SITETITLE',$row)) {
   $sdo->setSiteTitle($row['SITETITLE']);
  }
  if (array_key_exists('SITEURL',$row)) {
   $sdo->setSiteURL($row['SITEURL']);
  }
  return $sdo;
 }
 
 /**
  * gets the next record from the result set and populates the passed SiteDO 
  * (a SiteDO is created if it is null). 
  * @param \DataObject $do
  * @return \SiteDO if no more results are avaialble return empty DO.
  */
 public function next(\DataObject $do = null) {
  if (is_null($do)) {
   $do = DOFactory::getInstance()->createDO(DOEnum::SiteDO);
  }
  if ($this->currentRow < $this->rs->num_rows()) {
   $result = $this->rs->result_array();
   $do = $this->populateSiteDO($do, $result[$this->currentRow]);
  }
  $this->currentRow = $this->currentRow + 1;
  return $do;
 }
 
 /**
  * returns true if the result set has more data, false otherwise
  * @return boolean
  */
 public function hasMoreSite() {
  if ($this->currentRow < $this->rs->num_rows()) {
   return true;
  }
  return false;
 }
 
 /**
  * return the number of rows in the result set
  * @return integer
  */
 public function numRows() {
  return $this->rs->num_rows();
 }
 
 
 public function getSiteFromId($db,$udo){
		$this->setResultSet($db, 'idsite = '.$db->escape($udo->getSiteId()));
	}

 
 
}

/* End of file SiteDAO.php */
/* Location: /SiteDAO.php */