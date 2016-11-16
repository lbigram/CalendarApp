<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of GetSiteDAO
 * gets a single site from the database
 * @author user
 */
class GetSiteDAO extends SiteDAO {
 function __construct() {
  parent::__construct();
 }
 
 public function getSiteFromId($db, SiteDO $sdo) {
  $this->setResultSet($db, 'siteId = '.$db->escape($sdo->getSiteId()));
 }
 
 public function getSiteForList($db, ACQListDO $ldo) {
  //$this->setResultSet($db, 'siteId = (select b.siteId from acqList a inner join divisions b on a.divCode = b.divCode where a.listId = '.$ldo->getListId().')');
 }
 
 
}

/* End of file GetSiteDAO.php */
/* Location: /GetSiteDAO.php */