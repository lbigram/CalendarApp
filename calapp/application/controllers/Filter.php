<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
	Calendar Application
	
	Calendar.php - Controller for Calendar menu item.
*/


/*******************/
require 'MainCalendarApp.php';
/*******************/

class Filter extends MainCalendarApp {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',1);
 }
 
 /**
	Display first page
*/
  public function index() {
	//$this->showCalendarList(array());
 }
 
 
 
 public function filters($calendarid)
 {
	$this->load->model('FilterM');
	$dataa = $this->FilterM->getFilters($calendarid);
	
	//return $data;
	echo json_encode($dataa);
 
 }
 
 public function filtervalues($filterid)
 {
	$this->load->model('FilterM');
	$dataa = $this->FilterM->getFiltervalues($filterid);
	
	//return $data;
	echo json_encode($dataa);
 
 }
 
 public function eventfilters($eventid){
	
	$this->load->model("FilterM");
	$t = $this->FilterM->getFilterEvents($eventid);
	
	echo json_encode($t);

 }

 
 
}

?>