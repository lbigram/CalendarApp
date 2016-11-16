<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
	Calendar Application
	
	CalendarDO.php - The Calendar Data Object
*/


class AllocationDO extends DataObject {
 private $userid;
 private $calendarid;
 private $adate;
 private $username;
 private $calendarname;
 
 function __construct($userid, $calendarid, $adate, $username, $calendarname) {
  $this->userid = $userid;
  $this->calendarid = $calendarid;
  $this->adate = $adate;
  $this->username=$username;
  $this->calendarname = $calendarname;
 }
 
 public function getUserId() {
  return $this->userid;
 }
 public function getUsername() {
  return $this->username;
 }
 public function getCalendarname() {
  return $this->calendarname;
 }

 public function getCalendarId() { 
  return $this->calendarid;
 }

 public function getADate() {
  return $this->adate;
 }

 public function setUserId($userid) {
  $this->userid = $userid;
 }
 
  public function setUsername($username) {
  $this->username = $username;
 }
 
  public function setCalendarname($calendarname) {
  $this->calendarname = $calendarname;
 }

 public function setCalendarId($calendarid) {
  $this->calendarid = $calendarid;
 }

 public function setADate($adate) {
  $this->adate = $adate;
 }

}

