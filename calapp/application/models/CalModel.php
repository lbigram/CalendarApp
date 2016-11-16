<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
	Calendar Application
	
	CalModel.php - The first/main model for Calendar. All models must extend this one.
*/


include 'DOEnum.php';
include 'DataObject.php';;
include 'UserDO.php';
include 'CalendarDO.php';
include 'SiteDO.php';
include 'AllocationDO.php';
include 'EventDO.php';
include 'FilterDO.php';

include 'DOFactory.php';

class CalModel extends CI_Model {
 
 function __construct() {
  parent::__construct();
 }
 
}

