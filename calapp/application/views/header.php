<?php
 $userLoggedOn = true;
 $logon_userRec = $this->session->userdata('logon_userRec');
 if (is_bool($logon_userRec) && !$logon_userRec) {
  $userLoggedOn = false; 
 }
 
 $logon_loginName = $this->session->userdata('loginName');
 if (is_bool($logon_loginName) && $logon_loginName === FALSE) {
  $loginName = '';
 }
 elseif (is_string($logon_loginName)) {
  $loginName = $logon_loginName;
 }
 else {
  $loginName = '';
 }
 $logon_isAdmin = $this->session->userdata('isAdmin');
 if (is_bool($logon_isAdmin) && $logon_isAdmin === FALSE) {
  $isAdmin = 0;
 }
 else {
  $isAdmin = intval($logon_isAdmin);
 }
 $logon_menuOption = $this->session->userdata('menuoption');
 if (is_bool($logon_menuOption) && $logon_menuOption === FALSE) {
  $menuOption = 0;
 }
 else {
  $menuOption = intval($logon_menuOption);
 }
?>
<!doctype html>
<html>
 <head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title><?php echo $page_title; ?></title>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" />
  <!-- owl slider plugin -->
  <!-- Important Owl stylesheet -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/owl-carousel/owl.carousel.css">
  <!-- Default Theme -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/owl-carousel/owl.theme.css">
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
   <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
  <![endif]-->
  
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  

  <script type="text/javascript">
   base_url = '<?php echo base_url(); ?>';
   site_url = '<?php echo site_url(); ?>';
  </script>
  
   
  
 </head>
 <body>
  <div class="container">
   <div class="row header">
    <nav class="navbar" role="navigation">
     <div class="container-fluid">
      <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="<?php echo site_url(); ?>">Calendar Application</a>
      </div>
      <div class="collapse navbar-collapse" id="main-menu">
       <?php if ($userLoggedOn) { ?>
       <ul class="nav navbar-nav">
        
			<?php if ($isAdmin == 1) { ?>
			<li <?php if ($menuOption == 1) { echo 'class="active"';} ?>><?php echo anchor('calendar/index','Calendars',array('class'=>'navbar-link')); ?></li> 
			<li <?php if ($menuOption == 1) { echo 'class="active"';} ?>><?php echo anchor('admin/index','Users',array('class'=>'navbar-link')); ?></li> 
			<li <?php if ($menuOption == 1) { echo 'class="active"';} ?>><?php echo anchor('site/index','Sites',array('class'=>'navbar-link')); ?></li>
			<li <?php if ($menuOption == 1) { echo 'class="active"';} ?>><?php echo anchor('allocations/index','Allocations',array('class'=>'navbar-link')); ?></li>
			<li <?php if ($menuOption == 1) { echo 'class="active"';} ?>><?php echo anchor('events/index','Events',array('class'=>'navbar-link')); ?></li> 
			
			<li <?php if ($menuOption == 1) { echo 'class="active"';} ?>><?php echo anchor('display/index','Calendar Display',array('class'=>'navbar-link')); ?></li> 
			<?php } else { ?>
			<li <?php if ($menuOption == 1) { echo 'class="active"';} ?>><?php echo anchor('events/index','Events',array('class'=>'navbar-link')); ?></li> 
			<?php }  ?>
	  </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><?php echo anchor('main/logout','Sign Out',array('class'=>'navbar-link')); ?></li>
       </ul>
       <?php } else { ?>
       <ul class="nav navbar-nav navbar-right">
			<li><?php echo anchor('main/logon','Sign In',array('class'=>'navbar-link')); ?></li>
       </ul>
       <?php } ?>
      </div>
     </div>
    </nav>
   </div>
   <div class="row">
    <article class="main-content">
    