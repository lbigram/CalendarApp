<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of SiteDO
 * site data object
 * @author kpersadsingh
 */
class SiteDO extends DataObject {
 private $siteId;
 private $siteTitle;
 private $siteURL;

         
 function __construct($siteId, $siteTitle, $siteURL) {
  $this->siteId = $siteId;
  $this->siteName = $siteTitle;
  $this->siteURL = $siteURL;
 }
 
 public function getSiteId() {
  return $this->siteId;
 }

 public function getSiteTitle() {
  return $this->siteName;
 }

 public function getSiteURL() {
  return $this->siteURL;
 }
 
 public function setSiteId($siteId) {
  $this->siteId = $siteId;
 }

 public function setSiteTitle($siteTitle) {
  $this->siteName = $siteTitle;
 }

 public function setSiteURL($siteURL) {
  $this->siteURL = $siteURL;
 }

}

/* End of file SiteDO.php */
/* Location: /SiteDO.php */