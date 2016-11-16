<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
	Calendar Application
	
	Calendar.php - Controller for Calendar menu item.
*/


/*******************/
require 'MainCalendarApp.php';
/*******************/

class Display extends MainCalendarApp {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',1);
 }
 
 /**
	Display first page
*/
  public function index() {
	$data = array();
	 $this->displayPageWithData('display/calendar', $data);
 }
 

}

?>