<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of ACQModel
 * parent of the models
 * @author kpersadsingh
 */

include 'DOEnum.php';
include 'DataObject.php';
include 'UserDO.php';

include 'DOFactory.php';

class UserModel extends CI_Model {
 function __construct() {
  parent::__construct();
 }
 
}

/* End of file ACQModel.php */
/* Location: /ACQModel.php */