<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
	Calendar Application
	
	CalendarDO.php - The Calendar Data Object
*/


class EventDO extends DataObject {
 private $eventid;
 private $eventname;
 private $location;
 private $presenter;
 private $details;
 private $sdate;
 private $stime;
 private $etime;
 private $calendarid;
 private $calendarname;
 
 function __construct($eventid, $eventname, $location, $presenter, $details,$sdate,$stime, $etime, $calendarid,$calendarname) {
  $this->eventid = $eventid;
  $this->eventname = $eventname;
  $this->location = $location;
  $this->presenter=$presenter;
  $this->details = $details;
  $this->sdate = $sdate;
  $this->stime = $stime;
  $this->etime = $etime;
  $this->calendarid = $calendarid;
  $this->calendarname=$calendarname;
  
 }
 
 public function getSdate(){
	return $this->sdate;
 }
 
  public function getStime(){
	return $this->stime;
 }
 
   public function getEtime(){
	return $this->etime;
 }
 
  public function getCalendarid(){
	return $this->calendarid;
 }
 
 public function getCalendarname(){
	return $this->calendarname;
 }
 
 public function getEventid() {
  return $this->eventid;
 }
 public function getPresenter() {
  return $this->presenter;
 }
 public function getDetails() {
  return $this->details;
 }

 public function getEventname() { 
  return $this->eventname;
 }

 public function getLocation() {
  return $this->location;
 }

 public function setEventid($eventid) {
  $this->eventid = $eventid;
 }
 
  public function setPresenter($presenter) {
  $this->presenter = $presenter;
 }
 
  public function setDetails($details) {
  $this->details = $details;
 }

 public function setEventname($eventname) {
  $this->eventname = $eventname;
 }

 public function setLocation($location) {
  $this->location = $location;
 }
 
  public function setStime($stime) {
  $this->stime = $stime;
 }
 
 public function setEtime($etime) {
  $this->etime = $etime;
 }
 
 public function setSdate($sdate) {
  $this->sdate = $sdate;
 }
 
 public function setCalendarid($calendarid) {
  $this->calendarid = $calendarid;
 }
 
  public function setCalendarname($calendarname) {
  $this->calendarname = $calendarname;
 }

}

