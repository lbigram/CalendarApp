<?php

include 'display/classes/calendar.php';

$username = "root";
$password = "";
$hostname = "localhost"; 

//connection to the database
//$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

//select a database to work with
//$selected = mysql_select_db("calapp",$dbhandle) or die("Could not select examples");


$mysqli = mysqli_connect("localhost", "root", "", "calapp");


//$res = mysqli_query($mysqli, "SELECT 'A world full of ' AS _msg FROM DUAL");
//$row = mysqli_fetch_assoc($res);
//echo $row['_msg'];




if(isset($_POST['filtervalues'])) {
	$_SESSION['filtervalue'] =  $_POST['filtervalues'];  
}else if(isset($_POST['unset'])) {
	$_SESSION['filtervalue'] =  null;
	$_SESSION['calendar'] = null;
}
  
  if(isset($_POST['filter'])) {
	if($_POST['filter'] == "Calendar") $_SESSION['calendar']="true";
  }
  
  if(isset($_SESSION['filtervalue'])) {
  
		if(isset($_SESSION['calendar'])) {

				$val = $_SESSION['filtervalue']; //$_POST['filtervalues'];
				
				//$result = mysql_query("select * from events where idcalendar=$val");
				
				$result = mysqli_query($mysqli, "select * from events where idcalendar=$val");
	
				$calendar = setup();
				listevents($result,$calendar);
	  
		}else {
	  
				$val = $_SESSION['filtervalue']; //$_POST['filtervalues'];
				$calendar = setup();
				//$result = mysql_query("select * from eventfiltervalues a, events b where a.filtervalueid=$val and a.eventid = b.idevents");
				
				$result = mysqli_query($mysqli, "select * from eventfiltervalues a, events b where a.filtervalueid=$val and a.eventid = b.idevents");

				listevents($result,$calendar);
		}
  
  }else  {
  
  
			$calendar = setup();
			//$result = mysql_query("SELECT * FROM events");
			
			$result = mysqli_query($mysqli, "select * from events");

			//fetch tha data from the database
			listevents($result,$calendar);

	}

function listevents($result,$calendar){

		$events = array();
		while($row = mysqli_fetch_assoc($result)) {
		//while ($row = mysql_fetch_array($result)) {
			  
			  $toDisplay = display($row);
			   
			   if( $row{'idcalendar'} >= 10)
					//$event1 = $calendar->event()->condition('timestamp', strtotime($row{'sdate'}))->title($row{'eventname'})->output($row{'stime'} . "-" .$row{'eventname'})->details($toDisplay)->add_class('custom-event-class');
					
					$event1 = $calendar->event()->condition('timestamp', strtotime($row['sdate']))->title($row['eventname'])->output($row['stime'] . "-" .$row['eventname'])->details($toDisplay)->add_class('custom-event-class');
					
					
			   else{// holiday
					$event = $calendar->event()->condition('current', TRUE)->add_class('holiday');
					
					
					//$event1 = $event->condition('timestamp', strtotime($row{'sdate'}))->title($row{'eventname'})->output($row{'eventname'} . " Holiday")->details($toDisplay)->add_class('custom-event-class');
					
					$event1 = $event->condition('timestamp', strtotime($row['sdate']))->title($row['eventname'])->output($row['eventname'] . " Holiday")->details($toDisplay)->add_class('custom-event-class');
			   }

			   $calendar->attach($event1);
		}


}

function display($row){

	$toDisplay = " <ul style='list-style:none'>";
	/*$toDisplay = $toDisplay . "<li><strong style='color:green'>Event:" . $row{'eventname'} . "</strong></li>";
	$toDisplay = $toDisplay . "<li>Location:" . $row{'location'} . "</li>";
	$toDisplay = $toDisplay . "<li>Date:" . $row{'sdate'} . "</li>";
	$toDisplay = $toDisplay . "<li>Time:" . $row{'stime'} . "-" . $row{'etime'}. "</li>";
	$toDisplay = $toDisplay . "<li>Presenter:" . $row{'presenter'} . "</li>";
	$toDisplay = $toDisplay . "<li>Details:" . $row{'details'} . "</li>";
	$toDisplay = $toDisplay . "</ul> ";*/
	
	
	$toDisplay = $toDisplay . "<li><strong style='color:green'>Event:" . $row['eventname'] . "</strong></li>";
	$toDisplay = $toDisplay . "<li>Location:" . $row['location'] . "</li>";
	$toDisplay = $toDisplay . "<li>Date:" . $row['sdate'] . "</li>";
	$toDisplay = $toDisplay . "<li>Time:" . $row['stime'] . "-" . $row['etime']. "</li>";
	$toDisplay = $toDisplay . "<li>Presenter:" . $row['presenter'] . "</li>";
	$toDisplay = $toDisplay . "<li>Details:" . $row['details'] . "</li>";
	$toDisplay = $toDisplay . "</ul> ";
	
	
	return $toDisplay;		  
}

