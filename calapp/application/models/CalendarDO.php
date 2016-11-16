<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
	Calendar Application
	
	CalendarDO.php - The Calendar Data Object
*/


class CalendarDo extends DataObject {
 private $calendar_id;
 private $siteid;
 private $calendar_name;
 private $type;
 
 function __construct($calendar_id, $siteid, $calendar_name, $type) {
  $this->calendar_id = $calendar_id;
  $this->siteid = $siteid;
  $this->calendar_name = $calendar_name;
  $this->type = $type;
 }
 
 public function getCalendarId() {
  return $this->calendar_id;
 }

 public function getSiteId() { 
  return $this->siteid;
 }

 public function getCalendarName() {
  return $this->calendar_name;
 }
 
 public function getType() { 
  return $this->type;
 }

 public function setCalendarId($calendar_id) {
  $this->calendar_id = $calendar_id;
 }

 public function setSiteId($siteid) {
  $this->siteid = $siteid;
 }

 public function setCalendarName($calendar_name) {
  $this->calendar_name = $calendar_name;
 }
 
 public function setType($type) {
  $this->type = $type;
 }


}

