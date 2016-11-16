<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
	Calendar Application
	
	CalendarDO.php - The Calendar Data Object
*/


class FilterDO extends DataObject {
 private $filterid;
 private $filtername;
 private $calendarid;
 private $values = array(); //these are filter value options
 //private $eventvalues = array(); //these are the actually selected values for hte filters.
 
 function __construct($filterid,$filtername,$calendarid) {
	$this->filterid = $filterid;
	$this->filtername=$filtername;
	$this->calendarid=$calendarid;
 }
 
 public function setFilterId($filterid) {
  $this->filterid = $filterid;
 }
 
 
  public function setFiltername($filtername) {
  $this->filtername = $filtername;
  
 }
 
  public function setCalendarId($calendarid) {
  $this->calendarid = $calendarid;
 }
 
  public function getFilterid(){
	return $this->filterid;
 }
 
   public function getFiltername(){
	return $this->filtername;
 }
 
   public function getCalendarid(){
	return $this->calendarid;
 }
 
 


}