function setup(){

	$month = isset($_GET['m']) ? $_GET['m'] : NULL;
	$year  = isset($_GET['y']) ? $_GET['y'] : NULL;
	$calendar = Calendar::factory($month, $year);
	$calendar->standard('today')->standard('prev-next');
	return $calendar;

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Calendar</title>
		
		
		<script type="text/javascript">
		
		(function() {
		
		document.getElementsByClassName("link").onclick = function(){
			this.preventDefault();
		
		};
		
		});
		</script>
		
		
		<script>
		
			function showdiv( i){
					
					document.getElementById('details'+i).className = "show";
					
					//document.getElementById('details'+i).style.display='block';
					//window.alert(i);
				}
				
			function hidediv( i){
				
				document.getElementById('details'+i).className = "hide";
			}
				
			function populate(filter){
				
				var x =document.getElementById('filtervalues');

					var i;
					for(i=x.options.length-1;i>=0;i--)
					{
						x.remove(i);
					}
					
					if (filter == "Calendar") getcalendars(filter,x);
					else getvalues(filter,x);

			}
			
			function getvalues(filter,x){
			
				var xmlHttp = null;

				xmlHttp = new XMLHttpRequest();
				xmlHttp.open("GET", "http://localhost:8080/public/index.php/calendar/filtervalues/" + filter, false );
				xmlHttp.send();
				
				var values2 = eval(xmlHttp.responseText);
									
				for (var j=0;j<values2.length;j++){
				
					var object2 = values2[j];
				
					var option = document.createElement("option");
					option.value = "" + object2.IDFILTERVALUES;
					option.text = "" + object2.VALUE;
					x.add(option);
				
				}
			}
		
			function getcalendars(filter,x){
			
				var xmlHttp = null;

				xmlHttp = new XMLHttpRequest();
				xmlHttp.open( "GET", "http://localhost:8080/public/index.php/calendar/calendars", false );
				xmlHttp.send();
				
				var values2 = eval(xmlHttp.responseText);
									
				for (var j=0;j<values2.length;j++){
				
					var object2 = values2[j];
				
					var option = document.createElement("option");
					option.value = "" + object2.IDCALENDAR;
					option.text = "" + object2.CALENDAR_NAME;
					x.add(option);
				
				}

			}
			
		</script>
		<style>
		
		
			.calendar {width:100%; border-collapse:collapse;}
			.calendar tr.navigation th {padding-bottom:20px;}
			.calendar th.prev-month {text-align:left;}
			.calendar th.current-month {text-align:center; font-size:1.5em;}
			.calendar th.next-month {text-align:right;}
			.calendar tr.weekdays th {text-align:left;}
			.calendar td {width:14%; height:100px; vertical-align:top; border:1px solid #CCC;}
			.calendar td.today {background:#FFD;}
			.calendar td.prev-next {background:#EEE;}
			.calendar td.prev-next span.date {color:#9C9C9C;}
			.calendar td.holiday {background:#DDFFDE;}
			.calendar span.date {display:block; padding:4px; line-height:12px; background:#EEE;}
			.calendar div.day-content {}
			.calendar ul.output {margin:0; padding:0 4px; list-style:none;}
			.calendar ul.output li {margin:0; padding:5px 0; line-height:1em; border-bottom:1px solid #CCC;}
			.calendar ul.output li:last-child {border:0;}


			.calendar.small {width:auto; border-collapse:separate;}
			.calendar.small tr.navigation th {padding-bottom:5px;}
			.calendar.small tr.navigation th a span {font-size:1.5em;}
			.calendar.small th.current-month {font-size:1em;}
			.calendar.small tr.weekdays th {text-align:center;}
			.calendar.small td {width:auto; height:auto; padding:4px 8px; text-align:center; border:0; background:#EEE;}
			.calendar.small span.date {display:inline; padding:0; background:none;}
			
			th{
			
			background: none repeat scroll 0 0 #6c162e;
			color: #eee;
			font-weight: bold;

			}

			body{
				padding-top: -20px;
				
				
				background-color: #f5f5f5;
   
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
				margin-bottom: 20px;
				min-height: 20px;
				padding: 19px;
				
				
			}

			#calendarbody > section{
				padding-top:0px;
				
			
			}
			
			.hide{
				display:none;
				
				position: absolute;

					width: 300px;
					height: 200px;
					color: #959595;
					top: 25%;
					left: 25%;
					width: 50%;
					height: 50%;
					padding: 16px;
					border: 16px solid black;
					background-color: white;
					z-index:1002;
					overflow: auto;
			
			}
			
			.show{
					display: block;
					position: absolute;

					width: 300px;
					height: 200px;
					padding: 16px;
					background-color: white;
					z-index:1002;
					overflow: auto;
					color: #959595;
			}
			
			
			
			.btn-close {
  color: #aaa;
  font-size: 30px;
  text-decoration: none;
  position: absolute;
  right: 5px;
  top: 0;
}
.btn-close:hover {
  color: #909090;
}

.modal:before {
  content: "";
  /*display: none;*/
  background: transparent;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: -1;
}



.modal-dialog {
  background: #fefefe;
  border: #333 solid 1px;
  border-radius: 5px;
  margin-left: -200px;
  position: fixed;
  left: 50%;
  top: -100%;
  z-index: 11;
  width: 360px;
  
  display:none;
  

}

.modal-body {
  padding: 20px;
}

.modal-header,
.modal-footer {
  padding: 10px 20px;
}

.modal-header {
  border-bottom: #eee solid 1px;
}
.modal-header h2 {
  font-size: 20px;
}

.modal-footer {
  border-top: #eee solid 1px;
  text-align: right;
}


		</style>
	</head>
	
<body id="calendarbody" style="padding-top:0px;">

		<div>
			<form method="post" action="" style="display:inline;">
			  <label for="filter">Filter:</label>
			  <select name = "filter" id="filter" onclick="populate(this.value)" >
				<option value="Calendar">Calendar</option>
			   <?php
						$result = mysql_query("SELECT * FROM filters");
						//fetch tha data from the database
						while ($row = mysql_fetch_array($result)) {
							echo "<option value='" . $row['idfilters'] . "'>" . $row['filter_name'] . "</option>";
						}
			   ?>
			  </select>
			  
			  <label style="display:inline" for="filtervalues">Filter Values:</label>
			  <select name = "filtervalues" id="filtervalues" >
				
			   <?php
					
			   ?>
			  </select>
			  
			  <input type="submit" value="Filter" /> 
			</form>
			
			
			<form method="post" action="" style="display:inline;">
			
			<input type ="hidden" value="set" name="unset" id="unset"/>
			  <input type="submit" value="Unset Filter" style="display:inline;" /> 
			</form>
			 
		</div>
		
		

		<div style="width:100%;">
			<table class="calendar">
				<thead>
					<tr class="navigation">
						<th class="prev-month"><a href="<?php echo htmlspecialchars($calendar->prev_month_url()) ?>"><?php echo $calendar->prev_month() ?></a></th>
						<th colspan="5" class="current-month"><?php echo $calendar->month() ?></th>
						<th class="next-month"><a href="<?php echo htmlspecialchars($calendar->next_month_url()) ?>"><?php echo $calendar->next_month() ?></a></th>
					</tr>
					<tr class="weekdays">
						<?php foreach ($calendar->days() as $day): ?>
							<th><?php echo $day ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					<?php foreach ($calendar->weeks() as $week): ?>
						<tr>
							<?php foreach ($week as $day): ?>
								<?php
								list($number, $current, $data) = $day;
								
								$classes = array();
								$output  = '';
								$details = '';
								
								if (is_array($data))
								{
									$classes = $data['classes'];
									$title   = $data['title'];
									$output  = empty($data['output']) ? '' : '<ul class="output"><li>'.implode('</li><li>', $data['output']).'</li></ul>';
									
									$details = implode($data['details']);
									
									//echo $details;
								}
								?>
								<td class="day <?php echo implode(' ', $classes) ?>">
									<span class="date" title="<?php echo implode(' / ', $title) ?>"><?php echo $number ?></span>
									
									
									<span id="details<?php echo $i ?>"   class="hide"  >
									
										 <span class="modal-header">
										  <h3>Events for <?php echo $number ?> <?php echo $calendar->month() ?> </h3>
										  <label class="btn-close" onclick="hidediv('<?php echo $i ?>');">×</label>
										</span>
										  <p><?php echo $details ?> </p>
										
										<span class="modal-footer">
										</span>
									
									</span>
									
									<span >
										<a href="#" onclick="showdiv('<?php echo $i?>');"><?php echo $output ?></a>
									</span>
									
									<?php $i++; ?>
								</td>
							<?php endforeach ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		
		 
		 
  
  
		
		</body>
		
		</html>
