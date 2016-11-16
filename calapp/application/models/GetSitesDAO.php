<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of GetSitesDAO
 * get sites data access object
 * @author user
 */
class GetSitesDAO extends SiteDAO {
 function __construct() {
  parent::__construct();
 }
 
 public function getSites($db) {
  $this->setResultSet($db);
 }
}

/* End of file GetSitesDAO.php */
/* Location: /GetSitesDAO.php */