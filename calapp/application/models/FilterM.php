<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of Site
 * Site model
 * @author kpersadsingh
 */
require_once 'CalModel.php';
include 'FilterDAO.php';



class FilterM extends CalModel {
 function __construct() {
  parent::__construct();
 }
 
 
 
 public function getFilters($calendarid) {
	 
 
	$calDao = new FilterDAO();
	$calDao->getFilters($this->db," where calid=". $calendarid);
	//return $calDao;
	
	
	$udo = null;
	$dataToSend=array();
	$i=0;
   while ($calDao->hasMoreFilters()) {
    $udo = $calDao->next($udo);
	$dataToSend[$i]=array('FilterID'=>$udo->getFilterid(),'FilterName'=>$udo->getFiltername());
	$i++;
   
   }
	
	return $dataToSend;

 }
 
 public function getFiltervalues($filterid){
 
	$db = $this->db;
	$sql = 'select IDFILTERVALUES,IDFILTERS,VALUE from filtervalues where idfilters=' . $filterid;
	
	$rs = $db->query($sql);
	
	$arr = array();
	for ($i=0;$i < $rs->num_rows();$i++){
	
		 $result= $rs->result_array();
		 $row = $result[$i];
		$temp = array('IDFILTERVALUES'=>$row['IDFILTERVALUES'], 'VALUE'=>$row['VALUE']);
	
		array_push($arr, $temp);
	
	}
	
	return $arr;
 
}

public function insertFilters($id)
{
	$keyval = array_keys($_POST);
	foreach($keyval as $v)
	{
		if( strcmp(substr($v, 0, 8),"filterid") == 0) {
			//print_r("HERE : ". $_POST[$v]);
			$filterid = substr($v, 8,10);
			
			$db = $this->db;
			$sql = 'insert into eventfiltervalues(filtervalueid,eventid,filterid) values(' . $_POST[$v] . ',' . $id .',' . $filterid . ')';
			$rs = $db->query($sql);
		}
	}
}

public function getFilterEvents($eventid){

	$db = $this->db;
	$sql = 'select a.FILTERVALUEID, a.EVENTID, b.IDFILTERS from eventfiltervalues a,filtervalues b where a.FILTERVALUEID=b.IDFILTERVALUES AND a.eventid=' . $eventid;
	
	$rs = $db->query($sql);
	
	$arr = array();
	for ($i=0;$i < $rs->num_rows();$i++){
	
		 $result= $rs->result_array();
		 $row = $result[$i];
		$temp = array('FILTERVALUEID'=>$row['FILTERVALUEID'], 'IDFILTERS'=>$row['IDFILTERS']);
	
		array_push($arr, $temp);
	
	}
	
	return $arr;
}

public function updatefilters(){

	$keyval = array_keys($_POST);
	foreach($keyval as $v)
	{
	
	
		if( strcmp(substr($v, 0, 8),"filterid") == 0) {
			$filterid = substr($v, 8,10);
			
		//	print_r("sdfHERE : ". $filterid);
			
			$db = $this->db;
			$sql = 'update eventfiltervalues set filtervalueid=' . $_POST[$v] . ' where filterid=' . $filterid .' AND eventid=' . $_POST['eventid'];
			$rs = $db->query($sql);
		}
	}

}



 private function setEventIdValidationRule() {
  $this->form_validation->set_rules('eventid','Event ID','trim|required|is_natural_no_zero|xss_clean');
 }


}
/* End of file Site.php */
/* Location: /Site.php */