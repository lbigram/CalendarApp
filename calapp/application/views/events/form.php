<div class="col-sm-10 col-sm-offset-2">
<?php
 $this->load->helper('form');
 echo form_open($action,array('role'=>'form'));
 
 if($eventDO->getEventid() == null) echo '<input type="hidden" id="eventid" name="eventid" value="1" />';
 else echo '<input type="hidden" id="eventid" name="eventid" value="'. $eventDO->getEventid().'" />';

 
 if (isset($msg) && strlen($msg) > 0) {
  if (strcmp($msgType,'error') == 0) {
   echo '<div class="alert alert-danger">';
  }
  elseif (strcmp($msgType,'success') == 0) {
   echo '<div class="alert alert-success">';
  }
  else {
   echo '<div class="alert">';
  }
  echo $msg.validation_errors().'</div>';
 } 
?>



<div class="form-group">
 <label for="eventname">Event name</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $eventDO->getEventname(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="eventname" name="eventname" value="<?php echo $eventDO->getEventname(); ?>" placeholder="Enter the event name" required="required"/>
 <?php } ?>
</div>

<div class="form-group">
  <label for="calendarid">Calendars:</label>
  <select name="calendarid" class="form-control" id="calendarid" >
   <?php
    $ddo = null;
    while ($calendarList->hasMoreAllocations()) {
     $ddo = $calendarList->next($ddo);
	 $v='';
	if ($ddo->getCalendarId() == $eventDO->getCalendarid()) $v='selected="selected"';
     echo '<option value="'.$ddo->getCalendarId(). '"' . $v .  '>' .   $ddo->getCalendarName(). '</option>';
    }
   ?>
  </select>
 </div>

<div class="form-group">
 <label for="location">Location</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $eventDO->getLocation(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="location" name="location" value="<?php echo $eventDO->getLocation(); ?>" placeholder="Enter the location" required="required"/>
 <?php } ?>
</div>

<div class="form-group">
 <label for="presenter">Presenter</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $eventDO->getPresenter(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="presenter" name="presenter" value="<?php echo $eventDO->getPresenter(); ?>" placeholder="Enter the presenter" required="required"/>
 <?php } ?>
</div>


<div class="form-group">
 <label for="details">Details</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $eventDO->getDetails(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="details" name="details" value="<?php echo $eventDO->getDetails(); ?>" placeholder="Enter the details" required="required"/>
 <?php } ?>
</div>

<div class="form-group">
 <label for="sdate">Start Date</label>
 <?php if ($mode == 'remove') { ?>
  <p class="form-control-static"><?php echo $eventDO->getSDate(); ?></p>
 <?php } else { ?>
 <input type="text" class="form-control" id="sdate" name="sdate" value="<?php echo $eventDO->getSdate(); ?>" placeholder="Enter the start date" required="required"/>
 <?php } ?>
</div>



<div class="form-group">
 <label for="stime">Start Time</label>
 <select id="stime" name="stime"  class="form-control"  >
	 <?php
	$start = "00:00";
	$end = "24:00";

	$tStart = strtotime($start);
	$tEnd = strtotime($end);
	$tNow = $tStart;
	$v="";

	while($tNow <= $tEnd){
	
		
		$curr = date("H:i",$tNow);
		if($curr==$eventDO->getStime()) $v="selected='selected'";
		echo "<option " . $v . "value='" . $curr. "'>". $curr . "</option>";
		$v="";
		$tNow = strtotime('+30 minutes',$tNow);
	}
	?>

 </select>
</div>



<div class="form-group">
 <label for="etime">End Time</label>
 <select id="etime" name="etime"  class="form-control"  >
	 <?php
	$start = "00:00";
	$end = "24:00";

	$tStart = strtotime($start);
	$tEnd = strtotime($end);
	$tNow = $tStart;
	$v="";

	while($tNow <= $tEnd){
	
		
		$curr = date("H:i",$tNow);
		if($curr==$eventDO->getEtime()) $v="selected='selected'";
		echo "<option " . $v . "value='" . $curr. "'>". $curr . "</option>";
		$v="";
		$tNow = strtotime('+30 minutes',$tNow);
	}
	?>

 </select>
</div>


 
 
  <hr />


<div  id="presenter" class="form-group">
</div>

<div  id="data" class="form-group">
</div>




 



<button type="submit" class="btn btn-primary"><?php echo $btnLabel; ?></button>
</form>

<script type="text/javascript">
    $(document).ready(function() {
	
	$('#sdate').datepicker({ dateFormat: 'yy-mm-dd' });
	//$('#edate').datepicker();
	
		load();
		$('#calendarid').on("change", function(){
			load();
			
			
	
			
			
		});
		
		
		
		

	function load(){
		
		$( "#data" ).html( " " );
		var toDisplay = "";
		var j;
		$.get( "http://localhost:8080/calapp/index.php/filter/filters/" + $('#calendarid').val(), function( data ) {
				var data2 = eval(data);
				
				
				
				
				for (var i = 0; i < data2.length; i++) {
					var object = data2[i];
					
					
					
					//if(object.FilterName == "Room") {
					
					//}
					toDisplay = toDisplay + " <label for='filterid" + object.FilterID+ "'>" + object.FilterName + "</label>";
					toDisplay = toDisplay + "<select name='filterid" + object.FilterID + "' class='form-control' id='filterid" + object.FilterID + "'>";
					toDisplay = toDisplay +"</select>";
					
					
					
					
				}
				
				$( "#data" ).html(toDisplay );
				
				for (var i = 0;i<data2.length;i++){
					var obj = data2[i];

					$.ajax({
						type: "GET",
						url: "http://localhost:8080/calapp/index.php/filter/filtervalues/"+obj.FilterID,
						async:false
						})
						.always(function( values ) {
							var values2 = eval(values);
								
								for (j=0;j<values2.length;j++){
								
									var object2 = values2[j];
									//alert('<option value="' + object2.IDFILTERVALUES + '">' + object2.VALUE + '</option>');
									$('#filterid'+obj.FilterID).append('<option value="' + object2.IDFILTERVALUES + '">' + object2.VALUE + '</option>');
									
								
								}
						});
				}
				


			
			}); 
			
			
			
			$.ajax({
				type: "GET",
				url: "http://localhost:8080/calapp/index.php/filter/eventfilters/"+ $('#eventid').val(),
				async:false
				})
				.always(function( values ) {
					var values2 = eval(values);
						
						for (j=0;j<values2.length;j++){
						
							var object2 = values2[j];
							//alert('<option value="' + object2.IDFILTERVALUES + '">' + object2.VALUE + '</option>');
							$('#filterid'+ object2.IDFILTERS). val(object2.FILTERVALUEID);
							
						
						}
				});
			
			



		}
		
		
		

  });
</script>


<div class="app-form-nav-links">
 <?php echo anchor($backAction, 'Back'); ?>
</div>
</div>