<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of DOFactory
 * factory for the data objects
 * @author kpersadsingh
 */
class DOFactory {
 public static $instance = null;
 
 private function __construct() { }
 
 public static function getInstance() {
  if (!isset(self::$instance)) {
   self::$instance = new DOFactory();
  }
  
  return self::$instance;
 }
 
 /**
  * checks that the parametes passed are the ones required to create a DO
  * If the required values are not passed, the default value is set
  * returns an array containing the parameters to instantiate the DO with
  * 
  * @param array $pParams
  * @param array $pReqParams
  * @param array $pDefaults
  * @return array
  */
 private function checkParameters (array $pParams, array $pReqParams, array $pDefaults) {
  if (isset($pParams)) {
   $arr = $pDefaults;
   foreach ($pParams as $key => $keyValue) {
    if (in_array($key, $pReqParams)) {
     $arr[$key] = $keyValue;
    }
   }
   
   return $arr;
  }
  else { //null passed so create with defaults
   return $pDefaults;
  }
 }
 
 /**
  * create DOs, $pDO is the DO to be created (integer)
  * $pParams is an array containing parameters to pass to DO
  * 
  * @param integer $pDO
  * @param array $pParams
  * @return a data object
  */
 public function createDO($pDO, array $pParams = null) {
  if (is_null($pParams)) {
   $pParams = array();
  }
  switch ($pDO) {
   case DOEnum::CalendarDO: 
    $vParams = $this->checkParameters($pParams, array('IDCALENDAR', 'CALENDAR_NAME','SITEID','TYPE'), array('IDCALENDAR'=>'','CALENDAR_NAME'=>'','SITEID'=>'','TYPE'=>''));
    $vDO = new CalendarDO($vParams['IDCALENDAR'],$vParams['SITEID'], $vParams['CALENDAR_NAME'],$vParams['TYPE']);
    break;
   case DOEnum::UserDO:
    $vParams = $this->checkParameters($pParams, array('USERID','USERNAME','LDAPUSERCODE','USERACTIVE','ISADMIN'), array('USERID'=>0,'USERNAME'=>'','LDAPUSERCODE'=>'','USERACTIVE'=>0,'ISADMIN'=>0));
    $vDO = new UserDO($vParams['USERID'],$vParams['USERNAME'],$vParams['LDAPUSERCODE'],$vParams['USERACTIVE'],$vParams['ISADMIN']);
    break;
   case DOEnum::SiteDO: 
    $vParams = $this->checkParameters($pParams, array('IDSITE','SITETITLE','SITEURL'), array('IDSITE'=>'','SITETITLE'=>'','SITEURL'=>''));
    $vDO = new SiteDO($vParams['IDSITE'], $vParams['SITETITLE'], $vParams['SITEURL']);
    break;
	case DOEnum::AllocationDO: 
    $vParams = $this->checkParameters($pParams, array('USERID','CALENDARID','ADATE', 'USERNAME', 'CALENDARNAME'), array('USERID'=>'','CALENDARID'=>'','ADATE'=>'','USERNAME'=>'','CALENDARNAME'=>''));
    $vDO = new AllocationDO($vParams['USERID'], $vParams['CALENDARID'], $vParams['ADATE'],$vParams['USERNAME'],$vParams['CALENDARNAME']);
    break;
	case DOEnum::EventDO: 
    $vParams = $this->checkParameters($pParams, array('IDEVENTS','EVENTNAME','LOCATION', 'PRESENTER', 'DETAILS','SDATE','STIME','ETIME','CALENDARID','CALENDARNAME'), array('IDEVENTS'=>'','EVENTNAME'=>'','LOCATION'=>'','PRESENTER'=>'','DETAILS'=>'','SDATE'=>'','STIME'=>'','ETIME'=>'','CALENDARID'=>'','CALENDARNAME'=>''));
    $vDO = new EventDO($vParams['IDEVENTS'], $vParams['EVENTNAME'], $vParams['LOCATION'],$vParams['PRESENTER'],$vParams['DETAILS'],$vParams['SDATE'],$vParams['STIME'],$vParams['ETIME'],$vParams['CALENDARID'],$vParams['CALENDARNAME']);
    break;
	case DOEnum::FilterDO: 
    $vParams = $this->checkParameters($pParams, array('IDFILTERS','FILTER_NAME','CALENDARID'), array('IDFILTERS'=>'','FILTER_NAME'=>'','CALENDARID'=>''));
    $vDO = new FilterDO($vParams['IDFILTERS'], $vParams['FILTER_NAME'], $vParams['CALENDARID']);
    break;
	
	default:
    $vDO = null;
  }
  
  return $vDO;
 }
}

/* End of file DOFactory.php */
/* Location: /DOFactory.php */